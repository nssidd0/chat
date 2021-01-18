<?php
// Getting the value of post parameters
$room = $_POST['room'];

// checking for string size
	if (strlen($room)>20 or strlen($room)<2)
	{
			$message = "Plz choose an alphanumeric room name";
			echo '<script language="javascript">';
			echo 'alert("'.$message.'");';
			echo 'window.location="http://localhost/chatroom";';
			echo '</script>';
	}

  // Checking wether room name is alphanumeric
  else if (!ctype_alnum($room))
  {
    $message = "Plz choose an alphanumeric room name";
      echo '<script language="javascript">';
      echo 'alert("'.$message.'");';
      echo 'window.location="http://localhost/chatroom";';
      echo '</script>';
  }
else
{
  //connect to the database
  include 'db_connect.php';
}

// Check if room alreday exixts

$sql = "SELECT * FROM `rooms` WHERE roomname = '$room'";
$result = mysqli_query($conn, $sql);
if($result)
{
  if (mysqli_num_rows($result) > 0)
  {
      $message = "This room does not exist. Try creating a new one";
      echo '<script language="javascript">';
      echo 'alert("'.$message.'");';
      echo 'window.location="http://localhost/chatroom";';
      echo '</script>';
  }
  else
  {
    $sql = "INSERT INTO `rooms` ('roomname', 'stime') VALUES ('$room', CURRENT_TIMESTAMP);";
    if (mysqli_query($conn, $sql))
    {
      $message = "Ur name is ready n u can chat now!";
      echo '<script language="javascript">';
      echo 'alert("'.$message.'");';
      echo 'window.location="http://localhost/chatroom/rooms.php?roomname=` . $room. `";';
      echo '</script>';
    }
  }
}
else
{
  echo "Error: ". mysqli_error($conn);
}
?>
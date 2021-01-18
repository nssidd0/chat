<?php
// Getting the value of post parameters
$room = $_POST['room'];

// Checking for string size
if (strlen($room)>20 or strlen($room)<2)
{
	$message = "Plz inlet between 2 to 20 characters";
	echo '<script language="javascript">';
	echo 'alert("'.$message.'");';
	echo 'window.location="http://localhost/greenhouse";';
	echo '</script>';
}

// Checking wether room name is alphanumeric
else if (!ctype_alnum($room))
{
	$message = "Plz inlet an alphanumeric room name";
	echo '<script language="javascript">';
	echo 'alert("'.$message.'");';
	echo 'window.location="http://localhost/greenhouse";';
	echo '</script>';
}
else
{
	//Connecting to the database
include 'db_connect.php';
}

// Check if room already exits

$sql = "SELECT * FROM `rooms` WHERE roomname = '$room'";
$result = mysqli_query($conn, $sql);
if($result)
{
	if (mysqli_num_rows($result) > 0)
	{
		$message = "Plz inlet a different room name. This room is already inlet";
		echo '<script language="javascript">';
		echo 'alert("'.$message.'");';
		echo 'window.location="http://localhost/greenhouse";';
		echo '</script>';
	}

	else
	{
		$sql = "INSERT INTO `rooms` ('roomname', 'stime') VALUES ('$room', CURRENT_TIMESTAMP)";
		if (mysqli_query($conn, $sql))
		{
			$message = "Your name is ready and you can chat now!";
			echo '<script language="javascript">';
			echo 'alert("'.$message.'");';
			echo 'window.location="http://localhost/greenhouse/rooms.php?roomname=' . $room. '";';
			echo '</script>';
		}
	}
}

else
{
	echo "Error: ". mysqli_error($conn);
}
?>
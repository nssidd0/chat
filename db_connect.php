<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "chatroom";

// Creating database connection

$conn = mysqli_connect($servername, $username, $password, $database);

// Check connection

if (!$conn)
{
	die("ufff". mysqli_connect_error());
}

?>
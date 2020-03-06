<?php
$servername = "localhost";
$username = "yash";
$password = "yash";

// Create connection
$con = mysqli_connect($servername, $username, $password);

// Check connection
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

?>

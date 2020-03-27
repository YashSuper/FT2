<!--
  * @file
  * this file is used for fetching out logged in user's blogsa.
-->
<?php
// Included base connector file.
include ('dbconnector.php');
// Select DB.
mysqli_select_db($con, 'blog');
$username = $_SESSION['username'];
// Prepare and execute query.
$q = "select * from blog where username = '$username'";
$res = mysqli_query ($con, $q);
?>

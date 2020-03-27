<!--
  * @file
  * this file is used for fetching out logged in user's details .
-->
<?php
// Included base connector file.
include ('dbconnector.php');
// Select database.
mysqli_select_db($con, 'blog');
// Prepare and execute query.
$q = "select * from user";
$res = mysqli_query ($con, $q);
?>

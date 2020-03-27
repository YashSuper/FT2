<!--
  * @file
  * this file is used for fetching out all the blogs.
-->
<?php
// Included base connector file.
include ('dbconnector.php');
// Select DB.
mysqli_select_db($con, 'blog');
// Prepare and execute query.
$q = 'select * from blog order by time desc';
$res = mysqli_query ($con, $q);
?>

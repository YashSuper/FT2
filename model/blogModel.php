<!--
  * @file
  * This file is used selecting out specific blog.
-->
<?php
// Included base connector file.
include 'dbconnector.php';
// Select Database.
mysqli_select_db ($con, 'blog');
$id = $_GET['id'];
// Prepare query and execute it.
$q = "select * from blog where id ='".$id."'";
$res = mysqli_query ($con, $q);
 ?>

<!--
  * @file
  * this file is used for deleting out the records.
-->
<?php
// Included base connector file.
include 'dbconnector.php';
// Selected DB.
mysqli_select_db ($con, 'blog');
// Prepare and executed query.
$q = "DELETE FROM blog WHERE id = '$id'";
$res = mysqli_query ($con, $q);
?>

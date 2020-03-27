<!--
  * @file
  * this file is used for login and its validation.
-->

<?php
// Included the base connecctor file.
include ('dbconnector.php');
// Select the DB.
mysqli_select_db($con, 'blog');
$username = $_SESSION['username'];
// Write the query and executed it. 
$q = "INSERT INTO `blog` (`Title`, `Des`, `image`, `time`,  `username`) VALUES ('$title', '".$des."', '$img_locate' ,'$time', '$username')";
$res = mysqli_query ($con, $q);
echo mysqli_error($con);
 ?>

<!--
  * @file
  * this file is used for updating a blog post.
-->
<?php
// Included base connector file.
include ('dbconnector.php');
$id = $_GET['id'];
$username = $_SESSION['username'];
mysqli_select_db($con, 'blog');
// Image will be updated only when there is a change.
if ($_FILES['pic']) {
  $q = "UPDATE blog
  SET Title = '$title', Des= '$des, time = '$time', image = '$img_locate'
  WHERE id = $id";
}
else {
$q = "UPDATE blog
SET Title = '$title', Des= '$des, time = '$time'
WHERE id = $id";
}
$res = mysqli_query ($con, $q);
echo mysqli_error($con);
?>

<!--
  * @file
  * this file is used for render out UI for logged in user home page.
-->
<?php
echo "<h3 class=text-center> WELCOME ".$_SESSION['username']."!! </h3>";
include ('homeView.php');
?>

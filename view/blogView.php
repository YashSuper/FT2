<!--
  * @file
  * this file is used for render out UI for add blog.
-->
<?php
$temp = mysqli_fetch_array ($res);
if(isset ($_SESSION ['username']))
if ($_SESSION['username'] == $temp['username']) {
  echo "<a href='/index/user/edit/".$temp['id']."' class='btn btn-info float-right mx-3'>EDIT</a>";
  echo "<a href='/index/user/delete/".$temp['id']."' class='btn btn-info float-right mx-3'>DELETE</a>";
}

if ($temp['image']) {
  echo " <div  style='background:url(/" . $temp['image'] . ");background-size:cover;background-position:center;height:500px'></div>";
}
else {
  echo "<h1 class='text-center'> No Image Found </h1><br><br>";
}
echo "<div class=' title border border-secondary'><h1 class='text-center'>".$temp['Title']."</h1></div>";
echo "<h6>Published on ".date('d-m-Y', $temp['time'])."</h6>";
echo "<h5>".$temp['Des']."</h5>";
?>

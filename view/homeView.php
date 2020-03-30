<!--
  * @file
  * this file is used for render out home view for blogs.
-->

<!-- styling for blog cards -->
<style media="screen">
.ulogin {
  background-color: #002b4f;
  padding: 50px;
  color: white;
  box-shadow: 0px 4px 5px #454444;
  transition: all .1s ease;

}
.ulogin:hover {
  transform: scale(1.01);
  box-shadow: 0px 4px 10px #00ddff;
  background-color: rgba(20,148,255,.9);

}
.login {
  color: white;
  background-color: #ba3b00;
  padding: 50px;
  box-shadow: 0px 4px 5px #454444;
  transition: all .2s ease;
}
.login:hover {
  transform: scale(1.01);
  box-shadow: 0px 4px 10px #00ddff;
  background-color: rgba(255,119,0,.9);
  }

</style>

<?php
  // Fetching out row from the returned mysqli_result_object.
  while ( $temp = mysqli_fetch_array ($res) ) {
    // Break out description into words.
    $des = explode(" ",$temp['Des']);
    echo "<br>";
    // Check if the user is logged in.
    if (isset ($_SESSION ['username'])) {
      // Check if the post belongs to logged in user.
      if ($_SESSION['username'] == $temp['username']) {
        // If yes then style it differently.
        echo "<div class='ulogin container'>";
    }
      else {
        // If no then style accordingly.
        echo "<div class='login container'>";
      }
    }
    else {
      echo "<div class='login container'>";
    }

    echo "<h1>  <a style ='color:white;' href='/index/blog/show/".$temp['id']."'>".$temp['Title']."</a></h1>
    </a>
    <hr>
    <h5>";
    // Print out 20 words for card summary.
    for($i=0;$i<20;$i++) {
        echo $des[$i]." ";
    }
    // Read more link.
    echo  "....<a style ='color:#57ff9f;' href='/index/blog/show/".$temp['id']."'> Read More</a></h5>";
    // Rendering out edit and delete button if user is logged in.
    if (isset ($_SESSION ['username']))
      if ($_SESSION['username'] == $temp['username']) {
        echo "<a href='/index/user/edit/".$temp['id']."' class='btn btn-info float-right mx-3'>EDIT</a>";
        echo "<a href='/index/user/delete/".$temp['id']."' class='btn btn-info float-right mx-3'>DELETE</a>";

      }
      echo "</div>";
    }

?>

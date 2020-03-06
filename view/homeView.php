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

  while ( $temp = mysqli_fetch_array ($res) ) {
    $des = explode(" ",$temp['Des']);


    echo "<br>";
    if(isset ($_SESSION ['username'])) {
      if ($_SESSION['username'] == $temp['username']) {
        echo "<div class='ulogin container'>";

    }
    else {
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
    for($i=0;$i<20;$i++) {
        echo $des[$i]." ";
    }
    echo  "....<a style ='color:#57ff9f;' href='/index/blog/show/".$temp['id']."'> Read More</a></h5>";
    if(isset ($_SESSION ['username']))
    if ($_SESSION['username'] == $temp['username']) {
      echo "<a href='/index/user/edit/".$temp['id']."' class='btn btn-info float-right mx-3'>EDIT</a>";
      echo "<a href='/index/user/delete/".$temp['id']."' class='btn btn-info float-right mx-3'>DELETE</a>";

    }




  echo "</div>";


  }

?>

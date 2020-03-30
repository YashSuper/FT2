<?php
/**
 * This class implements user's blog operations.
 */
class UserModel {

  function myblogs () {
    // Included base connector file.
    include ('dbconnector.php');
    // Select DB.
    mysqli_select_db($con, 'blog');
    $username = $_SESSION['username'];
    // Prepare and execute query.
    $q = "select * from blog where username = '$username'";
    $res = mysqli_query ($con, $q);
    return $res;
  }

  function add ($title, $des, $img_locate, $time, $username) {
    include ('dbconnector.php');
    // Select the DB.
    mysqli_select_db($con, 'blog');
    $username = $_SESSION['username'];
    // Write the query and executed it.
    $q = "INSERT INTO `blog` (`Title`, `Des`, `image`, `time`,  `username`) VALUES ('$title', '".$des."', '$img_locate' ,'$time', '$username')";
    $res = mysqli_query ($con, $q);
    return $res;
  }

  function  delete ($id) {
    include ('dbconnector.php');
    // Selected DB.
    mysqli_select_db ($con, 'blog');
    // Prepare and executed query.
    $q = "DELETE FROM blog WHERE id = '$id'";
    $res = mysqli_query ($con, $q);
    return $res;
  }

  function update ($title, $des, $img_locate, $time,$id) {
    $username = $_SESSION['username'];
    include ('dbconnector.php');
    mysqli_select_db($con, 'blog');
    // Image will be updated only when there is a change.
    if ($_FILES['pic']) {
      $q = "UPDATE blog
      SET Title = '$title', Des= '$des', time = '$time', image = '$img_locate'
      WHERE id = '$id'";
    }
    else {
    $q = "UPDATE blog
    SET Title = '$title', Des= '$des', time = '$time'
    WHERE id = '$id'";
    }
    $res = mysqli_query ($con, $q);
    echo mysqli_error($con);
    return $res;
  }

  function isown ($id) {
    include('dbconnector.php');
    mysqli_select_db($con, 'blog');
    $q = "SELECT * from blog where id = '$id' ";
    $temp = mysqli_query($con, $q);
    $res =  mysqli_fetch_array ($temp);
    echo $res['username'];
    echo $_SESSION['username'];
    if($res['username']  == $_SESSION['username']){
      echo "Same";
      return True;
    }
    else {
      echo "not qeual";
      return False;
    }

  }

}
?>

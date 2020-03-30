<!--
  * @file
  * This file is used for performing logged in user's operations on database.
-->

<?php
/**
 * This class implements user's blog operations.
 */
class UserModel {

  /**
   * Function myblogs fetches out all the blogs of a user.
   * @return mixed mysqli_result_object
   */
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

  /**
   * Function add insert a new entry in blog table.
   * @param string $title
   *  This contains title of the blog post.
   * @param string $des
   *  This contains description of the blog post.
   * @param string $img_locate
   *  This contains location of the image on the server.
   * @param int $time
   *  This contains the timestamp of the blog creation.
   * @param string $username
   *  This contains the user by which blog is created.
   *  @return mixed
   *  This Function returns the mysqli_result_object.
   */
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

  /**
   * Function delete removes a particular entry from the database.
   * @param  int $id
   *  This contains the unique id for the blog post.
   * @return bool
   *  This Function returns the mysqli_result_object.
   */
  function  delete ($id) {
    include ('dbconnector.php');
    // Selected DB.
    mysqli_select_db ($con, 'blog');
    // Prepare and executed query.
    $q = "DELETE FROM blog WHERE id = '$id'";
    $res = mysqli_query ($con, $q);
    return $res;
  }

  /**
   * Function update updates a pre-existing blog.
   * @param string $title
   *  This contains title of the blog post.
   * @param string $des
   *  This contains description of the blog post.
   * @param string $img_locate
   *  This contains location of the image on the server.
   * @param int $time
   *  This contains the timestamp of the blog creation.
   * @param int $id
   *  This contains the unique id for a blog.
   *  @return mixed
   *  This Function returns the mysqli_result_object.
   */
  function update ($title, $des, $img_locate, $time, $id) {
    $username = $_SESSION['username'];
    include ('dbconnector.php');
    mysqli_select_db($con, 'blog');
    // Image will be updated only when there is a change.
    if ($_FILES['pic']['tmp_name'] ) {
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

  /**
   * Function isown checks if a blog is created by logged in user or not.
   * @param  int $id
   * This contains a unique id number for particular blog.
   * @return bool
   */
  function isown ($id) {
    include('dbconnector.php');
    mysqli_select_db($con, 'blog');
    $q = "SELECT * from blog where id = '$id' ";
    $temp = mysqli_query($con, $q);
    $res =  mysqli_fetch_array ($temp);

    if($res['username']  == $_SESSION['username']){
      return True;

    }
    else {
      return False;
    }

  }

}
?>

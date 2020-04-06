<!--
  * @file
  * This file is used for performing user operations and render out suitable results.
-->
<?php
// Check for if already logged in.
 if (!isset ($_SESSION['username'])) {
   header('location: index.php');
}

/**
 * Implements logged in user operations namely add, delete, udpate.
 */
class UserController {

  /**
   * Constructor function adds up model code.
   */
  function __construct () {
    include ('model/userModel.php');
  }

 /**
  * Function home renders out the name of logged in user.
  * @return mixed
  */
 function home () {
   echo $_SESSION['username'];
 }

 /**
  * Function myblogs renders out loggedin user's view.
  * @return mixed
  */
 function myblogs () {
   $userObj = new UserModel;
   $res = $userObj -> myblogs ();
   include ('view/userblogView.php');
 }

 /**
  * Function add  insert a new blog record into the databse.
  * @return bool
  */
 function add () {
   if (isset ($_POST['Title'])) {
     // Initializing variables.
     $title = $_POST['Title'];
     $des = $_POST['Des'];
     $time = time();
     $username = $_SESSION['username'];
     echo $_SESSION['username'];
     $img = $_FILES['pic']['name'];
     // Stores the temp name of image.
     $tmp_img = $_FILES['pic']['tmp_name'];
     // Locate the image in the folder.
     $img_locate = "pic/" . $img;
     move_uploaded_file($tmp_img,$img_locate);
     $userObj = new UserModel;
     $res = $userObj -> add ($title, $des, $img_locate, $time, $username);
     if ($res) {
       header('location:/');
     }
   }
   else {
     include('view/addView.php');
   }

 }

 /**
  * Function delete delete a particular record.
  * @return bool
  */
 function delete () {
   $id = $_GET['id'];
   $userObj = new UserModel;
   if(!$userObj -> isown ($id)){
     header('location: /index/blog/access_denied');
   }
   $res = $userObj -> delete ($id);
   if ($res){
     header('location:/');
   }

 }

 /**
  * Function edit updates a record.
  * @return bool
  */
 function edit () {
   $id = $_GET['id'];
   $userObj = new UserModel;
   if(!($userObj -> isown ($id))) {
     header('location: /index/blog/access_denied');
   }

   if (isset($_POST['Title'])) {
     $title = $_POST['Title'];
     $des = $_POST['Des'];
     $time = time();
     $img_locate = '';
     $username = $_SESSION['username'];
       // Stores the temp name of image.
     if ($_FILES['pic']['tmp_name']) {
       $img = $_FILES['pic']['name'];
       $tmp_img = $_FILES['pic']['tmp_name'];
       echo $tmp_img;
       // Locate the image in the folder.
       $img_locate = "pic/" . $img;
       move_uploaded_file($tmp_img,$img_locate);
   }
    $res = $userObj -> update ($title, $des, $img_locate, $time, $id);
     if ($res) {
       header('location: /');
     }
   }
   include('model/blogModel.php');
   include('view/editView.php');
 }
}

?>

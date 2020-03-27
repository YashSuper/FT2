<?php
// Check for logged in.
if (!isset ($_SESSION['username'])) {
  header('location: index.php');
}

/**
 * Implements logged in user operations namely add, delete, udpate.
 */
class UserController {

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
   include ('model/userblogModel.php');
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
     include('model/addModel.php');
     if ($res) {
       header('location:index.php');
     }
   }
   else{

     include('view/addView.php');
   }

 }

 /**
  * Function delete delete a particular record.
  * @return bool
  */
 function delete () {
   $id = $_GET['id'];
   include('model/deleteModel.php');
   header('location:/');
 }

 /**
  * Function edit updates a record.
  * @return bool
  */
 function edit() {
   if(isset($_POST['Title'])) {
     $title = $_POST['Title'];
     $des = $_POST['Des'];
     $time = time();
     $username = $_SESSION['username'];
     echo $_SESSION['username'];
     if($_FILES['pic']) {
       $img = $_FILES['pic']['name'];
       //stores the temp name of image
       $tmp_img = $_FILES['pic']['tmp_name'];
       //locate the image in the folder
       $img_locate = "pic/" . $img;
       move_uploaded_file($tmp_img,$img_locate);
   }
     include('model/addModel.php');
     if ($res) {
       header('location:/');
     }
   }
   include('model/blogModel.php');
   include('view/editView.php');
 }
}

?>

<?php

  if(!isset($_SESSION['username'])) {
    header('location: index.php');
  }

 class userController {
   function home () {
     echo $_SESSION['username'];
   }
   function myblogs () {
     include('model/userblogModel.php');
     include('view/userblogView.php');
   }
   function add () {
     if(isset($_POST['Title'])) {
       $title = $_POST['Title'];
       $des = $_POST['Des'];
       $time = time();
       $username = $_SESSION['username'];
       echo $_SESSION['username'];
       $img = $_FILES['pic']['name'];
       $tmp_img = $_FILES['pic']['tmp_name'];                      //stores the temp name of image
       $img_locate = "pic/" . $img;                                   //locate the image in the folder
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
   function delete () {
     $id = $_GET['id'];
     include('model/deleteModel.php');
     header('location:/');
   }
   function edit() {
     if(isset($_POST['Title'])) {
       $title = $_POST['Title'];
       $des = $_POST['Des'];
       $time = time();
       $username = $_SESSION['username'];
       echo $_SESSION['username'];
       if($_FILES['pic']) {

       $img = $_FILES['pic']['name'];
       $tmp_img = $_FILES['pic']['tmp_name'];                      //stores the temp name of image
       $img_locate = "pic/" . $img;                                   //locate the image in the folder
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

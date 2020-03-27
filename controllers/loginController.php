<?php
/**
 * This controller takes care of login, Validation and logout.
 */
class LoginController {
  /**
   * This function renders the login view.
   * @return mixed
   */
  function login () {
    if(isset ($_SESSION['username']))
      header ('location:/index/user/myblogs');
      include ('view/loginView.php');
   }

   /**
    * This function validates the login and details from the database.
    * @return mixed
    */
   function validate() {
     include ('model/loginModel.php');
     while ($temp = mysqli_fetch_array ($res)) {
       if($temp['username'] == $_POST['username'] && $temp['password'] == $_POST['password']) {
         $_SESSION['username'] = $temp['username'];
         header('location: /index/user/myblogs');
         break;
       }
       else {
         echo '<div class="alert alert-danger" role="alert"> Wrong Username or password  </div>';
         include ('view/loginView.php');

       }
     }
   }

   /**
    * This function implements the logout functionality.
    * @return mixed
    */
   function logout() {
     session_destroy();
     header ('location: /');
   }

 }

 ?>

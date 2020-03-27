<!--
  * @file
  * This  file contains the Front Controller for this blog task.
-->

<!-- Bootstrap CDN -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<?php
// Enable Error reporting for the system.
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
// Fetch Url.
$url = $_SERVER['REQUEST_URI'];
// Create  an array of parameters.
$param = explode("/", $url);
if (isset ($param[2]))
  $_GET['controller'] = $param[2];
if (isset ($param[3]))
  $_GET['function'] = $param[3];
if (isset ($param[4]))
  $_GET['id'] = $param[4];
// Set default controller and function to home.
$controller = 'home';
$function = 'home';
// Set the Parameters if setted.
if (isset ($_GET['controller']) && $_GET['controller'] != '') {
  $controller = $_GET['controller'];
}
if (isset ($_GET['function']) && $_GET['function'] != '') {
  $function = $_GET['function'];
}
// Started the session.
session_start ();
// Included the header.
include ('view/header.php');
// Include the controller file if its name is correct.
if (file_exists('controllers/'.$controller.'Controller.php')){
include ('controllers/'.$controller.'Controller.php');
}
else {
  include ('view/pageNotFound.php');
}
// Creating object from the controller passed in the parameter.
$class = ucfirst($controller).'Controller';
$obj = new $class;
// Called the function of controller if it is a valid one.
if (method_exists ($obj, $function)) {
  $obj -> $function ();
}
else {
  include('view/pageNotFound.php');
}
?>

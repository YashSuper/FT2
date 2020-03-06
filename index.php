<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$url = $_SERVER['REQUEST_URI'];
$param = explode("/", $url);
if(isset($param[2]))
$_GET['controller'] = $param[2];
if(isset($param[3]))
$_GET['function'] = $param[3];
if(isset($param[4])) {
  $_GET['id'] = $param[4];
}
print_r ($param);


  $controller = 'home';
  $function = 'home';
  if (isset ($_GET['controller']) && $_GET['controller'] != '') {
    $controller = $_GET['controller'];
  }
  if (isset ($_GET['function']) && $_GET['function'] != '') {
    $function = $_GET['function'];
  }
  session_start ();
  include ('view/header.php');
  include ('controllers/'.$controller.'Controller.php');
  $class = $controller.'Controller';
  $obj = new $class;
  $obj -> $function ();
 ?>

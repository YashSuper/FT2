<?php
spl_autoload_register('MyAutoLoader');
function MyAutoLoader($className) {
  $path = "controllers/";
  $ext = ".php";
  $fullpath = $path. $className. $ext;
  if(!file_exists($fullpath)) {
    return false;
  }
  include_once $fullpath;
}
?>

<?php namespace Controller;

/**
 * Home page renderer.
 */
class HomeController {
  function __construct () {
    echo "ankit tennis ";
  }
  /**
   * This function renders out home page.
   * @return mixed
   */
  function home () {
    include ('model/homeModel.php');
    include ('view/homeView.php');
  }
}
?>

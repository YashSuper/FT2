<?php
/**
 * Home page renderer.
 */
class HomeController {
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

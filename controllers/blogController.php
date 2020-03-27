<?php
/**
 * class for showing the blog in expanded form.
 */
class BlogController {
  /**
   * This function show renders out the blog in a detailed way.
   * @return mixed
   */
  function show () {
    include ('model/blogModel.php');
    include ('view/blogView.php');
  }
}

?>

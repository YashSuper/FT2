<!--
  * @file
  * this file is used for render out Header.
-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand" href="/">Home</a>
  <button class="navbar-toggler"
   type="button"
   data-toggle="collapse"
   data-target="#navbarSupportedContent"
   aria-controls="navbarSupportedContent"
   aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse"
   id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
    <?php
    // Render out username on the header when logged in.
    if (isset ($_SESSION['username'])) {
      echo '<li class="nav-item active">
      <a class="nav-link" href="/index/user/myblogs" style="text-transform:capitalize;">'.$_SESSION['username'].'\'s blogs</a>
      </li>';
      echo '<li class="nav-item active">
      <a class="nav-link" href="/index/user/add">Add New Blog</a>
      </li>';
      echo '<li class="nav-item active">
      <a class="nav-link" href="/index/login/logout">Log Out</a>
      </li>';
      }
    // Login render otherwise.
    else {
      echo '<li class="nav-item active">
      <a class="nav-link" href="/index/login/login">Log In <span class="sr-only">(current)</span></a>
      </li>';
    }
    ?>

    </ul>
  </div>
</nav>

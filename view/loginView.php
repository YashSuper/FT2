<!--
  * @file
  * This file is used for render out UI for login page.
-->
<div class="mx-auto my-5" style="width:50%;padding:50px;box-shadow:0px 3px 7px #1a1a1a;">
    <form class="login form-group" action="/index/login/validate" method="post">
    <input class="form-control" type="text" name="username" placeholder="Enter your username"><br>
    <input class="form-control" type="password" name="password" placeholder="Enter your password"><br>
    <input class="form-control btn btn-primary" type="submit" value="login">
  </form>
</div>

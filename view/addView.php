<!--
  * @file
  * This file is used for render out UI for add blog.
-->
<div class="container">
  <br>
  <form class="form-group" action="/index/user/add"  method="post" enctype="multipart/form-data">
    <input class="form-control" type="text" name="Title"  required placeholder="Enter Title of the Post"> <br>
    <textarea name="Des" rows="8" cols="121" required placeholder="Enter Description of the post"></textarea>
    <br><br>
    <input type="file" name="pic" class="form-control"  value="Select Image"><br>
    <input class="btn btn-primary" type="submit"  class="form-control" value="Submit">
  </form>

</div>

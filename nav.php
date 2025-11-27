<?php
if (!isset($_SESSION)) session_start();
?>

<nav class="navbar navbar-dark bg-dark">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#menu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <span class="navbar-text text-white">PHP</span>
  </div>
</nav>

<div class="offcanvas offcanvas-start" id="menu">
  <div class="offcanvas-header">
    <h5>Menu</h5>
    <button class="btn-close" data-bs-dismiss="offcanvas"></button>
  </div>
  <div class="offcanvas-body">
    <ul class="list-group">
      <a href="profile.php" class="list-group-item list-group-item-action">Profile</a>
      <a href="add_user.php" class="list-group-item list-group-item-action">Add User</a>
      <a href="index.php" class="list-group-item list-group-item-action text-danger">Logout</a>
    </ul>
  </div>
</div>

<?php

session_start();

require_once("../snap/src/snapchat.php");

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Log in:
    $snapchat = new Snapchat($username, $password);

// Authenticate session
if ($snapchat->auth_token == "") {
    header("Location: login.php?error=1");
    exit();
}
    
    $_SESSION['username'] = $username;
    $_SESSION['password'] = $password;
    header("Location: ./");
    exit();
}

$body="";
if ($_GET['error'] == 1) {
    $body.='<div class="alert alert-dismissable alert-danger">
  <strong>Incorrect username or password!</strong> Make sure you\'re using your Snapchat account.
</div>';
}
$body.='

<form role="form" method="post" action="login.php">
  <div class="form-group">
    <label for="username">Username</label>
    <input type="text" class="form-control" id="username" placeholder="Enter Snapchat username" name="username">
  </div>
  <div class="form-group">
    <label for="password">Password</label>
    <input type="password" class="form-control" id="password" placeholder="Enter Snapchat password" name="password">
  </div>
  <button type="submit" class="btn btn-default">Submit</button>
</form>

';

require_once("html.inc");
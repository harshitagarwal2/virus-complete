<?php

require_once('login_detail.php');
require_once('register_functions.php');
require_once('common_functions.php');
// Define variables and initialize with empty values
$name = $username = $password = $confirm_password = "";
$name_err = $username_err = $password_err = $confirm_password_err = '';


if($_SERVER["REQUEST_METHOD"] == "POST"){
  if(isset($_POST['name'])){
    $name = sanitizeString($_POST['name']);
  };
  if(isset($_POST['username'])){
    $username = sanitizeString($_POST['username']);
  };
  if(isset($_POST['password'])){
    $password = sanitizeString($_POST['password']);
  };

  if(isset($_POST['confirm_password'])){
    $confirm_password = sanitizeString($_POST['confirm_password']);
  };

  $name_err = CheckName($name);
  $username_err = validate_username($username);
  $password_err = validate_password($password);
  $confirm_password_err = validate_confirmPassword($password,$confirm_password);

  if(empty($name_err) && empty($username_err) && empty($password_err) && empty($confirm_password_err)) {
    $salt1 = "l&hga@1"; $salt2 = "pg!@";
    $token = hash('ripemd128', "$salt1$password$salt2");
    if($name!= "" && $username!= "" && $password != "" && $confirm_password != "" ) {
      $connection = createConnection($GLOBALS['hn'],$GLOBALS['db'], $GLOBALS['un'],$GLOBALS['pw']);
      registerUser($connection,$name,$username,$token);
      $connection->close();
    }
  }

};

 ?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Virus-Sweep</title>
    <link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/style.css">
<script src="js/register.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-show-password/1.0.3/bootstrap-show-password.min.js"></script>

  </head>
  <body class="bg-faded">
    <div class="container">

      <header class="mt-2 mb-5">
          <a href="login.php">Home</a>
      </header>

      <div  class="row">
        <div class="col-sm-4">
            <img src="img/icon.jpg" alt="Image-icon" class="center-" style="center-align;width:300px;height:300px;">
        </div>
        <div class="col-sm-8">
          <label class="display-4">Fill in the Details to Register</label>
          <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" onsubmit="return validate(this)" >
            <div class="form-group">
                  <label for="name">Name</label>
                  <input class="form-control" type="text" name="name" placeholder="Enter your Full Name" value="<?php echo $name; ?>">
                    <span class="help-block text-danger"><?php echo $name_err; ?></span>
            </div>
              <div class="form-group">
                <label for="username">Username</label>
                <input class="form-control" type="text" name="username" placeholder="Enter username" value="<?php echo $username; ?>">
                  <span class="help-block text-danger"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group">
                <label for="password">password</label>
                <input class="form-control" type="password" id="password" data-toggle="password" name="password" placeholder="Enter password" value="<?php echo $password; ?>">
                  <span class="help-block text-danger"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <label for="password">Confirm Password</label>
                <input class="form-control" type="password" name="confirm_password" placeholder="Enter password again" value="<?php echo $confirm_password; ?>">
                    <span class="help-block text-danger"><?php echo $confirm_password_err; ?></span>
                <br><br>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <input type="reset" class="btn btn-default" value="Reset">
            </div>
          </form>
        </div>

      </div>
    </div>

    <footer >
      <div class="footer-copyright m-5">
          <div class="container-fluid text-center">
            Page created by Harshit - Copyright (c) 2017
          </div>
      </div>
    </footer>


  <script type="text/javascript">
  	$("#password").password('toggle');
  </script>

  </body>
</html>

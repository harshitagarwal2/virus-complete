<?php
require_once('login_detail.php');
require_once('login_functions.php');
require_once('common_functions.php');

$username = $password = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST")
{
  $username = sanitizeString($_POST['username']);
  $password = sanitizeString($_POST['password']);
  $usertype= sanitizeString($_POST['usertype']);

  $username_err = validateUsername($username);
    $password_err = validatePassword($password);
    $connection = createConnection($GLOBALS['hn'],$GLOBALS['db'], $GLOBALS['un'],$GLOBALS['pw']);
    if($usertype == 'on')   {
              adminCheck($connection,$username,$password);
          }
    else    {
            userCheck($connection,$username,$password);
      };
      $connection->close();
};
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>virus-Sweep</title>
    <link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/style.css">
<script src="js/login.js"></script>
  </head>
  <body class="bg-faded">
    <div class="container">

      <header class="mt-2 mb-5">
            <a href="login.php">Home</a>
      </header>

      <div class="row">
          <div class="col-sm-7">
            <img src="img/icon.jpg" alt="Image-icon" class="center-" style="center-align;width:300px;height:300px;">
              <h1 class="display-1">Login to the design to scan the file.</h1>
          </div>
          <div class="col-sm-5">
            <br><br>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"  onsubmit="return validate(this)">
              <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                  <label>Username:<sup class="text-danger">*</sup></label>
                  <input type="text" name="username"class="form-control" value="<?php echo $username; ?>">
                  <span class="help-block text-danger"><?php echo $username_err; ?></span>
              </div>
              <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                  <label>Password:<sup class="text-danger">*</sup></label>
                  <input type="password" name="password" class="form-control">
                  <span class="help-block text-danger"><?php echo $password_err; ?></span>
              </div>
              <label>  <input type="checkbox" name="usertype">For Admin Login </label> <br>

                <button type="submit" name="signin" class="btn btn-outline-primary">Submit</button>
              </form><br>
              <span>OR</span>
              <a href="register.php" >click here to register</a>
          <br>
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

  </body>
</html>

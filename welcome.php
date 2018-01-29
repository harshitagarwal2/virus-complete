<?php

require_once('login_detail.php');
require_once('common_functions.php');
require_once('welcome_functions.php');

  // Initialize the session
  session_start();


  // If session variable is not set it will redirect to login page
  if(isset($_SESSION['username']) || !empty($_SESSION['username']) && isset($_SESSION['name']) || !empty($_SESSION['name'])  )
  {
    $username = $_SESSION['username'];
    $password = $_SESSION['password'] ;
    $connection = createConnection($GLOBALS['hn'],$GLOBALS['db'], $GLOBALS['un'],$GLOBALS['pw']);
    validateSession($connection,$username,$password);
    $connection->close();
  }
  else{
    header("location: login.php");
    exit;
  };


$filename = "";
$file_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    if(isset($_POST['filename'])){
    $filename = sanitizeString($_POST['filename']);
    }

    $file_err = validate_file($filename);

    if($file_err == "")
    {
      checkTextFile($filename);
      readFileString($filename);
    }
}



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
    </style>
</head>
<body>
  <div class="container">
    <div class="page-header" style="text-align: center;">
        <span><a href="welcome.php">Home</a></span>
        <h1>Hi, <b><?php echo $_SESSION['name']; ?></b>. Welcome to our site.</h1>
        <span>  <p><a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a></p></span>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <h1 class="text-info">Enter the File to the Scanner</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" >
          <div class="form-group">
            <label>File:</label>
            <input type="file" class="form-control-file" name="filename"  />
            <small class="form-text text-muted" >Only Text File Allowed</small>
            <div class="text-danger"> <?php echo $file_err;?> </div>
            <br /><br />
            <button type="submit" class="btn btn-primary">Submit</button>
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

</body>
</html>

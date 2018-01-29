<?php
require_once('login_detail.php');         //This file has the lgoin details to the database.
require_once('common_functions.php');     //This file has functions which are common to all the pages.
require_once('admin_functions.php');      //This has validation function and function to Insert Malware File to database.

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

$malName= $filename = "";
$malName_err = $file_err = "";


//Execute this PHP file only when the submit button is POST method.
if($_SERVER["REQUEST_METHOD"] == "POST") {

  if(isset($_POST['malname']))
  {
    $malName = sanitizeString($_POST['malname']);
  }

  if(isset($_POST['filename'])){
  $filename = sanitizeString($_POST['filename']);
  }

  $malName_err = validate_Name($malName);     //calling validation function for name to check if it contains an empty name file.
  $file_err = validate_file($filename);       //validating the chosen file is valid or not.

  if($file_err == "" && $malName_err == "") {       //if No error is occured which is file chosen is not empty name and given malware name is not empty
    checkTextFile($filename);
    $string = readFileString($filename);
    if($malName != "" && $filename != ""){
      $connection = createConnection($GLOBALS['hn'],$GLOBALS['db'], $GLOBALS['un'],$GLOBALS['pw']);
      insertMalwareToDatabase($connection,$malName,$string);
      $connection->close();
    }
    };

};
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif;}
    </style>
    <script src="js/admin.js">
    </script>
</head>
<body>
  <div class="container">
    <div class="page-header">
        <span class="float-sm-left"><a href="admin.php">Home</a></span>
        <span class="float-sm-right"><a href="welcome.php">Click Here to Scan a File.</a></span>
        <h1>Hi, <b><?php echo $_SESSION['name']; ?></b>. Welcome to our site.</h1>
        <span>  <p><a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a></p></span>
    </div>

    <div class="row">
      <div class="col-xs-12">
        <h1>Choose Malware File to be Included in the database</h1>

        <form method="post" onsubmit="return validate(this)" action="<?php  echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">

          <div class="form-group text-justify"  >
            <label for="name">Malware Name</label>
            <input type="text" name="malname" placeholder="Enter Name to be inserted" value="<?php echo $malName;?>" class="form-control" />
            <div class="text-danger"> <?php echo $malName_err; ?></div>
          </div>

            <div class="form-group text-justify">
              <label  for="file">File Upload</label>
              <input class="form-control-file" type="file" name="filename"  />
              <small class="form-text text-muted" >Only Text File Allowed</small><br /><br />
              <div class="text-danger"> <?php echo $file_err; ?></div>
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

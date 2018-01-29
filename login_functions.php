<?php
// Function for PHP validation if the user has enter the username field.
function validateUsername($field) {
return ($field == "") ? "No Username was entered.\n" : "";
};

// Function for PHP validation of the submitted Password field if it's entered or not.
function validatePassword($field) {
return ($field == "") ? "Please Enter your Password.\n" : "";
};

//Checking the username Password of submitted form in the database if valid or not.
function adminCheck($connection, $username, $password){
$sql_username =  mysql_entities_fix_string($connection, $username);
$sql_password =  mysql_entities_fix_string($connection, $password);
    $sql = "SELECT * FROM admin_tbl WHERE username = '$sql_username'";
    $result = $connection->query($sql);
     if (!$result) die($connection->error);
       else if ($result->num_rows) {
            $row = $result->fetch_array(MYSQLI_NUM);
            $result->close();
            $salt1 = "l&hga@1"; $salt2 = "pg!@";    //For securtiy from hackers we add salts to passsword,which is then allows more complexity for submitted data to database.
            $token = hash('ripemd128', "$salt1$sql_password$salt2");      //As the Password is saved in hashed form we have to use the hash function to convert the submitted password.
            if($token == $row[3]) {
              session_start();                            //Creating a session If Login Successful.
              $_SESSION['username'] = $username;
              $_SESSION['name'] = $row[1];
              $_SESSION['password']=$token;
              header("location: admin.php");          //Redirecting to the Home Page.
          }
          else die("Invalid username/password combination");
        }
        else die("Invalid username/password combination");
  };


//Checking the Username and Password for data submitted by a User.s
  function userCheck($connection,$username,$password )
  {

    $sql_username =  mysql_entities_fix_string($connection, $username);
    $sql_password =  mysql_entities_fix_string($connection, $password);
    $sql = "SELECT * FROM user_tbl WHERE username = '$sql_username'";
    $result = $connection->query($sql);
     if (!$result) die($connection->error);
       elseif ($result->num_rows) {
            $row = $result->fetch_array(MYSQLI_NUM);
            $result->close();
            $salt1 = "l&hga@1"; $salt2 = "pg!@";
            $token = hash('ripemd128', "$salt1$sql_password$salt2");
            if($token == $row[3])  {
              echo 'yay';
              session_start();
              $_SESSION['username'] = $username;
              $_SESSION['name'] = $row[1];
              $_SESSION['password']=$token;
              header("location: welcome.php");
          }
          else die("Invalid username/password combination");
        }
        else die("Invalid username/password combination");
  }


?>

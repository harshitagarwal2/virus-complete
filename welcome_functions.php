<?php


function validateSession($connection,$username,$password){
  $sql_username =  mysql_entities_fix_string($connection, $username);
  $sql_password =  mysql_entities_fix_string($connection, $password);
  $sql = "SELECT * FROM user_tbl WHERE username = '$sql_username'";
  $result = $connection->query($sql);
   if (!$result) die($connection->error);
     elseif ($result->num_rows) {
          $row = $result->fetch_array(MYSQLI_NUM);
          $result->close();
          if($password != $row[3])  {
            die("Sorry Some Error occured-User not authorized Please login again <a href=login.php>Click Here to Login</a> ");
          }
        else "";
      }
      else die("Sorry Some Error occured-User not authorized Please login again <a href=login.php>Click Here to Login</a> ");
  }

  function validate_file($field){
      return ($field == "") ? "File must be chosen" : "";
    }

  function checkTextFile($f)	//function to check if the file is text file or not
    {
      if($f == null)
      exit("Enter a valid String to check case ");
      $pos = strpos($f , '.');
      if(substr($f, $pos+1) != "txt" ) exit("Please Enter a text file");
    }

    //Returns a String of 20 bytes read from the admin inputed file which contains malware.
      function readFileString($file){
        if(!file_exists($file)) exit("The file does not exist please choose a valid file");
        $fout = fopen($file, "r") or die("Unable to open file!");	//opening the file.
        $connection = createConnection($GLOBALS['hn'],$GLOBALS['db'], $GLOBALS['un'],$GLOBALS['pw']);
        while(!feof($fout))
        {
          $string = fread($fout,20);
          $sql = "select * from malware_tbl where details like '$string'";
          $result = $connection->query($sql);
          if($result->num_rows)
          {
            $row =  $result->fetch_array(MYSQLI_NUM);
            echo "The Following Malware is detected in your file : $row[1]. \n\r";
            $value=1;
          }
        }
        if($value != 1)
        echo "No Malware Detected Cheers :)";
    };



?>

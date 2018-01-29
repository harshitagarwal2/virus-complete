<?php
  //Validation function for a given Name to be Inserted to Databse.
    function CheckName($field){
      return ($field == "") ? "enter a valid name" : "";
    };
    // validating the entered password by the user to be greater than 6 letter and must contain atleast one a-z,A-Z or numbers 0-9.
    function validate_password($field) {
       if ($field == "") return "No Password was entered<br>";
       else if (strlen($field) < 6)
       return "Passwords must be at least 6 characters<br>";
       else if (!preg_match("/[a-z]/", $field) ||
                 !preg_match("/[A-Z]/", $field) ||
                 !preg_match("/[0-9]/", $field))
           return "Passwords require 1 each of a-z, A-Z and 0-9<br>"; return "";
         };

         //PHP validation for the given Username if the Given is not empty, greater than 5 character.
       function validate_username($field) {
                 if ($field == "") return "No Username was entered<br>";
                 else if (strlen($field) < 5) return "Usernames must be at least 5 characters<br>";
                  else if (preg_match("/[^a-zA-Z0-9_-]/", $field))
                       return "Only letters, numbers, - and _ in usernames<br>";
                       return "";
                 };
      //Checking if both the passwords are same or not from the given field.
    function validate_confirmPassword($password,$confirm_password) {
         if(empty($confirm_password)) return 'Please enter confirm password.';
         else if($password != $confirm_password) return 'Password did not match.';
         else return "";
       };
      //registering the User to the database if there are no errors.
    function registerUser($connection,$name,$username,$token) {
         if(empty($name)) { echo "Name Field is empty cannot be Inserted"; return;}
         if(empty($username)) { echo "UserName Field is empty cannot be Inserted"; return;}
         if(empty($token)) { echo "Token Field is empty cannot be Inserted"; return;}
         $sql_name =  mysql_entities_fix_string($connection,$name);
         $sql_username =  mysql_entities_fix_string($connection,$username);
         $sql_token =  mysql_entities_fix_string($connection,$token);
         $sql = "INSERT INTO user_tbl VALUES (NULL,'$sql_name','$sql_username', '$sql_token')";
         $result = $connection->query($sql);
         if (!$result) die ("Database access failed: " . $connection->error);
         else echo "data is saved";
      }
?>

<?php

//Function returning a Connection object of Database when provided the following username password,address and database.
  function createConnection($hn,$db,$un,$pw)  {
  $connection = new mysqli($hn, $un, $pw, $db);
  if ($connection->connect_error)
  {
    mysql_fatal_error('Sorry unable to connect to the Database Server,Please try again after someTime');
    die($connection->connect_error);
  }
  return $connection;
  };

  //function to sanitize the input received from the input forms for increasing securtiy.
    function sanitizeString($var) {
    $var = stripslashes($var);
    $var = strip_tags($var);
    $var = htmlentities($var);
    return $var;
    };

//Sanitizing data to be entered to the database.
  function mysql_entities_fix_string($conn, $string)
	{
		return htmlentities(mysql_fix_string($conn, $string));
	}

	function mysql_fix_string($conn, $string)
	{
		if (get_magic_quotes_gpc()) $string = stripslashes($string);
		return $conn->real_escape_string($string);
	}

//giving a user-friendly message to the user if any error while connecting to database.
  function mysql_fatal_error($msg)
  {
      $msg2 = mysql_error();
    echo <<<_END
    We are sorry, but it was not possible to complete
    the requested task. The error message we got was:

      <p>$msg: $msg2</p>

    Please click the back button on your browser
    and try again. If you are still having problems,
    please <a href="mailto:admin@server.com">email
    our administrator</a>. Thank you.
_END;
  };

?>

<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
      ini_set('display_errors' , 1); 

	echo "<link rel='stylesheet' type='text/css' href='design.css'>";
	//include("admin.php");

	include ( "account.php" ) ;
	
	( $dbh = mysql_connect ( $hostname, $username, $password ) )

		   or die ( "Unable to connect to MySQL database" );

	mysql_select_db( $project ); 
	echo "Results from xxA1.php with data from xxA1.html<br>";
	print "Successfully connected to MySQL<br><br>";
	


session_start();
$_SESSION['login_user']=mysql_real_escape_string($_GET["user"]);

$name = mysql_real_escape_string($_GET["user"]);
$pass = mysql_real_escape_string($_GET["pass"]);
$type = mysql_real_escape_string($_GET["type"]);

//$type=choice($name,$pass, $type);

if ($type=='A'){
	 $result1 = mysql_query("SELECT * FROM Admin WHERE user = '".$name."' &&  pass= '".$pass."'");
	if(mysql_num_rows($result1) > 0 )
		
	
	{ 
	
	$_SESSION["state"] = $type;
	$_SESSION["login_user"] = $name;
		echo " Good Credentials. Redrecting to Processing Page.";
		header("refresh:2;url=admin.php");
		
		
		//$_SESSION['logged'] = true;
		
	}
	else
	{
		echo" Credentials are wrong. Enter again.";
		header("refresh:2; url=login.html");
	}
	

	
	}
	$_SESSION['logged'] = true;
	
	
if ($type=='C'){
	 $result2 = mysql_query("SELECT * FROM A WHERE user = '".$name."' &&  pass=sha1('".$pass."')");
	 if(mysql_num_rows($result2) > 0 )
		
	
	{ 
	
	while ( $r = mysql_fetch_array($result2) ) 
		   //$_SESSION["fullname"]   = $r["fullname"];
	   $_SESSION["current_balance"]  = $r["current_balance"];

	  //$_SESSION['logged'] = true;

	$_SESSION['logged'] = true;
	$_SESSION["state"] = $type;
	
		echo " Good Credentials. Redrecting to Processing Page.";
		header("refresh:2;url=customer.php");
	
	 
	}
	else
	{
		echo" Credentials are wrong. Enter again.";
		header("refresh:2; url=login.html");
	}
		
	}	


?>
<html>

<a href="admin.php">go</a>

<html>
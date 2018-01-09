
<html>
<head>
<link rel="stylesheet" type="text/css" href="design.css">
      <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>		

</head>

<body>


<ul>

  <li><a href="customer.php" class="navbar-brand">Back</a></li>
 <!-- <li><a  href="#" class="navbar-brand active">Admin</a></li> -->
  <li><a href="#" class="navbar-brand active">Customer</a></li>
	
  <button style="float:right" class="button" style="vertical-align:middle" ><a href="logout.php"><span>Logout</a> </span></button>
</ul>

</body>
<html>

<?php

error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
      ini_set('display_errors' , 1); 

	echo "<link rel='stylesheet' type='text/css' href='design.css'>";
	

	include ( "account.php" ) ;
	( $dbh = mysql_connect ( $hostname, $username, $password ) )

		   or die ( "Unable to connect to MySQL database" );

	mysql_select_db( $project ); 
	echo "Results from xxA1.php with data from xxA1.html<br>";
	print "Successfully connected to MySQL<br><br>";


session_start();


$name = $_SESSION['login_user'];
$type = $_SESSION['state'];


$current_balance=$_SESSION["current_balance"] ;

$now = time();
if ((isset($_SESSION['discard_after']) && $now > $_SESSION['discard_after']) ){
    // this session has worn out its welcome; kill it and start a brand new one
    session_unset();
    session_destroy();
    session_start();
}



// either new or old, it should live at most for another hour
$_SESSION['discard_after'] = $now + 1000;


if(@$login_session=$_SESSION['login_user'] && $_SESSION['logged']!=true && $_SESSION['state'] =="C") {

echo '<script type="text/javascript">alert("You are being hacked!");</script>';
echo "Warning!!! Someone was trying to hack you. Your bank account is still secured, go back and make transaction again. ";


}

elseif(@$login_session=$_SESSION['login_user']  && $_SESSION['logged'] = true && $_SESSION['state'] =="C" ){
	
	if(isset($_GET['submit1'])) {
		
	// $_SESSION['login_user'] = $name;

	$amount = $_GET["amount"];
	$_SESSION['amount']= $amount;

	

	
	$type = $_GET['type'];
	//$_SESSION['type'] = $type;
	echo "Name: $name<br>";
	//echo "Pass: $pass<br>";
	echo "Amount: $$amount<br>";
	echo "Type: $type<br><br>"; 
	
}
?>

<?php


	function update ($name,$amount,$type){
		
	 $result20 = mysql_query("SELECT user FROM A WHERE user = '".$name."' ");
	 
	 if((mysql_num_rows($result20) > 0 ) )
{
		                                                            
	
$s="insert into T values( '$name','$type','$amount', NOW())";
//echo "<br>insert SQL is:$s" ;
($t=mysql_query($s)) or die (mysql_error());

//update


$s="update A SET current_balance = current_balance + ${_SESSION['amount']} where user ='$name'";
echo $_SESSION['amount'];
echo "SQL s for update is:<br> $s" ;

($t=mysql_query($s)) or die (mysql_error());
}
else if((mysql_num_rows($result20) <= 0 ) )
{
	echo "Wrong Credentials";
	
}
	
}

function withdraw ($name,$amount,$type){
	$result21 = mysql_query("SELECT user FROM A WHERE user = '".$name."'");
	 if((mysql_num_rows($result21) > 0 ) && ($amount > 0))
{
	
$a="insert into T values( '$name','$type','$amount', NOW())";
//echo "<br>insert SQL is:$a" ;


($b=mysql_query($a)) or die (mysql_error());


//update

$a="update A SET current_balance=current_balance - ${_SESSION['amount']} where user ='$name'";
echo "SQL a for withdraw is:<br> $a" ;
($b=mysql_query($a)) or die (mysql_error());
}
else if((mysql_num_rows($result21) <= 0 ) && ($amount > 0))
{
	echo "Wrong Credentials";}

}
if ($type=='D'){update($name, $amount, $type);}; 
	if ($type=='W'){withdraw($name, $amount, $type);};
?><?php


global $out;
$out.="<table width='500' cellpadding=5celspacing=5 border=2>";

$out .= "<th>Table A</th>";
$out .= "<table width='500' cellpadding=5celspacing=5 border=2>";
$out .="<tr> <th>User</th><th>Email</th><th>Full Name</th><th>Address</th><th>Initial Balance</th><th>Current Balance</th></tr>";
	?>
	<?php


	$query = "SELECT * from A where  user = '".$name."'"; 

$result = mysql_query($query) or die(mysql_error());
//if (mysql_num_rows($result) == 0) die("no data"); 
//$number_of_rows = mysql_num_rows($result);  
//echo "<th>Number of rows fetched are : ". $number_of_rows;  


while($row=mysql_fetch_array($result)):	?>

	<?php $out .= "<tr>"; ?>
	
	<td><?php $user = $row['user'];?></td>
	<td><?php $email = strip_tags($row['email']);?></td>
	<td><?php $fullname = $row['fullname'];?></td>
	<td><?php $address =  strip_tags($row['address']);?></td>
	<td><?php $initial_balance = $row['initial_balance'];?></td>
	<td><?php $current_balance =  $row['current_balance'];?></td>
	<?php $out .= "<td>$user</td> <td>$email</td> <td>$fullname</td> <td>$address</td> <td>$initial_balance</td><td>$current_balance</td> "; ?>
	<?php $out .= "</tr>"; ?>
	<?php endwhile;?>
	
	
	<?php $out.= "</table>"; print $out;?>
	
	<br><br>
	<?php
	
global $out2;
	
	$out2.="<table width='500' cellpadding=5celspacing=5 border=2>";

$out2 .= "<th>Table T</th>";
$out2 .= "<table width='500' cellpadding=5celspacing=5 border=2>";
$out2 .="<tr> <th>User</th><th>Type</th><th>Amount</th><th>Date</th></tr>";
	?>
	<?php
	$query1 = "SELECT * from T WHERE user = '".$name."'"; 
$result1 = mysql_query($query1) or die(mysql_error());

while($row1=mysql_fetch_array($result1)):?>

<?php $out2 .= "<tr>"; ?>
	<td><?php $user1 = $row1['user'];?></td>
	<td><?php $type = $row1['type'];?></td>
	<td><?php $amount = $row1['amount'];?></td>
	<td><?php $date = $row1['date'];?></td>
	
	<?php $out2 .= "<td>$user1</td> <td>$type</td> <td>$amount</td> <td>$date</td>"; ?>
	<?php $out2 .= "</tr>"; ?>
	<?php endwhile;?>
	<?php $out2.= "</table>"; print $out2;?>

	
	<?php
	unset($_SESSION['logged']);
	
	function get_mail_request($type, $name){
	
	
		if ($type!='C')  {
		$s6 = mysql_query("select email from A where user = '".$name."'"); 
		while ($r6=mysql_fetch_array($s6)) {
		 return $r6["email"];
		}
		}

	
}
	
	
	if(isset($_GET['emailrequest'])){
		
		$to			= get_mail_request($type, $name);
		$subject	="IT 202 Assignment 2";
		$headers 	= 'MIME-Version: 1.0' . "\r\n";
		$headers	.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

		mail($to,$subject,$out,$out2,$headers);
		echo "Email has been sent $to";
	}
	

}



else {header("LOCATION:login.html");}


?>




<html>
<head>
<link rel="stylesheet" type="text/css" href="design.css">

      <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>		
<style>
<script>
    
</script>
  
</style>
</head>
<body>


<ul>
  <li><a href="login.html" class="navbar-brand">Home</a></li>
  <li><a  href="#" class="navbar-brand active">Admin</a></li>
  <!-- <li><a href="customer.php" class="navbar-brand">Customer</a></li> -->
	
  <button style="float:right" class="button" style="vertical-align:middle" ><a href="logout.php"><span>Logout</a> </span></button>
</ul>

</body>
<html>
<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
      ini_set('display_errors' , 1); 

	echo "<link rel='stylesheet' type='text/css' href='design.css'>";
	//include("login.php");

	include ( "account.php" ) ;
	
	
	
	( $dbh = mysql_connect ( $hostname, $username, $password ) )

		   or die ( "Unable to connect to MySQL database" );

	mysql_select_db( $project ); 
	echo "Results from xxA1.php with data from xxA1.html<br>";
	print "Successfully connected to MySQL<br><br>";
	

session_start();



$name = $_SESSION['login_user'];
echo $name;

$type = $_SESSION['state'];


	
//echo $_SESSION["login_user"];


$now = time();
if (isset($_SESSION['discard_after']) && $now > $_SESSION['discard_after']) {
	
    // this session has worn out its welcome; kill it and start a brand new one
    session_unset();
    session_destroy();
    session_start();
}



// either new or old, it should live at most for another hour
$_SESSION['discard_after'] = $now + 1000;


if($login_session=$_SESSION['login_user'] && $_SESSION['logged'] = true && $_SESSION['state'] =="A") {
	echo $login_session;



?>

<?php


global $out;
$out.="<table width='500' cellpadding=5celspacing=5 border=2>";

$out .= "<th>Table A</th>";
$out .= "<table width='500' cellpadding=5celspacing=5 border=2>";
$out .="<tr> <th>User</th><th>Pass</th><th>Email</th><th>Full Name</th><th>Address</th><th>Initial Balance</th><th>Current Balance</th></tr>";
	?>
	<?php


	$query = "SELECT * from A"; 

$result = mysql_query($query) or die(mysql_error());
//if (mysql_num_rows($result) == 0) die("no data"); 
//$number_of_rows = mysql_num_rows($result);  
//echo "<th>Number of rows fetched are : ". $number_of_rows;  


while($row=mysql_fetch_array($result)):	?>

	<?php $out .= "<tr>"; ?>
	
	<td><?php $user = $row['user'];?></td>
	<td><?php $pass = $row['pass'];?></td>
	<td><?php $email = strip_tags($row['email']);?></td>
	<td><?php $fullname = $row['fullname'];?></td>
	<td><?php $address =  strip_tags($row['address']);?></td>
	<td><?php $initial_balance = $row['initial_balance'];?></td>
	<td><?php $current_balance =  $row['current_balance'];?></td>
	<?php $out .= "<td>$user</td><td>$pass</td>  <td>$email</td> <td>$fullname</td> <td>$address</td> <td>$initial_balance</td><td>$current_balance</td> "; ?>
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
	$query1 = "SELECT * from T"; 
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
	



}








else {header("LOCATION:login.html");}


?>




	







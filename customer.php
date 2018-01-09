
<html>
<head>
<link rel="stylesheet" type="text/css" href="design.css">

</head>

<body>


<ul>

  <li><a href="login.html" class="navbar-brand">Home</a></li>
 <!-- <li><a  href="admin.php" class="navbar-brand">Admin</a></li> -->
  <li><a  href="#" class="navbar-brand active">Customer</a></li>
	
  <button style="float:right" class="button" style="vertical-align:middle" ><a href="logout.php"><span>Logout</a> </span></button>
</ul>

</body>
<html>
<?php
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);
      ini_set('display_errors' , 1); 

	echo "<link rel='stylesheet' type='text/css' href='design.css'>";
	//include("transact.php");

	include ( "account.php" ) ;
	( $dbh = mysql_connect ( $hostname, $username, $password ) )

		   or die ( "Unable to connect to MySQL database" );

	mysql_select_db( $project ); 
	//echo "Results from xxA1.php with data from xxA1.html<br>";
	print "Successfully connected to MySQL<br><br>";
	

session_start();


	

$name = $_SESSION['login_user'];
//echo $name;

$type = $_SESSION['state'];


	



//echo $_SESSION['name'];


$now = time();
if ((isset($_SESSION['discard_after']) && $now > $_SESSION['discard_after']) ){
    // this session has worn out its welcome; kill it and start a brand new one
    session_unset();
    session_destroy();
    session_start();
}



// either new or old, it should live at most for another hour
$_SESSION['discard_after'] = $now + 1000;


if($login_session=$_SESSION['login_user'] && $_SESSION['logged'] = true && $_SESSION['state'] =="C" ){


?>
<!DOCTYPE html>

<head>
<title>Assignment 2</title>
	  
      <link rel="stylesheet" type="text/css" href="design.css">
      <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 
</script>
</head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.0/additional-methods.min.js"></script>
<script type="text/javascript">

$(function () {
	$('input').blur(function () {                        
                $(this).val(
                    $.trim($(this).val())
                );
            });
			$("#form").submit(function (e) {
            // If it is not checked, prevent the default behavior (your submit)
            if (!$('input[name="type"]').is(':checked')) {
                alert("No selection!")
                e.preventDefault();
            }
	
        });
		
		$("#form").submit(function (e) {
            // If it is not checked, prevent the default behavior (your submit)
            if (!$('input[value="A"]').is(':checked') && $.trim($("#amount").val()) === "") {
                alert("Enter the amount!")
                e.preventDefault();
            }			
        
		
            // If it is not checked, prevent the default behavior (your submit)
            else if (!$('input[value="A"]').is(':checked') && !$.isNumeric($("#amount").val()) ) {
                alert("Amount field not numeric!")
                e.preventDefault();
            }			
        });
		$( "#form" ).validate({
		  rules: {
			amount: {
			  //required: true,
			  
			  min:0
			 

			}
		  },
		  
		  messages: {
				amount: "Amount is Negative"
				
		  
			},
				
			//errorPlacement: function (error, element) {
					//alert(error.text());
					//}

		});
	
	});

</script>


<body>
<div class="container">

<form class="form-horizontal" action="transact.php" method="GET	" id="form"  name="form" ">
<fieldset> 
 <legend>Assignment 2</legend>
 <?php
 $result2 = mysql_query("SELECT * FROM A WHERE user = '".$name."'");
	 if(mysql_num_rows($result2) > 0 )
		
	
	{ 
	
	while ( $r = mysql_fetch_array($result2) ) 
		   
	   $_SESSION["current_balance"]  = $r["current_balance"];

	   
	}
echo "$name your Current Balance is: ${_SESSION['current_balance']}";?>
<br>
<div>



<div class="form-group">
<label class="control-label col-sm-5" for="user">Amount:</label>
<div class="col-sm-3">
<input type="text" class="form-control" name="amount" id="amount" placeholder="Enter Amount" autocomplete="off"  autofocus>
</div>
</div>


<br><br>
<div class="form-group">        
      <div class="col-sm-offset-5 col-sm-10">

<label><input type="radio" name="type" id="radio2" value="D"> Deposit</label><br>
<label> <input type="radio" name="type" id="radio3" value="W"> Withdraw </label><br>

</div>
</div>

<div class="form-group">        
      <div class="col-sm-offset-5 col-sm-10">
<label><input type="checkbox" name="emailrequest"> Email </label><br>
</div>
</div>

<div class="form-group">        
      <div class="col-sm-offset-6 col-sm-10">
<button type="submit" name = "submit1" class="btn btn-default"  >Submit</button>
</div>
    </div>

	


</form>
</div>

</body>

</fieldset>
<?php




//echo $type;



?>
</html>



<?php
//unset($_SESSION['logged']);

}

else {header("LOCATION:login.html");}


?>




	







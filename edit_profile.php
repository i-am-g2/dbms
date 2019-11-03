<!DOCTYPE html>
<html lang="en">
<head>
	<title>Personal Profile</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>

<body style = "
  background: url('Res/Image/profile-bg3.png') no-repeat center center fixed;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  background-size: cover;
  -o-background-size: cover;
">


	<div style="margin-left:1%">
		<span style="color:white">School of Engineering</span><br>
		<img src="Res/Image/logo.png" class="img-thumbnail" alt="U Logo" style="max-width: 10%;height: auto;margin-bottom:1%;margin-top:0">
			<span class="display-4 text-center" style="margin-top:1%;color:white">YJ University<span>
		</img> 
	</div>

<?php
	session_start();
	require_once __DIR__ . "/vendor/autoload.php";
	$collection = (new MongoDB\Client)->YJUniversityDB->profiles;
	$UserIdPara = $_GET['UserId'];
	$Permission=FALSE;
	if(isset($_SESSION['UserId'])){
		if($_SESSION['UserId']==$UserIdPara)
			$Permission=TRUE;		
	}
	if(array_key_exists('button1', $_POST)) { 
		button1(); 
	} 
	else if(array_key_exists('button2', $_POST)) { 
		button2(); 
	} 
	function button1() {
		$new_val=$_POST['button1']; 
		echo $new_val;
		//$updateResult = $collection->updateOne(
		//	[ 'UserId' => $UserIdPara ],
		//	[ '$set' => [ 'Name' => $new_val ]]
		//);
	} 
	function button2() { 
		echo "This is Button2 that is selected"; 
	} 
	
?>

	<form method="post">
		New Name:<br> 
		<input type = "text">
        <input type="submit" name="button1"
                class="button"/><br>  
	</form> 

</body>
</html>



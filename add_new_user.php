<!--
    Temporary File to add a new user
    Untill you make the real one @Jeetu
    Or maybe just add a way to check admin here-->

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
	$user = $collection->findOne(['UserId'=>$UserIdPara]);
    if($user==NULL){
        $insertOneResult = $collection->insertOne([
            'UserId' => $UserIdPara,
        ]);
        echo"<h1 class='display-1'>User Created</h1>";
    }
    else{
        echo"<h1 class='display-1'>User Exists</h1>";
    }
?>

	
</body>
</html>



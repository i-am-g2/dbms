<?php
	require "postgreCon.php";
	if($db==false) {
		header ("Location: error.php");
		echo "Db Pressed";
	}
	if (isset($_POST['loginSubmit'])) {
		echo "Submit Button Pressed";
		
		if(empty($_POST['userId'] ) ) {
			header("Location: index.php?error=emptyUname");
			exit();
		}
		else if (empty($_POST['password'])) {
			header("Location: index.php?error=emptypwd&username=".$_POST['userId']);
			exit();
		}
		// Find Username in dbms, User Does not exist
		// Find Username in dbms,  password do not match
		
		session_start();
		$_SESSION['login'] = true;
		$_SESSION['userId'] = $_POST['userId'];
		// redirect to Profile Page
		header("Location: main.php");
	}
?>
<?php
	require "postgreCon.php";
	if (isset($_POST['loginSubmit'])) {
		
		
		if(empty($_POST['userId'] ) ) {
			header("Location: index.php?error=emptyUname&message=Username_Empty");
			exit();
		}
		else if (empty($_POST['password'])) {
			header("Location: index.php?error=emptypwd&message=Enter_Password&username=".$_POST['userId']);
			exit();
		}

		$query = "select password from credentials where username = '".$_POST['userId']."';";
		$result = pg_query($db, $query.";");
		$count = pg_num_rows($result);
		if($count ==0) {
			header("Location: index.php?error=usernamenotexist&message=User_does_not_exist&usernaem=".$_POST['userId']);
			exit();
		}
		
		$pass = pg_fetch_row($result)[0];

		if (password_verify($_POST['password'] ,$pass )) {
			session_start();
			$_SESSION['login'] = true;
			$_SESSION['userId'] = $_POST['userId'];
			header("Location: dashboard.php"); 
		} else {
			header("Location: index.php?error=wrongpassword&message=Password_Error&username=".$_POST['userId']);
		}

		
	}
?>
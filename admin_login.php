<?php
	require "header.php";
?>
<?php
    require "postgreCon.php";
	if($db==false) {
		header ("Location: error.php");
		exit();
	}
	if(array_key_exists('loginSubmit', $_POST)  ) {
		
		
		if(empty($_POST['userId'] ) ) {
			header("Location: admin_login.php?error=emptyUname");
			exit();
		}
		else if (empty($_POST['password'])) {
			header("Location: admin_login.php?error=emptypwd&username=".$_POST['userId']);
			exit();
		}

		$query = "select Password,Power from Admins where username = '".$_POST['userId']."';";
		$result = pg_query($db, $query.";");
		$count = pg_num_rows($result);
		if($count ==0) {
			header("Location: admin_login.php?error=usernamenotexist&usernaem=".$_POST['userId']);
			exit();
		}
		
        $row = pg_fetch_row($result);
        $pass=$row[0];
        $power =$row[1]; 
		if (password_verify($_POST['password'] ,$pass )) {
			session_start();
			$_SESSION['admin_login'] = true;
            $_SESSION['userId'] = $_POST['userId'];
            $_SESSION['power'] =$power;
			header("Location: adminPanel.php"); 
		} else {
			header("Location: admin_login.php?error=wrongpassword&username=".$_POST['userId']);
		}

		
	}

?>


<link rel="stylesheet" type="text/css" href="Res/CSS/customLogin.css">
<title>Login</title>

<div class="login-page">
	
	<div class="form">
		<ul class="nav nav-pills nav-justified">
    		<li class="nav-item"><a class="nav-link " href="index.php">Faculty</a></li>
    		<li class="nav-item"><a class="nav-link active" href="admin_login.php">Admin</a></li>
    
  		</ul><br>
		<form class="login-form" method="post">
			
			<?php
				if (isset($_GET['username'])) {
					echo "<input type='text' placeholder='User Name' name='userId' value =".$_GET["username"]."/>";		
				} else {
					echo "<input type='text' placeholder='User Name' name='userId' />";
				}
			?>
			
			<input type="password" placeholder="Password" name="password"  />
			<button name="loginSubmit">Login</button>
			<p class="message">Need Help? <a href="#">Contact Us</a></p>
			<?php 
				if (isset($_GET["error"])) {
					echo "<div class ='errorMsg'>";
					/* Use if else Condition */
					echo "</div>";
				}
			?>
		</form>
	</div>
</div>


<div  class="bottumbar">
	<span class="paraLeft">
		Faculty Portal @ IIT Ropar
	</span>
	 
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<?php require "footer.php" ?>
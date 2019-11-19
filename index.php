<?php
	require "header.php";
	
?>

<?php
function process_string($var) {
	$maxim = strlen($var);
	for ($i = 0; $i<$maxim;$i++) {
		if($var[$i] == '_'){
			$var[$i] = ' ';
		}
	}
	return $var;
}
?>

<link rel="stylesheet" type="text/css" href="Res/CSS/customLogin.css">
<title>Login</title>

<div class="login-page">
	
	<div class="form">
		<ul class="nav nav-pills nav-justified">
    		<li class="nav-item"><a class="nav-link active" href="index.php">Faculty</a></li>
    		<li class="nav-item"><a class="nav-link" href="admin_login.php">Admin</a></li>
    
  		</ul><br>
		<form class="login-form" action="login.inc.php" method="post">
			
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
			<!-- <h2 class="message"> <a href="browse_guest.php"> Browse as Guest</a></h2> -->
			<?php 
				
				if (isset($_GET["error"])) {
					echo "<div class ='errorMsg'>";
					echo "<i class='fas fa-exclamation-circle'></i> ".process_string(($_GET['message']));
					echo "</div>";
				} else if(isset($_GET["success"])) {
					echo "<div class ='successMsg'>";
					echo "<i class='fas fa-check-circle'></i> ".process_string(($_GET['message']));
					echo "</div>";
				}
				?>
				<hr>
				<a class="btn btn-primary" href="browse_guest.php" role="button">Browse As Guest</a>
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
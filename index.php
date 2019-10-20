<?php
	require "header.php";
?>
<link rel="stylesheet" type="text/css" href="Res/CSS/customLogin.css">
<title>Login</title>


<div class="login-page">
	<div class="form">
		<form class="login-form" action="login.inc.php" method="post">
			<?php
				if (isset($_GET['username'])) {
					echo "<input type='text' placeholder='User Name' name='userId' value =".$_GET["username"]."/>";		
				} else {
					echo "<input type='text' placeholder='User Name' name='userId' />";
				}
			?>
			
			<input type="password" placeholder="Password" name="password"  />
			<button name="loginSubmit">Submit</button>
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
<?php require "footer.php" ?>
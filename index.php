<?php 
	require "header.php";
?>
	<div>
		<?php require "postgreCon.php";?>
	</div>

	<form action="login.inc.php"  method="post">
	<input type="text" name="userid" >
	<br>
	<input type="password" name="pwd" >
	<br>
	<button name=>Submit</button>
	</form>

<?php require "footer.php" ?>
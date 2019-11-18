<?php 
	/* App */
	session_start();
	require("postgreCon.php");
	$query = "select * from applications where username='".$_SESSION['userId']."' and status='pend';";
	$res= pg_query($db,$query);
	if(pg_num_rows($res)>0) {
		echo true;
	}  else {
		echo false;
	}
?>
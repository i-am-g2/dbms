<?php
	session_start();
	require ("postgreCon.php");
	if (isset($_POST['rev_submit'])) {
		$sql = "update into applications set curr_holder= '' where id = ;";
		$res = pg_query($db,$sql);
		header("Location: action.php");
		
	}


?>
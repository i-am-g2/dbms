<?php
	session_start();
	require ("postgreCon.php");
	if (isset($_POST['rev_submit'])) {
		$query = "select * from applications where id = '".$_SESSION['app_id']."';";
		
		$res = pg_query($db,$query);
		$application_data = pg_fetch_row($res); 

		$sql = "update into applications set curr_holder=' ".$application_data['1']."' where id ='". $application_data['0']."';";
		$res = pg_query($db,$sql);
		header("Location: action.php");
	}


?>
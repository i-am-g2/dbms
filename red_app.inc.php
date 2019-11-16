<?php
	session_start();
	require("postgreCon.php");
	require ("application_routes.php");
	if (isset($_POST['rev_submit'])) {
		$query = "select * from applications where id = '" . $_SESSION['app_id'] . "';";
		$res = pg_query($db, $query);
		$application_data = pg_fetch_row($res);

		$sql = "update applications set curr_holder='" . $application_data['1'] . "' where id ='" . $application_data['0'] . "';";
		$res = pg_query($db, $sql);
		if ($res) {
			header("Location: action.php");
		}
	} else if (isset($_POST['resubmit'])) {
		/* TODO Approve Check */
		$query = "select * from applications where id = '" . $_SESSION['app_id'] . "';";
		$res = pg_query($db, $query);
		$application_data = pg_fetch_row($res);
		$next_holder = getRouteFromUsername( $db,$application_data['1']); 
		$sql = "update applications set curr_holder='" . $next_holder . "' where id ='" . $application_data['0'] ."';";
		$res = pg_query($db, $sql);
		header("Location: action.php");

		

	} else if (isset($_POST['reject_submit'])) {
		$query = "select * from applications where id = '" . $_SESSION['app_id'] . "';";
		
		/* Get Application */
		$res = pg_query($db, $query);
		$application_data = pg_fetch_row($res);
		
		$set_curr_holder = "update applications set curr_holder= NULL where id ='" . $application_data['0'] ."';";
		$set_curr_status = "update applications set status='rjct' where id ='" . $application_data['0'] ."';";
		/* Run Queries */
		$res = pg_query($db, $set_curr_holder);
		$res = pg_query($db, $set_curr_status);
		
		/* Redirect  */
		header("Location: action.php");

	} 
?>
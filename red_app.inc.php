<?php
	session_start();
	require("postgreCon.php");
	require ("application_routes.php");

	$query = "select * from applications where id = '" . $_SESSION['app_id'] . "';";
	$res = pg_query($db, $query);
	$application_data = pg_fetch_row($res);



	if (isset($_POST['rev_submit'])) {

		$sql = "update applications set curr_holder='" . $application_data['1'] . "' where id ='" . $application_data['0'] . "';";
		$res = pg_query($db, $sql);
		if ($res) {
			$values = array(
				"log_" => $_SESSION['userId']." reverted back app_id ".$_SESSION['app_id'] 
			);
			$res = pg_insert($db, 'logs', $values);
			header("Location: action.php");
		}
	} else if (isset($_POST['resubmit'])) {
		

		$next_holder = getRouteFromUsername( $db,$application_data['1']); 
		$sql = "update applications set curr_holder='" . $next_holder . "' where id ='" . $application_data['0'] ."';";
		$res = pg_query($db, $sql);
		$values = array(
			"log_" => $_SESSION['userId']." resubmitted app_id ".$_SESSION['app_id'] 
		);
		$res = pg_insert($db, 'logs', $values);
		
		header("Location: action.php");

		

	} else if (isset($_POST['reject_submit'])) {

		
		$set_curr_holder = "update applications set curr_holder= NULL where id ='" . $application_data['0'] ."';";
		$set_curr_status = "update applications set status='rjct' where id ='" . $application_data['0'] ."';";
		/* Run Queries */
		$res = pg_query($db, $set_curr_holder);
		$res = pg_query($db, $set_curr_status);
		
		/* Redirect  */
		$values = array(
			"log_" => $_SESSION['userId']." rejected app_id ".$_SESSION['app_id'] 
		);
		$res = pg_insert($db, 'logs', $values);
		header("Location: action.php");

	} else if (isset($_POST['approve_submit'])) {
		$next_holder = getRouteFromUsername( $db,$_SESSION['userId']);
		$sql = "update applications set curr_holder='" . $next_holder . "' where id ='" . $application_data['0'] ."';";
		$res = pg_query($db,$sql);

		if(strcmp($next_holder, 'Approved' ) == 0) {
			$user = $application_data['1'];
			$set_curr_status = "update applications set status='appr' where id ='" . $application_data['0'] ."';";
			$res = pg_query($db,$set_curr_status);
			// $query = "udate days_remaining set";
			
			/* Days Subtract*/
			$st_date = date_create($application_data['2']) ;
			$en_date = date_create($application_data['3']) ;
			$leave_days = ($en_date->diff($st_date))->format("%a"); 
			$new_curr_val = max($_SESSION['daysleft'] - $leave_days, 0);

			$update_leave = "update remaining_leaves set daysleft =".$new_curr_val." where username='". $application_data['1'] ."' and yearid = '0'; ";
			$res = pg_query($db,$update_leave);

			$update_leave = "update remaining_leaves set daysleft = daysleft-'".$application_data['7']."' where username='". $application_data['1'] ."' and yearid = '1'; ";
			$res = pg_query($db,$update_leave);
			
			$values = array(
				"log_" => "approved app_id ".$_SESSION['app_id'] 
			);
			$res = pg_insert($db, 'logs', $values);

		}
		header ("Location: action.php") ;
		
	} 

?>
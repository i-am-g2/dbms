
<!-- 
	Charlength 4
	Status : pend, appr , rjct
 -->

<?php

	session_start();
	require "postgreCon.php";
	require "application_routes.php";
	if (isset($_POST['leave_submit'])) {
		if(empty($_POST['start_date']) || empty($_POST['end_date']) || empty($_POST['description']) ) {
			header("Location: create_leave.php?error=emptyfields");
		} else {

			$days_left = $_SESSION['daysleft'];

			$end_date_obj  = date_create($_POST['end_date']);
			$start_date_obj  = date_create($_POST['start_date']);
			$difference = $end_date_obj->diff ($start_date_obj);
			$leave_days =  $difference->format("%a");
			$borrow = max($leave_days - $days_left ,0 );
			$next_user = getroutefromusername($db, $_SESSION['userId']);

			$values = array(
				"username" => $_SESSION['userId'],
				"start_date"  => $_POST['start_date'],
				"end_date"  => $_POST['end_date'],
				"description" => $_POST['description'],
				"status" => 'pend', 
				"curr_holder" => $next_user,
				"days_borrowed" => $borrow,
			);

			
			//TODO
			/* Check if already leave for above dates exist or not , */
			/* Check if even after borrowing it is fulfillable or not */
			
			
			$res = pg_insert($db,'applications',$values);
			if($res) {
				/* Redirect to Dashboard with msg */
				header("Location: dashboard.php?msg=Application_Submit_Successful");
				// echo "Success";
			} else {
				echo "fail";
				/* Redirect to Dashboard with msg */
			}

		}
	} else {
		header("Location: dashboard.php"); 
	}
?>
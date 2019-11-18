<!-- 
	Charlength 4
	Status : pend, appr , rjct
 -->

<?php

session_start();
require "postgreCon.php";
require "application_routes.php";
if (isset($_POST['leave_submit'])) {
	if (empty($_POST['start_date']) || empty($_POST['end_date']) || empty($_POST['description'])) {
		header("Location: create_leave.php?error=emptyfields");
	} else {

		$days_left = $_SESSION['daysleft'];

		$end_date_obj  = date_create($_POST['end_date']);
		$start_date_obj  = date_create($_POST['start_date']);
		$difference = $end_date_obj->diff($start_date_obj);
		$leave_days =  $difference->format("%a");
		$borrow = max($leave_days - $days_left, 0);
		$next_user = getroutefromusername($db, $_SESSION['userId']);
		//echo $next_user;
		//exit();
		$values = array(
			"username" => $_SESSION['userId'],
			"start_date"  => $_POST['start_date'],
			"end_date"  => $_POST['end_date'],
			"description" => $_POST['description'],
			"status" => 'pend',
			"curr_holder" => $next_user,
			"days_borrowed" => $borrow,
		);

		if ($next_user == "Approved") {
			$user = $_SESSION['userId'];

//			$set_curr_status = "update applications set status='appr' where id ='" . $application_data['0'] ."';";
//$res = pg_query($db,$set_curr_status);
			// $query = "udate days_remaining set";
			$values['status']="appr";
			/* Days Subtract*/
			
			$st_date = new DateTime($_POST['start_date']) ;
			$en_date = new DateTime($_POST['end_date']) ;
			$leave_days = ($en_date->diff($st_date))->format("%a"); 
			$new_curr_val = max($_SESSION['daysleft'] - $leave_days, 0);

			$update_leave = "update remaining_leaves set daysleft =".$new_curr_val." where username='". $user ."' and yearid = '0'; ";
			$res = pg_query($db,$update_leave);

			$update_leave = "update remaining_leaves set daysleft = daysleft-'".$borrow."' where username='". $user ."' and yearid = '1'; ";
			$res = pg_query($db,$update_leave);
			$res = pg_insert($db, 'applications', $values);
			header("Location: dashboard.php");
		 } else if ($next_user == "Disabled") {
			
			header("Location: dashboard.php?alert=Leaves_currently_disabled,_contact_admin");
		  } else {

			$res = pg_insert($db, 'applications', $values);
			//var_dump($res);
			//echo "ll".$res[0];
			//exit();
			if ($res) {
				/* Redirect to Dashboard with msg */
				header("Location: dashboard.php?msg=Application_Submit_Successful");

				// echo "Success";
			} else {
				echo "fail";
				/* Redirect to Dashboard with msg */
			}
		}


		//TODO
		/* Check if already leave for above dates exist or not , */
		/* Check if even after borrowing it is fulfillable or not */
	}
} else {
	header("Location: dashboard.php");
}
?>
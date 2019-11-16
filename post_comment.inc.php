<!-- 
	Charlength 4
	Status : pend, appr , rjct
 -->

<?php

session_start();
require "postgreCon.php";
// require "application_routes.php";
if (isset($_POST['comment_submit'])) {
	if (empty($_POST['comment'])) {
		header("Location: action_app_details.php");
	} else {


		$values = array(
			"app_id" => $_SESSION['app_id'],
			"username" => $_SESSION['userId'],
			"text_" => $_POST['comment']
		);

		//TODO
		/* Check if already application for above dates exist or not , */
		/* Check if even after borrowing it is fulfillable or not */

		$res = pg_insert($db, 'comments', $values);
		if ($res) {
			header("Location: action_app_details.php");
			/* Redirect to Dashboard with msg */
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
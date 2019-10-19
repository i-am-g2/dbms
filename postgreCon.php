<?php
	$db = pg_connect("dbname = facultysys user=facultyAdmin password=");
	if($db) {
		echo "Connection Successful";
	} else {
		echo "some Error Occored";
	}
?>



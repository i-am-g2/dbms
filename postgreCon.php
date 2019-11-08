<?php
	$db = pg_connect("dbname = facultysys user=facultyAdmin password=a");
	echo($db);
	if(!$db) {
		header ("Location: error.php");	
	} 
?>



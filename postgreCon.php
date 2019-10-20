<?php
	$db = pg_connect("dbname = facultysys user=facultyAdmin password=");
	if(!$db) {
		header ("Location : unkownError.php");	
	} 
?>



<?php
	//  $db = pg_connect("dbname = facultysys user=myprojectuser password=".getenv('myprojectuser_pass'));
	$db =  pg_connect("dbname = facultysys user=myprojectuser password=NxG56jsFXcfg");
	if(!$db) {
		header ("Location: error.php");
	} 
	//myprojectuser_pass=NxG56jsFXcfg
?>

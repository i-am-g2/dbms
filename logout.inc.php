<?php
session_start();
	$values = array(
		"log_" => $_SESSION['userId']." logged out" 
	);
	$res = pg_insert($db, 'logs', $values);
session_unset();
session_destroy();
header("Location: index.php?success=true&message=Logout_Successful");
?>

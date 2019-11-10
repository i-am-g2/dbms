<?php 
require "postgreCon.php";
// echo password_hash ( "img2" , PASSWORD_DEFAULT ); 
$sql =
		"select password from credentials where username = 'jeetu'";
		$result = pg_query($db, $sql.";");
		while ($row = pg_fetch_row($result)) {
			echo "Author:". $row[0];
		}
?>
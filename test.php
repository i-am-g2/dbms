<?php 
require "postgreCon.php";
// echo password_hash ( "img2" , PASSWORD_DEFAULT ); 






// require ("postgreCon.php");
$sql = "select * from applications;";
$result = pg_query($db,$sql);
$returnArr = array();
while($row =  pg_fetch_row($result)){
	array_push($returnArr, $row);
}
// echo json_encode($returnArr);

?>
<?php 
session_start();
$_SESSION['app_id'] = $_POST['redirect'];
echo $_POST['redirect'];
header("Location: action_app_details.php");
?>

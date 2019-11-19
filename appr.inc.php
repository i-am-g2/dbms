<?php 
session_start();
$_SESSION['app_id_approved'] = $_POST['redirect'];
echo $_POST['redirect'];
header("Location: approved_app_details.php");
?>

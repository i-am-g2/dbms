<?php
    require "postgreCon.php";
    session_start();
if (!isset($_SESSION['admin_login'])) {
	header("Location: index.php?error=loginrequired");
} else if ($_SESSION['admin_login'] == false) {
	header("Location: index.php?error=loginrequired");
}
session_start();
if (!isset($_SESSION['power'])) {
	header("Location: admin_login.php?error=loginrequired");
} else if ($_SESSION['power'] == 1) {
	header("Location: adminPanel.php?error=MainAdminOnly");
}
    try{
    $username = $_GET['username'];
    $return_arr = array();
    //$query = "select position FROM Faculty_Pos where username ='".$username."';";
    //$result = pg_query($db,$query);
    $query = "DELETE FROM Admins where username ='".$username."';";
    $result = pg_query($db,$query);

// Encoding array in JSON format
    echo "User deleted";
    }
    catch(\Exception $e){
        echo "Deletion Failed! ".$e->getmessage();
    }

?>
<?php
    require "postgreCon.php";
    session_start();
if (!isset($_SESSION['admin_login'])) {
	header("Location: index.php?error=loginrequired");
} else if ($_SESSION['admin_login'] == false) {
	header("Location: index.php?error=loginrequired");
}
    try{
    $username = $_GET['username'];
    $return_arr = array();
    $query = "DELETE FROM Faculty_Pos where username ='".$username."';";
    $result = pg_query($db,$query);
    $query = "DELETE FROM credentials where username ='".$username."';";
    $result = pg_query($db,$query);
    

// Encoding array in JSON format
    echo json_encode($return_arr);
    }
    catch(\Exception $e){
        echo $e->getmessage();
    }

?>
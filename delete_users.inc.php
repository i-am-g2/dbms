<?php
    require("mongo_functions.php");
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
    //$query = "select position FROM Faculty_Pos where username ='".$username."';";
    //$result = pg_query($db,$query);
    $query = "DELETE FROM Faculty_Pos where username ='".$username."';";
    $result = pg_query($db,$query);
    $query = "DELETE FROM credentials where username ='".$username."';";
    $result = pg_query($db,$query);
    

// Encoding array in JSON format
        
    $query="INSERT INTO admin_logs(admin_username,log_) VALUES('".$_SESSION['userId']."','deleted user".$username."');";
    pg_query($db, $query . ";");
    deleteUser($_SESSION['userId']);
    echo "User deleted";
    
    }
    catch(\Exception $e){
        echo "Deletion Failed! ".$e->getmessage();
    }

?>
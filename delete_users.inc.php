<?php
    require "postgreCon.php";
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
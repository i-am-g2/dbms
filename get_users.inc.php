<?php
    require "postgreCon.php";
    try{
    $dept = $_GET['dept'];
    $return_arr = array();
    $query = "SELECT username FROM Faculty_Pos where dept ='".$dept."';";
    $result = pg_query($db,$query);

    while($row =  pg_fetch_row($result)){
        $return_arr[] = $row[0];
    }

// Encoding array in JSON format
    echo json_encode($return_arr);
    }
    catch(\Exception $e){
        echo $e->getmessage();
    }

?>
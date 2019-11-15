<?php
    function getUserName($db,$to_){
        if($to_=="Approved"){
            $to_username="Approved";
        }
        else if($to_=="Director" || $to_=="DFA" || $to_=="ADFA"){
            $query = "select username from Faculty_pos where position = '".$to_."';";
            $result = pg_query($db, $query.";");
            $to_username = pg_fetch_row($result)[0];
        }
        else if($to_=="Approved"){
            $to_username="Approved";
        }
        else {
            $query = "select username from Faculty_pos where position = '".$to_."';";
            $result = pg_query($db, $query.";");
            $to_username = pg_fetch_row($result)[0];
        }

        if(!$to_username){
            $query = "select to_ from routes where from_ = '".$to_."';";
            $result = pg_query($db, $query.";");
            $to_ = pg_fetch_row($result)[0];
            return getUserName($db,$to_);
        }
        else{
            return $to_username;
        }
    }
    function getRouteFromUsername($db,$from_username){
        $query = "select * from Faculty_pos where username = '".$from_username."';";
		$result = pg_query($db, $query.";");
		$count = pg_num_rows($result);
        //TODO handle count=0;
        $user = pg_fetch_row($result);
        if($user[2]=="Faculty"){
            $from_=$user[1]."_FAC";
        }
        else{
            $from_=$user[2];
        }
        //echo"from".$from_."\n";
        $query = "select to_ from routes where from_ = '".$from_."';";
        $result = pg_query($db, $query.";");
        
        $to_ = pg_fetch_row($result)[0];
        //echo"to".$to_."\n";
        
        return getUserName($db,$to_);
    }

    function setDefaultRoutes($db){
        //echo"setting efaults";
        $query = "DELETE FROM routes;";
        $result = pg_query($db, $query.";");
        $query = "INSERT INTO routes VALUES('CSE_FAC','CSE_HOD');";
        $result = pg_query($db, $query.";");
        $query = "INSERT INTO routes VALUES('EE_FAC','EE_HOD');";
        $result = pg_query($db, $query.";");
        $query = "INSERT INTO routes VALUES('ME_FAC','ME_HOD');";
        $result = pg_query($db, $query.";");
        $query = "INSERT INTO routes VALUES('CSE_HOD','DFA');";
        $result = pg_query($db, $query.";");
        $query = "INSERT INTO routes VALUES('EE_HOD','DFA');";
        $result = pg_query($db, $query.";");
        $query = "INSERT INTO routes VALUES('ME_HOD','DFA');";
        $result = pg_query($db, $query.";");
        $query = "INSERT INTO routes VALUES('ADFA','DFA');";
        $result = pg_query($db, $query.";");
        $query = "INSERT INTO routes VALUES('DFA','Director');";
        $result = pg_query($db, $query.";");
        $query = "INSERT INTO routes VALUES('Director','Approved');";
        $result = pg_query($db, $query.";");
    }

    function setAllRoutesApproved($db){
        $query = "DELETE FROM routes;";
        $result = pg_query($db, $query.";");
        $query = "INSERT INTO routes VALUES('CSE_FAC','Approved');";
        $result = pg_query($db, $query.";");
        $query = "INSERT INTO routes VALUES('EE_FAC','Approved');";
        $result = pg_query($db, $query.";");
        $query = "INSERT INTO routes VALUES('ME_FAC','Approved');";
        $result = pg_query($db, $query.";");
        $query = "INSERT INTO routes VALUES('CSE_HOD','Approved');";
        $result = pg_query($db, $query.";");
        $query = "INSERT INTO routes VALUES('EE_HOD','Approved');";
        $result = pg_query($db, $query.";");
        $query = "INSERT INTO routes VALUES('ME_HOD','Approved');";
        $result = pg_query($db, $query.";");
        $query = "INSERT INTO routes VALUES('ADFA','Approved');";
        $result = pg_query($db, $query.";");
        $query = "INSERT INTO routes VALUES('DFA','Approved');";
        $result = pg_query($db, $query.";");
        $query = "INSERT INTO routes VALUES('Director','Approved');";
        $result = pg_query($db, $query.";");
    }

    function setRoute($db,$from_,$to_){
        $query=" UPDATE routes set to_='".$to_."' where from_='".$from_. "';";
        $result = pg_query($db, $query.";");
    }

    function getRoute($db,$from_){
        $query = "select to_ from routes where from_ = '".$from_."';";
        $result = pg_query($db, $query.";");
        return pg_fetch_row($result)[0];
    }
?>
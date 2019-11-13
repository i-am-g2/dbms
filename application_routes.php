<?php
    function getUserName($db,$to_){
        if($to_=="Approved"){
            $to_username="Approved";
        }
        else if($to_=="Director" || $to_=="DFA" || $to_=="ADFA"){
            $query = "select username from Faculty_pos where position = '".$to_."';";
            $result = pg_query($db, $query.";");
            $to_username = pg_fetch_row($result)[0];
            if(!$to_username){
                header("Location: error.php");
                //TODO error no director
            }
        }
        else if($to_=="CSE_HOD"){

            $query = "select username from Faculty_pos where position = 'HOD' and dept='CSE';";
            $result = pg_query($db, $query.";");
            $to_username = pg_fetch_row($result)[0];
        }
        else if($to_=="ME_HOD"){

            $query = "select username from Faculty_pos where position = 'HOD' and dept='ME';";
            $result = pg_query($db, $query.";");
            $to_username = pg_fetch_row($result)[0];
        }
        else if($to_=="EE_HOD"){

            $query = "select username from Faculty_pos where position = 'HOD' and dept='EE';";
            $result = pg_query($db, $query.";");
            $to_username = pg_fetch_row($result)[0];
        }
        else{
            $to_username="Approved";
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
        if($user[2]=="Director"){
            $from_="Director";
        }
        else if($user[2]=="DFA" || $user[2]=="ADFA"){
            $from_=$user[2];
        }
        else if($user[2]=="HOD"){
            $from_=$user[1].'_'.$user[2];
        }
        else{
            $from_=$user[1]."_FAC";
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
        $query = "DROP TABLE routes;";
        $result = pg_query($db, $query.";");
        $query="CREATE TABLE routes(
            from_ 	VARCHAR(25) NOT NULL PRIMARY KEY,
            to_ 		VARCHAR(25) NOT NULL
        );";
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
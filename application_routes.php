<?php
    function getRouteFromUser($db,$from_username){
        $query = "select * from Faculty_pos where username = '".$_from_username."';";
		$result = pg_query($db, $query.";");
		$count = pg_num_rows($result);
        //TODO handle count=0;
        $user = pg_fetch_row($result);
        if($user['position']=="Director"){
            $from_="Director";
        }
        else if($user['position']=="DFA" || $user['position']=="ADFA"){
            $from_=$user['position'];
        }
        else if($user['position']=="HOD"){
            $from_=$user['dept'].'_'.$user['position'];
        }
        else{
            $from_=$user['dept']."_FAC";
        }

        $query = "select to_ from routes where from_ = '".$from_."';";
        $result = pg_query($db, $query.";");
        
        $to_ = pg_fetch_row($result)[0];

        if($to_=="Approved"){
            $to_username="Approved";
        }
        else if($to_=="Director" || $to_=="DFA" || $to_=="ADFA"){
            $query = "select username from Faculty_pos where position = '".$to_."';";
            $result = pg_query($db, $query.";");
            $to_username = pg_fetch_row($result)[0];
        }
        else if($user['position']=="CSE_HOD"){

            $query = "select username from Faculty_pos where position = 'HOD' and dept='CSE';";
            $result = pg_query($db, $query.";");
            $to_username = pg_fetch_row($result)[0];
        }
        else if($user['position']=="ME_HOD"){

            $query = "select username from Faculty_pos where position = 'HOD' and dept='ME';";
            $result = pg_query($db, $query.";");
            $to_username = pg_fetch_row($result)[0];
        }
        else if($user['position']=="EE_HOD"){

            $query = "select username from Faculty_pos where position = 'HOD' and dept='EE';";
            $result = pg_query($db, $query.";");
            $to_username = pg_fetch_row($result)[0];
        }
        else{
            $to_username="Approved";
        }
        return $to_username;
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
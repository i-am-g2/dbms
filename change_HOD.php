<?php
require("dash_head_admin.php");
require "postgreCon.php";
if ($db == false) {
  header("Location: error.php");
  exit();
}

function rowBuilder1($db,$field){

  echo"<div class='row'><div class='col-sm-3'>".$field.":</div><div class='col-sm-3'>";
      
                $query = "select username from faculty_pos where position='".$field."'";
                $result = pg_query($db, $query . ";");
                echo pg_fetch_row($result)[0];
              
           echo"   </div>
              <div class='col-sm-6'></div>
            </div>";
}

function rowBuilder2($db,$field){

  echo"<div class='row'>
              <div class='col-sm-4'><label for='".$field."'>Select ".$field." :</label></div>
              <div class='col-sm-4'><select class='form-control' id='".$field."' name='".$field."_VAL'>";
              if($field=="CSE_HOD"){
                  $query = "select username from faculty_pos where dept='CSE'";
              }
              else if($field=="EE_HOD"){
                $query = "select username from faculty_pos where dept='EE'";
              }
              else if($field=="ME_HOD"){
                $query = "select username from faculty_pos where dept='ME'";
              }
              else{
                $query = "select username from faculty_pos";
              }
                  $result = pg_query($db, $query . ";");
                  $count = pg_num_rows($result);
                  while ($count != 0) {
                    $count = $count - 1;
                    $username = pg_fetch_row($result)[0];
                    echo "<option value='" . $username . "'>" . $username . "</option>";
                  }
                  
              echo"  </select></div>
              <div class='col-sm-4'><button name='".$field."_Btn' class='btn btn-primary'>Update</button></div>
            </div><hr>";
}

if (array_key_exists('CSE_HOD_Btn', $_POST)) {

  $query = "UPDATE faculty_pos set position='Faculty' where  position='CSE_HOD'";
  $result = pg_query($db, $query . ";");

  $query = "UPDATE faculty_pos set position='CSE_HOD' where username='".$_POST['CSE_HOD_VAL']."'";
  $result = pg_query($db, $query . ";");
}
if (array_key_exists('EE_HOD_Btn', $_POST)) {

  $query = "UPDATE faculty_pos set position='Faculty' where  position='EE_HOD'";
  $result = pg_query($db, $query . ";");

  $query = "UPDATE faculty_pos set position='EE_HOD' where username='".$_POST['EE_HOD_VAL']."'";
  $result = pg_query($db, $query . ";");
}
if (array_key_exists('ME_HOD_Btn', $_POST)) {

  $query = "UPDATE faculty_pos set position='Faculty' where position='ME_HOD'";
  $result = pg_query($db, $query . ";");

  $query = "UPDATE faculty_pos set position='ME_HOD' where username='".$_POST['ME_HOD_VAL']."'";
  $result = pg_query($db, $query . ";");
}

if (array_key_exists('DFA_Btn', $_POST)) {

  $query = "UPDATE faculty_pos set position='Faculty' where position='DFA'";
  $result = pg_query($db, $query . ";");

  $query = "UPDATE faculty_pos set position='DFA' where username='".$_POST['DFA_VAL']."'";
  $result = pg_query($db, $query . ";");
}
if (array_key_exists('ADFA_Btn', $_POST)) {

  $query = "UPDATE faculty_pos set position='Faculty' where position='ADFA'";
  $result = pg_query($db, $query . ";");

  $query = "UPDATE faculty_pos set position='ADFA' where username='".$_POST['ADFA_VAL']."'";
  $result = pg_query($db, $query . ";");
}
if (array_key_exists('Director_Btn', $_POST)) {

  $query = "UPDATE faculty_pos set position='Faculty' where position='Director'";
  $result = pg_query($db, $query . ";");

  $query = "UPDATE faculty_pos set position='Director' where username='".$_POST['Director_VAL']."'";
  $result = pg_query($db, $query . ";");
}
?>
<div id="content-wrapper">
  <div class="container-fluid">



    <h3>Current HODs:</h3>
    <div class="container">
      <div class="form">
        <form class="login-form" method="post">
          <br>
          <div class="form-group"><?php
            rowBuilder1($db,"CSE_HOD");
            rowBuilder1($db,"ME_HOD");
            rowBuilder1($db,"EE_HOD");
            rowBuilder1($db,"DFA");
            rowBuilder1($db,"ADFA");
            rowBuilder1($db,"Director");
            ?>
            
            
            <hr>
            <h3>Update HODs:</h3><br>
            <?php
              rowBuilder2($db,"CSE_HOD");
              rowBuilder2($db,"ME_HOD");
              rowBuilder2($db,"EE_HOD");
              rowBuilder2($db,"DFA");
              rowBuilder2($db,"ADFA");
              rowBuilder2($db,"Director");
            ?>
            

            <hr>
          </div>
      </div>
      </form>
    </div>
  </div>
</div>

<script>
  $(".sidebar li:eq(3)").addClass(" active ");
</script>

<?php
require("dash_foot.php");
?>
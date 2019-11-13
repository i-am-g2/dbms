<?php
require("dash_head_admin.php");
require "postgreCon.php";
if ($db == false) {
  header("Location: error.php");
  exit();
}

if (array_key_exists('CSE_HOD_Btn', $_POST)) {

  $query = "UPDATE faculty_pos set position='Faculty' where dept='CSE' and position='HOD'";
  $result = pg_query($db, $query . ";");

  $query = "UPDATE faculty_pos set position='HOD' where username='".$_POST['CSE_HOD_VAL']."'";
  $result = pg_query($db, $query . ";");
}
if (array_key_exists('EE_HOD_Btn', $_POST)) {

  $query = "UPDATE faculty_pos set position='Faculty' where dept='EE' and position='HOD'";
  $result = pg_query($db, $query . ";");

  $query = "UPDATE faculty_pos set position='HOD' where username='".$_POST['EE_HOD_VAL']."'";
  $result = pg_query($db, $query . ";");
}
if (array_key_exists('ME_HOD_Btn', $_POST)) {

  $query = "UPDATE faculty_pos set position='Faculty' where dept='ME' and position='HOD'";
  $result = pg_query($db, $query . ";");

  $query = "UPDATE faculty_pos set position='HOD' where username='".$_POST['ME_HOD_VAL']."'";
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
          <div class="form-group">
            <div class="row">
              <div class="col-sm-3">CSE:</div>
              <div class="col-sm-3">
                <?php
                $query = "select username from faculty_pos where dept='CSE' and position='HOD'";
                $result = pg_query($db, $query . ";");
                echo pg_fetch_row($result)[0];
                ?>
              </div>
              <div class="col-sm-6"></div>
            </div>
            <div class="row">
              <div class="col-sm-3">EE:</div>
              <div class="col-sm-3">
                <?php
                $query = "select username from faculty_pos where dept='EE' and position='HOD'";
                $result = pg_query($db, $query . ";");
                echo pg_fetch_row($result)[0];
                ?>
              </div>
              <div class="col-sm-6"></div>
            </div>
            <div class="row">
              <div class="col-sm-3">ME:</div>
              <div class="col-sm-3">
                <?php
                $query = "select username from faculty_pos where dept='ME' and position='HOD'";
                $result = pg_query($db, $query . ";");
                echo pg_fetch_row($result)[0];
                ?>
              </div>
              <div class="col-sm-6"></div>
            </div>
            <hr>
            <h3>Update HODs:</h3><br>
            <div class="row">
              <div class="col-sm-4"><label for="CSE_HOD">Select HOD for CSE Dept.:</label></div>
              <div class="col-sm-4"><select class="form-control" id="CSE_HOD" name="CSE_HOD_VAL">
                  <?php
                  $query = "select username from faculty_pos where dept='CSE'";
                  $result = pg_query($db, $query . ";");
                  $count = pg_num_rows($result);
                  while ($count != 0) {
                    $count = $count - 1;
                    $username = pg_fetch_row($result)[0];
                    echo "<option value='" . $username . "'>" . $username . "</option>";
                  }
                  ?>
                </select></div>
              <div class="col-sm-4"><button name="CSE_HOD_Btn" class="btn btn-primary">Update</button></div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-4"><label for="EE_HOD">Select HOD for EE Dept.:</label></div>
              <div class="col-sm-4"><select class="form-control" id="EE_HOD" name="EE_HOD_VAL">
                  <?php
                  $query = "select username from faculty_pos where dept='EE'";
                  $result = pg_query($db, $query . ";");
                  $count = pg_num_rows($result);
                  while ($count != 0) {
                    $count = $count - 1;
                    $username = pg_fetch_row($result)[0];
                    echo "<option value='" . $username . "'>" . $username . "</option>";
                  }
                  ?>
                </select></div>
              <div class="col-sm-4"><button name="EE_HOD_Btn" class="btn btn-primary">Update</button></div>
            </div>
            <hr>
            <div class="row">
              <div class="col-sm-4"><label for="ME_HOD">Select HOD for ME Dept.:</label></div>
              <div class="col-sm-4"><select class="form-control" id="ME_HOD" name="ME_HOD_VAL">
                  <?php
                  $query = "select username from faculty_pos where dept='ME'";
                  $result = pg_query($db, $query . ";");
                  $count = pg_num_rows($result);
                  while ($count != 0) {
                    $count = $count - 1;
                    $username = pg_fetch_row($result)[0];
                    echo "<option value='" . $username . "'>" . $username . "</option>";
                  }
                  ?>
                </select></div>
              <div class="col-sm-4"><button name="ME_HOD_Btn" class="btn btn-primary">Update</button></div>
            </div>

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
<?php
require("dash_head_admin.php");

require "postgreCon.php";
if ($db == false) {
  header("Location: error.php");
  exit();
}
if (array_key_exists('AddBtn', $_POST)) {
  try {
    $query = "INSERT INTO credentials(Username,Password) VALUES ('"
      . $_POST['userId'] . "','"
      . password_hash($_POST['password'], PASSWORD_DEFAULT)
      . "');";
    $result = pg_query($db, $query . ";");
    if (!$result) {
      //TODO implement this using trigger
      $query = "select password from credentials where username = '" . $_POST['userId'] . "';";
      $result = pg_query($db, $query . ";");
      $count = pg_num_rows($result);
      if ($count == 1) {
        echo "<script type='text/javascript'>alert('Username Exists!!');</script>";
      } else {
        echo "<script type='text/javascript'>alert('Some Error Occured!!');</script>";
      }
    } else {
      $query = "INSERT INTO Faculty_Pos(username,dept,position) VALUES ('"
        . $_POST['userId'] . "','"
        . $_POST['dept'] . "','Faculty');";


      $result = pg_query($db, $query . ";");
      if ($result) {
        echo "<script type='text/javascript'>alert('New User Added!!');</script>";
      } else {
        $query = "DELETE FROM credentials where username='" . $_POST['userId'] . "';";
        $result = pg_query($db, $query . ";");
        echo "<script type='text/javascript'>alert('Error code 2!!');</script>";
      }
    }
  } catch (\PDOException $e) {
    echo $e->getMessage();
  }
}

?>
<div id="content-wrapper">
  <div class="container-fluid">
    <div class="login-page">
      <div class="form">
        <form class="login-form" method="post">
          UserName:<br>
          <input type='text' placeholder='User Name' name='userId' />
          <br>Password:<br>
          <input type="password" placeholder="Password" name="password" />
          <br>
          <div class="form-group">
            <label for="sel1">Select Department:</label>
            <select class="form-control" id="sel1" name="dept">
              <option value="CSE">CSE</option>
              <option value="ME">ME</option>
              <option value="EE">EE</option>
            </select>

            <br><button name="AddBtn" class="btn btn-primary">Add</button>
            <?php
            if (isset($_GET["error"])) {
              echo "<div class ='errorMsg'>";
              echo "</div>";
            }
            ?>
        </form>
      </div>
    </div>
  </div>
</div>
<script>
  $(".sidebar li:eq(1)").addClass(" active ");
</script>

<?php
require("dash_foot.php");
?>
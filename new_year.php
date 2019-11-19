<?php
require("dash_head_admin.php");
require("mongo_functions.php");

if (!isset($_SESSION['power'])) {
  header("Location: admin_login.php?error=loginrequired");
} else if ($_SESSION['power'] == 1) {
  header("Location: adminPanel.php?error=MainAdminOnly");
}
if (!isset($_SESSION['power'])) {
	header("Location: admin_login.php?error=loginrequired");
} else if ($_SESSION['power'] == 1) {
	header("Location: adminPanel.php?error=MainAdminOnly");
}

require "postgreCon.php";
if ($db == false) {
  header("Location: error.php");
  exit();
}
if (array_key_exists('reset', $_POST)) {
  if ($_POST['newYear'] != "NEW YEAR") {
    echo "<script type='text/javascript'>alert('Failed code 1');</script>";
  } else {
    $query = "select password from Admins where username = '" . $_SESSION['userId'] . "';";
    $result = pg_query($db, $query . ";");
    $count = pg_num_rows($result);
    if ($count == 0) {
      echo "<script type='text/javascript'>alert('Failed code 2');</script>";
    } else {
      $pass = pg_fetch_row($result)[0];

      if (password_verify($_POST['password'], $pass)) {
        try {
          $leaves=$_POST['leaves'];
          //TODO stored procedure here
          $query = "select NewYear(".$leaves.");";
          $result = pg_query($db, $query . ";");
        } catch (\PDOException $e) {
          echo $e->getMessage();
        }
      } else {
        echo "<script type='text/javascript'>alert('Failed code 3');</script>";
      }
    }
  }
}



?>
<div id="content-wrapper">
  <div class="container-fluid">
    <div class="login-page">
      <div>
        <p>"This page is to be called on a new year to reset the leaves of all the employees"</p>
      </div>
      <div class="form">
        <form class="login-form" method="post">
          Enter "NEW YEAR" (without quotes) in the following field and press confirm button to reset all leaves:<br>
          <input type='text' placeholder='NEW YEAR' name='newYear' />
          <br>Login Password:<br>
          <input type="password" placeholder="Password" name="password" />
          <br>
          
          Leaves for new year:<br>
          <input type='number' placeholder='Leaves' name='leaves' step="1" />
          <br>
          <br><button name="reset" class="btn btn-primary">Confirm</button>
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
  $(".sidebar li:eq(9)").addClass(" active ");
</script>

<?php
require("dash_foot.php");
?>
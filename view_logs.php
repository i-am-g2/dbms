<?php
  require("dash_head_admin.php");
  if(!isset($_SESSION['power']) || $_SESSION['power']==1){
    header ("Location: error.php");
  }
  require "postgreCon.php";
  if($db==false) {
		header ("Location: error.php");
		exit();
	}
?>

  <div id="content-wrapper">
    <div class="container-fluid">
      
      <?php
        $query = "select * from admin_logs;";
        $result = pg_query($db, $query.";");
        $count = pg_num_rows($result);
        while ($count != 0) {
          $count = $count - 1;
          $log = pg_fetch_row($result);
          echo "<div class='row'>";
          echo"<div class='col-sm-3'>".$log[0]."</div>";
          echo"<div class='col-sm-3'>".$log[2]."</div>";
          echo"<div class='col-sm-6'>".$log[1]."</div>";
          echo"</div>";  
        }
        
      ?>    
    </div>
  </div>
    

    
    <script>
		$(".sidebar li:eq(7)").addClass(" active ");
	</script>
	
<?php
  require("dash_foot.php");
?>

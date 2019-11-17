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
  if(array_key_exists('CSE_FAC_Btn', $_POST)  ) {
    //  echo "update cse fac";
    setRoute($db,'CSE_FAC',$_POST['CSE_FAC_VAL'],$_SESSION['userId']);
  }
?>

  <div id="content-wrapper">
    <div class="container-fluid">
      <form class="login-form" method="post">
        
        <button name="ADFA_Btn" class="btn btn-primary">Update</button>
      </form>        
    </div>
  </div>
    

    
    <script>
		$(".sidebar li:eq(8)").addClass(" active ");
	</script>
	
<?php
  require("dash_foot.php");
?>

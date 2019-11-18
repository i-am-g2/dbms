<?php
require("dash_head.php");

if(isset($_GET['alert'])){
  //echo"ll";
  $alert=$_GET['alert'];
  //echo "<script type='text/javascript'>alert('".$alert."');</script>";
echo $alert;
}
?>
<div id="content-wrapper">
  <div class="container-fluid">

    <div class="toast" id="myToast" data-delay= 3500 >
      <div class="toast-header">
        <strong class="mr-auto"><i class="fas fa-check-circle"></i> Success </strong>
        <small></small>
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast">&times;</button>
      </div>
      <div class="toast-body">
        <!-- <?php echo $_SESSION['msg'] ?> -->
      </div>
    </div>

  
  </div>
</div>


<script>
  $(".sidebar li:eq(0)").addClass(" active ");
  
  
</script>

<?php
require("dash_foot.php");
?>
<?php
require("dash_head.php");
?>

<link rel="stylesheet" href="Res/CSS/customForm.css">

<div id="content-wrapper">
	
	<ol class="breadcrumb">
		<li class="breadcrumb-item">
			<a href="dashboard.php">Dashboard</a>
		</li>
		<li class="breadcrumb-item active">Take Leave</li>
	</ol>
	<div class="container-fluid">
		<div class="card" style="width: 40%;">
			
			<div class="card-body">
				<h5 class="card-title">Leave Form</h5>
				<p class="card-text">Please fill in the required Details.</p>
				

				<div class="form">
					

					<form class="leave-form" action="leave.inc.php" method="post">
						<label> Start Date : </label> <input type="date" name="start_date"> <br>
						<label> End Date &nbsp&nbsp: </label> <input type="date" name="end_date"> <br>
						<label> Description: </label><br>
						<!-- <input type= name=""  values = "<?php echo $daysleft  ?>"  hidden =true> -->
						<textarea name="description" style="width:80%;height:150px;"></textarea><br>
						<button name="leave_submit"> Submit</button>
					</form>


				</div>
			</div>



		</div>

	</div>
</div>
<script>
	$(".sidebar li:eq(2)").addClass(" active ");
</script>

<?php
require("dash_foot.php");
?>
<?php
require("dash_head.php");
require("postgreCon.php");
$sql = "select * from applications where username='" . $_SESSION['userId'] . "';";
$result = pg_query($db, $sql);
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
		<div class="row">
			<div class="col-md-6" style="">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title">Leave Form</h5>
						<p class="card-text">Please fill in the required Details.</p>


						<div class="form">

							<form class="leave-form" action="leave.inc.php" method="post">
								<label> Start Date : </label> <input type="date" name="start_date"> <br>
								<label> End Date &nbsp&nbsp: </label> <input type="date" name="end_date"> <br>
								<label> Description: </label><br>
								<textarea name="description" style="width:80%;height:150px;"></textarea><br>
								<button name="leave_submit"> Submit</button>
							</form>


						</div>
					</div>
				</div>

			</div>
			<div class="col-md-6" style=" border-left: medium dashed green;">
				<div class="card" style="">

					<div class="card-body">
						<h5 class="card-title">Past Leave Forms</h5>
						<p class="card-text"> </p>

						<!-- Past Submitted  -->
						<div style="background-color: #f2f2f2;">
							<ul class="list-group">
								<?php
								while ($row = pg_fetch_row($result)) {

									echo "
									<li class='list-group-item'>
									
									<p>Id :" . $row['0'] . " </p>
									<p>User : " . $row['1'] . " </p>
									<p>" . $row['2'] . " to " . $row['3'] . "</p>
									
									</li>";
								}
								?>
							</ul>
						</div>

					</div>



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
<?php
require("dash_head.php");
require("postgreCon.php");
$sql = "select * from applications where username='" . $_SESSION['userId'] . "';";
$result = pg_query($db, $sql);
?>
<!--js Query karo and submit Button Disable kar do -->

<script>
	$(document).ready(
		enableSbmit
	);
	$(document).ready(
		setVisible
	)
	$(document).ready(
		color
	)
	
	function setVisible() {
		var count = $("#past_list").children().length;
		if(count==0) {
			$("#side_card").prop("hidden",true);
		}
	}

	function enableSbmit () {
		var xmlhttp = new XMLHttpRequest();
		xmlhttp.onreadystatechange = function () {
			if (this.readyState == 4 && this.status == 200) {
				console.log(this.responseText);
				if (this.responseText == 1) { /* Already one application */
					$("input, textarea, button").prop("disabled",true);
					$("button").removeClass();
					$("button").addClass("btn btn-secondary diabled");
					$("button").prop("aria-disabled",true);
					$("#msgS").prop("hidden",false);
				} 

			}
		};
		
		console.log("e");
		xmlhttp.open("GET", "multiple_app.php" ,  true);
		xmlhttp.send();
	} 

	function color() {
		$('#past_list').children().each(function () {
			console.log($(this).children('h6').html());
			if($(this).children('h6').html() == 'appr') {
				$(this).css({"border-left-color":"#4caf50"});
				$(this).append("<p class='text-success'> Approved</p>");
			} else if($(this).children('h6').html() == 'rjct') {
				$(this).css({"border-left-color":"#fc4a1a"});
				$(this).append("<p class='text-danger'> Rejected</p>");
			} else {
				$(this).css({"border-left-color":"#55bbe7"});
				$(this).append("<p class='text-primary'> Pending</p>");
			}
	 // "this" is the current element in the loop
});
	}
</script>


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
								<button name="leave_submit" id = "submitB"> Submit</button>
							</form>


						</div>
						<h6 id="msgS" hidden style="color:#fc4a1a;" > <i class="fas fa-exclamation-triangle"></i> As per the rule, you can submit only one leave application at a time. Please wait for clearance of previous leave application.</h6>
					</div>
				</div>

			</div>
			<div class="col-md-6" style=" border-left: medium dashed green;" id="side_card">
				<div class="card" style="">

					<div class="card-body">
						<h5 class="card-title">Past Leave Forms</h5>
						<p class="card-text"> </p>

						<!-- Past Submitted  -->
						<div style="background-color: #f2f2f2;">
							<ul class="list-group" id="past_list">
								<?php
								while ($row = pg_fetch_row($result)) {

									echo "
									<li class='list-group-item' style='border-left: medium solid; border-left-width:10px;' >
									
									
									<p>".$row['4']."</p>
									<small class='text-muted'>".$row['2']." - ". $row['3'] ."</small>
									<h6 hidden>".$row['5']."</h6>
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
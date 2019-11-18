
<!-- 
	Pick Application Id from Session : read and detroy the id
-->

<?php
require("dash_head.php");
?>

<script>
function submitFunc() {
	document.getElementById("cmnt_form").submit();
	return true;
}
</script>

<link rel="stylesheet" href="Res/CSS/customappdetails.css">

<div id="content-wrapper">
	<ol class="breadcrumb">
		<li class="breadcrumb-item">
			<a href="dashboard.php">Dashboard</a>
		</li>
		<li class="breadcrumb-item active">Actions</li>
		<li class="breadcrumb-item active">Details</li>
	</ol>
	<div class="container-fluid">
		<!-- Application Detals -->
		<?php 
			// $_SESSION['app_id'] = 3;
			$app_id = $_SESSION['app_id'];
			$sql = "select * from applications where id = '".$_SESSION['app_id']."';";
			$result = pg_query($db,$sql);
			$application_obj = pg_fetch_row($result);
			$cmntsql = "select * from comments where app_id = '".$app_id."';";
			$cmnt_res = pg_query($db, $cmntsql);
		?> 

		<div>
			<p> Id : <?php echo $application_obj['0']; ?> </p>
			<p> By : <?php echo $application_obj['1']; ?> </p>
			<p> From : <?php echo date_format(date_create($application_obj['2']) , "D, d M y"); ?> </p>
			<p> To : <?php echo date_format(date_create($application_obj['3']) , "D, d M y"); ?></p>
			<p> Days Borrowed : <?php echo $application_obj['7']; ?></p>
			<p> Description</p>
			<p style="border-left: medium solid blue; padding-left : 10px; background-color: #f2f2f2;">  <?php echo $application_obj['4']; ?></p>
			<hr>
			<ul class="list-group">
				<?php 
					while ($row_cmnt = pg_fetch_row($cmnt_res)) {
						echo "<li class = 'list-group-item'><p class='user'> <i class='fas fa-user'> </i> &nbsp : &nbsp ".$row_cmnt['1']."</p><p class='timeval'> <i class='fas fa-clock'> </i> &nbsp : &nbsp".date_format(date_create($row_cmnt['2']) , "G:i : : d M y") ."</p><p class='desc'> <i class='fas fa-comment-alt'> </i> &nbsp : &nbsp".$row_cmnt['3']."</p></li>";
					}
				?>
				<!-- Comments -->
			</ul>

			<!--Comment Box-->
			<form action="post_comment.inc.php" method="post" id="cmnt_form" > 
			<textarea name="comment" style="width:80%;height:150px;"></textarea><br>
			<button name="comment_submit" class="btn btn-success">Comment</button>	
			</form>

			<hr> 
			<?php 
				// Current Holder != UserName
				if($application_obj['1'] != $application_obj['6']) {
					echo "
					<form action='red_app.inc.php' method='post' id='buttonArea'>
					<button  class='btn btn-dark' name='approve_submit'> Approve </button> 
					<button  class='btn btn-dark' name='reject_submit'>Reject</button>
					<button  class='btn btn-dark' name='rev_submit'>Revert</button>
					</form>
					";
				} else  {
					echo "
					<form action='red_app.inc.php' method='post' id='buttonArea'>
					<button class='btn btn-dark' name='resubmit'> Resubmit </button> 
					</form>
					";
				}
			?>

		</div>
	</div>
</div>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script>
	$(".sidebar li:eq(4)").addClass(" active ");
</script>

<?php
require("dash_foot.php");
?>
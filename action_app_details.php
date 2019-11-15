
<!-- 
	Pick Application Id from Session : read and detroy the id
-->

<?php
require("dash_head.php");
?>

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
			<p> From : <?php echo $application_obj['2']; ?> </p>
			<p> To : <?php echo $application_obj['3']; ?></p>
			<p> Days Borrowed : <?php echo $application_obj['7']; ?></p>
			<p> Description</p>
			<p style="border-left: medium solid blue; padding-left : 10px; "> <?php echo $application_obj['4']; ?></p>
			
			<ul class="list-group">
				<?php 
					while ($row_cmnt = pg_fetch_row($cmnt_res)) {
						echo "<li id='cmnt_item' class = 'list-group-item'><p id='user'>".$row_cmnt['1']."</p><p id='timeval'>".$row_cmnt['2']."</p><p id='desc'>".$row_cmnt['3']."</p></li>";
					}
				?>
				<!-- Comments -->
			</ul>

			<!--Comment Box-->
			<form action="post_comment.inc.php" method="post"> 
			<textarea name="comment" style="width:80%;height:150px;"></textarea><br>
			<button name="comment_submit">Submit</button>	
			</form>


			<form action="post_comment.inc.php" method="post">
			<button type="button" class="btn btn-success"> Approve </button> 
			<button type="button" class="btn btn-danger">Reject</button>
			<button type="button" class="btn btn-primary">Revert</button>
			</form>

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
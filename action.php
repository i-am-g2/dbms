<?php
require("dash_head.php");
require ("postgreCon.php");

$sql = "select * from applications where curr_holder= '".$_SESSION['userId']."';";
$result = pg_query($db, $sql);
?>




<div id="content-wrapper">
	<ol class="breadcrumb">
		<li class="breadcrumb-item">
			<a href="dashboard.php">Dashboard</a>
		</li>
		<li class="breadcrumb-item active">Actions</li>
	</ol>
	<div class="container-fluid">
		<ul class="list-group">
			
			<?php 
				while ($row = pg_fetch_row($result)) {

					echo  "
					<li class='list-group-item'>
					<form method='post' action='redirect.inc.php'>
						<p>Id :".$row['0']." </p>
						<p>User".$row['1']." </p>
						<p>".$row['2'] ." to ".$row['3'] ."</p>
						<input type='text' name='redirect' id='hidInput'  value='". $row['0'] ."' >  
						<button name='redirect_Submit'>View Details</button>
					</form>";
				}
			?> 
			
			
			
		</ul>

	</div>
</div>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script>
	$(".sidebar li:eq(4)").addClass(" active ");
</script>

<?php
require("dash_foot.php");
?>
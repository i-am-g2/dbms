<?php
require("dash_head.php");
require ("postgreCon.php");
$query = "SELECT username FROM credentials WHERE username !='".$_SESSION['userId']."';";
$result = pg_query($db, $query);
?>
<div id="content-wrapper">
	<div class="container-fluid">
	<ul>
	<div>
	<h4>Available Users</h4>
	<ul class="list-group">
	<?php 
		$html = "<li><a href = ''></a></li>" ;
		
		while($row = pg_fetch_row($result)) {
			echo "<a class='list-group-item list-group-item-action 'href = 'profile.php?UserId=".$row['0']."'>".$row['0']."</a>";
		}
	?></ul>
	</div>
	

</div>
</div>
<script>
	$(".sidebar li:eq(1)").addClass(" active ");
</script>

<?php
require("dash_foot.php");
?>
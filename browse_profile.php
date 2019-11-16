<?php
require("dash_head.php");
require ("postgreCon.php");
$query = "SELECT username FROM credentials WHERE username !='".$_SESSION['userId']."';";
$result = pg_query($db, $query);
?>
<div id="content-wrapper">
	<div class="container-fluid">
	
	<?php 
		while ($row = pg_fetch_row($result)) {
			echo $row['0'];
		}
	?>
	

</div>
</div>
<script>
	$(".sidebar li:eq(1)").addClass(" active ");
</script>

<?php
require("dash_foot.php");
?>
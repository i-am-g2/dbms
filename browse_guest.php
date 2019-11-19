<?php
require("header.php");
require ("postgreCon.php");
$query = "SELECT username FROM credentials;";
$result = pg_query($db, $query);
?>
<link rel="stylesheet" type="text/css" href="Res/CSS/customLogin.css">
<div class="login-page">
<div id="content-wrapper">
	<div class="container-fluid">
	<ul>
	<div class="card" style="background-color: #fff; ">
	<div class="card-header">
    <!-- Featured -->
	<h4>Available Users</h4>
  </div>
	<div class="card-body">
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
</div>

<div  class="bottumbar">
	<span class="paraLeft">
		Faculty Portal @ IIT Ropar
	</span>
</div>
<script>
	$(".sidebar li:eq(1)").addClass(" active ");
</script>


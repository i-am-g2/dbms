<?php
require("dash_head.php");
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
			<li class="list-group-item">
				<p>Application</p>
				<p>User </p>
				<p>From to End</p>
			</li>
			<li class="list-group-item">
				<p>Application</p>
				<p>User </p>
				<p>From to End</p>
			</li>
			<li class="list-group-item">
				<p>Application</p>
				<p>User </p>
				<p>From to End</p>
			</li>
			<li class="list-group-item">
				<p>Application</p>
				<p>User </p>
				<p>From to End</p>
			</li>
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
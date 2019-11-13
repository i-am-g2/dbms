<?php
session_start();
if (!isset($_SESSION['login'])) {
	header("Location: index.php?error=loginrequired&message=Login_Required");
} else if ($_SESSION['login'] == false) {
	header("Location: index.php?error=loginrequired&message=Login_Required");
}
?>

<?php 
	require "postgreCon.php";
	$sql = "select daysleft from remaining_leaves where username ='".$_SESSION['userId']."' and yearId = 0";
	$res = pg_query($db, $sql.';');
	$row = pg_fetch_row($res);
	$daysleft = $row['0'];
	$_SESSION['daysleft'] = $daysleft;
?>

<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">

	<title> Dashboard</title>

	<!-- Custom fonts for this template-->
	<link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

	<!-- Page level plugin CSS-->
	<link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

	<!-- Custom styles for this template-->
	<link href="css/sb-admin.css" rel="stylesheet">

</head>

<body id="page-top">
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<!-- <script src="vendor/jquery-easing/jquery.easing.min.js"></script> -->

	<nav class="navbar navbar-expand navbar-dark bg-dark static-top">

		<a class="navbar-brand mr-1" href="index.html">Welcome <?php echo $_SESSION['userId'] ?> </a>

		<!-- <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
      <i class="fas fa-bars"></i>
    </button> -->

		<!-- Navbar Search -->
		<form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
			<div class="input-group">
				<input type="text" class="form-control" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
				<div class="input-group-append">
					<button class="btn btn-primary" type="button">
						<i class="fas fa-search"></i>
					</button>
				</div>
			</div>
		</form>

		<!-- Navbar -->
		<ul class="navbar-nav ml-auto ml-md-0">

			<li class="nav-item dropdown no-arrow">
				<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-user-circle fa-fw"></i>
				</a>
				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
					<a class="dropdown-item" href="#">Settings</a>
					<a class="dropdown-item" href="#">Activity Log</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="logout.inc.php">Logout</a>
				</div>
			</li>
		</ul>

	</nav>

	<div id="wrapper">

		<!-- Sidebar -->
		<ul class="sidebar navbar-nav">
			<li class="nav-item ">
				<a class="nav-link" href="dashboard.php">
					<i class="fas fa-fw fa-tachometer-alt"></i>
					<span>Dashboard</span>
				</a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="tables.html">
					<i class="fas fa-id-badge"></i>
					<span> Browse Profile </span></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="create_leave.php">
					<i class="fas fa-plane-departure"></i>
					<span>Take Leave</span></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="charts.html">
					<i class="fas fa-fw fa-chart-area"></i>
					<span>My Profile</span></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="action.php">
					<i class="fas fa-info-circle"></i>
					<span> Actions </span></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="tables.html">
					<i class="fas fa-calander-day"></i>
					<span> <?php echo $daysleft ?> : Days Remaining </span></a>
			</li>
		</ul>
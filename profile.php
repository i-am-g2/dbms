<!DOCTYPE html>
<html lang="en">
<head>
	<title>Personal Profile</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>

<body style = "
  background: url('Res/Image/profile-bg3.png') no-repeat center center fixed;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  background-size: cover;
  -o-background-size: cover;
">


<!--<div class="jumbotron text-center">-->
<div style="margin-left:1%">
	<span style="color:white">School of Engineering</span><br>
	<img src="Res/Image/logo.png" class="img-thumbnail" alt="U Logo" style="max-width: 10%;height: auto;margin-bottom:1%;margin-top:0"">
		<span class="display-4 text-center" style="margin-top:1%;color:white">YJ University<span>
	</img> 
</div>

  
<div class="container" style="background-color:white;margin-top:1%;border-radius: 10px;">
	<div class="row">
		<div class="col-sm-3">
			<img src="Res/Image/logo.png" class="img-thumbnail" alt="DP" style="max-width: 100%;height: auto;margin:2%;"></img>
			<div class="text-center">
				<img src="Res/Image/gscholar.jpeg" alt="G" style="max-width: 40%;height: auto;margin-left:0%;margin-top:2%;margin-bottom:2%;margin-right:0%"></img>
				<img src="Res/Image/LinkedIn_logo.png" alt="L" style="max-width: 20%;height: auto;margin-right:2%;margin-top:2%;margin-bottom:2%;margin-left:0%""></img>	
			</div>
    	</div>
    	<div class="col-sm-9">
        	<h1 class="diaplay-4" style="margin-top:3%">$Name</h1>
			<h4 class="diaplay-4" style="margin-top:1%"><small>$Position, <span class="text-primary">$Lab/Dept.</span></small></h1>
			<h4 class="diaplay-4" style="margin-top:1%"><small>$Position, $Headline</small></h1>
			<hr>
			<span> Email: $email</span><br>
			<span> $Note</span>
    	</div>
    
	</div><!--Row end-->
</div>

<div class="container" style="background-color:white;margin-top:1%;border-radius: 10px;">
		<h1 class="diaplay-4"><small> Personal Profile </small></h1><br>
		<h2 class="diaplay-4"><small> About Me </small></h2>
		<span>$AboutMe</span>
		<br><hr>
		<h2 class="diaplay-4"><small> Latest News </small></h2>
		<div class="list-group">
			<a href="#" class="list-group-item list-group-item-action">First item</a>
			<a href="#" class="list-group-item list-group-item-action">Second item</a>
			<a href="#" class="list-group-item list-group-item-action">Third item</a>
		</div>
		<hr>
		<h2 class="diaplay-4"><small> Current Research Interests </small></h2>
		<ul class="list-group list-group-flush">
			<li class="list-group-item" style="border:none">First item</li>
			<li class="list-group-item" style="border:none">Second item</li>
			<li class="list-group-item" style="border:none">Third item</li>
			<li class="list-group-item" style="border:none">Fourth item</li>
		</ul> 
		<hr>
		<h2 class="diaplay-4"><small> Teaching Interests </small></h2>
		<ul class="list-group list-group-flush">
			<li class="list-group-item" style="border:none">First item</li>
			<li class="list-group-item" style="border:none">Second item</li>
			<li class="list-group-item" style="border:none">Third item</li>
			<li class="list-group-item" style="border:none">Fourth item</li>
		</ul> 
		<hr>
		<h2 class="diaplay-4"> Projects </h2>
		<div id ="projects">
			<div>
				<a href="#"><h4 class="text-primary" style="margin:0">$Title</h4></a>
				<span class="text-muted" style="margin-top:0"><small>begin | end</small></span>
				<br>
				<span class="text-dark">$description</span>
			</div>
		</div>
		<hr>
		<h2 class="diaplay-4"> Research Output </h2>
		<div id ="projects">
			<div>
				<a href="#"><h4 class="text-primary" style="margin:0">$Title</h4></a>
				<span class="text-muted" style="margin-top:0"><small>begin | end</small></span>
				<br>
				<span class="text-dark">$description</span>
			</div>
		</div>
		<hr>
		<span>Collaboration note</span>
		<hr>
		<h2 class="diaplay-4"><small> Other Links </small></h2>
		<div class="list-group">
			<a href="#" class="list-group-item list-group-item-action">First item</a>
			<a href="#" class="list-group-item list-group-item-action">Second item</a>
			<a href="#" class="list-group-item list-group-item-action">Third item</a>
		</div>
		<hr>
</div>

</body>
</html>


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


<div style="margin-left:1%">
	<span style="color:white">School of Engineering</span><br>
	<img src="Res/Image/logo.png" class="img-thumbnail" alt="U Logo" style="max-width: 10%;height: auto;margin-bottom:1%;margin-top:0">
		<span class="display-4 text-center" style="margin-top:1%;color:white">YJ University<span>
	</img> 
	<div align="right" style="vertical-align: text-top;" valign="top">
	<a href="edit_profile.php"><img src="Res/Image/edit.png" class="img-thumbnail" alt="Edit" style="max-width: 5%;height: auto;margin-bottom:1%;margin-top:0"></a>
	</div>
</div>

<?php
require_once __DIR__ . "/vendor/autoload.php";
$collection = (new MongoDB\Client)->YJUniversityDB->profiles;
$UserIdPara = $_GET['UserId'];
$user = $collection->findOne(['UserId'=>$UserIdPara]);
$name=$user['Name'];
$position=$user['Position'];
$lab=$user['Lab'];
$headline=$user['Headline'];
$emailId=$user['EmailId'];
$linkedin_link=$user['Linkedin_Link'];
$google_scholar=$user['Google_Scholar'];
$latest_news=$user['Latest_News'];
$note=$user['Note'];
$about_me=$user['About_Me'];
$research_interests=$user['Research_Interests'];
$collaboration=$user['Collaboration'];
$teaching_interest=$user['Teaching_Interest'];
$projects=$user['Projects'];
$research_outputs=$user['Research_Outputs'];
$prizes=$user['Prizes'];
$other_links=$user['Other_Links'];

$img_src="Res/Image/".$UserIdPara.".png";
echo"
<div class='container' style='background-color:white;margin-top:1%;border-radius: 10px;'>
	<div class='row'>
		<div class='col-sm-3'>
			<img src='$img_src' class='img-thumbnail' alt='DP' style='max-width: 100%;height: auto;margin:2%;'></img>
			<div class='text-center'>
				<img src='Res/Image/gscholar.jpeg' alt='G' style='max-width: 40%;height: auto;margin-left:0%;margin-top:2%;margin-bottom:2%;margin-right:0%'></img>
				<img src='Res/Image/LinkedIn_logo.png' alt='L' style='max-width: 20%;height: auto;margin-right:2%;margin-top:2%;margin-bottom:2%;margin-left:0%'></img>	
			</div>
    	</div>
    	<div class='col-sm-9'>
        	<h1 class='diaplay-4' style='margin-top:3%'>$name</h1>
			<h4 class='diaplay-4' style='margin-top:1%'><small>$position, <span class='text-primary'>$lab</span></small></h1>
			<h4 class='diaplay-4' style='margin-top:1%'><small>$headline</small></h1>
			<hr>
			<span> Email: $emailId</span><br>
			<span> $note</span>
    	</div>
    
	</div> 
</div>

<div class='container' style='background-color:white;margin-top:1%;border-radius: 10px;'>
		<h1 class='diaplay-4'><small> Personal Profile </small></h1><br>
		<h2 class='diaplay-4'><small> About Me </small></h2>
		<span>$about_me</span>
		<br><hr>
		<h2 class='diaplay-4'><small> Latest News </small></h2>
		<div class='list-group'>";
			if (is_array($latest_news))
			foreach($latest_news as $news){
				$news_link=$news['Link'];
				$news_headline=$news['Headline'];
				if($news['Link']==NULL)
					$news_link=NULL;
				echo"<a href='$news_link' class='list-group-item list-group-item-action'>$news_headline</a>";
			}
		echo"
		</div>
		<hr>
		<h2 class='diaplay-4'><small> Current Research Interests </small></h2>
		<ul class='list-group list-group-flush'>
		";	
			if (is_array($research_interests))
			foreach($research_interests as $interest){
				echo"<li class='list-group-item' style='border:none'>$interest</li>";	
			}
		echo"</ul> 
		<hr>
		<h2 class='diaplay-4'><small> Teaching Interests </small></h2>
		<ul class='list-group list-group-flush'>
		";
			if (is_array($teaching_interest))
			foreach($teaching_interest as $interest){
				echo"<li class='list-group-item' style='border:none'>$interest</li>";
			}
		echo"</ul> 
		<hr>
		<h2 class='diaplay-4'> Projects </h2>
		<div id ='projects'>
			<div>";
				if (is_array($projects))
				foreach($projects as $project){
					$project_title=$project['Title'];
					$project_description=$project['Description'];
					$project_link=$project['Link'];
					$time_begin=$project['Time_Begin'];
					$time_end=$project['Time_End'];
					if($project_link==NULL)
					$project_link="#";
					echo"<a href='$project_link'><h4 class='text-primary' style='margin:0'>$project_title</h4></a>
					<span class='text-muted' style='margin-top:0'><small>$time_begin | $time_end</small></span>
					<br>
					<span class='text-dark'>$project_description</span>";
				}
		echo"
			</div>
		</div>
		<hr>
		<h2 class='diaplay-4'> Research Output </h2>
		<div id ='projects'>
			<div>";
			$conference_papers=$research_outputs['Conference_Papers'];
			$articles=$research_outputs['Papers'];
			$others=$research_outputs['Others'];
			if (is_array($conference_papers))
			foreach($conference_papers as $project){
				$project_title=$project['Title'];
				$conference_title=$project['Conference_Title'];
				$project_description=$project['Description'];
				$project_link=$project['Link'];
				$time=$project['Time'];
				$citations=$project['Citations'];
				if($project_link==NULL)
					$project_link="#";
				echo"
					<a href='$project_link'><h4 class='text-primary' style='margin:0'>$project_title</h4></a>
					<span class='text-muted' style='margin-top:0'><small>$time</small></span>
					<br>
					<p class='text-secondary'>$conference_title</p>
					<span class='text-dark'>$project_description</span><br>
					<p> Citations:$citations</p>
				";
			}
			if (is_array($articles))
			foreach($articles as $project){
				$project_title=$project['Title'];
				$conference_title=$project['Conference_Title'];
				$project_description=$project['Description'];
				$project_link=$project['Link'];
				$time=$project['Time'];
				$citations=$project['Citations'];
				if($project_link==NULL)
					$project_link="#";
				echo"
					<a href='$project_link'><h4 class='text-primary' style='margin:0'>$project_title</h4></a>
					<span class='text-muted' style='margin-top:0'><small>$time</small></span>
					<br>
					<p class='text-secondary'>$conference_title</p>
					<span class='text-dark'>$project_description</span><br>
					<p> Citations:$citations</p>
				";
			}
			if (is_array($others))
			foreach($others as $project){
				$project_title=$project['Title'];
				$project_description=$project['Description'];
				$project_link=$project['Link'];
				$time=$project['Time'];
				$citations=$project['Citations'];
				if($project_link==NULL)
					$project_link="#";
				echo"
					<a href='$project_link'><h4 class='text-primary' style='margin:0'>$project_title</h4></a>
					<span class='text-muted' style='margin-top:0'><small>$time</small></span>
					<br>
					<p class='text-secondary'>$conference_title</p>
					<span class='text-dark'>$project_description</span><br>
					<p> Citations:$citations</p>
				";
			}
			echo"
			</div>
		</div>
		<hr>
		<span>$collaboration</span><br>
		<hr>
		<h2 class='diaplay-4'><small> Other Links </small></h2>
		<div class='list-group'>";
		if (is_array($other_links))
			foreach($other_links as $link){
				echo"<a href='$link' class='list-group-item list-group-item-action'>$link</a>";
			}
		echo"	
		</div>
		<hr>
</div>";
?>

</body>
</html>


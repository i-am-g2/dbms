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
		<?php
		$link="profile.php?UserId=".$_GET['UserId'];
		echo"
		<a href='$link'><img src='Res/Image/eye.png' class='img-thumbnail' alt='Edit' style='max-width: 5%;height: auto;margin-bottom:1%;margin-top:0'></a>
		</div>";
		?>
	</div>

<?php
	//include 'classes.php';
	session_start();
	require_once __DIR__ . "/vendor/autoload.php";
	$Permission=FALSE;
	//echo $_SESSION['userId'];
	$UserIdPara = $_GET['UserId'];
	if(isset($_SESSION['userId'])){
		 
		if($_SESSION['userId']!=$UserIdPara){
		//	echo"<script type = 'text/javascript'>alert('Not Enough Permissions');</script>";
			header("Location: dashboard.php?alert=You_cannot_edit_others'_profile");
		}

	}else{
	//	echo"<script type = 'text/javascript'>alert('Not Enough Permissions');</script>";
			header("Location: index.php");
	}

	if(array_key_exists('button1', $_POST)) { 
		update('button1fun'); 
	} 
	else if(array_key_exists('button2', $_POST)) { 
		update('button2fun'); 
	}
	else if(array_key_exists('button3', $_POST)) { 
		update('button3fun'); 
	}
	else if(array_key_exists('button4', $_POST)) { 
		update('button4fun'); 
	}
	else if(array_key_exists('button5', $_POST)) { 
		update('button5fun'); 
	}
	else if(array_key_exists('button6', $_POST)) { 
		update('button6fun'); 
	}
	else if(array_key_exists('button7', $_POST)) { 
		update('button7fun'); 
	}
	else if(array_key_exists('button8', $_POST)) { 
		update('button8fun'); 
	}
	else if(array_key_exists('button9', $_POST)) { 
		update('button9fun'); 
	}
	else if(array_key_exists('button10', $_POST)) { 
		update('button10fun'); 
	}
	else if(array_key_exists('buttonimage', $_POST)) { 
		$target_dir = "Res/Image/";
		$target_file = $target_dir.basename($_FILES["fileToUpload"]["name"]); //. $_GET['userId'];
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
		echo $imageFileType.$_GET['UserId'];
    	$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    	if($check !== false) {
    	    echo "File is an image - " . $check["mime"] . ".";
    	    $uploadOk = 1;
    	} else {
    	    echo "File is not an image.";
    	    $uploadOk = 0;
    	}

// Check if file already exists
		if (file_exists($target_dir.$_GET['UserId'].".".$imageFileType)) {
    		unlink($target_dir.$_GET['UserId'].".".$imageFileType);
		}
// Check file size
		if ($_FILES["fileToUpload"]["size"] > 2000000) {
		    echo "Sorry, your file is too large.";
		    $uploadOk = 0;
		}
// Allow certain file formats
		if($imageFileType != "jpg" ) {
		    echo "Sorry, only JPG files are allowed.";
		    $uploadOk = 0;
		}
// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
		    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
		} else {
    		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_dir.$_GET['UserId'].".".$imageFileType)) {
        		echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
    		} else {
        		echo "Sorry, there was an error uploading your file.";
    		}
		}
	}
	else if(array_key_exists('button11', $_POST)) { 
		//delete news
		$collection = (new MongoDB\Client)->YJUniversityDB->profiles;
		$UserIdPara = $_GET['UserId'];
		$user = $collection->findOne(['UserId'=>$UserIdPara]);
		$new_val=$_POST['Delete_News'];
		$new_news_array=array();
		
		if(isset($user['Latest_News'])){
			$latest_news=$user['Latest_News'];
			echo"latest news found";
		}
		else{
			echo"ltest news not found";
			$latest_news=array();
		}
		if (is_array($latest_news) || is_object($latest_news)){
			$cnt=0;
		foreach($latest_news as $news){
			$cnt=$cnt + 1;
			echo"cnt".$cnt."newval".$new_val;
			if($cnt!=$new_val){
				echo "debug";
				$new_news_array[]=$news;
			}
		}}
		else{
			//echo"not array";
		}
			
		$updateResult = $collection->updateOne(
			[ 'UserId' => $UserIdPara ],
			[ '$set' => [ 'Latest_News' => $new_news_array ]]
		);
	}
	else if(array_key_exists('button12', $_POST)) { 
		//delete news
		$UserIdPara = $_GET['UserId'];
		$collection = (new MongoDB\Client)->YJUniversityDB->profiles;
		$new_news_headline=$_POST['New_News_Headline'];
		$new_news_link=$_POST['New_News_Link'];
		$user = $collection->findOne(['UserId'=>$UserIdPara]);
		
		if(isset($user['Latest_News'])){
			$latest_news=$user['Latest_News'];
		}else{
			$latest_news=array();
		}
		$new_news=[
			'Headline'=> $new_news_headline,
			'Link'=>$new_news_link
		];
		//var_dump($new_news);
		$latest_news[]=$new_news;
		//var_dump($latest_news);

			
		$updateResult = $collection->updateOne(
			[ 'UserId' => $UserIdPara ],
			[ '$set' => [ 'Latest_News' => $latest_news ]]
		);
	}
	else if(array_key_exists('button13', $_POST)) { 
		//delete news
		$collection = (new MongoDB\Client)->YJUniversityDB->profiles;
		$UserIdPara = $_GET['UserId'];
		$user = $collection->findOne(['UserId'=>$UserIdPara]);
		$new_val=$_POST['Delete_Research_Interest'];
		$new_interests=array();
		
		if(isset($user['Research_Interests'])){
			$research_interests=$user['Research_Interests'];
		}
		else{
			$research_interests=array();
		}
		if (is_array($research_interests) || is_object($research_interests)){
			$cnt=0;
		foreach($research_interests as $news){
			$cnt=$cnt + 1;
			if($cnt!=$new_val){
				$new_interests[]=$news;
			}
		}}
			
		$updateResult = $collection->updateOne(
			[ 'UserId' => $UserIdPara ],
			[ '$set' => [ 'Research_Interests' => $new_interests ]]
		);
	}
	else if(array_key_exists('button14', $_POST)) { 
		//delete news
		$UserIdPara = $_GET['UserId'];
		$collection = (new MongoDB\Client)->YJUniversityDB->profiles;
		$new_research_interest=$_POST['New_Research_Interest'];
		$user = $collection->findOne(['UserId'=>$UserIdPara]);
		
		if(isset($user['Research_Interests'])){
			$research_interests=$user['Research_Interests'];
		}else{
			$research_interests=array();
		}
		//var_dump($new_news);
		$research_interests[]=$new_research_interest;
		//var_dump($latest_news);

			
		$updateResult = $collection->updateOne(
			[ 'UserId' => $UserIdPara ],
			[ '$set' => [ 'Research_Interests' => $research_interests ]]
		);
	}
	else if(array_key_exists('button15', $_POST)) { 
		//delete news
		$collection = (new MongoDB\Client)->YJUniversityDB->profiles;
		$UserIdPara = $_GET['UserId'];
		$user = $collection->findOne(['UserId'=>$UserIdPara]);
		$new_val=$_POST['Delete_Teaching_Interest'];
		$new_interests=array();
		
		if(isset($user['Teaching_Interests'])){
			$research_interests=$user['Teaching_Interests'];
		}
		else{
			$research_interests=array();
		}
		if (is_array($research_interests) || is_object($research_interests)){
			$cnt=0;
		foreach($research_interests as $news){
			$cnt=$cnt + 1;
			if($cnt!=$new_val){
				$new_interests[]=$news;
			}
		}}	
		$updateResult = $collection->updateOne(
			[ 'UserId' => $UserIdPara ],
			[ '$set' => [ 'Teaching_Interests' => $new_interests ]]
		);
	}
	else if(array_key_exists('button16', $_POST)) { 
		//delete news
		$UserIdPara = $_GET['UserId'];
		$collection = (new MongoDB\Client)->YJUniversityDB->profiles;
		$new_research_interest=$_POST['New_Teaching_Interest'];
		$user = $collection->findOne(['UserId'=>$UserIdPara]);
		
		if(isset($user['Teaching_Interests'])){
			$research_interests=$user['Teaching_Interests'];
		}else{
			$research_interests=array();
		}
		//var_dump($new_news);
		$research_interests[]=$new_research_interest;
		//var_dump($latest_news);

			
		$updateResult = $collection->updateOne(
			[ 'UserId' => $UserIdPara ],
			[ '$set' => [ 'Teaching_Interests' => $research_interests ]]
		);
	}
	else if(array_key_exists('button17', $_POST)) { 
		//delete news
		$collection = (new MongoDB\Client)->YJUniversityDB->profiles;
		$UserIdPara = $_GET['UserId'];
		$user = $collection->findOne(['UserId'=>$UserIdPara]);
		$new_val=$_POST['Delete_Project'];
		$new_interests=array();
		
		if(isset($user['Projects'])){
			$research_interests=$user['Projects'];
		}
		else{
			$research_interests=array();
		}
		if (is_array($research_interests) || is_object($research_interests)){
			$cnt=0;
		foreach($research_interests as $news){
			$cnt=$cnt + 1;
			if($cnt!=$new_val){
				$new_interests[]=$news;
			}
		}}	
		$updateResult = $collection->updateOne(
			[ 'UserId' => $UserIdPara ],
			[ '$set' => [ 'Projects' => $new_interests ]]
		);
	}
	else if(array_key_exists('button18', $_POST)) { 
		//delete news
		$UserIdPara = $_GET['UserId'];
		$collection = (new MongoDB\Client)->YJUniversityDB->profiles;
		$new_project=[
			'Title' => $_POST['New_Project_Title'],
			'Link' => $_POST['New_Project_Link'],
			'Description' => $_POST['New_Project_Description'],
			'Time_Begin' => $_POST['New_Project_Time_Begin'],
			'Time_End' => $_POST['New_Project_Time_End'],
		];
		//var_dump($new_project);

		$user = $collection->findOne(['UserId'=>$UserIdPara]);
		
		if(isset($user['Projects'])){
			$projects=$user['Projects'];
		}else{
			$projects=array();
		}
		$projects[] =$new_project;
		$updateResult = $collection->updateOne(
			[ 'UserId' => $UserIdPara ],
			[ '$set' => [ 'Projects' => $projects ]]
		);
	}
	else if(array_key_exists('button19', $_POST)) { 
		//delete news
		$collection = (new MongoDB\Client)->YJUniversityDB->profiles;
		$UserIdPara = $_GET['UserId'];
		$user = $collection->findOne(['UserId'=>$UserIdPara]);
		$new_val=$_POST['Delete_Paper'];
		$new_interests=array();
		
		if(isset($user['Research_Outputs'])){
			$research_outputs=$user['Research_Outputs'];
			if(isset($research_outputs['Conference_Papers']))
				$conference_papers=$research_outputs['Conference_Papers'];
			else
			$conference_papers=array();
		}
		else{
			$conference_papers=array();
		}
		$new_conference_papers=array();
		if (is_array($conference_papers) || is_object($conference_papers)){
			$cnt=0;
		foreach($conference_papers as $paper){
			$cnt=$cnt + 1;
			if($cnt!=$new_val){
				$new_conference_papers[]=$paper;
			}
		}}
			
		$research_outputs['Conference_Papers']=$new_conference_papers;
		$updateResult = $collection->updateOne(
			[ 'UserId' => $UserIdPara ],
			[ '$set' => [ 'Research_Outputs' => $research_outputs ]]
		);
	}


	else if(array_key_exists('button20', $_POST)) { 
		//delete news
		$UserIdPara = $_GET['UserId'];
		$collection = (new MongoDB\Client)->YJUniversityDB->profiles;
		$UserIdPara = $_GET['UserId'];
		$user = $collection->findOne(['UserId'=>$UserIdPara]);
		$new_interests=array();
		
		if(isset($user['Research_Outputs'])){
			$research_outputs=$user['Research_Outputs'];
			if(isset($research_outputs['Conference_Papers']))
				$conference_papers=$research_outputs['Conference_Papers'];
			else
			$conference_papers=array();
		}
		else{
			$research_outputs;
			$conference_papers=array();
		}
		$new_paper=[
			'Paper_Title' => $_POST['New_Paper_Title'],
			'Conference_Title' => $_POST['New_Conference_Paper_Title'],
			'Link' => $_POST['New_Paper_Link'],
			'Description' => $_POST['New_Paper_Description'],
			'Time' => $_POST['New_Paper_Time'],
			'Citations' => $_POST['New_Paper_Citations'],
		];

		//var_dump($new_news);
		$conference_papers[]=$new_paper;
		$research_outputs['Conference_Papers']=$conference_papers;
		//var_dump($latest_news);

	
		$updateResult = $collection->updateOne(
			[ 'UserId' => $UserIdPara ],
			[ '$set' => [ 'Research_Outputs' => $research_outputs ]]
		);
	}

	else if(array_key_exists('button21', $_POST)) { 
		//delete news
		$collection = (new MongoDB\Client)->YJUniversityDB->profiles;
		$UserIdPara = $_GET['UserId'];
		$user = $collection->findOne(['UserId'=>$UserIdPara]);
		$new_val=$_POST['Delete_Article'];
		$new_interests=array();
		
		if(isset($user['Research_Outputs'])){
			$research_outputs=$user['Research_Outputs'];
			if(isset($research_outputs['Articles']))
				$articles=$research_outputs['Articles'];
			else
			$articles=array();
		}
		else{
			$articles=array();
		}
		$new_articles=array();
		if (is_array($articles) || is_object($articles)){
			$cnt=0;
		foreach($articles as $article){
			$cnt=$cnt + 1;
			if($cnt!=$new_val){
				$new_articles[]=$article;
			}
		}}
			
		$research_outputs['Articles']=$new_conference_papers;
		$updateResult = $collection->updateOne(
			[ 'UserId' => $UserIdPara ],
			[ '$set' => [ 'Research_Outputs' => $research_outputs ]]
		);
	}


	else if(array_key_exists('button22', $_POST)) { 
		//delete news
		$UserIdPara = $_GET['UserId'];
		$collection = (new MongoDB\Client)->YJUniversityDB->profiles;
		$UserIdPara = $_GET['UserId'];
		$user = $collection->findOne(['UserId'=>$UserIdPara]);
		
		if(isset($user['Research_Outputs'])){
			$research_outputs=$user['Research_Outputs'];
			if(isset($research_outputs['Articles']))
				$articles=$research_outputs['Articles'];
			else
			$articles=array();
		}
		else{
			$research_outputs;
			$articles=array();
		}
		$new_article=[
			'Title' => $_POST['New_Article_Title'],
			'Conference_Title' => $_POST['New_Conference_Article_Title'],
			'Link' => $_POST['New_Article_Link'],
			'Description' => $_POST['New_Article_Description'],
			'Time' => $_POST['New_Article_Time'],
		];

		//var_dump($new_news);
		$articles[]=$new_article;
		$research_outputs['Articles']=$articles;
		//var_dump($latest_news);

	
		$updateResult = $collection->updateOne(
			[ 'UserId' => $UserIdPara ],
			[ '$set' => [ 'Research_Outputs' => $research_outputs ]]
		);
	}

	else if(array_key_exists('button23', $_POST)) { 
		//delete news
		$collection = (new MongoDB\Client)->YJUniversityDB->profiles;
		$UserIdPara = $_GET['UserId'];
		$user = $collection->findOne(['UserId'=>$UserIdPara]);
		$new_val=$_POST['Delete_Other'];
		$new_interests=array();
		
		if(isset($user['Research_Outputs'])){
			$research_outputs=$user['Research_Outputs'];
			if(isset($research_outputs['Others']))
				$articles=$research_outputs['Others'];
			else
			$others=array();
		}
		else{
			$others=array();
		}
		$new_others=array();
		if (is_array($others) || is_object($others)){
			$cnt=0;
		foreach($others as $other){
			$cnt=$cnt + 1;
			if($cnt!=$new_val){
				$new_others[]=$other;
			}
		}}
			
		$research_outputs['Others']=$new_others;
		$updateResult = $collection->updateOne(
			[ 'UserId' => $UserIdPara ],
			[ '$set' => [ 'Research_Outputs' => $research_outputs ]]
		);
	}


	else if(array_key_exists('button24', $_POST)) { 
		//delete news
		$UserIdPara = $_GET['UserId'];
		$collection = (new MongoDB\Client)->YJUniversityDB->profiles;
		$UserIdPara = $_GET['UserId'];
		$user = $collection->findOne(['UserId'=>$UserIdPara]);
		$new_val=$_POST['Delete_Project'];
		$new_interests=array();
		
		if(isset($user['Research_Outputs'])){
			$research_outputs=$user['Research_Outputs'];
			if(isset($research_outputs['Others']))
				$others=$research_outputs['Others'];
			else
			$others=array();
		}
		else{
			$research_outputs;
			$others=array();
		}
		$new_other=[
			'Title' => $_POST['New_Others_Title'],
			'Link' => $_POST['New_Others_Link'],
			'Description' => $_POST['New_Others_Description'],
			'Time' => $_POST['New_Others_Time'],
		];

		//var_dump($new_news);
		$others[]=$new_other;
		$research_outputs['Others']=$others;
		//var_dump($latest_news);

	
		$updateResult = $collection->updateOne(
			[ 'UserId' => $UserIdPara ],
			[ '$set' => [ 'Research_Outputs' => $research_outputs ]]
		);
	}

	else if(array_key_exists('button25', $_POST)) { 
		//delete news
		//start here
		$collection = (new MongoDB\Client)->YJUniversityDB->profiles;
		$UserIdPara = $_GET['UserId'];
		$user = $collection->findOne(['UserId'=>$UserIdPara]);
		$new_val=$_POST['Delete_Prize'];
		$new_interests=array();
		
		if(isset($user['Prizes'])){
			$prizes=$user['Prizes'];
		}
		else{
			$prizes=array();
		}
		$new_prizes=array();
		if (is_array($prizes) || is_object($prizes)){
			$cnt=0;
		foreach($prizess as $Prize){
			$cnt=$cnt + 1;
			if($cnt!=$new_val){
				$new_prizes[]=$prize;
			}
		}}
			
		$updateResult = $collection->updateOne(
			[ 'UserId' => $UserIdPara ],
			[ '$set' => [ 'Prizes' => $new_prizes ]]
		);
	}


	else if(array_key_exists('button26', $_POST)) { 
		//delete news
		$UserIdPara = $_GET['UserId'];
		$collection = (new MongoDB\Client)->YJUniversityDB->profiles;
		$UserIdPara = $_GET['UserId'];
		$user = $collection->findOne(['UserId'=>$UserIdPara]);
		
		if(isset($user['Prizes'])){
			$prizes=$user['Prizes'];
		}
		else{
			$prizes=array();
		}
		$new_prize=[
			'Title' => $_POST['New_Prize_Title'],
			'Time' => $_POST['New_Prize_Time'],
		];

		//var_dump($new_news);
		$prizes[]=$new_prize;
	
		$updateResult = $collection->updateOne(
			[ 'UserId' => $UserIdPara ],
			[ '$set' => [ 'Prizes' => $prizes ]]
		);
	}

	else if(array_key_exists('button27', $_POST)) { 
		//delete news
		$collection = (new MongoDB\Client)->YJUniversityDB->profiles;
		$UserIdPara = $_GET['UserId'];
		$user = $collection->findOne(['UserId'=>$UserIdPara]);
		$new_val=$_POST['Delete_Other_Link'];
		$new_interests=array();
		
		if(isset($user['Other_Links'])){
			$research_interests=$user['Other_Links'];
		}
		else{
			$research_interests=array();
		}
		if (is_array($research_interests) || is_object($research_interests)){
			$cnt=0;
		foreach($research_interests as $news){
			$cnt=$cnt + 1;
			if($cnt!=$new_val){
				$new_interests[]=$news;
			}
		}}
			
		$updateResult = $collection->updateOne(
			[ 'UserId' => $UserIdPara ],
			[ '$set' => [ 'Other_Links' => $new_interests ]]
		);
	}
	else if(array_key_exists('button28', $_POST)) { 
		//delete news
		$UserIdPara = $_GET['UserId'];
		$collection = (new MongoDB\Client)->YJUniversityDB->profiles;
		$new_research_interest=$_POST['New_Other_Link'];
		$user = $collection->findOne(['UserId'=>$UserIdPara]);
		
		if(isset($user['Other_Links'])){
			$research_interests=$user['Other_Links'];
		}else{
			$research_interests=array();
		}
		//var_dump($new_news);
		$research_interests[]=$new_research_interest;
		//var_dump($latest_news);

			
		$updateResult = $collection->updateOne(
			[ 'UserId' => $UserIdPara ],
			[ '$set' => [ 'Other_Links' => $research_interests ]]
		);
	}


	function update($a){
		//TODO check permission here
		$UserIdPara = $_GET['UserId'];
		$a();
//		echo"<h1>Updated</1>";
//		$link = "profile.php?UserId=".$UserIdPara;
//		echo"<a href='$link'><h4>Click here to see updated profile</h4></a>";
	}
	function button1fun() {
		$new_val=$_POST['New_Name']; 
		$UserIdPara = $_GET['UserId'];
		$collection = (new MongoDB\Client)->YJUniversityDB->profiles;	
		$updateResult = $collection->updateOne(
			[ 'UserId' => $UserIdPara ],
			[ '$set' => [ 'Name' => $new_val ]]
		);
	}
	function button2fun() {
		$new_val=$_POST['New_Position']; 
		$UserIdPara = $_GET['UserId'];
		$collection = (new MongoDB\Client)->YJUniversityDB->profiles;	
		$updateResult = $collection->updateOne(
			[ 'UserId' => $UserIdPara ],
			[ '$set' => [ 'Position' => $new_val ]]
		);
	}
	function button3fun() {
		$UserIdPara = $_GET['UserId'];
		$new_val=$_POST['New_Lab']; 
		$collection = (new MongoDB\Client)->YJUniversityDB->profiles;	
		$updateResult = $collection->updateOne(
			[ 'UserId' => $UserIdPara ],
			[ '$set' => [ 'Lab' => $new_val ]]
		);
	}
	function button4fun() {
		$UserIdPara = $_GET['UserId'];
		$new_val=$_POST['New_Headline']; 
		$collection = (new MongoDB\Client)->YJUniversityDB->profiles;	
		$updateResult = $collection->updateOne(
			[ 'UserId' => $UserIdPara ],
			[ '$set' => [ 'Headline' => $new_val ]]
		);
	}
	function button5fun() {
		$UserIdPara = $_GET['UserId'];
		$new_val=$_POST['New_EmailId']; 
		$collection = (new MongoDB\Client)->YJUniversityDB->profiles;	
		$updateResult = $collection->updateOne(
			[ 'UserId' => $UserIdPara ],
			[ '$set' => [ 'EmailId' => $new_val ]]
		);
	}
	function button6fun() {
		$UserIdPara = $_GET['UserId'];
		$new_val=$_POST['New_Linkedin_Link']; 
		$collection = (new MongoDB\Client)->YJUniversityDB->profiles;	
		$updateResult = $collection->updateOne(
			[ 'UserId' => $UserIdPara ],
			[ '$set' => [ 'Linkedin_Link' => $new_val ]]
		);
	}
	function button7fun() {
		$UserIdPara = $_GET['UserId'];
		$new_val=$_POST['New_Google_Scholar_Link']; 
		$collection = (new MongoDB\Client)->YJUniversityDB->profiles;	
		$updateResult = $collection->updateOne(
			[ 'UserId' => $UserIdPara ],
			[ '$set' => [ 'Google_Scholar_Link' => $new_val ]]
		);
	}
	function button8fun() {
		$UserIdPara = $_GET['UserId'];
		$new_val=$_POST['New_Note']; 
		$collection = (new MongoDB\Client)->YJUniversityDB->profiles;	
		$updateResult = $collection->updateOne(
			[ 'UserId' => $UserIdPara ],
			[ '$set' => [ 'Note' => $new_val ]]
		);
	}
	function button9fun() {
		$UserIdPara = $_GET['UserId'];
		$new_val=$_POST['New_About_Me']; 
		$collection = (new MongoDB\Client)->YJUniversityDB->profiles;	
		$updateResult = $collection->updateOne(
			[ 'UserId' => $UserIdPara ],
			[ '$set' => [ 'About_Me' => $new_val ]]
		);
	}
	function button10fun() {
		$UserIdPara = $_GET['UserId'];
		$new_val=$_POST['New_Collaboration']; 
		$collection = (new MongoDB\Client)->YJUniversityDB->profiles;	
		$updateResult = $collection->updateOne(
			[ 'UserId' => $UserIdPara ],
			[ '$set' => [ 'Collaboration' => $new_val ]]
		);
	}
?>
	<div class='container' style='background-color:white;margin-top:1%;border-radius: 10px;'>
	<br>
	<form method="post" enctype="multipart/form-data">
    Select image to upload:
    	<input type="file" name="fileToUpload" id="fileToUpload">
    	<input type="submit" value="Upload Image" class="button" name="buttonimage">
	</form>
	<hr>
	<form method="post">
		New Name:<br> 
		<input type = "text" name="New_Name">
        <input type="submit" name="button1" class="button" value="submit"/><br><hr> 
		New Position:<br> 
		<input type = "text" name="New_Position">
        <input type="submit" name="button2" class="button" value="submit"/><br><hr>
		New Lab:<br> 
		<input type = "text" name="New_Lab">
        <input type="submit" name="button3" class="button" value="submit"/><br><hr>
		New Headline:<br> 
		<input type = "text" name="New_Headline">
        <input type="submit" name="button4" class="button" value="submit"/><br><hr>
		New EmailId:<br> 
		<input type = "text" name="New_EmailId">
        <input type="submit" name="button5" class="button" value="submit"/><br><hr>
		New Linkedin Link:<br> 
		<input type = "text" name="New_Linkedin_Link">
        <input type="submit" name="button6" class="button" value="submit"/><br><hr>
		New Google Scholar Link:<br> 
		<input type = "text" name="New_Google_Scholar_Link">
        <input type="submit" name="button7" class="button" value="submit"/><br><hr>
		New Note:<br> 
		<input type = "textarea" name="New_Note">
        <input type="submit" name="button8" class="button" value="submit"/><br><hr>
		New About Me:<br> 
		<input type = "text" name="New_About_Me">
        <input type="submit" name="button9" class="button" value="submit"/><br><hr>
		New Collaboration Note:<br> 
		<input type = "text" name="New_Collaboration">
        <input type="submit" name="button10" class="button" value="submit"/><br><hr>
		<?php 
			$collection = (new MongoDB\Client)->YJUniversityDB->profiles;
			$UserIdPara = $_GET['UserId'];
			$user = $collection->findOne(['UserId'=>$UserIdPara]);
			$latest_news=$user['Latest_News'];
			$research_interests=$user['Research_Interests'];
			$teaching_interests=$user['Teaching_Interests'];

			if (is_array($latest_news)  || is_object($latest_news)){
				$cnt=0;
			foreach($latest_news as $news){
				$cnt=$cnt + 1;
				$news_link=$news['Link'];
				$news_headline=$news['Headline'];
				if($news['Link']==NULL)
					$news_link=NULL;
				echo"$cnt : $news_headline<br>";

			}
			if($cnt==0){
				echo"No News Previously.<br><hr>";
			}
			else{
			echo"Delete News Number<input type = 'text' name='Delete_News'>
			<input type='submit' name='button11' class='button' value='delete'/><br><hr>";
			}}
			else{
				echo"No News Previously.<br><hr>";
			}
			echo" Add New News:<br> 
			Headline:<input type = 'text' name='New_News_Headline'><br>
			Link:<input type = 'text' name='New_News_Link'>
			<input type='submit' name='button12' class='button' value='Add'/><br><hr>
			
			";

			
			if (is_array($research_interests)  || is_object($research_interests)){
				$cnt=0;
			foreach($research_interests as $news){
				$cnt=$cnt + 1;
				echo"$cnt : $news<br>";
			}
			if($cnt==0){
				echo"No Research Interests Previously.<br><hr>";
			}
			else{
			echo"Delete Research Interest Number<input type = 'text' name='Delete_Research_Interest'>
			<input type='submit' name='button13' class='button' value='delete'/><br><hr>";
			}}
			else{
				echo"No Research Interests Previously.<br><hr>";
			}
			echo" Add New Research Interest:<br> 
			Title:<input type = 'text' name='New_Research_Interest'>
			<input type='submit' name='button14' class='button' value='Add'/><br><hr>
			";

			
			if (is_array($teaching_interests)  || is_object($teaching_interests)){
				$cnt=0;
			foreach($teaching_interests as $news){
				$cnt=$cnt + 1;
				echo"$cnt : $news<br>";
			}
			if($cnt==0){
				echo"No Teaching Interests Previously.<br><hr>";
			}
			else{
			echo"Delete Teaching Interest Number<input type = 'text' name='Delete_Teaching_Interest'>
			<input type='submit' name='button15' class='button' value='delete'/><br><hr>";
			}}
			else{
				echo"No Teaching Interests Previously.<br><hr>";
			}
			echo" Add New Teaching Interest:<br> 
			Title:<input type = 'text' name='New_Teaching_Interest'>
			<input type='submit' name='button16' class='button' value='Add'/><br><hr>
			";

			
/*
			if (is_array($teaching_interests)  || is_object($teaching_interests)){
				$cnt=0;
			foreach($teaching_interests as $news){
				$cnt=$cnt + 1;
				echo"$cnt : $news<br>";
			}
			if($cnt==0){
				echo"No Teaching Interests Previously.<br><hr>";
			}
			else{
			echo"Delete Teaching Interest Number<input type = 'text' name='Delete_News'>
			<input type='submit' name='button17' class='button' value='delete'/><br><hr>";
			}}
			else{
				echo"No Teaching Interests Previously.<br><hr>";
			}
			echo" Add New Teaching Interest:<br> 
			Title:<input type = 'text' name='New_News_Link'>
			<input type='submit' name='button18' class='button' value='Add'/><br><hr>
			";
*/
			
			$projects=$user['Projects'];
			$research_outputs=$user['Research_Outputs'];
			$conference_papers=$research_outputs['Conference_Papers'];
			$articles=$research_outputs['Articles'];
			$others=$research_outputs['Others'];
			$prizes=$user['Prizes'];
			$other_links=$user['Other_Links'];

			if (is_array($projects)  || is_object($projects)){
				$cnt=0;
			foreach($projects as $news){
				$cnt=$cnt + 1;
				$title=$news['Title'];
				echo"$cnt : $title<br>";
			}
			if($cnt==0){
				echo"No Projects Previously.<br><hr>";
			}
			else{
			echo"Delete Projects Number<input type = 'text' name='Delete_Project'>
			<input type='submit' name='button17' class='button' value='delete'/><br><hr>";
			}}
			else{
				echo"No Projects Previously.<br><hr>";
			}
			echo" Add New Projects:<br> 
			Title:<input type = 'text' name='New_Project_Title'><br>
			Link:<input type = 'text' name='New_Project_Link'><br>
			Description:<input type = 'textarea' name='New_Project_Description'><br>
			Time Begin:<input type = 'date' name='New_Project_Time_Begin'><br>
			Time End:<input type = 'date' name='New_Project_Time_End'>
			<input type='submit' name='button18' class='button' value='Add'/><br><hr>
			";

			
			if (is_array($conference_papers)  || is_object($conference_papers)){
				$cnt=0;
			foreach($conference_papers as $news){
				$cnt=$cnt + 1;
				$title=$news['Paper_Title'];
				echo"$cnt : $title<br>";
			}
			if($cnt==0){
				echo"No Conference Papers Previously.<br><hr>";
			}
			else{
			echo"Delete Conference Papers Number<input type = 'text' name='Delete_Paper'>
			<input type='submit' name='button19' class='button' value='delete'/><br><hr>";
			}}
			else{
				echo"No Conference Papers Previously.<br><hr>";
			}
			echo" Add New Paper:<br> 
			Paper Title:<input type = 'text' name='New_Paper_Title'><br>
			Paper Conference Title:<input type = 'text' name='New_Conference_Paper_Title'><br>
			Link:<input type = 'text' name='New_Paper_Link'><br>
			Description:<input type = 'textarea' name='New_Paper_Description'><br>
			Time:<input type = 'date' name='New_Paper_Time'><br>
			Citations:<input type = 'text' name='New_Paper_Citations'>
			
			<input type='submit' name='button20' class='button' value='Add'/><br><hr>
			";

			
			if (is_array($artices)  || is_object($articles)){
				$cnt=0;
			foreach($articles as $news){
				$cnt=$cnt + 1;
				$title=$news['Title'];
				echo"$cnt : $title<br>";
			}
			if($cnt==0){
				echo"No Articles Previously.<br><hr>";
			}
			else{
			echo"Delete Articles Number<input type = 'text' name='Delete_Article'>
			<input type='submit' name='button21' class='button' value='delete'/><br><hr>";
			}}
			else{
				echo"No Articles Previously.<br><hr>";
			}
			echo" Add New Article:<br> 
			Article Title:<input type = 'text' name='New_Article_Title'><br>
			Paper Conference Title:<input type = 'text' name='New_Conference_Article_Title'><br>
			Link:<input type = 'text' name='New_Article_Link'><br>
			Description:<input type = 'textarea' name='New_Article_Description'><br>
			Time:<input type = 'date' name='New_Article_Time'>
			
			<input type='submit' name='button22' class='button' value='Add'/><br><hr>
			";

			
			if (is_array($others)  || is_object($others)){
				$cnt=0;
			foreach($others as $news){
				$cnt=$cnt + 1;
				$title=$news['Paper_Title'];
				echo"$cnt : $title<br>";
			}
			if($cnt==0){
				echo"No Other Research Outputs Previously.<br><hr>";
			}
			else{
			echo"Delete Other Research Output Number<input type = 'text' name='Delete_Other'>
			<input type='submit' name='button23' class='button' value='delete'/><br><hr>";
			}}
			else{
				echo"No Other Research Outputs Previously.<br><hr>";
			}
			echo" Add New Other Research Output:<br> 
			Title:<input type = 'text' name='New_Others_Title'><br>
			Link:<input type = 'text' name='New_Others_Link'><br>
			Description:<input type = 'textarea' name='New_Others_Description'><br>
			Time:<input type = 'date' name='New_Others_Time'>			
			<input type='submit' name='button24' class='button' value='Add'/><br><hr>
			";

			
			

			if (is_array($prizes)  || is_object($prizes)){
				$cnt=0;
			foreach($prizes as $news){
				$cnt=$cnt + 1;
				$title=$news['Title'];
				echo"$cnt : $title <br>";
			}
			if($cnt==0){
				echo"No Prizes Previously.<br><hr>";
			}
			else{
			echo"Delete Prizes Number<input type = 'text' name='Delete_Prize'>
			<input type='submit' name='button25' class='button' value='delete'/><br><hr>";
			}}
			else{
				echo"No Prizess Previously.<br><hr>";
			}
			echo" Add New Prizes:<br> 
			Title:<input type = 'text' name='New_Prize_Title'><br>
			Time:<input type = 'date' name='New_Prize_Time'>
			<input type='submit' name='button26' class='button' value='Add'/><br><hr>
			";
			
			if (is_array($other_links)  || is_object($other_links)){
				$cnt=0;
			foreach($other_links as $news){
				$cnt=$cnt + 1;
				echo"$cnt : $news<br>";
			}
			if($cnt==0){
				echo"No Other Links  Previously.<br><hr>";
			}
			else{
			echo"Delete Other Links Number<input type = 'text' name='Delete_Other_Link'>
			<input type='submit' name='button27' class='button' value='delete'/><br><hr>";
			}}
			else{
				echo"No Other Links Previously.<br><hr>";
			}
			echo" Add New Other Link:<br> 
			Link:<input type = 'text' name='New_Other_Link'>
			<input type='submit' name='button28' class='button' value='Add'/><br><hr>
			";

				
		?>
	</form> 
	</div>
</body>
</html>



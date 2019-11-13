<?php
  require("dash_head_admin.php");
  require "postgreCon.php";
  if($db==false) {
		header ("Location: error.php");
		exit();
	}
  if(array_key_exists('AddBtn', $_POST)  ) {
    try{
    $query = "INSERT INTO credentials(Username,Password) VALUES ('"
              .$_POST['userId']."','"
              .password_hash($_POST['password'],PASSWORD_DEFAULT)
              ."');";
    //echo $query;
    
    $result = pg_query($db, $query.";");
    if(!$ret) {
      // echo pg_last_error($db);
      $query = "select password from credentials where username = '".$_POST['userId']."';";
		  $result = pg_query($db, $query.";");
      $count = pg_num_rows($result);
      if($count==1){
        echo "<script type='text/javascript'>alert('Username Exists!!');</script>";
      }
   } else {
    echo "<script type='text/javascript'>alert('New User Added!!');</script>";

   }
    }
    catch(\PDOException $e){
        echo $e->getMessage();
    }
  }
  
?>
<script>
function getUsers(dept){
    //alert(dept+user);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function(){
      //alert("request completed")
      if(this.readyState ==4 && this.status==200){
        var len = this.response.length;

            for(var i=0; i<len; i++){
                var img = "&ensp; &ensp;<img src='Res/Image/cross.jpg' class='img-thumbnail' alt='X' style='max-width: 3%;height: auto' onclick='deleteUser(\""+dept+"\",\""+this.response[i]+"\")'></td>";
                alert(img);
                var tr_str = "<tr>" +
                    "<td>" +this.response[i]+ img +
                    "</tr>";
                  //  $("#userTable tbody").remove();
                $("#userTable tbody").append(tr_str);
            }
      }
    }
    xmlhttp.open("GET","get_users.inc.php?dept="+dept,true);
    xmlhttp.responseType = 'json';
    xmlhttp.send();
}

function deleteUser(dept,user){
    alert(dept+user);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function(){
      //alert("request completed")
      if(this.readyState ==4 && this.status==200){
        window.location.href="delete_user.php"; 
      }
    }
    xmlhttp.open("GET","delete_users.inc.php?username="+user,true);
    xmlhttp.responseType = 'json';
    xmlhttp.send();
}

function highlightCSE() {
  getUsers('CSE',null);
  document.getElementById("cse_span").className = "nav-link active";
  document.getElementById("me_span").className = "nav-link";
  document.getElementById("ee_span").className = "nav-link";
}
function highlightME() {
  getUsers('ME',null);
  document.getElementById("cse_span").className = "nav-link";
  document.getElementById("me_span").className = "nav-link active";
  document.getElementById("ee_span").className = "nav-link";
}
function highlightEE() {
  getUsers('EE',null);
  document.getElementById("cse_span").className = "nav-link";
  document.getElementById("me_span").className = "nav-link";
  document.getElementById("ee_span").className = "nav-link active";
}
</script>
  <div id="content-wrapper">
        <div class="container-fluid">
        <h6>Select department:</h6>
        <ul class="nav nav-pills nav-justified">
        
    		<li class="nav-item"><span class="nav-link" id="cse_span" onclick="highlightCSE('CSE',null)">CSE</span></li>
    		<li class="nav-item"><span class="nav-link" id="me_span" onclick="highlightME('ME',null)">ME</span></li>
        <li class="nav-item"><span class="nav-link" id="ee_span" onclick="highlightEE('EE',null)">EE</span></li>
        <li class="nav-item"></li>
        <li class="nav-item"></li>
  		</ul><br>
      <div class="container">
   <table id="userTable" border="0" >
      <thead>
        
      </thead>
      <tbody></tbody>
   </table>
</div>
    </div>
    </div>

    
    <script>
		$(".sidebar li:eq(2)").addClass(" active ");
	</script>
	
<?php
  require("dash_foot.php");
?>

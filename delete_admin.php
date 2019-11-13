<?php
  require("dash_head_admin.php");
  require "postgreCon.php";
  if($db==false) {
		header ("Location: error.php");
		exit();
  }
  session_start();
?>
<script>
function deleteAdmin(user){
    //alert(dept+user);
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function(){
      //alert("request completed")
      if(this.readyState ==4 && this.status==200){
        window.location.href="delete_admin.php"; 
      }
    }
    xmlhttp.open("GET","delete_users.inc.php?username="+user,true);
    xmlhttp.responseType = 'json';
    xmlhttp.send();
}
</script>
  <div id="content-wrapper">
        <div class="container-fluid">
        
      <div class="container">
   <table id="userTable" border="0" >
      <thead>
      <?php
      $query = "select username,power from admins";
      $result = pg_query($db,$query);
      $count = pg_num_rows($result);
      while($count!=0){
        $count=$count-1;
        $row=pg_fetch_row($result);
        $username=$row[0];
        $power=$row[1];
        if($power==1){
          $img = "&ensp; &ensp;<img src='Res/Image/cross.jpg' class='img-thumbnail' alt='X' style='max-width: 3%;height: auto' onclick='deleteAdmin(\"".$username."\")'></td>";
          $tr_str = "<tr>"."<td>".$username.$img."</tr>";
          echo $tr_str;
        }
      }
      ?>
      </thead>
      <tbody></tbody>
   </table>
</div>
    </div>
    </div>

    
    <script>
		$(".sidebar li:eq(6)").addClass(" active ");
	</script>
	
<?php
  require("dash_foot.php");
?>

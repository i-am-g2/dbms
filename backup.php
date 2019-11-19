<?php
  require("dash_head_admin.php");
  if(!isset($_SESSION['power']) || $_SESSION['power']==1){
    header ("Location: error.php");
  }
  require "postgreCon.php";
  if($db==false) {
		header ("Location: error.php");
		exit();
  }
  if(array_key_exists('Backup', $_POST)  ) {
    putenv("PGPASSWORD=" . "NxG56jsFXcfg");
    // facultysys user=myprojectuser
    $dumpcmd = array("pg_dump", "-i", "-U", "myprojectuser", "-F", "c", "-b", "-v", "-f", "/home/stylo/dbackup.tar", "facultysys");
    $cmd="pg_dump -U myprojectuser -F t facultysys > /tmp/dbackup.tar";
//    exec( join(' ', $dumpcmd), $cmdout, $cmdresult );
    $res=exec($cmd);
  putenv("PGPASSWORD");
  }
  if(array_key_exists('Restore', $_POST)  ) {
    putenv("PGPASSWORD=" . "NxG56jsFXcfg");
    $cmd="pg_restore -d facultysys /tmp/dbackup.tar -c -U myprojectuser";
    $res=exec($cmd);
    putenv("PGPASSWORD");
  }
?>

  <div id="content-wrapper">
    <div class="container-fluid">
      <form class="login-form" method="post">
        
        <button name="Backup" class="btn btn-primary">Backup</button>
        <br><br>
        <button name="Restore" class="btn btn-primary">Restore</button>
      </form>        
    </div>
  </div>
    

    
    <script>
		$(".sidebar li:eq(10)").addClass(" active ");
	</script>
	
<?php
  require("dash_foot.php");
?>

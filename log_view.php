<?php
  require("dash_head_admin.php");
  require ("postgreCon.php");
  $query = "select * from logs;";
  $result = pg_query( $db,$query);

?>
  <div id="content-wrapper">
        <div class="container-fluid">
		<ul class="list-group" id="past_list">
				<?php 
					while($row  = pg_fetch_row($result) ) {
						echo "<li class='list-group-item'>";
						echo "<p>".date_format(date_create($row['0']) , "G:i d M y"). " &nbsp&nbsp&nbsp&nbsp&nbsp|&nbsp&nbsp&nbsp&nbsp&nbsp ".$row['1'];
						// echo "<p>".$row['1']."</p>";
						echo "</li>";
					}

				?>
			

			</ul>

          
      </div>
    </div>
    
    <script>
		$(".sidebar li:eq(8)").addClass(" active ");
	</script>
	
<?php
  require("dash_foot.php");
?>

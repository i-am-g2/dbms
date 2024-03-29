<?php
  require("dash_head_admin.php");
  require("application_routes.php");
  require "postgreCon.php";
  if($db==false) {
		header ("Location: error.php");
		exit();
    }
  //  echo getRouteFromUsername($db,"yogesh");
  if(array_key_exists('CSE_FAC_Btn', $_POST)  ) {
    //  echo "update cse fac";
    setRoute($db,'CSE_FAC',$_POST['CSE_FAC_VAL'],$_SESSION['userId']);
  }
  if(array_key_exists('EE_FAC_Btn', $_POST)  ) {
    //  echo "update cse fac";
    setRoute($db,'EE_FAC',$_POST['EE_FAC_VAL'],$_SESSION['userId']);
  }
  if(array_key_exists('ME_FAC_Btn', $_POST)  ) {
    //  echo "update cse fac";
    setRoute($db,'ME_FAC',$_POST['ME_FAC_VAL'],$_SESSION['userId']);
  }
  if(array_key_exists('CSE_HOD_Btn', $_POST)  ) {
    //  echo "update cse fac";
    setRoute($db,'CSE_HOD',$_POST['CSE_HOD_VAL'],$_SESSION['userId']);
  }
  if(array_key_exists('ME_HOD_Btn', $_POST)  ) {
    //  echo "update cse fac";
    setRoute($db,'ME_HOD',$_POST['ME_HOD_VAL'],$_SESSION['userId']);
  }
  if(array_key_exists('EE_HOD_Btn', $_POST)  ) {
    //  echo "update cse fac";
    setRoute($db,'EE_HOD',$_POST['EE_HOD_VAL'],$_SESSION['userId']);
  }
  if(array_key_exists('DFA_Btn', $_POST)  ) {
    //  echo "update cse fac";
    setRoute($db,'DFA',$_POST['DFA_VAL'],$_SESSION['userId']);
  }
  if(array_key_exists('ADFA_Btn', $_POST)  ) {
    //  echo "update cse fac";
    setRoute($db,'ADFA_HOD',$_POST['ADFA_VAL'],$_SESSION['userId']);
  }
  if(array_key_exists('Defaults_Btn', $_POST)  ) {
    //  echo"set defaults";
    setDefaultRoutes($db,$_SESSION['userId']);
  }
  if(array_key_exists('Approved_Btn', $_POST)  ) {
    //  echo"set defaults";
    setAllRoutesDisabled($db,$_SESSION['userId']);
  }
  
  
?>
  <div id="content-wrapper">
    <div class="container-fluid">
      <div class="login-page">    
        <div class="form">
        <form class="login-form" method="post">
        <br> <div class="form-group">
                <div class = "row">
                    <div class = "col-sm-4"><label for="CSE_FAC">Select Destination for CSE Faculty:</label></div>
                    <div class = "col-sm-4"><select class="form-control" id="CSE_FAC" name="CSE_FAC_VAL">
                        <option value="CSE_HOD">HOD CSE</option>
                        <option value="DFA">DFA</option>
                        <option value="ADFA">ADFA</option>
                        <option value="Director">Director</option>
                        <option value="Approved">Approved</option>
                        <option value="Disabled">Disable</option>
                    </select></div>
                    <div class = "col-sm-4"><button name="CSE_FAC_Btn" class="btn btn-primary">Update</button></div>
                </div>
                <hr>

                <div class = "row">
                    <div class = "col-sm-4"><label for="ME_FAC">Select Destination for ME Faculty:</label></div>
                    <div class = "col-sm-4"><select class="form-control" id="ME_FAC" name="ME_FAC_VAL">
                        <option value="ME_HOD">HOD ME</option>
                        <option value="DFA">DFA</option>
                        <option value="ADFA">ADFA</option>
                        <option value="Director">Director</option>
                        <option value="Approved">Approved</option>
                        <option value="Disabled">Disable</option>
                    </select></div>
                    <div class = "col-sm-4"><button name="ME_FAC_Btn" class="btn btn-primary">Update</button></div>
                </div>
                <hr>

                <div class = "row">
                    <div class = "col-sm-4"><label for="EE_FAC">Select Destination for EE Faculty:</label></div>
                    <div class = "col-sm-4"><select class="form-control" id="EE_FAC" name="EE_FAC_VAL">
                        <option value="EE_HOD">HOD EE</option>
                        <option value="DFA">DFA</option>
                        <option value="ADFA">ADFA</option>
                        <option value="Director">Director</option>
                        <option value="Approved">Approved</option>
                        <option value="Disabled">Disable</option>
                    </select></div>
                    <div class = "col-sm-4"><button name="EE_FAC_Btn" class="btn btn-primary">Update</button></div>
                </div>
                <hr>

                <div class = "row">
                    <div class = "col-sm-4"><label for="CSE_HOD">Select Destination for CSE HOD:</label></div>
                    <div class = "col-sm-4"><select class="form-control" id="CSE_HOD" name="CSE_HOD_VAL">
                        <option value="DFA">DFA</option>
                        <option value="ADFA">ADFA</option>
                        <option value="Director">Director</option>
                        <option value="Approved">Approved</option>
                        <option value="Disabled">Disable</option>
                    </select></div>
                    <div class = "col-sm-4"><button name="CSE_HOD_Btn" class="btn btn-primary">Update</button></div>
                </div>
                <hr>

                <div class = "row">
                    <div class = "col-sm-4"><label for="EE_HOD">Select Destination for EE HOD:</label></div>
                    <div class = "col-sm-4"><select class="form-control" id="EE_HOD" name="EE_HOD_VAL">
                        <option value="DFA">DFA</option>
                        <option value="ADFA">ADFA</option>
                        <option value="Director">Director</option>
                        <option value="Approved">Approved</option>
                        <option value="Disabled">Disable</option>
                    </select></div>
                    <div class = "col-sm-4"><button name="EE_HOD_Btn" class="btn btn-primary">Update</button></div>
                </div>
                <hr>

                <div class = "row">
                    <div class = "col-sm-4"><label for="ME_HOD">Select Destination for ME HOD:</label></div>
                    <div class = "col-sm-4"><select class="form-control" id="ME_HOD" name="ME_HOD_VAL">
                        <option value="DFA">DFA</option>
                        <option value="ADFA">ADFA</option>
                        <option value="Director">Director</option>
                        <option value="Approved">Approved</option>
                        <option value="Disabled">Disable</option>
                    </select></div>
                    <div class = "col-sm-4"><button name="ME_HOD_Btn" class="btn btn-primary">Update</button></div>
                </div>
                <hr>

                <div class = "row">
                    <div class = "col-sm-4"><label for="ADFA">Select Destination for ADFA:</label></div>
                    <div class = "col-sm-4"><select class="form-control" id="ADFA" name="ADFA_VAL">
                        <option value="DFA">DFA</option>
                        <option value="Approved">Approved</option>
                        <option value="Director">Director</option>
                        <option value="Disabled">Disable</option>
                    </select></div>
                    <div class = "col-sm-4"><button name="ADFA_Btn" class="btn btn-primary">Update</button></div>
                </div>
                <hr>

                <div class = "row">
                    <div class = "col-sm-4"><label for="DFA">Select Destination for DFA:</label></div>
                    <div class = "col-sm-4"><select class="form-control" id="DFA" name="DFA_VAL">
                        <option value="Approved">Approved</option>
                        <option value="Director">Director</option>
                        <option value="Disabled">Disable</option>
                    </select></div>
                    <div class = "col-sm-4"><button name="DFA_Btn" class="btn btn-primary">Update</button></div>
                </div>
                <hr>
                <div><button name="Defaults_Btn" class="btn btn-primary">Set Defaults</button>
                
                <button name="Approved_Btn" class="btn btn-primary">Set All Disabled</button></div>
                <hr>          


		      </form>
	      </div>    
      </div>
      
      <div class="container">
        <h2>Current Destinations:</h2>
        <div class = "row">
            <div class = "col-sm-3">CSE Faculty</div>
            <?php
                $dest=getRoute($db,'CSE_FAC');
                echo"<div class = 'col-sm-3'>".$dest."</div>";
            ?>
            <div class = "col-sm-6"></div>
        </div>
        <div class = "row">
            <div class = "col-sm-3">EE Faculty</div>
            <?php
                $dest=getRoute($db,'EE_FAC');
                echo"<div class = 'col-sm-3'>".$dest."</div>";
            ?>
            <div class = "col-sm-6"></div>
        </div>
        <div class = "row">
            <div class = "col-sm-3">ME Faculty</div>
            <?php
                $dest=getRoute($db,'ME_FAC');
                echo"<div class = 'col-sm-3'>".$dest."</div>";
            ?>
            <div class = "col-sm-6"></div>
        </div>
        <div class = "row">
            <div class = "col-sm-3">CSE HOD</div>
            <?php
                $dest=getRoute($db,'CSE_HOD');
                echo"<div class = 'col-sm-3'>".$dest."</div>";
            ?>
            <div class = "col-sm-6"></div>
        </div>
        <div class = "row">
            <div class = "col-sm-3">EE HOD</div>
            <?php
                $dest=getRoute($db,'EE_HOD');
                echo"<div class = 'col-sm-3'>".$dest."</div>";
            ?>
            <div class = "col-sm-6"></div>
        </div>
        <div class = "row">
            <div class = "col-sm-3">ME HOD</div>
            <?php
                $dest=getRoute($db,'ME_HOD');
                echo"<div class = 'col-sm-3'>".$dest."</div>";
            ?>
            <div class = "col-sm-6"></div>
        </div>
        <div class = "row">
            <div class = "col-sm-3">DFA</div>
            <?php
                $dest=getRoute($db,'DFA');
                echo"<div class = 'col-sm-3'>".$dest."</div>";
            ?>
            <div class = "col-sm-6"></div>
        </div>
        <div class = "row">
            <div class = "col-sm-3">ADFA</div>
            <?php
                $dest=getRoute($db,'ADFA');
                echo"<div class = 'col-sm-3'>".$dest."</div>";
            ?>
            <div class = "col-sm-6"></div>
        </div>
        <div class = "row">
            <div class = "col-sm-3">Director</div>
            <?php
                $dest=getRoute($db,'Director');
                echo"<div class = 'col-sm-3'>".$dest."</div>";
            ?>
            <div class = "col-sm-6"></div>
        </div>
      </div>
    </div>
  </div>
    <script>
		$(".sidebar li:eq(4)").addClass(" active ");
	</script>
	
<?php
  require("dash_foot.php");
?>

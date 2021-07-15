<!--header area-->
<?php include 'theme/header.php'; ?>
<!--sidebar area-->
<?php include 'theme/sidebar.php'; ?>

         
   <div id="content-wrapper">

        <div class="container-fluid">
 <!--  <div class="frame1">
            <div class="box">
              <img src="img/Screenshot_2018-09-17-09-46-19_1.jpg" alt="Img" height="130" width="197">
            </div>
          </div> -->
<!--  <div>Patients Table</div> -->
 <h2 style="font-family: AR BLANCA">List of Team(s) </h2> 
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Team Name</th>
                      <th>Options</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php

                    $query = "SELECT * FROM team where match_id = ".$_GET['id']." ORDER by match_id";
                    $result = mysqli_query($db, $query) or die (mysqli_error($db));                  
                        while ($row = mysqli_fetch_assoc($result)) { ?>


<tr>
                              <td><?php echo $row['team_name'];?></td>
                              <td>
                              <a  type="button" class="btn btn-sm btn-info fas fa-user"  data-toggle="modal" data-target="#assignPlayer<?php echo $row['team_id'];?>" style="color: white;">Assign Players</a>
                              <a  type="button" class="btn btn-sm btn-info fas fa-eye"   style="color: white;" href="view_players.php?&id=<?php echo $row['team_id']; ?>">View Players</a>
                              </td>
                              
                            </tr>


                            <div id="assignPlayer<?php echo $row['team_id'];?>" class="modal fade" role="dialog">

<div class="modal-dialog">
  <!-- Modal content-->
  <div class="modal-content" style="width: 130%">
    <div class="modal-header"><h3>Assign Player</h3>
      <button type="button" class="close" data-dismiss="modal">&times;</button>
    </div>
    <div class="modal-body">
        
          
      <form method="POST" action="#" id="<?php echo $row['team_id'] ; ?>">
        
        <input type="hidden" class="form-control" name="team_id" value="<?php echo $row['team_id']?>" required>

                    <div class="form-group">
                    <h3>Select Player</h3>
                          <select required name="player" class="form-control">
                              <option value="">---Select Player---</option>
                              <?php
                              
                                    $query2 = "SELECT * FROM players;";

                                    $resultNew = mysqli_query($db, $query2) or die (mysqli_error($db));

                                    while($row2=mysqli_fetch_assoc($resultNew))
                                    {

                                        echo '<option value="'. $row2['player_id'].'">'. $row2['player_name'].'</option>';
                                        
                                    }

                              ?>
                            </select>
                          </div> 


        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">
            Close
            <span class="glyphicon glyphicon-remove-sign"></span>
          </button>
          <input type="submit" name="submit" value="Save" class="btn btn-success">
        </div>
    </form>
   
    </div>
    </div>
</div>
</div>




                <?php }  ?>
                  </tbody>
                  
                </table>
              </div>
              </div>
              </div>  
              </div>  
              
            <!-- header("Refresh:0; url=page2.php"); -->


<?php
if(isset($_POST['submit'])){
  
  $team_id = $_POST['team_id'];
  $player_id = $_POST['player'];

  $queryt = "SELECT * FROM team_players where team_id = ".$team_id." and player_id = ".$player_id."";
  $result = mysqli_query($db,$queryt);

  if($result) {
    $rowcount=mysqli_num_rows($result);
    if($rowcount > 0) {
      echo '<script>alert("Already Assigned.")</script>';
    } else {

        $queryt = "INSERT INTO team_players(team_id,player_id)
        VALUES ('".$team_id."','".$player_id."')";
        mysqli_query($db,$queryt)or die (mysqli_error($db));
        echo '<script>alert("Player Assigned  Successfully!")</script>';

    }
  }
}
?>
                <!-- <script type="text/javascript">
      alert("Player Assigned  Successfully!.");
      <?php
      echo 'window.location ="add_player.php"';
      ?>
    </script> -->
<?php

 include 'theme/footer.php'; ?>
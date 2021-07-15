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


 <h2 style="font-family: AR BLANCA">Team(s)</h2> 

          

            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Team ID</th>
                      <th>Team Name</th>
                      <th>Event Name</th>
                      <th>Options</th>
                      <!-- <th>Options</th> -->
                    </tr>
                  </thead>
                  <tbody>
                  <?php

                      $queryEvent = "SELECT * FROM events order by event_id desc;";
                      $eventData = mysqli_query($db,$queryEvent);

                      $query = "SELECT t.team_id, t.team_name, e.event_name FROM teams t JOIN events e on t.event_id = e.event_id where t.team_id in (SELECT DISTINCT team_id FROM participants WHERE event_id = ".$_GET['event_id']." and game_id = ".$_GET['game_id'].") ORDER by team_id DESC;";
                      $result = mysqli_query($db,$query);
                      foreach($result as $row) {
                  
                  ?>

                  <tr>
                  
                        <td><?php echo $row['team_id'];?></td>
                        <td><?php echo $row['team_name'];?></td>
                        <td><?php echo $row['event_name'];?></td>
                        
                        <td>
                        
                        
                        <a href="view_players.php?team_id=<?php echo $row['team_id'];?>"  class="ml-1 btn btn-sm btn-primary">View Players</a>
                        <button data-target="#delete<?php echo $row['team_id'];?>" data-toggle="modal" class="ml-1 btn btn-sm btn-primary">Delete Participants</button>

                        



                        <div class="modal fade" id="delete<?php echo $row['team_id'];?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header bg-info">
            <h5 class="modal-title" id="exampleModalLabel">Ready to delete?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Are you sure?

            

          </div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <form action="" method="post">
              <input type="hidden" name="team_id" value="<?php echo $row['team_id'];?>">
              <input type="hidden" name="event_id" value="<?php echo $_GET['event_id'];?>">
              <input type="hidden" name="game_id" value="<?php echo $_GET['game_id'];?>">

              <button type="submit" class="btn btn-danger" name="submit_delete">Delete</button>
            </form>
            
          </div>
        </div>
      </div>
    </div>





                            <div id="addPlayer<?php echo $row['team_id'];?>" class="modal fade" role="dialog">
                              <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content" style="width: 130%">
                                  <div class="modal-header"><h3>New Player</h3>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  </div>
                                  <div class="modal-body">
                                    <form method="POST" action="#">

                                      <div class="form-group">
                                        <h5>Name</h5>
                                        <input type="text" class="form-control" name="name" required>  
                                      </div>

                                      <div class="form-group">
                                        <h5>Mobile Number</h5>
                                        <input type="text" class="form-control" placeholder="e.g 0301123187" name="number" required>  
                                      </div>

                                      

                                      <input type="hidden" name="team_id" value="<?php echo $row['team_id'];?>">

                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">
                                          Close
                                          <span class="glyphicon glyphicon-remove-sign"></span>
                                        </button>
                                        <input type="submit" name="submit_player" value="Save" class="btn btn-success">
                                      </div>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>
                        </td>

                  </tr>

                  <?php }?>
                  </tbody>
                </table>
              </div>
              </div>   

    <div id="addTeam" class="modal fade" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content" style="width: 130%">
          <div class="modal-header"><h3>New Team</h3>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
          </div>
          <div class="modal-body">
            <form method="POST" action="#">

              <div class="form-group">
                <h5>Team Name</h5>
                <input type="text" class="form-control" name="name" required>  
              </div>

              <div class="form-group">
                <h5>Select Event</h5>
                <select name="event_id" class="form-control" required>
                  <option value="" >Select Event</option>
                  <?php foreach($eventData as $event) {?>
                    <option value="<?php echo $event['event_id']; ?>" ><?php echo $event['event_name']; ?></option>
                  <?php }?>
                </select>
              </div>

              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                  Close
                  <span class="glyphicon glyphicon-remove-sign"></span>
                </button>
                <input type="submit" name="submit_team" value="Save" class="btn btn-success">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>


<!-- Message -->

<div id="message" class="alert alert-success alert-dismissible fade <?php if(isset($_GET['message'])) { echo 'show'; } ?>" role="alert">
      <?php if(isset($_GET['message'])) { echo $_GET['message']; } ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>

<!-- Message -->

<div id="message" class="alert alert-warning alert-dismissible fade <?php if(isset($_GET['error'])) { echo 'show'; } ?>" role="alert">
      <?php if(isset($_GET['error'])) { echo $_GET['error']; } ?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
  

<?php



if(isset($_POST['submit_delete'])){


  $team_id = $_POST['team_id'];
  $event_id = $_POST['event_id'];
  $game_id = $_POST['game_id'];


      mysqli_query($db,"DELETE FROM participants where team_id = ".$team_id."")or die(mysqli_error($db)); 

      echo '<script>window.location.replace("view_participant.php?message=Team Successfully Deleted&event_id='.$event_id.'&game_id='.$game_id.'&message=Successfully Added");</script>';

}



if(isset($_POST['submit_team'])){


  $name = $_POST['name'];
  $event_id = $_POST['event_id'];

  $query = "SELECT * FROM teams where LOWER(`team_name`) = LOWER('".$name."');";  
  
  $result = mysqli_query($db, $query); 

  if($result) {

    $rowcount = mysqli_num_rows($result);
    if($rowcount > 0) {
      echo '<script>window.location.replace("team.php?error=Team Already Exits In Corresponding Event");</script>';
    } else {

      mysqli_query($db,"INSERT INTO teams (event_id, team_name) VALUES ('".$event_id."','".$name."')")or die(mysqli_error($db)); 

      echo '<script>window.location.replace("team.php?message=Team Successfully Added");</script>';

    }

  }
}

if(isset($_POST['submit_player'])){

      $name = $_POST['name'];
      $number = $_POST['number'];
      $team_id = $_POST['team_id'];

      $query = "SELECT * FROM players where LOWER(`name`) = LOWER('".$name."') and team_id = ".$team_id.";";  
      
      $result = mysqli_query($db, $query); 

      if($result) {

        $rowcount = mysqli_num_rows($result);
        if($rowcount > 0) {
          echo '<script>window.location.replace("team.php?error=Player Already Exits");</script>';
        } else {

          mysqli_query($db,"INSERT INTO players (team_id, name, mobile_number) VALUES (".$team_id.", '".$name."', '".$number."')")or die(mysqli_error($db)); 

          echo '<script>window.location.replace("team.php?message=Player Successfully Added");</script>';

        }

      }
      

}
?>
<?php include 'theme/footer.php'; ?>

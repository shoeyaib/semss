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
                        
                        
                        <a href="#" data-target="#addScroe<?php echo $row['team_id'];?>" data-toggle="modal"   class="ml-1 btn btn-sm btn-primary">Add Score</a>
                        <a href="view_players.php?team_id=<?php echo $row['team_id'];?>"  class="ml-1 btn btn-sm btn-primary">View Players</a>
                        
                            <div id="addScroe<?php echo $row['team_id'];?>" class="modal fade" role="dialog">
                              <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content" style="width: 130%">
                                  <div class="modal-header"><h3>Add Score</h3>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  </div>
                                  <div class="modal-body">
                                    <form method="POST" action="#">

                                      <div class="form-group">
                                        <h5>Score (Max - <?php echo isset($_GET['score']) ? $_GET['score'] :'0';?>)</h5>
                                        <input type="text" class="form-control" name="score" required>  
                                      </div>

                                      <input type="hidden" name="team_id" value="<?php echo $row['team_id'];?>">
                                      <input type="hidden" name="game_id" value="<?php echo $_GET['game_id'];?>">
                                      <input type="hidden" name="event_id" value="<?php echo $_GET['event_id'];?>">
                                      <input type="hidden" name="max_score" value="<?php echo isset($_GET['score']) ? $_GET['score'] :'0';?>">

                                      

                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">
                                          Close
                                          <span class="glyphicon glyphicon-remove-sign"></span>
                                        </button>
                                        <input type="submit" name="submit_score" value="Save" class="btn btn-success">
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



if(isset($_POST['submit_score'])){


  $score = $_POST['score'];
  $event_id = $_POST['event_id'];
  $team_id = $_POST['team_id'];
  $game_id = $_POST['game_id'];
  $max_score = $_POST['max_score'];

  if($score > $max_score) {
    echo '<script>window.location.replace("game_participant.php?event_id='.$event_id.'&game_id='.$game_id.'&score='.$max_score.'&error=Score Can not be exceed");</script>';
  } else {
    
    
  

  $query = "SELECT * FROM score where event_id = ".$event_id." and team_id = ".$team_id." and game_id = ".$game_id.";";  
  
  $result = mysqli_query($db, $query); 

  if($result) {

    $rowcount = mysqli_num_rows($result);
    if($rowcount > 0) {
      echo '<script>window.location.replace("game_participant.php?event_id='.$event_id.'&game_id='.$game_id.'&score='.$max_score.'&error=Score Already Added");</script>';
    } else {

      mysqli_query($db,"INSERT INTO score (event_id, team_id, game_id, score) VALUES ('".$event_id."','".$team_id."','".$game_id."','".$score."')")or die(mysqli_error($db)); 

      echo '<script>window.location.replace("game_participant.php?event_id='.$event_id.'&game_id='.$game_id.'&score='.$max_score.'&message=Score Successfully Added");</script>';

    }

  }

  }

}

?>
<?php include 'theme/footer.php'; ?>
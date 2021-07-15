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


 <h2 style="font-family: AR BLANCA">Game Result(s)</h2> 
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th >Event ID</th>
                      <th>Event Name</th>
                      <th>Event Contact</th>
                      <th>Options</th>
                      <!-- <th>Options</th> -->
                    </tr>
                  </thead>
                  <tbody>
                  <?php

                      $queryRefree = "SELECT * FROM refrees";
                      $resultRefree = mysqli_query($db,$queryRefree);

                      $query = "SELECT * FROM `events` WHERE event_id in (SELECT event_id FROM refree_event where refree_id in (SELECT refree_id FROM refrees WHERE user_id = ".$_SESSION['id']."))";
                      $result = mysqli_query($db,$query);
                      foreach($result as $row) {
                  
                  ?>

                  <tr>
                  
                        <td><?php echo $row['event_id'];?></td>
                        <td><?php echo $row['event_name'];?></td>
                        <td><?php echo $row['event_date'];?></td>
                        
                        <td>
                        <a href="result_games.php?event_id=<?php echo $row['event_id'];?>" class="ml-3 btn btn-sm btn-primary">View Games</a>
                        <!-- <a href="#" data-target="#addGame<?php echo $row['event_id'];?>" data-toggle="modal" class="ml-1 btn btn-sm btn-primary">Add Game</a>
                        <a href="#" data-target="#assignRefree<?php echo $row['event_id'];?>" data-toggle="modal" class="ml-1 btn btn-sm btn-primary">Assign Refree</a> -->
                            <div id="addGame<?php echo $row['event_id'];?>" class="modal fade" role="dialog">
                              <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content" style="width: 130%">
                                  <div class="modal-header"><h3>New Game</h3>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  </div>
                                  <div class="modal-body">
                                    <form method="POST" action="#">

                                      <div class="form-group">
                                        <h5>Name</h5>
                                        <input type="text" class="form-control" name="name" required>  
                                      </div>

                                      <div class="form-group">
                                        <h5>Category</h5>
                                        <input type="text" class="form-control" placeholder="e.g Running" name="category" required>  
                                      </div>

                                      <input type="hidden" name="event_id" value="<?php echo $row['event_id'];?>">

                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">
                                          Close
                                          <span class="glyphicon glyphicon-remove-sign"></span>
                                        </button>
                                        <input type="submit" name="submit_game" value="Save" class="btn btn-success">
                                      </div>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            </div>

                            <div id="assignRefree<?php echo $row['event_id'];?>" class="modal fade" role="dialog">
                              <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content" style="width: 130%">
                                  <div class="modal-header"><h3>Assign Refree</h3>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  </div>
                                  <div class="modal-body">
                                    <form method="POST" action="#">

                                    <div class="form-group">
                                        <h5>Select Refree</h5>
                                        <select name="refree_id" class="form-control" required>
                                          <option value="">Select Refree</option>
                                          <?php foreach($resultRefree as $refree) {?>
                                            <option value="<?php echo $refree['refree_id']; ?>" ><?php echo $refree['refree_name']; ?></option>
                                          <?php }?>
                                        </select>
                                      </div>

                                      <input type="hidden" name="event_id" value="<?php echo $row['event_id'];?>">

                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">
                                          Close
                                          <span class="glyphicon glyphicon-remove-sign"></span>
                                        </button>
                                        <input type="submit" name="submit_refree" value="Save" class="btn btn-success">
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

            <div id="add" class="modal fade" role="dialog">
              <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content" style="width: 130%">
                  <div class="modal-header"><h3>New Event</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                      
                        
            <form method="POST" action="#">
              <div class="form-group">
                <h5>Name</h5>
                <input type="text" class="form-control" name="name" required>  
              </div>

              <div class="form-group">
              <h5>Date</h5>
                <input type="date" class="form-control" name="date" required>  
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

if(isset($_POST['submit_refree'])){

  $refree_id = $_POST['refree_id'];
  $event_id = $_POST['event_id'];

  $query = "SELECT * FROM refree_event where refree_id = ".$refree_id." and event_id = ".$event_id.";";  
  
  $result = mysqli_query($db, $query); 

  if($result) {

    $rowcount = mysqli_num_rows($result);
    if($rowcount > 0) {
      echo '<script>window.location.replace("match.php?error=Refree Already Assigned");</script>';
    } else {

      mysqli_query($db,"INSERT INTO refree_event (event_id, refree_id) VALUES ('".$event_id."','".$refree_id."')")or die(mysqli_error($db)); 

      echo '<script>window.location.replace("match.php?message=Refree Successfully Assigned");</script>';

    }

  }
}


if(isset($_POST['submit_game'])){

  $name = $_POST['name'];
  $category = $_POST['category'];
  $event_id = $_POST['event_id'];

  $query = "SELECT * FROM games where LOWER(`game_name`) = LOWER('".$name."') and event_id = ".$event_id.";";  
  
  $result = mysqli_query($db, $query); 

  if($result) {

    $rowcount = mysqli_num_rows($result);
    if($rowcount > 0) {
      echo '<script>window.location.replace("match.php?error=Game Already Exits");</script>';
    } else {

      mysqli_query($db,"INSERT INTO games (event_id, game_name, category) VALUES ('".$event_id."','".$name."', '".$category."')")or die(mysqli_error($db)); 

      echo '<script>window.location.replace("match.php?message=Game Successfully Added");</script>';

    }

  }
}

if(isset($_POST['submit'])){

      $name = $_POST['name'];
      $date = $_POST['date'];

      $query = "SELECT * FROM events where LOWER(`event_name`) = LOWER('".$name."');";  
      
      $result = mysqli_query($db, $query); 

      if($result) {

        $rowcount = mysqli_num_rows($result);
        if($rowcount > 0) {
          echo '<script>window.location.replace("match.php?error=Event Already Exits");</script>';
        } else {

          mysqli_query($db,"INSERT INTO events (event_name, event_date) VALUES ('".$name."', '".$date."')")or die(mysqli_error($db)); 

          echo '<script>window.location.replace("match.php?message=Event Successfully Created");</script>';

        }

      }
      

}
?>
<?php include 'theme/footer.php'; ?>
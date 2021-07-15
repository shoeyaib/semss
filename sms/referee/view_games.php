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


 <h2 style="font-family: AR BLANCA">Event Game(s)</h2> 
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Game ID</th>
                      <th>Game Name</th>
                      <th>Category</th>
                      <th>Option</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php


                      $id = isset($_GET['event_id']) ? $_GET['event_id'] : 0;

                      $query = "SELECT * FROM games where event_id = ".$id.";";
                      $result = mysqli_query($db,$query);
                      foreach($result as $row) {
                  
                  ?>

                  <tr>
                  
                        <td><?php echo $row['game_id'];?></td>
                        <td><?php echo $row['game_name'];?></td>
                        <td><?php echo $row['category'];?></td>
                        <td>
                        
                        <a href="view_participant.php?event_id=<?php echo $row['event_id'];?>&game_id=<?php echo $row['game_id'];?>" class="ml-3 btn btn-sm btn-primary">View Participants</a>
                        
                        <a href="add_participant.php?event_id=<?php echo $row['event_id'];?>&game_id=<?php echo $row['game_id'];?>" class="ml-1 btn btn-sm btn-primary">Add Participants</a>
                        


                        </td>
                        
                  </tr>

                  <?php }?>
                  </tbody>
                </table>
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
  


<?php include 'theme/footer.php'; ?>
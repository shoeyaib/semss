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


 <h2 style="font-family: AR BLANCA">Player(s)</h2> 
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Player ID</th>
                      <th>Player Name</th>
                      <th>Mobile Number</th>
                      
                      <!-- <th>Options</th> -->
                    </tr>
                  </thead>
                  <tbody>
                  <?php

                      $id = isset($_GET['team_id']) ? $_GET['team_id'] : 0;

                      $queryCount = "SELECT COUNT(*) as total FROM participants WHERE team_id = ".$id." and player_id is not null;";
                      $resultCount = mysqli_query($db, $queryCount);
                      $resultCount = mysqli_fetch_assoc($resultCount);

                      if($resultCount['total'] > 0){
                        $query = "SELECT * FROM players where team_id = ".$id." and player_id in (SELECT player_id FROM participants WHERE team_id = ".$id." and player_id is NOT NUll);";
                        $result = mysqli_query($db,$query);
                      } else {
                        $query = "SELECT * FROM players where team_id = ".$id.";";
                        $result = mysqli_query($db,$query);
                      }

                      foreach($result as $row) {
                  
                  ?>

                  <tr>
                  
                        <td><?php echo $row['player_id'];?></td>
                        <td><?php echo $row['name'];?></td>
                        <td><?php echo $row['mobile_number'];?></td>
                        
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
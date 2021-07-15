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


 <h2 style="font-family: AR BLANCA">Games(s)</h2> 
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Game ID</th>
                      <th>Game Name</th>
                      <th>Category</th>
                      <th>Game Score</th>
                      
                      <!-- <th>Options</th> -->
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
                        <td><?php echo $row['score'];?></td>
                        
                  </tr>

                  <?php }?>
                  </tbody>
                </table>
              </div>
              </div>   

            

            <h2 style="font-family: AR BLANCA">Assigne Refrees(s)</h2> 
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Refree ID</th>
                      <th>Refree Name</th>
                      
                      <!-- <th>Options</th> -->
                    </tr>
                  </thead>
                  <tbody>
                  <?php

                      $query = "SELECT refree_event.refree_id, refrees.refree_name FROM `refree_event` JOIN refrees ON refrees.refree_id = refree_event.refree_id where event_id = ".$id.";";
                      $result = mysqli_query($db,$query);
                      foreach($result as $row) {
                  
                  ?>

                  <tr>
                  
                        <td><?php echo $row['refree_id'];?></td>
                        <td><?php echo $row['refree_name'];?></td>
                        
                        
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
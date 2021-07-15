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
<?php
$id = $_GET['id'];

// $query = 'SELECT p.player_name, m.team_no  FROM match_player m, players p WHERE m.player_id = p.player_id and m.match_id  =  = "'.$id.'"';
//                     $result = mysqli_query($db, $query) or die (mysqli_error($db));
//                         $row = mysqli_fetch_assoc($result);
//                         $name = $row['tour_name'];
?>
<a href="match.php" type="button" class="btn btn-lg btn-add fas fa-arrow-left bg-warning">Back</a><br><br>
 <h2 style="font-family: AR BLANCA">Team Details</h2> 
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Player Name</th>
                      <th>Team Number</th>
                      
                    </tr>
                  </thead>
              <?php

                $query = 'SELECT p.player_name, m.team_no  FROM match_player m, players p WHERE m.player_id = p.player_id and m.match_id  = "'.$id.'"';
                    $result = mysqli_query($db, $query) or die (mysqli_error($db));
                  
                        while ($row = mysqli_fetch_assoc($result)) {
                                             
                            echo '<tr>';
                            echo '<td>'. $row['player_name'].'</td>';
                              echo '<td>'. $row['team_no'].'</td>';
                            echo '</tr>';
                }
            ?> 
                </table>
              </div>
              </div>       
<?php include 'theme/footer.php'; ?>
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

// $query = 'SELECT tour_name FROM tournament WHERE tour_code = "'.$id.'"';
//                     $result = mysqli_query($db, $query) or die (mysqli_error($db));
//                         $row = mysqli_fetch_assoc($result);
//                         $name = $row['tour_name'];
?>
<a href="result.php" type="button" class="btn btn-lg btn-add fas fa-arrow-left bg-warning">Back</a><br><br>
 <h2 style="font-family: AR BLANCA">Result</h2> 
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Team</th>
                      <th>Position</th>
                    </tr>
                  </thead>
              <?php

$query = "SELECT gr.team_no,gp.position_name FROM game_result gr , game_result_position gp WHERE gr.position_code = gp.position_code and gr.match_id = ".$id." ORDER by gr.position_code";
                    $result = mysqli_query($db, $query) or die (mysqli_error($db));
                  
                        while ($row = mysqli_fetch_assoc($result)) {
                                             
                            echo '<tr>';
                            echo '<td>'. $row['team_no'].'</td>';
                              echo '<td>'. $row['position_name'].'</td>';
                            echo '</tr>';
                }
            ?> 
                </table>
              </div>
              </div>       
<?php include 'theme/footer.php'; ?>
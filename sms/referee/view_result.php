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
    <h2 style="font-family: AR BLANCA">Result </h2> 
            <div class="card-body">
                <h1><?php echo $_GET['tname']?></h1>
                <h2><?php echo $_GET['gname']?></h2>

                <div class="table-responsive">
                <table class="table table-bordered" id="" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Team Name</th>
                      <th>Score</th>
                      <th>Position</th>
                    </tr>
                  </thead>
              <?php

$query = "SELECT team.team_name, game_result.position_code, game_result.final_score FROM `game_result` JOIN team on game_result.team_id = team.team_id WHERE game_result.match_id = ".$_GET['id']." ORDER by game_result.position_code";

                    $result = mysqli_query($db, $query) or die (mysqli_error($db));
                  
                        while ($row = mysqli_fetch_assoc($result)) {

                          ?>
                            

                            <tr>
                              <td><?php echo $row['team_name'];?></td>
                              <td><?php echo $row['final_score'];?></td>
                              <td>
                                    <?php 
                                        $query2 = "SELECT position_name FROM game_result_position where position_code = ".$row['position_code']."";

                                        $result2 = mysqli_query($db, $query2) or die (mysqli_error($db));
                                        $rs = mysqli_fetch_assoc($result2);
                                        echo $rs['position_name'];
                                    ?>
                              </td>
                            </tr>
                                                

                    <?php } ?> 
                </table>
              </div>

            </div>
            </div>
            </div>
              
              



            <!-- header("Refresh:0; url=page2.php"); -->


<?php
if(isset($_POST['submit'])){
  
  $team_id = $_POST['team_id'];
  $m_id = $_POST['match_id'];

  $queryt = "SELECT * FROM match_team where match_id = ".$m_id." and team_id = ".$team_id."";
  $result = mysqli_query($db,$queryt);

  if($result) {
    $rowcount=mysqli_num_rows($result);
    if($rowcount > 0) {
      echo '<script>alert("Already Assigned.")</script>';
    } else {

      $queryt = "INSERT INTO match_team(match_id,team_id)
          VALUES ('".$m_id."','".$team_id."')";
          mysqli_query($db,$queryt)or die (mysqli_error($db));
          echo '<script>alert("Team Assigned  Successfully!")</script>';

    }
  }

?>
                <!-- <script type="text/javascript">
      alert("Player Assigned  Successfully!.");
      <?php
      echo 'window.location ="match.php"';
      ?>
    </script> -->
<?php
}
 include 'theme/footer.php'; ?>
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
$query = 'SELECT * FROM players';
                    $result = mysqli_query($db, $query) or die (mysqli_error($db));
                  
                        $row1 = mysqli_fetch_assoc($result);
?>
 <h2 style="font-family: AR BLANCA">List of Player(s)

  <?php if($_SESSION['user_type']=='Refree') { ?>
    <a href="#addplayer" data-target="#addplayer" data-toggle="modal" class="small-box-footer">Add Single Player</a>|<a href="#addcsv" data-target="#addcsv" data-toggle="modal" class="small-box-footer" style="color: green">Add Multiple Player</a>
    <?php }
    ?>
      
    </h2> 
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Code</th>
                      <th>Name</th>
                      <th>Age</th>
                      <th>Course</th>
                      <th>Address</th>
                      <th>Gender</th>
                      <th>School</th>
                      <th>Game</th>
                      <th>Contact</th>
                      <!-- <th>Options</th> -->
                    </tr>
                  </thead>
              <?php

// $query = 'SELECT p.player_id,p.player_code,p.player_name,p.player_age,p.player_course,p.player_address,p.player_gender,s.school_name,sp.sport_name,p.contact from players p,schools s,sports sp where s.school_code = p.school_code and sp.sport_code = p.sport_code';


$query = 'SELECT p.player_id,p.player_code,p.player_name,p.player_age,p.player_course,p.player_address,p.player_gender,p.player_game_type,s.school_name,p.contact from players p,schools s where s.school_code = p.school_code';
                    $result = mysqli_query($db, $query) or die (mysqli_error($db));
                  
                        while ($row = mysqli_fetch_assoc($result)) {
                                             
                            echo '<tr>';
                              echo '<td>'. $row['player_code'].'</td>';
                               echo '<td>'. $row['player_name'].'</td>';
                                echo '<td>'. $row['player_age'].'</td>';
                                 echo '<td>'. $row['player_course'].'</td>';
                                 echo '<td>'. $row['player_address'].'</td>';
                               echo '<td>'. $row['player_gender'].'</td>';
                                echo '<td>'. $row['school_name'].'</td>';
                                echo '<td>'. $row['player_game_type'].'</td>';
                                 echo '<td>'. $row['contact'].'</td>';
                            // echo '<td><a type="button" class="btn btn-sm btn-info fas fa-user" href="addhistory.php?action=add & id='.$row['player_id'] . '">Details</a>';
                            echo '</tr>';
                }
            ?> 
                </table>
              </div>
              </div>   
              <?php
$query4 = "SELECT concat(`auto_desc`,'-',`auto_start`+`auto_end`) as 'player' FROM auto_number WHERE `auto_desc` = 'PLYR'";

     $result4 = mysqli_query($db, $query4) or die (mysqli_error($db));
                  
                        $row4 = mysqli_fetch_assoc($result4);
                                             
                            $code = $row4['player'];

                            $query5 = "SELECT * FROM schools";

     $result5 = mysqli_query($db, $query5) or die (mysqli_error($db));

     $query6 = "SELECT * FROM sports";

     $result6 = mysqli_query($db, $query6) or die (mysqli_error($db));

     $game_query = "SELECT * FROM game_type";

     $game_result = mysqli_query($db, $game_query) or die (mysqli_error($db));
                        
              ?>
              <div id="addplayer" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Add Player</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">
        <form class="form-horizontal" method="post" action="#" enctype='multipart/form-data'>
               
                <div class="form-group">
          <h5>Code</h5>
            <input type="text" readonly class="form-control" name="code" value="<?php echo $code;?>" required>  
        </div> 
        <div class="form-group">
          <h5>Name</h5>
            <input type="text" class="form-control" name="name" required>  
        </div> 
        <div class="form-group">
          <h5>Age</h5>
            <input type="number" class="form-control" name="age" required>  
        </div> 
        <div class="form-group">
          <h5>Course</h5>
            <input type="text" class="form-control" name="course" required>  
        </div> 
        <div class="form-group">
          <h5>Address</h5>
            <input type="text" class="form-control" name="add" required>  
        </div> 
        
        <div class="form-group">
          <h5>Gender</h5>
            <select class="form-control" name="gender">
              <option value="Male">Male</option>
              <option value="Female">Female</option>
            </select>  
        </div>
        <div class="form-group">
          <h5>School</h5>
           <select class="form-control" name="school">
             <?php
             while ($row5 =  mysqli_fetch_assoc($result5)) {
              ?>
              <option value="<?php echo $row5['school_code']; ?>"><?php echo $row5['school_name']; ?></option>
              <?php
}
              ?>
           </select>
          </div>

          <div class="form-group">
          <h5>Game Type</h5>
           <select class="form-control" name="game_type">
             <?php
             while ($game_row =  mysqli_fetch_assoc($game_result)) {
              ?>
              <option value="<?php echo $game_row['type_of_game']; ?>"><?php echo $game_row['type_of_game']; ?></option>
              <?php
}
              ?>
           </select>
          </div>
        <!-- <div class="form-group">
          <h5>Sport</h5>
           <select class="form-control" name="sport">
             <?php
             while ($row6 =  mysqli_fetch_assoc($result6)) {
              ?>
              <option value="<?php echo $row6['sport_code']; ?>"><?php echo $row6['sport_name']; ?></option>
              <?php
}
              ?>
           </select>
        </div>  -->
        <div class="form-group">
          <h5>Contact</h5>
            <input type="text" class="form-control" placeholder="+639" name="contact" required>
        </div>
      </div>
              <div class="modal-footer">
    <button type="submit" name="submit" class="btn btn-primary">Save changes</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
        </form>
            </div>
      
        </div><!--end of modal-dialog-->
 </div>   
 <?php
if(isset($_POST['submit'])){
  $code = $_POST['code'];
   $name = $_POST['name'];
    $age = $_POST['age'];
     $course = $_POST['course'];
      $add = $_POST['add'];
      $gender = $_POST['gender'];
   $school = $_POST['school'];
    $game_type = $_POST['game_type'];
    // $sport = $_POST['sport'];
      $contact = $_POST['contact'];


      mysqli_query($db,"INSERT INTO players (player_name,player_age,player_course,player_address,player_gender,school_code,contact,player_code,player_game_type) VALUES ('".$name."','".$age."','".$course."','".$add."','".$gender."','".$school."','".$contact."','".$code."','".$game_type."')")or die(mysqli_error($db)); 
          
          mysqli_query($db,"UPDATE auto_number set auto_end = auto_end+auto_increment where auto_desc = 'FCLTR'") or die(mysqli_error($db));
        ?>
        <script>
                alert("Successfully Added!");
                window.location = "players.php"; 
                </script>
 <?php
}
?>
<?php
        
        include_once './config1/db-config.php';

  // including import controller file
  include_once './controllers1/import-controller.php';

  // creating object of DBController class
  $db              =      new DBController();

  // calling connect() function using object
    $conn            =      $db->connect();

    // creating object of import controller and passing connection object as a parameter
  $importCtrl      =      new ImportController($conn);

?>

<div id="addcsv" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Add Multiple Players</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
              </div>
              <div class="modal-body">
  

  <div class="container">
    <form method="post" enctype="multipart/form-data">
          <label> Import Data </label>
            <div class="form-group">          
              <input type="file" name="file" class="form-control">
            </div>
            <div class="form-group">
              <button type="submit" name="import" class="btn btn-success">Import 
      </button>
    </div>
          <?php

            $importResult   =  $importCtrl->index();  
                      
          ?>
    </form>
  </div>
            </div>
      
        </div><!--end of modal-dialog-->
 </div>   
<?php include 'theme/footer.php'; ?>
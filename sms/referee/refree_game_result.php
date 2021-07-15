<!--header area-->
<?php include 'theme/header.php';
  $resultData = array(); 
  $resultDataTeam = array(); 
?>
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


 <h2 style="font-family: AR BLANCA">Game Result(s) <button class="btn btn-primary" id="download">Download</button></h2>
 <?php

$query = "SELECT * FROM events where event_id = ".$_GET['event_id']."";
$result = mysqli_query($db,$query);
$result = mysqli_fetch_assoc($result);
?>

<div style="text-align: center;">
    <h3>Event ID : <?php echo $result['event_id']; array_push($resultData, $result['event_id'] ); ?></h3>
    <h3>Event Name : <?php echo $result['event_name']; array_push($resultData, $result['event_name']);?></h3>
    <h3>Event Date : <?php echo $result['event_date']; array_push($resultData,$result['event_date']);?></h3>
</div>

<div class="mt-5" style="text-align: center;">

<?php

  

    $query = "SELECT DISTINCT game_id FROM score WHERE event_id = ".$_GET['event_id']."";
    $result = mysqli_query($db,$query);            

?>


    <h3><u>Position</u></h3>

    <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Team ID</th>
                    <th>Team Name</th>
                    <th>Team Score</th>
                    <th>Position</th>
                </tr>
            </thead>
            <tbody>

    <?php
        
        $positions = ['1st', '2nd', '3rd'];

        $count = 0;

        $game_id =  isset($_GET['game_id']) ? $_GET['game_id'] : 0;

        $queryWinner = "SELECT score , teams.team_id , teams.team_name FROM score JOIN teams on teams.team_id = score.team_id WHERE (score.team_id,score.game_id) in (SELECT team_id, score.game_id FROM score WHERE game_id = ".$game_id.") ORDER by score DESC LIMIT 3";
        $resultWinner = mysqli_query($db,$queryWinner);  
        foreach ($resultWinner as $resultPosition) {
            
        
    ?>

<tr>
                
                <td><?php echo $resultPosition['team_id']?></td>
                <td><?php echo $resultPosition['team_name']?></td>
                <td><?php echo $resultPosition['score']?></td>
                <td><?php 

                        echo $positions[$count];

                        array_push($resultDataTeam, array(
                          "team_id" => $resultPosition['team_id'],
                          "team_name" => $resultPosition['team_name'],
                          "score" => $resultPosition['score'],
                          "position" => $positions[$count]
                        ));

                    ?>
                    </td>
            </tr>

    <?php $count++;} ?>
        
                


    </tbody>
        </table>
    
</div>

<div class="card-body">

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
  
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.5/jspdf.debug.js"></script>
<?php 

  echo "
  <script>

    var btn = document.getElementById('download');
    btn.addEventListener('click', function() {

      var doc = new jsPDF();
      ";

      

      echo "
        doc.text('Event Id : ".$resultData[0]."', 40, 10);
        doc.text('Event Name : ".$resultData[1]."', 40, 20);
        doc.text('Event Date : ".$resultData[2]."', 40, 30);
      ";

      echo "
        doc.text('Positions' , 80, 40);  
      ";

      echo "
        doc.text('Team Id ' , 20, 50);
        doc.text('Team Name' , 60, 50);
        doc.text('Score' , 100, 50);
        doc.text('Position' , 140, 50);
      ";

      $h = 60;

      foreach($resultDataTeam as $team) {

        echo "
          doc.text('".$team['team_id']."', 20, ".$h.");
          doc.text('".$team['team_name']."', 60, ".$h.");
          doc.text('".$team['score']."', 100, ".$h.");
          doc.text('".$team['position']."', 140 , ".$h.");
      ";


      $h += 10;

      }

      

echo "
      doc.save('result.pdf');
    });
  </script>
  ";



?>



<?php include 'theme/footer.php'; ?>
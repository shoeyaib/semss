<!--header area-->
<?php include 'theme/header.php';

$resultData = array();
$resultDataTeam = array();
$resultDataTeam2 = array();

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


    <h2 style="font-family: AR BLANCA">Score Board(s)<button class="btn btn-primary" id="download">Download</button></h2>
    <?php

    $query = "SELECT * FROM events where event_id = " . $_GET['event_id'] . "";
    $result = mysqli_query($db, $query);
    $result = mysqli_fetch_assoc($result);
    ?>

    <div style="text-align: center;">
      <h3>Event ID : <?php echo $result['event_id'];
                      array_push($resultData, $result['event_id']); ?></h3>
      <h3>Event Name : <?php echo $result['event_name'];
                        array_push($resultData, $result['event_name']); ?></h3>
      <h3>Event Date : <?php echo $result['event_date'];
                        array_push($resultData, $result['event_date']); ?></h3>
    </div>

    <div class="mt-5" style="text-align: center;">

      <?php

      $query = "SELECT DISTINCT game_id FROM score WHERE event_id = " . $_GET['event_id'] . "";
      $result = mysqli_query($db, $query);



      ?>


      <h3><u>Winners</u></h3>

      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Team ID</th>
            <th>Team Name</th>
            <th>Game Name</th>
            <th>Team Score</th>
          </tr>
        </thead>
        <tbody>

          <?php foreach ($result as $row) {

            $queryWinner = "SELECT teams.team_id, teams.team_name, score.score FROM teams JOIN score on teams.team_id = score.team_id WHERE teams.team_id = (SELECT team_id FROM score WHERE game_id = " . $row['game_id'] . " ORDER by score desc LIMIT 1) ORDER by score.score desc LIMIT 1";
            $resultWinner = mysqli_query($db, $queryWinner);
            $resultWinner = mysqli_fetch_assoc($resultWinner);
          ?>

            <tr>

              <td><?php echo $resultWinner['team_id'] ?></td>
              <td><?php echo $resultWinner['team_name'] ?></td>
              <td><?php

                  $queryGame = "SELECT game_name FROM games where game_id = " . $row['game_id'] . "";
                  $resultGame = mysqli_query($db, $queryGame);
                  $resultGame = mysqli_fetch_assoc($resultGame);

                  echo $resultGame['game_name'];



                  array_push($resultDataTeam, array(
                    "team_id" => $resultWinner['team_id'],
                    "team_name" => $resultWinner['team_name'],
                    "score" => $resultWinner['score'],
                    "game_name" => $resultGame['game_name']
                  ));

                  ?></td>
              <td><?php echo $resultWinner['score'] ?></td>

            </tr>

          <?php } ?>

        </tbody>
      </table>


      <!-- Message for winner team of event-->
      <h3><u>Tournament Winner</u></h3>

      <table class="table table-bordered">
        <thead>
          <tr>
            <th>Team ID</th>
            <th>Team Name</th>
            <th>Team Total Score</th>
          </tr>
        </thead>
        <tbody>

          <?php

          $queryWinner = "SELECT s.team_id,s.event_id,s.game_id,t.team_name, sum(score) as score FROM score as s join teams as t on s.team_id = t.team_id where s.event_id = ".$_GET['event_id']." group by t.team_id order by sum(score) desc";
          $resultWinner = mysqli_query($db, $queryWinner);
          $resultWinner = mysqli_fetch_assoc($resultWinner);
          ?>

          <tr>

            <td><?php echo $resultWinner['team_id'] ?></td>
            <td><?php echo $resultWinner['team_name'] ?></td>
            <td><?php echo $resultWinner['score'] ?></td>
            <?php

            array_push($resultDataTeam2, array(
              "team_id" => $resultWinner['team_id'],
              "team_name" => $resultWinner['team_name'],
              "score" => $resultWinner['score'],

            ));

            ?>



          </tr>

          <?php ?>

        </tbody>
      </table>




      <!-- Message for winner team of event-->

    </div>

    <div class="card-body">

    </div>






    <!-- Message -->

    <div id="message" class="alert alert-success alert-dismissible fade <?php if (isset($_GET['message'])) {
                                                                          echo 'show';
                                                                        } ?>" role="alert">
      <?php if (isset($_GET['message'])) {
        echo $_GET['message'];
      } ?>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>

    <!-- Message -->

    <div id="message" class="alert alert-warning alert-dismissible fade <?php if (isset($_GET['error'])) {
                                                                          echo 'show';
                                                                        } ?>" role="alert">
      <?php if (isset($_GET['error'])) {
        echo $_GET['error'];
      } ?>
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
        doc.text('Event Id : " . $resultData[0] . "', 40, 10);
        doc.text('Event Name : " . $resultData[1] . "', 40, 20);
        doc.text('Event Date : " . $resultData[2] . "', 40, 30);
      ";

    echo "
        doc.text('Winners' , 80, 40);  
      ";

    echo "
        doc.text('Team Id ' , 20, 50);
        doc.text('Team Name' , 60, 50);
        doc.text('Score' , 100, 50);
        doc.text('Game Name' , 140, 50);
      ";

    $h = 60;

    foreach ($resultDataTeam as $team) {

      echo "
          doc.text('" . $team['team_id'] . "', 20, " . $h . ");
          doc.text('" . $team['team_name'] . "', 60, " . $h . ");
          doc.text('" . $team['score'] . "', 100, " . $h . ");
          doc.text('" . $team['game_name'] . "', 140 , " . $h . ");
      ";


      $h += 10;
    }

    echo "
        doc.text('Tournament Winners' , 80, 120);  
      ";
    $h = 130;

    foreach ($resultDataTeam2 as $team2) {

      echo "
          doc.text('" . $team2['team_id'] . "', 20, " . $h . ");
          doc.text('" . $team2['team_name'] . "', 60, " . $h . ");
          doc.text('" . $team2['score'] . "', 100, " . $h . ");
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
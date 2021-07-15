<!--header area-->
<?php include 'theme/header.php'; ?>
<!--sidebar area-->

<?php include 'theme/body.php'; ?>
          <!-- Breadcrumbs-->
<!--breadcrumbs area-->

          <!-- Area Chart Example-->
             <!-- Area Chart area-->

          <!-- DataTables Example -->
            <!-- datatable area-->
            <?php

$query = "SELECT * FROM events where event_id = ".$_GET['event_id']."";
$result = mysqli_query($db,$query);
$result = mysqli_fetch_assoc($result);
?>

<div style="text-align: center;">
    <h3>Event ID : <?php echo $result['event_id'];?></h3>
    <h3>Event Name : <?php echo $result['event_name'];?></h3>
    <h3>Event Date : <?php echo $result['event_date'];?></h3>
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

                    ?>
                    </td>
            </tr>

    <?php $count++;} ?>
        
                
            

    </tbody>
        </table>
    
</div>

<div class="card-body">

</div>   

      <!--footer area-->
      <center>
<?php include 'theme/footer.php'; ?>
</center>
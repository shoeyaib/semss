
<?php
include "theme/header.php";
include "theme/body.php";

?>
                       
                  <div class="align-center">
<?php
if (!$db) {
    # code...
    die('server not connected');
  }
  $sql = "SELECT m.match_id,m.match_code,m.tour_code, g.type_of_game,m.match_date,m.match_time,m.match_status,f.facilitator_name,sc.school_name,v.place from match_schedule m,game_type g,facilitator f,schools sc,venue v where g.game_type_id = m.game_id and f.facilitator_code = m.facilitator_code and sc.school_code = m.school_code and v.venue_code = m.venue_code and g.sport_type_code = 'SINGLESPORTS' group by m.match_id";
  $r =mysqli_query($db,$sql);
  while ($row = mysqli_fetch_array($r)) {
    ?>

            <div style="margin-top:-50px ">                
<center>

  <div class="container">
      <div class="card card-register mx-auto mt-5">
        <div class="card-header bg-primary">
        <?php 

        $query2 = "SELECT tour_name FROM tournament where tour_code = '".$row['tour_code']."'";


        $result2 = mysqli_query($db, $query2) or die (mysqli_error($db));
        $rs = mysqli_fetch_assoc($result2);
        
        
        
          echo '<h2>
          <a style="font-family:arial black;color: black;">'.$rs['tour_name'].'<a>
          </header>
          </h4>';
        ?>

<?php echo '<h4>
    <a style="font-family:arial black;color: black;">'.$row['type_of_game'].'<a>
    </header>
    </h4>';?>

    </div>
        <div class="card-body">
                <?php
   echo '<header>
    <h5>
    <a style="color: black;background-color: blue">'.''. $row['match_code'].'<a>
    </h5>';
    echo '<h5>
    <a style="color: black">'.'Date of Match:    '. $row['match_date'].'<a>
    </h5>';
     echo '<h5>
    <a style="color: black">'.'Time:    '. $row['match_time'].'<a>
    </h5>';
     echo '<h5>
    <a style="color: black">'.'Venue:    '. $row['place'].'<a>
    </h5>';
     echo '<h5>
    <a style="color: black">'.'Status:    '. $row['match_status'].'<a>
    </h5>';
     echo '<h5>
    <a style="color: black">'.'Facilitator:    '. $row['facilitator_name'].'<a>
    </h5>
    ';

    echo '<h4>Position</h4>';
    
    $sql123 = "SELECT team.team_name, game_result.position_code, game_result.final_score FROM `game_result` JOIN team on game_result.team_id = team.team_id WHERE game_result.match_id = ".$row['match_id']." ORDER by game_result.position_code";
    $rs123 = mysqli_query($db,$sql123);
    $no = mysqli_num_rows($rs123);
    if($no == 0) {
      echo '<h5>Pending</h5>';
    } else {
      while ($row5 = mysqli_fetch_array($rs123)) {


        $query2 = "SELECT position_name FROM game_result_position where position_code = ".$row5['position_code']."";

        $result27 = mysqli_query($db, $query2) or die (mysqli_error($db));
        $rs3 = mysqli_fetch_assoc($result27);
        $rs3['position_name'];



        echo '<span>'.$rs3['position_name'].'</span>';
        echo '<span>'.$row5['team_name'].'</span>';
        echo '<span>'.$row5['final_score'].'</span>';
        

      }
    }
    
    

    ?>
    
  <br>
    
<?php
}
?>
<center>
<?php
include "theme/footer.php";
?>
</center>
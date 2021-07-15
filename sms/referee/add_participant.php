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

                      $id = isset($_GET['event_id']) ? $_GET['event_id'] : 0;

                      $query = "SELECT * FROM teams where event_id = ".$id.";";
                      $teams = mysqli_query($db,$query);                      

                  ?>

 <h2 style="font-family: AR BLANCA">Add Participant(s)</h2> 
            <div class="card-body">
              <form name="team_form" method="post">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="type" id="inlineRadio1" value="single">
                    <label class="form-check-label" for="inlineRadio1">Single Game</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="type" id="inlineRadio2" value="double">
                    <label class="form-check-label" for="inlineRadio2">Double Game</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="type" id="inlineRadio3" value="team" checked>
                    <label class="form-check-label" for="inlineRadio3">Team Game</label>
                </div>

                <div class="form-group mt-3">
                    <h4>Select Team</h4>
                    <select name="team_id" id="team" class="form-control" required>
                        <option value="">Select Team</option>
                        <?php foreach($teams as $team) {?>
                            <option value="<?php echo $team['team_id']; ?>" ><?php echo $team['team_name']; ?></option>
                        <?php }?>
                    </select>
                </div>

                <div class="form-group mt-3" id="player-selection" style="display:none;">
                    <h4>Select Player</h4>
                    <select name="player_id[]" id="players" multiple class="form-control">
                        
                    </select>
                </div>

                

                <input type="hidden" name="game_id" value="<?php echo $_GET['game_id'];?>">
                <input type="hidden" name="event_id" value="<?php echo $_GET['event_id'];?>">
                
                
                <div class="form-group mt-3">
                    <input type="submit" name="submit" value="Save" class="btn btn-primary">
                </div>
                

              </form>
            </div>   


<script>

    var container = document.getElementById("player-selection");
    var players = document.getElementById("players");
    
    
    var team = document.getElementById("team");
    // var type = document.querySelector('input[name="type"]');
    var type = document.team_form.type;
    

    for (var i = 0; i < type.length; i++) {
        type[i].addEventListener('change', function() {

            if(this.value != "team") {
                container.style.display = "initial";
            } else {
                container.style.display = "none";
            }

        });
    }

    team.addEventListener('change', function() {

        var typeChecked = document.querySelector('input[name="type"]:checked');
        if(typeChecked.value != "team"){
            if(team.value != "") {
                players.innerHTML = "";
                const xmlhttp = new XMLHttpRequest();
                xmlhttp.onload = function() {
                    var data = JSON.parse(this.responseText);
                    for (let index = 0; index < data.length; index++) {
                        const element = data[index];
                        var option = document.createElement("option");
                        option.text = element.player_name;
                        option.value = element.player_id;
                        players.add(option);
                    }
                }
                xmlhttp.open("GET", "team_players.php?team_id=" + team.value);
                xmlhttp.send();
            }
        }
        
    });

    

    
    
    
    


</script>

            

    
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


<?php

if(isset($_POST['submit'])){
    $type = $_POST['type'];
    $event_id = $_POST['event_id'];
    $team_id = $_POST['team_id'];
    $game_id = $_POST['game_id'];

    

    if($type == "single") {
        
        if(count($_POST['player_id']) == 1){

            foreach ($_POST['player_id'] as $id) {
                mysqli_query($db,"INSERT INTO participants (event_id, game_id, team_id, player_id) VALUES (".$event_id.", ".$game_id.", ".$team_id.", ".$id.")")or die(mysqli_error($db)); 
            }
            echo '<script>window.location.replace("add_participant.php?event_id='.$event_id.'&game_id='.$game_id.'&message=Successfully Added");</script>';

        } else {
            echo '<script>window.location.replace("add_participant.php?event_id='.$event_id.'&game_id='.$game_id.'&error=Choose 1 player");</script>';
        }

    } else if($type == "double") {

        if(count($_POST['player_id']) == 2){

            foreach ($_POST['player_id'] as $id) {
                mysqli_query($db,"INSERT INTO participants (event_id, game_id, team_id, player_id) VALUES (".$event_id.", ".$game_id.", ".$team_id.", ".$id.")")or die(mysqli_error($db)); 
            }
            echo '<script>window.location.replace("add_participant.php?event_id='.$event_id.'&game_id='.$game_id.'&message=Successfully Added");</script>';

        } else {
            echo '<script>window.location.replace("add_participant.php?event_id='.$event_id.'&game_id='.$game_id.'&error=Choose 2 player");</script>';
        }

    } else if($type == "team") {


        $query = "SELECT * FROM participants where game_id = ".$game_id." and team_id = ".$team_id."";
        $result = mysqli_query($db, $query); 

        if($result) {

        $rowcount = mysqli_num_rows($result);
        if($rowcount > 0) {
            echo '<script>window.location.replace("add_participant.php?event_id='.$event_id.'&game_id='.$game_id.'&error=Already Exits");</script>';
        } else {

            mysqli_query($db,"INSERT INTO participants (event_id, game_id, team_id) VALUES (".$event_id.", ".$game_id.", ".$team_id.")")or die(mysqli_error($db)); 

            echo '<script>window.location.replace("add_participant.php?event_id='.$event_id.'&game_id='.$game_id.'&message=Successfully Added");</script>';


        }

    }


    }


    // foreach ($_POST['player_id'] as $id) {
    //     echo $id;
    // }

    

    // $name = $_POST['name'];
    // $date = $_POST['date'];

    // $query = "SELECT * FROM events where LOWER(`event_name`) = LOWER('".$name."');";  
    
    // $result = mysqli_query($db, $query); 

    // if($result) {

    //   $rowcount = mysqli_num_rows($result);
    //   if($rowcount > 0) {
    //     echo '<script>window.location.replace("match.php?error=Event Already Exits");</script>';
    //   } else {

    //     mysqli_query($db,"INSERT INTO events (event_name, event_date) VALUES ('".$name."', '".$date."')")or die(mysqli_error($db)); 

    //     echo '<script>window.location.replace("match.php?message=Event Successfully Created");</script>';

    //   }

    // }
    

}


?>


<?php include 'theme/footer.php'; ?>
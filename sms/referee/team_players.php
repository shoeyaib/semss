<?php

include_once 'includes/connection.php';

$id = isset($_GET['team_id']) ? $_GET['team_id'] : 0;

$query = "SELECT * FROM players where team_id = ".$id.";";

$result = mysqli_query($db,$query);


// echo json_encode($result);
$data = array();

foreach($result as $row) {
    array_push($data, [
        "player_id" => $row['player_id'],
        "player_name" => $row['name']
    ]);
}


echo json_encode($data);

                  
                
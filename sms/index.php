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
      $query = "SELECT * FROM events order by event_id desc;";
      $result = mysqli_query($db,$query);
      foreach($result as $row) {
?>



<div class="container mb-5 mt-2">

      <div class="card text-center ">
            <div class="card-header">
            <h3>
            <?php echo $row['event_name']; $id =$row['event_id']; ?>
            </h3>
            </div>

            <div class="card-body">
            <h5 class="card-title">Games</h5>
                  <div class="container" style="width: 40%;">
                        <div class="list-group">
                        <?php
                              $query2 = "SELECT * FROM games where event_id = ".$id."";
                              $result2 = mysqli_query($db,$query2);
                              
                              foreach ($result2 as $game) {
                                    echo '<a href="result.php?game_id='.$game['game_id'].'&event_id='.$id.'" class="list-group-item list-group-item-action">'.$game['game_name'].'</a>';
                              }
                        ?>      
                        </div>
                  </div>
            </div>

            <div class="card-footer text-muted">
            <?php echo $row['event_date']; ?>
            </div>
      </div>

</div>


<?php }?>

      <!--footer area-->
      <center>
<?php include 'theme/footer.php'; ?>
</center>
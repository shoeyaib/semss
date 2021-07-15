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


 <h2 style="font-family: AR BLANCA">Refree(s)<a href="#addfac" data-target="#addfac" data-toggle="modal" class="ml-3 btn btn-lg btn-primary"><i class="fas fa-plus"></i></a></h2> 
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Refree ID</th>
                      <th>Name</th>
                      <th>Contact</th>
                      <!-- <th>Options</th> -->
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                      $query = "SELECT * FROM `refrees`";
                      $result = mysqli_query($db,$query);

                      foreach($result as $row) {
                  
                  ?>

                  <tr>
                  
                        <td><?php echo $row['refree_id'];?></td>
                        <td><?php echo $row['refree_name'];?></td>
                        <td><?php echo $row['mobile_number'];?></td>

                  </tr>

                  <?php }?>
                  </tbody>
                </table>
              </div>
              </div>   
            <div id="addfac" class="modal fade" role="dialog">
              <div class="modal-dialog">
                <!-- Modal content-->
                <div class="modal-content" style="width: 130%">
                  <div class="modal-header"><h3>New Refree</h3>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                      
                        
            <form method="POST" action="#">
              <div class="form-group">
                <h5>Name</h5>
                <input type="text" class="form-control" name="name" required>  
              </div>

              <div class="form-group">
              <h5>User Name</h5>
                <input type="text" class="form-control" name="user_name" required>  
              </div>

              <div class="form-group">
              <h5>Password</h5>
                <input type="text" class="form-control" name="user_pass" required>  
              </div>
        
              <div class="form-group">
                <h5>Contact</h5>
                  <input type="text" class="form-control" placeholder="e.g +3011232897" name="contact" required>
              </div>
                
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">
                      Close
                      <span class="glyphicon glyphicon-remove-sign"></span>
                    </button>
                    <input type="submit" name="submit" value="Save" class="btn btn-success">
                  </div>
                  </form>
                 
</div>
</div>
              </div>
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
if(isset($_POST['submit'])){

      $name = $_POST['name'];
      $contact = $_POST['contact'];
      $user_name = $_POST['user_name'];
      $password = $_POST['user_pass'];
      $user_pass = sha1($_POST['user_pass']);

      $data = mysqli_query($db,"INSERT Into user(name,username,password,user_type) VALUES('".$name."','".$user_name."','".$user_pass."','Refree')") or die(mysqli_error($db));

      mysqli_query($db,"INSERT INTO refrees (refree_name, mobile_number, user_id) VALUES ('".$name."', '".$contact."', '".$db->insert_id."')")or die(mysqli_error($db)); 



      echo "
      <script>
        

        var doc = new jsPDF();
        doc.text('Name : ".$name."', 10, 10);
        doc.text('Username : ".$user_name."', 10, 20);
        doc.text('Password : ".$password."', 10, 30);
        doc.save('".$name.".pdf');
        
      </script>
      ";



      echo '<script>window.location.replace("refree.php?message=Successfully Added");</script>';

      // header("Location: refree.php?message=Successfully Added");

}
?>
<?php include 'theme/footer.php'; ?>
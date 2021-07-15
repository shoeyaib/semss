<?php include 'includes/connection.php'; ?>
<?php
session_start();
if(!$_SESSION["name"] || ($_SESSION['user_type']!=='Admin' && $_SESSION['user_type']!=='Refree')){
 header("Location: ../login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Sports Event Management System</title>
    <link href="logo.jpg" rel="icon">
    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">

    <script type="text/javascript" src="js/demo/datepicker.js"></script>
    <link href="css/datepicker.css" rel="stylesheet" type="text/css" />

    <style>
    
        #message{
          position: absolute;
          left: 20;
          right: 30px;
          bottom: 80px;
        }
    
    </style>

  </head>

  <body id="page-top">

    <nav class="navbar navbar-expand navbar-dark static-top bg-info">

      <a class="navbar-brand mr-1" href="index.php" style="font-family: Snap ITC">Sports Event Management System</a>

      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>

      </button>
      <!-- Navbar Search -->
      <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
      </form>

      <!-- Navbar -->
      <ul class="navbar-nav ml-auto ml-md-0" style="font-family: AR BLANCA">
         <li class="nav-item dropdown no-arrow mx-1">
          <a class="nav-link dropdown-toggle active" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Message(s)
             <?php

              //  $query = "SELECT * FROM `messagein` where (MessageFrom = '+639125113555' or MessageFrom = '+639070344612') and Status = 'UNREAD'";
              //  $result = mysqli_query($db,$query);
              //  $count = 0;
              //   while($row = mysqli_fetch_array($result)){
              //     $count++;
              //   }
                ?>
            <span class="badge badge-danger">0</span>
             <i class="fas fa-envelope fa-fw"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="messagesDropdown">
            
          </div>
        </li>
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle active" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user-circle fa-fw"></i>
            Howday,<?php echo " ". $_SESSION['user_type']; ?>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            <a class="dropdown-item" data-target="#changePass" data-toggle="modal" href="#">Change Password</a>
            
            <div class="dropdown-divider"></div>
            <a class="dropdown-item fas fa-sign-out-alt" style="color: red" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
          </div>
        </li>
      </ul>

    </nav>

                    
                        <div id="changePass" class="modal fade" role="dialog">
                          <div class="modal-dialog">
                            <!-- Modal content-->
                            <div class="modal-content" style="width: 130%">
                              <div class="modal-header"><h3>Change Password</h3>
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                              </div>
                              <div class="modal-body">
                                <form method="POST" action="#">

                                  <div class="form-group">
                                    <h5>Old Password</h5>
                                    <input type="password" class="form-control" name="old-pass" required>  
                                  </div>

                                  <div class="form-group">
                                    <h5>New Password</h5>
                                    <input type="password" class="form-control" name="new-pass" required>  
                                  </div>

                                  <div class="form-group">
                                    <h5>Confirm Password</h5>
                                    <input type="password" class="form-control" name="confirm-pass" required>  
                                  </div>


                                  <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">
                                      Close
                                      <span class="glyphicon glyphicon-remove-sign"></span>
                                    </button>
                                    <input type="submit" name="submit_password" value="Save" class="btn btn-success">
                                  </div>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>



                        <?php



if(isset($_POST['submit_password'])){


  $old = sha1($_POST['old-pass']);
  $new = sha1($_POST['new-pass']);
  $confirm = sha1($_POST['confirm-pass']);

  if($new != $confirm) {
    echo '<script>alert("Password did not match")</script>';
  }
  

  $query = "SELECT * FROM user where password = '".$old."' and user_id = ".$_SESSION['id']."";  
  
  $result = mysqli_query($db, $query); 

  if($result) {

    $rowcount = mysqli_num_rows($result);
    if($rowcount > 0) {

      mysqli_query($db,"Update user set password = '".$new."' where user_id = ".$_SESSION['id']."")or die(mysqli_error($db)); 

      echo '<script>alert("Password Updated")</script>';
      
    } else {

      echo '<script>alert("Wrong Password")</script>';


    }

  }
}

?>
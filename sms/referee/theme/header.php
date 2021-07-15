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
            <a class="dropdown-item" href="#">Settings</a>
            <a class="dropdown-item" href="#">Activity Log</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item fas fa-sign-out-alt" style="color: red" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
          </div>
        </li>
      </ul>

    </nav>
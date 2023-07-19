<?php

include 'config.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:login_form.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Admin</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/materyales.png" rel="icon">
  <link href="assets/img/materyales.png" rel="materyales">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

  <!-- Template Main CSS File -->
  <link href="assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin - v2.5.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>


  <!-- ======= Header ======= -->
<header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="assets/img/materyalesba.png" alt="">
        <span class="d-none d-lg-block">MateryalesBa</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->


    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">



        

        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-bell"></i>
            <span class="badge bg-primary badge-number">4</span>
          </a><!-- End Notification Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
            <li class="dropdown-header">
              You have 4 new notifications
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>
            </li>


          </ul><!-- End Notification Dropdown Items -->

        </li><!-- End Notification Nav -->

        <li class="nav-item dropdown">

          <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
            <i class="bi bi-chat-left-text"></i>
            <span class="badge bg-success badge-number">3</span>
          </a><!-- End Messages Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
            <li class="dropdown-header">
              You have 3 new messages
              <a href="#"><span class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a>
            </li>


          </ul><!-- End Messages Dropdown Items -->

        </li><!-- End Messages Nav -->

        <li class="nav-item dropdown pe-3">
            <?php
            $select_profile = $conn->prepare("SELECT * FROM `user_form` WHERE id = ?");
            $select_profile->execute([$admin_id]);
            $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
            ?>
          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="uploaded_img/<?= $fetch_profile['image']; ?>" alt=""class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?= $fetch_profile['name']; ?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <span><h6><?= $fetch_profile['name']; ?></h6></span>
              <span>Admin</span>
            </li>


          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->


      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  

 <!-- ======= Sidebar ======= -->
<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

  <li class="nav-item">
    <a class="nav-link " href="admin_dashboard.php">
      <i class="ri-home-2-line"></i>
      <span>Dashboard</span>
    </a>
  </li><!-- End Profile Page Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" href="admin_user_information.php">
      <i class="bi bi-question-circle"></i>
      <span>User Information</span>
    </a>
  </li><!-- End F.A.Q Page Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" href="admin_user_account.php">
      <i class="bi bi-envelope"></i>
      <span>User Account</span>
    </a>
  </li><!-- End Contact Page Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" href="admin_hardware.php">
      <i class="bi bi-card-list"></i>
      <span>Hardware Registration</span>
    </a> 
  </li><!-- End Register Page Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" href="login_form.php">
      <i class="bi bi-box-arrow-in-right"></i>
      <span>Signout</span>
    </a>
  </li><!-- End Signout Page Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" href="pages-error-404.html">
      <i class="bi bi-dash-circle"></i>
      <span>Error 404</span>
    </a>
  </li><!-- End Error 404 Page Nav -->

  <li class="nav-item">
    <a class="nav-link collapsed" href="pages-blank.html">
      <i class="bi bi-file-earmark"></i>
      <span>Blank</span>
    </a>
  </li><!-- End Blank Page Nav -->

</ul>

</aside><!-- End Sidebar-->

  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Dashboard</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="admin_dashboard.php">Home</a></li>
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->


<section class="section dashboard">
    <div class="main-content-inner">
        <!-- sales report area start -->
        <div class="sales-report-area mt-5 mb-5">
            <div class="row">
                <div class="col-md-4">
                    <div class="single-report mb-xs-30">
                        <div class=" pr--20 pt--30 mb-3 d-flex align-items-center">
                            <div class="icon bg-primary rounded-circle">
                                <i class="fas fa-registered"></i>
                            </div>
                            <div class="s-report-title ml-3">
                                <h4 class="header-title mb-0">Registered Hardware:</h4>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center pb-2">
                          <h2 class="text-center">
                                <?php 
                                    $query = "SELECT id FROM registration_hardware ORDER BY id";
                                      $stmt = $conn->prepare($query);
                                      $stmt->execute();
                                      $rows = $stmt->rowCount();
                                      echo $rows;
                                ?>
                                </h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="single-report mb-xs-30">
                        <div class=" pr--20 pt--30 mb-3 d-flex align-items-center">
                            <div class="icon bg-success rounded-circle">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="s-report-title ml-3">
                                <h4 class="header-title mb-0">Users:</h4>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center pb-2">
                          <h2 class="text-center">
                                <?php 
                            $query = "SELECT id FROM user_form ORDER BY id";
                            $stmt = $conn->prepare($query);
                            $stmt->execute();
                            $rows = $stmt->rowCount();
                            echo $rows;
                                ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="single-report">
                        <div class=" pr--20 pt--30 mb-3 d-flex align-items-center">
                            <div class="icon bg-warning rounded-circle">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="s-report-title ml-3">
                                <h4 class="header-title mb-0">Total </h4>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center pb-2">
                          <h2 class="text-center">
                              <?php
                            $query1 = "SELECT id FROM registration_hardware ORDER BY id";
                            $stmt1 = $conn->prepare($query1);
                            $stmt1->execute();
                            $count1 = $stmt1->rowCount();

                            $query2 = "SELECT id FROM user_form ORDER BY id";
                            $stmt2 = $conn->prepare($query2);
                            $stmt2->execute();
                            $count2 = $stmt2->rowCount();

                            $totalCount = $count1 + $count2;

                            echo $totalCount;
                            ?>

                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>








  </main><!-- End #main -->


  


  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>
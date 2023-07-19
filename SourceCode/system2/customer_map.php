<?php

include 'config.php';

session_start();

$customer_id = $_SESSION['customer_id'];

if(!isset($customer_id)){
   header('location:login_form.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Map</title>
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



    <div class="search-bar">
      <form class="search-form d-flex align-items-center" method="POST" action="#">
        <input type="text" name="query" placeholder="Search" title="Enter search keyword">
        <button type="submit" title="Search"><i class="bi bi-search"></i></button>
      </form>
    </div><!-- End Search Bar -->

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">

        <li class="nav-item d-block d-lg-none">
          <a class="nav-link nav-icon search-bar-toggle " href="#">
            <i class="bi bi-search"></i>
          </a>
        </li><!-- End Search Icon-->

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
        $select_profile->execute([$customer_id]);
        $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
        ?>
        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
          <img src="uploaded_img/<?= $fetch_profile['image']; ?>" alt="" class="rounded-circle">
          <span class="d-none d-md-block dropdown-toggle ps-2"><?= $fetch_profile['name']; ?></span>
        </a><!-- End Profile Iamge Icon -->

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
          <li class="dropdown-header">
            <span><h6><?= $fetch_profile['name']; ?></h6></span>
            <span>Customer</span>
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
        <a class="nav-link collapsed" href="customer.php">
          <i class="ri-home-2-line"></i>
          <span>Home</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link" href="customer_map.php">
          <i class="ri-map-pin-line"></i>
          <span>Map</span>
        </a>
      </li><!-- End F.A.Q Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="customer_shop.php">
          <i class="ri-store-2-line"></i>
          <span>Shop</span>
        </a>
      </li><!-- End Contact Page Nav -->

          <li class="nav-item">
           <a class="nav-link collapsed" href="customer_list.php">
             <i class="bi bi-list-task"></i>
             <span>Send List</span>
            </a>
          </li>


      <li class="nav-item">
        <a class="nav-link collapsed" href="customer_transact_history.php">
          <i class="ri-history-line"></i>
          <span>Transaction History</span>
        </a>
      </li><!-- End Login Page Nav -->

      <li class="nav-heading">Account</li>
          <li class="nav-item">
            <a class="nav-link collapsed" href="customer_profile.php">
              <i class="bi bi-person"></i>
              <span>Profile</span>
            </a>
          </li>
                <li class="nav-item">
        <a class="nav-link collapsed" href="customer_purchase.php">
          <i class="ri-shopping-cart-line"></i>
          <span>My Purchases</span>
        </a> 
      </li><!-- End Register Page Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-blank.html">
          <i class="bi bi-question-circle"></i>
          <span>Need Help</span>
        </a>
      </li><!-- End Blank Page Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" href="login_form.php">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Signout</span>
        </a>
      </li><!-- End Signout Page Nav -->
    </ul>

    </aside><!-- End Sidebar-->
  
  <main id="main" class="main">
    <div class="pagetitle">
      <h1>Home</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="customer.php">Home</a></li>
          <li class="breadcrumb-item"><a href="#">Map</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->
            

  </main><!-- End #main -->
  
  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    
  </footer><!-- End Footer -->

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
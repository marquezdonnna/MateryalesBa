<?php

include 'config.php';

session_start();

$customer_id = $_SESSION['customer_id'];

if(!isset($customer_id)){
   header('location:login_form.php');
}

$seller_id = $_SESSION['seller_id'];

if(!isset($seller_id)){
   header('location:login_form.php');
}

if(isset($_GET['get_id'])){
   $get_id = $_GET['get_id'];
}else{
   $get_id = '';
   header('location:customer_shop.php');
}



// Fetch data from the first database (seller_product)
$query1 = "SELECT * FROM seller_product";
$result1 = $conn->query($query1);

// Fetch data from the second database (registration_hardware)
$query2 = "SELECT * FROM registration_hardware";
$result2 = $conn->query($query2);
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Home</title>
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
</head>

<body>

<header id="header" class="header fixed-top d-flex align-items-center">
  <div class="d-flex align-items-center justify-content-between">
    <a href="index.html" class="logo d-flex align-items-center">
      <img src="assets/img/materyalesba.png" alt="">
      <span class="d-none d-lg-block">MateryalesBa</span>
    </a>
    <i class="bi bi-list toggle-sidebar-btn"></i>
  </div><!-- End Logo -->

  <!-- ======= Search Bar ======= -->
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
      </li><!-- End Search Icon -->

      <!-- ======= Notifications ======= -->
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
        </ul><!-- End Notification Dropdown Items -->
      </li><!-- End Notification Nav -->

      <!-- ======= Messages ======= -->
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
        <a class="nav-link " href="customer.php">
          <i class="ri-home-2-line"></i>
          <span>Home</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="customer_map.php">
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
          <li class="breadcrumb-item"><a href="customer.php">Bagbag Hardware</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->  








<div class="card">
  <div class="card-header"></div>
  <div class="card-body">
    <div class="row justify-content-center">
      <div class="card mt-4 shop-card custom-design">
        <div class="card-body">
          <div class="d-flex align-items-center justify-content-between">

          <?php
          $select_properties = $conn->prepare("SELECT * FROM `registration_hardware` WHERE id = ? ORDER BY date DESC LIMIT 1");
          $select_properties->execute([$get_id]);
          if($select_properties->rowCount() > 0){
             while($fetch_property = $select_properties->fetch(PDO::FETCH_ASSOC)){

             $property_id = $fetch_property['id'];

             $select_user = $conn->prepare("SELECT * FROM `user_form` WHERE id = ?");
             $select_user->execute([$fetch_property['seller_id']]);
             $fetch_user = $select_user->fetch(PDO::FETCH_ASSOC);

            ?>

            <div class="bg-image hover-zoom ripple rounded ripple-surface">
                <img src="uploads/<?= $fetch_property['image']; ?>" title="<?php echo $fetch_property['image']; ?>" width=100 >
            </div>

              <span class="hardware-names"><?= $fetch_property['hardware_name']; ?></span>

            <div>
              <button class="btn btn-warning btn-border">
                <i class="bi bi-chat-dots-fill"></i>
                Chat
              </button>
            </div>
          </div>
             <?php
                }
             }else{
                echo '<p class="empty">property not found! <a href="post_property.php" style="margin-top:1.5rem;" class="btn">add new</a></p>';
             }
             ?>

        </div>
      </div>
    </div>

    <div class="container">
      <div style='width: 100%; height: 1px; background-color: grey; margin-top: 15px; margin-bottom: 15px;'></div>

      <h2 class="product-header">Products</h2>
      <div class="row justify-content-center">
            <?php
                                // Assuming you already have the $conn variable defined for database connection
            $select_properties = $conn->prepare("SELECT * FROM `seller_product` WHERE seller_id = ? ORDER BY date DESC");
            $select_properties->execute([$seller_id]);
            if($select_properties->rowCount() > 0){
              while($fetch_property = $select_properties->fetch(PDO::FETCH_ASSOC)){

            $property_id = $fetch_property['id'];
              ?>
          <div class="col-md-4">
            <div class="card mt-4 border-top border-warning"> <!-- Added "border-top" and "border-warning" classes -->
              <div class="card-body text-center"> <!-- Added "text-center" class -->
                <img src="uploads/<?= $fetch_profile['image']; ?> <?php echo $fetch_property['image']; ?>" class="card-img-top product-image">
                <div class="card-footer">
                  <span class="card-title"><?= $fetch_property['product_name']; ?></span>
                  <p class="card-text">₱<?= $fetch_property['product_price']; ?></p> <!-- Added ₱ symbol -->
                </div>
              </div>
            </div>
          </div>
                 <?php
         }
      }
      ?>
      </div>
    </div>
  </div>
</div>






</main>












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

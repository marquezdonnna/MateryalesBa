<?php

include 'config.php';

session_start();

$seller_id = $_SESSION['seller_id'];

if(!isset($seller_id)){
   header('location:login_form.php');
}


include_once 'config.php';

if (isset($_POST["submit"])) {
  $productName = $_POST['productName'];
  $productDescription = $_POST['productDescription'];
  $productPrice = $_POST['productPrice'];

  if (!isset($_FILES["productImage"]) || $_FILES["productImage"]["error"] === 4) {
    echo "<script> alert('Image does not exist');</script>";
  } else {
    $fileName = $_FILES["productImage"]["name"];
    $fileSize = $_FILES["productImage"]["size"];
    $tmpName = $_FILES["productImage"]["tmp_name"];

    $validImageExtensions = ['jpeg', 'jpg', 'png'];

    $imageExtension = pathinfo($fileName, PATHINFO_EXTENSION);
    $imageExtension = strtolower($imageExtension);

    if (!in_array($imageExtension, $validImageExtensions)) {
      echo "<script> alert('Invalid image extension');</script>";
    } elseif ($fileSize > 1000000) {
      echo "<script> alert('Image size is too large');</script>";
    } else {
      $newImageName = uniqid() . '.' . $imageExtension;

      if (move_uploaded_file($tmpName, 'uploads/' . $newImageName)) {
        $sellerId = $_SESSION['seller_id'];
        $query = "INSERT INTO seller_product (seller_id, product_name, product_description, product_price, image) VALUES (:sellerId, :productName, :productDescription, :productPrice, :newImageName)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':sellerId', $sellerId);
        $stmt->bindParam(':productName', $productName);
        $stmt->bindParam(':productDescription', $productDescription);
        $stmt->bindParam(':productPrice', $productPrice);
        $stmt->bindParam(':newImageName', $newImageName);

        if ($stmt->execute()) {
          echo "<script> alert('Successfully Added'); window.location.href = 'seller_table.php';</script>";
          exit;
        } else {
          echo "<script> alert('Error: " . $stmt->errorInfo()[2] . "');</script>";
        }
      } else {
        echo "<script> alert('Error moving uploaded file');</script>";
      }
    }
  }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Add Products</title>
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
      <li class="nav-item dropdown pe-3">
        <?php
        $select_profile = $conn->prepare("SELECT * FROM `user_form` WHERE id = ?");
        $select_profile->execute([$seller_id]);
        $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
        ?>
        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
          <img src="uploaded_img/<?= $fetch_profile['image']; ?>" alt="" class="rounded-circle">
          <span class="d-none d-md-block dropdown-toggle ps-2"><?= $fetch_profile['name']; ?></span>
        </a><!-- End Profile Iamge Icon -->

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
          <li class="dropdown-header">
            <span><h6><?= $fetch_profile['name']; ?></h6></span>
            <span>Seller</span>
          </li>
        </ul><!-- End Profile Dropdown Items -->
      </li><!-- End Profile Nav -->
    </ul>
  </nav><!-- End Icons Navigation -->
</header>
  

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="seller_dashboard.php">
          <i class="bi bi-grid"></i>
          <span>Dashboard</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-menu-button-wide"></i><span>Inventory</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
          <li>
            <a  href="seller_addproducts.php">
              <i class="bi bi-circle"></i><span>Add Products</span>
            </a>
          </li>
          <li>
            <a href="seller_table.php">
              <i class="bi bi-circle"></i><span>Products</span>
            </a>
          </li>
          <li>
            <a href="components-badges.html">
              <i class="bi bi-circle"></i><span>Delivery</span>
            </a>
          </li>
          <li>
            <a href="components-breadcrumbs.html">
              <i class="bi bi-circle"></i><span>Transaction History</span>
            </a>
          </li>
        </ul>
      </li><!-- End Components Nav -->

      


      <li class="nav-heading">Pages</li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="add.php">
          <i class="bi bi-person"></i>
          <span>Profile</span>
        </a>
      </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-faq.html">
          <i class="bi bi-question-circle"></i>
          <span>Messages</span>
        </a>
      </li><!-- End F.A.Q Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-contact.html">
          <i class="bi bi-envelope"></i>
          <span>Notification</span>
        </a>
      </li><!-- End Contact Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-register.html">
          <i class="bi bi-card-list"></i>
          <span>Account Settings</span>
        </a>
      </li><!-- End Register Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="pages-login.html">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Sign Out</span>
        </a>
      </li><!-- End Login Page Nav -->

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
      <h1>Home</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="customer.php">My Products</a></li>
          <li class="breadcrumb-item"><a href="customer.php">Add New Products</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

<div class="container">
  <div class="row justify-content-center">
    <div class="col-lg-6 col-md-8 d-flex flex-column align-items-center justify-content-center">
      <div class="card mb-3 mt-4 custom-border-top">
        <div class="card-body">
          <h3 class="card-title mb-4">Upload Product</h3>
          <form class="row g-3 needs-validation" method="POST" enctype="multipart/form-data" novalidate>
            <div class="col-12">
              <div class="mb-3">
                <label for="productImage" class="form-label">Product Image</label>
                <input type="file" name="productImage" class="form-control" id="productImage">
              </div>
            </div>
            <div class="col-12">
              <div class="mb-3">
                <label for="productName" class="form-label">Product Name</label>
                <input type="text" name="productName" class="form-control" id="productName">
              </div>
            </div>
            <div class="col-12">
              <div class="mb-3">
                <label for="productDescription" class="form-label">Product Description</label>
                <textarea name="productDescription" class="form-control" id="productDescription" rows="4"></textarea>
              </div>
            </div>
            <div class="col-12">
              <div class="mb-3">
                <label for="productPrice" class="form-label">Product Price</label>
                <input type="text" name="productPrice" class="form-control" id="productPrice">
              </div>
            </div>
            <div class="col-12">
              <button type="submit" name="submit" class="btn btn-primary">Save and Publish</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>



  </main>

  


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
<?php
include 'config.php';
session_start();

$seller_id = $_SESSION['seller_id'];

if (!isset($seller_id)) {
   header('location:login_form.php');
}

include_once 'config.php';

// Check if the seller is already registered
$checkRegisteredQuery = "SELECT * FROM registration_hardware WHERE seller_id = :sellerId";
$checkRegisteredStmt = $conn->prepare($checkRegisteredQuery);
$checkRegisteredStmt->bindParam(':sellerId', $seller_id);
$checkRegisteredStmt->execute();

if ($checkRegisteredStmt->rowCount() > 0) {
    // Seller is already registered, you can redirect them to the seller dashboard or display a message
    // For example:
    echo "<script> alert('You are already registered as a seller.'); window.location.href = 'seller_dashboard.php';</script>";
    exit;
}

// If seller is not already registered, proceed with the registration process

if (isset($_POST["submit"])) {
    $hname = $_POST['hname'];
    $address = $_POST['address'];
    $owners = $_POST['owners'];

    if (!isset($_FILES["image"]) || $_FILES["image"]["error"] === 4) {
        echo "<script> alert('Image does not exist');</script>";
    } else {
        $fileName = $_FILES["image"]["name"];
        $fileSize = $_FILES["image"]["size"];
        $tmpName = $_FILES["image"]["tmp_name"];

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
                $query = "INSERT INTO registration_hardware (seller_id, hardware_name, address, owners_name, image) VALUES (:sellerId, :hname, :address, :owners, :newImageName)";
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':sellerId', $sellerId);
                $stmt->bindParam(':hname', $hname);
                $stmt->bindParam(':address', $address);
                $stmt->bindParam(':owners', $owners);
                $stmt->bindParam(':newImageName', $newImageName);

                if ($stmt->execute()) {
                    echo "<script> alert('Successfully Added'); window.location.href = 'seller_dashboard.php';</script>";
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

  <title>Dashboard - NiceAdmin Bootstrap Template</title>
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
</header><!-- End Header -->


  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Form Elements</h1>
    </div><!-- End Page Title -->
      <section class="section">
      <div class="row">
        <div class="col-lg-9">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title"></h5>

              <!-- General Form Elements -->
        <form action="" action="" method="POST" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="hname" class="form-label">Hardware name</label>
            <input type="text" class="form-control" id="hname" name="hname" required>
          </div>

          <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" class="form-control" id="address" name="address" required>
          </div>


          <div class="mb-3">
            <label for="owners" class="form-label">Owners name</label>
            <input type="text" class="form-control" id="owners" name="owners" required>
          </div>


          <div class="mb-3">
            <label for="profile-image" class="form-label">Logo </label>
            <input type="file" class="form-control" name="image" id = "image" accept=".jpeg, .png, .jpg" value="">
          </div>


          <button type="submit" name ="submit"class="btn btn-primary">Submit</button>
        </form>

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
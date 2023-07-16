<?php

include 'config.php';

session_start();

$error = []; // Initialize the $error array

if(isset($_POST['submit'])){

   $name = ""; // Initialize the $name variable
   $email = ""; // Initialize the $email variable
   $pass = ""; // Initialize the $pass variable
   $username ="";
   $cpass = ""; // Initialize the $cpass variable
   $user_type = ""; // Initialize the $user_type variable

   if(isset($_POST['name'])){
      $name = mysqli_real_escape_string($conn, $_POST['name']);
   }
   if(isset($_POST['username'])){
      $username = mysqli_real_escape_string($conn, $_POST['username']);
   }

   if(isset($_POST['email'])){
      $email = mysqli_real_escape_string($conn, $_POST['email']);
   }

   if(isset($_POST['password'])){
      $pass = md5($_POST['password']);
   }

   if(isset($_POST['cpassword'])){
      $cpass = md5($_POST['cpassword']);
   }
 
   if(isset($_POST['user_type'])){
      $user_type = $_POST['user_type'];
   }

   $select = "SELECT * FROM user_form WHERE username = '$username' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $row = mysqli_fetch_array($result);

      if($row['user_type'] == 'seller'){

         $_SESSION['seller_name'] = $row['name'];
         $_SESSION['gender_seller'] = $row['gender']; //prob 1
         header('location:registration_hardware.php');
         exit();

      } elseif($row['user_type'] == 'customer'){

         $_SESSION['customer_name'] = $row['name']; //prob1
         $_SESSION['gender_customer'] = $row['gender'];
         $_SESSION['address_customer'] = $row['address'];
         $_SESSION['contact_customer'] = $row['contact'];
         $_SESSION['username_customer'] = $row['username'];
         $_SESSION['email_customer'] = $row['email'];
         header('location:customer.php');
         exit();

      } elseif($row['user_type'] == 'admin'){

         $_SESSION['admin_name'] = $row['name']; //prob1
         header('location:admin_dashboard.php');
         exit();

      } elseif($row['user_type'] == 'legit_seller'){

         $_SESSION['admin_name'] = $row['name']; //prob1
         header('location:seller_dashboard.php');
         exit();

      }
     
   } else {
      $error[] = 'Incorrect email or password!';
   }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Index_Customer - MateryalesBa</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/m-logo.png" rel="icon">
  <link href="assets/img/m-logo.png" rel="apple-touch-icon">

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

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="assets/img/m-logo.png" alt="">
        <span class="d-none d-lg-block">MateryalesBa</span>
      </a>
    </div><!-- End Logo -->
  </header>



<section class="vh-100">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-6 col-lg-5 col-xl-4">
        <img src="assets/img/worker.png" class="img-fluid" alt="Sample image">
      </div>

      <div class="col-md-6 col-lg-5 col-xl-4">
        <div class="card">
          <div class="card-body">
            <form action="" method="post">
            <?php
            if(!empty($error)){
               foreach($error as $errorMessage){
                  echo '<span class="error-msg">'.$errorMessage.'</span>';
               }
            }
            ?>
              <h3 class="login-heading">Login Now</h3>
              <div class="form-group mb-3">
                <label for="username">Username</label>
                <input type="text" name="username" id="username" required class="form-control" required placeholder="Enter your email">
              </div>

              <div class="form-group mb-4">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required class="form-control" required placeholder="Enter your password">
              </div>

              <button type="submit" name="submit" value="Login Now" class="btn btn-primary custom-button">Login Now</button>


              <p>Don't have an account? <a href="register_form.php">Register Now</a></p>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-warning">
  </div>
</section>









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



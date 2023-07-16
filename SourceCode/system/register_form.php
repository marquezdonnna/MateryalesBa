<?php

@include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $gender = mysqli_real_escape_string($conn, $_POST['gender']);
   $address = mysqli_real_escape_string($conn, $_POST['address']);
   $contact = mysqli_real_escape_string($conn, $_POST['contact']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $username = mysqli_real_escape_string($conn, $_POST['username']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = $_POST['user_type'];

   $select = " SELECT * FROM user_form WHERE username = '$username' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'user already exist!';

   }else{

      if($pass != $cpass){
         $error[] = 'password not matched!';
      }else{
         $insert = "INSERT INTO user_form(name, gender, address, contact, email, username, password, user_type) VALUES('$name','$gender','$address','$contact','$email','$username','$pass','$user_type')";
         mysqli_query($conn, $insert);
         header('location:login_form.php');
      }
   }

};


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
  <style>
    /* Adjust the margin-top of the section to create space below the header */
    .section {
      margin-top: 100px;
    }
  </style>
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


<section class="text-center">
  <!-- Background image -->
 <div class="p-5 bg-image" style="background-image: url('assets/img/worker.png'); height: 300px;"></div>

  <!-- Background image -->

  <div class="card mx-4 mx-md-5 shadow-5-strong" style="margin-top: -100px; background: hsla(0, 0%, 100%, 0.8); backdrop-filter: blur(30px);">
    <div class="card-body py-3 px-md-3">

      <div class="row d-flex justify-content-center">
        <div class="col-lg-4">
          <h2 class="fw-bold mb-5">Register Now</h2>
         <?php
         if(isset($error)){
            foreach($error as $error){
               echo '<span class="error-msg">'.$error.'</span>';
            };
         };
         ?>
          <form action="" method="post">
            <div class="row">
              <div class="form-outline mb-4">
                <input type="text" name="name" id="name" class="form-control" required placeholder="Enter your name">
<!--                   <label class="form-label" for="name">Name</label> -->
                </div>
                <div class="form-outline mb-4">
                  <select id="gender" name="gender" class="form-control" required>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                  </select>
<!--                   <label class="form-label" for="gender">Gender</label> -->
                  </div>

            <div class="form-outline mb-4">
              <input type="text" name="address" id="address" class="form-control" required placeholder="Enter your full address">
<!--               <label class="form-label" for="address">Address</label> -->
            </div>

            <div class="form-outline mb-4">
              <input type="text" name="contact" id="contact" class="form-control" required placeholder="Enter your contact">
<!--               <label class="form-label" for="contact">Contact</label> -->
            </div>

            <div class="form-outline mb-4">
              <input type="email" name="email" id="email" class="form-control" required placeholder="Enter your email">
<!--               <label class="form-label" for="email">Email address</label> -->
            </div>

            <div class="form-outline mb-4">
              <input type="text" name="username" id="username" class="form-control" required placeholder="Enter your username">
<!--               <label class="form-label" for="username">Username</label> -->
            </div>

            <div class="form-outline mb-4">
              <input type="password" name="password" id="password" class="form-control" required placeholder="Enter your password">
<!--               <label class="form-label" for="password">Password</label> -->
            </div>

            <div class="form-outline mb-4">
              <input type="password" name="cpassword" id="cpassword" class="form-control" required placeholder="Confirm your password">
<!--               <label class="form-label" for="cpassword">Confirm Password</label> -->
            </div>

            <div class="form-outline mb-4">
              <select name="user_type" id="user_type" class="form-control" required>
                <option value="customer">Customer</option>
                <option value="seller">Seller</option>
              </select>
<!--               <label class="form-label" for="user_type">User Type</label> -->
            </div>

            <button type="submit" name="submit" class="btn btn-primary btn-block mb-4">Register Now</button>

            <p>Already have an account? <a href="login_form.php">Login Now</a></p>
          </form>
        </div>
      </div>
    </div>
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

<?php

@include 'db_conn.php';

if(isset($_POST['submit'])){

   $firstname = mysqli_real_escape_string($conn, $_POST['firstName']);
   $middlename = mysqli_real_escape_string($conn, $_POST['middleName']);
   $lastname = mysqli_real_escape_string($conn, $_POST['lastName']);
   $gender = $_POST['gender'];
   $age = $_POST['age']; // hold
   //address
   $barangay = mysqli_real_escape_string($conn, $_POST['barangay']);
   $street = mysqli_real_escape_string($conn, $_POST['street']);
   $municipality = mysqli_real_escape_string($conn, $_POST['municipality']);
   $province = mysqli_real_escape_string($conn, $_POST['province']);
   $zipCode = $_POST['zipCode'];
   // user account
   $contact = $_POST['contact'];
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $username = mysqli_real_escape_string($conn, $_POST['username']);
   $pass = md5($_POST['password']);
   $cpass = md5($_POST['cpassword']);
   $user_type = $_POST['userType'];

   $select = " SELECT * FROM account WHERE username = '$username' && password = '$pass' ";

   $result = mysqli_query($conn, $select);

   if(mysqli_num_rows($result) > 0){

      $error[] = 'user already exist!';

   }else{

      if($pass != $cpass){
         $error[] = 'password not matched!';
      } else {
            $insert1 = "INSERT INTO user(firstname, middlename, lastname, gender, age, contact) VALUES ('$firstname','$middlename','$lastname','$gender','$age','$contact')";
            $insert2 = "INSERT INTO account(email, username, password, usertype) VALUES('$email','$username','$pass','$user_type')";
            $insert3 = "INSERT INTO address(barangay, street, municipality, province, zipcode) VALUES ('$barangay','$street','$municipality','$province','$zipCode')";

            mysqli_query($conn, $insert1);
            mysqli_query($conn, $insert2);
            mysqli_query($conn, $insert3);
            header('location: login.php');
            exit();
        }
   }

};


?>



<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Register/MateryalesBa?</title>
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

  <!-- =======================================================
  * Template Name: NiceAdmin - v2.5.0
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

<header id="header" class="header fixed-top d-flex align-items-center">
  <div class="d-flex align-items-center justify-content-between">
    <a href="index.html" class="logo d-flex align-items-center">
      <img src="assets/img/m-logo.png" alt="">
      <span class="d-none d-lg-block">MateryalesBa</span>
    </a>
  </div>
</header>

<main>
  <div class="container mt-5">
    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-8 col-md-10 d-flex flex-column align-items-center justify-content-center">
            <div class="card mb-3">
              <div class="card-body">
                <div class="pt-4 pb-2">
                  <div class="d-flex justify-content-center align-items-center py-4">
                    <a href="index.html" class="logo d-flex align-items-center justify-content-center" style="margin-right: -10px;">
                      <img src="assets/img/m-logo.png" alt="" style="width: 100px; height: auto;">
                    </a>
                  </div>

                  <h5 class="card-title text-center pb-0 fs-4" style="margin-top: -10px;">Create an Account</h5>

                  <p class="text-center small" style="margin-top: -5px;">Enter your personal details to create an account</p>

                  <form class="row g-3 needs-validation" novalidate action="" method="post">
                  <?php
                  if(isset($error)){
                    foreach($error as $error){
                      echo '<span class="error-msg">'.$error.'</span>';
                    };
                  };
                  ?>
                    <div class="col-md-6">
                      <label for="firstName" class="form-label">First Name</label>
                      <input type="text" name="firstName" class="form-control" id="firstName" placeholder="First Name" required>
                      <div class="invalid-feedback">Please enter your first name.</div>
                    </div>

                    <div class="col-md-6">
                      <label for="middleName" class="form-label">Middle Name</label>
                      <input type="text" name="middleName" class="form-control" id="middleName" placeholder="Middle Name" required>
                      <div class="invalid-feedback">Please enter your middle name.</div>
                    </div>

                    <div class="col-md-6">
                      <label for="lastName" class="form-label">Last Name</label>
                      <input type="text" name="lastName" class="form-control" id="lastName" placeholder="Last Name" required>
                      <div class="invalid-feedback">Please enter your last name.</div>
                    </div>

                    <div class="col-md-6">
                      <label for="gender" class="form-label">Gender</label>
                      <select name="gender" class="form-select" id="gender" required>
                        <option value="" selected disabled>Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                      </select>
                      <div class="invalid-feedback">Please select your gender.</div>
                    </div>

                    <div class="col-md-6">
                      <label for="age" class="form-label">Age</label>
                      <input type="number" name="age" class="form-control" id="age" placeholder="Age" required>
                      <div class="invalid-feedback">Please enter your age.</div>
                    </div>

                    <div class="col-md-6">
                      <label for="barangay" class="form-label">Barangay</label>
                      <input type="text" name="barangay" class="form-control" id="barangay" placeholder="Barangay" required>
                      <div class="invalid-feedback">Please enter your barangay.</div>
                    </div>

                    <div class="col-md-6">
                      <label for="street" class="form-label">Street</label>
                      <input type="text" name="street" class="form-control" id="street" placeholder="Street" required>
                      <div class="invalid-feedback">Please enter your street.</div>
                    </div>

                    <div class="col-md-6">
                      <label for="municipality" class="form-label">Municipality</label>
                      <input type="text" name="municipality" class="form-control" id="municipality" placeholder="Municipality" required>
                      <div class="invalid-feedback">Please enter your municipality.</div>
                    </div>

                    <div class="col-md-6">
                      <label for="province" class="form-label">Province</label>
                      <input type="text" name="province" class="form-control" id="province" placeholder="Province" required>
                      <div class="invalid-feedback">Please enter your province.</div>
                    </div>

                    <div class="col-md-6">
                      <label for="zipCode" class="form-label">ZIP Code</label>
                      <input type="text" name="zipCode" class="form-control" id="zipCode" placeholder="ZIP Code" required>
                      <div class="invalid-feedback">Please enter your ZIP code.</div>
                    </div>
                  </div> <!-- End of Row 1 -->

                  <div class="row g-3"> <!-- Start of Row 2 -->
                    <div class="col-md-6">
                      <label for="contact" class="form-label">Contact</label>
                      <input type="text" name="contact" class="form-control" id="contact" placeholder="Contact" required>
                      <div class="invalid-feedback">Please enter your contact number.</div>
                    </div>

                    <div class="col-md-6">
                      <label for="email" class="form-label">Email</label>
                      <input type="email" name="email" class="form-control" id="email" placeholder="Email" required>
                      <div class="invalid-feedback">Please enter a valid email address.</div>
                    </div>

                    <div class="col-md-6">
                      <label for="username" class="form-label">Username</label>
                      <input type="text" name="username" class="form-control" id="username" required>
                      <div class="invalid-feedback">Please choose a username.</div>
                    </div>

                    <div class="col-md-6">
                      <label for="password" class="form-label">Enter your Password</label>
                      <input type="password" name="password" class="form-control" id="password" required>
                      <div class="invalid-feedback">Please enter your password.</div>
                    </div>

                    <div class="col-md-6">
                      <label for="password" class="form-label">Confirm your Password</label>
                      <input type="password" name="cpassword" class="form-control" id="password" required>
                      <div class="invalid-feedback">Confirm your password.</div>
                    </div>

                    <div class="col-md-6">
                      <label for="userType" class="form-label">User Type</label>
                      <select name="userType" class="form-select" id="userType" required>
                        <option value="" selected disabled>Select User Type</option>
                        <option value="customer">Customer</option>
                        <option value="seller">Seller</option>
                      </select>
                      <div class="invalid-feedback">Please select your user type.</div>
                    </div>

                    <div class="col-12">
                      <div class="form-check">
                        <input class="form-check-input" name="terms" type="checkbox" value="" id="acceptTerms" required>
                        <label class="form-check-label" for="acceptTerms">I agree and accept the <a href="#">terms and conditions</a></label>
                        <div class="invalid-feedback">You must agree before submitting.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <button class="btn btn-warning w-100" name="submit" type="submit">Create Account</button>
                    </div>

                    <div class="col-12">
                      <p class="small mb-0">Already have an account? <a href="login.php">Log in</a></p>
                    </div>
                  </div> <!-- End of Row 2 -->
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</main>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="assets/vendor/chart.js/chart.umd.js"></script>
<script src="assets/vendor/counterup/counterup.min.js"></script>
<script src="assets/vendor/jquery/jquery.min.js"></script>
<script src="assets/vendor/quill/quill.min.js"></script>
<script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="assets/vendor/chart.js/chart.umd.js"></script>

<!-- Template Main JS File -->
<script src="assets/js/main.js"></script>

</body>

</html>

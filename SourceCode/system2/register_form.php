<?php

include 'config.php';

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);

   $gender = $_POST['gender'];
   $gender = filter_var($gender, FILTER_SANITIZE_STRING);

   $address = $_POST['address'];
   $address = filter_var($address, FILTER_SANITIZE_STRING);

   $contact = $_POST['contact'];
   $contact = filter_var($contact, FILTER_SANITIZE_STRING);

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
  
   $username = $_POST['username'];
   $username = filter_var($username, FILTER_SANITIZE_STRING);

   $pass = md5($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $cpass = md5($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   $user_type = $_POST['user_type'];

   $image = $_FILES['image']['name'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_size = $_FILES['image']['size'];
   $image_folder = 'uploaded_img/'.$image;

   $select = $conn->prepare("SELECT * FROM `user_form` WHERE username = ?");
   $select->execute([$username]);

   if($select->rowCount() > 0){
      $message[] = 'user already exist!';
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }elseif($image_size > 2000000){
         $message[] = 'image size is too large!';
      }else{
         $insert = $conn->prepare("INSERT INTO `user_form`(name, gender, address,contact, email, username, password, user_type, image) VALUES(?,?,?,?,?,?,?,?,?)");
         $insert->execute([$name, $gender, $address, $contact, $email, $username, $cpass, $user_type, $image]);
         if($insert){
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'registered succesfully!';
            header('location:login_form.php');
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

  <title>Register</title>
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
  <style>
    /* Adjust the margin-top of the section to create space below the header */
    .section {
      margin-top: 100px;
    }
  </style>
</head>


<body>

  <section class="vh-100 section mt-3">
    <div class="container-fluid h-custom">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-md-6 col-lg-5 col-xl-4">
          <img src="assets/img/worker.png" class="img-fluid" alt="Sample image">
        </div>

        <div class="col-md-6 col-lg-5 col-xl-4">
          <div class="card bg-transparent">
            <div class="card-body">
            

                <form action="" method="post" enctype="multipart/form-data">
                  <h3 class="login-heading my-4" style="text-align: center;">Register Now</h3>
                  <?php
                  if (isset($message)) {
                    foreach ($message as $msg) {
                      echo '
                      <div class="message">
                        <span>' . $msg . '</span>
                        <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
                      </div>
                      ';
                    }
                  }
                  ?>

                  <div class="row">
                    <div class="form-outline mb-4">
                      <label for="name">Full name</label>
                      <input type="text" name="name"  class="form-control" required placeholder="Full name">
                    </div>

                    <div class="form-outline mb-4">
                      <label for="gender">Gender</label>
                      <select id="gender" name="gender" class="form-control" required>
                        <option value="" disabled selected>Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                      </select>
                    </div>
                  </div>

                  <div class="form-outline mb-4">
                    <label for="address">Address</label>
                    <input type="text" name="address"  class="form-control" required placeholder="Address">
                  </div>

                  <div class="form-outline mb-4">
                    <label for="contact">Phone Number</label>
                    <input type="text" name="contact"  class="form-control" required placeholder="Phone Number">
                  </div>

                  <div class="form-outline mb-4">
                    <label for="email">Email Address</label>
                    <input type="email" name="email" class="form-control" required placeholder="Email Address">
                  </div>

                  <div class="form-outline mb-4">
                    <label for="username">Username</label>
                    <input type="text" name="username" class="form-control" required placeholder="Username">
                  </div>

                  <div class="form-outline mb-4">
                    <label for="password">Password</label>
                    <input type="password" name="pass"  class="form-control" required placeholder="Password">
                  </div>

                  <div class="form-outline mb-4">
                    <label for="cpassword">Confirm Password</label>
                    <input type="password" name="cpass" class="form-control" required placeholder="Confirm your password">
                  </div>

                  <div class="form-outline mb-4">
                    <label for="user_type">User Type</label>
                    <select name="user_type" id="user_type" class="form-control" required>
                      <option value="" disabled selected>Select User Type</option>
                      <option value="customer">Customer</option>
                      <option value="seller">Seller</option>
                    </select>
                  </div>

                  <div class="form-outline mb-4">
                    <label for="image">Image</label>
                    <input type="file" name="image" required id="image" class="form-control" accept="image/jpg, image/png, image/jpeg">
                  </div>

                  <button type="submit" name="submit" class="btn btn-primary w-100">Register Now</button>

                  <p>Already have an account? <a href="login_form.php">Login Now</a></p>
                </form>


            </div>
          </div>
        </div>

      </div>
    </div>
  </section>

  <!-- ======= Footer ======= -->

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


<?php

include 'config.php';

session_start();

if(isset($_POST['submit'])){

   $username = $_POST['username'];
   $username = filter_var($username, FILTER_SANITIZE_STRING);
   $pass = md5($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $select = $conn->prepare("SELECT * FROM `user_form` WHERE username = ? AND password = ?");
   $select->execute([$username, $pass]);
   $row = $select->fetch(PDO::FETCH_ASSOC);

   if($select->rowCount() > 0){

      if($row['user_type'] == 'customer'){

         $_SESSION['customer_id'] = $row['id'];
         header('location:customer.php');

      }elseif($row['user_type'] == 'admin'){

         $_SESSION['admin_id'] = $row['id'];
         header('location:admin_dashboard.php');
 
      }elseif($row['user_type'] == 'seller'){

         $_SESSION['seller_id'] = $row['id'];
         header('location:registration_hardware.php');
 
      }else{
         $message[] = 'no user found!';
      }
      
   }else{
      $message[] = 'incorrect email or password!';
   }

}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Login</title>
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
    .h-custom {
      height: 100%;
    }

    .center-section {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100%;
    }
  </style>

</head>

<body>

  <section class="vh-100 section mt-3">
    <div class="container-fluid h-custom">
      <div class="row d-flex justify-content-center align-items-center h-100 center-section">
        <div class="col-md-6 col-lg-5 col-xl-4">
          <img src="assets/img/worker.png" class="img-fluid" alt="Sample image">
        </div>

        <div class="col-md-6 col-lg-5 col-xl-4">
          <div class="card bg-transparent">
            <div class="card-body">
              <div class="d-flex justify-content-center mb-4">
                <img src="assets/img/m-logo1.png" alt="Logo" width="120" height="auto">
              </div>

              <form action="" method="post" enctype="multipart/form-data">
                <h3 class="login-heading my-4" style="text-align: center;">Login Now</h3>
                <?php
                if (isset($message)) {
                  foreach ($message as $message) {
                    echo '
               <div class="message">
                  <span>' . $message . '</span>
                  <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
               </div>
               ';
                  }
                }
                ?>

                <div class="form-outline mb-4">
                  <label for="username">Username</label>
                  <input type="text" name="username" required class="form-control" placeholder="Enter your username">
                </div>

                <div class="form-outline mb-4">
                  <label for="password">Password</label>
                  <input type="password" name="pass" required class="form-control" placeholder="Enter your password">
                </div>

                <button type="submit" name="submit" class="btn btn-primary w-100">Login Now</button>
                <p>Don't have an account? <a href="register_form.php">Register Now</a></p>
              </form>
            </div>
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

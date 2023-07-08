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
         header('location:seller.php');
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

      }elseif($row['user_type'] == 'admin'){

         $_SESSION['admin_name'] = $row['name']; //prob1
         header('location:admin_dashboard.php');
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
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Login Form</title>

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<div class="form-container">

   <form action="" method="post">
      <h3>Login Now</h3>
            <?php
            if(!empty($error)){
               foreach($error as $errorMessage){
                  echo '<span class="error-msg">'.$errorMessage.'</span>';
               }
            }
            ?>
      <input type="text" name="username" required placeholder="Enter your email">
      <input type="password" name="password" required placeholder="Enter your password">
      <input type="submit" name="submit" value="Login Now" class="form-btn">
      <p>Don't have an account? <a href="register_form.php">Register Now</a></p>
   </form>

</div>

</body>
</html>

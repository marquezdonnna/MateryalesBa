<?php
// Include database connection file
include_once 'config.php';

// Retrieve form data
$id = $_POST['id'];
$name = $_POST['name'];
$gender = $_POST['gender'];
$address = $_POST['address'];
$contact = $_POST['contact'];
$user_type = $_POST['user_type'];


// Update data in the database
$sql = "UPDATE user_form SET name='$name', gender='$gender', address='$address', contact='$contact', user_type='$user_type' WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    // Redirect to index.php after successful update
    header('Location: admin_user_information.php');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close database connection
$conn->close();
?>
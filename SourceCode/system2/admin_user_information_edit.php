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
$sql = "UPDATE user_form SET name = :name, gender = :gender, address = :address, contact = :contact, user_type = :user_type WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':name', $name);
$stmt->bindParam(':gender', $gender);
$stmt->bindParam(':address', $address);
$stmt->bindParam(':contact', $contact);
$stmt->bindParam(':user_type', $user_type);
$stmt->bindParam(':id', $id);

if ($stmt->execute()) {
    // Redirect to admin_user_information.php after successful update
    header('Location: admin_user_information.php');
} else {
    echo "Error: " . $stmt->errorInfo()[2];
}

// Close database connection
$conn = null;
?>

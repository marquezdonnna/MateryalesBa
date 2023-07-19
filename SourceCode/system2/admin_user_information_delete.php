<?php
// Include database connection file
include_once 'config.php';

// Retrieve form data
$id = $_POST['delete_id'];

// Delete data from the database
$sql = "DELETE FROM user_form WHERE id = :id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':id', $id);

if ($stmt->execute()) {
    // Redirect to admin_user_information.php after successful deletion
    header('Location: admin_user_information.php');
} else {
    echo "Error: " . $stmt->errorInfo()[2];
}

// Close database connection
$conn = null;
?>

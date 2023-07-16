<?php
// Include database connection file
include_once 'config.php';

// Retrieve form data
$id = $_POST['id'];

// Delete data from the database
$sql = "DELETE FROM user_form WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    // Redirect to index.php after successful deletion
    header('Location: admin_user_information.php');
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close database connection
$conn->close();
?>
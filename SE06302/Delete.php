<?php
include 'db.php';

// Check if 'id' is set in the URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // Delete query
    $sql = "DELETE FROM users WHERE id = $id";

    if ($conn->query($sql)) {
        // Redirect to manager.php after successful deletion
        header('Location: Manage.php');
        exit();  // Make sure no further code is executed after the redirect
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}
?>

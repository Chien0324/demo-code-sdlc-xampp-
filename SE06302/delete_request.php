<?php

include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];

    $stmt = $conn->prepare("DELETE FROM requests WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: Manage.php");
    } else {
        echo "Xóa yêu cầu thất bại: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>

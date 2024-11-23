<?php
include('db.php'); // Kết nối với cơ sở dữ liệu

// Kiểm tra nếu có ID từ URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Xóa thời gian biểu theo ID
    $sql = "DELETE FROM schedule WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
        header("Location: Manage.php");
    } else {
        echo "Error: " . $conn->error;
    }
} else {
    echo "No ID provided!";
}

$conn->close();
?>

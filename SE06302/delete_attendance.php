<?php
include('db.php');

// Xử lý khi người dùng yêu cầu xóa bản ghi
if (isset($_GET['id'])) {
    $attendance_id = $_GET['id']; // Lấy ID từ URL

    // Chuẩn bị câu lệnh SQL để xóa bản ghi
    $stmt = $conn->prepare("DELETE FROM attendance WHERE id = ?");
    $stmt->bind_param("i", $attendance_id);
    
    if ($stmt->execute()) {
        echo "<script>alert('Đã xóa bản ghi thành công!'); window.location.href='Manage.php';</script>";  // Sau khi xóa, chuyển lại về trang hiện tại
    } else {
        echo "Lỗi: " . $stmt->error;  // Thông báo lỗi nếu có
    }
    $stmt->close();
}

// Đóng kết nối
$conn->close();
?>

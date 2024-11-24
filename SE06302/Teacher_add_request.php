<?php

include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy dữ liệu từ form
    $id = $_POST['id'];  // Nhận giá trị id từ form
    $username = $_POST['username'];
    $Courses = $_POST['Courses'];
    $request_text = $_POST['request_text'];

    // Sửa câu lệnh SQL để chèn id do người dùng nhập
    $stmt = $conn->prepare("INSERT INTO requests (id, username, Courses, request_text) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("isss", $id, $username, $Courses, $request_text);

    // Thực thi câu lệnh
    if ($stmt->execute()) {
        header("Location: Manage.php");
        exit(); // Đảm bảo chuyển hướng sau khi chèn thành công
    } else {
        echo "Thêm yêu cầu thất bại: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Request</title>
    <link rel="stylesheet" href="add_request.css">
    <style>
        body{
            background-image: url(https://cloud-web-cms-beta.s3.cloud.cmctelecom.vn/1_chung_chi_cong_nghe_thong_tin_55144b2891.png);
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

    </style>
</head>
<body>

    <div class="add-request">
        <h2>Add New Request</h2>
        <form action="add_request.php" method="POST">
            <!-- Thêm trường ID cho phép người dùng nhập giá trị -->
            <input type="number" name="id" placeholder="ID" required>
            <input type="text" name="username" placeholder="Student Name" required>
            <input type="text" name="Courses" placeholder="Course" required>
            <textarea name="request_text" placeholder="Request Details" required></textarea>
            <button type="submit">Add Request</button>
            <p class="text-center mt-3">Return to <a href="Teacher.php">Teacher</a></p>
        </form>
    </div>

</body>
</html>



<?php include 'db.php'; ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $description = $_POST['description'];
    $time = $_POST['time'];

    // Kiểm tra nếu ID đã tồn tại
    $checkStmt = $conn->prepare("SELECT COUNT(*) FROM courses WHERE id = ?");
    $checkStmt->bind_param("s", $id);
    $checkStmt->execute();
    $checkStmt->bind_result($count);
    $checkStmt->fetch();
    $checkStmt->close();

    if ($count > 0) {
        echo "<p style='color: red; text-align: center;'>ID already exists. Please use a different ID.</p>";
    } else {
        // Thêm dữ liệu vào bảng courses
        $stmt = $conn->prepare("INSERT INTO courses (id, name, description, time) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $id, $name, $description, $time);
        $stmt->execute();
        $stmt->close();

        // Chuyển hướng sau khi thêm thành công
        header("Location: Manage.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="add_course.css">
    <title>Add New Course</title>
    <style>
        h1 {
            font-size: 25px;
        }

        p {
            text-align: center;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Add New Course</h1>
        <form method="POST">
            <div class="form-group">
                <label for="id">ID:</label>
                <input type="text" id="id" name="id" required>
            </div>
            <div class="form-group">
                <label for="name">Course Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" required></textarea>
            </div>
            <div class="form-group">
                <label for="description">Time:</label>
                <input type="text" id="time" name="time" required>
            </div>
            <button type="submit" class="btn">Add Course</button>
            <p class="text-center mt-3">Return to <a href="Manage.php">Manage</a></p>
        </form>
    </div>
</body>
</html>

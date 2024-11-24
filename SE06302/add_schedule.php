<?php
include('db.php'); // Kết nối với cơ sở dữ liệu

// Kiểm tra nếu form được gửi đi
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy dữ liệu từ form
    $id = $_POST['id']; // Lấy id từ form
    $day = $_POST['day'];
    $month = $_POST['month'];
    $year = $_POST['year'];
    $class = $_POST['class'];
    $Courses = $_POST['Courses'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $activity = $_POST['activity'];

    // Kết hợp ngày, tháng, năm thành một ngày sinh hoàn chỉnh
    $dob = $year . '-' . $month . '-' . $day;

    // Chuẩn bị câu lệnh SQL sử dụng prepared statements để tránh SQL injection
    $stmt = $conn->prepare("INSERT INTO schedule (id, class, Courses, start_time, end_time, activity, birth_date) 
                            VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $id, $class, $Courses, $start_time, $end_time, $activity, $dob);

    // Kiểm tra nếu câu lệnh SQL thực thi thành công
    if ($stmt->execute()) {
        echo "New timetable added successfully!";
        header("Location: Manage.php"); // Điều hướng về trang quản lý
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Timetable</title>
    <link rel="stylesheet" href="add_schedule.css"> 
    <style>
        body {
         background-image: url('https://blog.topcv.vn/wp-content/uploads/2020/09/cong-nghe-thong-tin-la-gi-tn.jpg');
         background-size: cover;
         background-position: center;
         background-attachment: fixed;
    
    }

       .container {
         width: 25%;
    }
    </style>
</head>
<body>
    <div class="container">  
        <h1>Add New Timetable</h1>
        <form method="POST">
            <label for="id">ID:</label>
            <input type="text" id="id" name="id" required>

            <div class="mb-3">
                <label for="dob" class="form-label">Date of Birth:</label>
                <div id="dob" class="d-flex gap-2">
                    <select name="day" id="dob-day" class="form-select" required>
                        <option value="">Day</option>
                        <?php for ($i = 1; $i <= 31; $i++) echo "<option value='$i'>$i</option>"; ?>
                    </select>
                    <select name="month" id="dob-month" class="form-select" required>
                        <option value="">Month</option>
                        <?php for ($i = 1; $i <= 12; $i++) echo "<option value='$i'>$i</option>"; ?>
                    </select>
                    <select name="year" id="dob-year" class="form-select" required>
                        <option value="">Year</option>
                        <?php for ($i = 1900; $i <= date("Y"); $i++) echo "<option value='$i'>$i</option>"; ?>
                    </select>
                </div>
            </div>

            <label for="class">Class:</label>
            <input type="text" id="class" name="class" required>

            <label for="Courses">Course:</label>
            <input type="text" id="Courses" name="Courses" required>

            <label for="start_time">Start time:</label>
            <input type="time" id="start_time" name="start_time" required>

            <label for="end_time">End time:</label>
            <input type="time" id="end_time" name="end_time" required>

            <label for="activity">Activity:</label>
            <input type="text" id="activity" name="activity" required>

            <button type="submit">Add Timetable</button>
            <p class="text-center mt-3">Updated course information? <a href="Manage.php">Manage</a></p>
        </form>
    </div>
</body>
</html>

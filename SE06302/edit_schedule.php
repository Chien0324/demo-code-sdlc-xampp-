<?php
include('db.php'); // Kết nối với cơ sở dữ liệu

// Kiểm tra nếu có ID từ URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Lấy dữ liệu thời gian biểu theo ID
    $sql = "SELECT * FROM schedule WHERE id = $id";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Kiểm tra nếu form được submit
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy dữ liệu từ form
            $class = $_POST['class'];
            $Courses = $_POST['Courses'];
            $start_time = $_POST['start_time'];
            $end_time = $_POST['end_time'];
            $activity = $_POST['activity'];

            // Lấy giá trị ngày sinh từ form (người dùng nhập vào dưới dạng ngày, tháng, năm)
            $birth_day = $_POST['birth_day'];
            $birth_month = $_POST['birth_month'];
            $birth_year = $_POST['birth_year'];

            // Kết hợp thành định dạng DATE (YYYY-MM-DD)
            $birth_date = $birth_year . '-' . str_pad($birth_month, 2, '0', STR_PAD_LEFT) . '-' . str_pad($birth_day, 2, '0', STR_PAD_LEFT);

            // Cập nhật dữ liệu vào bảng schedule
            $sql = "UPDATE schedule SET class='$class', Courses='$Courses', start_time='$start_time', 
                    end_time='$end_time', activity='$activity', birth_date='$birth_date' WHERE id=$id";

            // Thực hiện câu lệnh cập nhật
            if ($conn->query($sql) === TRUE) {
                echo "Record updated successfully";
                header("Location: manage.php"); // Chuyển hướng đến trang quản lý sau khi cập nhật thành công
                exit();
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    } else {
        echo "No record found with that ID!";
    }
} else {
    echo "No ID provided!";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Timetable</title>
    <link rel="stylesheet" href="edit_schedule.css"> <!-- Liên kết với file CSS -->
</head>
<body>
    <div class="container">  
        <h1>Edit Timetable</h1>
        <form method="POST">
            <!-- Trường ID (Chỉ đọc, không thể thay đổi) -->
            <label for="id">ID:</label>
            <input type="text" id="id" name="id" value="<?php echo $row['id']; ?>" readonly>

            <!-- Trường Date of Birth (ngày, tháng, năm) -->
            <div class="input-group">
                <div class="day">
                    <label for="birth_day">Day:</label>
                    <input type="number" id="birth_day" name="birth_day" value="<?php echo date('d', strtotime($row['birth_date'])); ?>" min="1" max="31" required>
                </div>
                <div class="month">
                    <label for="birth_month">Month:</label>
                    <input type="number" id="birth_month" name="birth_month" value="<?php echo date('m', strtotime($row['birth_date'])); ?>" min="1" max="12" required>
                </div>
                <div class="year">
                    <label for="birth_year">Year:</label>
                    <input type="number" id="birth_year" name="birth_year" value="<?php echo date('Y', strtotime($row['birth_date'])); ?>" min="1900" max="2100" required>
                </div>
            </div>

            <label for="class">Class:</label>
            <input type="text" id="class" name="class" value="<?php echo $row['class']; ?>" required>

            <label for="Courses">Course:</label>
            <input type="text" id="Courses" name="Courses" value="<?php echo $row['Courses']; ?>" required>

            <label for="start_time">Start time:</label>
            <input type="time" id="start_time" name="start_time" value="<?php echo $row['start_time']; ?>" required>

            <label for="end_time">End time:</label>
            <input type="time" id="end_time" name="end_time" value="<?php echo $row['end_time']; ?>" required>

            <label for="activity">Activity:</label>
            <input type="text" id="activity" name="activity" value="<?php echo $row['activity']; ?>" required>

            <button type="submit">Update Timetable</button>
            <p class="text-center mt-3">Updated course information? <a href="manage.php">Manage</a></p>
        </form>
    </div>
</body>
</html>

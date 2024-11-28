<?php
include('db.php');

// Lấy từ khóa tìm kiếm từ URL
$searchKeyword = isset($_GET['search']) ? trim($_GET['search']) : '';

// Truy vấn cơ sở dữ liệu dựa trên từ khóa tìm kiếm
if (!empty($searchKeyword)) {
    $sql = "SELECT * FROM attendance WHERE user_id LIKE '%$searchKeyword%'";
} else {
    $sql = "SELECT * FROM attendance";
}

$result = $conn->query($sql);

// Thêm bản ghi khi nhấn nút "Update"
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    // Lặp qua tất cả các dòng trong bảng và thêm bản ghi mới vào cơ sở dữ liệu
    $sql_add = "SELECT * FROM attendance";
    $data = $conn->query($sql_add);

    if ($data->num_rows > 0) {
        while ($row = $data->fetch_assoc()) {
            $user_id = $row['user_id']; // Giữ nguyên User ID
            $course_id = $row['course_id']; // Giữ nguyên Course ID
            $schedule_id = $row['schedule_id']; // Giữ nguyên Schedule ID
            $attendance_date = $row['attendance_date']; // Giữ nguyên Attendance Date
            $status = $row['status']; // Giữ nguyên Status
            $note = $row['note']; // Giữ nguyên Note

            // Thêm bản ghi mới vào bảng attendance
            $insert_sql = "INSERT INTO listattendance (user_id, course_id, schedule_id, attendance_date, status, note) 
                           VALUES (?, ?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($insert_sql);
            $stmt->bind_param('ssssss', $user_id, $course_id, $schedule_id, $attendance_date, $status, $note);
            $stmt->execute();
        }
    } else {
        $msg = "No data to add!";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Điểm Danh</title>
    <link rel="stylesheet" href="Teacher_manageAttendance.css"> <!-- Đường dẫn tới file CSS -->
    <style>
    h2 {
    color: #e212a4;
    }
    th {
    background-color: black;
    }
    </style>
</head>
<body>
    <h2>Attendance</h2>>

    <!-- Hiển thị thông báo nếu có -->
    <?php if (isset($msg)): ?>
        <p><?= $msg ?></p>
    <?php endif; ?>

    <!-- Bảng danh sách điểm danh -->
    <?php if ($result->num_rows > 0): ?>
        <table>
            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>Course ID</th>
                <th>Schedule ID</th>
                <th>Attendance Date</th>
                <th>Status</th>
                <th>Note</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr id="row-<?= $row['id'] ?>">
                    <td><?= $row["id"] ?></td>
                    <td><?= $row["user_id"] ?></td>
                    <td><?= $row["course_id"] ?></td>
                    <td><?= $row["schedule_id"] ?></td>
                    <td contenteditable="true" class="attendance_date"><?= $row["attendance_date"] ?></td>
                    <td contenteditable="true" class="status"><?= $row["status"] ?></td>
                    <td contenteditable="true" class="note"><?= $row["note"] ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>Không có dữ liệu phù hợp!</p>
    <?php endif; ?>

    <!-- Nút update thêm bản ghi -->
    <form method="POST">
        <button type="submit" name="update" class="btn-update">Update</button>
    </form>
</body>
</html>

<?php 
$conn->close();
?>
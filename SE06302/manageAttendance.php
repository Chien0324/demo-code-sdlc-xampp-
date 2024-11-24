<?php
include('db.php');

// Lấy danh sách điểm danh từ cơ sở dữ liệu
$sql = "SELECT * FROM attendance";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh Sách Điểm Danh</title>
    <link rel="stylesheet" href="manageAttendance.css"> <!-- Đường dẫn tới file CSS -->
</head>
<body>
    <h2>Danh Sách Điểm Danh</h2>
    
    <!-- Nút Thêm bản ghi -->
    <a href="Add_attendance.php">
        <button>Add New Record</button>
    </a>

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
                <th>Actions</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row["id"] ?></td>
                    <td><?= $row["user_id"] ?></td>
                    <td><?= $row["course_id"] ?></td>
                    <td><?= $row["schedule_id"] ?></td>
                    <td><?= $row["attendance_date"] ?></td>
                    <td><?= $row["status"] ?></td>
                    <td><?= $row["note"] ?></td>
                    <td>
                        <a href="Edit_attendance.php?id=<?= $row['id'] ?>" class="btn edit">Edit</a>
                        <!-- Link xóa bản ghi -->
                        <a href="delete_attendance.php?id=<?= $row['id'] ?>" class="btn delete" onclick="return confirm('Bạn có chắc chắn muốn xóa bản ghi này không?');">Delete</a>
                    </td>
                </tr>  
            <?php endwhile; ?>
        </table>
    <?php else: ?>
        <p>Không có dữ liệu!</p>
    <?php endif; ?>

</body>
</html>

<?php 
$conn->close();
?>

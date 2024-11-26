<?php
include('db.php');

// Lấy từ khóa tìm kiếm từ URL nếu có
$searchKeyword = isset($_GET['search']) ? trim($_GET['search']) : '';

// Truy vấn cơ sở dữ liệu dựa trên từ khóa tìm kiếm
if (!empty($searchKeyword)) {
    $sql = "SELECT * FROM listattendance WHERE user_id LIKE ?";
    $stmt = $conn->prepare($sql);
    $searchParam = "%" . $searchKeyword . "%";  // Thêm dấu % vào trước và sau từ khóa
    $stmt->bind_param("s", $searchParam); // "s" là kiểu dữ liệu string
} else {
    $sql = "SELECT * FROM listattendance";
    $stmt = $conn->prepare($sql); // Không cần bind_param khi không có điều kiện tìm kiếm
}

$stmt->execute();
$result = $stmt->get_result(); // Lấy kết quả từ câu truy vấn
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
    <h2>Manage List Attendance</h2>

    <!-- Thanh điều hướng và tìm kiếm -->
    <div class="header-bar">
        <input type="text" id="search" placeholder="Search by User ID" value="<?= htmlspecialchars($searchKeyword) ?>">
        <button onclick="searchData()">Search</button>
    </div>

    <!-- Bảng danh sách điểm danh -->
    <div id="attendanceTable">
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
                    <tr>
                        <td><?= $row["id"] ?></td>
                        <td><?= $row["user_id"] ?></td>
                        <td><?= $row["course_id"] ?></td>
                        <td><?= $row["schedule_id"] ?></td>
                        <td><?= $row["attendance_date"] ?></td>
                        <td><?= $row["status"] ?></td>
                        <td><?= $row["note"] ?></td>
                    </tr>  
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p>Không có dữ liệu phù hợp!</p>
        <?php endif; ?>
    </div>

    <script>
        // Hàm tìm kiếm bằng JavaScript (sử dụng AJAX để tìm kiếm mà không tải lại trang)
        function searchData() {
            const searchInput = document.getElementById('search').value.trim();

            // Nếu có giá trị tìm kiếm
            if (searchInput) {
                // Gửi AJAX request
                const xhr = new XMLHttpRequest();
                xhr.open("GET", "search_attendance.php?search=" + encodeURIComponent(searchInput), true);
                xhr.onload = function() {
                    if (xhr.status === 200) {
                        // Cập nhật nội dung bảng với kết quả tìm kiếm
                        document.getElementById('attendanceTable').innerHTML = xhr.responseText;
                    }
                };
                xhr.send();
            } else {
                // Nếu không có từ khóa, load lại tất cả dữ liệu
                window.location.href = "?";
            }
        }
    </script>
</body>
</html>

<?php 
$stmt->close(); // Đóng prepared statement
$conn->close(); // Đóng kết nối cơ sở dữ liệu
?>

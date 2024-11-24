<?php
include('db.php');

// Lấy từ khóa tìm kiếm từ URL
$searchKeyword = isset($_GET['search']) ? trim($_GET['search']) : '';

// Truy vấn cơ sở dữ liệu dựa trên từ khóa tìm kiếm
if (!empty($searchKeyword)) {
    $sql = "SELECT * FROM listattendance WHERE user_id LIKE ?";
    $stmt = $conn->prepare($sql);
    $searchParam = "%" . $searchKeyword . "%";
    $stmt->bind_param("s", $searchParam);
} else {
    $sql = "SELECT * FROM listattendance";
    $stmt = $conn->prepare($sql);
}

$stmt->execute();
$result = $stmt->get_result(); // Lấy kết quả từ câu truy vấn

// Render lại bảng kết quả tìm kiếm
if ($result->num_rows > 0) {
    echo '<table>
            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>Course ID</th>
                <th>Schedule ID</th>
                <th>Attendance Date</th>
                <th>Status</th>
                <th>Note</th>
                <th>Actions</th>
            </tr>';
    while ($row = $result->fetch_assoc()) {
        echo '<tr>
                <td>' . $row["id"] . '</td>
                <td>' . $row["user_id"] . '</td>
                <td>' . $row["course_id"] . '</td>
                <td>' . $row["schedule_id"] . '</td>
                <td>' . $row["attendance_date"] . '</td>
                <td>' . $row["status"] . '</td>
                <td>' . $row["note"] . '</td>
                <td>
                    <a href="Edit_attendance.php?id=' . $row['id'] . '" class="btn edit">Edit</a>
                    <a href="delete_attendance.php?id=' . $row['id'] . '" class="btn delete" onclick="return confirm(\'Bạn có chắc chắn muốn xóa bản ghi này không?\');">Delete</a>
                </td>
            </tr>';
    }
    echo '</table>';
} else {
    echo '<p>Không có dữ liệu phù hợp!</p>';
}

$stmt->close(); // Đóng prepared statement
$conn->close(); // Đóng kết nối cơ sở dữ liệu
?>

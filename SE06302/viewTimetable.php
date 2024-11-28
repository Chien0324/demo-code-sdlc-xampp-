<?php
include('db.php'); // Kết nối với cơ sở dữ liệu

// Lấy dữ liệu từ bảng schedule
$sql = "SELECT * FROM schedule";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Timetable</title>
    <link rel="stylesheet" href="viewTimetable.css">
    <style>
    a[href="add_schedule.php"] {
       background-color: #146e29;
    }
    /* Header styling */
    h1 {
    color: #e40dbd;
    }

    </style>
</head>
<body>
    <h1>Manage Timetable</h1>
    
    <a href="add_schedule.php">Add New Timetable</a>
    
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Date of Birth</th>
            <th>Class</th>
            <th>Course</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Activity</th>
            <th>Actions</th>
        </tr>
        
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Hiển thị ngày sinh từ cột birth_date
                $birth_date = $row['birth_date'];
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . date('d/m/Y', strtotime($birth_date)) . "</td>"; // Định dạng ngày tháng năm
                echo "<td>" . $row['class'] . "</td>";
                echo "<td>" . $row['Courses'] . "</td>";
                echo "<td>" . $row['start_time'] . "</td>";
                echo "<td>" . $row['end_time'] . "</td>";
                echo "<td>" . $row['activity'] . "</td>";
                echo "<td>
                        <a href='edit_schedule.php?id=" . $row['id'] . "'>Edit</a> 
                        <a href='delete_schedule.php?id=" . $row['id'] . "'>Delete</a>
                      </td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='8'>No records found</td></tr>";
        }
        ?>
    </table>

</body>
</html>

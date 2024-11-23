<?php include 'db.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="manageCourses.css">
    <title>Course Management</title>
</head>
<body>
    <h1>Course Management</h1>
    <a href="add_course.php" class="btn">Add New Course</a>
    <table>
        <tr>
            <th>ID</th>
            <th>Course Name</th>
            <th>Description</th>
            <th>Time</th>
            <th>Action</th>
        </tr>
        <?php
        // Sắp xếp theo ID từ thấp đến cao
        $result = $conn->query("SELECT * FROM courses ORDER BY id ASC");
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['name']}</td>
                    <td>{$row['description']}</td>
                    <td>{$row['time']}</td>
                    <td>
                        <a href='Delete_course.php?id={$row['id']}' class='btn delete'>Delete</a>
                    </td>
                </tr>";
        }
        ?>
    </table>
</body>
</html>

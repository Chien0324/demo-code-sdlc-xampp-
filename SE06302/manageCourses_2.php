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
    <h1>Course</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Course Name</th>
            <th>Description</th>
            <th>Time</th>
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
                </tr>";
        }
        ?>
    </table>
</body>
</html>

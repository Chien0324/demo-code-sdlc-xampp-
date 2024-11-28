<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="manageGrades.css">
    <title>Grade Management</title>
    <style>
        body {
            background-image: url(https://cloud-web-cms-beta.s3.cloud.cmctelecom.vn/1_chung_chi_cong_nghe_thong_tin_55144b2891.png);
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        thead th {
            background: #302e2e;
        }

        a.btn, button {
            background: #198754;
        }
    </style>
</head>
<body>
    <h1>Grade Management </h1>
    <a href="Add_grade_3.php" class="btn">Add New Grade</a>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>User ID</th>
                <th>Student Name</th>
                <th>Gender</th>
                <th>Course ID</th>
                <th>Course</th>
                <th>Score</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include 'db.php';
            $result = $conn->query("SELECT * FROM Grades ORDER BY id ASC");
            while ($row = $result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['id']}</td>
                        <td>{$row['user_id']}</td>
                        <td>{$row['username']}</td>
                        <td>{$row['gender']}</td>
                        <td>{$row['course_id']}</td>
                        <td>{$row['Courses']}</td>
                        <td>{$row['score']}</td>
                        <td>
                            <a href='Edit_grade_3.php?id={$row['id']}' class='btn'>Edit</a>
                        </td>
                    </tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>

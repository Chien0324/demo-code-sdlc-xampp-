<?php include 'db.php'; ?>
<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $gender = $_POST['gender'];
    $Courses = $_POST['Courses'];
    $score = $_POST['score'];

    $stmt = $conn->prepare("INSERT INTO Grades (id, username, gender, Courses, score) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssd", $id, $username, $gender, $Courses, $score);
    $stmt->execute();
    $stmt->close();
    header("Location: Manage.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Add_grade.css">
    <title>Add New Grade</title>
    <style>
        body {
            background-image: url('https://blog.topcv.vn/wp-content/uploads/2020/09/cong-nghe-thong-tin-la-gi-tn.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
        
    </style>
</head>
<body>
    <div class="container">  
        <h1>Add New Grade</h1>
        <form method="POST">
            <label for="id">ID:</label>
            <input type="text" id="id" name="id" required>
            <label>Student Name:</label>
            <input type="text" name="username" required>
            <label>Gender:</label>
            <select name="gender" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
            </select>
            <label>Course:</label>
            <input type="text" name="Courses" required>
            <label>Score:</label>
            <input type="number" step="0.1" name="score" required>
            <button type="submit">Add Grade</button>
            <p class="text-center mt-3">Updated course information? <a href="Manage.php">Manage</a></p>
        </form>
    </div>
</body>
</html>
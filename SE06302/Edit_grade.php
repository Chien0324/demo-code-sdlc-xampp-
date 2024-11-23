<?php include 'db.php'; ?>
<?php
$id = $_GET['id'] ?? null; // Kiểm tra nếu 'id' được truyền qua GET
if ($id) {
    // Lấy thông tin từ database
    $result = $conn->query("SELECT * FROM Grades WHERE id = $id");
    if ($result->num_rows > 0) {
        $grade = $result->fetch_assoc();
    } else {
        die("Grade with ID $id not found!");
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $gender = $_POST['gender'];
    $Courses = $_POST['Courses'];
    $score = $_POST['score'];

    $stmt = $conn->prepare("UPDATE Grades SET username = ?, gender = ?, Courses = ?, score = ? WHERE id = ?");
    $stmt->bind_param("sssdi", $username, $gender, $Courses, $score, $id);
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
    <link rel="stylesheet" href="Edit_grade.css">
    <title>Edit Grade</title>
</head>
<body>
    <div class="container">
        <h1>Edit Grade</h1>
        <form method="POST">
            <label for="id">ID:</label>
            <input type="text" id="id" name="id" value="<?php echo $grade['id'] ?? ''; ?>" readonly required>

            <label>Student Name:</label>
            <input type="text" name="username" value="<?php echo $grade['username'] ?? ''; ?>" required>

            <label>Gender:</label>
            <select name="gender" required>
                <option value="Male" <?php if (isset($grade['gender']) && $grade['gender'] == 'Male') echo 'selected'; ?>>Male</option>
                <option value="Female" <?php if (isset($grade['gender']) && $grade['gender'] == 'Female') echo 'selected'; ?>>Female</option>
            </select>

            <label>Course:</label>
            <input type="text" name="Courses" value="<?php echo $grade['Courses'] ?? ''; ?>" required>

            <label>Score:</label>
            <input type="number" step="0.1" name="score" value="<?php echo $grade['score'] ?? ''; ?>" required>

            <button type="submit">Update Grade</button>
            <p class="text-center mt-3">Return to <a href="Manage.php">Manage</a></p>
        </form>
    </div>
</body>
</html>

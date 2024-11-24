<?php 

include('db.php');

// Check if data is submitted via the form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $id = isset($_POST['id']) ? $_POST['id'] : null;
    $user_id = $_POST['user_id'];
    $course_id = $_POST['course_id'];
    $schedule_id = $_POST['schedule_id'];
    $attendance_date = $_POST['attendance_date'];
    $status = $_POST['status'];
    $note = $_POST['note'] ?? null; // Allow NULL if no value is provided

    // Prepare SQL statement with prepared statement
    $stmt = $conn->prepare(
        "INSERT INTO attendance (id, user_id, course_id, schedule_id, attendance_date, status, note)
         VALUES (?, ?, ?, ?, ?, ?, ?)"
    );

    // Check if statement preparation failed
    if (!$stmt) {
        die("Query preparation failed: " . $conn->error);
    }

    // Bind values to the parameters
    $stmt->bind_param("iiissss", $id, $user_id, $course_id, $schedule_id, $attendance_date, $status, $note);

    // Execute the SQL query
    if ($stmt->execute()) {
        $message = "Record added successfully!";
        $messageType = "success";
    } else {
        $message = "Error: " . $stmt->error;
        $messageType = "error";
    }

    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>

<!-- HTML Form for data entry -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Attendance Record</title>
    <link rel="stylesheet" href="Edit_attendance.css">
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
    <h2>Add New Record</h2>
    <form action="" method="POST">
        <label for="id">ID:</label>
        <input type="number" id="id" name="id" required><br><br>

        <label for="user_id">User ID:</label>
        <input type="number" id="user_id" name="user_id" required><br><br>

        <label for="course_id">Course ID:</label>
        <input type="number" id="course_id" name="course_id" required><br><br>

        <label for="schedule_id">Schedule ID:</label>
        <input type="number" id="schedule_id" name="schedule_id" required><br><br>

        <label for="attendance_date">Attendance Date:</label>
        <input type="date" id="attendance_date" name="attendance_date" required><br><br>

        <label for="status">Status:</label>
        <select id="status" name="status" required>
            <option value="Present">Present</option>
            <option value="On time">On Time</option>
        </select><br><br>

        <label for="note">Note:</label>
        <textarea id="note" name="note" rows="4" cols="50"></textarea><br><br>

        <button type="submit">Add</button>
        <p class="text-center mt-3">Return to <a href="Manage.php">Manage</a></p>
    </form>
    </div>
</body>
</html>

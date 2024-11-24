<?php 
include('db.php');

// Check if ID is provided in the URL
if (!isset($_GET['id'])) {
    die("ID not provided.");
}

$id = $_GET['id'];

// Fetch the current record from the database
$stmt = $conn->prepare("SELECT * FROM attendance WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Record not found with ID: " . $id);
}

$row = $result->fetch_assoc();
$stmt->close();

// Check if the form data has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve data from the form
    $user_id = $_POST['user_id'];
    $course_id = $_POST['course_id'];
    $schedule_id = $_POST['schedule_id'];
    $attendance_date = $_POST['attendance_date'];
    $status = $_POST['status'];
    $note = $_POST['note'] ?? null; // Allow NULL if no value is provided

    // Prepare SQL query to update the record
    $stmt = $conn->prepare(
        "UPDATE attendance 
         SET user_id = ?, course_id = ?, schedule_id = ?, attendance_date = ?, status = ?, note = ?
         WHERE id = ?"
    );

    // Check if the statement failed to prepare
    if (!$stmt) {
        die("Query preparation failed: " . $conn->error);
    }

    // Bind the parameters
    $stmt->bind_param("iiisssi", $user_id, $course_id, $schedule_id, $attendance_date, $status, $note, $id);

    // Execute the SQL query
    if ($stmt->execute()) {
        $message = "Record updated successfully!";
        $messageType = "success";
    } else {
        $message = "Error: " . $stmt->error;
        $messageType = "error";
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>

<!-- HTML Form for Editing Data -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Attendance Record</title>
    <link rel="stylesheet" href="Edit_attendance.css">
    <style>
        body {
            background-image: url('https://blog.topcv.vn/wp-content/uploads/2020/09/cong-nghe-thong-tin-la-gi-tn.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }

        /* Notification bar styling */
        .notification {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            padding: 15px;
            text-align: center;
            font-size: 16px;
            font-weight: bold;
            color: #fff;
            display: none; /* Hidden by default */
            z-index: 9999;
        }

        .notification.success {
            background-color: #4caf50; /* Green for success */
        }

        .notification.error {
            background-color: #f44336; /* Red for errors */
        }
    </style>
</head>
<body>
    <!-- Notification Bar -->
    <?php if (isset($message)): ?>
        <div class="notification <?= $messageType ?>" id="notification">
            <?= htmlspecialchars($message) ?>
        </div>
    <?php endif; ?>

    <div class="container"> 
        <h2>Edit Record</h2>
        <form action="" method="POST">
            <label for="id">ID:</label>
            <input type="number" id="id" name="id" value="<?= htmlspecialchars($row['id']) ?>" readonly><br><br>

            <label for="user_id">User ID:</label>
            <input type="number" id="user_id" name="user_id" value="<?= htmlspecialchars($row['user_id']) ?>" required><br><br>

            <label for="course_id">Course ID:</label>
            <input type="number" id="course_id" name="course_id" value="<?= htmlspecialchars($row['course_id']) ?>" required><br><br>

            <label for="schedule_id">Schedule ID:</label>
            <input type="number" id="schedule_id" name="schedule_id" value="<?= htmlspecialchars($row['schedule_id']) ?>" required><br><br>

            <label for="attendance_date">Attendance Date:</label>
            <input type="date" id="attendance_date" name="attendance_date" value="<?= htmlspecialchars($row['attendance_date']) ?>" required><br><br>

            <label for="status">Status:</label>
            <select id="status" name="status" required>
                <option value="Present" <?= $row['status'] === 'Present' ? 'selected' : '' ?>>Present</option>
                <option value="On time" <?= $row['status'] === 'On time' ? 'selected' : '' ?>>On Time</option>
            </select><br><br>

            <label for="note">Note:</label>
            <textarea id="note" name="note" rows="4" cols="50"><?= htmlspecialchars($row['note']) ?></textarea><br><br>

            <button type="submit">Update</button>
            <p class="text-center mt-3">Return to <a href="Manage.php">Manage</a></p>
        </form>
    </div>

    <script>
        // Display notification if it exists
        document.addEventListener("DOMContentLoaded", function () {
            const notification = document.getElementById("notification");
            if (notification) {
                notification.style.display = "block";
                // Automatically hide after 5 seconds
                setTimeout(() => {
                    notification.style.display = "none";
                }, 5000);
            }
        });
    </script>
</body>
</html>

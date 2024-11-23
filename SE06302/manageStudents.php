<?php
include 'db.php';

// Check database connection
if ($conn->connect_error) {
    die("Database connection failed: " . $conn->connect_error);
}

// Fetch the list of users
$sql = "SELECT * FROM users";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management</title>
    <link rel="stylesheet" href="manageStudents.css">
    <style>
        table th{
            background-color: #212529;
            color: white;
        }
    </style>
</head>
<body>
    <h1>Manage Students</h1>
    <a href="Register.php" class="btn">Add User</a>
    <?php if ($result->num_rows > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Gender</th>
                    <th>Date of Birth</th>
                    <th>Phone</th>
                    <th>Profession</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= htmlspecialchars($row['username']) ?></td>
                        <td><?= $row['gender'] ?></td>
                        <td><?= $row['birth_day'] ?>/<?= $row['birth_month'] ?>/<?= $row['birth_year'] ?></td>
                        <td><?= $row['phone'] ?></td>
                        <td><?= $row['profession'] ?></td>
                        <td><?= htmlspecialchars($row['email']) ?></td>
                        <td><?= $row['password'] ?></td> <!-- Display password -->
                        <td>
                            <a href="Edit.php?id=<?= $row['id'] ?>" class="btn">Edit</a>
                            <a href="Delete.php?id=<?= $row['id'] ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete?')">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p style="text-align: center; color: #555;">No users found in the database.</p>
    <?php endif; ?>
</body>
</html>

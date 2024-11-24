<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Request Management</title>
    <link rel="stylesheet" href="manageRequest.css">
</head>
<body>
    <h2>Request List</h2>
    
    <div class="container">
        <!-- Request list -->
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Student Name</th>
                    <th>Course</th>
                    <th>Request Details</th>
                    <th>Created At</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'db.php';
                
                // Fetch the list of requests and order by ID in ascending order
                $sql = "SELECT * FROM requests ORDER BY id ASC";  // Sắp xếp theo id tăng dần
                $result = $conn->query($sql);
                
                while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><?= $row['username'] ?></td>
                        <td><?= $row['Courses'] ?></td>
                        <td><?= $row['request_text'] ?></td>
                        <td><?= $row['created_at'] ?></td>
                        <td>
                            <form action="delete_request.php" method="post" style="display:inline;">
                                <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                <button type="submit" class="delete-btn">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</body>
</html>

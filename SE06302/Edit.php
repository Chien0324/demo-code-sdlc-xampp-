<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sdlc_asm";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$message = "";
$user = null; // Khởi tạo để tránh lỗi khi không có 'id'

// Hiển thị thông tin nếu 'id' được truyền qua GET
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM users WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    if (!$user) {
        die("User not found.");
    }
}

// Xử lý form khi nhấn nút sửa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $re_password = $_POST['re_password'];
    $gender = $_POST['gender'];
    $profession = $_POST['profession'];
    $day = $_POST['day'];
    $month = $_POST['month'];
    $year = $_POST['year'];
    $phone = $_POST['phone'];

    if ($password != $re_password) {
        $message = "<p class='text-danger'>Passwords do not match!</p>";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("SELECT id FROM users WHERE (id != ? AND email = ?)");
        $stmt->bind_param("is", $id, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $message = "<p class='text-danger'>Email already exists!</p>";
        } else {
            $stmt = $conn->prepare("UPDATE users SET username = ?, gender = ?, birth_day = ?, birth_month = ?, birth_year = ?, phone = ?, profession = ?, email = ?, password = ? WHERE id = ?");
            $stmt->bind_param("ssiiissssi", $username, $gender, $day, $month, $year, $phone, $profession, $email, $hashed_password, $id);

            if ($stmt->execute()) {
                $message = "<div class='alert alert-success mt-4'>You have successfully edited your information!</div>";
            } else {
                $message = "<p class='text-danger'>Update failed. Please try again.</p>";
            }
        }
        $stmt->close();
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="Register.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .E7 {
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div id="form-container" class="col-md-6 shadow p-4">
                <h2 id="form-title" class="text-center mb-4">Edit User</h2>
                <form action="" method="post" id="edit-form">
                    <div class="mb-3">
                        <label for="id" class="form-label">ID:</label>
                        <input type="text" name="id" id="id" class="form-control" value="<?= $user['id'] ?? '' ?>" readonly>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username:</label>
                        <input type="text" name="username" id="username" class="form-control" value="<?= $user['username'] ?? '' ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Gender:</label>
                        <div class="form-check">
                            <input type="radio" name="gender" id="gender-male" value="Male" class="form-check-input" <?= (isset($user['gender']) && $user['gender'] == "Male") ? 'checked' : '' ?> required>
                            <label for="gender-male" class="form-check-label">Male</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" name="gender" id="gender-female" value="Female" class="form-check-input" <?= (isset($user['gender']) && $user['gender'] == "Female") ? 'checked' : '' ?>>
                            <label for="gender-female" class="form-check-label">Female</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="dob" class="form-label">Date of Birth:</label>
                        <div id="dob" class="d-flex gap-2">
                            <select name="day" id="dob-day" class="form-select" required>
                                <option value="">Day</option>
                                <?php for ($i = 1; $i <= 31; $i++): ?>
                                    <option value="<?= $i ?>" <?= (isset($user['birth_day']) && $user['birth_day'] == $i) ? 'selected' : '' ?>><?= $i ?></option>
                                <?php endfor; ?>
                            </select>
                            <select name="month" id="dob-month" class="form-select" required>
                                <option value="">Month</option>
                                <?php for ($i = 1; $i <= 12; $i++): ?>
                                    <option value="<?= $i ?>" <?= (isset($user['birth_month']) && $user['birth_month'] == $i) ? 'selected' : '' ?>><?= $i ?></option>
                                <?php endfor; ?>
                            </select>
                            <select name="year" id="dob-year" class="form-select" required>
                                <option value="">Year</option>
                                <?php for ($i = 1900; $i <= date("Y"); $i++): ?>
                                    <option value="<?= $i ?>" <?= (isset($user['birth_year']) && $user['birth_year'] == $i) ? 'selected' : '' ?>><?= $i ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number:</label>
                        <input type="tel" name="phone" id="phone" class="form-control" value="<?= $user['phone'] ?? '' ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Profession:</label>
                        <div class="form-check">
                            <input type="radio" name="profession" id="profession-student" value="Student" class="form-check-input" required>
                            <label for="profession-student" class="form-check-label">Student</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" name="profession" id="profession-manager" value="Manager" class="form-check-input">
                            <label for="profession-manager" class="form-check-label">Manage</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" name="profession" id="profession-teacher" value="Teacher" class="form-check-input">
                            <label for="profession-teacher" class="form-check-label">Teacher</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" name="profession" id="profession-another" value="Another" class="form-check-input">
                            <label for="profession-another" class="form-check-label">Another</label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" name="email" id="email" class="form-control" value="<?= $user['email'] ?? '' ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="New password" required>
                    </div>
                    <div class="mb-3">
                        <label for="re_password" class="form-label">Re-enter Password:</label>
                        <input type="password" name="re_password" id="re_password" class="form-control" placeholder="Confirm new password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Update</button>
                    <p class="text-center mt-3">Return to <a href="Manage.php" class="E7">Manage</a></p>
                </form>
                <?= $message ?>
            </div>
        </div>
    </div>
</body>
</html>








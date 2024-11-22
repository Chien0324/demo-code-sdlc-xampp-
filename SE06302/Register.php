<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="Register.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div id="form-container" class="col-md-6 shadow p-4">
                <h2 id="form-title" class="text-center mb-4">Register</h2>
                <form action="" method="post" id="register-form">
                    <div class="mb-3">
                        <label for="ID" class="form-label">ID:</label>
                        <input type="text" name="id" id="id" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="username" class="form-label">Username:</label>
                        <input type="text" name="username" id="username" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Gender:</label>
                        <div class="form-check">
                            <input type="radio" name="gender" id="gender-male" value="Male" class="form-check-input" required>
                            <label for="gender-male" class="form-check-label">Male</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" name="gender" id="gender-female" value="Female" class="form-check-input">
                            <label for="gender-female" class="form-check-label">Female</label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="dob" class="form-label">Date of Birth:</label>
                        <div id="dob" class="d-flex gap-2">
                            <select name="day" id="dob-day" class="form-select" required>
                                <option value="">Day</option>
                                <?php for ($i = 1; $i <= 31; $i++) echo "<option value='$i'>$i</option>"; ?>
                            </select>
                            <select name="month" id="dob-month" class="form-select" required>
                                <option value="">Month</option>
                                <?php for ($i = 1; $i <= 12; $i++) echo "<option value='$i'>$i</option>"; ?>
                            </select>
                            <select name="year" id="dob-year" class="form-select" required>
                                <option value="">Year</option>
                                <?php for ($i = 1900; $i <= date("Y"); $i++) echo "<option value='$i'>$i</option>"; ?>
                            </select>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number:</label>
                        <input type="tel" name="phone" id="phone" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Profession:</label>
                        <div class="form-check">
                            <input type="radio" name="profession" id="profession-student" value="Student" class="form-check-input" required>
                            <label for="profession-student" class="form-check-label">Student</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" name="profession" id="profession-manager" value="Manager" class="form-check-input">
                            <label for="profession-manager" class="form-check-label">Manager</label>
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
                        <input type="email" name="email" id="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password:</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Minimum 6 to 8 characters" required>
                    </div>

                    <div class="mb-3">
                        <label for="re_password" class="form-label">Re-enter Password:</label>
                        <input type="password" name="re_password" id="re_password" class="form-control" placeholder="Minimum 6 to 8 characters" required>
                    </div>

                    <button type="submit" id="submit-button" class="btn btn-primary w-100">Register</button>
                    <p class="text-center mt-3">Already have an account? <a href="login.php">Sign in</a></p>
                </form>

                <?php if (isset($message)) echo $message; ?>
            </div>
        </div>
    </div>
</body>
</html>



<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "se06302_asm_sdlc";


$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}


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
    $message = "";

    if ($password != $re_password) {
        $message = "<p class='text-danger'>Passwords do not match!</p>";
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("SELECT ID, email FROM users WHERE ID = ? OR email = ?");
        $stmt->bind_param("ss", $id, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $message = "<p class='text-danger'>ID or Email already exists!</p>";
        } else {
            $stmt = $conn->prepare("INSERT INTO users (ID, username, gender, birth_day, birth_month, birth_year, phone, profession, email, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssiiisss", $id, $username, $gender, $day, $month, $year, $phone, $profession, $email, $hashed_password);

            if ($stmt->execute()) {
                $message = "<div class='alert alert-success mt-4'>Registration successful!</div>";
            } else {
                $message = "<p class='text-danger'>Registration failed. Please try again.</p>";
            }
        }
        $stmt->close();
    }
    $conn->close();
}

?>



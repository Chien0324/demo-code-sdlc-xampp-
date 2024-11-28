<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="Login.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
        <div class="login-form">
         <h2>Login</h2>
            <form action="" method="post">
                <label>Account :</label>
                <input type="text" name="account" placeholder="Email or Phone number" required>
                
                <label>Password :</label>
                <input type="password" name="password" placeholder="Minimum 6 to 8 characters" required>
                
                <br><button type="submit">Login</button>
                <p>Don't have an account? <a href="register.php">Create an account</a></p>
            </form>
        </div>
</body>
</html>



    <?php
// Kết nối cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sdlc_asm";

$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Kiểm tra khi form được submit
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Lấy dữ liệu từ form
    $account = $_POST['account'];
    $password = $_POST['password'];

    // Sử dụng Prepared Statement để bảo mật
    $stmt = $conn->prepare("SELECT * FROM users WHERE (email = ? OR username = ?)");
    $stmt->bind_param("ss", $account, $account);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $hashed_password = $user['password']; // Lấy mật khẩu đã mã hóa từ cơ sở dữ liệu

        // Kiểm tra mật khẩu nếu đã mã hóa
        if (password_verify($password, $hashed_password)) {
            $profession = strtolower($user['profession']); 

            // Điều hướng theo nghề nghiệp
            if ($profession == 'student') {
                header("Location: Student.php");
                exit(); // Đảm bảo script dừng lại tại đây
            } elseif ($profession == 'teacher') {
                header("Location: Teacher.php");
                exit(); // Đảm bảo script dừng lại tại đây
            } elseif ($profession == 'manage') {
                header("Location: Manage.php");
                exit(); // Đảm bảo script dừng lại tại đây
            } else {
                echo "<p class='error'>Nghề nghiệp không hợp lệ.</p>";
            }
        } else {
            echo "<p class='error'>Thông tin đăng nhập không đúng.</p>";
        }
    } else {
        echo "<p class='error'>Thông tin đăng nhập không đúng.</p>";
    }

    $stmt->close();
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        table.table {
            background-color: #fff;
            border-collapse: collapse;
        }
        table.table th {
            background-color: #007bff;
            color: #fff;
            text-align: center;
        }
        table.table td {
            text-align: center;
            vertical-align: middle;
        }
        .btn {
            margin: 2px;
        }
        h2 {
            text-align: center;
        }
        .welcome-section {
            justify-content: flex-end;
            display: flex;
            align-items: center;
        }
        .welcome-section span {
            margin-right: 15px;
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Include Sidebar Menu -->
        <?php include 'menu.php'; ?>

        <!-- Main Content -->
        <div class="container-fluid p-4">
            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2>Dashboard</h2>
                <div class="welcome-section">
                    <span>Welcome!</span>
                    <a href="Login.php" class="btn btn-danger">Logout</a>
                </div>
            </div>

            <!-- Content Area -->
            <div class="content">
                <?php
                // Lấy giá trị 'page' từ query string
                $page = isset($_GET['page']) ? $_GET['page'] : '';

                // Hiển thị nội dung tương ứng
                // switch ($page) {
                //     case 'students':
                //         include 'student.php';
                //         break;
                //     case 'courses':
                //         include 'course.php';
                //         break;
                //     case 'classes':
                //         include 'classes.php';
                //         break;
                //     case 'grades':
                //         include 'grades.php';
                //         break;
                //     case 'timetable': // Bảng thời khóa biểu
                //         include 'timetable.php';
                //         break;
                //     case 'tuition': // Học phí
                //         include 'tuition.php';
                //         break;
                //     default: // Hiển thị bảng thời khóa biểu mặc định
                //         include 'timetable.php';
                // }
                ?>
            </div>
        </div>
    </div>
</body>
</html>

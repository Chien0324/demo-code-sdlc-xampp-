<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Management - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url(https://cloud-web-cms-beta.s3.cloud.cmctelecom.vn/1_chung_chi_cong_nghe_thong_tin_55144b2891.png);
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
        }
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
            color: #db13a1;
        }
        .welcome-section {
            justify-content: flex-end;
            display: flex;
            align-items: center;
        }
        .welcome-section span {
            margin-right: 15px;
            color: #db13a1;
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Include Sidebar Menu -->
        <?php include 'Menu_teacher.php'; ?>

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
                switch ($page) {
                    case 'grades':
                        include 'manageGrades_2.php';
                        break;
                    case 'timetable': 
                        include 'viewTimetable_2.php';
                        break;
                    case 'attendance': 
                        include 'Teacher_manageAttendance.php';
                        break;
                    case 'listattendance': 
                        include 'ListAttendance_2.php';
                        break;
                }
                ?>
            </div>
        </div>
    </div>
</body>
</html>

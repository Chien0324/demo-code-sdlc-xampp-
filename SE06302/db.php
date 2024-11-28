<?php
$host = 'localhost';
$username = 'root'; // Thay bằng username thực tế
$password = '';     // Thay bằng password thực tế
$database = 'se06302_sdlc_17';

$conn = new mysqli($host, $username, $password, $database);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
?>

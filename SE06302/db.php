<?php
$host = 'localhost';
$username = 'root'; // Thay bằng username thực tế
$password = '';     // Thay bằng password thực tế
$database = 'sdlc_Asm';

$conn = new mysqli($host, $username, $password, $database);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
?>

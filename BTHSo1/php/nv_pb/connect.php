<?php
$host = "localhost";  // thường là localhost
$user = "root";       // username mặc định XAMPP
$pass = "";           // password mặc định trống
$dbname = "DULIEU";

// Kết nối
$conn = new mysqli($host, $user, $pass, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
$conn->set_charset("utf8"); // để hiển thị tiếng Việt đúng
?>

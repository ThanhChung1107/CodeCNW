<?php
$host = "localhost";
$user = "root";
$pass = ""; // <-- THAY THẾ bằng mật khẩu thực tế của bạn
$dbname = "DULIEU";
$port = 3307; // <-- THÊM CỔNG 3307

// Kết nối
// Thêm $port vào tham số cuối cùng
$conn = new mysqli($host, $user, $pass, $dbname, $port); 

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
$conn->set_charset("utf8"); // để hiển thị tiếng Việt đúng
?>
<?php
include 'connect.php';

// Thực hiện lệnh xóa tất cả nhân viên
$sql = "DELETE FROM nhanvien";

if ($conn->query($sql) === TRUE) {
    echo "<script>
        alert('✅ Đã xóa toàn bộ nhân viên thành công!');
        window.location.href = 'xoatatca.php';
    </script>";
} else {
    echo "❌ Lỗi khi xóa tất cả nhân viên: " . $conn->error;
}

$conn->close();
?>

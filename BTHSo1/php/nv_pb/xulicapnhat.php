<?php
include 'connect.php';

// Lấy dữ liệu từ REQUEST (ưu tiên POST, nhưng REQUEST vẫn nhận được nếu là GET)
$idpb = $_REQUEST['IDPB'] ?? null;
$tenpb = $_REQUEST['Tenpb'] ?? null;
$mota = $_REQUEST['Mota'] ?? null;

if (!$idpb || !$tenpb || !$mota) {
    die("❌ Thiếu thông tin, vui lòng nhập đầy đủ!");
}

// Cập nhật dữ liệu
$sql = "UPDATE phongban SET Tenpb='$tenpb', Mota='$mota' WHERE IDPB='$idpb'";

if ($conn->query($sql) === TRUE) {
    echo "<h3>✅ Đã cập nhật thành công phòng ban <strong>$idpb</strong>!</h3>";
    echo "<a href='capnhat.php'>⬅️ Quay lại danh sách</a>";
} else {
    echo "❌ Lỗi khi cập nhật: " . $conn->error;
}

$conn->close();
?>

<?php
include 'connect.php';

// Lấy IDPB từ URL hoặc form (dùng REQUEST)
$idpb = $_REQUEST['IDPB'] ?? null;

if (!$idpb) {
    die("❌ Không có mã phòng ban để cập nhật.");
}

// Lấy dữ liệu phòng ban hiện tại
$sql = "SELECT * FROM phongban WHERE IDPB = '$idpb'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $pb = $result->fetch_assoc();
} else {
    die("❌ Không tìm thấy phòng ban có ID: $idpb");
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Cập nhật phòng ban</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        input { padding: 6px; margin-bottom: 10px; width: 250px; }
        button { padding: 6px 12px; cursor: pointer; margin-right: 10px; }
    </style>
</head>
<body>

<h2>✏️ Cập nhật thông tin phòng ban</h2>

<form action="xulicapnhat.php" method="post">
    <label>IDPB:</label><br>
    <input type="text" name="IDPB" value="<?=$pb['IDPB']?>" readonly><br>

    <label>Tên phòng ban:</label><br>
    <input type="text" name="Tenpb" value="<?=$pb['Tenpb']?>" required><br>

    <label>Mô tả:</label><br>
    <input type="text" name="Mota" value="<?=$pb['Mota']?>" required><br>

    <button type="submit">💾 Lưu thay đổi</button>
    <a href="capnhatpb.php"><button type="button">⬅️ Quay lại</button></a>
</form>

</body>
</html>

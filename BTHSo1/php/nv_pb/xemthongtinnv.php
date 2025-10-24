<?php
include 'connect.php'; // kết nối database

$sql = "SELECT IDNV, Hoten, IDPB, Diachi FROM nhanvien";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách nhân viên</title>
</head>
<body>
<h2>Danh sách nhân viên</h2>
<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>Mã nhân viên</th>
        <th>Họ tên</th>
        <th>Mã phòng ban</th>
        <th>Địa chỉ</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        // Duyệt từng dòng
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['IDNV']}</td>
                    <td>{$row['Hoten']}</td>
                    <td>{$row['IDPB']}</td>
                    <td>{$row['Diachi']}</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='3'>Không có dữ liệu</td></tr>";
    }
    $conn->close();
    ?>
</table>
</body>
</html>

<?php
include 'connect.php'; // file kết nối database

// Lấy IDPB từ URL
$idpb = $_GET['IDPB'] ?? '';

$sql = "SELECT IDNV, Hoten, Diachi FROM nhanvien WHERE IDPB = '$idpb'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Nhân viên thuộc phòng <?php echo htmlspecialchars($idpb); ?></title>
</head>
<body>
<h2>Danh sách nhân viên của phòng <?php echo htmlspecialchars($idpb); ?></h2>

<table border="1" cellpadding="5" cellspacing="0">
    <tr>
        <th>Mã nhân viên</th>
        <th>Họ tên</th>
        <th>Địa chỉ</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['IDNV']}</td>
                    <td>{$row['Hoten']}</td>
                    <td>{$row['Diachi']}</td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='3'>Không có nhân viên trong phòng này</td></tr>";
    }
    $conn->close();
    ?>
</table>
</body>
</html>

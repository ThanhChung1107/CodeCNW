<?php
include 'connect.php';
$sql = "SELECT * FROM nhanvien";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Xóa nhân viên</title>
</head>
<body>
    <h2>🗑️ Xóa nhân viên</h2>

    <form action="xulixoa.php" method="post" onsubmit="return confirm('Bạn có chắc muốn xóa các nhân viên đã chọn không?')">
        <table border="1" cellpadding="8" cellspacing="0">
            <tr>
                <th>Chọn</th>
                <th>IDNV</th>
                <th>Tên nhân viên</th>
                <th>IDPB</th>
                <th>Địa chỉ</th>
            </tr>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><input type="checkbox" name="chon[]" value="<?= $row['IDNV'] ?>"></td>
                    <td><?= $row['IDNV'] ?></td>
                    <td><?= $row['hoten'] ?></td>
                    <td><?= $row['IDPB'] ?></td>
                    <td><?= $row['Diachi'] ?></td>
                </tr>
            <?php } ?>
        </table>
        <br>
        <button type="submit">🗑️ Xóa nhân viên đã chọn</button>
    </form>

    <br>
    <a href="index.php">⬅️ Quay lại trang chính</a>
</body>
</html>

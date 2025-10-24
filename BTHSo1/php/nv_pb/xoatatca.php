<?php
include 'connect.php';
$sql = "SELECT * FROM nhanvien";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Xóa tất cả nhân viên</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { border-collapse: collapse; width: 70%; }
        th, td { border: 1px solid #888; padding: 6px 10px; text-align: center; }
        th { background-color: #eee; }
        button { padding: 8px 12px; cursor: pointer; }
    </style>
    <script>
        function confirmDeleteAll() {
            return confirm("⚠️ Bạn có chắc muốn xóa TẤT CẢ nhân viên không?");
        }
    </script>
</head>
<body>
    <h2>🧨 Xóa tất cả nhân viên</h2>

    <table>
        <tr>
            <th>IDNV</th>
            <th>Họ tên</th>
            <th>IDPB</th>
            <th>Địa chỉ</th>
        </tr>
        <?php if ($result->num_rows > 0) { ?>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?= $row['IDNV'] ?></td>
                    <td><?= $row['hoten'] ?></td>
                    <td><?= $row['IDPB'] ?></td>
                    <td><?= $row['Diachi'] ?></td>
                </tr>
            <?php } ?>
        <?php } else { ?>
            <tr><td colspan="4">Không có dữ liệu</td></tr>
        <?php } ?>
    </table>

    <br>

    <form action="xulixoatatca.php" method="post" onsubmit="return confirmDeleteAll();">
        <button type="submit" style="background-color:red;color:white;">🗑️ Xóa tất cả nhân viên</button>
    </form>

    <br>
    <a href="home.php">⬅️ Quay lại trang chính</a>
</body>
</html>

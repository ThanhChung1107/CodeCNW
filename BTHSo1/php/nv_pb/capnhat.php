<?php
include 'connect.php';

$sql = "SELECT * FROM phongban";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách phòng ban</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { border-collapse: collapse; width: 70%; margin-top: 20px; }
        th, td { border: 1px solid #888; padding: 6px 10px; text-align: center; }
        th { background-color: #eee; }
        a button { padding: 6px 12px; cursor: pointer; }
    </style>
</head>
<body>

<h2>📋 Danh sách phòng ban</h2>
<table>
    <tr>
        <th>IDPB</th>
        <th>Tên phòng ban</th>
        <th>Mô tả</th>
        <th>Thao tác</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>{$row['IDPB']}</td>
                <td>{$row['Tenpb']}</td>
                <td>{$row['Mota']}</td>
                <td>
                    <a href='form_capnhat.php?IDPB={$row['IDPB']}'><button>✏️ Cập nhật</button></a>
                </td>
            </tr>";
        }
    } else {
        echo "<tr><td colspan='4'>Không có dữ liệu</td></tr>";
    }
    $conn->close();
    ?>
</table>

</body>
</html>

<?php
include 'connect.php';

$sql = "SELECT IDPB, Tenpb, Mota FROM phongban";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách phòng ban</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
        .detail-link {
            color: #3498db;
            text-decoration: none;
            cursor: pointer;
        }
        .detail-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<h2>Danh sách phòng ban</h2>
<table>
    <tr>
        <th>Mã phòng ban</th>
        <th>Tên phòng ban</th>
        <th>Mô tả</th>
        <th>Xem chi tiết</th>
    </tr>
    <?php
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['IDPB']}</td>
                    <td>{$row['Tenpb']}</td>
                    <td>{$row['Mota']}</td>
                    <td>
                        <a class='detail-link' onclick='
                            // Hiển thị loading
                            parent.document.getElementById(\"content-frame\").innerHTML = \"<div style=\\\"text-align: center; padding: 50px;\\\"><i class=\\\"fas fa-spinner fa-spin\\\"></i><p>Đang tải...</p></div>\";
                            
                            // Tải nội dung
                            fetch(\"xemthongtinnvpb.php?IDPB={$row['IDPB']}\")
                                .then(r => r.text())
                                .then(html => parent.document.getElementById(\"content-frame\").innerHTML = html)
                                .catch(err => parent.document.getElementById(\"content-frame\").innerHTML = \"<p>Lỗi tải dữ liệu</p>\")
                        '>Xem chi tiết</a>
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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Xóa sinh viên</title>
    <style>
        body { font-family: Arial; text-align: center; background: #f8f8f8; }
        table { margin: auto; border-collapse: collapse; width: 60%; background: #fff; box-shadow: 0 0 8px rgba(0,0,0,0.1); }
        th, td { border: 1px solid #ddd; padding: 10px; }
        th { background: #4CAF50; color: white; }
        a { text-decoration: none; color: #d9534f; font-weight: bold; }
        a:hover { text-decoration: underline; }
        .btn-delete-all {
            display: inline-block; margin-top: 20px; padding: 10px 15px;
            background: #d9534f; color: white; border-radius: 6px;
        }
        .btn-delete-all:hover { background: #c9302c; }
    </style>
</head>
<body>
    <h2>Danh sách sinh viên cần xóa</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Tên</th>
            <th>Tuổi</th>
            <th>Trường</th>
            <th>Hành động</th>
        </tr>
        <?php foreach ($students as $st): ?>
        <tr>
            <td><?= $st->id ?></td>
            <td><?= $st->name ?></td>
            <td><?= $st->age ?></td>
            <td><?= $st->university ?></td>
            <td>
                <a href="C_Student.php?mod3=1&stid=<?= $st->id ?>" onclick="return confirm('Xóa sinh viên này?')">Xóa</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>

    <a class="btn-delete-all" href="C_Student.php?mod4=1" onclick="return confirm('Bạn có chắc chắn muốn xóa TẤT CẢ sinh viên không?')">🗑 Xóa tất cả</a>
    <br><br>
    <a href="../index.php">⬅ Quay lại trang chính</a>
</body>
</html>

<!-- view/studentlistforupdate.php -->
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách sinh viên - Cập nhật</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background:#f2f2f2; margin:0; padding:0; }
        .container { width: 600px; background:#fff; margin:60px auto; padding:30px 40px; border-radius:12px; box-shadow:0 4px 12px rgba(0,0,0,0.12); }
        h2 { text-align:center; color:#333; margin-bottom:20px; }
        ul { list-style:none; padding:0; margin:0; }
        li { margin:8px 0; padding:12px; background:#f8f8f8; border-radius:8px; }
        li:hover { background:#e8eefc; }
        a { color:#2b6cdf; text-decoration:none; font-weight:600; }
        a:hover { text-decoration:underline; }
        .back { display:block; text-align:center; margin-top:18px; color:#555; }
    </style>
</head>
<body>
<div class="container">
    <h2>Chọn sinh viên cần cập nhật</h2>

    <?php if (!empty($students)): ?>
        <ul>
        <?php foreach ($students as $index => $student): ?>
            <li>
                <?= ($index + 1) ?>.
                <a href="C_Student.php?mod2=1&stid=<?= urlencode($student->id) ?>">
                    <?= htmlspecialchars($student->name) ?>
                </a>
            </li>
        <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Không có sinh viên nào trong danh sách.</p>
    <?php endif; ?>

    <a class="back" href="../index.php">← Quay lại trang chủ</a>
</div>
</body>
</html>

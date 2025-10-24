<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách sinh viên</title>
</head>
<body>
    <h2>Danh sách sinh viên:</h2>

    <?php if (!empty($students)): ?>
        <?php foreach ($students as $i => $student): ?>
            <p>
                <?= $i + 1 ?>.
                <a href="?stid=<?= htmlspecialchars($student->id) ?>">
                    <?= htmlspecialchars($student->name) ?>
                </a>
            </p>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Không có sinh viên nào trong danh sách.</p>
    <?php endif; ?>

    <br>
    <p><a href="../index.php">Trang chủ</a></p>
</body>
</html>

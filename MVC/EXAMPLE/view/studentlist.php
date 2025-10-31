<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách sinh viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            background-color: #f8f9fa;
        }
        .student-card {
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .student-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }
    </style>
</head>
<body>
    <!-- Thanh tiêu đề -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">Quản lý sinh viên</a>
            <a class="btn btn-light btn-sm" href="../index.php">Trang chủ</a>
        </div>
    </nav>

    <div class="container">
        <h2 class="text-center mb-4 text-primary">Danh sách sinh viên</h2>

        <?php if (!empty($students)): ?>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-3">
                <?php foreach ($students as $i => $student): ?>
                    <div class="col">
                        <div class="card student-card">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <?= $i + 1 ?>. 
                                    <a href="?stid=<?= htmlspecialchars($student->id) ?>" class="text-decoration-none">
                                        <?= htmlspecialchars($student->name) ?>
                                    </a>
                                </h5>
                                <p class="card-text text-muted mb-0">Mã SV: <?= htmlspecialchars($student->id) ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="alert alert-warning text-center mt-4">
                Không có sinh viên nào trong danh sách.
            </div>
        <?php endif; ?>

        <div class="text-center mt-4">
            <a href="../index.php" class="btn btn-outline-primary">⬅️ Quay lại trang chủ</a>
        </div>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thông tin sinh viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            background-color: #f8f9fa;
        }
        .card {
            max-width: 400px;
            margin: 50px auto;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
            border-radius: 15px;
        }
        .card-title {
            color: #0d6efd;
        }
        .btn-back {
            text-decoration: none;
        }
    </style>
</head>
<body>
    <!-- Thanh tiêu đề -->
    <nav class="navbar navbar-dark bg-primary">
        <div class="container">
            <span class="navbar-brand fw-bold">Chi tiết sinh viên</span>
        </div>
    </nav>

    <!-- Nội dung chính -->
    <div class="card p-4 mt-4">
        <div class="card-body text-center">
            <h4 class="card-title mb-3">Thông tin chi tiết</h4>
            <?php
                echo "<p><strong>Họ và tên:</strong> " . htmlspecialchars($student->name) . "</p>";
                echo "<p><strong>Tuổi:</strong> " . htmlspecialchars($student->age) . "</p>";
                echo "<p><strong>Trường học:</strong> " . htmlspecialchars($student->university) . "</p>";
            ?>
            <a href="javascript:history.back()" class="btn btn-outline-primary mt-3">⬅️ Quay lại</a>
        </div>
    </div>
</body>
</html>

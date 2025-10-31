<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sinh viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="#">Quản lý sinh viên</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="controller/C_Student.php">Xem sinh viên</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="controller/C_Student.php?mod1=1">Thêm sinh viên</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="controller/C_Student.php?mod2=1">Cập nhật sinh viên</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white" href="controller/C_Student.php?mod3=1">Xóa sinh viên</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-danger" href="controller/C_Student.php?mod4=1">Xóa tất cả</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Nội dung chính -->
    <div class="container mt-5">
        <h1 class="text-center mb-4">Chào mừng đến hệ thống quản lý sinh viên</h1>
        <p class="text-center text-muted">Chọn chức năng ở thanh điều hướng phía trên để thao tác.</p>
    </div>
</body>
</html>

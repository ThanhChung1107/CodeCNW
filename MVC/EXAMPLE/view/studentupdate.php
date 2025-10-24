<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Cập nhật thông tin sinh viên</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to right, #74ebd5, #ACB6E5);
            margin: 0;
            padding: 0;
        }
        .container {
            width: 400px;
            background: white;
            margin: 80px auto;
            padding: 30px 40px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }
        h2 {
            text-align: center;
            color: #333;
        }
        label {
            display: block;
            font-weight: bold;
            margin-top: 10px;
            color: #555;
        }
        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 8px 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 8px;
            transition: border-color 0.3s;
        }
        input[type="text"]:focus, input[type="number"]:focus {
            border-color: #5c6bc0;
            outline: none;
        }
        input[type="submit"] {
            margin-top: 20px;
            width: 100%;
            background-color: #5c6bc0;
            color: white;
            font-weight: bold;
            border: none;
            padding: 10px 0;
            border-radius: 8px;
            cursor: pointer;
            transition: 0.3s;
        }
        input[type="submit"]:hover {
            background-color: #3f51b5;
        }
        a {
            display: block;
            text-align: center;
            margin-top: 15px;
            text-decoration: none;
            color: #3f51b5;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Cập nhật thông tin sinh viên</h2>

    <?php if (isset($student) && $student): ?>
        <form method="POST" action="C_Student.php?mod2=1&stid=<?= urlencode($student->id) ?>">
            <label for="id">Mã SV:</label>
            <input type="text" id="id" name="id" value="<?= htmlspecialchars($student->id) ?>" readonly>

            <label for="name">Tên:</label>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($student->name) ?>" required>

            <label for="age">Tuổi:</label>
            <input type="number" id="age" name="age" value="<?= htmlspecialchars($student->age) ?>" required>

            <label for="university">Trường:</label>
            <input type="text" id="university" name="university" value="<?= htmlspecialchars($student->university) ?>" required>

            <input type="submit" value="Cập nhật">
        </form>
    <?php else: ?>
        <p style="text-align:center;">Không tìm thấy thông tin sinh viên để cập nhật.</p>
    <?php endif; ?>

    <a href="C_Student.php">← Quay lại danh sách</a>
</div>
</body>
</html>

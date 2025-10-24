<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm sinh viên mới</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f5f7fa;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .form-container {
            background: #fff;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }

        h2 {
            color: #2c3e50;
            margin-bottom: 25px;
        }

        label {
            display: block;
            text-align: left;
            font-weight: 600;
            margin-bottom: 5px;
            color: #34495e;
        }

        input[type="text"],
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 6px;
            border: 1px solid #ccc;
            font-size: 15px;
            transition: 0.2s;
        }

        input[type="text"]:focus,
        input[type="number"]:focus {
            border-color: #3498db;
            outline: none;
            box-shadow: 0 0 4px rgba(52, 152, 219, 0.3);
        }

        input[type="submit"] {
            background: #3498db;
            color: white;
            font-weight: bold;
            padding: 10px 15px;
            border: none;
            border-radius: 6px;
            width: 100%;
            cursor: pointer;
            transition: 0.2s;
        }

        input[type="submit"]:hover {
            background: #2980b9;
        }

        a {
            display: inline-block;
            margin-top: 15px;
            text-decoration: none;
            color: #3498db;
            font-weight: 500;
            transition: 0.2s;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Thêm sinh viên mới</h2>
        <form method="POST" action="C_Student.php?mod1=1">
            <label for="id">Mã SV:</label>
            <input type="text" id="id" name="id" required>

            <label for="name">Tên:</label>
            <input type="text" id="name" name="name" required>

            <label for="age">Tuổi:</label>
            <input type="number" id="age" name="age" required>

            <label for="university">Trường:</label>
            <input type="text" id="university" name="university" required>

            <input type="submit" value="Thêm mới">
        </form>
        <a href="C_Student.php">← Quay lại danh sách</a>
    </div>
</body>
</html>

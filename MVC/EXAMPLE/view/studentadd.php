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

        input.error {
            border-color: #e74c3c;
        }

        .error-message {
            color: #e74c3c;
            font-size: 13px;
            margin-top: -10px;
            margin-bottom: 10px;
            text-align: left;
            display: none;
        }

        .error-message.show {
            display: block;
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

        input[type="submit"]:hover:not(:disabled) {
            background: #2980b9;
        }

        input[type="submit"]:disabled {
            background: #95a5a6;
            cursor: not-allowed;
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
        <form method="POST" action="C_Student.php?mod1=1" id="addStudentForm">
            <label for="id">Mã SV:</label>
            <input type="text" id="id" name="id" required>
            <div class="error-message" id="idError">⚠️ Mã sinh viên đã tồn tại!</div>

            <label for="name">Tên:</label>
            <input type="text" id="name" name="name" required disabled>

            <label for="age">Tuổi:</label>
            <input type="number" id="age" name="age" required disabled>

            <label for="university">Trường:</label>
            <input type="text" id="university" name="university" required disabled>

            <input type="submit" value="Thêm mới" id="submitBtn">
        </form>
        <a href="C_Student.php">← Quay lại danh sách</a>
    </div>

    <script>
        const idInput = document.getElementById('id');
        const nameInput = document.getElementById('name');
        const ageInput = document.getElementById('age');
        const universityInput = document.getElementById('university');
        const idError = document.getElementById('idError');
        const submitBtn = document.getElementById('submitBtn');
        const form = document.getElementById('addStudentForm');

        let isIdValid = false;

        // Kiểm tra mã SV khi blur (rời khỏi ô input)
        idInput.addEventListener('blur', function() {
            const id = this.value.trim();
            
            if (id === '') {
                resetForm();
                return;
            }

            // Gọi API kiểm tra
            fetch(`C_Student.php?check_id=${encodeURIComponent(id)}`)
                .then(response => response.json())
                .then(data => {
                    if (data.exists) {
                        // Mã SV đã tồn tại
                        idInput.classList.add('error');
                        idError.classList.add('show');
                        disableOtherFields();
                        isIdValid = false;
                    } else {
                        // Mã SV hợp lệ
                        idInput.classList.remove('error');
                        idError.classList.remove('show');
                        enableOtherFields();
                        isIdValid = true;
                        nameInput.focus(); // Tự động focus vào ô tên
                    }
                })
                .catch(error => {
                    console.error('Lỗi kiểm tra mã SV:', error);
                    alert('Không thể kiểm tra mã sinh viên. Vui lòng thử lại!');
                });
        });

        // Khi thay đổi mã SV, reset trạng thái
        idInput.addEventListener('input', function() {
            idInput.classList.remove('error');
            idError.classList.remove('show');
            isIdValid = false;
            disableOtherFields();
        });

        // Ngăn submit nếu mã SV không hợp lệ
        form.addEventListener('submit', function(e) {
            if (!isIdValid) {
                e.preventDefault();
                alert('Vui lòng nhập mã sinh viên hợp lệ!');
                idInput.focus();
            }
        });

        function disableOtherFields() {
            nameInput.disabled = true;
            ageInput.disabled = true;
            universityInput.disabled = true;
            submitBtn.disabled = true;
        }

        function enableOtherFields() {
            nameInput.disabled = false;
            ageInput.disabled = false;
            universityInput.disabled = false;
            submitBtn.disabled = false;
        }

        function resetForm() {
            idInput.classList.remove('error');
            idError.classList.remove('show');
            isIdValid = false;
            disableOtherFields();
        }

        // Khởi tạo: disable các ô khác
        disableOtherFields();
    </script>
</body>
</html>
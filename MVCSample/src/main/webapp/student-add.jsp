<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8" %>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm sinh viên</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .form-container { max-width: 500px; margin: 0 auto; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
        input[type="text"], input[type="number"] { width: 100%; padding: 8px; }
        .btn { padding: 10px 20px; background: #007bff; color: white; border: none; cursor: pointer; }
        .back-link { display: inline-block; margin-bottom: 20px; }
        .error { color: red; margin-bottom: 10px; }
    </style>
</head>
<body>
    <a href="welcome.jsp" class="back-link">← Quay lại trang chủ</a>
    <div class="form-container">
        <h1>Thêm sinh viên mới</h1>
        
        <% if (request.getAttribute("error") != null) { %>
            <div class="error"><%= request.getAttribute("error") %></div>
        <% } %>
        
        <form action="add-student" method="post">
            <div class="form-group">
                <label for="name">Họ tên:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="age">Tuổi:</label>
                <input type="number" id="age" name="age" required>
            </div>
            <div class="form-group">
                <label for="university">Trường:</label>
                <input type="text" id="university" name="university" required>
            </div>
            <button type="submit" class="btn">Thêm sinh viên</button>
        </form>
    </div>
</body>
</html>
<%@page import="com.mvcsample.model.bean.Student"%>
<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8" %>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Sửa thông tin sinh viên</title>
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
        <h1>Sửa thông tin sinh viên</h1>
        
        <% if (request.getAttribute("error") != null) { %>
            <div class="error"><%= request.getAttribute("error") %></div>
        <% } %>
        
        <%
            Student student = (Student) request.getAttribute("student");
            if (student != null) {
        %>
        <form action="edit-student" method="post">
            <input type="hidden" name="id" value="<%= student.getId() %>">
            <div class="form-group">
                <label for="name">Họ tên:</label>
                <input type="text" id="name" name="name" value="<%= student.getName() %>" required>
            </div>
            <div class="form-group">
                <label for="age">Tuổi:</label>
                <input type="number" id="age" name="age" value="<%= student.getAge() %>" required>
            </div>
            <div class="form-group">
                <label for="university">Trường:</label>
                <input type="text" id="university" name="university" value="<%= student.getUniversity() %>" required>
            </div>
            <button type="submit" class="btn">Cập nhật</button>
        </form>
        <% } else { %>
            <p>Không tìm thấy thông tin sinh viên!</p>
        <% } %>
    </div>
</body>
</html>
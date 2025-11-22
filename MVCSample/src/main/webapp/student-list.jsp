<%@page import="com.mvcsample.model.bean.Student"%>
<%@page import="java.util.List"%>
<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8" %>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách sinh viên</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        th { background-color: #f2f2f2; }
        .action-links a { margin-right: 10px; text-decoration: none; }
        .back-link { display: inline-block; margin-bottom: 20px; }
        .message { color: green; margin: 10px 0; }
        .error { color: red; margin: 10px 0; }
        .search-form { margin: 20px 0; }
        .search-form input { padding: 8px; margin-right: 10px; }
        .stats { margin: 10px 0; color: #666; }
    </style>
</head>
<body>
    <a href="welcome.jsp" class="back-link">← Quay lại trang chủ</a>
    <h1>Danh sách sinh viên</h1>
    
    <!-- Hiển thị thông báo -->
    <% if (session.getAttribute("message") != null) { %>
        <div class="message"><%= session.getAttribute("message") %></div>
        <% session.removeAttribute("message"); %>
    <% } %>
    
    <% if (session.getAttribute("error") != null) { %>
        <div class="error"><%= session.getAttribute("error") %></div>
        <% session.removeAttribute("error"); %>
    <% } %>
    
    <% if (request.getAttribute("error") != null) { %>
        <div class="error"><%= request.getAttribute("error") %></div>
    <% } %>
    
    <!-- Form tìm kiếm -->
    <div class="search-form">
        <form action="student-list" method="get">
            <input type="text" name="searchName" 
                   placeholder="Tìm kiếm theo tên..." 
                   value="<%= request.getAttribute("searchName") != null ? request.getAttribute("searchName") : "" %>">
            <button type="submit">Tìm kiếm</button>
            <a href="student-list">Xem tất cả</a>
        </form>
    </div>
    
    <!-- Thống kê -->
    <div class="stats">
        Tổng số sinh viên: <strong><%= request.getAttribute("studentCount") != null ? request.getAttribute("studentCount") : 0 %></strong>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Họ tên</th>
                <th>Tuổi</th>
                <th>Trường</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <%
                List<Student> students = (List<Student>) request.getAttribute("students");
                if (students != null && !students.isEmpty()) {
                    for (Student student : students) {
            %>
            <tr>
                <td><%= student.getId() %></td>
                <td><%= student.getName() %></td>
                <td><%= student.getAge() %></td>
                <td><%= student.getUniversity() %></td>
                <td class="action-links">
                    <a href="edit-student?id=<%= student.getId() %>">Sửa</a>
                    <a href="delete-student?id=<%= student.getId() %>" 
                       onclick="return confirm('Bạn có chắc chắn muốn xóa sinh viên <%= student.getName() %>?')">Xóa</a>
                </td>
            </tr>
            <%
                    }
                } else {
            %>
            <tr>
                <td colspan="5" style="text-align: center;">Không có sinh viên nào</td>
            </tr>
            <% } %>
        </tbody>
    </table>
</body>
</html>
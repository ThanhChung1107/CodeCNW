<%@page import="com.mvcsample.model.bean.User"%>
<%@ page language="java" contentType="text/html; charset=UTF-8" pageEncoding="UTF-8" %>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <title>Welcome - Quản lý Sinh viên</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #f5f5f5;
        }
        .container {
            width: 80%;
            margin: 40px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
        }
        .menu {
            display: flex;
            flex-direction: column;
            gap: 15px;
            width: 300px;
            margin: 0 auto;
        }
        a.button {
            display: block;
            padding: 12px;
            text-align: center;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }
        a.button:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to Student Manager</h1>

        <div class="menu">
            <a href="student-list" class="button">Xem thông tin sinh viên</a>
            <a href="add-student" class="button">Thêm sinh viên</a>
        </div>
    </div>
</body>
</html>
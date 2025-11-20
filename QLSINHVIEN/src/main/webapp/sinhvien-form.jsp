<%@page import="com.qlsinhvien.model.bean.Khoa"%>
<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<%@ page import="java.util.List" %>
<%@ page import="com.qlsinhvien.model.bean.Khoa" %>
<%
    List<Khoa> khoaList = (List<Khoa>) request.getAttribute("khoaList");
    String error = (String) request.getAttribute("error");
    String msv = request.getAttribute("msv") != null ? (String) request.getAttribute("msv") : "";
    String hoTen = request.getAttribute("hoTen") != null ? (String) request.getAttribute("hoTen") : "";
    String gioiTinh = request.getAttribute("gioiTinh") != null ? (String) request.getAttribute("gioiTinh") : "Nam";
    String maKhoa = request.getAttribute("maKhoa") != null ? (String) request.getAttribute("maKhoa") : "";
%>
<!DOCTYPE html>
<html>
<head>
    <title>Thêm mới sinh viên</title>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .form-container { width: 500px; }
        .form-group { margin-bottom: 15px; }
        label { display: inline-block; width: 100px; }
        input[type="text"], select { width: 200px; padding: 5px; }
        .btn { background: #4CAF50; color: white; padding: 8px 15px; text-decoration: none; border: none; cursor: pointer; margin-right: 10px; }
        .error { color: red; margin-bottom: 15px; }
    </style>
</head>
<body>
    <h1>Thêm mới sinh viên</h1>
    
    <% if (error != null) { %>
        <div class="error"><%= error %></div>
    <% } %>
    
    <div class="form-container">
        <form action="sinhvien?action=add" method="post">
            <div class="form-group">
                <label>Mã SV:</label>
                <input type="text" name="msv" value="<%= msv %>" required>
            </div>
            <div class="form-group">
                <label>Họ tên:</label>
                <input type="text" name="hoTen" value="<%= hoTen %>" required>
            </div>
            <div class="form-group">
                <label>Giới tính:</label>
                <input type="radio" name="gioiTinh" value="Nam" <%= "Nam".equals(gioiTinh) ? "checked" : "" %>> Nam
                <input type="radio" name="gioiTinh" value="Nữ" <%= "Nữ".equals(gioiTinh) ? "checked" : "" %>> Nữ
            </div>
            <div class="form-group">
                <label>Khoa:</label>
                <select name="maKhoa" required>
                    <option value="">-- Chọn khoa --</option>
                    <% for (Khoa khoa : khoaList) { %>
                        <option value="<%= khoa.getMaKhoa() %>" 
                                <%= khoa.getMaKhoa().equals(maKhoa) ? "selected" : "" %>>
                            <%= khoa.getTenKhoa() %>
                        </option>
                    <% } %>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" value="Thêm mới" class="btn">
                <a href="sinhvien" class="btn" style="background: #ccc; color: black;">Quay lại</a>
            </div>
        </form>
    </div>
</body>
</html>
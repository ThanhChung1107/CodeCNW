<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<%@ page import="java.util.List" %>
<%@ page import="com.qlsinhvien.model.bean.Khoa" %>
<%@ page import="com.qlsinhvien.model.bean.SinhVien" %>
<%
    List<Khoa> khoaList = (List<Khoa>) request.getAttribute("khoaList");
    SinhVien sinhVien = (SinhVien) request.getAttribute("sinhVien");
    String error = (String) request.getAttribute("error");
%>
<!DOCTYPE html>
<html>
<head>
    <title>Sửa thông tin sinh viên</title>
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
    <h1>Sửa thông tin sinh viên</h1>
    
    <% if (error != null) { %>
        <div class="error"><%= error %></div>
    <% } %>
    
    <div class="form-container">
        <form action="sinhvien?action=update" method="post">
            <div class="form-group">
                <label>Mã SV:</label>
                <input type="text" name="msv" value="<%= sinhVien.getMsv() %>" readonly style="background-color: #f0f0f0;">
            </div>
            <div class="form-group">
                <label>Họ tên:</label>
                <input type="text" name="hoTen" value="<%= sinhVien.getHoTen() %>" required>
            </div>
            <div class="form-group">
                <label>Giới tính:</label>
                <input type="radio" name="gioiTinh" value="Nam" <%= "Nam".equals(sinhVien.getGioiTinh()) ? "checked" : "" %>> Nam
                <input type="radio" name="gioiTinh" value="Nữ" <%= "Nữ".equals(sinhVien.getGioiTinh()) ? "checked" : "" %>> Nữ
            </div>
            <div class="form-group">
                <label>Khoa:</label>
                <select name="maKhoa" required>
                    <option value="">-- Chọn khoa --</option>
                    <% for (Khoa khoa : khoaList) { %>
                        <option value="<%= khoa.getMaKhoa() %>" 
                                <%= khoa.getMaKhoa().equals(sinhVien.getMaKhoa()) ? "selected" : "" %>>
                            <%= khoa.getTenKhoa() %>
                        </option>
                    <% } %>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" value="Cập nhật" class="btn">
                <a href="sinhvien" class="btn" style="background: #ccc; color: black;">Hủy</a>
            </div>
        </form>
    </div>
</body>
</html>
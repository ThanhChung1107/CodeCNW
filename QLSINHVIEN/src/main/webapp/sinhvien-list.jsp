<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<%@ page import="java.util.List" %>
<%@ page import="com.qlsinhvien.model.bean.SinhVien" %>
<%
    List<SinhVien> sinhVienList = (List<SinhVien>) request.getAttribute("sinhVienList");
    String username = (String) session.getAttribute("username");
%>
<!DOCTYPE html>
<html>
<head>
    <title>Danh sách sinh viên</title>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .header { display: flex; justify-content: space-between; align-items: center; }
        .btn { background: #4CAF50; color: white; padding: 10px 15px; text-decoration: none; border: none; cursor: pointer; }
        .logout { background: #f44336; }
        .action-btn { 
            padding: 5px 10px; 
            text-decoration: none; 
            border: none; 
            cursor: pointer; 
            margin: 2px;
            border-radius: 3px;
        }
        .edit-btn { background: #2196F3; color: white; }
        .delete-btn { background: #f44336; color: white; }
        .action-btns { display: flex; gap: 5px; }
    </style>
    <script>
        function confirmDelete(msv, hoTen) {
            if (confirm('Bạn có chắc chắn muốn xóa sinh viên: ' + hoTen + ' (Mã: ' + msv + ') không?')) {
                window.location.href = 'sinhvien?action=delete&msv=' + msv;
            }
        }
    </script>
</head>
<body>
    <div class="header">
        <h1>Danh sách sinh viên</h1>
        <div>
            <span>Xin chào, <%= username %> | </span>
            <a href="sinhvien?action=new" class="btn">Thêm mới</a>
            <a href="logout" class="btn logout">Đăng xuất</a>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Mã SV</th>
                <th>Họ tên</th>
                <th>Giới tính</th>
                <th>Khoa</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            <% for (SinhVien sv : sinhVienList) { %>
                <tr>
                    <td><%= sv.getMsv() %></td>
                    <td><%= sv.getHoTen() %></td>
                    <td><%= sv.getGioiTinh() %></td>
                    <td><%= sv.getTenKhoa() %></td>
                    <td>
                        <div class="action-btns">
                            <!-- Nút Sửa -->
                            <a href="sinhvien?action=edit&msv=<%= sv.getMsv() %>" 
                               class="action-btn edit-btn">Sửa</a>
                            
                            <!-- Nút Xóa -->
                            <button onclick="confirmDelete('<%= sv.getMsv() %>', '<%= sv.getHoTen() %>')" 
                                    class="action-btn delete-btn">Xóa</button>
                        </div>
                    </td>
                </tr>
            <% } %>
            <% if (sinhVienList.isEmpty()) { %>
                <tr>
                    <td colspan="5" style="text-align: center;">Không có sinh viên nào</td>
                </tr>
            <% } %>
        </tbody>
    </table>
</body>
</html>
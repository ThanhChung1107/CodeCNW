<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<%@ page import="model.bean.SinhVien,java.util.List" %>
<%
    if (session.getAttribute("adminUser") == null) {
        response.sendRedirect(request.getContextPath()+"/login");
        return;
    }
    List<SinhVien> list = (List<SinhVien>) request.getAttribute("list");
%>
<!DOCTYPE html>
<html>
<head>
    <title>Danh sách Sinh Viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
</head>
<body>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Danh sách Sinh Viên</h3>
        <div>
            <a href="<%=request.getContextPath()%>/sinhvien/add" class="btn btn-success">Thêm</a>
            <a href="<%=request.getContextPath()%>/logout" class="btn btn-outline-danger">Logout</a>
        </div>
    </div>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
        <tr>
            <th>ID</th><th>Họ tên</th><th>Tuổi</th><th>Trường</th><th>Hành động</th>
        </tr>
        </thead>
        <tbody>
        <%
            if (list != null) {
                for (SinhVien sv : list) {
        %>
        <tr>
            <td><%=sv.getId()%></td>
            <td><%=sv.getName()%></td>
            <td><%=sv.getAge()%></td>
            <td><%=sv.getUniversity()%></td>
            <td>
                <a class="btn btn-sm btn-primary" href="<%=request.getContextPath()%>/sinhvien/edit?id=<%=sv.getId()%>">Sửa</a>
                <a class="btn btn-sm btn-danger" href="<%=request.getContextPath()%>/sinhvien/delete?id=<%=sv.getId()%>" onclick="return confirm('Xóa sinh viên?');">Xóa</a>
            </td>
        </tr>
        <%
                }
            }
        %>
        </tbody>
    </table>
</div>
</body>
</html>

<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<%@ page import="model.bean.SinhVien" %>
<%
    if (session.getAttribute("adminUser") == null) {
        response.sendRedirect(request.getContextPath()+"/login");
        return;
    }
    SinhVien sv = (SinhVien) request.getAttribute("sv");
    if (sv == null) {
        response.sendRedirect(request.getContextPath()+"/sinhvien/list");
        return;
    }
%>
<!DOCTYPE html>
<html>
<head>
    <title>Sửa Sinh Viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
</head>
<body>
<div class="container mt-4" style="max-width:600px;">
    <h3 class="mb-3">Sửa Sinh Viên</h3>
    <form method="post" action="<%=request.getContextPath()%>/sinhvien/edit" class="card card-body">
        <input type="hidden" name="id" value="<%=sv.getId()%>"/>
        <div class="mb-3">
            <label class="form-label">Họ tên</label>
            <input name="name" class="form-control" value="<%=sv.getName()%>" required/>
        </div>
        <div class="mb-3">
            <label class="form-label">Tuổi</label>
            <input name="age" type="number" min="1" class="form-control" value="<%=sv.getAge()%>" required/>
        </div>
        <div class="mb-3">
            <label class="form-label">Trường</label>
            <input name="university" class="form-control" value="<%=sv.getUniversity()%>" required/>
        </div>
        <div class="text-danger mb-2">
            <%= request.getAttribute("error") == null ? "" : request.getAttribute("error") %>
        </div>
        <button class="btn btn-primary">Cập nhật</button>
        <a href="<%=request.getContextPath()%>/sinhvien/list" class="btn btn-secondary ms-2">Hủy</a>
    </form>
</div>
</body>
</html>

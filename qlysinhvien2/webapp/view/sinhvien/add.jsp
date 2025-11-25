<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<%
    if (session.getAttribute("adminUser") == null) {
        response.sendRedirect(request.getContextPath()+"/login");
        return;
    }
%>
<!DOCTYPE html>
<html>
<head>
    <title>Thêm Sinh Viên</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
</head>
<body>
<div class="container mt-4" style="max-width:600px;">
    <h3 class="mb-3">Thêm Sinh Viên</h3>
    <form method="post" action="<%=request.getContextPath()%>/sinhvien/add" class="card card-body">
        <div class="mb-3">
            <label class="form-label">Họ tên</label>
            <input name="name" class="form-control" required/>
        </div>
        <div class="mb-3">
            <label class="form-label">Tuổi</label>
            <input name="age" type="number" min="1" class="form-control" required/>
        </div>
        <div class="mb-3">
            <label class="form-label">Trường</label>
            <input name="university" class="form-control" required/>
        </div>
        <div class="text-danger mb-2">
            <%= request.getAttribute("error") == null ? "" : request.getAttribute("error") %>
        </div>
        <button class="btn btn-success">Lưu</button>
        <a href="<%=request.getContextPath()%>/sinhvien/list" class="btn btn-secondary ms-2">Hủy</a>
    </form>
</div>
</body>
</html>

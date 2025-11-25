<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"/>
</head>
<body class="bg-light">
<div class="container mt-5" style="max-width:420px;">
    <h3 class="mb-3">Đăng nhập Admin</h3>
    <form method="post" action="<%=request.getContextPath()%>/login" class="card card-body">
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input name="username" class="form-control" required/>
        </div>
        <div class="mb-3">
            <label class="form-label">Password</label>
            <input name="password" type="password" class="form-control" required/>
        </div>
        <div class="text-danger mb-2">
            <%= request.getAttribute("error") == null ? "" : request.getAttribute("error") %>
        </div>
        <button class="btn btn-primary w-100">Login</button>
    </form>
</div>
</body>
</html>

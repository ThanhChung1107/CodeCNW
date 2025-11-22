<%@ page contentType="text/html;charset=UTF-8" pageEncoding="UTF-8" language="java" %>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; margin: 50px; }
        .register-form { width: 300px; margin: 0 auto; padding: 20px; border: 1px solid #ccc; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 5px; }
        input[type="text"], input[type="password"], select { width: 100%; padding: 8px; }
        input[type="submit"] { background: white; color: black; padding: 10px; border: none; cursor: pointer; width: 100%; }
        .error { margin-bottom: 15px; }
        .links { text-align: center; margin-top: 15px; }
    </style>
</head>
<body>
    <div class="register-form">
        <h2>Register</h2>
        
        <% if (request.getAttribute("error") != null) { %>
            <div class="error"><%= request.getAttribute("error") %></div>
        <% } %>
        
        <form action="register" method="post">
            <div class="form-group">
                <label>Username:</label>
                <input type="text" name="username" required>
            </div>
            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="password" required>
            </div>
            <div class="form-group">
                <label>Lastname:</label>
                <input type="text" name="lastname" required>
            </div>
            <div class="form-group">
                <label>Roles:</label>
                <select name="roles" required>
                    <option value="User">User</option>
                    <option value="Manager">Manager</option>
                    <option value="Administrator">Administrator</option>
                </select>
            </div>
            <div class="form-group">
                <input type="submit" value="Register">
            </div>
        </form>
        
        <div class="links">
            <a href="login">Try Again</a>
        </div>
    </div>
</body>
</html>
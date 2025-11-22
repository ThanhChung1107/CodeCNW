<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<!DOCTYPE html>
<html>
<head>
    <title>Login Failed</title>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; margin: 50px; text-align: center; }
        .error-box { 
            width: 350px; 
            margin: 0 auto; 
            padding: 20px; 
            border: 1px solid #ccc; 
            border-radius: 5px;
        }
        .error-text { color: red; font-size: 18px; margin-bottom: 20px; }
        .btn { 
            display: block; 
            margin: 10px auto; 
            width: 200px; 
            padding: 10px; 
            text-decoration: none; 
            border-radius: 5px;
        }
    </style>
</head>
<body>

    <div class="error-box">
        <div class="error-text">Invalid username or password!</div>

        <a href="login" class="btn">Try Again</a>
        <a href="register" class="btn btn-danger">Register</a>
    </div>

</body>
</html>

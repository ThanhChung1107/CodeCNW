<%@ page language="java" contentType="text/html; charset=UTF-8"
    pageEncoding="UTF-8"%>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>login</title>
</head>
<body>
	<%
		String temp = "temp";
		session.setAttribute("temp",temp);
	%>
	
	<form name="form1" action="login" method="post">
		Username: <input type="text" name="username"/>
		Password: <input type="password" name="password"/>
		<input type="submit" value="Login"/>
		<input type="reset" value="Reset"/>
	</form>
</body>
</html>
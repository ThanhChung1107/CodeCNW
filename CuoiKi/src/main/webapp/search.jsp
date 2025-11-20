<%@ page contentType="text/html;charset=UTF-8" language="java" %>
<%@ page import="java.util.List" %>
<%@ page import="com.example.model.bean.User" %>
<%
    List<User> users = (List<User>) request.getAttribute("users");
    String keyword = (String) request.getAttribute("keyword");
    User currentUser = (User) session.getAttribute("user");
%>
<!DOCTYPE html>
<html>
<head>
    <title>Search Users</title>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .welcome { font-size: 18px; font-weight: bold; }
        .search-form { margin: 20px 0; padding: 15px; background: #f9f9f9; border: 1px solid #ddd; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        .btn { background: #4CAF50; color: white; padding: 5px 10px; text-decoration: none; border: none; cursor: pointer; }
        .delete-btn { background: #f44336; }
        .logout-btn { background: #ff9800; }
        .no-result { text-align: center; color: #666; font-style: italic; margin: 20px 0; }
    </style>
</head>
<body>
    <div class="header">
        <h1>Search Users</h1>
        <div>
            <span class="welcome">Welcome, <%= currentUser.getLastname() %></span>
            <a href="logout" class="btn logout-btn" style="margin-left: 15px;">Logout</a>
        </div>
    </div>

    <div class="search-form">
        <form action="search" method="get">
            <input type="hidden" name="action" value="search">
            <label>Search by lastname:</label>
            <input type="text" name="keyword" value="<%= keyword != null ? keyword : "" %>" placeholder="Enter part of lastname">
            <input type="submit" value="Search" class="btn">
        </form>
    </div>

    <% if (users != null) { %>
        <% if (users.isEmpty()) { %>
            <div class="no-result">No Result is matched!</div>
        <% } else { %>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Lastname</th>
                        <th>Roles</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <% for (User user : users) { %>
                        <tr>
                            <td><%= user.getId() %></td>
                            <td><%= user.getUsername() %></td>
                            <td>
                                <form action="search" method="get" style="display: inline;">
                                    <input type="hidden" name="action" value="update">
                                    <input type="hidden" name="id" value="<%= user.getId() %>">
                                    <input type="hidden" name="originalKeyword" value="<%= keyword %>">
                                    <input type="text" name="lastname" value="<%= user.getLastname() %>">
                            </td>
                            <td>
                                    <select name="roles">
                                        <option value="User" <%= "User".equals(user.getRoles()) ? "selected" : "" %>>User</option>
                                        <option value="Manager" <%= "Manager".equals(user.getRoles()) ? "selected" : "" %>>Manager</option>
                                        <option value="Administrator" <%= "Administrator".equals(user.getRoles()) ? "selected" : "" %>>Administrator</option>
                                    </select>
                            </td>
                            <td>
                                    <input type="submit" value="Update" class="btn">
                                </form>
                                <a href="search?action=delete&id=<%= user.getId() %>&originalKeyword=<%= java.net.URLEncoder.encode(keyword, "UTF-8") %>" 
                                   class="btn delete-btn" 
                                   onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                            </td>
                        </tr>
                    <% } %>
                </tbody>
            </table>
        <% } %>
    <% } %>
</body>
</html>
package com.example.model.dao;


import com.example.model.bean.*;
import com.example.util.DBUtil;
import java.sql.*;
import java.util.ArrayList;
import java.util.List;


import java.sql.*;
import java.util.ArrayList;
import java.util.List;

public class UserDAO {
    
    public User authenticate(String username, String password) throws SQLException {
        String sql = "SELECT * FROM Users WHERE username = ? AND password = ?";
        
        try (Connection conn = DBUtil.getConnection();
             PreparedStatement stmt = conn.prepareStatement(sql)) {
            
            stmt.setString(1, username);
            stmt.setString(2, password);
            ResultSet rs = stmt.executeQuery();
            
            if (rs.next()) {
                User user = new User();
                user.setId(rs.getInt("id"));
                user.setUsername(rs.getString("username"));
                user.setPassword(rs.getString("password"));
                user.setLastname(rs.getString("lastname"));
                user.setRoles(rs.getString("roles"));
                return user;
            }
        }
        return null;
    }
    
    public boolean register(User user) throws SQLException {
        String sql = "INSERT INTO Users (username, password, lastname, roles) VALUES (?, ?, ?, ?)";
        
        try (Connection conn = DBUtil.getConnection();
             PreparedStatement stmt = conn.prepareStatement(sql)) {
            
            stmt.setString(1, user.getUsername());
            stmt.setString(2, user.getPassword());
            stmt.setString(3, user.getLastname());
            stmt.setString(4, user.getRoles());
            
            return stmt.executeUpdate() > 0;
        }
    }
    
    public List<User> searchUsers(String keyword) throws SQLException {
        List<User> users = new ArrayList<>();
        String sql = "SELECT * FROM Users WHERE lastname LIKE ?";
        
        try (Connection conn = DBUtil.getConnection();
             PreparedStatement stmt = conn.prepareStatement(sql)) {
            
            stmt.setString(1, "%" + keyword + "%");
            ResultSet rs = stmt.executeQuery();
            
            while (rs.next()) {
                User user = new User();
                user.setId(rs.getInt("id"));
                user.setUsername(rs.getString("username"));
                user.setPassword(rs.getString("password"));
                user.setLastname(rs.getString("lastname"));
                user.setRoles(rs.getString("roles"));
                users.add(user);
            }
        }
        return users;
    }
    
    public boolean updateUser(User user) throws SQLException {
        String sql = "UPDATE Users SET lastname = ?, roles = ? WHERE id = ?";
        
        try (Connection conn = DBUtil.getConnection();
             PreparedStatement stmt = conn.prepareStatement(sql)) {
            
            stmt.setString(1, user.getLastname());
            stmt.setString(2, user.getRoles());
            stmt.setInt(3, user.getId());
            
            return stmt.executeUpdate() > 0;
        }
    }
    
    public boolean deleteUser(int id) throws SQLException {
        String sql = "DELETE FROM Users WHERE id = ?";
        
        try (Connection conn = DBUtil.getConnection();
             PreparedStatement stmt = conn.prepareStatement(sql)) {
            
            stmt.setInt(1, id);
            return stmt.executeUpdate() > 0;
        }
    }
    
    public boolean checkUsernameExists(String username) throws SQLException {
        String sql = "SELECT 1 FROM Users WHERE username = ?";
        
        try (Connection conn = DBUtil.getConnection();
             PreparedStatement stmt = conn.prepareStatement(sql)) {
            
            stmt.setString(1, username);
            ResultSet rs = stmt.executeQuery();
            return rs.next();
        }
    }
}
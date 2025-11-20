package com.qlsinhvien.model.dao;

import com.qlsinhvien.util.*;
import com.qlsinhvien.model.bean.*;
import java.sql.*;

public class TaiKhoanDAO {
    
    public boolean checkLogin(String username, String password) throws SQLException {
        String sql = "SELECT * FROM TaiKhoan WHERE username = ? AND password = ?";
        
        try (Connection conn = DBConnection.getConnection();
             PreparedStatement stmt = conn.prepareStatement(sql)) {
            
            stmt.setString(1, username);
            stmt.setString(2, password);
            ResultSet rs = stmt.executeQuery();
            
            return rs.next();
        }
    }
}

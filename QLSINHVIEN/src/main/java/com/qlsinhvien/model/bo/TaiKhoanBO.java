package com.qlsinhvien.model.bo;

import com.qlsinhvien.model.dao.*;
import java.sql.SQLException;

public class TaiKhoanBO {
    private TaiKhoanDAO taiKhoanDAO;
    
    public TaiKhoanBO() {
        this.taiKhoanDAO = new TaiKhoanDAO();
    }
    
    public boolean authenticate(String username, String password) throws SQLException {
        if (username == null || username.trim().isEmpty()) {
            throw new IllegalArgumentException("Tên đăng nhập không được để trống");
        }
        if (password == null || password.trim().isEmpty()) {
            throw new IllegalArgumentException("Mật khẩu không được để trống");
        }
        
        return taiKhoanDAO.checkLogin(username, password);
    }
    
    public boolean validateLogin(String username, String password) {
        if (username == null || username.trim().isEmpty()) {
            return false;
        }
        if (password == null || password.trim().isEmpty()) {
            return false;
        }
        return true;
    }
    
    public String encryptPassword(String password) {
        // Simple encryption - in real project, use stronger encryption
        return password; // For demo, return as is. In production, use BCrypt etc.
    }
}
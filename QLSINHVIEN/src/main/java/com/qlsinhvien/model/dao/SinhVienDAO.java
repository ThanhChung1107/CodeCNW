package com.qlsinhvien.model.dao;

import com.qlsinhvien.util.*;
import com.qlsinhvien.model.bean.*;
import java.sql.*;
import java.util.ArrayList;
import java.util.List;

public class SinhVienDAO {
    
    public List<SinhVien> getAllSinhVien() throws SQLException {
        List<SinhVien> sinhVienList = new ArrayList<>();
        String sql = "SELECT s.msv, s.ho_ten, s.gioi_tinh, s.ma_khoa, k.ten_khoa " +
                    "FROM SinhVien s " +
                    "LEFT JOIN Khoa k ON s.ma_khoa = k.ma_khoa " +
                    "ORDER BY s.msv";
        
        try (Connection conn = DBConnection.getConnection();
             PreparedStatement stmt = conn.prepareStatement(sql);
             ResultSet rs = stmt.executeQuery()) {
            
            while (rs.next()) {
                SinhVien sv = new SinhVien();
                sv.setMsv(rs.getString("msv"));
                sv.setHoTen(rs.getString("ho_ten"));
                sv.setGioiTinh(rs.getString("gioi_tinh"));
                sv.setMaKhoa(rs.getString("ma_khoa"));
                sv.setTenKhoa(rs.getString("ten_khoa"));
                sinhVienList.add(sv);
            }
        }
        return sinhVienList;
    }
    
    public boolean addSinhVien(SinhVien sv) throws SQLException {
        String sql = "INSERT INTO SinhVien (msv, ho_ten, gioi_tinh, ma_khoa) VALUES (?, ?, ?, ?)";
        
        try (Connection conn = DBConnection.getConnection();
             PreparedStatement stmt = conn.prepareStatement(sql)) {
            
            stmt.setString(1, sv.getMsv());
            stmt.setString(2, sv.getHoTen());
            stmt.setString(3, sv.getGioiTinh());
            stmt.setString(4, sv.getMaKhoa());
            
            return stmt.executeUpdate() > 0;
        }
    }
    
    public boolean checkMaSinhVienExists(String msv) throws SQLException {
        String sql = "SELECT 1 FROM SinhVien WHERE msv = ?";
        
        try (Connection conn = DBConnection.getConnection();
             PreparedStatement stmt = conn.prepareStatement(sql)) {
            
            stmt.setString(1, msv);
            ResultSet rs = stmt.executeQuery();
            return rs.next();
        }
    }
    public boolean deleteSinhVien(String msv) throws SQLException {
        String sql = "DELETE FROM SinhVien WHERE msv = ?";
        
        try (Connection conn = DBConnection.getConnection();
             PreparedStatement stmt = conn.prepareStatement(sql)) {
            
            stmt.setString(1, msv);
            
            // executeUpdate() trả về số lượng hàng bị ảnh hưởng.
            return stmt.executeUpdate() > 0;
        }
    }
    
    public boolean updateSinhVien(SinhVien sv) throws SQLException {
        String sql = "UPDATE SinhVien SET ho_ten = ?, gioi_tinh = ?, ma_khoa = ? WHERE msv = ?";
        
        try (Connection conn = DBConnection.getConnection();
             PreparedStatement stmt = conn.prepareStatement(sql)) {
            
            // 1. Gán các giá trị mới
            stmt.setString(1, sv.getHoTen());
            stmt.setString(2, sv.getGioiTinh());
            stmt.setString(3, sv.getMaKhoa());
            
            // 2. Gán giá trị khóa chính (WHERE condition)
            stmt.setString(4, sv.getMsv());
            
            // executeUpdate() trả về số lượng hàng bị ảnh hưởng.
            return stmt.executeUpdate() > 0;
        }
    }
    
    public SinhVien getSinhVienByMsv(String msv) throws SQLException {
        SinhVien sv = null;
        String sql = "SELECT s.msv, s.ho_ten, s.gioi_tinh, s.ma_khoa, k.ten_khoa " +
                     "FROM SinhVien s " +
                     "LEFT JOIN Khoa k ON s.ma_khoa = k.ma_khoa " +
                     "WHERE s.msv = ?";
        
        try (Connection conn = DBConnection.getConnection();
             PreparedStatement stmt = conn.prepareStatement(sql)) {
            
            stmt.setString(1, msv);
            
            try (ResultSet rs = stmt.executeQuery()) {
                if (rs.next()) {
                    sv = new SinhVien();
                    sv.setMsv(rs.getString("msv"));
                    sv.setHoTen(rs.getString("ho_ten"));
                    sv.setGioiTinh(rs.getString("gioi_tinh"));
                    sv.setMaKhoa(rs.getString("ma_khoa"));
                    sv.setTenKhoa(rs.getString("ten_khoa"));
                }
            }
        }
        return sv;
    }
}
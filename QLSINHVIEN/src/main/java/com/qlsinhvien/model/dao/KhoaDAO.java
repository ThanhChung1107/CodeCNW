package com.qlsinhvien.model.dao;

import com.qlsinhvien.util.*;
import com.qlsinhvien.model.bean.*;
import java.sql.*;
import java.util.ArrayList;
import java.util.List;

public class KhoaDAO {
    
    public List<Khoa> getAllKhoa() throws SQLException {
        List<Khoa> khoaList = new ArrayList<>();
        String sql = "SELECT * FROM Khoa ORDER BY ten_khoa";
        
        try (Connection conn = DBConnection.getConnection();
             PreparedStatement stmt = conn.prepareStatement(sql);
             ResultSet rs = stmt.executeQuery()) {
            
            while (rs.next()) {
                Khoa khoa = new Khoa();
                khoa.setMaKhoa(rs.getString("ma_khoa"));
                khoa.setTenKhoa(rs.getString("ten_khoa"));
                khoaList.add(khoa);
            }
        }
        return khoaList;
    }
}
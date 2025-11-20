package com.qlsinhvien.model.bo;

import com.qlsinhvien.model.dao.*;
import com.qlsinhvien.model.bean.*;
import java.sql.SQLException;
import java.util.List;

public class KhoaBO {
    private KhoaDAO khoaDAO;
    
    public KhoaBO() {
        this.khoaDAO = new KhoaDAO();
    }
    
    public List<Khoa> getAllKhoa() throws SQLException {
        return khoaDAO.getAllKhoa();
    }
    
    public Khoa getKhoaByMaKhoa(String maKhoa) throws SQLException {
        List<Khoa> khoaList = khoaDAO.getAllKhoa();
        for (Khoa khoa : khoaList) {
            if (khoa.getMaKhoa().equals(maKhoa)) {
                return khoa;
            }
        }
        return null;
    }
    
    public boolean validateKhoa(Khoa khoa) {
        if (khoa.getMaKhoa() == null || khoa.getMaKhoa().trim().isEmpty()) {
            return false;
        }
        if (khoa.getTenKhoa() == null || khoa.getTenKhoa().trim().isEmpty()) {
            return false;
        }
        return true;
    }
    
    public int getTotalKhoa() throws SQLException {
        List<Khoa> khoaList = khoaDAO.getAllKhoa();
        return khoaList.size();
    }
    
    public List<Khoa> searchKhoaByName(String name) throws SQLException {
        List<Khoa> allKhoa = khoaDAO.getAllKhoa();
        if (name == null || name.trim().isEmpty()) {
            return allKhoa;
        }
        
        String searchName = name.toLowerCase().trim();
        return allKhoa.stream()
                .filter(k -> k.getTenKhoa().toLowerCase().contains(searchName))
                .collect(java.util.stream.Collectors.toList());
    }
}
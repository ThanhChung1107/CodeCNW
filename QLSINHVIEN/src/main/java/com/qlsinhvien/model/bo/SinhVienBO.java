package com.qlsinhvien.model.bo;

import com.qlsinhvien.model.dao.SinhVienDAO;
import com.qlsinhvien.model.dao.KhoaDAO;
import com.qlsinhvien.model.bean.SinhVien;
import com.qlsinhvien.model.bean.Khoa;
import java.sql.SQLException;
import java.util.List;

public class SinhVienBO {
    private SinhVienDAO sinhVienDAO;
    private KhoaDAO khoaDAO;
    
    public SinhVienBO() {
        this.sinhVienDAO = new SinhVienDAO();
        this.khoaDAO = new KhoaDAO();
    }
    
    public List<SinhVien> getAllSinhVien() throws SQLException {
        return sinhVienDAO.getAllSinhVien();
    }
    
    public boolean addSinhVien(SinhVien sinhVien) throws SQLException {
        // Validate data before adding
        if (sinhVien.getMsv() == null || sinhVien.getMsv().trim().isEmpty()) {
            throw new IllegalArgumentException("Mã sinh viên không được để trống");
        }
        if (sinhVien.getHoTen() == null || sinhVien.getHoTen().trim().isEmpty()) {
            throw new IllegalArgumentException("Họ tên không được để trống");
        }
        if (sinhVien.getGioiTinh() == null || sinhVien.getGioiTinh().trim().isEmpty()) {
            throw new IllegalArgumentException("Giới tính không được để trống");
        }
        if (sinhVien.getMaKhoa() == null || sinhVien.getMaKhoa().trim().isEmpty()) {
            throw new IllegalArgumentException("Mã khoa không được để trống");
        }
        
        // Check if student code already exists
        if (sinhVienDAO.checkMaSinhVienExists(sinhVien.getMsv())) {
            throw new IllegalArgumentException("Mã sinh viên đã tồn tại: " + sinhVien.getMsv());
        }
        
        return sinhVienDAO.addSinhVien(sinhVien);
    }
    
    public boolean validateSinhVien(SinhVien sinhVien) {
        if (sinhVien.getMsv() == null || sinhVien.getMsv().trim().isEmpty()) {
            return false;
        }
        if (sinhVien.getHoTen() == null || sinhVien.getHoTen().trim().isEmpty()) {
            return false;
        }
        if (sinhVien.getGioiTinh() == null || sinhVien.getGioiTinh().trim().isEmpty()) {
            return false;
        }
        if (sinhVien.getMaKhoa() == null || sinhVien.getMaKhoa().trim().isEmpty()) {
            return false;
        }
        return true;
    }
    
    public List<Khoa> getAllKhoa() throws SQLException {
        return khoaDAO.getAllKhoa();
    }
    
    public String getTenKhoaByMaKhoa(String maKhoa) throws SQLException {
        List<Khoa> khoaList = khoaDAO.getAllKhoa();
        for (Khoa khoa : khoaList) {
            if (khoa.getMaKhoa().equals(maKhoa)) {
                return khoa.getTenKhoa();
            }
        }
        return "Không xác định";
    }
    
    public int getTotalSinhVien() throws SQLException {
        List<SinhVien> sinhVienList = sinhVienDAO.getAllSinhVien();
        return sinhVienList.size();
    }
    
    public List<SinhVien> searchSinhVienByMaKhoa(String maKhoa) throws SQLException {
        List<SinhVien> allSinhVien = sinhVienDAO.getAllSinhVien();
        if (maKhoa == null || maKhoa.trim().isEmpty()) {
            return allSinhVien;
        }
        
        return allSinhVien.stream()
                .filter(sv -> sv.getMaKhoa().equals(maKhoa))
                .collect(java.util.stream.Collectors.toList());
    }
    
    public List<SinhVien> searchSinhVienByName(String name) throws SQLException {
        List<SinhVien> allSinhVien = sinhVienDAO.getAllSinhVien();
        if (name == null || name.trim().isEmpty()) {
            return allSinhVien;
        }
        
        String searchName = name.toLowerCase().trim();
        return allSinhVien.stream()
                .filter(sv -> sv.getHoTen().toLowerCase().contains(searchName))
                .collect(java.util.stream.Collectors.toList());
    }
    
    public SinhVien getSinhVienByMsv(String msv) throws SQLException {
    	return sinhVienDAO.getSinhVienByMsv(msv);
    }
    
    public boolean updateSinhVien(SinhVien sv) throws SQLException {
    	return sinhVienDAO.updateSinhVien(sv);
    }
    
    public boolean deleteSinhVien(String msv) throws SQLException {
    	return sinhVienDAO.deleteSinhVien(msv);
    }
}
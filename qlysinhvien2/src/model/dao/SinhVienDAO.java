package model.dao;

import model.bean.SinhVien;
import java.util.List;
import java.util.ArrayList;
import java.sql.*;

public class SinhVienDAO extends BaseDAO {

    public List<SinhVien> getAll() {
        List<SinhVien> list = new ArrayList<>();
        String sql = "SELECT id,name,age,university FROM sinhvien ORDER BY id DESC";
        try (Connection c = getConnection();
             PreparedStatement ps = c.prepareStatement(sql);
             ResultSet rs = ps.executeQuery()) {
            while (rs.next()) {
                list.add(new SinhVien(
                        rs.getInt("id"),
                        rs.getString("name"),
                        rs.getInt("age"),
                        rs.getString("university")
                ));
            }
        } catch (Exception e) { e.printStackTrace(); }
        return list;
    }

    public SinhVien getById(int id) {
        String sql = "SELECT id,name,age,university FROM sinhvien WHERE id=?";
        try (Connection c = getConnection();
             PreparedStatement ps = c.prepareStatement(sql)) {
            ps.setInt(1, id);
            try (ResultSet rs = ps.executeQuery()) {
                if (rs.next()) {
                    return new SinhVien(
                            rs.getInt("id"),
                            rs.getString("name"),
                            rs.getInt("age"),
                            rs.getString("university")
                    );
                }
            }
        } catch (Exception e) { e.printStackTrace(); }
        return null;
    }

    public boolean add(SinhVien sv) {
        String sql = "INSERT INTO sinhvien(name,age,university) VALUES (?,?,?)";
        try (Connection c = getConnection();
             PreparedStatement ps = c.prepareStatement(sql)) {
            ps.setString(1, sv.getName());
            ps.setInt(2, sv.getAge());
            ps.setString(3, sv.getUniversity());
            return ps.executeUpdate() > 0;
        } catch (Exception e) { e.printStackTrace(); }
        return false;
    }

    public boolean update(SinhVien sv) {
        String sql = "UPDATE sinhvien SET name=?, age=?, university=? WHERE id=?";
        try (Connection c = getConnection();
             PreparedStatement ps = c.prepareStatement(sql)) {
            ps.setString(1, sv.getName());
            ps.setInt(2, sv.getAge());
            ps.setString(3, sv.getUniversity());
            ps.setInt(4, sv.getId());
            return ps.executeUpdate() > 0;
        } catch (Exception e) { e.printStackTrace(); }
        return false;
    }

    public boolean delete(int id) {
        String sql = "DELETE FROM sinhvien WHERE id=?";
        try (Connection c = getConnection();
             PreparedStatement ps = c.prepareStatement(sql)) {
            ps.setInt(1, id);
            return ps.executeUpdate() > 0;
        } catch (Exception e) { e.printStackTrace(); }
        return false;
    }
}

package model.bo;

import model.bean.SinhVien;
import model.dao.SinhVienDAO;
import java.util.List;

public class SinhVienBO {
    private final SinhVienDAO dao = new SinhVienDAO();
    public List<SinhVien> list() { return dao.getAll(); }
    public SinhVien get(int id) { return dao.getById(id); }
    public boolean add(SinhVien sv) { return dao.add(sv); }
    public boolean update(SinhVien sv) { return dao.update(sv); }
    public boolean delete(int id) { return dao.delete(id); }
}

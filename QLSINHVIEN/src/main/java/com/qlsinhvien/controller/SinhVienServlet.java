package com.qlsinhvien.controller;

import com.qlsinhvien.model.bo.*;
import com.qlsinhvien.model.bean.*;
import javax.servlet.*;
import javax.servlet.http.*;
import javax.servlet.annotation.*;
import java.io.IOException;
import java.sql.SQLException;
import java.util.List;

@WebServlet(name = "SinhVienServlet", urlPatterns = {"/sinhvien"})
public class SinhVienServlet extends HttpServlet {
    private SinhVienBO sinhVienBO;
    private KhoaBO khoaBO;
    
    public void init() {
        this.sinhVienBO = new SinhVienBO();
        this.khoaBO = new KhoaBO();
    }
    
    protected void doGet(HttpServletRequest request, HttpServletResponse response) 
            throws ServletException, IOException {
        // Cần thiết lập mã hóa cho POST request (dù doPost gọi doGet)
        request.setCharacterEncoding("UTF-8"); 
        
        // Check login (Đã làm tốt)
        HttpSession session = request.getSession(false);
        if (session == null || session.getAttribute("username") == null) {
            response.sendRedirect("login");
            return;
        }
        
        String action = request.getParameter("action");
        if (action == null) {
            action = "list";
        }
        
        try {
            switch (action) {
                case "new":
                    showNewForm(request, response);
                    break;
                case "add":
                    addSinhVien(request, response);
                    break;
                case "edit":
                    showEditForm(request, response);
                    break;
                case "update":
                    updateSinhVien(request, response);
                    break;
                case "delete":
                    deleteSinhVien(request, response);
                    break;
                case "report":
                    showReport(request, response); // Thêm chức năng báo cáo
                    break;
                default:
                    listSinhVien(request, response);
                    break;
            }
        } catch (SQLException ex) {
            // Log lỗi và chuyển sang trang báo lỗi
            ex.printStackTrace();
            throw new ServletException("Database error: " + ex.getMessage(), ex);
        }
    }
    
    protected void doPost(HttpServletRequest request, HttpServletResponse response) 
            throws ServletException, IOException {
        // Xử lý mã hóa cho POST
        request.setCharacterEncoding("UTF-8"); 
        doGet(request, response);
    }
    
    // Phương thức 1: List Sinh Viên (Hiển thị mặc định)
    private void listSinhVien(HttpServletRequest request, HttpServletResponse response)
            throws SQLException, ServletException, IOException {
        // Lấy danh sách khoa để hiển thị bộ lọc
        List<Khoa> khoaList = khoaBO.getAllKhoa();
        request.setAttribute("khoaList", khoaList);
        
        List<SinhVien> sinhVienList = sinhVienBO.getAllSinhVien();
        request.setAttribute("sinhVienList", sinhVienList);
        RequestDispatcher dispatcher = request.getRequestDispatcher("sinhvien-list.jsp");
        dispatcher.forward(request, response);
    }
    
    // Phương thức 2: Hiển thị Form Thêm Mới
    private void showNewForm(HttpServletRequest request, HttpServletResponse response)
            throws SQLException, ServletException, IOException {
        List<Khoa> khoaList = khoaBO.getAllKhoa();
        request.setAttribute("khoaList", khoaList);
        // Form dùng chung cho Thêm/Sửa (hoặc form riêng)
        RequestDispatcher dispatcher = request.getRequestDispatcher("sinhvien-form.jsp"); 
        dispatcher.forward(request, response);
    }
    
    // Phương thức 3: Hiển thị Form Chỉnh Sửa
    private void showEditForm(HttpServletRequest request, HttpServletResponse response)
            throws SQLException, ServletException, IOException {
        String msv = request.getParameter("msv");
        // Lấy thông tin sinh viên cần sửa
        SinhVien sinhVien = sinhVienBO.getSinhVienByMsv(msv); 
        // Lấy danh sách khoa cho dropdown
        List<Khoa> khoaList = khoaBO.getAllKhoa();
        
        request.setAttribute("sinhVien", sinhVien);
        request.setAttribute("khoaList", khoaList);
        RequestDispatcher dispatcher = request.getRequestDispatcher("sinhvien-edit.jsp");
        dispatcher.forward(request, response);
    }
    
    // Phương thức 4: Thêm Sinh Viên (Xử lý POST)
    private void addSinhVien(HttpServletRequest request, HttpServletResponse response)
            throws SQLException, IOException, ServletException {
        // Lấy dữ liệu từ form (đã có setCharacterEncoding ở doPost)
        String msv = request.getParameter("msv");
        String hoTen = request.getParameter("hoTen");
        String gioiTinh = request.getParameter("gioiTinh");
        String maKhoa = request.getParameter("maKhoa");
        
        SinhVien sv = new SinhVien(msv, hoTen, gioiTinh, maKhoa);
        
        try {
            if (sinhVienBO.addSinhVien(sv)) {
                // Thêm thành công -> Chuyển hướng về trang danh sách
                response.sendRedirect("sinhvien?message=add_success");
            }
        } catch (IllegalArgumentException e) {
            // Xử lý lỗi logic (ví dụ: trùng MSV)
            request.setAttribute("error", e.getMessage());
            
            // Cần set lại các giá trị đã nhập và danh sách Khoa để hiển thị lại form
            List<Khoa> khoaList = khoaBO.getAllKhoa();
            request.setAttribute("khoaList", khoaList);
            request.setAttribute("sinhVien", sv); // Truyền lại đối tượng vừa nhập
            
            RequestDispatcher dispatcher = request.getRequestDispatcher("sinhvien-form.jsp");
            dispatcher.forward(request, response);
        }
    }
    
    // Phương thức 5: Cập nhật Sinh Viên (Xử lý POST)
    private void updateSinhVien(HttpServletRequest request, HttpServletResponse response)
            throws SQLException, IOException, ServletException {
        // MSV cần lấy từ hidden field hoặc path
        String msv = request.getParameter("msv"); 
        String hoTen = request.getParameter("hoTen");
        String gioiTinh = request.getParameter("gioiTinh");
        String maKhoa = request.getParameter("maKhoa");
        
        SinhVien sv = new SinhVien(msv, hoTen, gioiTinh, maKhoa);
        
        try {
            if (sinhVienBO.updateSinhVien(sv)) {
                // Cập nhật thành công -> Chuyển hướng về trang danh sách
                response.sendRedirect("sinhvien?message=update_success");
            } else {
                 // Không có bản ghi nào được update (MSV không tồn tại)
                 request.setAttribute("error", "Không tìm thấy sinh viên để cập nhật.");
                 showEditForm(request, response); 
            }
        } catch (IllegalArgumentException e) {
            // Xử lý lỗi logic
            request.setAttribute("error", e.getMessage());
            
            // Cần set lại các giá trị và danh sách Khoa để hiển thị lại form
            List<Khoa> khoaList = khoaBO.getAllKhoa();
            request.setAttribute("khoaList", khoaList);
            request.setAttribute("sinhVien", sv); // Truyền lại đối tượng vừa nhập
            
            RequestDispatcher dispatcher = request.getRequestDispatcher("sinhvien-edit.jsp");
            dispatcher.forward(request, response);
        }
    }
    
    // Phương thức 6: Xóa Sinh Viên
    private void deleteSinhVien(HttpServletRequest request, HttpServletResponse response)
            throws SQLException, IOException {
        String msv = request.getParameter("msv");
        
        try {
            if (sinhVienBO.deleteSinhVien(msv)) {
                response.sendRedirect("sinhvien?message=delete_success");
            } else {
                response.sendRedirect("sinhvien?message=delete_fail&reason=notfound");
            }
        } catch (IllegalArgumentException e) {
            // Xử lý lỗi nếu cần (ví dụ: Sinh viên có ràng buộc khóa ngoại)
            response.sendRedirect("sinhvien?message=delete_fail&reason=" + e.getMessage());
        }
    }
    
    
    
    // Phương thức 8: Hiển thị Báo Cáo (Ví dụ: Thống kê số lượng sinh viên theo khoa) 📊
    private void showReport(HttpServletRequest request, HttpServletResponse response)
            throws SQLException, ServletException, IOException {
        // Hàm này giả định bạn có một hàm BO mới: getThongKeTheoKhoa() trả về List<ThongKeBean>
        // List<ThongKeBean> reportList = sinhVienBO.getThongKeTheoKhoa();
        
        // request.setAttribute("reportList", reportList);
        RequestDispatcher dispatcher = request.getRequestDispatcher("sinhvien-report.jsp");
        dispatcher.forward(request, response);
    }
}
package controller;

import model.bean.SinhVien;
import model.bo.SinhVienBO;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.*;
import java.io.IOException;

@WebServlet("/sinhvien/edit")
public class SinhVienEditServlet extends HttpServlet {
    private final SinhVienBO bo = new SinhVienBO();

    private boolean auth(HttpServletRequest req, HttpServletResponse resp) throws IOException {
        if (req.getSession(false) == null || req.getSession(false).getAttribute("adminUser") == null) {
            resp.sendRedirect(req.getContextPath() + "/login");
            return false;
        }
        return true;
    }

    @Override
    protected void doGet(HttpServletRequest req, HttpServletResponse resp) throws ServletException, IOException {
        if (!auth(req, resp)) return;
        String idStr = req.getParameter("id");
        int id;
        try { id = Integer.parseInt(idStr); } catch (Exception e) { resp.sendRedirect(req.getContextPath()+"/sinhvien/list"); return; }
        SinhVien sv = bo.get(id);
        if (sv == null) { resp.sendRedirect(req.getContextPath()+"/sinhvien/list"); return; }
        req.setAttribute("sv", sv);
        req.getRequestDispatcher("/view/sinhvien/edit.jsp").forward(req, resp);
    }

    @Override
    protected void doPost(HttpServletRequest req, HttpServletResponse resp) throws ServletException, IOException {
        if (!auth(req, resp)) return;
        String idStr = req.getParameter("id");
        String name = req.getParameter("name");
        String ageStr = req.getParameter("age");
        String university = req.getParameter("university");

        int id, age;
        try { id = Integer.parseInt(idStr); age = Integer.parseInt(ageStr); }
        catch (Exception e) {
            req.setAttribute("error", "Dữ liệu không hợp lệ.");
            req.getRequestDispatcher("/view/sinhvien/edit.jsp").forward(req, resp);
            return;
        }
        if (name == null || name.isBlank() || university == null || university.isBlank()) {
            req.setAttribute("error", "Vui lòng nhập đầy đủ.");
            req.getRequestDispatcher("/view/sinhvien/edit.jsp").forward(req, resp);
            return;
        }
        bo.update(new SinhVien(id, name, age, university));
        resp.sendRedirect(req.getContextPath() + "/sinhvien/list");
    }
}

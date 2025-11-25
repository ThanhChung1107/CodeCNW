package controller;

import model.bean.SinhVien;
import model.bo.SinhVienBO;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.*;
import java.io.IOException;

@WebServlet("/sinhvien/add")
public class SinhVienAddServlet extends HttpServlet {
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
        req.getRequestDispatcher("/view/sinhvien/add.jsp").forward(req, resp);
    }

    @Override
    protected void doPost(HttpServletRequest req, HttpServletResponse resp) throws ServletException, IOException {
        if (!auth(req, resp)) return;
        String name = req.getParameter("name");
        String ageStr = req.getParameter("age");
        String university = req.getParameter("university");

        if (name == null || name.isBlank() || ageStr == null || ageStr.isBlank() || university == null || university.isBlank()) {
            req.setAttribute("error", "Vui lòng nhập đầy đủ.");
            req.getRequestDispatcher("/view/sinhvien/add.jsp").forward(req, resp);
            return;
        }
        int age;
        try { age = Integer.parseInt(ageStr); } catch (NumberFormatException e) {
            req.setAttribute("error", "Tuổi không hợp lệ.");
            req.getRequestDispatcher("/view/sinhvien/add.jsp").forward(req, resp);
            return;
        }
        bo.add(new SinhVien(name, age, university));
        resp.sendRedirect(req.getContextPath() + "/sinhvien/list");
    }
}

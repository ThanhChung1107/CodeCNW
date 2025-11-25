package controller;

import model.bo.SinhVienBO;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.*;
import java.io.IOException;

@WebServlet("/sinhvien/delete")
public class SinhVienDeleteServlet extends HttpServlet {
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
        try {
            int id = Integer.parseInt(idStr);
            bo.delete(id);
        } catch (Exception ignored) {}
        resp.sendRedirect(req.getContextPath() + "/sinhvien/list");
    }
}

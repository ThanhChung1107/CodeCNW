package controller;

import model.bo.SinhVienBO;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.*;
import java.io.IOException;

@WebServlet("/sinhvien/list")
public class SinhVienListServlet extends HttpServlet {
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
        req.setAttribute("list", bo.list());
        req.getRequestDispatcher("/view/sinhvien/list.jsp").forward(req, resp);
    }
}

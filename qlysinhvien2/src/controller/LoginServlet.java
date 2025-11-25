package controller;

import model.bo.AdminBO;

import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.*;
import java.io.IOException;

@WebServlet("/login")
public class LoginServlet extends HttpServlet {
    private final AdminBO bo = new AdminBO();

    @Override
    protected void doGet(HttpServletRequest req, HttpServletResponse resp) throws ServletException, IOException {
        req.getRequestDispatcher("/view/admin/login.jsp").forward(req, resp);
    }

    @Override
    protected void doPost(HttpServletRequest req, HttpServletResponse resp) throws ServletException, IOException {
        String u = req.getParameter("username");
        String p = req.getParameter("password");
        if (u == null || u.isBlank() || p == null || p.isBlank()) {
            req.setAttribute("error", "Thiếu thông tin.");
            req.getRequestDispatcher("/view/admin/login.jsp").forward(req, resp);
            return;
        }
        if (bo.login(u, p)) {
            req.getSession(true).setAttribute("adminUser", u);
            resp.sendRedirect(req.getContextPath() + "/sinhvien/list");
        } else {
            req.setAttribute("error", "Sai tài khoản hoặc mật khẩu.");
            req.getRequestDispatcher("/view/admin/login.jsp").forward(req, resp);
        }
    }
}

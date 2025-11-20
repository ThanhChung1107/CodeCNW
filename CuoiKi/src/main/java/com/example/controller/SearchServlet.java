package com.example.controller;

import com.example.model.bo.UserBO;
import com.example.model.bean.User;

import javax.servlet.*;
import javax.servlet.http.*;
import javax.servlet.annotation.*;
import java.io.IOException;
import java.sql.SQLException;
import java.util.List;

@WebServlet(name = "SearchServlet", urlPatterns = {"/search"})
public class SearchServlet extends HttpServlet {

    private UserBO userBO;

    @Override
    public void init() {
        userBO = new UserBO();
    }

    @Override
    protected void doGet(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {

        HttpSession session = request.getSession(false);
        if (session == null || session.getAttribute("user") == null) {
            response.sendRedirect("login");
            return;
        }

        String action = request.getParameter("action");

        try {
            if (action != null) {
                switch (action) {
                    case "search":
                        searchUsers(request, response);
                        break;
                    case "update":
                        updateUser(request, response);
                        break;
                    case "delete":
                        deleteUser(request, response);
                        break;
                    default:
                        showSearchForm(request, response);
                        break;
                }
            } else {
                showSearchForm(request, response);
            }
        } catch (SQLException e) {
            throw new ServletException(e);
        }
    }

    @Override
    protected void doPost(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {

        doGet(request, response);
    }

    private void showSearchForm(HttpServletRequest request, HttpServletResponse response)
            throws ServletException, IOException {

        request.getRequestDispatcher("search.jsp").forward(request, response);
    }

    private void searchUsers(HttpServletRequest request, HttpServletResponse response)
            throws SQLException, ServletException, IOException {

        String keyword = request.getParameter("keyword");
        List<User> users = userBO.searchUsers(keyword);

        request.setAttribute("users", users);
        request.setAttribute("keyword", keyword);

        request.getRequestDispatcher("search.jsp").forward(request, response);
    }

    private void updateUser(HttpServletRequest request, HttpServletResponse response)
            throws SQLException, IOException {

        int id = Integer.parseInt(request.getParameter("id"));
        String lastname = request.getParameter("lastname");
        String roles = request.getParameter("roles");

        User user = new User();
        user.setId(id);
        user.setLastname(lastname);
        user.setRoles(roles);

        userBO.updateUser(user);

        response.sendRedirect("search?action=search&keyword="
                + java.net.URLEncoder.encode(request.getParameter("originalKeyword"), "UTF-8"));
    }

    private void deleteUser(HttpServletRequest request, HttpServletResponse response)
            throws SQLException, IOException {

        int id = Integer.parseInt(request.getParameter("id"));
        userBO.deleteUser(id);

        response.sendRedirect("search?action=search&keyword="
                + java.net.URLEncoder.encode(request.getParameter("originalKeyword"), "UTF-8"));
    }
}

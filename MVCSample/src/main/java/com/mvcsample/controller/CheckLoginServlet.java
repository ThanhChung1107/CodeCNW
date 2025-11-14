package com.mvcsample.controller;

import java.io.IOException;
import java.util.ArrayList;
import java.util.List;

import javax.servlet.RequestDispatcher;
import javax.servlet.ServletException;
import javax.servlet.annotation.WebServlet;
import javax.servlet.http.HttpServlet;
import javax.servlet.http.HttpServletRequest;
import javax.servlet.http.HttpServletResponse;
import javax.servlet.http.HttpSession;

import com.mvcsample.model.bean.User;
import com.mvcsample.model.bo.CheckLoginBO;

@WebServlet("/login")
public class CheckLoginServlet extends HttpServlet{
	@Override
	protected void doPost(HttpServletRequest request, HttpServletResponse response) 
					throws ServletException, IOException {
		request.setCharacterEncoding("UTF-8");
		String destination = null;
		
        String username = request.getParameter("username");
        String password = request.getParameter("password");
        List<User> users = new ArrayList<>();
        
        CheckLoginBO bo = new CheckLoginBO();
        User user = bo.CheckLogin(username, password);
        
        if (user != null) {
            HttpSession session = request.getSession();
            session.setAttribute("user", user);
            response.sendRedirect("welcome.jsp");
        } else {
            response.sendRedirect("login.jsp?error=1");
        }
	}
}

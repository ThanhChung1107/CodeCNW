package com.mvcsample.controller;

import com.mvcsample.model.bo.StudentBO;
import javax.servlet.*;
import javax.servlet.http.*;
import javax.servlet.annotation.*;
import java.io.IOException;

@WebServlet("/delete-student")
public class DeleteStudentServlet extends HttpServlet {
    private StudentBO studentBO;
    
    @Override
    public void init() throws ServletException {
        this.studentBO = new StudentBO();
    }
    
    protected void doGet(HttpServletRequest request, HttpServletResponse response) 
            throws ServletException, IOException {
        
        try {
            int id = Integer.parseInt(request.getParameter("id"));
            boolean success = studentBO.deleteStudent(id);
            
            if (success) {
                request.getSession().setAttribute("message", "Xóa sinh viên thành công!");
            } else {
                request.getSession().setAttribute("error", "Xóa sinh viên thất bại!");
            }
            
        } catch (IllegalArgumentException e) {
            request.getSession().setAttribute("error", e.getMessage());
        } catch (Exception e) {
            request.getSession().setAttribute("error", "Lỗi hệ thống: " + e.getMessage());
        }
        
        response.sendRedirect("student-list");
    }
}
package com.mvcsample.controller;

import com.mvcsample.model.bean.Student;
import com.mvcsample.model.bo.StudentBO;
import javax.servlet.*;
import javax.servlet.http.*;
import javax.servlet.annotation.*;
import java.io.IOException;

@WebServlet("/edit-student")
public class EditStudentServlet extends HttpServlet {
    private StudentBO studentBO;
    
    @Override
    public void init() throws ServletException {
        this.studentBO = new StudentBO();
    }
    
    protected void doGet(HttpServletRequest request, HttpServletResponse response) 
            throws ServletException, IOException {
        
        try {
            int id = Integer.parseInt(request.getParameter("id"));
            Student student = studentBO.getStudentById(id);
            
            if (student == null) {
                request.setAttribute("error", "Không tìm thấy sinh viên với ID: " + id);
            } else {
                request.setAttribute("student", student);
            }
            
        } catch (IllegalArgumentException e) {
            request.setAttribute("error", e.getMessage());
        } catch (Exception e) {
            request.setAttribute("error", "Lỗi hệ thống: " + e.getMessage());
        }
        
        RequestDispatcher dispatcher = request.getRequestDispatcher("student-edit.jsp");
        dispatcher.forward(request, response);
    }
    
    protected void doPost(HttpServletRequest request, HttpServletResponse response) 
            throws ServletException, IOException {
        
        try {
            int id = Integer.parseInt(request.getParameter("id"));
            String name = request.getParameter("name");
            int age = Integer.parseInt(request.getParameter("age"));
            String university = request.getParameter("university");
            
            Student student = new Student(id, name, age, university);
            boolean success = studentBO.updateStudent(student);
            
            if (success) {
                request.getSession().setAttribute("message", "Cập nhật thông tin sinh viên thành công!");
                response.sendRedirect("student-list");
            } else {
                request.setAttribute("error", "Cập nhật thông tin thất bại!");
                RequestDispatcher dispatcher = request.getRequestDispatcher("student-edit.jsp");
                dispatcher.forward(request, response);
            }
            
        } catch (IllegalArgumentException e) {
            request.setAttribute("error", e.getMessage());
            RequestDispatcher dispatcher = request.getRequestDispatcher("student-edit.jsp");
            dispatcher.forward(request, response);
        } catch (Exception e) {
            request.setAttribute("error", "Lỗi hệ thống: " + e.getMessage());
            RequestDispatcher dispatcher = request.getRequestDispatcher("student-edit.jsp");
            dispatcher.forward(request, response);
        }
    }
}
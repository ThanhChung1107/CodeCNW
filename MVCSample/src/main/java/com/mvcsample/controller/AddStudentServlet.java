package com.mvcsample.controller;

import com.mvcsample.model.bean.Student;
import com.mvcsample.model.bo.StudentBO;
import javax.servlet.*;
import javax.servlet.http.*;
import javax.servlet.annotation.*;
import java.io.IOException;

@WebServlet("/add-student")
public class AddStudentServlet extends HttpServlet {
    private StudentBO studentBO;
    
    @Override
    public void init() throws ServletException {
        this.studentBO = new StudentBO();
    }
    
    protected void doPost(HttpServletRequest request, HttpServletResponse response) 
            throws ServletException, IOException {
        
        try {
            String name = request.getParameter("name");
            int age = Integer.parseInt(request.getParameter("age"));
            String university = request.getParameter("university");
            
            Student student = new Student();
            student.setName(name);
            student.setAge(age);
            student.setUniversity(university);
            
            boolean success = studentBO.addStudent(student);
            
            if (success) {
                request.getSession().setAttribute("message", "Thêm sinh viên thành công!");
                response.sendRedirect("student-list");
            } else {
                request.setAttribute("error", "Thêm sinh viên thất bại!");
                RequestDispatcher dispatcher = request.getRequestDispatcher("student-add.jsp");
                dispatcher.forward(request, response);
            }
            
        } catch (IllegalArgumentException e) {
            request.setAttribute("error", e.getMessage());
            RequestDispatcher dispatcher = request.getRequestDispatcher("student-add.jsp");
            dispatcher.forward(request, response);
        } catch (Exception e) {
            request.setAttribute("error", "Lỗi hệ thống: " + e.getMessage());
            RequestDispatcher dispatcher = request.getRequestDispatcher("student-add.jsp");
            dispatcher.forward(request, response);
        }
    }
    
    protected void doGet(HttpServletRequest request, HttpServletResponse response) 
            throws ServletException, IOException {
        RequestDispatcher dispatcher = request.getRequestDispatcher("student-add.jsp");
        dispatcher.forward(request, response);
    }
}
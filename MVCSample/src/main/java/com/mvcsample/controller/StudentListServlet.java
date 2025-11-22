package com.mvcsample.controller;

import com.mvcsample.model.bean.Student;
import com.mvcsample.model.bo.StudentBO;
import javax.servlet.*;
import javax.servlet.http.*;
import javax.servlet.annotation.*;
import java.io.IOException;
import java.util.List;

@WebServlet("/student-list")
public class StudentListServlet extends HttpServlet {
    private StudentBO studentBO;
    
    @Override
    public void init() throws ServletException {
        this.studentBO = new StudentBO();
    }
    
    protected void doGet(HttpServletRequest request, HttpServletResponse response) 
            throws ServletException, IOException {
        
        try {
            String searchName = request.getParameter("searchName");
            List<Student> students;
            
            if (searchName != null && !searchName.trim().isEmpty()) {
                // Tìm kiếm sinh viên theo tên
                students = studentBO.searchStudentsByName(searchName);
                request.setAttribute("searchName", searchName);
            } else {
                // Lấy tất cả sinh viên
                students = studentBO.getAllStudents();
            }
            
            request.setAttribute("students", students);
            request.setAttribute("studentCount", studentBO.getStudentCount());
            
        } catch (Exception e) {
            request.setAttribute("error", "Lỗi khi tải danh sách sinh viên: " + e.getMessage());
        }
        
        RequestDispatcher dispatcher = request.getRequestDispatcher("student-list.jsp");
        dispatcher.forward(request, response);
    }
}
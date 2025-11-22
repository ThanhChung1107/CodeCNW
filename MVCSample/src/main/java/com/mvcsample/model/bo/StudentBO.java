package com.mvcsample.model.bo;

import com.mvcsample.model.bean.Student;
import com.mvcsample.model.dao.StudentDAO;
import java.util.List;

public class StudentBO {
    private StudentDAO studentDAO;
    
    public StudentBO() {
        this.studentDAO = new StudentDAO();
    }
    
    // Lấy danh sách tất cả sinh viên
    public List<Student> getAllStudents() {
        return studentDAO.getAllStudents();
    }
    
    // Lấy sinh viên theo ID
    public Student getStudentById(int id) {
        if (id <= 0) {
            throw new IllegalArgumentException("ID sinh viên không hợp lệ");
        }
        return studentDAO.getStudentById(id);
    }
    
    // Thêm sinh viên mới với validation
    public boolean addStudent(Student student) {
        validateStudent(student);
        return studentDAO.addStudent(student);
    }
    
    // Cập nhật thông tin sinh viên với validation
    public boolean updateStudent(Student student) {
        if (student.getId() <= 0) {
            throw new IllegalArgumentException("ID sinh viên không hợp lệ");
        }
        validateStudent(student);
        return studentDAO.updateStudent(student);
    }
    
    // Xóa sinh viên
    public boolean deleteStudent(int id) {
        if (id <= 0) {
            throw new IllegalArgumentException("ID sinh viên không hợp lệ");
        }
        
        // Kiểm tra sinh viên có tồn tại không
        Student student = studentDAO.getStudentById(id);
        if (student == null) {
            throw new IllegalArgumentException("Sinh viên không tồn tại");
        }
        
        return studentDAO.deleteStudent(id);
    }
    
    // Tìm kiếm sinh viên theo tên
    public List<Student> searchStudentsByName(String name) {
        if (name == null || name.trim().isEmpty()) {
            return getAllStudents();
        }
        
        List<Student> allStudents = studentDAO.getAllStudents();
        return allStudents.stream()
                .filter(student -> student.getName().toLowerCase().contains(name.toLowerCase()))
                .collect(java.util.stream.Collectors.toList());
    }
    
    // Validation cho student
    private void validateStudent(Student student) {
        if (student == null) {
            throw new IllegalArgumentException("Thông tin sinh viên không được null");
        }
        
        if (student.getName() == null || student.getName().trim().isEmpty()) {
            throw new IllegalArgumentException("Tên sinh viên không được để trống");
        }
        
        if (student.getAge() <= 0 || student.getAge() > 150) {
            throw new IllegalArgumentException("Tuổi sinh viên không hợp lệ");
        }
        
        if (student.getUniversity() == null || student.getUniversity().trim().isEmpty()) {
            throw new IllegalArgumentException("Tên trường không được để trống");
        }
        
        // Kiểm tra độ dài tên
        if (student.getName().length() > 100) {
            throw new IllegalArgumentException("Tên sinh viên quá dài (tối đa 100 ký tự)");
        }
        
        if (student.getUniversity().length() > 100) {
            throw new IllegalArgumentException("Tên trường quá dài (tối đa 100 ký tự)");
        }
    }
    
    // Lấy số lượng sinh viên
    public int getStudentCount() {
        return studentDAO.getAllStudents().size();
    }
}
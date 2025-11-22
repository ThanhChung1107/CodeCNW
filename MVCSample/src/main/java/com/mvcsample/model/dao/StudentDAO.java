package com.mvcsample.model.dao;

import com.mvcsample.model.bean.Student;
import com.mvcsample.util.DBConnect;
import java.sql.*;
import java.util.ArrayList;
import java.util.List;

public class StudentDAO {
    
	public List<Student> getAllStudents() {
		System.out.println("=== DEBUG DAO START ===");
        List<Student> students = new ArrayList<>();
        String sql = "SELECT * FROM sinhvien";
        
        System.out.println("=== DEBUG: getAllStudents() called ===");
        
        try (Connection conn = DBConnect.getConnection();
             PreparedStatement stmt = conn.prepareStatement(sql);
             ResultSet rs = stmt.executeQuery()) {
            
            System.out.println("Connection successful: " + (conn != null));
            
            int count = 0;
            while (rs.next()) {
                count++;
                Student student = new Student();
                student.setId(rs.getInt("id"));
                student.setName(rs.getString("name"));
                student.setAge(rs.getInt("age"));
                student.setUniversity(rs.getString("university"));
                students.add(student);
                
                System.out.println("Student " + count + ": " + student.getName() + ", " + student.getAge() + ", " + student.getUniversity());
            }
            
            System.out.println("Total students found: " + count);
            
        } catch (SQLException e) {
            System.out.println("SQL Error: " + e.getMessage());
            e.printStackTrace();
        } catch (Exception e) {
            System.out.println("General Error: " + e.getMessage());
            e.printStackTrace();
        }
        
        return students;
    }
    
    public Student getStudentById(int id) {
        Student student = null;
        String sql = "SELECT * FROM sinhvien WHERE id = ?";
        
        try (Connection conn = DBConnect.getConnection();
             PreparedStatement stmt = conn.prepareStatement(sql)) {
            
            stmt.setInt(1, id);
            ResultSet rs = stmt.executeQuery();
            
            if (rs.next()) {
                student = new Student();
                student.setId(rs.getInt("id"));
                student.setName(rs.getString("name"));
                student.setAge(rs.getInt("age"));
                student.setUniversity(rs.getString("university"));
            }
            rs.close();
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return student;
    }
    
    public boolean addStudent(Student student) {
        String sql = "INSERT INTO sinhvien (name, age, university) VALUES (?, ?, ?)";
        
        try (Connection conn = DBConnect.getConnection();
             PreparedStatement stmt = conn.prepareStatement(sql)) {
            
            stmt.setString(1, student.getName());
            stmt.setInt(2, student.getAge());
            stmt.setString(3, student.getUniversity());
            
            return stmt.executeUpdate() > 0;
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return false;
    }
    
    public boolean updateStudent(Student student) {
        String sql = "UPDATE sinhvien SET name = ?, age = ?, university = ? WHERE id = ?";
        
        try (Connection conn = DBConnect.getConnection();
             PreparedStatement stmt = conn.prepareStatement(sql)) {
            
            stmt.setString(1, student.getName());
            stmt.setInt(2, student.getAge());
            stmt.setString(3, student.getUniversity());
            stmt.setInt(4, student.getId());
            
            return stmt.executeUpdate() > 0;
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return false;
    }
    
    public boolean deleteStudent(int id) {
        String sql = "DELETE FROM sinhvien WHERE id = ?";
        
        try (Connection conn = DBConnect.getConnection();
             PreparedStatement stmt = conn.prepareStatement(sql)) {
            
            stmt.setInt(1, id);
            return stmt.executeUpdate() > 0;
        } catch (SQLException e) {
            e.printStackTrace();
        }
        return false;
    }
}
package com.mvcsample.model.dao;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.util.ArrayList;
import java.util.List;
import com.mvcsample.model.bean.User;
import com.mvcsample.util.DBConnect;

public class CheckLoginDAO {
	
	public User login(String username, String password) {
	    String sql = "SELECT * FROM admin WHERE username = ? AND password = ?";
	    
	    try (Connection conn = DBConnect.getConnection();
	         PreparedStatement ps = conn.prepareStatement(sql)) {
	        
	        ps.setString(1, username);
	        ps.setString(2, password);
	        
	        ResultSet rs = ps.executeQuery();
	        
	        if (rs.next()) {
	            User u = new User();
	            u.setUsername(rs.getString("username"));
	            u.setPassword(rs.getString("password"));
	            return u;
	        }
	    } catch (Exception e) {
	        e.printStackTrace();
	    }
	    return null;
	}

	
}

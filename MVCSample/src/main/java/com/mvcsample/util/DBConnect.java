package com.mvcsample.util;

import java.sql.Connection;
import java.sql.DriverManager;

public class DBConnect {
    private static String jdbcURL = "jdbc:mysql://localhost:3306/example";
    private static String jdbcUsername = "root";
    private static String jdbcPassword = "root";
    
    public static Connection getConnection() {
        Connection conn = null;
        try {
            Class.forName("com.mysql.cj.jdbc.Driver");
            conn = DriverManager.getConnection(jdbcURL, jdbcUsername, jdbcPassword);
        } catch (Exception e) {
        	System.out.println("❌ DB ERROR: " + e.getMessage());
            e.printStackTrace();
        }
        return conn;
    }
}

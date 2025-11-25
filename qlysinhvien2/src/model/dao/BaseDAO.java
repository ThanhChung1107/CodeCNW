package model.dao;

import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;
import java.util.Properties;
import java.io.InputStream;
import java.io.FileInputStream;

public class BaseDAO {
    private static String url;
    private static String user;
    private static String pass;

    static {
        Properties props = new Properties();
        try {
            InputStream in = BaseDAO.class.getClassLoader().getResourceAsStream("db.properties");
            if (in == null) {
                in = new FileInputStream("db.properties");
            }
            props.load(in);
            in.close();
            url = props.getProperty("url");
            user = props.getProperty("user");
            pass = props.getProperty("pass");
            Class.forName("com.mysql.cj.jdbc.Driver");
        } catch (Exception e) {
            throw new RuntimeException("Cannot load DB config", e);
        }
    }

    protected Connection getConnection() throws SQLException {
        return DriverManager.getConnection(url, user, pass);
    }
}

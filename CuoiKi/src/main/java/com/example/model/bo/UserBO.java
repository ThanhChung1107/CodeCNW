package com.example.model.bo;

import com.example.model.bean.User;
import com.example.model.dao.UserDAO;

import java.sql.SQLException;
import java.util.List;

public class UserBO {

    private UserDAO userDAO = new UserDAO();

    // Đăng nhập
    public User authenticate(String username, String password) throws SQLException {
        return userDAO.authenticate(username, password);
    }

    // Đăng ký
    public boolean register(User user) throws SQLException {

        // Kiểm tra username có tồn tại chưa
        if (userDAO.checkUsernameExists(user.getUsername())) {
            return false; // đã tồn tại
        }

        return userDAO.register(user);
    }

    // Tìm kiếm theo lastname
    public List<User> searchUsers(String keyword) throws SQLException {
        return userDAO.searchUsers(keyword);
    }

    // Cập nhật thông tin
    public boolean updateUser(User user) throws SQLException {
        return userDAO.updateUser(user);
    }

    // Xóa user
    public boolean deleteUser(int id) throws SQLException {
        return userDAO.deleteUser(id);
    }

    // Kiểm tra username tồn tại
    public boolean checkUsernameExists(String username) throws SQLException {
        return userDAO.checkUsernameExists(username);
    }
}

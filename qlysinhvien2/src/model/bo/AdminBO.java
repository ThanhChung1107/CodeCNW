package model.bo;

import model.dao.AdminDAO;

public class AdminBO {
    private final AdminDAO dao = new AdminDAO();
    public boolean login(String username, String password) {
        return dao.checkLogin(username, password);
    }
}

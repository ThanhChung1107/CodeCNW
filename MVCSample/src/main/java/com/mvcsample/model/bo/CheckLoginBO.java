package com.mvcsample.model.bo;

import com.mvcsample.model.bean.User;
import com.mvcsample.model.dao.CheckLoginDAO;

public class CheckLoginBO {
	private CheckLoginDAO dao = new CheckLoginDAO();
	
	public User CheckLogin(String username, String password) {
		return dao.login(username, password);
	}
}	

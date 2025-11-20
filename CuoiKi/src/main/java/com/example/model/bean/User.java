package com.example.model.bean;

public class User {
    private int id;
    private String username;
    private String password;
    private String lastname;
    private String roles;
    
    public User() {}
    
    public User(String username, String password, String lastname, String roles) {
        this.username = username;
        this.password = password;
        this.lastname = lastname;
        this.roles = roles;
    }
    
    // Getters and Setters
    public int getId() { return id; }
    public void setId(int id) { this.id = id; }
    
    public String getUsername() { return username; }
    public void setUsername(String username) { this.username = username; }
    
    public String getPassword() { return password; }
    public void setPassword(String password) { this.password = password; }
    
    public String getLastname() { return lastname; }
    public void setLastname(String lastname) { this.lastname = lastname; }
    
    public String getRoles() { return roles; }
    public void setRoles(String roles) { this.roles = roles; }
}
package model.bean;

public class SinhVien {
    private int id;
    private String name;
    private int age;
    private String university;

    public SinhVien() {}
    public SinhVien(int id, String name, int age, String university) {
        this.id = id; this.name = name; this.age = age; this.university = university;
    }
    public SinhVien(String name, int age, String university) {
        this.name = name; this.age = age; this.university = university;
    }
    public int getId() { return id; }
    public void setId(int id) { this.id = id; }
    public String getName() { return name; }
    public void setName(String name) { this.name = name; }
    public int getAge() { return age; }
    public void setAge(int age) { this.age = age; }
    public String getUniversity() { return university; }
    public void setUniversity(String university) { this.university = university; }
}

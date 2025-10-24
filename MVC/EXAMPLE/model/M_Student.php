<?php
require_once('E_Student.php');

#kết nối cơ sở dữ liệu
// $host = "localhost";
// $user = "root";
// $pass = "";
// $dbname = "DULIEU";

// $conn = new mysqli($host,$user,$pass,$dbname);

// if($conn->connect_error){
//     die("Kết nối thất bại: " . $conn->connect_error);
// }
// $conn->set_charset("utf8");

#truy vấn cơ sở dữ liệu
class M_Student {
    private $conn;

    public function __construct(){}
    public function getAllStudents(){
        $sql = "select * from sinhvien";
        $link = mysqli_connect("localhost","root","") or die ("không thể kết nối");
        mysqli_select_db($link,"DULIEU");
        $rs = mysqli_query($link,$sql);
        $i = 0;
        $students = []; // Mảng chứa danh sách sinh viên

        if ($rs && $rs->num_rows > 0) {
            while ($row = $rs->fetch_assoc()) {
                // Tạo đối tượng E_Student cho từng dòng
                $students[] = new E_Student(
                    $row['IDSV'],
                    $row['name'],
                    $row['age'],
                    $row['university']
                );
            }
        }

        return $students;
    }
    public function getStudentDetail($stid){
        $allstudent = $this->getAllStudents();
        foreach ($allstudent as $student) {
            if ($student->id == $stid) { // id trùng với $stid
                return $student;
            }
        }
        return null; // nếu không tìm thấy
    }
    public function addStudent($id, $name, $age, $university){
        $link = mysqli_connect("localhost","root","") or die("Không thể kết nối");
        mysqli_select_db($link,"DULIEU");
        mysqli_set_charset($link,"utf8");
        $sql = "INSERT INTO sinhvien (IDSV, name, age, university) VALUES ('$id', '$name', '$age', '$university')";
        return mysqli_query($link,$sql);
    }

    public function updateStudent($id, $name, $age, $university){
        $link = mysqli_connect("localhost","root","") or die("Không thể kết nối");
        mysqli_select_db($link,"DULIEU");
        mysqli_set_charset($link,"utf8");
        $sql = "UPDATE sinhvien SET name='$name', age='$age', university='$university' WHERE IDSV='$id'";
        return mysqli_query($link,$sql);
    }
    public function deletestudent($id){
        $link = mysqli_connect("localhost","root","") or die("Không thể kết nối");
        mysqli_select_db($link,"DULIEU");
        mysqli_set_charset($link,"utf8");
        $sql = "delete from sinhvien where IDSV = '$id'";
        return mysqli_query($link,$sql);
    }
    public function deleteAllStudents(){
        $link = mysqli_connect("localhost","root","") or die("Không thể kết nối");
        mysqli_select_db($link,"DULIEU");
        mysqli_set_charset($link,"utf8");
        $sql = "delete from sinhvien";
        return mysqli_query($link,$sql);
    }
}

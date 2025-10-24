<?php
session_start();
include 'connect.php';

$username = $_POST['username'];
$pass = $_POST['password'];

$sql = "select * from admin where username = '$username' and password = '$pass'";
$result = $conn->query( $sql );

if($result->num_rows > 0 ){
    $_SESSION['username'] = $username;
    header("location: home.php");
}
else{
    header("Location: login.php?error=Sai tài khoản hoặc mật khẩu!");
}
$conn->close();
?>
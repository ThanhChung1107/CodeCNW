<?php
include 'connect.php';

if (isset($_POST['chon'])) {
    $chon = $_POST['chon']; // Mảng các IDNV được chọn

    // Ghép danh sách ID thành chuỗi cho câu lệnh SQL
    $ds_id = implode("','", $chon);

    // Thực hiện xóa
    $sql = "DELETE FROM nhanvien WHERE IDNV IN ('$ds_id')";
    if ($conn->query($sql)) {
        // Quay lại trang xoa.php sau khi xóa
        header("Location: xoa.php");
        exit();
    } else {
        echo "❌ Lỗi khi xóa: " . $conn->error;
    }
} else {
    // Nếu không chọn nhân viên nào
    header("Location: xoa.php");
    exit();
}
?>

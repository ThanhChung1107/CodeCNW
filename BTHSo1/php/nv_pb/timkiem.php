<?php
include 'connect.php'; // file kết nối database

$searchType = '';
$searchValue = '';
$result = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $searchType = $_POST['searchType'];
    $searchValue = $_POST['searchValue'];

    // Tạo câu truy vấn dựa trên loại tìm kiếm
    if ($searchType && $searchValue != '') {
        $sql = "SELECT * FROM nhanvien WHERE $searchType LIKE '%$searchValue%'";
        $result = $conn->query($sql);
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Tìm kiếm nhân viên</title>
</head>
<body>
<h2>Tìm kiếm nhân viên</h2>

<!-- Form tìm kiếm -->
<form method="POST" action="">
    <input type="text" name="searchValue" placeholder="Nhập từ khóa..." value="<?php echo htmlspecialchars($searchValue); ?>" required>
    <br><br>

    <label><input type="radio" name="searchType" value="IDNV" <?php if($searchType=='IDNV') echo 'checked'; ?>> Mã nhân viên</label>
    <label><input type="radio" name="searchType" value="Hoten" <?php if($searchType=='Hoten') echo 'checked'; ?>> Họ tên</label>
    <label><input type="radio" name="searchType" value="Diachi" <?php if($searchType=='Diachi') echo 'checked'; ?>> Địa chỉ</label>
    <br><br>

    <input type="submit" value="Tìm kiếm">
</form>

<hr>

<!-- Hiển thị kết quả -->
<?php
if ($result) {
    if ($result->num_rows > 0) {
        echo "<table border='1' cellpadding='5' cellspacing='0'>
                <tr>
                    <th>Mã NV</th>
                    <th>Họ tên</th>
                    <th>Mã PB</th>
                    <th>Địa chỉ</th>
                </tr>";
        while($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['IDNV']}</td>
                    <td>{$row['hoten']}</td>
                    <td>{$row['IDPB']}</td>
                    <td>{$row['Diachi']}</td>
                </tr>";
        }
        echo "</table>";
    } else {
        echo "<p>Không tìm thấy kết quả phù hợp.</p>";
    }
}

$conn->close();
?>
</body>
</html>

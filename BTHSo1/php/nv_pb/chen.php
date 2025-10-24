<?php
// chen.php
include 'connect.php';

// Biến để hiển thị lỗi/success
$errors = [
    'IDNV' => '',
    'Hoten' => ''
];
$success = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Lấy và trim input
    $idnv = trim($_POST['IDNV']);
    $hoten = trim($_POST['Hoten']);
    $idpb = trim($_POST['IDPB']);
    $diachi = trim($_POST['Diachi']);

    // Server-side: kiểm tra trùng IDNV (phòng trường hợp JS tắt)
    $stmt = $conn->prepare("SELECT COUNT(*) FROM nhanvien WHERE IDNV = ?");
    $stmt->bind_param("s", $idnv);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    if ($count > 0) {
        $errors['IDNV'] = "Mã NV đã tồn tại. Vui lòng nhập mã khác.";
    }

    // (Bạn có thể thêm kiểm tra khác ở đây, ví dụ Hoten trùng nếu cần)
    // Nếu không có lỗi thì insert
    if (empty($errors['IDNV'])) {
        $stmt = $conn->prepare("INSERT INTO nhanvien (IDNV, Hoten, IDPB, Diachi) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $idnv, $hoten, $idpb, $diachi);
        if ($stmt->execute()) {
            $success = "✅ Thêm nhân viên thành công!";
            // reset form values
            $idnv = $hoten = $idpb = $diachi = '';
        } else {
            $errors['IDNV'] = "Lỗi khi thêm: " . $conn->error;
        }
        $stmt->close();
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm nhân viên mới</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; }
        label { display:block; margin-top:10px; }
        input[type="text"] { padding:6px; width:300px; }
        .error { color: #b00020; margin-left:5px; }
        .success { color: #006600; margin-bottom:10px; }
        .disabled { background:#f2f2f2; }
    </style>
</head>
<body>
    <h2>Thêm nhân viên mới</h2>

    <?php if ($success): ?>
        <p class="success"><?php echo htmlspecialchars($success); ?> <a href="home.php">Quay lại</a></p>
    <?php endif; ?>

    <form id="frmAdd" method="POST" action="">
        <label for="IDNV">Mã NV:</label>
        <input type="text" id="IDNV" name="IDNV" value="<?php echo isset($idnv) ? htmlspecialchars($idnv) : ''; ?>" required autofocus>
        <span id="errIDNV" class="error"><?php echo $errors['IDNV']; ?></span>

        <label for="Hoten">Họ tên:</label>
        <input type="text" id="Hoten" name="Hoten" value="<?php echo isset($hoten) ? htmlspecialchars($hoten) : ''; ?>" required>
        <span id="errHoten" class="error"><?php echo $errors['Hoten']; ?></span>

        <label for="IDPB">Mã PB:</label>
        <input type="text" id="IDPB" name="IDPB" value="<?php echo isset($idpb) ? htmlspecialchars($idpb) : ''; ?>" required>

        <label for="Diachi">Địa chỉ:</label>
        <input type="text" id="Diachi" name="Diachi" value="<?php echo isset($diachi) ? htmlspecialchars($diachi) : ''; ?>">

        <br><br>
        <button type="submit" id="btnSubmit" disabled>Thêm mới</button>
        <a href="home.php" style="margin-left:10px;">↩️ Quay lại</a>
    </form>

<script>
// debounce helper
function debounce(fn, delay){
    let t;
    return function(...args){
        clearTimeout(t);
        t = setTimeout(()=>fn.apply(this,args), delay);
    };
}

const idnvInput = document.getElementById('IDNV');
const hotenInput = document.getElementById('Hoten');
const idpbInput = document.getElementById('IDPB');
const diachiInput = document.getElementById('Diachi');
const errIDNV = document.getElementById('errIDNV');
const btnSubmit = document.getElementById('btnSubmit');
const frm = document.getElementById('frmAdd');

// Ban đầu khóa các input khác cho đến khi IDNV hợp lệ
function disableOtherInputs(disabled) {
    hotenInput.disabled = disabled;
    idpbInput.disabled = disabled;
    diachiInput.disabled = disabled;
    if (disabled) {
        hotenInput.classList.add('disabled');
        idpbInput.classList.add('disabled');
        diachiInput.classList.add('disabled');
    } else {
        hotenInput.classList.remove('disabled');
        idpbInput.classList.remove('disabled');
        diachiInput.classList.remove('disabled');
    }
    btnSubmit.disabled = disabled;
}

// kiểm tra IDNV trống => disable
if (!idnvInput.value.trim()) {
    disableOtherInputs(true);
} else {
    // sẽ kiểm tra bằng AJAX
    disableOtherInputs(true);
}

// Gọi AJAX để kiểm tra IDNV
const checkId = debounce(function() {
    const idnv = idnvInput.value.trim();
    if (!idnv) {
        errIDNV.textContent = "Vui lòng nhập Mã NV.";
        disableOtherInputs(true);
        return;
    }

    // request tới check_id.php
    fetch('check_id.php?IDNV=' + encodeURIComponent(idnv))
        .then(res => res.json())
        .then(data => {
            if (data.exists) {
                errIDNV.textContent = "Mã NV đã tồn tại. Vui lòng chọn mã khác.";
                disableOtherInputs(true);
            } else {
                errIDNV.textContent = "";
                disableOtherInputs(false);
            }
        })
        .catch(err => {
            // trong trường hợp lỗi network, để phòng ngừa: disable submit
            console.error(err);
            errIDNV.textContent = "Không thể kiểm tra mã (lỗi mạng). Vui lòng thử lại.";
            disableOtherInputs(true);
        });
}, 400);

// Bắt sự kiện input / blur trên IDNV
idnvInput.addEventListener('input', function(){
    // mỗi khi thay đổi, tắt các ô khác cho đến khi kiểm tra xong
    disableOtherInputs(true);
    errIDNV.textContent = "Đang kiểm tra...";
    checkId();
});

// Khi tải trang, nếu server đã báo lỗi IDNV (ví dụ sau submit), vẫn giữ disable nếu lỗi
window.addEventListener('load', function(){
    if (errIDNV.textContent.trim()) {
        disableOtherInputs(true);
    } else if (idnvInput.value.trim()) {
        // kích hoạt kiểm tra 1 lần
        checkId();
    }
});

// Khi submit, đảm bảo client-side kiểm tra lại 1 lần nữa
frm.addEventListener('submit', function(e){
    if (errIDNV.textContent.trim()) {
        e.preventDefault();
        alert('Vui lòng sửa lỗi trước khi gửi form.');
        idnvInput.focus();
    }
});
</script>

</body>
</html>

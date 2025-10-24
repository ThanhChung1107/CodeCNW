<?php
// check_id.php
include 'connect.php';

$idnv = isset($_GET['IDNV']) ? trim($_GET['IDNV']) : '';

header('Content-Type: application/json');

if ($idnv === '') {
    echo json_encode(['exists' => false, 'error' => 'empty']);
    exit;
}

$stmt = $conn->prepare("SELECT COUNT(*) FROM nhanvien WHERE IDNV = ?");
$stmt->bind_param("s", $idnv);
$stmt->execute();
$stmt->bind_result($count);
$stmt->fetch();
$stmt->close();
$conn->close();

echo json_encode(['exists' => ($count > 0)]);

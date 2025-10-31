<?php
// controller/C_Student.php
require_once(__DIR__ . '/../model/M_student.php');

class C_student {
    public function invoke() {
        $studentModel = new M_Student();

        // ===== API KIỂM TRA MÃ SV TỒN TẠI =====
        if (isset($_GET['check_id'])) {
            header('Content-Type: application/json');
            $id = $_GET['check_id'] ?? '';
            $exists = $studentModel->checkStudentExists($id);
            echo json_encode(['exists' => $exists]);
            exit;
        }

        // 1) Thêm sinh viên (mod1=1)
        if (isset($_GET['mod1']) && $_GET['mod1'] == '1') {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $id = $_POST['id'] ?? '';
                $name = $_POST['name'] ?? '';
                $age = $_POST['age'] ?? '';
                $university = $_POST['university'] ?? '';
                $studentModel->addStudent($id, $name, $age, $university);
                header("Location: C_Student.php");
                exit;
            } else {
                include_once(__DIR__ . '/../view/studentadd.php');
                return;
            }
        }

        // 2) Cập nhật sinh viên (mod2=1)
        if (isset($_GET['mod2']) && $_GET['mod2'] == '1') {
            // Nếu chưa chọn sinh viên (no stid) -> hiện danh sách chọn để cập nhật
            if (!isset($_GET['stid'])) {
                $students = $studentModel->getAllStudents();
                include_once(__DIR__ . '/../view/studentlistforupdate.php');
                return;
            }

            // Nếu đã chọn (click một SV) -> hiển thị form update hoặc xử lý POST
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $id = $_POST['id'] ?? '';
                $name = $_POST['name'] ?? '';
                $age = $_POST['age'] ?? '';
                $university = $_POST['university'] ?? '';
                $studentModel->updateStudent($id, $name, $age, $university);
                header("Location: C_Student.php?mod2=1");
                exit;
            } else {
                $student = $studentModel->getStudentDetail($_GET['stid']);
                include_once(__DIR__ . '/../view/studentupdate.php');
                return;
            }
        }

        // 3) Xóa sinh viên (mod3=1)
        if (isset($_GET['mod3']) && $_GET['mod3'] == '1') {
            if (isset($_GET['stid'])) {
                $studentModel->deleteStudent($_GET['stid']);
                header("Location: C_Student.php");
                exit;
            } else {
                $students = $studentModel->getAllStudents();
                include_once(__DIR__ . '/../view/studentlistfordelete.php');
                return;
            }
        }

        // 4) Xóa tất cả sinh viên (mod4=1)
        if (isset($_GET['mod4']) && $_GET['mod4'] == '1') {
            $studentModel->deleteAllStudents();
            header("Location: C_Student.php");
            exit;
        }

        // 5) Xem chi tiết nếu request có stid và không phải mod2
        if (isset($_GET['stid']) && !isset($_GET['mod2'])) {
            $student = $studentModel->getStudentDetail($_GET['stid']);
            include_once(__DIR__ . '/../view/studentdetail.php');
            return;
        }

        // 6) Mặc định: hiển thị danh sách
        $students = $studentModel->getAllStudents();
        include_once(__DIR__ . '/../view/studentlist.php');
    }
}

$controller = new C_student();
$controller->invoke();
?>
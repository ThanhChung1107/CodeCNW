<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ - Hệ thống quản lý nhân sự</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f7fa;
            color: #333;
            overflow: hidden;
        }

        .container {
            display: grid;
            grid-template-areas: 
                "header header"
                "sidebar content";
            grid-template-rows: 70px 1fr;
            grid-template-columns: 250px 1fr;
            height: 100vh;
        }

        /* Header Styles */
        header {
            grid-area: header;
            background-color: #2c3e50;
            color: white;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 30px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            z-index: 100;
        }

        .logo {
            font-size: 24px;
            font-weight: bold;
        }

        .logo span {
            color: #3498db;
        }

        .auth-buttons {
            display: flex;
            gap: 15px;
        }

        .btn {
            padding: 8px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-login {
            background-color: #3498db;
            color: white;
            border: none;
        }

        .btn-logout {
            background-color: #e74c3c;
            color: white;
            border: none;
        }

        .btn-register {
            background-color: transparent;
            color: white;
            border: 1px solid white;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-info img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        /* Sidebar Styles */
        .sidebar {
            grid-area: sidebar;
            background-color: #34495e;
            color: white;
            padding: 20px 0;
            overflow-y: auto;
            box-shadow: 2px 0 5px rgba(0,0,0,0.1);
        }

        .sidebar-title {
            padding: 0 20px 15px;
            font-size: 18px;
            border-bottom: 1px solid #4a6278;
            margin-bottom: 15px;
        }

        .sidebar-menu {
            list-style: none;
        }

        .sidebar-menu li {
            padding: 12px 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
        }

        .sidebar-menu li i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        .sidebar-menu li:hover {
            background-color: #3c546b;
        }

        .sidebar-menu li.active {
            background-color: #3498db;
        }

        .menu-divider {
            height: 1px;
            background-color: #4a6278;
            margin: 10px 20px;
        }

        /* Content Styles */
        .content {
            grid-area: content;
            padding: 20px;
            overflow-y: auto;
            background-color: #f5f7fa;
        }

        .content-frame {
            background-color: white;
            border-radius: 8px;
            padding: 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }

        .content-frame h2 {
            margin-bottom: 20px;
            color: #2c3e50;
        }

        .content-frame p {
            color: #7f8c8d;
            max-width: 600px;
            line-height: 1.6;
        }

        .welcome-icon {
            font-size: 80px;
            color: #3498db;
            margin-bottom: 20px;
        }

        /* Login Modal */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
            z-index: 1000;
            align-items: center;
            justify-content: center;
        }

        .modal-content {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            width: 400px;
            max-width: 90%;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .modal-header h2 {
            color: #2c3e50;
        }

        .close-modal {
            font-size: 24px;
            cursor: pointer;
            color: #7f8c8d;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #2c3e50;
            font-weight: 500;
        }

        .form-group input {
            width: 100%;
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        .form-group input:focus {
            border-color: #3498db;
            outline: none;
        }

        .modal-footer {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-top: 20px;
        }

        .btn-cancel {
            background-color: #95a5a6;
            color: white;
            border: none;
        }

        .btn-submit {
            background-color: #3498db;
            color: white;
            border: none;
        }

        .error-message {
            color: #e74c3c;
            background-color: #fadbd8;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 15px;
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <header>
            <div class="logo">Hệ thống <span>Quản lý Nhân sự</span></div>
            <div class="auth-buttons">
                <div id="user-info" class="user-info" style="display: none;">
                    <img src="https://i.pravatar.cc/40" alt="Avatar">
                    <span id="username-display">Nguyễn Văn A</span>
                    <button class="btn btn-logout" id="logout-btn">
                        <i class="fas fa-sign-out-alt"></i> Đăng xuất
                    </button>
                </div>
                <div id="guest-buttons">
                    <button class="btn btn-login" id="login-btn">
                        <i class="fas fa-sign-in-alt"></i> Đăng nhập
                    </button>
                </div>
            </div>
        </header>

        <!-- Sidebar -->
        <div class="sidebar">
            <div class="sidebar-title">Chức năng hệ thống</div>
            <ul class="sidebar-menu" id="sidebar-menu">
                <!-- Các chức năng khi chưa đăng nhập -->
                <li class="menu-item" data-page="xemthongtinnv.php">
                    <i class="fas fa-users"></i> Xem thông tin nhân viên
                </li>
                <li class="menu-item" data-page="xemthongtinpb.php">
                    <i class="fas fa-building"></i> Xem thông tin phòng ban
                </li>
                <li class="menu-item" data-page="timkiem.php">
                    <i class="fas fa-search"></i> Tìm kiếm thông tin
                </li>
                
                <!-- Các chức năng sau khi đăng nhập (ẩn ban đầu) -->
                <div id="admin-functions" style="display: none;">
                    <div class="menu-divider"></div>
                    <li class="menu-item" data-page="chen.php">
                        <i class="fas fa-plus-circle"></i> Chèn thông tin
                    </li>
                    <li class="menu-item" data-page="capnhat.php">
                        <i class="fas fa-edit"></i> Cập nhật thông tin
                    </li>
                    <li class="menu-item" data-page="xoa.php">
                        <i class="fas fa-trash-alt"></i> Xóa thông tin
                    </li>
                    <li class="menu-item" data-page="xoatatca.php">
                        <i class="fas fa-broom"></i> Xóa tất cả
                    </li>
                </div>
            </ul>
        </div>

        <!-- Content -->
        <div class="content">
            <div class="content-frame" id="content-frame">
                <div class="welcome-icon">
                    <i class="fas fa-home"></i>
                </div>
                <h2>Chào mừng đến với Hệ thống Quản lý Nhân sự</h2>
                <p>Vui lòng chọn một chức năng từ menu bên trái để bắt đầu. Để sử dụng các chức năng quản trị, bạn cần đăng nhập vào hệ thống.</p>
            </div>
        </div>
    </div>

    <!-- Login Modal -->
    <div class="modal" id="login-modal">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Đăng nhập hệ thống</h2>
                <span class="close-modal" id="close-login-modal">&times;</span>
            </div>
            <div class="error-message" id="login-error"></div>
            <form id="login-form">
                <div class="form-group">
                    <label for="username">Tên đăng nhập</label>
                    <input type="text" id="username" name="username" placeholder="Nhập tên đăng nhập" required>
                </div>
                <div class="form-group">
                    <label for="password">Mật khẩu</label>
                    <input type="password" id="password" name="password" placeholder="Nhập mật khẩu" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-cancel" id="cancel-login">Hủy</button>
                    <button type="submit" class="btn btn-submit">Đăng nhập</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // DOM Elements
        const loginBtn = document.getElementById('login-btn');
        const logoutBtn = document.getElementById('logout-btn');
        const loginModal = document.getElementById('login-modal');
        const closeLoginModal = document.getElementById('close-login-modal');
        const cancelLogin = document.getElementById('cancel-login');
        const loginForm = document.getElementById('login-form');
        const userInfo = document.getElementById('user-info');
        const guestButtons = document.getElementById('guest-buttons');
        const adminFunctions = document.getElementById('admin-functions');
        const contentFrame = document.getElementById('content-frame');
        const menuItems = document.querySelectorAll('.menu-item');
        const loginError = document.getElementById('login-error');
        const usernameDisplay = document.getElementById('username-display');

        // Kiểm tra trạng thái đăng nhập khi trang được tải
        document.addEventListener('DOMContentLoaded', function() {
            checkLoginStatus();
        });

        // Mở modal đăng nhập
        loginBtn.addEventListener('click', () => {
            loginModal.style.display = 'flex';
            loginError.style.display = 'none';
        });

        // Đóng modal đăng nhập
        closeLoginModal.addEventListener('click', () => {
            loginModal.style.display = 'none';
        });

        cancelLogin.addEventListener('click', () => {
            loginModal.style.display = 'none';
        });

        // Xử lý đăng nhập bằng AJAX
        loginForm.addEventListener('submit', (e) => {
            e.preventDefault();
            
            const formData = new FormData(loginForm);
            
            fetch('process_login.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                if (data.includes('success') || data.trim() === '') {
                    // Đăng nhập thành công
                    loginModal.style.display = 'none';
                    checkLoginStatus();
                } else {
                    // Đăng nhập thất bại
                    loginError.textContent = 'Sai tài khoản hoặc mật khẩu!';
                    loginError.style.display = 'block';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                loginError.textContent = 'Có lỗi xảy ra khi đăng nhập!';
                loginError.style.display = 'block';
            });
        });

        // Xử lý đăng xuất
        logoutBtn.addEventListener('click', () => {
            fetch('logout.php')
                .then(response => response.text())
                .then(() => {
                    checkLoginStatus();
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });

        // Kiểm tra trạng thái đăng nhập
        function checkLoginStatus() {
            fetch('check_login.php')
                .then(response => response.json())
                .then(data => {
                    if (data.loggedIn) {
                        usernameDisplay.textContent = data.username;
                        userInfo.style.display = 'flex';
                        guestButtons.style.display = 'none';
                        adminFunctions.style.display = 'block';
                    } else {
                        userInfo.style.display = 'none';
                        guestButtons.style.display = 'block';
                        adminFunctions.style.display = 'none';
                    }
                })
                .catch(error => {
                    console.error('Error checking login status:', error);
                });
        }

        // Xử lý click vào menu item
        menuItems.forEach(item => {
            item.addEventListener('click', () => {
                // Xóa active class từ tất cả các item
                menuItems.forEach(i => i.classList.remove('active'));
                // Thêm active class cho item được click
                item.classList.add('active');
                
                // Lấy trang cần hiển thị
                const page = item.getAttribute('data-page');
                
                // Tải nội dung bằng AJAX
                fetch(page)
                    .then(response => response.text())
                    .then(html => {
                        contentFrame.innerHTML = html;
                    })
                    .catch(error => {
                        console.error('Error loading content:', error);
                        contentFrame.innerHTML = `
                            <h2>Lỗi tải trang</h2>
                            <p>Không thể tải nội dung từ ${page}. Vui lòng thử lại.</p>
                        `;
                    });
            });
        });
    </script>
</body>
</html>
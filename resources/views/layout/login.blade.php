<?php
// login.php - Simple PHP logic for Cinebook login

session_start();

// Database configuration (Example)
$servername = "localhost";
$username_db = "root";
$password_db = "";
$dbname = "cinebook_db";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // In a real application, you would connect to a database and verify credentials
    // For this demonstration, we'll use a hardcoded check
    if ($user === "admin" && $pass === "password123") {
        $_SESSION['user'] = $user;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Tên đăng nhập hoặc mật khẩu không chính xác.";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>PHP Login Logic - Cinebook</title>
    <style>
        body { font-family: sans-serif; padding: 20px; line-height: 1.6; }
        .code-box { background: #f4f4f4; border: 1px solid #ddd; padding: 15px; border-radius: 5px; overflow-x: auto; }
        h2 { color: #E50914; }
    </style>
</head>
<body>
    <h2>Hướng dẫn tích hợp PHP cho Cinebook</h2>
    <p>Dưới đây là đoạn mã PHP cơ bản để xử lý việc đăng nhập. Bạn có thể lưu đoạn mã này vào tệp <code>login.php</code>.</p>
    
    <div class="code-box">
        <pre>
&lt;?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Kết nối CSDL và kiểm tra...
    if ($username == "user" && $password == "pass") {
        echo "Đăng nhập thành công!";
    } else {
        echo "Thất bại!";
    }
}
?&gt;
        </pre>
    </div>

    <p>Đừng quên đặt thuộc tính <code>method="POST"</code> và <code>action="login.php"</code> trong thẻ <code>&lt;form&gt;</code> của mã HTML trang đăng nhập.</p>
</body>
</html>
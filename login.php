<?php
session_start();
$host = 'localhost';
$user = 'root';
$password = '';
$db = 'win';
$port = 3406; // Đặt cổng ở đây

$conn = new mysqli($host, $user, $password, $db, $port);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}


$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $input_password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();
        if (password_verify($input_password, $user['password'])) {
            // Lưu session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];

            // Cập nhật trạng thái online
            $updateStatus = $conn->prepare("UPDATE users SET status = 1 WHERE id = ?");
            $updateStatus->bind_param("i", $user['id']);
            $updateStatus->execute();
            $updateStatus->close();

            // Chuyển hướng về index
            header("Location: index.php");
            exit();
        } else {
            $message = "⚠️ Mật khẩu không đúng!";
        }
    } else {
        $message = "⚠️ Tài khoản không tồn tại!";
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Đăng nhập</title>
  <style>
    body {
      font-family: sans-serif;
      background: url('image/nen/nenlog.jpeg') no-repeat center center/cover;
      display: flex;
      background-size: 108%;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }
    form {
      background: rgba(255, 255, 255, 0.15); /* trắng mờ */
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
      width: 300px;
      backdrop-filter: blur(10px);
      color: white;
      text-align: center;
    }
    input {
      width: 92%;
      padding: 10px;
      margin: 10px 0;
      border: 1px solid white;
      border-radius: 5px;
      background: transparent;
      color: white;
      text-align: center;
      font-size: 16px;
    }
    input::placeholder {
      color: #ddd;
      text-align: center;
    }
    button {
      width: 100%;
      padding: 10px;
      margin-top: 10px;
      background-color: rgba(255, 255, 255, 0.2);
      border: 1px solid white;
      border-radius: 5px;
      color: white;
      font-weight: bold;
      font-size: 16px;
      cursor: pointer;
      transition: background 0.3s;
    }
    button:hover {
      background-color: rgba(255, 255, 255, 0.3);
    }
    .link-register {
      margin-top: 15px;
    }
    .link-register a {
      color: white; /* xanh dương */
      text-decoration: none;
      font-size: 14px;
    }
    .link-register a:hover {
      text-decoration: underline;
    }
    .message {
      color: #ff4d4d;
      margin-top: 10px;
    }
  </style>
</head>
<body>
  <form method="POST" action="login.php">
    <h2>🔑 Đăng nhập</h2>
    <input type="text" name="username" placeholder="Tên tài khoản" required>
    <input type="password" name="password" placeholder="Mật khẩu" required>
    <button type="submit">Đăng nhập</button>
    <div class="link-register">
      <a href="register.php">Đăng ký nếu chưa có tài khoản?</a>
    </div>
    <?php if (!empty($message)) echo "<div class='message'>$message</div>"; ?>
  </form>
</body>
</html>

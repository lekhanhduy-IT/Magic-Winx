<?php
// PHP phần xử lý như bạn đang có (không thay đổi)
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

// Lấy danh sách nhân vật
$image_query = "SELECT * FROM image_user";
$image_result = $conn->query($image_query);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $plain_password = $_POST['password'];
    $user_static = $_POST['user_static'];
    $user_fly = $_POST['user_fly'];
    $hashed_password = password_hash($plain_password, PASSWORD_DEFAULT);

    $check_sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($check_sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $message = "⚠️ Tên tài khoản đã tồn tại!";
    } else {
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $username, $hashed_password);
        $stmt->execute();
        $user_id = $stmt->insert_id;

        $sql2 = "INSERT INTO outfits (user_id, image2, image1, image3, image4)
                 VALUES (?, ?, ?, 'canhtrong.png', 'canhtrong.png')";
        $stmt2 = $conn->prepare($sql2);
        $stmt2->bind_param("iss", $user_id, $user_fly, $user_static);
        $stmt2->execute();

        $message = '✅ Đăng ký thành công! Hãy <a href="login.php" style="color: blue; text-decoration: underline;">đăng nhập</a>.';
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Đăng ký tài khoản</title>
  <style>
    body {
      font-family: sans-serif;
      margin: 0;
      padding: 0;
      height: 100vh;
      background: linear-gradient(to right, #a1c4fd, #c2e9fb);
      display: flex;
    }
    .left, .right {
      flex: 1;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 20px;
      box-sizing: border-box;
    }
    .left {
      background: rgba(255,255,255,0.9);
    }
    form {
      width: 100%;
      max-width: 400px;
      text-align: center;
    }
 button {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
    }
    input{
        width: 92%;
      padding: 10px;
      margin: 10px 0;

    }
    .message {
      color: red;
      margin-top: 10px;
    }
    .character-list {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
      justify-content: center;
      align-items: center;
      max-width: 500px;
      overflow-y: auto;
      max-height: 90vh;
      margin-top:150px;
      margin-bottom:150px;
      padding: 20px;
    }
    .user-container {
      position: relative;
      width: 220px;
      height: 220px;
      border: 2px solid transparent;
      border-radius: 10px;
      overflow: hidden;
      cursor: pointer;
      background: white;
      box-shadow: 0 2px 8px rgba(0,0,0,0.2);
      transition: border-color 0.3s;
    }
    .user-container.selected {
      border-color: blue;
    }
    .user-container img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      position: absolute;
      top: 0;
      left: 0;
      transition: opacity 0.3s;
    }
  </style>
</head>
<body>

  <div class="left">
    <form method="POST" action="register.php">
      <h2>🔐 Đăng ký tài khoản</h2>
      <input type="text" name="username" placeholder="Tên tài khoản" required>
      <input type="password" name="password" placeholder="Mật khẩu" required>

      <!-- Input ẩn -->
      <input type="hidden" name="user_static" id="user_static" required>
      <input type="hidden" name="user_fly" id="user_fly" required>

      <button type="submit">Đăng ký</button>
      <?php if (!empty($message)) echo "<div class='message'>$message</div>"; ?>
    </form>
  </div>

  <div class="right">
    <div class="character-list" id="characterList">
      <?php while($row = $image_result->fetch_assoc()): ?>
        <div class="user-container" 
             data-user_static="<?= htmlspecialchars($row['user_static']) ?>" 
             data-user_fly="<?= htmlspecialchars($row['user_fly']) ?>">
          <img src="<?= htmlspecialchars($row['user_static']) ?>" class="static" style="opacity:1;">
          <img src="<?= htmlspecialchars($row['user_fly']) ?>" class="fly" style="opacity:0;">
        </div>
      <?php endwhile; ?>
    </div>
  </div>

  <script>
    const containers = document.querySelectorAll('.user-container');
    let selectedContainer = null;

    containers.forEach(container => {
      let staticImg = container.querySelector('.static');
      let flyImg = container.querySelector('.fly');

      // Đổi ảnh động
      setInterval(() => {
        if (staticImg.style.opacity == "1") {
          staticImg.style.opacity = "0";
          flyImg.style.opacity = "1";
        } else {
          staticImg.style.opacity = "1";
          flyImg.style.opacity = "0";
        }
      }, 300);

      // Chọn nhân vật
      container.addEventListener('click', () => {
        if (selectedContainer) {
          selectedContainer.classList.remove('selected');
        }
        container.classList.add('selected');
        selectedContainer = container;

        document.getElementById('user_static').value = container.getAttribute('data-user_static');
        document.getElementById('user_fly').value = container.getAttribute('data-user_fly');
      });
    });
  </script>

</body>
</html>

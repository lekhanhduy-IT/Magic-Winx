<?php
session_start();
include 'config.php'; // file kết nối CSDL, hoặc copy kết nối DB vào đây nếu chưa có

if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];

    // Cập nhật trạng thái offline trong database
    $updateStatus = $conn->prepare("UPDATE users SET status = 0 WHERE id = ?");
    $updateStatus->bind_param("i", $userId);
    $updateStatus->execute();
    $updateStatus->close();
}

// Xóa session
session_unset();
session_destroy();

// Chuyển hướng về login
header("Location: login.php");
exit();
?>

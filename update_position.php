<?php
session_start();
require_once('config.php'); // Kết nối cơ sở dữ liệu

if (isset($_POST['user_id'], $_POST['x'], $_POST['y'])) {
    $user_id = (int) $_POST['user_id'];
    $x = (int) $_POST['x'];
    $y = (int) $_POST['y'];

    // Cập nhật vị trí của người dùng trong cơ sở dữ liệu
    $sql = "UPDATE outfits SET x = ?, y = ? WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('iii', $x, $y, $user_id);
    $stmt->execute();
    $stmt->close();
}
?>


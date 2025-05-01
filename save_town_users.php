<?php
session_start();
$data = json_decode(file_get_contents('php://input'), true);

// Lưu danh sách nhân vật vào session
if ($data) {
    $_SESSION['town_users'] = $data;
}
?>

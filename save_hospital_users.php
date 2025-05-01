<?php
session_start();

$data = json_decode(file_get_contents('php://input'), true);

if ($data && is_array($data)) {
    $_SESSION['hospital_users'] = $data; // Lưu tất cả user vào session
}
?>

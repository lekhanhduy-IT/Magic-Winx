<?php
// get_effect_status.php

// Kết nối Database
$host = 'localhost';
$user = 'root';
$password = '';
$db = 'win';
$port = 3406;

$conn = new mysqli($host, $user, $password, $db, $port);

if ($conn->connect_error) {
    die(json_encode([]));
}

$sql = "SELECT user_id as id, status_effect FROM outfits";
$result = $conn->query($sql);

$users = [];
while ($row = $result->fetch_assoc()) {
    $users[] = $row;
}

echo json_encode($users);
?>

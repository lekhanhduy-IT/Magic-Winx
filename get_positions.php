<?php
require_once('config.php'); // Kết nối cơ sở dữ liệu

// Truy vấn tất cả vị trí người chơi
$sql = "SELECT user_id, x, y FROM outfits";
$result = $conn->query($sql);

$positions = [];
while ($row = $result->fetch_assoc()) {
    $positions[] = $row;
}

echo json_encode($positions); // Trả về dữ liệu dưới dạng JSON
?>

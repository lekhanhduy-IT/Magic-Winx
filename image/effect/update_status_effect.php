<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = intval($_POST['user_id']);
    $effectIndex = intval($_POST['effect_index']);
    $status = intval($_POST['status']);

    $conn = new mysqli('localhost', 'root', '', 'win', 3406);
    if ($conn->connect_error) {
        http_response_code(500);
        echo "Kết nối cơ sở dữ liệu thất bại";
        exit;
    }

    // Xác định tên cột trạng thái cần cập nhật
    $statusColumns = ['status_effect', 'status_effect1', 'status_effect2', 'status_effect3'];

    // Tạo mảng cập nhật
    $updates = [];
    foreach ($statusColumns as $index => $column) {
        $updates[] = "$column = " . ($index === $effectIndex ? $status : 0);
    }

    $updateQuery = "UPDATE outfits SET " . implode(', ', $updates) . " WHERE user_id = $userId";
    $conn->query($updateQuery);
    $conn->close();

    echo 'success';
}
?>

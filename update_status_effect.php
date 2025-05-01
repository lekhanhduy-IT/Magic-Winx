<?php
// Kết nối CSDL
$host = 'localhost';
$user = 'root';
$password = '';
$db = 'win';
$port = 3406;

$conn = new mysqli($host, $user, $password, $db, $port);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Nhận dữ liệu từ client
$user_id = intval($_POST['user_id']);
$effect_index = intval($_POST['effect_index']);
$status = intval($_POST['status']);

// Tên các cột tương ứng với hiệu ứng
$columns = ['status_effect', 'status_effect1', 'status_effect2', 'status_effect3'];

if (!isset($columns[$effect_index])) {
    die("Effect index không hợp lệ");
}

// Nếu status = 1 thì bật cột tương ứng và tắt các cột còn lại
if ($status === 1) {
    // Tạo câu SQL cập nhật duy nhất 1 cột = 1, các cột còn lại = 0
    $updates = [];
    foreach ($columns as $index => $col) {
        $value = ($index === $effect_index) ? 1 : 0;
        $updates[] = "$col = $value";
    }
    $sql = "UPDATE outfits SET " . implode(", ", $updates) . " WHERE user_id = ?";
} else {
    // Nếu status = 0 thì chỉ tắt hiệu ứng đang được yêu cầu
    $column_name = $columns[$effect_index];
    $sql = "UPDATE outfits SET $column_name = 0 WHERE user_id = ?";
}

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();

if ($stmt->affected_rows >= 0) {
    echo "Cập nhật hiệu ứng thành công";
} else {
    echo "Không có thay đổi";
}

$stmt->close();
$conn->close();
?>

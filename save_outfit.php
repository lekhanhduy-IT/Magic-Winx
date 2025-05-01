<?php
session_start();

// Kiểm tra nếu người dùng chưa đăng nhập
if (!isset($_SESSION['user_id'])) {
    http_response_code(403); // Cấm truy cập
    echo "Bạn chưa đăng nhập.";
    exit();
}

$host = 'localhost';
$user = 'root';
$password = '';
$db = 'win';
$port = 3406; // Đặt cổng ở đây

$conn = new mysqli($host, $user, $password, $db, $port);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

$image3 = $_POST['image3'] ?? '';
$image4 = $_POST['image4'] ?? '';
$user_id = $_SESSION['user_id'];

$sql_check = "SELECT * FROM outfits WHERE user_id = ?";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->bind_param("i", $user_id);
$stmt_check->execute();
$result = $stmt_check->get_result();

if ($result->num_rows > 0) {
    $sql = "UPDATE outfits SET image3 = ?, image4 = ? WHERE user_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $image3, $image4, $user_id);
} else {
    $sql = "INSERT INTO outfits (user_id, image3, image4) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iss", $user_id, $image3, $image4);
}

$stmt->execute();
$stmt->close();
$conn->close();

echo "✅ Outfit đã được lưu.";
?>

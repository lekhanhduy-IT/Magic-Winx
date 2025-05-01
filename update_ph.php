<?php
// update_ph.php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = intval($_POST['user_id']);
    $ph = intval($_POST['ph']);

    $conn = new mysqli('localhost', 'root', '', 'win', 3406);
    if ($conn->connect_error) {
        http_response_code(500);
        echo "Database error";
        exit;
    }

    $stmt = $conn->prepare("UPDATE outfits SET PH = ? WHERE user_id = ?");
    $stmt->bind_param("ii", $ph, $user_id);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    echo "OK";
}
?>
<?php
session_start();
$user_id = $_POST['user_id'];
$ph = $_POST['ph'];

// Kết nối CSDL
$host = 'localhost';
$user = 'root';
$password = '';
$db = 'win';
$port = 3406; // Đặt cổng ở đây

$conn = new mysqli($host, $user, $password, $db, $port);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Cập nhật PH trong bảng outfits
$sql = "UPDATE outfits SET PH = ? WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ii', $ph, $user_id);
$stmt->execute();

$stmt->close();
$conn->close();
?>

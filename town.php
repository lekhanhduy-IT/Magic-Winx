<?php
session_start();
$current_user_id = $_SESSION['user_id'];

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

// Lấy thông tin user đăng nhập
$sql = "
SELECT 
    users.id, 
    users.username, 
    outfits.image1, 
    outfits.image2, 
    outfits.image3, 
    outfits.image4, 
    outfits.effect, 
    outfits.status_effect,
    outfits.x, 
    outfits.y, 
    users.status
FROM users
INNER JOIN outfits ON users.id = outfits.user_id
WHERE users.id = $current_user_id
";

$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Hospital</title>
    <style>
        body {
            margin: 0;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: url('image/nen/nensugar.jpg') no-repeat center center;
            background-size: cover;
            overflow: hidden;
        }
        .image-container {
      left: 100px;
      top: 120px;
      position: absolute;
      width: 80px; /* chiều rộng ảnh */
      height: 80px; /* chiều cao ảnh */
      overflow: visible;
      transition: transform 3.4s ease;
      animation: moveInCircle 4s linear infinite;
      transform-origin: center; /* Xác định tâm của container */

    }




.image-container img {
    position: absolute;
    top: 120;
  left: 100;
  width: 100%;       /* hoặc 120% nếu cần lớn hơn */
  height: 100%;
  object-fit: contain; /* ✅ Không méo ảnh, giữ nguyên tỷ lệ */
}



.image1, .image3 {
  display: block;
}

.image1, .image2 {
  width: 100%;
  height: 100%;
  z-index: 3; /* Nhân vật */
}

.image3, .image4 {
  width: 100%;
  height: 100%;
  transform: scale(1.2); /* Phóng to nhưng không làm ảnh bị cắt */
  margin-top: -8%;
  z-index: 1; 

}



    </style>
</head>
<body>

<script>
window.onload = function() {
    const character = document.querySelector('.image-container.current-user');
    if (character) {
        const bodyWidth = document.body.clientWidth;
        const bodyHeight = document.body.clientHeight;

        const centerX = (bodyWidth / 2) - (character.offsetWidth / 2);
        const bottomY = bodyHeight - character.offsetHeight - 100; // cách đáy 100px

        character.style.left = `${centerX}px`;
        character.style.top = `${bottomY}px`;

        // Đồng thời update vị trí mới lên server
        updatePosition(centerX, bottomY);
    }
};
</script>


<?php
if ($row = $result->fetch_assoc()) {
    echo '<div class="image-container current-user" 
    data-user-id="' . $row['id'] . '">';


        echo '<div class="username" style="z-index:10;margin: 0 auto; text-align:center;color: gold; font-weight: bold; position: relative; font-family: arial; font-size: 12px;">
                                ' . htmlspecialchars($row['username']) . '
                            </div>';
        echo '<img src="' . $row['image1'] . '" class="image1" style="display:block;">';
        echo '<img src="' . $row['image2'] . '" class="image2" style="display:none;">';
        echo '<img src="' . $row['image3'] . '" class="image3" style="display:block;">';
        echo '<img src="' . $row['image4'] . '" class="image4" style="display:none;">';
        echo '<img src="' . $row['effect'] . '" class="effect-image" style="display:none;position:relative;z-index:2; object-fit: bottom;height:100%; width:100%;left: -0%; top:-20%;">';
    echo '</div>';
}
?>

</body>
<script>
// Đổi ảnh động liên tục
let isStatic = false;
setInterval(() => {
    document.querySelectorAll('.image1').forEach(img => img.style.display = isStatic ? 'block' : 'none');
    document.querySelectorAll('.image2').forEach(img => img.style.display = isStatic ? 'none' : 'block');
    document.querySelectorAll('.image3').forEach(img => img.style.display = isStatic ? 'block' : 'none');
    document.querySelectorAll('.image4').forEach(img => img.style.display = isStatic ? 'none' : 'block');
    isStatic = !isStatic;
}, 200);

// Di chuyển chậm nhân vật chính
document.addEventListener('click', function(e) {
    const character = document.querySelector('.image-container.current-user');
    if (!character) return;

    // Nếu click vào trong nhân vật thì bỏ qua
    if (e.target.closest('.image-container')) {
        return;
    }

    const rect = document.body.getBoundingClientRect();
    const targetX = e.clientX - rect.left - 50; // center align
    const targetY = e.clientY - rect.top - 50;

    let currentX = parseInt(character.style.left) || 0;
    let currentY = parseInt(character.style.top) || 0;

    const speed = 5; // px mỗi frame
    const moveInterval = setInterval(() => {
        const dx = targetX - currentX;
        const dy = targetY - currentY;

        if (Math.abs(dx) < speed && Math.abs(dy) < speed) {
            character.style.left = `${targetX}px`;
            character.style.top = `${targetY}px`;
            updatePosition(targetX, targetY);
            clearInterval(moveInterval);
            return;
        }

        currentX += dx > 0 ? speed : -speed;
        currentY += dy > 0 ? speed : -speed;

        character.style.left = `${currentX}px`;
        character.style.top = `${currentY}px`;
    }, 16); // ~60fps
});



// Hàm gửi vị trí người dùng qua AJAX
function updatePosition(x, y) {
    const userId = document.querySelector('.image-container.current-user').getAttribute('data-user-id');

    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'update_position.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.send(`user_id=${userId}&x=${x}&y=${y}`);
}

</script>

<script>
// Tải dữ liệu vị trí của tất cả người chơi mỗi giây
setInterval(function() {
    const xhr = new XMLHttpRequest();
    xhr.open('GET', 'get_positions.php', true);
    xhr.onload = function() {
        if (xhr.status === 200) {
            const positions = JSON.parse(xhr.responseText);
            updatePositions(positions);
        }
    };
    xhr.send();
}, 100); // Lấy dữ liệu mỗi giây

// Cập nhật lại vị trí của tất cả người chơi
function updatePositions(positions) {
    positions.forEach(function(position) {
        const character = document.querySelector(`[data-user-id="${position.user_id}"]`);
        if (character) {
            character.style.left = `${position.x}px`;
            character.style.top = `${position.y}px`;
        }
    });
}

</script>

</html>

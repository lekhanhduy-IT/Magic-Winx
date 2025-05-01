<?php
session_start();
$current_user_id = $_SESSION['user_id']; // Lấy ID từ session khi người dùng đăng nhập

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


// Lấy toàn bộ user và outfit tương ứng
$sql = "
SELECT 
    users.id, 
    users.username, 
    outfits.image1, 
    outfits.image2, 
    outfits.image3, 
    outfits.image4, 
    outfits.effect, 
    outfits.effect1,
    outfits.effect2,
    outfits.effect3,
    outfits.status_effect,
    outfits.status_effect1,
    outfits.status_effect2,
    outfits.status_effect3,
    outfits.x, 
    outfits.y, 
    users.status
FROM users
INNER JOIN outfits ON users.id = outfits.user_id
WHERE users.status = 1
";


$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
           * {
      box-sizing: border-box;
    }
    body {
  margin: 0;
  height: 100vh;
  overflow: hidden;
  position: relative;
  display: flex;
  align-items: center;
  justify-content: center;
}

#background-video {
  position: absolute;
  top: 50%;
  left: 50%;
  min-width: 100%;
  min-height: 100%;
  width: auto;
  height: auto;
  z-index: -1;
  transform: translate(-50%, -50%);
  object-fit: cover;
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
  transform: scale(1.4); /* Phóng to nhưng không làm ảnh bị cắt */
  margin-top: -8%;
  z-index: 1; /* Nhân vật */

}
  </style>
</head>
<body>
<video autoplay muted loop id="background-video">
    <source src="nenlovestree.mp4" type="video/mp4">
    Your browser does not support HTML5 video.
  </video>

  <!-- Nội dung trang web ở đây -->
  <div class="content">

  <?php
while ($row = $result->fetch_assoc()) {
    $isCurrent = ($row['id'] == $current_user_id) ? 'current-user' : '';

    if ($row['id'] == $current_user_id) {
        // Nếu là current user thì chỉ có effect-icon
        $usernameDisplay = '<div class="username" style="z-index:10;margin: 0 auto; text-align:center;color: gold; font-weight: bold; position: relative; font-family: arial; font-size: 12px;">
                                <i class="fa-solid fa-arrow-up"></i> ' . htmlspecialchars($row['username']) . '
                                <div class="icon-container" style="display: none;">
                                    <img src="effect_icon.png" class="circle-icon effect-icon" data-effect="' . htmlspecialchars($row['effect']) . '">
                                </div>
                            </div>';
    } else {
        // Nếu là người khác thì chỉ có namdam.webp
        $usernameDisplay = '<div class="username" style="z-index:10;text-align:center;color: white; position: relative;font-family: arial; font-size: 12px">
                                ' . htmlspecialchars($row['username']) . '
                                <div class="icon-container" style="display: none;">
                                    <img src="namdam.webp" class="circle-icon namdam-icon">
                                    <img src="set.png" class="circle-icon set-icon" style="left: -10%;">
                                    <img src="sword.webp" class="circle-icon kiem-icon" style="left: -65%;">
                                </div>
                            </div>';
    }

    echo '<div class="image-container ' . $isCurrent . '" 
              data-user-id="' . $row['id'] . '" 
              style="left:' . $row['x'] . 'px; top:' . $row['y'] . 'px;">';
        echo $usernameDisplay;
        echo '<img src="' . $row['image1'] . '" class="image1" style="display:block;">';
        echo '<img src="' . $row['image2'] . '" class="image2" style="display:none;">';
        echo '<img src="' . $row['image3'] . '" class="image3" style="display:block;">';
        echo '<img src="' . $row['image4'] . '" class="image4" style="display:none;">';
        $displayEffect = ($row['status_effect'] == 1) ? 'block' : 'none';
        $displayEffect1 = ($row['status_effect1'] == 1) ? 'block' : 'none';
        $displayEffect2 = ($row['status_effect2'] == 1) ? 'block' : 'none';
        $displayEffect3 = ($row['status_effect3'] == 1) ? 'block' : 'none';
        
        echo '<img src="' . $row['effect'] . '" class="effect-image" style="display:' . $displayEffect . ';position:relative;z-index:2; object-fit: bottom;height:100%; width:120%;left: -10%; top:10%;">';
        echo '<img src="' . $row['effect1'] . '" class="effect-image1" style="display:' . $displayEffect1 . ';position:relative;z-index:2; object-fit: bottom;height:100%; width:120%;left: -10%; top:10%;">';
        echo '<img src="' . $row['effect2'] . '" class="effect-image2" style="display:' . $displayEffect2 . ';position:relative;z-index:2; object-fit: bottom;height:100%; width:120%;left: -10%; top:10%;">';
        echo '<img src="' . $row['effect3'] . '" class="effect-image3" style="display:' . $displayEffect3 . ';position:relative;z-index:2; object-fit: bottom;height:100%; width:120%;left: -10%; top:-30%;">';
                
    echo '</div>';
}
?>
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

    // Nếu click vào trong .image-container thì không làm gì
    if (e.target.closest('.image-container')) {
        return;
    }

    const targetX = e.clientX - 50; // Dịch sang trái 50 để nhân vật nằm giữa click
    const targetY = e.clientY - 50;

    let currentX = parseInt(character.style.left) || 0;
    let currentY = parseInt(character.style.top) || 0;

    const speed = 5; // px mỗi frame
    const moveInterval = setInterval(() => {
        const dx = targetX - currentX;
        const dy = targetY - currentY;

        if (Math.abs(dx) < speed && Math.abs(dy) < speed) {
            character.style.left = `${targetX}px`;
            character.style.top = `${targetY}px`;

            // Gửi vị trí mới của người dùng lên server qua AJAX
            updatePosition(targetX, targetY);

            clearInterval(moveInterval);
            return;
        }

        currentX += dx > 0 ? speed : -speed;
        currentY += dy > 0 ? speed : -speed;

        character.style.left = `${currentX}px`;
        character.style.top = `${currentY}px`;

        // Gửi vị trí mới của người dùng lên server qua AJAX
        updatePosition(currentX, currentY);
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

</div>

</body>
<style>
.icon-container {
    position: absolute;
    top: -40px;
    left: 50%;
    transform: translateX(-50%);
    display: none;
    z-index: 5;
    width: 40px;
    height: 30px; /* hoặc cao hơn tùy bạn */
    display: flex;
    align-items: center; /* cho ảnh thẳng hàng theo chiều dọc */
    background: rgba(0, 0, 0, 0); /* nền mờ cho dễ thấy icon */
    border-radius: 8px; /* bo góc */
    padding: 0px; /* thêm khoảng cách trong */
    text-align: centercenter;
}

.icon-container img {
    width: 24px;
    height: 24px;
    cursor: pointer; /* để có icon tay khi hover */
    

}

</style>


<style>
@keyframes fadeUp {
    0% {
        opacity: 0;
        transform: translateY(20px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

.effect-image.show-effect {
    animation: fadeUp 1s ease-out forwards;
}
</style>


</html>

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
    outfits.status_effect,
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
  display: flex;
  align-items: center;
  justify-content: center;
  background-image: url('duongdat.jpg');
  background-repeat: no-repeat;
  background-size: auto 145%; /* Chiều cao bằng 100% màn hình, chiều rộng tự co */
  background-position: bottom center; /* Căn dưới và giữa */
  background-attachment: fixed; /* Tuỳ, nếu muốn background cố định */
  position: relative;
  overflow: hidden;
}
    .image-container {
        position: absolute;
        width: 100px;
        height: 100px;
    }
    .image-container img {
        position: absolute;
        width: 100px;
        height: 100px;
    }
    .image1, .image3 {
  display: block;
}

.image1, .image2 {
  z-index: 3; /* Nhân vật */
  
}

.image3, .image4 {
  z-index: 1; /* Cánh */
}
  </style>
</head>
<body>
  

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
        echo '<img src="' . $row['effect'] . '" class="effect-image" style="display:none;position:relative;z-index:2; object-fit: bottom;height:100%; width:100%;left: -0%; top:-20%;">';
    echo '</div>';
}
?>


<!-- Thêm phần JS vào cuối trang -->
<script>
// Tất cả mã JavaScript ở trên, bao gồm phần kết nối WebSocket và các xử lý sự kiện
const socket = new WebSocket('ws://localhost:8080');  // Kết nối đến WebSocket server

socket.onopen = function() {
    console.log('WebSocket connection established');
};

socket.onmessage = function(event) {
    const data = JSON.parse(event.data);
    console.log('Received:', data);
    
    // Cập nhật giao diện của các client khác
    if (data.type === 'effect') {
        updateEffect(data.userId, data.effectVisible);
    } else if (data.type === 'attack') {
        launchSkillEffect(data);
    }
};

socket.onclose = function() {
    console.log('WebSocket connection closed');
};

// Cập nhật hiệu ứng cho các client khác
function updateEffect(userId, effectVisible) {
    const userContainer = document.querySelector(`.image-container[data-user-id='${userId}']`);
    const effectImage = userContainer.querySelector('.effect-image');
    if (effectVisible) {
        effectImage.style.display = 'block';
        effectImage.classList.add('show-effect');
    } else {
        effectImage.style.display = 'none';
        effectImage.classList.remove('show-effect');
    }
}

// Tạo hiệu ứng skill bay khi tấn công
function launchSkillEffect(data) {
    const skill = document.createElement('img');
    skill.src = 'skill6.gif';
    skill.style.position = 'fixed';
    skill.style.left = (data.startX - 25) + 'px';
    skill.style.top = (data.startY - 25) + 'px'; 
    skill.style.width = '100px';
    skill.style.height = '100px';
    skill.style.zIndex = '10000';
    skill.style.pointerEvents = 'none';
    skill.style.transition = 'transform 1.2s linear';
    document.body.appendChild(skill);

    setTimeout(() => {
        skill.style.transform = `translate(${data.dx}px, ${data.dy}px) rotate(${data.angle}deg)`;
    }, 10);

    setTimeout(() => {
        skill.remove();
    }, 1300); // Delay > 1.2s
}

// Xử lý sự kiện click cho các user
document.querySelectorAll('.image-container').forEach(container => {
    container.addEventListener('click', function(e) {
        if (e.target.classList.contains('effect-icon') || e.target.classList.contains('namdam-icon')) return;

        document.querySelectorAll('.icon-container').forEach(ic => ic.style.display = 'none');

        const iconContainer = this.querySelector('.icon-container');
        if (iconContainer) {
            iconContainer.style.display = 'block';
        }
        e.stopPropagation();
    });

    const effectIcon = container.querySelector('.effect-icon');
    const effectImage = container.querySelector('.effect-image');
    const namdamIcon = container.querySelector('.namdam-icon');

    // Xử lý effect-icon (chỉ current user)
    if (effectIcon && effectImage) {
        let effectVisible = false;
        effectIcon.addEventListener('click', function(e) {
            effectVisible = !effectVisible;
            if (effectVisible) {
                effectImage.style.display = 'block';  // Hiện hiệu ứng
                effectImage.classList.add('show-effect'); // Thêm animation

                // Gửi thông báo đến server và các client khác
                const userId = container.getAttribute('data-user-id');
                socket.send(JSON.stringify({
                    type: 'effect',
                    userId: userId,
                    effectVisible: true
                }));
            } else {
                effectImage.style.display = 'none'; // Ẩn hiệu ứng
                effectImage.classList.remove('show-effect'); // Xóa animation

                // Gửi thông báo đến server và các client khác
                const userId = container.getAttribute('data-user-id');
                socket.send(JSON.stringify({
                    type: 'effect',
                    userId: userId,
                    effectVisible: false
                }));
            }
            e.stopPropagation();
        });
    }

    // Xử lý namdam-icon (click để tấn công)
    if (namdamIcon) {
        namdamIcon.addEventListener('click', function(e) {
            e.stopPropagation();

            const currentUserContainer = document.querySelector('.image-container.current-user');
            if (!currentUserContainer) return;

            const startRect = currentUserContainer.getBoundingClientRect();
            const startX = startRect.left + startRect.width / 2;
            const startY = startRect.top + startRect.height / 2;

            const targetRect = container.getBoundingClientRect();
            const endX = targetRect.left + targetRect.width / 2;
            const endY = targetRect.top + targetRect.height / 2;

            // Tạo skill bay
            const skill = document.createElement('img');
            skill.src = 'skill6.gif';
            skill.style.position = 'fixed';
            skill.style.left = (startX - 25) + 'px'; // Căn chỉnh để tâm ảnh
            skill.style.top = (startY - 25) + 'px'; 
            skill.style.width = '100px';
            skill.style.height = '100px';
            skill.style.zIndex = '10000';
            skill.style.pointerEvents = 'none';
            skill.style.transition = 'transform 1.2s linear';
            document.body.appendChild(skill);

            // Tính toán vector di chuyển
            const dx = endX - startX;
            const dy = endY - startY;
            const angle = Math.atan2(dy, dx) * 180 / Math.PI;

            // Gửi sự kiện tấn công đến server và các client khác
            const userId = container.getAttribute('data-user-id');
            socket.send(JSON.stringify({
                type: 'attack',
                userId: userId,
                startX: startX,
                startY: startY,
                dx: dx,
                dy: dy,
                angle: angle
            }));

            // Bắt đầu bay skill
            setTimeout(() => {
                skill.style.transform = `translate(${dx}px, ${dy}px) rotate(${angle}deg)`;
            }, 10);

            // Sau khi bay xong thì xóa skill
            setTimeout(() => {
                skill.remove();
            }, 1300); // Delay > 1.2s
        });
    }
});

// Nếu click ra ngoài thì ẩn tất cả icon-container
document.addEventListener('click', function() {
    document.querySelectorAll('.icon-container').forEach(container => {
        container.style.display = 'none';
    });
});
</script>






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

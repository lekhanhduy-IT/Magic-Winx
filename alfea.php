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
                                    <img src="image/icon/effect_icon.png" style="left:-10%;" class="circle-icon effect-icon" data-effect="' . htmlspecialchars($row['effect']) . '">
                                </div>
                            </div>';
    } else {
        // Nếu là người khác thì chỉ có namdam.webp
        $usernameDisplay = '<div class="username" style="z-index:10;text-align:center;color: white; position: relative;font-family: arial; font-size: 12px">
                                ' . htmlspecialchars($row['username']) . '
                                <div class="icon-container" style="display: none;">
                                    <img src="image/icon/namdam.webp" class="circle-icon namdam-icon" style="width:20px;right: -25%";>
                                    <img src="image/icon/set.png" class="circle-icon set-icon" style="left: -15%;width:20px;">
                                    <img src="image/icon/sword.webp" class="circle-icon kiem-icon" style="right: 20%;width:20px;">
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

<!-- Thêm phần JS vào cuối trang -->
<script>
    
    const currentUserId = "<?php echo $current_user_id; ?>"; // Lấy user_id từ session
const socket = new WebSocket('ws://localhost:8888');

socket.onopen = () => {
    console.log('WebSocket connected');
    // Gửi thông tin người dùng sau khi kết nối
    socket.send(JSON.stringify({
    type: 'attack',
    userId,        // người bị tấn công
    skillType,
    senderId: currentUserId
}));

};


socket.onmessage = (event) => {
    const data = JSON.parse(event.data);

    if (data.type === 'effect') {
    updateEffect(data.userId, data.effectIndex, data.status);
}
 else if (data.type === 'attack' && data.senderId !== currentUserId) {
    launchSkillEffect(data);
}
 else if (data.type === 'user_connected') {
        // Hiển thị thông báo người dùng mới kết nối
        alert(data.message); // Hoặc cập nhật giao diện theo cách của bạn
    }
};



socket.onclose = () => {
    console.log('WebSocket disconnected');
};


function updateEffect(userId, effectIndex, status) {
    const container = document.querySelector(`.image-container[data-user-id="${userId}"]`);
    if (!container) return;

    const effectClasses = ['.effect-image', '.effect-image1', '.effect-image2', '.effect-image3'];
    const effect = container.querySelector(effectClasses[effectIndex]);

    if (effect) {
        effect.style.display = status ? 'block' : 'none';
        effect.classList.toggle('show-effect', status);
    }
}

function launchSkillEffect(data) {
    const currentUser = document.querySelector('.image-container.current-user');
    const targetUser = document.querySelector(`.image-container[data-user-id="${data.userId}"]`);
    if (!currentUser || !targetUser) return;

    const startRect = currentUser.getBoundingClientRect();
    const endRect = targetUser.getBoundingClientRect();

    const startX = startRect.left + startRect.width / 2;
    const startY = startRect.top + startRect.height / 2;
    const endX = endRect.left + endRect.width / 2;
    const endY = endRect.top + endRect.height / 2;

    const dx = endX - startX;
    const dy = endY - startY;
    const angle = Math.atan2(dy, dx) * 180 / Math.PI;
    const distance = Math.hypot(dx, dy);
    const direction = targetUser.offsetLeft < currentUser.offsetLeft ? 'left' : 'right';

    const skill = document.createElement('img');
    skill.style.position = 'fixed';
    skill.style.zIndex = '10000';
    skill.style.pointerEvents = 'none';
    skill.style.transition = 'transform 1.2s linear';
    skill.style.transformOrigin = 'left center';

    if (data.skillType === 'set') {
    skill.src = 'image/skill/skill4_right.gif';
    skill.style.left = `${startX}px`;
    skill.style.top = `${startY}px`;
    skill.style.width = `${distance}px`;
    skill.style.height = '40px';
    skill.style.transform = `rotate(${angle}deg)`;
} else {
    // Chọn ảnh theo hướng
    if (data.skillType === 'kiem') {
        skill.src = direction === 'left' ? 'image/skill/skill8_right.gif' : 'image/skill/skill8_right.gif';
    } else if (data.skillType === 'namdam') {
        skill.src = direction === 'left' ? 'image/skill/skill6.gif' : 'image/skill/skill6.gif'; // Gợi ý nếu bạn có cả 2 ảnh
    }

    skill.style.left = `${startX - 50}px`;
    skill.style.top = `${startY - 50}px`;
    skill.style.width = '200px';
    skill.style.height = '100px';
    skill.style.transform = `rotate(${angle}deg)`;

    setTimeout(() => {
        skill.style.transform = `rotate(${angle}deg) translateX(${distance}px)`;
    }, 10);
}

    document.body.appendChild(skill);
    setTimeout(() => skill.remove(), 1300);
}

// Gán sự kiện click vào mỗi user để mở icon
document.querySelectorAll('.image-container').forEach(container => {
    const effectIcon = container.querySelector('.effect-icon');
    if (effectIcon) {
        effectIcon.addEventListener('click', e => {
            e.stopPropagation();
            const effectImg = container.querySelector('.effect-image');
            if (!effectImg) return;
            const isVisible = effectImg.style.display === 'block';
            effectImg.style.display = isVisible ? 'none' : 'block';
            effectImg.classList.toggle('show-rise', !isVisible);
        });
    }
    document.querySelectorAll('.image-container').forEach(container => {
    const effectIcon = container.querySelector('.effect-icon');
    const userId = container.getAttribute('data-user-id');

    if (effectIcon) {
        let effectState = 0; // 0: effect, 1: effect1, 2: effect2, 3: effect3

        effectIcon.addEventListener('click', e => {
            e.stopPropagation();

            const effects = [
                container.querySelector('.effect-image'),
                container.querySelector('.effect-image1'),
                container.querySelector('.effect-image2'),
                container.querySelector('.effect-image3')
            ];

            // Tắt tất cả hiệu ứng
            effects.forEach(effect => {
                if (effect) effect.style.display = 'none';
            });

            // Xác định hiệu ứng hiện tại
            const currentEffect = effects[effectState];

            if (currentEffect) {
                // Kiểm tra trạng thái hiển thị
                const isVisible = currentEffect.style.display === 'block';

                // Cập nhật hiển thị
                currentEffect.style.display = isVisible ? 'none' : 'block';

                // Gửi AJAX để cập nhật trạng thái
                const formData = new FormData();
                formData.append('user_id', userId);
                formData.append('effect_index', effectState);
                formData.append('status', isVisible ? 0 : 1);

                fetch('update_status_effect.php', {
                    method: 'POST',
                    body: formData
                });
                socket.send(JSON.stringify({
    type: 'effect',
    userId: userId,
    effectIndex: effectState,
    status: !isVisible // true = hiển thị, false = ẩn
}));

            }

            // Chuyển sang trạng thái tiếp theo
            effectState = (effectState + 1) % 4;
        });
    }
});


    container.addEventListener('click', function (e) {
        if (['effect-icon', 'namdam-icon'].some(cls => e.target.classList.contains(cls))) return;
        document.querySelectorAll('.icon-container').forEach(ic => ic.style.display = 'none');
        const iconContainer = this.querySelector('.icon-container');
        if (iconContainer) iconContainer.style.display = 'block';
        e.stopPropagation();
    });

    const setIcon = container.querySelector('.set-icon');
    const kiemIcon = container.querySelector('.kiem-icon');
    const namdamIcon = container.querySelector('.namdam-icon');

    function sendAttack(skillType) {
        const userId = container.getAttribute('data-user-id');
        socket.send(JSON.stringify({ type: 'attack', userId, skillType }));
        launchSkillEffect({ userId, skillType });
    }

    if (setIcon) setIcon.addEventListener('click', e => { e.stopPropagation(); sendAttack('set'); });
    if (kiemIcon) kiemIcon.addEventListener('click', e => { e.stopPropagation(); sendAttack('kiem'); });
    if (namdamIcon) namdamIcon.addEventListener('click', e => { e.stopPropagation(); sendAttack('namdam'); });
});

document.addEventListener('click', () => {
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
    .skill-attack {
    position: fixed;
    z-index: 10000;
    pointer-events: none;
}

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

.effect-image.show-rise{
    animation: fadeUp 1s ease-out forwards;
}

</style>

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
  background-image: url('image/nen/alfea.webp');
  background-size: 105%;
  background-position: center;
  position: relative;
  overflow: hidden;
  /* overflow-y: scroll; /* hoặc auto */

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

</html>

<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
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

$user_id = $_SESSION['user_id'];

$image1 = '';
$image2 = '';
$image3 = '';
$image4 = '';

// Lấy outfit từ user_id
$sql = "SELECT * FROM outfits WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
if ($row = $result->fetch_assoc()) {
  $image1 = $row['image1'];
  $image2 = $row['image2'];
  $image3 = $row['image3'];
  $image4 = $row['image4'];
}
$stmt->close();
$conn->close();
?>



<!DOCTYPE html>
<html lang="vi">
<head>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="icon" type="image/png" href="no.gif">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playwrite+US+Trad:wght@100..400&display=swap" rel="stylesheet">
  <meta charset="UTF-8">
  <title>Flora-Win</title>
  <style>
       /* Căn giữa toàn bộ trang */
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

.content {
  position: relative;
  z-index: 1;
  color: white;
  text-align: center;
}


    /* Khối nội dung chính */
    main {
      height: calc(100vh - 130px); /* trừ header và nav */
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .container {
      position: relative;
      width: 400px;
      height: 400px;
    }


    .image-container {
      left: 100px;
      top: 120px;
      position: fixed;
      width: 400px; /* chiều rộng ảnh */
      height: 400px; /* chiều cao ảnh */
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
  display: none;
}



.image1, .image3 {
  display: block;
}

.image1, .image2 {
  width: 100%;
  height: 100%;
  z-index: 6; /* Nhân vật */
}

.image3, .image4 {
  width: 100%;
  height: 100%;
  transform: scale(1.1); /* Phóng to nhưng không làm ảnh bị cắt */
  margin-top: -0%;
  z-index: 5; /* Nhân vật */

}


.star-layer {
  position: absolute;
  width: 100%;
  height: 100%;
  pointer-events: none;
  overflow: hidden;
  z-index: 3; /* Đảm bảo chồng lên tất cả ảnh */
}


@keyframes twinkle {
  0%, 100% { opacity: 0.2; }
  50% { opacity: 0.6; }
}


      /* Lớp sao rơi */
      .star-layer {
      position: absolute;
      width: 100%;
      height: 80%;
      pointer-events: none;
      overflow: hidden;
    }

    .star {
      position: absolute;
      width: 2px;
      height: 2px;
      background: white;
      border-radius: 50%;
      color: yellow;
      animation: twinkle 1s infinite alternate, fall 3s linear infinite;
    }

    @keyframes twinkle {
      0% { opacity: 0.2; transform: scale(1); }
      100% { opacity: 1; transform: scale(1.5); }
    }

    @keyframes fall {
      0% {
        transform: translateY(-10px) translateX(0);
      }
      100% {
        transform: translateY(400px) translateX(20px);
      }
    }





    /* tủ */
    .wing-cabinet {

  margin-top: 150px;
  top: -12%;
  right: -80px;
  position: relative;
  width: 500px;
  background-color: rgba(255, 192, 203, 0.2);
  padding: 20px;
  border-radius: 20px;
  box-shadow: 0 0 15px rgba(255, 182, 193, 0.6);
  z-index: 999;
  backdrop-filter: blur(6px);
   /* overflow-y: scroll; /* hoặc auto */
}

.cabinet-title {
  margin-top: -10px;
  text-align: center;
  font-family: 'Great Vibes', cursive;
  font-size: 28px;
  color: #fff;
  margin-bottom: 15px;
  text-shadow: 0 0 5px rgba(255,255,255,0.8);
}
.cabinet-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr); /* 3 cột dọc */
  grid-template-rows: repeat(2, 1fr); /* 2 hàng ngang */
  gap: 10px;
}


.cabinet-box {
  width: 100px;
  height: 100px;
  background-color: rgba(255, 182, 193, 0.3);
  border-radius: 15px;
  padding: 5px; /* tạo khoảng cách giữa ảnh và viền */
  box-sizing: border-box;
  display: flex;
  align-items: center;
  justify-content: center;
  overflow: hidden;
  transition: transform 0.3s, box-shadow 0.3s;
  cursor: pointer;
}

.cabinet-box img {
  width: 100%;
  height: 100%;
  object-fit: cover;
  border-radius: 10px;
}

.cabinet-box:hover {
  transform: scale(1.05);
  box-shadow: 0 0 10px rgba(255,182,193,0.6);
}

.star {
  color: yellow;
}


@keyframes moveInCircle {
  0% {
    transform: rotate(0deg) translateX(0.55cm) rotate(0deg);
  }
  25% {
    transform: rotate(90deg) translateX(0.55cm) rotate(-90deg);
  }
  50% {
    transform: rotate(180deg) translateX(0.55cm) rotate(-180deg);
  }
  75% {
    transform: rotate(270deg) translateX(0.55cm) rotate(-270deg);
  }
  100% {
    transform: rotate(360deg) translateX(0.5cm) rotate(-360deg);
  }
}


  </style>

</head>
<body>
<video autoplay muted loop id="background-video">
    <source src="image/nen/nenweb.mp4" type="video/mp4">
    Your browser does not support HTML5 video.
  </video>

  <!-- Nội dung trang web ở đây -->
  <div class="content">



<main>
<div class="container">
    <div class="image-container">
  
            <img src="<?php echo htmlspecialchars($image1); ?>" alt="User đứng yên" class="image1">
 
            <img src="<?php echo htmlspecialchars($image2); ?>" alt="User đập cánh" class="image2">
 
            <img src="<?php echo htmlspecialchars($image3); ?>" alt="Cánh đứng yên" class="image3">
  
            <img src="<?php echo htmlspecialchars($image4); ?>" alt="Cánh đập" class="image4">
      
        <div class="star-layer" id="stars"></div>
    </div>
</div>

      
      <!-- Tủ cánh -->
      <div class="wing-cabinet">
        <h2 class="cabinet-title">Wing Style</h2>
        <div class="cabinet-grid">
          <div class="cabinet-box" data-wing-static="image/canh/win1.png" data-wing-fly="image/canh/win11.png"><img src="image/canh/win1.png" alt="Cánh 1"></div>
          <div class="cabinet-box" data-wing-static="image/canh/win3_bloomix.png" data-wing-fly="image/canh/win33.png"><img src="image/canh/win3_bloomix.png" alt="Cánh 2"></div>
          <div class="cabinet-box" data-wing-static="image/canh/win4.png" data-wing-fly="image/canh/win44.png"><img src="image/canh/win4.png" alt="Cánh 3"></div>
          <div class="cabinet-box" data-wing-static="image/canh/win5.png" data-wing-fly="image/canh/win55.png"><img src="image/canh/win5.png" alt="Cánh 4"></div>
          <div class="cabinet-box" data-wing-static="image/canh/win6.png" data-wing-fly="image/canh/win66.png"><img src="image/canh/win6.png" alt="Cánh 5"></div>
          <div class="cabinet-box" data-wing-static="image/canh/win8.png" data-wing-fly="image/canh/win88.png"><img src="image/canh/win8.png" alt="Cánh 6"></div>
          <div class="cabinet-box" data-wing-static="image/canh/win7.png" data-wing-fly="image/canh/win77.png"><img src="image/canh/win7.png" alt="Cánh 7"></div>
          <div class="cabinet-box" data-wing-static="image/canh/win9.png" data-wing-fly="image/canh/win99.png"><img src="image/canh/win9.png" alt="Cánh 8"></div>
          <div class="cabinet-box" data-wing-static="image/canh/win10.png" data-wing-fly="image/canh/win1010.png"><img src="image/canh/win10.png" alt="Cánh 9"></div>
          <div class="cabinet-box" data-wing-static="image/canh/win12.png" data-wing-fly="image/canh/win1212.png"><img src="image/canh/win12.png" alt="Cánh 8"></div>
          <div class="cabinet-box" data-wing-static="image/canh/win13.png" data-wing-fly="image/canh/win1313.png"><img src="image/canh/win13.png" alt="Cánh 8"></div>
          <div class="cabinet-box" data-wing-static="image/canh/win14.png" data-wing-fly="image/canh/win1414.png"><img src="image/canh/win14.png" alt="Cánh 8"></div>
          <div class="cabinet-box" data-wing-static="image/canh/win15.png" data-wing-fly="image/canh/win1515.png"><img src="image/canh/win15.png" alt="Cánh 8"></div>
      
<!-- <div class="cabinet-box" data-wing-static="canhtrong.png" data-wing-fly="canhtrong.png"><img src="canhtrong.png" alt="Cánh 8"></div>-->
        </div>
      </div>
      
  
  
</main>
<script>
    let isStatic = true;
    
    setInterval(() => {
      isStatic = !isStatic;
      document.querySelector('.image1').style.display = isStatic ? 'block' : 'none';
      document.querySelector('.image2').style.display = isStatic ? 'none' : 'block';
      document.querySelector('.image3').style.display = isStatic ? 'block' : 'none';
      document.querySelector('.image4').style.display = isStatic ? 'none' : 'block';
    }, 200);
    
    document.querySelectorAll('.cabinet-box').forEach(box => {
  box.addEventListener('click', () => {
    const wingStatic = box.getAttribute('data-wing-static');
    const wingFly = box.getAttribute('data-wing-fly');
    
    document.querySelector('.image4').src = wingStatic;
    document.querySelector('.image3').src = wingFly;

    // Gửi dữ liệu về PHP để lưu
    fetch('save_outfit.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
      },
      body: `image4=${encodeURIComponent(wingStatic)}&image3=${encodeURIComponent(wingFly)}`
    });
  });
});



    </script>
    <script>
        const starLayer = document.getElementById('stars');
      
        function createStar() {
          const star = document.createElement('div');
          star.classList.add('star');
          star.style.left = Math.random() * 100 + '%';
          star.style.top = -10 + 'px'; // bắt đầu từ trên
          starLayer.appendChild(star);
      
          setTimeout(() => {
            star.remove();
          }, 3000); // trùng với thời gian rơi (fall 3s)
        }
      
        setInterval(createStar, 100); // tạo sao liên tục
      </script>


</div>      
</body>
</html>

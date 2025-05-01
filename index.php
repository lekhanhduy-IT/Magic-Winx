<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
       /* Căn giữa toàn bộ trang */
   * {
      box-sizing: border-box;
    }
    body {
  margin: 0;
  height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  background-image: url('floranen2.webp');
  background-size: 100%;
  background-position: center;
  position: relative;
  overflow: hidden;
  /* overflow-y: scroll; /* hoặc auto */

}

body::before {
  content: "";
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.4); /* 👈 màu đen, mờ 40% */
  z-index: -1; /* nằm dưới nội dung */
}

iframe {
    border: none;
}
    
    header {
  background: linear-gradient(to right, #4b6bb700, #18284800);
  padding: 20px 40px;
  text-align: right;  /* căn phải toàn bộ nội dung */
  font-size: 24px;
  position: fixed;
  top: 0;
  width: 100%;
  z-index: 999;
  font-weight: bold;
}

header a {
  display: inline-block;
  width: 40px;
  height: 40px;
  margin-left: 20px;
  background-size: cover;
  background-position: center;
  transition: transform 0.3s;
}

/* Biểu tượng riêng cho từng a */
.icon-home {
  background-image: url('home.png');
}

.icon-about {
  background-image: url('about.webp');
}

.icon-contact {
  background-image: url('contract.png');
}

.icon-logout {
  background-image: url('logout.png.png');
}
/* Hiệu ứng hover */
header a:hover {
  transform: scale(1.1);
}


    nav {
      background-color: #22222200;
      display: flex;
      justify-content: center;
      padding: 10px 0;
      gap: 30px;
    }

    nav a {
      color: white;
      text-decoration: none;
      font-size: 18px;
      transition: color 0.3s;
    }

    nav a:hover {
      color: #00ffff;
    }
    .pinkbtn {
    background-image: url('buttongo.png');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat; /* thêm dòng này */
    background-color: transparent; /* đảm bảo */
    font-family: "Playwrite US Trad", cursive;
    padding: 12px 28px;
    border-radius: 50px;
    border: none;
    color: brown;
    width: 100px;
    position: fixed;
    top: 20px;
    left: 20px;
    z-index: 1000;
    outline: none; /* thêm nếu cần bỏ viền xanh */
}

/* Dropdown giả */
.custom-dropdown {
  position: relative;
  display: inline-block;
  cursor: pointer;
  font-size: 16px;
  font-weight: bold;
  user-select: none;
  margin-left: 20px;
  font-family:arial;
}

.dropdown-selected {
  width: 40px;
  height: 40px;
  background-image: url('about.webp');
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  border-radius: 50%; /* làm tròn nếu muốn giống mấy nút kia, bỏ nếu muốn vuông */
  cursor: pointer;
  border: none; /* bỏ viền */
}


.dropdown-list {
  position: absolute;
  top: 110%;
  left: 0;
  background: rgba(255,255,255,0.95);
  border-radius: 10px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.2);
  display: none;
  z-index: 10000;
  min-width: 200px;
}

.dropdown-item {
  display: flex;
  align-items: center;
  padding: 10px;
  gap: 10px;
  transition: background 0.3s;
  border-bottom: 1px solid #ddd;
}

.dropdown-item img {
  width: 40px;
  height: 40px;
  object-fit: cover;
  border-radius: 8px;
}

.dropdown-item span {
  flex: 1;
}

.dropdown-item:hover {
  background: #f0f0f0;
}

</style>
<body>
<header>
  <button class="pinkbtn">Musa</button>

  <a href="home.php" class="icon-home" title="Trang chủ"></a>

  <!-- Dropdown custom -->
  <div class="custom-dropdown">
    <div class="dropdown-selected"></div>
    <div class="dropdown-list">
      <div class="dropdown-item" data-url="alfea.php">
        <img src="alfea.webp" alt="Trường học">
        <span>Trường học</span>
      </div>
      <div class="dropdown-item" data-url="night_town.php">
        <img src="town.jpg" alt="Thị trấn đường">
        <span>Thị trấn đường</span>
      </div>
      <div class="dropdown-item" data-url="love_stree.php">
        <img src="caytree.jpg" alt="Cây sự ssống">
        <span>Cây sự sống</span>
      </div>
      <div class="dropdown-item" data-url="ngoai_o.php">
        <img src="duongdat.jpg" alt="Ngoại ô">
        <span>Ngoại ô</span>
      </div>
      <div class="dropdown-item" data-url="dothi.php">
        <img src="dothi.jpg" alt="Đô thị">
        <span>Đô thị</span>
      </div>
    </div>
  </div>

  <a href="contact.html" class="icon-contact" title="Liên hệ"></a>
  <a href="logout.php" class="icon-logout"></a>
</header>

<iframe id="mainFrame" width="100%" height="600px"></iframe>

</body>
<script>
document.addEventListener('DOMContentLoaded', function () {
  const links = document.querySelectorAll('header a');
  const iframe = document.getElementById('mainFrame');
  const dropdownSelected = document.querySelector('.dropdown-selected');
  const dropdownList = document.querySelector('.dropdown-list');
  const dropdownItems = document.querySelectorAll('.dropdown-item');

  // Gán src mặc định
  iframe.setAttribute('src', 'home.php');

  // Click icon header => đổi iframe
  links.forEach(link => {
    link.addEventListener('click', function (e) {
      e.preventDefault();
      const url = this.getAttribute('href');
      iframe.setAttribute('src', url);
    });
  });

  // Click dropdown-selected để mở/đóng danh sách
  dropdownSelected.addEventListener('click', function () {
    dropdownList.style.display = dropdownList.style.display === 'block' ? 'none' : 'block';
  });

  // Click vào item trong dropdown
  dropdownItems.forEach(item => {
    item.addEventListener('click', function () {
      const url = this.getAttribute('data-url');
      iframe.setAttribute('src', url);
      dropdownList.style.display = 'none'; // tự đóng dropdown
    });
  });

  // Click ra ngoài dropdown thì đóng lại
  document.addEventListener('click', function (e) {
    if (!e.target.closest('.custom-dropdown')) {
      dropdownList.style.display = 'none';
    }
  });
});

</script>


</html>
-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2024 at 11:21 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quanlytra`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mat_khau` varchar(255) NOT NULL,
  `trang_thai` tinyint(1) DEFAULT 0,
  `hinhanh` varchar(255) DEFAULT 'user.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `email`, `mat_khau`, `trang_thai`, `hinhanh`) VALUES
(1, 'along@gmail.com', '202cb962ac59075b964b07152d234b70', 1, 'user.png');

-- --------------------------------------------------------

--
-- Table structure for table `chitietdonhang`
--

CREATE TABLE `chitietdonhang` (
  `machitietdonhang` int(11) NOT NULL,
  `madonhang` int(11) DEFAULT NULL,
  `masanpham` int(11) DEFAULT NULL,
  `hinhanh1` varchar(255) DEFAULT NULL,
  `tensanpham` varchar(255) DEFAULT NULL,
  `soluong` int(11) DEFAULT NULL,
  `tongtien` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chitietdonhang`
--

INSERT INTO `chitietdonhang` (`machitietdonhang`, `madonhang`, `masanpham`, `hinhanh1`, `tensanpham`, `soluong`, `tongtien`) VALUES
(13, 10, 9, 'traxanh.webp', 'Trà Xanh', 1, 130000.00),
(14, 10, 14, 'traoat.jpg', 'Trà Oải Hương', 1, 80000.00),
(15, 11, 12, 'xanh1.jpg', 'Trà Xanh', 4, 360000.00),
(16, 12, 12, 'xanh1.jpg', 'Trà Xanh', 4, 360000.00),
(17, 13, 9, 'traxanh.webp', 'Trà Xanh', 2, 260000.00),
(18, 13, 10, 'trakho.png', 'Trà Khô', 1, 80000.00),
(19, 14, 9, 'traxanh.webp', 'Trà Xanh', 1, 130000.00),
(20, 14, 11, 'trahoa.jpg', 'Trà Hoa', 2, 260000.00),
(23, 16, 9, 'traxanh.webp', 'Trà Xanh', 1, 130000.00),
(24, 17, 11, 'trahoa.jpg', 'Trà Hoa', 1, 130000.00),
(25, 17, 9, 'traxanh.webp', 'Trà Xanh', 17, 2210000.00),
(26, 18, 3, 'long.png', 'Trà Ô Long', 1, 0.00),
(27, 18, 11, 'trahoa.jpg', 'Trà Hoa', 2, 260000.00),
(28, 18, 7, 'olong.jpeg', 'Trà Ô Long', 1, 90000.00),
(29, 18, 13, 'lai.jpg', 'Trà Lài', 1, 120000.00),
(30, 18, 2, 'den.png', 'Trà Đen', 2, 0.00),
(31, 19, 10, 'trakho.png', 'Trà Khô', 2, 160000.00),
(32, 19, 11, 'trahoa.jpg', 'Trà Hoa', 1, 130000.00),
(33, 19, 12, 'xanh1.jpg', 'Trà Xanh', 1, 100000.00),
(34, 19, 1, 'xanh.png', 'Trà Xanh', 2, 0.00),
(35, 19, 2, 'den.png', 'Trà Đen', 4, 0.00),
(36, 20, 9, 'traxanh.webp', 'Trà Xanh', 1, 130000.00),
(37, 20, 11, 'trahoa.jpg', 'Trà Hoa', 1, 130000.00),
(38, 21, 13, 'lai.jpg', 'Trà Lài', 1, 120000.00),
(39, 21, 14, 'traoat.jpg', 'Trà Oải Hương', 1, 70000.00),
(40, 22, 11, 'trahoa.jpg', 'Trà Hoa', 1, 130000.00),
(41, 22, 12, 'xanh1.jpg', 'Trà Xanh', 2, 200000.00),
(42, 22, 10, 'trakho.png', 'Trà Khô', 1, 80000.00),
(43, 22, 7, 'olong.jpeg', 'Trà Ô Long', 1, 90000.00),
(44, 23, 13, 'lai.jpg', 'Trà Lài', 1, 120000.00),
(45, 23, 7, 'olong.jpeg', 'Trà Ô Long', 2, 180000.00),
(46, 23, 9, 'traxanh.webp', 'Trà Xanh', 1, 130000.00),
(47, 24, 7, 'olong.jpeg', 'Trà Ô Long', 1, 90000.00),
(48, 25, 12, 'xanh1.jpg', 'Trà Xanh', 1, 100000.00),
(49, 26, 7, 'olong.jpeg', 'Trà Ô Long', 7, 630000.00),
(50, 26, 11, 'trahoa.jpg', 'Trà Hoa', 2, 260000.00),
(51, 27, 9, 'traxanh.webp', 'Trà Xanh', 1, 130000.00),
(52, 27, 7, 'olong.jpeg', 'Trà Ô Long', 1, 90000.00),
(53, 28, 12, 'xanh1.jpg', 'Trà Xanh', 1, 100000.00);

-- --------------------------------------------------------

--
-- Table structure for table `danhgia`
--

CREATE TABLE `danhgia` (
  `id` int(11) NOT NULL,
  `madonhang` int(11) NOT NULL,
  `makhachhang` int(11) NOT NULL,
  `noidung` text DEFAULT NULL,
  `sosao` int(11) DEFAULT NULL,
  `hinhanh` varchar(255) DEFAULT NULL,
  `ngaygui` datetime DEFAULT current_timestamp(),
  `masanpham` int(11) NOT NULL,
  `trangthai` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `danhgia`
--

INSERT INTO `danhgia` (`id`, `madonhang`, `makhachhang`, `noidung`, `sosao`, `hinhanh`, `ngaygui`, `masanpham`, `trangthai`) VALUES
(57, 19, 6, 'rà thơm ngon như một bản giao hưởng của hương vị, với từng giọt trà mang đến sự thanh mát, dễ chịu. Mỗi lần thưởng thức đều là một trải nghiệm tuyệt vời', 4, '65fb969c-1ae7-44ae-bcbc-e7a7f06b0dbf (1).webp', '2024-10-21 00:08:32', 10, 1),
(58, 19, 6, 'Hương trà nhẹ nhàng 😘, êm dịu như làn gió mùa xuân, khiến tâm hồn tôi như được lấp đầy bằng niềm vui và sự bình yên. Trà này thực sự là một báu vật của thiên nhiên.', 3, '670f2e6125b23_Tea-Ceremony.webp', '2024-10-21 00:09:49', 11, 1),
(59, 23, 7, 'Mỗi tách trà là một câu chuyện, một hành trình khám phá hương vị phong phú và sâu lắng. Trà ngon không chỉ là thức uống mà còn là một phần của nghệ thuật sống.', 4, '670f2edbbf013_DALL·E 2024-10-13 21.55.58 - A vast green tea hill with neatly arranged rows of tea plants extending into the distance. The hill is lush and vibrant with a variety of shades of gr.webp', '2024-10-21 00:15:41', 9, 1),
(74, 23, 7, 'Hương thơm nồng nàn của trà lan tỏa khắp không gian, khiến tôi như lạc vào một thế giới đầy màu sắc và hương vị. Trà ngon như vậy thực sự là một trải nghiệm không thể quên.', 4, 'AdobeStock_652791063_Preview.jpeg', '2024-10-21 01:47:05', 7, 1),
(75, 23, 7, 'Trà ngon mang đến cảm giác thư giãn tuyệt đối, giống như một làn sóng êm đềm cuốn đi mọi lo âu. Tôi rất thích nhâm nhi từng ngụm trà trong những lúc rảnh rỗi.', 4, '670f36efbff37_8700359b-3078-40e3-92cc-56d3de41adf9.webp', '2024-10-21 01:47:39', 7, 1),
(76, 19, 6, 'xinh đẹp tuyệt vời 😘😘', 4, '1000025514.png', '2024-10-21 04:42:50', 1, 0),
(77, 23, 7, 'hh', 5, 'donhang.jpg', '2024-10-21 13:53:59', 9, 0),
(80, 16, 10, 'ngon lắm', 4, 'tea13.png', '2024-10-24 01:54:30', 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `donhang`
--

CREATE TABLE `donhang` (
  `madonhang` int(11) NOT NULL,
  `makhachhang` int(11) DEFAULT NULL,
  `tongtien` decimal(10,2) DEFAULT NULL,
  `ngaytao` datetime DEFAULT NULL,
  `tinhtrang` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `donhang`
--

INSERT INTO `donhang` (`madonhang`, `makhachhang`, `tongtien`, `ngaytao`, `tinhtrang`) VALUES
(10, 6, NULL, '2024-10-16 17:47:17', NULL),
(11, 6, 360000.00, '2024-10-16 17:56:32', 'Đang xử lý'),
(12, 6, 360000.00, '2024-10-16 23:02:10', 'Người bán đã bàn giao đơn hàng cho đơn vị vận chuyển'),
(13, 6, NULL, '2024-10-16 19:21:07', 'Đang xử lý'),
(14, 6, 390000.00, '2024-10-16 19:21:53', 'Đang chuẩn bị hàng'),
(16, 10, 130000.00, '2024-10-16 19:43:12', 'Giao hàng thành công'),
(17, 6, 2340000.00, '2024-10-20 03:47:46', 'Giao hàng thành công'),
(18, 6, 470000.00, '2024-10-18 08:25:30', 'Đang chuẩn bị hàng'),
(19, 6, 390000.00, '2024-10-18 22:19:45', 'Giao hàng thành công'),
(20, 2, 260000.00, '2024-10-18 19:30:53', 'Đang xử lý'),
(21, 2, 190000.00, '2024-10-19 00:35:01', 'Đang xử lý'),
(22, 5, 500000.00, '2024-10-19 00:38:31', 'Đang giao hàng'),
(23, 7, 430000.00, '2024-10-21 00:13:50', 'Giao hàng thành công'),
(24, 7, 90000.00, '2024-10-21 13:11:54', 'Giao hàng thành công'),
(25, 6, 100000.00, '2024-10-22 00:03:04', 'Đang chuẩn bị hàng'),
(26, 6, 890000.00, '2024-10-22 00:04:32', 'Đang xử lý'),
(27, 6, 220000.00, '2024-10-22 00:09:01', 'Đang xử lý'),
(28, 6, 100000.00, '2024-10-22 00:10:04', 'Đang xử lý');

-- --------------------------------------------------------

--
-- Table structure for table `khachhang`
--

CREATE TABLE `khachhang` (
  `makhachhang` int(11) NOT NULL,
  `tenkhachhang` varchar(200) NOT NULL,
  `email` varchar(100) NOT NULL,
  `diachi` varchar(200) NOT NULL,
  `matkhau` varchar(100) NOT NULL,
  `dienthoai` varchar(20) NOT NULL,
  `avatar` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `khachhang`
--

INSERT INTO `khachhang` (`makhachhang`, `tenkhachhang`, `email`, `diachi`, `matkhau`, `dienthoai`, `avatar`) VALUES
(1, 'Lê Khánh Duy', 'lk@gmail.com', 'ấp, xã, huyện, tỉnh', '81dc9bdb52d04dc20036dbd8313ed055', '0848114595', 'uploads/67127e5a07456_pngegg.png'),
(2, 'Ngô Quốc Toàn', 'qt@gmail.com', 'ấp, xã, huyện, tỉnh', '81dc9bdb52d04dc20036dbd8313ed055', '0848114595', 'uploads/67127efac7f09_a painting of two lotus flowers and a dragonfly.jpg'),
(3, 'Trần Văn Tân', 'tvt@gmail.com', 'ấp, xã, huyện, tỉnh', '81dc9bdb52d04dc20036dbd8313ed055', '0123334556', 'uploads/67127ebf4cecb_pngegg.png'),
(4, 'Khánh Duy Lê', 'kd@gmail.com', 'ấp, xã, huyện, tĩnh', '81dc9bdb52d04dc20036dbd8313ed055', '0848114595', 'uploads/671280932b326_Ảnh chụp màn hình 2024-10-02 111123.png'),
(5, 'Lê Khánh Duy', 'duy@gmail.com', 'ấp, xã, huyện, tỉnh', '202cb962ac59075b964b07152d234b70', '0848114595', 'uploads/671281bfc1d22_tavolo-da-conferenza-in-vetro-in-un-ufficio-moderno-con-vista-sulla-citta.jpg'),
(6, 'Lê Nguyễn Gia Bảo ', 'bao@gmail.com', 'cái nước cà thơi xzy', '202cb962ac59075b964b07152d234b70', '848114595', 'uploads/67122d2183e31_z5891382426718_f0d31ed25e90827ed236f21a4df1036c.jpg'),
(7, 'Bảo Anh', 'baoanh@gmail.com', 'ấp, xẫ, huyện , tĩnh', '202cb962ac59075b964b07152d234b70', '0123334556', 'uploads/67128218a3bb0_293787541_1080201329579969_589920233816780080_n.jpg'),
(9, 'Trần Huỳnh Như', 'nhu@gmail.com', 'ấp, xẫ, huyện , tĩnh', '202cb962ac59075b964b07152d234b70', '0123334556', 'uploads/6712837ae2b11_8700359b-3078-40e3-92cc-56d3de41adf9.jpg'),
(10, 'Lục Cẩm Nghi', 'nghi@gmail.com', 'ấp, xẫ, huyện , tĩnh', '202cb962ac59075b964b07152d234b70', '0123334556', 'uploads/6710055df0917_gif (1).gif'),
(11, 'Toàn', 'toan@gmail.com', 'cái nước cà thơi', '202cb962ac59075b964b07152d234b70', '123334556', 'uploads/67129f2f73287_pngwing.com (1).png'),
(12, 'Lê Khánh Duy', 'duykhanh@gmail.com', 'cái nước cà mau', '202cb962ac59075b964b07152d234b70', '848114595', 'uploads/6718f0c1c4d08_tea8.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `loaisanpham`
--

CREATE TABLE `loaisanpham` (
  `maloai` int(11) NOT NULL,
  `tenloai` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `loaisanpham`
--

INSERT INTO `loaisanpham` (`maloai`, `tenloai`) VALUES
(1, 'Trà hạ tiểu đường'),
(3, 'Trà hạ hỏa'),
(5, 'Trà túi lọc');

-- --------------------------------------------------------

--
-- Table structure for table `sanpham`
--

CREATE TABLE `sanpham` (
  `masanpham` int(11) NOT NULL,
  `tensanpham` varchar(255) NOT NULL,
  `tenloai` varchar(100) DEFAULT NULL,
  `maloai` int(11) DEFAULT NULL,
  `gia` decimal(10,2) NOT NULL,
  `trongluong` decimal(5,2) NOT NULL,
  `soluong` int(11) NOT NULL,
  `hinhanh1` varchar(255) DEFAULT NULL,
  `hinhanh2` varchar(255) DEFAULT NULL,
  `hinhanh3` varchar(255) DEFAULT NULL,
  `mota1` text DEFAULT NULL,
  `mota2` text DEFAULT NULL,
  `mota3` text DEFAULT NULL,
  `mota4` text DEFAULT NULL,
  `motachitiet` text DEFAULT NULL,
  `luotmua` int(11) DEFAULT 0,
  `trangthai` tinyint(1) DEFAULT 1,
  `ghim` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sanpham`
--

INSERT INTO `sanpham` (`masanpham`, `tensanpham`, `tenloai`, `maloai`, `gia`, `trongluong`, `soluong`, `hinhanh1`, `hinhanh2`, `hinhanh3`, `mota1`, `mota2`, `mota3`, `mota4`, `motachitiet`, `luotmua`, `trangthai`, `ghim`) VALUES
(1, 'Trà Xanh', 'Trà hạ tiểu đường', 1, 0.00, 500.00, 8, 'xanh.png', 'DALL·E 2024-10-13 22.06.05 - A vast, lush green tea hill with rolling terraces under a bright sky. On the top right corner of the image, there is a small tea set with a delicate t.png', 'AdobeStock_652791063_Preview.jpeg', 'Giúp giảm cholesterol và cải thiện chức năng tim mạch.', NULL, NULL, NULL, 'Trà xanh có nhiều lợi ích cho sức khỏe, giúp giảm cân, cải thiện chức năng tim mạch và tăng cường năng lượng. Ngoài ra, trà xanh cũng chứa nhiều chất chống oxi hóa giúp bảo vệ cơ thể khỏi các tác nhân gây hại.', 2, 0, 1),
(2, 'Trà Đen', 'Trà hạ tiểu đường', 1, 0.00, 0.00, 94, 'den.png', '', '', 'Tăng cường hệ miễn dịch và hỗ trợ kiểm soát đường huyết.', NULL, NULL, NULL, 'Trà đen giúp tăng cường hệ miễn dịch và hỗ trợ tiêu hóa. Với hương vị đậm đà, trà đen là lựa chọn tuyệt vời cho những ai yêu thích vị trà mạnh mẽ.', 6, 0, 1),
(3, 'Trà Ô Long', 'Trà hạ tiểu đường', 1, 0.00, 0.00, 90, 'long.png', '', '', 'Giúp tiêu hóa tốt hơn và hỗ trợ giảm cân hiệu quả.', NULL, NULL, NULL, 'Trà ô long là sự kết hợp hoàn hảo giữa trà xanh và trà đen, giúp hỗ trợ quá trình giảm cân và cải thiện sức khỏe tim mạch. Trà ô long cũng nổi tiếng với khả năng làm đẹp da.', 1, 0, 1),
(4, 'Trà Sen', 'Trà', 1, 120.00, 500.00, 200, 'long.png', 'web.jpg', '', 'Giúp tiêu hóa tốt hơn và hỗ trợ giảm cân hiệu quả.', NULL, NULL, NULL, 'Trà sen có hương vị nhẹ nhàng, giúp thư giãn và giảm căng thẳng. Trà sen còn được biết đến với tác dụng thanh nhiệt và giải độc, rất thích hợp cho những ngày hè.', 0, 0, 1),
(5, 'Trà Bưởi', 'Trà', 1, 0.00, 0.00, 0, 'xanh.png', '', '', 'Giúp giảm cholesterol và cải thiện chức năng tim mạch.', NULL, NULL, NULL, 'Trà bưởi có hương thơm tươi mát, giúp cải thiện chức năng tiêu hóa và hỗ trợ giảm cân. Đây là lựa chọn lý tưởng cho những ai yêu thích sự mới mẻ và tự nhiên.', 0, 0, 1),
(6, 'Trà Lài', 'Trà', 1, 150.00, 0.00, 0, 'den.png', NULL, NULL, 'Tăng cường hệ miễn dịch và hỗ trợ kiểm soát đường huyết.', NULL, NULL, NULL, 'Trà lài mang lại cảm giác thư giãn, giúp cải thiện tâm trạng và làm dịu tinh thần. Hương thơm tự nhiên của trà lài rất quyến rũ và thư giãn.', 0, 0, 1),
(7, 'Trà Ô Long', 'Trà hạ tiểu đường', 1, 90000.00, 500.00, 189, 'olong.jpeg', '', '', 'Giúp giảm cân hiệu quả.', 'Tăng cường sự tập trung.', 'Chống oxi hóa, làm trẻ hóa cơ thể.', 'Giảm căng thẳng và lo âu.', NULL, 13, 1, 0),
(8, 'Trà Đen', 'Trà', 1, 120000.00, 500.00, 0, 'traden.jpg', NULL, NULL, 'Hỗ trợ tiêu hóa tốt hơn.', 'Giúp tăng cường sức đề kháng.', 'Giảm nguy cơ mắc bệnh tim mạch.', 'Nâng cao năng lượng cho cơ thể.', NULL, 4, 1, 0),
(9, 'Trà Xanh', 'Trà', 1, 130000.00, 500.00, 76, 'traxanh.webp', NULL, NULL, 'Giàu chất chống oxi hóa.', 'Giúp giảm cholesterol xấu.', 'Cải thiện tình trạng da.', 'Tăng cường sức khỏe tim mạch.', NULL, 30, 1, 0),
(10, 'Trà Khô', 'Trà', 1, 80000.00, 500.00, 46, 'trakho.png', NULL, NULL, 'Hương vị đậm đà, thơm ngon.', 'Giúp thư giãn sau một ngày dài.', 'Thích hợp cho mọi lứa tuổi.', 'Là lựa chọn tuyệt vời cho trà chiều.', 'Trà khô có hương vị đậm đà, thơm ngon, rất thích hợp cho những ai yêu thích sự đậm đà trong từng ngụm trà. Trà khô còn giúp thư giãn và tạo cảm giác dễ chịu.', 10, 1, 0),
(11, 'Trà Hoa', 'Trà', 1, 130000.00, 500.00, 0, 'trahoa.jpg', 'traden.jpg', 'traoat.jpg', 'Hương vị đậm đà, thơm ngon.', 'Giúp thư giãn sau một ngày dài.', 'Thích hợp cho mọi lứa tuổi.', 'Là lựa chọn tuyệt vời cho trà chiều.', 'Trà hoa là một lựa chọn tuyệt vời cho những ai yêu thích sự tinh tế. Trà hoa mang lại nhiều lợi ích cho sức khỏe, từ giảm stress đến cải thiện giấc ngủ.', 17, 0, 0),
(12, 'Trà Xanh', 'Trà', 1, 100000.00, 500.00, 19, 'xanh1.jpg', NULL, NULL, 'Giàu chất chống oxi hóa.', 'Giúp giảm cholesterol xấu.', 'Cải thiện tình trạng da.', 'Tăng cường sức khỏe tim mạch.', NULL, 23, 0, 0),
(13, 'Trà Lài', 'Trà', 1, 120000.00, 500.00, -3, 'lai.jpg', NULL, NULL, 'Giúp giảm cân hiệu quả.', 'Tăng cường sự tập trung.', 'Chống oxi hóa, làm trẻ hóa cơ thể.', 'Giảm căng thẳng và lo âu.', NULL, 12, 0, 0),
(14, 'Trà Oải Hương', 'Trà', 1, 70000.00, 500.00, 79, 'traoat.jpg', NULL, NULL, 'Hỗ trợ tiêu hóa tốt hơn.', 'Giúp tăng cường sức đề kháng.', 'Giảm nguy cơ mắc bệnh tim mạch.', 'Nâng cao năng lượng cho cơ thể.', NULL, 14, 0, 0),
(23, 'Chuột Gaming', 'Trà hạ tiểu đường', NULL, 120.00, 500.00, 100, '670f46e3428b9_tavolo-da-conferenza-in-vetro-in-un-ufficio-moderno-con-vista-sulla-citta.jpg', '670f394f5a733_z5891500839044_5a70ce1441babcdfe43b45bffec53859.jpg', '670f361509a11_Tea-Ceremony.webp', '', '', '', '', '', 0, 1, 0),
(24, 'Chuột Gaming', 'Trà hạ tiểu đường', NULL, 150.00, 500.00, 200, 'nendau.png', 'DALL·E 2024-10-13 22.06.05 - A vast, lush green tea hill with rolling terraces under a bright sky. On the top right corner of the image, there is a small tea set with a delicate t.png', '1000025514.png', '', '', '', '', '', 0, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tinhtrang`
--

CREATE TABLE `tinhtrang` (
  `matinhtrang` int(11) NOT NULL,
  `madonhang` int(11) DEFAULT NULL,
  `tinhtrang` varchar(255) DEFAULT NULL,
  `ngaytao` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tinhtrang`
--

INSERT INTO `tinhtrang` (`matinhtrang`, `madonhang`, `tinhtrang`, `ngaytao`) VALUES
(7, 10, 'Đang xử lý', '2024-10-17 19:42:57'),
(8, 10, 'Đang chuẩn bị hàng', '2024-10-17 19:43:17'),
(9, 10, 'Đang trên đường giao đến bạn', '2024-10-17 21:19:26'),
(22, 12, 'Đang xử lý', '2024-10-18 11:28:31'),
(23, 12, 'Đang xử lý', '2024-10-18 11:28:35'),
(24, 12, 'Đang chuẩn bị hàng', '2024-10-18 11:28:44'),
(47, 18, 'Đang trên đường giao đến bạn', '2024-10-18 13:31:21'),
(79, 18, 'Đang chuẩn bị hàng', '2024-10-20 03:17:14'),
(80, 17, 'Đang xử lý', '2024-10-20 03:44:33'),
(81, 17, 'Đang chuẩn bị hàng', '2024-10-20 03:44:38'),
(82, NULL, 'Người bán đã bàn giao đơn hàng cho đơn vị vận chuyển', NULL),
(83, 17, 'Người bán đã bàn giao đơn hàng cho đơn vị vận chuyển', '2024-10-20 03:44:57'),
(84, NULL, 'Đang giao hàng', NULL),
(85, 17, 'Đang trên đường giao đến bạn', '2024-10-20 03:45:23'),
(86, 17, 'Đang giao hàng', '2024-10-20 03:45:27'),
(87, 17, 'Giao hàng thành công', '2024-10-20 03:47:46'),
(88, 23, 'Đang xử lý', '2024-10-21 00:14:04'),
(89, 23, 'Đang chuẩn bị hàng', '2024-10-21 00:14:12'),
(90, 23, 'Người bán đã bàn giao đơn hàng cho đơn vị vận chuyển', '2024-10-21 00:14:17'),
(91, 23, 'Đang trên đường giao đến bạn', '2024-10-21 00:14:27'),
(92, 23, 'Đang giao hàng', '2024-10-21 00:14:31'),
(93, 23, 'Giao hàng thành công', '2024-10-21 00:14:35'),
(94, 19, 'Đang xử lý', '2024-10-21 04:07:08'),
(95, 19, 'Đang chuẩn bị hàng', '2024-10-21 04:07:15'),
(96, 19, 'Người bán đã bàn giao đơn hàng cho đơn vị vận chuyển', '2024-10-21 04:07:24'),
(97, 19, 'Đang trên đường giao đến bạn', '2024-10-21 04:07:39'),
(98, 19, 'Đang giao hàng', '2024-10-21 04:07:46'),
(99, 19, 'Giao hàng thành công', '2024-10-21 04:07:50'),
(100, 24, 'Đang xử lý', '2024-10-21 23:52:14'),
(101, 24, 'Đang chuẩn bị hàng', '2024-10-21 23:52:19'),
(102, 24, 'Người bán đã bàn giao đơn hàng cho đơn vị vận chuyển', '2024-10-21 23:52:23'),
(103, 24, 'Đang trên đường giao đến bạn', '2024-10-21 23:52:29'),
(104, 24, 'Đang giao hàng', '2024-10-21 23:52:35'),
(105, 24, 'Giao hàng thành công', '2024-10-21 23:52:41'),
(106, 16, 'Đang xử lý', '2024-10-21 23:52:58'),
(107, 16, 'Đang chuẩn bị hàng', '2024-10-21 23:53:02'),
(108, 16, 'Người bán đã bàn giao đơn hàng cho đơn vị vận chuyển', '2024-10-21 23:53:19'),
(109, 16, 'Đang trên đường giao đến bạn', '2024-10-21 23:53:26'),
(110, 16, 'Đang giao hàng', '2024-10-21 23:53:32'),
(111, 16, 'Giao hàng thành công', '2024-10-21 23:53:35'),
(112, 25, 'Đang xử lý', NULL),
(113, 25, 'Đang chuẩn bị hàng', '2024-10-22 00:03:27'),
(115, 26, NULL, '2024-10-22 00:07:22'),
(116, 26, 'Đang xử lý', '2024-10-22 00:07:27'),
(117, 27, 'Đang xử lý', '2024-10-22 00:09:02'),
(118, 28, 'Đang xử lý', '2024-10-22 00:10:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  ADD PRIMARY KEY (`machitietdonhang`),
  ADD KEY `madonhang` (`madonhang`),
  ADD KEY `masanpham` (`masanpham`);

--
-- Indexes for table `danhgia`
--
ALTER TABLE `danhgia`
  ADD PRIMARY KEY (`id`),
  ADD KEY `madonhang` (`madonhang`),
  ADD KEY `makhachhang` (`makhachhang`),
  ADD KEY `danhgia_ibfk_3` (`masanpham`);

--
-- Indexes for table `donhang`
--
ALTER TABLE `donhang`
  ADD PRIMARY KEY (`madonhang`),
  ADD KEY `makhachhang` (`makhachhang`);

--
-- Indexes for table `khachhang`
--
ALTER TABLE `khachhang`
  ADD PRIMARY KEY (`makhachhang`);

--
-- Indexes for table `loaisanpham`
--
ALTER TABLE `loaisanpham`
  ADD PRIMARY KEY (`maloai`);

--
-- Indexes for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`masanpham`),
  ADD KEY `maloai` (`maloai`);

--
-- Indexes for table `tinhtrang`
--
ALTER TABLE `tinhtrang`
  ADD PRIMARY KEY (`matinhtrang`),
  ADD KEY `madonhang` (`madonhang`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  MODIFY `machitietdonhang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `danhgia`
--
ALTER TABLE `danhgia`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `donhang`
--
ALTER TABLE `donhang`
  MODIFY `madonhang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `khachhang`
--
ALTER TABLE `khachhang`
  MODIFY `makhachhang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `loaisanpham`
--
ALTER TABLE `loaisanpham`
  MODIFY `maloai` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `masanpham` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tinhtrang`
--
ALTER TABLE `tinhtrang`
  MODIFY `matinhtrang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chitietdonhang`
--
ALTER TABLE `chitietdonhang`
  ADD CONSTRAINT `chitietdonhang_ibfk_1` FOREIGN KEY (`madonhang`) REFERENCES `donhang` (`madonhang`),
  ADD CONSTRAINT `chitietdonhang_ibfk_2` FOREIGN KEY (`masanpham`) REFERENCES `sanpham` (`masanpham`);

--
-- Constraints for table `danhgia`
--
ALTER TABLE `danhgia`
  ADD CONSTRAINT `danhgia_ibfk_1` FOREIGN KEY (`madonhang`) REFERENCES `donhang` (`madonhang`),
  ADD CONSTRAINT `danhgia_ibfk_2` FOREIGN KEY (`makhachhang`) REFERENCES `khachhang` (`makhachhang`),
  ADD CONSTRAINT `danhgia_ibfk_3` FOREIGN KEY (`masanpham`) REFERENCES `sanpham` (`masanpham`);

--
-- Constraints for table `donhang`
--
ALTER TABLE `donhang`
  ADD CONSTRAINT `donhang_ibfk_1` FOREIGN KEY (`makhachhang`) REFERENCES `khachhang` (`makhachhang`);

--
-- Constraints for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD CONSTRAINT `fk_masanpham` FOREIGN KEY (`maloai`) REFERENCES `loaisanpham` (`maloai`);

--
-- Constraints for table `tinhtrang`
--
ALTER TABLE `tinhtrang`
  ADD CONSTRAINT `tinhtrang_ibfk_1` FOREIGN KEY (`madonhang`) REFERENCES `donhang` (`madonhang`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

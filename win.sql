-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1:3406
-- Thời gian đã tạo: Th5 02, 2025 lúc 02:15 AM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `win`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `image_user`
--

CREATE TABLE `image_user` (
  `id` int(11) NOT NULL,
  `user_static` varchar(255) NOT NULL,
  `user_fly` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `image_user`
--

INSERT INTO `image_user` (`id`, `user_static`, `user_fly`) VALUES
(1, 'fly.png', 'static.png'),
(2, 'image/user/stella_static.png', 'image/user/stella_fly.png'),
(3, 'image/user/tech_static.png', 'image/user/tech_fly.png'),
(4, 'image/user/musa_static.png', 'image/user/musa_fly.png'),
(5, 'image/user/pixi1_static.png', 'image/user/pixi1_fly.png');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `outfits`
--

CREATE TABLE `outfits` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `image1` varchar(255) DEFAULT 'user_fly.png',
  `image2` varchar(255) DEFAULT 'user_static.png',
  `image3` varchar(255) DEFAULT NULL,
  `image4` varchar(255) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `x` int(11) DEFAULT 100,
  `y` int(11) DEFAULT 100,
  `effect` text NOT NULL,
  `status_effect` tinyint(1) DEFAULT 0,
  `effect1` text NOT NULL,
  `effect2` text NOT NULL,
  `effect3` text NOT NULL,
  `status_effect1` tinyint(4) NOT NULL,
  `status_effect2` tinyint(4) NOT NULL,
  `status_effect3` tinyint(4) NOT NULL,
  `PH` int(11) NOT NULL DEFAULT 10000
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `outfits`
--

INSERT INTO `outfits` (`id`, `user_id`, `image1`, `image2`, `image3`, `image4`, `updated_at`, `x`, `y`, `effect`, `status_effect`, `effect1`, `effect2`, `effect3`, `status_effect1`, `status_effect2`, `status_effect3`, `PH`) VALUES
(3, 3, 'user_static.png', 'user_fly.png', 'win44.png', 'win4.png', '2025-04-28 04:17:16', 156, 151, '', 0, '', '', '', 0, 0, 0, 10000),
(4, 4, 'user_fly.png', 'user_static.png', 'win3_bloomix.png', 'win33.png', '2025-04-25 19:07:07', 100, 100, '', 0, '', '', '', 0, 0, 0, 10000),
(5, 5, 'static.png', 'fly.png', 'image/canh/win9.png', 'image/canh/win99.png', '2025-05-01 13:42:59', 869, 51, 'effect.gif', 0, '', '', '', 0, 0, 0, 10000),
(6, 6, 'image/user/stella_static.png', 'image/user/stella_fly.png', 'image/canh/win11.png', 'image/canh/win1.png', '2025-05-01 13:44:36', 336, 268, '', 0, '', '', 'image/effect/effect.gif', 0, 0, 1, 10000),
(7, 7, 'image/user/musa_static.png', 'image/user/musa_fly.png', 'image/canh/win1515.png', 'image/canh/win15.png', '2025-05-01 15:21:12', 653, 400, 'image/effect/effect6.gif', 1, '', '', '', 0, 0, 0, 10000),
(8, 8, 'image/user/tech_static.png', 'image/user/tech_fly.png', 'image/canh/win44.png', 'image/canh/win4.png', '2025-05-01 13:45:07', 474, 419, 'image/effect/effect4.gif', 1, '', '', '', 0, 0, 0, 10000),
(9, 9, 'image/user/fly.png', 'image/user/static.png', 'image/canh/win66.png', 'image/canh/win6.png', '2025-05-01 19:28:53', 346, 257, 'image/effect/chan_effect.gif', 1, '', '', '', 0, 0, 0, 0),
(12, 12, 'image/user/pixi1_static.png', 'image/user/pixi1_fly.png', 'image/canh/win1414.png', 'image/canh/win14.png', '2025-05-01 19:26:50', 206, 323, 'image/effect/effect7.gif', 1, 'image/effect/chan_effect.gif', 'image/effect/effect8.gif', 'image/effect/effect9.gif', 0, 0, 0, 10000),
(13, 13, 'image/user/pixi1_static.png', 'image/user/pixi1_fly.png', 'image/canh/win1515.png', 'image/canh/win15.png', '2025-05-01 18:14:40', 762, 237, '', 0, '', '', '', 0, 0, 0, 10000);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `created_at`, `status`) VALUES
(3, 'toan2k3', '$2y$10$2RO8meDfmW/7KnWcT6u6ZOxh1PfcuhZKHuYx56PIdrHCIJdLJcQUa', '2025-04-25 18:55:42', 0),
(4, 'duy2k3', '$2y$10$7LS.3DFfc.GTAI3y4Gbzx.rKZjpeEVeSLITMxKMWvZf1jVKQe3W1a', '2025-04-25 19:06:33', 0),
(5, 'duy2k2', '$2y$10$1EJKWCl8IcpXfCmlJnPGoOU8K5z5JXRrfzPIg16UsRgnLmMuyAe2a', '2025-04-25 19:11:27', 0),
(6, 'duy2k25', '$2y$10$AxEGgQNVoMZluGQkSkNQhecS0XJOnP0N9Qh9nDMs2bq/NGAYgT0R2', '2025-04-27 00:58:21', 0),
(7, 'nhu2k25', '$2y$10$dZry.6RUctqUcWYetPMyQeDLdSklO.jU4yDwBgsbFLyuWDnwKiXLW', '2025-04-27 01:02:02', 0),
(8, 'nghi2k25', '$2y$10$UhtPbbi1bi82ORmsCF0wROEVthxHMtjQ7TIcrTousBWpMchMyHOT2', '2025-04-27 01:04:52', 1),
(9, 'ly2k25', '$2y$10$15JjfOlOfu9sNuFxMvRFL.ijBVP5MrwKOhuMTEoq/8GPh9dp0uMKK', '2025-04-27 01:06:28', 1),
(12, 'pixi1', '$2y$10$8ELQ/1UnXC2gTA0R0LMIOe.lXFnNZb9Ttu.ExpbEqQBpdlBezcuBa', '2025-04-29 17:15:15', 1),
(13, 'toan2k25', '$2y$10$UjaYXwyPdEgkrf0Fd4Re3uOpTqrvKDqKpVSOW14uXGCYgotfxIEN.', '2025-05-01 15:25:32', 0);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `image_user`
--
ALTER TABLE `image_user`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `outfits`
--
ALTER TABLE `outfits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_user_id` (`user_id`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `image_user`
--
ALTER TABLE `image_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `outfits`
--
ALTER TABLE `outfits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `outfits`
--
ALTER TABLE `outfits`
  ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

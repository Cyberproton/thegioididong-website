-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: localhost
-- Thời gian đã tạo: Th10 29, 2021 lúc 08:46 AM
-- Phiên bản máy phục vụ: 10.4.21-MariaDB
-- Phiên bản PHP: 8.0.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `thegioididong`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `attribute`
--

CREATE TABLE `attribute` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL,
  `spec_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `attribute`
--

INSERT INTO `attribute` (`id`, `name`, `spec_id`) VALUES
(1, 'CPU', 1),
(2, 'Speed', 1),
(3, 'GPU', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `device_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `device_id`, `quantity`) VALUES
(40, 10, 13, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart_item`
--

CREATE TABLE `cart_item` (
  `cart_id` int(11) NOT NULL,
  `device_id` int(11) NOT NULL,
  `price` decimal(19,4) NOT NULL,
  `quantity` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(1024) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'Phone'),
(2, 'Tablet'),
(3, 'Laptop');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category_spec`
--

CREATE TABLE `category_spec` (
  `category_id` int(11) NOT NULL,
  `spec_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `category_spec`
--

INSERT INTO `category_spec` (`category_id`, `spec_id`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `content` varchar(10240) NOT NULL,
  `date` datetime NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `comment`
--

INSERT INTO `comment` (`id`, `content`, `date`, `user_id`) VALUES
(1, 'A First Comment', '2021-10-27 10:31:26', 1),
(2, 'A Test Comment', '2021-10-27 10:29:48', 1),
(3, 'A Second Comment', '2021-10-27 10:38:43', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comment_comment`
--

CREATE TABLE `comment_comment` (
  `comment_id` int(11) NOT NULL,
  `parent_comment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `comment_comment`
--

INSERT INTO `comment_comment` (`comment_id`, `parent_comment_id`) VALUES
(2, 1),
(3, 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `device`
--

CREATE TABLE `device` (
  `id` int(11) NOT NULL,
  `name` varchar(1024) NOT NULL,
  `price` decimal(19,4) NOT NULL,
  `value` decimal(19,4) NOT NULL,
  `image_url` varchar(4096) DEFAULT NULL,
  `manufacturer` varchar(1024) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `device`
--

INSERT INTO `device` (`id`, `name`, `price`, `value`, `image_url`, `manufacturer`, `description`, `category_id`, `is_deleted`) VALUES
(2, 'iPhone 13 Pro Max 1TB', '800.0000', '800.0000', 'https://m.media-amazon.com/images/I/71yIGykJFNS._AC_SL1500_.jpg', 'Apple', '', 1, 1),
(4, 'Xiaomi 11T 5G 256GB', '500.0000', '500.0000', 'https://cdn.tgdd.vn/Products/Images/42/248293/xiaomi-11t-white-1-2-600x600.jpg', '', 'sdfsdfdsf', 1, 1),
(5, 'Samsung Galaxy Z Flip 3', '200.0000', '100.0000', '', 'Samsung', '', 1, 1),
(8, 'Samsung Galaxy Z Flip 3', '200.0000', '100.0000', '', 'Samsung', '', 1, 1),
(9, 'Xiaomi 11T 5G 256GB', '500.0000', '500.0000', 'https://cdn.tgdd.vn/Products/Images/42/251216/iaomi-11t-xam-1.jpg', 'Xiaomi', 'Xiaomi 11T 5G sở hữu màn hình AMOLED, viên pin siêu khủng cùng camera độ phân giải 108 MP, chiếc smartphone này của Xiaomi sẽ đáp ứng mọi nhu cầu sử dụng của bạn, từ giải trí đến làm việc đều vô cùng mượt mà.', 1, 0),
(10, 'iPhone 13 Pro Max 1TB', '800.0000', '800.0000', 'https://m.media-amazon.com/images/I/71yIGykJFNS._AC_SL1500_.jpg', 'Apple', '', 1, 1),
(11, 'Samsung Galaxy Z Flip 3', '123.0000', '456.0000', 'https://cdn.tgdd.vn/Products/Images/42/248283/samsung-galaxy-z-flip-3-violet-1-600x600.jpg', 'sfds', 'Nối tiếp thành công của Galaxy Z Flip 5G, trong sự kiện Galaxy Unpacked vừa qua Samsung tiếp tục giới thiệu đến thế giới về Galaxy Z Flip3 5G 256GB. Sản phẩm có nhiều cải tiến từ độ bền cho đến hiệu năng và thậm chí nó còn vượt xa hơn mong đợi của mọi người.', 1, 0),
(12, 'Test Device', '10000.0000', '10000.0000', 'https://cdn.tgdd.vn/Products/Images/42/223286/asus-rog-phone-3-044020-104056-600x600.jpg', '', '', 1, 0),
(13, 'Test Device', '10000.0000', '10000.0000', 'https://cdn.tgdd.vn/Products/Images/42/223286/asus-rog-phone-3-044020-104056-600x600.jpg', '', '', 1, 1),
(14, 'Acer Nitro 5 Gaming AN515 57 727J', '1500.0000', '1000.0000', 'https://cdn.tgdd.vn/Products/Images/44/247243/Slider/vi-vn-acer-nitro-gaming-an515-57-727J-i7-nhqd9sv005-thumbvideo.jpg', 'Acer', 'Acer Nitro Gaming được trang bị bộ vi xử lý Intel Core i7 Tiger Lake với cấu trúc 8 nhân 16 luồng có tốc độ đạt tối đa đến 4.6 GHz nhờ Turbo Boost cho máy hiệu năng mạnh mẽ chạy tốt các tựa game cấu hình cao, xử lý các tác vụ đồ họa chuyên nghiệp một cách trơn tru.&#13;&#10;&#13;&#10;RAM 8 GB chuẩn DDR4 2 khe (1 khe 8 GB + 1 khe rời) cùng khả năng nâng cấp tối đa lên đến 32 GB xử lý đa nhiệm cùng lúc nhiều tác vụ, việc di chuyển qua lại giữa các phần mềm, chạy đồng thời các ứng dụng đồ họa mà không lo hiện tượng giật, lag.', 3, 0),
(15, 'Samsung Galaxy Tab S7 FE 4G', '800.0000', '500.0000', 'https://cdn.tgdd.vn/Products/Images/522/240254/Slider/samsung-galaxy-tab-s7-fan-editon-030721-0216148.jpg', 'Samsung', 'Samsung chính thức trình làng mẫu máy tính bảng có tên Galaxy Tab S7 FE, máy trang bị cấu hình mạnh mẽ, màn hình giải trí siêu lớn và điểm ấn tượng nhất là viên pin siêu khủng được tích hợp bên trong, giúp tăng hiệu suất làm việc nhưng vẫn có tính di động cực cao.', 2, 0),
(16, 'iPhone 12 64GB', '2000.0000', '1000.0000', 'https://cdn.tgdd.vn/Products/Images/42/213031/iphone-12-do-new-2-600x600.jpg', 'AppleApple', 'Trong những tháng cuối năm 2020, Apple đã chính thức giới thiệu đến người dùng cũng như iFan thế hệ iPhone 12 series mới với hàng loạt tính năng bứt phá, thiết kế được lột xác hoàn toàn, hiệu năng đầy mạnh mẽ và một trong số đó chính là iPhone 12 64GB.', 1, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `device_attribute`
--

CREATE TABLE `device_attribute` (
  `device_id` int(11) NOT NULL,
  `attribute_id` int(11) NOT NULL,
  `value` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `device_attribute`
--

INSERT INTO `device_attribute` (`device_id`, `attribute_id`, `value`) VALUES
(2, 1, 'Apple A15 Bionic'),
(2, 2, '3.22 GHz'),
(2, 3, 'Apple GPU 5 nhân');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `device_comment`
--

CREATE TABLE `device_comment` (
  `comment_id` int(11) NOT NULL,
  `device_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `device_news`
--

CREATE TABLE `device_news` (
  `device_id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `classification` varchar(64) NOT NULL,
  `title` varchar(256) NOT NULL,
  `content` text NOT NULL,
  `date` datetime NOT NULL,
  `image_url` varchar(4096) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `news`
--

INSERT INTO `news` (`id`, `classification`, `title`, `content`, `date`, `image_url`) VALUES
(1, 'Review', 'Danh sách các điện thoại Samsung dòng Galaxy A đáng mua nhất 2021 tại TGDĐ, trải dài trên nhiều phân khúc, giá chỉ từ 2.6 triệu', 'Hello.&#38;#13;&#38;#10;Samsung là một hãng smartphone nhận được nhiều sự tin tưởng và lựa chọn của người dùng Việt. Và dòng Galaxy A của Samsung là một trong những dòng sản phẩm bán chạy nhất của hãng trong suốt thời gian qua. Đến với bài viết lần này, mình sẽ tổng hợp và gửi đến các bạn tuyển tập những điện thoại Samsung Galaxy A đáng mua nhất 2021 tại Thế Giới Di Động.&#38;#13;&#38;#10;Danh sách sẽ bao gồm 7 &#38;#39;ứng cử viên&#38;#39; sáng giá, trải dài trên các phân khúc khác nhau, với giá tốt đi kèm cấu hình và hiệu năng ổn, đáp ứng được nhiều nhu cầu khác nhau. Hãy cùng tham khảo để chọn mua cho mình chiếc điện thoại ưng ý nhất nhé.', '2021-11-29 04:40:36', 'https://cdn.tgdd.vn/hoi-dap/651567/y-nghia-logo-cua-the-gioi-di-dong-la-gi2-800x450.jpg'),
(2, 'Review', 'Danh sách các điện thoại Samsung dòng Galaxy A đáng mua nhất 2021 tại TGDĐ, trải dài trên nhiều phân khúc, giá chỉ từ 2.6 triệu', 'Samsung là một hãng smartphone nhận được nhiều sự tin tưởng và lựa chọn của người dùng Việt. Và dòng Galaxy A của Samsung là một trong những dòng sản phẩm bán chạy nhất của hãng trong suốt thời gian qua. Đến với bài viết lần này, mình sẽ tổng hợp và gửi đến các bạn tuyển tập những điện thoại Samsung Galaxy A đáng mua nhất 2021 tại Thế Giới Di Động.&#13;&#10;Danh sách sẽ bao gồm 7 &#39;ứng cử viên&#39; sáng giá, trải dài trên các phân khúc khác nhau, với giá tốt đi kèm cấu hình và hiệu năng ổn, đáp ứng được nhiều nhu cầu khác nhau. Hãy cùng tham khảo để chọn mua cho mình chiếc điện thoại ưng ý nhất nhé.', '2021-11-29 04:41:00', 'https://cdn.tgdd.vn/hoi-dap/651567/y-nghia-logo-cua-the-gioi-di-dong-la-gi2-800x450.jpg'),
(3, 'Review', 'Danh sách các điện thoại Samsung dòng Galaxy A đáng mua nhất 2021 tại TGDĐ, trải dài trên nhiều phân khúc, giá chỉ từ 2.6 triệu', 'Samsung là một hãng smartphone nhận được nhiều sự tin tưởng và lựa chọn của người dùng Việt. Và dòng Galaxy A của Samsung là một trong những dòng sản phẩm bán chạy nhất của hãng trong suốt thời gian qua. Đến với bài viết lần này, mình sẽ tổng hợp và gửi đến các bạn tuyển tập những điện thoại Samsung Galaxy A đáng mua nhất 2021 tại Thế Giới Di Động.&#13;&#10;Danh sách sẽ bao gồm 7 &#39;ứng cử viên&#39; sáng giá, trải dài trên các phân khúc khác nhau, với giá tốt đi kèm cấu hình và hiệu năng ổn, đáp ứng được nhiều nhu cầu khác nhau. Hãy cùng tham khảo để chọn mua cho mình chiếc điện thoại ưng ý nhất nhé.', '2021-11-29 04:43:02', 'https://cdn.tgdd.vn/hoi-dap/651567/y-nghia-logo-cua-the-gioi-di-dong-la-gi2-800x450.jpg'),
(9, 'sdfdsfdsf', 'Testst', 'sdfsdfsdfdsfdsfdsf', '2021-11-29 04:43:35', 'https://cdn.tgdd.vn/hoi-dap/651567/y-nghia-logo-cua-the-gioi-di-dong-la-gi2-800x450.jpg');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `date` datetime NOT NULL,
  `status` varchar(64) NOT NULL DEFAULT 'PENDING',
  `user_id` int(11) NOT NULL,
  `device_id` int(11) NOT NULL,
  `price` decimal(19,4) NOT NULL,
  `quantity` int(11) NOT NULL,
  `cancellation_reason` varchar(64) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `date`, `status`, `user_id`, `device_id`, `price`, `quantity`, `cancellation_reason`) VALUES
(14, '2021-11-27 14:49:07', 'CANCELLED', 2, 5, '2000.0000', 10, 'Sole out'),
(15, '2021-11-27 14:50:20', 'COMPLETED', 2, 5, '2000.0000', 10, NULL),
(16, '2021-11-27 14:52:00', 'COMPLETED', 2, 5, '200.0000', 1, NULL),
(17, '2021-11-27 14:52:00', 'DELIVERING', 2, 9, '2000.0000', 4, NULL),
(19, '2021-11-27 15:02:18', 'CANCELLED', 2, 5, '200.0000', 1, 'Customer cancelled'),
(21, '2021-11-28 11:13:03', 'DELIVERING', 5, 9, '500.0000', 1, NULL),
(22, '2021-11-28 14:09:23', 'CANCELLED', 2, 4, '2500.0000', 5, 'Khong thich giao nua'),
(23, '2021-11-28 14:09:23', 'CANCELLED', 2, 9, '2500.0000', 5, 'Customer cancelled'),
(24, '2021-11-28 14:14:39', 'DELIVERING', 2, 9, '500.0000', 1, NULL),
(25, '2021-11-29 08:00:27', 'CANCELLED', 2, 14, '19500.0000', 13, 'Customer cancelled'),
(26, '2021-11-29 08:01:02', 'COMPLETED', 2, 12, '10000.0000', 1, NULL),
(27, '2021-11-29 08:24:12', 'PENDING', 2, 11, '246.0000', 2, NULL),
(28, '2021-11-29 08:24:12', 'PENDING', 2, 12, '10000.0000', 1, NULL),
(29, '2021-11-29 08:24:12', 'PENDING', 2, 14, '1500.0000', 1, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_item`
--

CREATE TABLE `order_item` (
  `order_id` int(11) NOT NULL,
  `device_id` int(11) NOT NULL,
  `price` decimal(19,4) NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `rating`
--

CREATE TABLE `rating` (
  `id` int(11) NOT NULL,
  `value` tinyint(4) NOT NULL,
  `content` varchar(1024) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `device_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `rating`
--

INSERT INTO `rating` (`id`, `value`, `content`, `user_id`, `device_id`) VALUES
(5, 1, '', 1, 4),
(6, 2, '', 2, 4),
(8, 5, '', 2, 9);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `specification`
--

CREATE TABLE `specification` (
  `id` int(11) NOT NULL,
  `name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `specification`
--

INSERT INTO `specification` (`id`, `name`) VALUES
(1, 'CPU'),
(2, 'Memory');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(32) NOT NULL,
  `name` varchar(64) DEFAULT NULL,
  `address` varchar(64) DEFAULT NULL,
  `phone` varchar(32) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `role` varchar(64) NOT NULL DEFAULT 'CUSTOMER',
  `is_deleted` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `name`, `address`, `phone`, `date_of_birth`, `role`, `is_deleted`) VALUES
(1, 'tranhoangquan', '123456', 'Tran Hoang Quan', '', '', '1970-01-01', 'ADMIN', 0),
(2, 'manager', '123456', 'Tran Hoang Quan', '3108 Phu Loi, Phu Trung', '0339049688', '1970-01-01', 'ADMIN', 0),
(3, 'normaluser', '123456', '', '', '', '0000-00-00', 'CUSTOMER', 0),
(5, 'hohoho', '123456', NULL, NULL, NULL, NULL, 'CUSTOMER', 1),
(6, 'testest', '123456', '', '', '', NULL, 'CUSTOMER', 0),
(7, 'testtesttest', '123456', '', '', '', NULL, 'CUSTOMER', 0),
(8, 'testtesttesttest', '123456', '', '', '', '2021-06-11', 'CUSTOMER', 1),
(9, '12345678', '12345678', '', '', '', NULL, 'CUSTOMER', 0),
(10, 'test123', '123456', '', '', '', NULL, 'CUSTOMER', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_news`
--

CREATE TABLE `user_news` (
  `user_id` int(11) NOT NULL,
  `news_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Đang đổ dữ liệu cho bảng `user_news`
--

INSERT INTO `user_news` (`user_id`, `news_id`) VALUES
(1, 1);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `attribute`
--
ALTER TABLE `attribute`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `attribute_ibfk_1` (`spec_id`);

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `device_id` (`device_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `cart_item`
--
ALTER TABLE `cart_item`
  ADD PRIMARY KEY (`cart_id`,`device_id`),
  ADD KEY `device_id` (`device_id`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Chỉ mục cho bảng `category_spec`
--
ALTER TABLE `category_spec`
  ADD PRIMARY KEY (`category_id`,`spec_id`),
  ADD KEY `category_spec_ibfk_2` (`spec_id`);

--
-- Chỉ mục cho bảng `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `comment_comment`
--
ALTER TABLE `comment_comment`
  ADD PRIMARY KEY (`comment_id`,`parent_comment_id`),
  ADD KEY `comment_comment_ibfk_2` (`parent_comment_id`);

--
-- Chỉ mục cho bảng `device`
--
ALTER TABLE `device`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Chỉ mục cho bảng `device_attribute`
--
ALTER TABLE `device_attribute`
  ADD PRIMARY KEY (`device_id`,`attribute_id`),
  ADD KEY `attribute_id` (`attribute_id`);

--
-- Chỉ mục cho bảng `device_comment`
--
ALTER TABLE `device_comment`
  ADD PRIMARY KEY (`comment_id`,`device_id`),
  ADD KEY `device_comment_ibfk_2` (`device_id`);

--
-- Chỉ mục cho bảng `device_news`
--
ALTER TABLE `device_news`
  ADD PRIMARY KEY (`device_id`,`news_id`),
  ADD KEY `news_id` (`news_id`);

--
-- Chỉ mục cho bảng `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `orders_ibfk_1` (`user_id`),
  ADD KEY `device_id` (`device_id`);

--
-- Chỉ mục cho bảng `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`order_id`,`device_id`),
  ADD KEY `order_item_ibfk_1` (`device_id`);

--
-- Chỉ mục cho bảng `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`),
  ADD KEY `device_id` (`device_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Chỉ mục cho bảng `specification`
--
ALTER TABLE `specification`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Chỉ mục cho bảng `user_news`
--
ALTER TABLE `user_news`
  ADD PRIMARY KEY (`user_id`,`news_id`),
  ADD KEY `news_id` (`news_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `attribute`
--
ALTER TABLE `attribute`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT cho bảng `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT cho bảng `device`
--
ALTER TABLE `device`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT cho bảng `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT cho bảng `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `specification`
--
ALTER TABLE `specification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `attribute`
--
ALTER TABLE `attribute`
  ADD CONSTRAINT `attribute_ibfk_1` FOREIGN KEY (`spec_id`) REFERENCES `specification` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`device_id`) REFERENCES `device` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `cart_item`
--
ALTER TABLE `cart_item`
  ADD CONSTRAINT `cart_item_ibfk_1` FOREIGN KEY (`cart_id`) REFERENCES `cart` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_item_ibfk_2` FOREIGN KEY (`device_id`) REFERENCES `device` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `category_spec`
--
ALTER TABLE `category_spec`
  ADD CONSTRAINT `category_spec_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `category_spec_ibfk_2` FOREIGN KEY (`spec_id`) REFERENCES `specification` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `comment_comment`
--
ALTER TABLE `comment_comment`
  ADD CONSTRAINT `comment_comment_ibfk_1` FOREIGN KEY (`comment_id`) REFERENCES `comment` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `comment_comment_ibfk_2` FOREIGN KEY (`parent_comment_id`) REFERENCES `comment` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `device`
--
ALTER TABLE `device`
  ADD CONSTRAINT `device_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Các ràng buộc cho bảng `device_attribute`
--
ALTER TABLE `device_attribute`
  ADD CONSTRAINT `device_attribute_ibfk_1` FOREIGN KEY (`attribute_id`) REFERENCES `attribute` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `device_attribute_ibfk_2` FOREIGN KEY (`device_id`) REFERENCES `device` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `device_comment`
--
ALTER TABLE `device_comment`
  ADD CONSTRAINT `device_comment_ibfk_1` FOREIGN KEY (`comment_id`) REFERENCES `comment` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `device_comment_ibfk_2` FOREIGN KEY (`device_id`) REFERENCES `device` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `device_news`
--
ALTER TABLE `device_news`
  ADD CONSTRAINT `device_news_ibfk_1` FOREIGN KEY (`device_id`) REFERENCES `device` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `device_news_ibfk_2` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`device_id`) REFERENCES `device` (`id`) ON DELETE NO ACTION;

--
-- Các ràng buộc cho bảng `order_item`
--
ALTER TABLE `order_item`
  ADD CONSTRAINT `order_item_ibfk_1` FOREIGN KEY (`device_id`) REFERENCES `device` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_item_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`device_id`) REFERENCES `device` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rating_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `user_news`
--
ALTER TABLE `user_news`
  ADD CONSTRAINT `user_news_ibfk_1` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `user_news_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

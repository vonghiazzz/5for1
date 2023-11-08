-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th2 16, 2023 lúc 01:33 PM
-- Phiên bản máy phục vụ: 10.4.27-MariaDB
-- Phiên bản PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `1633_gcc210025`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `pID` varchar(8) NOT NULL,
  `pCount` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `cart`
--

INSERT INTO `cart` (`cart_id`, `user_id`, `pID`, `pCount`, `date`) VALUES
(45, 5, 'GC0024', 3, '2022-12-20'),
(46, 5, 'GC0066', 1, '2022-12-20'),
(47, 5, 'GC0001', 1, '2023-02-13');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `category`
--

CREATE TABLE `category` (
  `pCat_id` varchar(8) NOT NULL,
  `catName` varchar(30) NOT NULL,
  `catDes` varchar(200) DEFAULT NULL,
  `parentCat` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `category`
--

INSERT INTO `category` (`pCat_id`, `catName`, `catDes`, `parentCat`) VALUES
('C001', 'Dress', NULL, 'Womens Fashion'),
('C002', 'Coats', NULL, 'Womens Fashion'),
('C003', 'Shoes', NULL, 'Womens Fashion'),
('C004', 'Jewels', NULL, 'Womens Fashion'),
('C005', 'Handbag', NULL, 'Womens Fashion'),
('C006', 'T-shirt', NULL, 'Mens Fashion'),
('C008', 'Suit', NULL, 'Mens Fashion'),
('C009', 'Loafers', NULL, 'Mens Fashion'),
('C010', 'Jewels', NULL, 'Mens Fashion'),
('C011', 'Trousers', NULL, 'Mens Fashion');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_detail`
--

CREATE TABLE `order_detail` (
  `od_id` int(11) NOT NULL,
  `oid` int(11) NOT NULL,
  `pID` varchar(8) NOT NULL,
  `pQuantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order_detail`
--

INSERT INTO `order_detail` (`od_id`, `oid`, `pID`, `pQuantity`) VALUES
(134, 306, 'GC0001', 5);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product`
--

CREATE TABLE `product` (
  `pID` varchar(8) NOT NULL,
  `pName` varchar(80) NOT NULL,
  `pQuantity` int(11) NOT NULL,
  `pPrice` decimal(8,0) NOT NULL,
  `pStatus` tinyint(1) NOT NULL,
  `pImage` varchar(60) DEFAULT NULL,
  `pDesc` varchar(200) DEFAULT NULL,
  `pCat_id` varchar(8) NOT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product`
--

INSERT INTO `product` (`pID`, `pName`, `pQuantity`, `pPrice`, `pStatus`, `pImage`, `pDesc`, `pCat_id`, `date`) VALUES
('GC0001', 'Victoria Beckham Dress Fashion Women College', 160, '500', 1, 'women_fashion.jpg', NULL, 'C001', '2022-12-16'),
('GC0002', 'Vince Dress Fashion Women Collections', 32, '374', 1, 'women_fashion1.jpg', NULL, 'C001', '2022-12-16'),
('GC0003', 'Monique Lhuillier Dress Fashion Women Coll', 100, '900', 1, 'women_fashion2.jpg', NULL, 'C001', '2022-12-16'),
('GC0005', '1940s Style Half Collar Batwing Cape Women Dress', 100, '900', 1, 'women_fashion4.jpg', NULL, 'C001', '2022-12-16'),
('GC0006', 'Designer Coats for Women | NET-A-PORTER', 21, '34', 1, 'women_fashion5.jpg', NULL, 'C002', '2022-12-17'),
('GC0007', 'Coats Winter Womens Fashion', 24, '465', 1, 'women_fashion6.jpg', NULL, 'C002', '2022-12-17'),
('GC0008', 'Balmain Wool-Cashmere Women Coats', 23, '53', 1, 'women_fashion7.jpg', NULL, 'C002', '2022-12-17'),
('GC0009', 'Women\'s Coats Wide Lapel Pocket Wool Blend Belts', 31, '245', 1, 'women_fashion20.jpg', NULL, 'C002', '2022-12-17'),
('GC0010', 'Bottega Veneta Shearling-trimmed Wool Women Coats', 52, '450', 1, 'women_fashion9.jpg', NULL, 'C002', '2022-12-17'),
('GC0011', 'Tiny Diamond Earrings Stud Jewels For Women', 100, '300', 1, 'women_fashion10.jpg', NULL, 'C004', '2022-12-18'),
('GC0012', 'Silver Snowflake Water Drop Tassel Earring Studs Jewels Women', 50, '500', 1, 'women_fashion11.jpg', NULL, 'C004', '2022-12-18'),
('GC0013', 'Elise Unique Crystal Flower Adjustable Jewels Women Ring', 60, '580', 1, 'women_fashion12.jpg', NULL, 'C004', '2022-12-18'),
('GC0014', 'Baby Goddess Leaf Diamond Jewels Women Ring', 10, '800', 1, 'women_fashion13.jpg', NULL, 'C004', '2022-12-18'),
('GC0015', 'Royal Crown Jewels Women Necklace ', 30, '560', 1, 'women_fashion14.jpg', NULL, 'C004', '2022-12-18'),
('GC0016', 'Double Heart Flower Pendant Jewels Women Necklace', 40, '700', 1, 'Women\'s_fashion15.jpg', NULL, 'C004', '2022-12-18'),
('GC0017', 'Pebbled cross-body handbags - Women', 100, '670', 1, 'women_fashion15.jpg', NULL, 'C005', '2022-12-19'),
('GC0018', 'Flossy B Leather Women\'s Butterfly Tote Handbags', 100, '700', 1, 'women_fashion16.jpg', NULL, 'C005', '2022-12-19'),
('GC0019', 'Elegant Shoulder Handbags Women Designer Luxury', 80, '700', 1, 'women_fashion17.jpg', NULL, 'C005', '2022-12-19'),
('GC0020', 'Autumn/Winter Women Fashion Personality Shoulder Messenger Handbags', 40, '800', 1, 'women_fashion18.jpg', NULL, 'C005', '2022-12-19'),
('GC0021', 'Womens Shoulder Messenger Handbags Lattice Rivet Square', 40, '580', 1, 'women_fashion19.jpg', NULL, 'C005', '2022-12-19'),
('GC0022', 'Gucci - Rhyton Logo-print Leather Shoes- Womens', 120, '300', 1, 'women_fashion21.jpg', NULL, 'C003', '2022-12-19'),
('GC0023', 'Women\'s Shoes: Sandals, Sneakers + Boots', 80, '300', 1, 'women_fashion22.jpg', NULL, 'C003', '2022-12-19'),
('GC0024', 'Womens Shoes: Sandals, Sneakers + Boots', 60, '560', 1, 'women_fashion23.jpg', NULL, 'C003', '2022-12-20'),
('GC0025', 'Female Causal Shoes Ankle Boots For Women', 50, '600', 1, 'women_fashion24.jpg', NULL, 'C003', '2022-12-20'),
('GC0026', 'Womens Casual Shoes Knee High Boots Leather Fashion', 40, '360', 1, 'women_fashion25.jpg', NULL, 'C003', '2022-12-18'),
('GC0031', 'Maticevski Dress Women Fashion Collections ', 50, '453', 1, 'women_fashion3.jpg', NULL, 'C001', '2022-12-16'),
('GC0060', 'Man Tribal Printed Short Sleeve T-Shirts', 80, '129', 1, 'men_fashion.jpg', NULL, 'C006', '2022-12-18'),
('GC0061', 'Man Geometric Print Color Block Ethnic T-Shirts', 55, '179', 1, 'men_fashion1.jpg', NULL, 'C006', '2022-12-18'),
('GC0062', 'Coconut Tree Causal T-Shirt for Man', 40, '300', 1, 'men_fashion2.jpg', NULL, 'C006', '2022-12-18'),
('GC0063', 'Loose Vacation T-Shirt Collar Man\'s Floral Shirt', 50, '180', 1, 'men_fashion3.jpg', NULL, 'C006', '2022-12-18'),
('GC0064', 'Striped Collar Man\'s Floral T-Shirt', 30, '150', 1, 'men_fashion4.jpg', NULL, 'C006', '2022-12-18'),
('GC0065', 'Man suit', 40, '700', 1, 'men_fashion5.jpg', NULL, 'C008', '2022-12-11'),
('GC0066', 'Classic Style Groom Tuxedos Big Man Lapel Groomsmen Suit White', 50, '800', 1, 'men_fashion6.jpg', NULL, 'C008', '2022-12-20'),
('GC0067', 'Formal Man\'s Suits Slim Fit 3 Pieces Notch Lapel', 30, '1200', 1, 'men_fashion7.jpg', NULL, 'C008', '2022-12-20'),
('GC0068', 'Lori White Slim Fit Peak Lapel Wedding Man Suit ', 20, '1100', 1, 'men_fashion8.jpg', NULL, 'C008', '2022-12-16'),
('GC0069', 'Double Breasted Maroon 6 Button Button Man\'s Suit ', 20, '900', 1, 'men_fashion9.jpg', NULL, 'C008', '2022-12-11'),
('GC0070', 'Man Party Wedding Real Suede Leather Loafers', 30, '450', 1, 'men_fashion10.jpg', NULL, 'C009', '2022-12-11'),
('GC0071', 'Man\'s Spring / Fall Loafers', 20, '400', 1, 'men_fashion11.jpg', NULL, 'C009', '2022-12-12'),
('GC0072', 'Leather Wedding Man Loafers ', 50, '480', 1, 'men_fashion12.jpg', NULL, 'C009', '2022-12-11'),
('GC0073', 'Man\'s Fall Business Daily Oxfords PU Waterproof loafers', 25, '200', 1, 'men_fashion13.jpg', NULL, 'C009', '2022-12-14'),
('GC0074', 'Men Loafers Shoes British Style ', 50, '500', 1, 'men_fashion14.jpg', NULL, 'C009', '2022-12-20'),
('GC0075', 'Man\'s Pleated Trousers', 30, '300', 1, 'men_fashion15.jpg', NULL, 'C011', '2022-12-19'),
('GC0076', 'Pants Man\'s Herringbone Tweed Trousers', 45, '800', 1, 'men_fashion16.jpg', NULL, 'C011', '2022-12-19'),
('GCC0077', 'Man Fashion Vintage Trousers Pants', 30, '500', 1, 'men_fashion17.jpg', NULL, 'C011', '2022-12-19'),
('GCC0078', 'Man\'s Slim Fit Formal Trousers', 60, '560', 1, 'men_fashion18.jpg', NULL, 'C011', '2022-12-19');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `user_id` int(6) NOT NULL,
  `email` varchar(40) NOT NULL,
  `fullname` varchar(40) NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `address` varchar(200) DEFAULT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(10) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `birthday` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`user_id`, `email`, `fullname`, `gender`, `address`, `password`, `role`, `phone`, `birthday`) VALUES
(2, 'NNhoaianh1110@gmail.com', 'Vo Tan Nghia1', 1, 'VietNam', '123', 'admin', '0', '2002-07-17'),
(4, 'votannghia.nt18@gmail.com', 'Vo Tan Nghia', 1, 'VietNam', 'vonghia113', 'user', '0985000000', '2003-06-18'),
(5, 'nghia@gmail.com', 'Tannghia', 1, 'VietNam', '1234567890', 'user', '0000000000', '2022-11-01'),
(9, 'vonghia@gmail.com', 'Tannghia', 1, 'Lưu Văn Liệt', 'Tanghia113', 'user', '0245035890', '2022-12-08'),
(11, 'vonghia113@gmail.com', 'Tannghia', 1, 'LÆ°u VÄƒn Liá»‡t', 'Tanghia113', 'user', '0245035890', '2022-12-16'),
(12, 'vonghia1123@gmail.com', 'Tannghia', 0, 'LÆ°u VÄƒn Liá»‡t', 'Tanghia113', 'user', '0245035890', '2022-12-19'),
(14, 'vonghia11233@gmail.com', 'Tannghia', 1, 'LÆ°u VÄƒn Liá»‡t', 'Tanghia113', 'user', '0245035890', '2022-12-20'),
(15, 'vonghiakk@gmail.com', 'Vo Tan Nghia', 1, 'VietNam', '1234567123', 'user', '0000000000', '2022-12-08');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_order`
--

CREATE TABLE `user_order` (
  `oid` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sum` decimal(10,0) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Đang đổ dữ liệu cho bảng `user_order`
--

INSERT INTO `user_order` (`oid`, `user_id`, `sum`, `date`) VALUES
(301, 5, '2480', '2023-01-06'),
(302, 5, '2480', '2023-01-06'),
(303, 5, '2480', '2023-01-06'),
(304, 5, '2480', '2023-01-06'),
(305, 5, '2480', '2023-02-13'),
(306, 5, '2980', '2023-02-13');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`,`pID`),
  ADD KEY `product_pID` (`pID`);

--
-- Chỉ mục cho bảng `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`pCat_id`);

--
-- Chỉ mục cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`od_id`),
  ADD KEY `oid` (`oid`),
  ADD KEY `pID` (`pID`);

--
-- Chỉ mục cho bảng `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`pID`),
  ADD UNIQUE KEY `pName` (`pName`),
  ADD KEY `product_pCat_id` (`pCat_id`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Chỉ mục cho bảng `user_order`
--
ALTER TABLE `user_order`
  ADD PRIMARY KEY (`oid`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  MODIFY `od_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT cho bảng `user_order`
--
ALTER TABLE `user_order`
  MODIFY `oid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=307;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `product_pID` FOREIGN KEY (`pID`) REFERENCES `product` (`pID`);

--
-- Các ràng buộc cho bảng `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `pID` FOREIGN KEY (`pID`) REFERENCES `product` (`pID`);

--
-- Các ràng buộc cho bảng `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_pCat_id` FOREIGN KEY (`pCat_id`) REFERENCES `category` (`pCat_id`);

--
-- Các ràng buộc cho bảng `user_order`
--
ALTER TABLE `user_order`
  ADD CONSTRAINT `user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

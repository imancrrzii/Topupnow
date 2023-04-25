-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 25, 2023 at 12:41 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pplbo`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrator`
--

CREATE TABLE `administrator` (
  `id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `administrator`
--

INSERT INTO `administrator` (`id`, `full_name`, `username`, `password`) VALUES
(1, 'admin', 'admin', '21232f297a57a5a743894a0e4a801fc3'),
(56, 'basss', 'bas', '202cb962ac59075b964b07152d234b70'),
(57, 'poster', 'poster', '81dc9bdb52d04dc20036dbd8313ed055');

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `title`, `description`, `price`, `image_name`, `category_id`, `featured`, `active`) VALUES
(1, '100 Diamonds', '+4 Bonus', '25000', '100dm.jpg\r\n', 1, 'YES', 'YES'),
(2, '200 Diamonds', '+23 Bonus', '50000', 'Item_1682405091.png', 1, 'YES', 'YES'),
(17, '300 Diamonds', '+30 Bonus', '75000', 'Item_1682405158.png', 1, 'YES', 'YES'),
(18, '500 Diamonds', '+50 Bonus', '150000', 'Item_1682405325.png', 1, 'YES', 'YES'),
(19, '750 Diamonds', '+100 Bonus', '250000', 'Item_1682405650.png', 1, 'YES', 'YES'),
(20, '1500 Diamonds', '+300 Diamonds', '500000', 'Item_1682405770.png', 1, 'YES', 'YES'),
(21, '4000 Diamonds', '+800 Bonus', '1200000', 'Item_1682405856.png', 1, 'YES', 'YES'),
(22, 'Twillight Pass', '-', '150000', 'Item_1682405962.png', 1, 'YES', 'YES'),
(23, 'Weekly Diamond Pass', '-', '30000', 'Item_1682406148.png', 1, 'YES', 'YES'),
(24, '140 Diamonds', '+14 Bonus', '20000', 'Item_1682408385.png', 2, 'YES', 'YES'),
(25, '355 Diamonds', '+35 Bonus', '50000', 'Item_1682408451.png', 2, 'YES', 'YES'),
(26, '720 Diamonds', '+72 Bonus', '100000', 'Item_1682408573.png', 2, 'YES', 'YES'),
(27, '1450 Diamonds', '+140 Bonus', '200000', 'Item_1682408618.png', 2, 'YES', 'YES'),
(28, '2180 Diamonds', '+210 Bonus', '300000', 'Item_1682408668.png', 2, 'YES', 'YES'),
(29, '3640 Diamonds', '+360 Bonus', '500000', 'Item_1682408718.png', 2, 'YES', 'YES'),
(30, '7290 Diamonds', '+720 Bonus', '1000000', 'Item_1682408751.png', 2, 'YES', 'YES'),
(31, '36500 Diamonds', '+3650 Bonus', '5000000', 'Item_1682408791.png', 2, 'YES', 'YES'),
(32, '60 UC', '+6 Bonus', '15000', 'Item_1682408912.png', 3, 'YES', 'YES'),
(33, '325 UC', '+32 Bonus', '75000', 'Item_1682408957.png', 3, 'YES', 'YES'),
(34, '660 UC', '+66 Bonus', '150000', 'Item_1682409002.png', 3, 'YES', 'YES'),
(35, '1800 UC', '+180 Bonus', '375000', 'Item_1682409052.png', 3, 'YES', 'YES'),
(36, '3850 UC', '+380 Bonus', '750000', 'Item_1682409091.png', 3, 'YES', 'YES'),
(37, '8100 UC', '+810 Bonus', '1500000', 'Item_1682409127.png', 3, 'YES', 'YES'),
(38, '125 Points', '-', '15000', 'Item_1682409237.png', 4, 'YES', 'YES'),
(39, '420 Points', '-', '50000', 'Item_1682409283.png', 4, 'YES', 'YES'),
(40, '700 Points', '-', '75000', 'Item_1682409311.png', 4, 'YES', 'YES'),
(41, '1375 Points', '-', '150000', 'Item_1682409337.png', 4, 'YES', 'YES'),
(42, '2400 Points', '-', '250000', 'Item_1682409380.png', 4, 'YES', 'YES'),
(43, '4000 Points', '-', '400000', 'Item_1682409413.png', 4, 'YES', 'YES'),
(44, '8150 Points', '-', '800000', 'Item_1682409437.png', 4, 'YES', 'YES'),
(45, '60 Genesis Crystals', '-', '16000', 'Item_1682410195.png', 5, 'YES', 'YES'),
(46, '300 Genesis Crystals', '+30 Bonus', '79000', 'Item_1682410459.png', 5, 'YES', 'YES'),
(47, '980 Genesis Crystals', '+110 Bonus', '249000', 'Item_1682410509.png', 5, 'YES', 'YES'),
(48, '1980 Genesis Crystals', '+260 Bonus', '479000', 'Item_1682410554.png', 5, 'YES', 'YES'),
(49, '3280 Genesis Crystals', '+600 Bonus', '799000', 'Item_1682410603.png', 5, 'YES', 'YES'),
(50, '6480 Genesis Crystals', '+1600 Bonus', '1599000', 'Item_1682410646.png', 5, 'YES', 'YES'),
(51, 'Blessin Of The Welkin Moon ', '-', '79000', 'Item_1682410697.png', 5, 'YES', 'YES'),
(52, '105 Wild Cores', '-', '15000', 'Item_1682415332.png', 6, 'YES', 'YES'),
(53, '350 Wild Cores', '-', '50000', 'Item_1682415380.png', 6, 'YES', 'YES'),
(54, '585 Wild Cores', '-', '80000', 'Item_1682415409.png', 6, 'YES', 'YES'),
(55, '1135 Wild Cores', '-', '150000', 'Item_1682415445.png', 6, 'YES', 'YES'),
(56, '1660 Wild Cores', '-', '210000', 'Item_1682415479.png', 6, 'YES', 'YES'),
(57, '3010 Wild Cores', '-', '360000', 'Item_1682415508.png', 6, 'YES', 'YES'),
(58, '6210 Wild Cores', '-', '750000', 'Item_1682415552.png', 6, 'YES', 'YES'),
(59, '6 Big Cat Coins', '-', '10000', 'Item_1682415721.png', 7, 'YES', 'YES'),
(60, '36 Big Cat Coins', '-', '25000', 'Item_1682415748.png', 7, 'YES', 'YES'),
(61, '72 Big Cat Coins', '-', '50000', 'Item_1682415776.png', 7, 'YES', 'YES'),
(62, '145 Big Cat Coins', '-', '100000', 'Item_1682415808.png', 7, 'YES', 'YES'),
(63, '1532 Big Cat Coins', '-', '500000', 'Item_1682415841.png', 7, 'YES', 'YES'),
(64, '3993 Big Cat Coins', '-', '10000000', 'Item_1682415864.png', 7, 'YES', 'YES'),
(65, 'Limited Special Gift', '-', '150000', 'Item_1682415899.png', 7, 'YES', 'YES'),
(66, '55 Star Credits', '-', '15000', 'Item_1682416099.png', 8, 'YES', 'YES'),
(67, '275 Star Credits', '-', '75000', 'Item_1682416148.png', 8, 'YES', 'YES'),
(68, '565 Star Credits', '-', '150000', 'Item_1682416178.png', 8, 'YES', 'YES'),
(69, '1155 Star Credits', '-', '300000', 'Item_1682416217.png', 8, 'YES', 'YES'),
(70, '1765 Star Credits', '-', '450000', 'Item_1682416243.png', 8, 'YES', 'YES'),
(71, '2950 Star Credits', '-', '750000', 'Item_1682416317.png', 8, 'YES', 'YES'),
(72, '6000 Star Credits', '-', '1500000', 'Item_1682416342.png', 8, 'YES', 'YES'),
(73, '127 CP', '-', '20000', 'Item_1682416518.png', 9, 'YES', 'YES'),
(74, '645 CP', '-', '100000', 'Item_1682416576.png', 9, 'YES', 'YES'),
(75, '1373 CP', '-', '200000', 'Item_1682416606.png', 9, 'YES', 'YES'),
(76, '3564 CP', '-', '500000', 'Item_1682416631.png', 9, 'YES', 'YES'),
(77, '7656 CP', '-', '1000000', 'Item_1682416655.png', 9, 'YES', 'YES'),
(78, '38280 CP', '-', '5000000', 'Item_1682416677.png', 9, 'YES', 'YES'),
(79, 'Pile Of Gems', '(250)', '12000', 'Item_1682416797.png', 10, 'YES', 'YES'),
(80, 'Bag Of Gems', '(800)', '31500', 'Item_1682416842.png', 10, 'YES', 'YES'),
(81, 'Crate Of Gems', '(1600 Gems + 75 Tokens)', '55000', 'Item_1682416901.png', 10, 'YES', 'YES'),
(82, 'Vault Of Gems', '(5000 Gems + 275 Tokens)', '125000', 'Item_1682416942.png', 10, 'YES', 'YES'),
(83, 'Pile Of Stumble Tokens', '(120)', '37500', 'Item_1682416982.png', 10, 'YES', 'YES'),
(84, 'Vault Of Stumble Tokens', '(1300)', '315000', 'Item_1682417016.png', 10, 'YES', 'YES'),
(85, '30M Koin Emas-D', '-', '5000', 'Item_1682417230.png', 11, 'YES', 'YES'),
(86, '60M Koin Emas-D', '-', '10000', 'Item_1682417270.png', 11, 'YES', 'YES'),
(87, '100M Koin Emas-D', '-', '15000', 'Item_1682417306.png', 11, 'YES', 'YES'),
(88, '200M Koin Emas-D', '-', '30000', 'Item_1682417356.png', 11, 'YES', 'YES'),
(89, '400M Koin Emas-D', '-', '60000', 'Item_1682417381.png', 11, 'YES', 'YES'),
(90, '2B Koin Emas-D', '-', '250000', 'Item_1682417413.png', 11, 'YES', 'YES'),
(91, '4B Koin Emas-D', '-', '500000', 'Item_1682417445.png', 11, 'YES', 'YES'),
(92, '5 Diamonds', '-', '1500', 'Item_1682417793.png', 14, 'YES', 'YES'),
(93, '100 Diamonds', '-', '30000', 'Item_1682417907.png', 14, 'YES', 'YES'),
(94, '200 Diamonds', '-', '65000', 'Item_1682417927.png', 14, 'YES', 'YES'),
(95, '500 Diamonds', '-', '160000', 'Item_1682417965.png', 14, 'YES', 'YES'),
(96, '1000 Diamonds', '-', '310000', 'Item_1682417988.png', 14, 'YES', 'YES'),
(97, '2000 Diamonds', '-', '608000', 'Item_1682418009.png', 14, 'YES', 'YES');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id`, `title`, `image_name`, `featured`, `active`) VALUES
(1, 'Mobile Legends', 'ml.jpg', 'YES', 'YES'),
(2, 'Free Fire', 'ff.jpg', 'Yes', 'Yes'),
(3, 'PUBG Mobile', 'Food_category_1679566251.jpg', 'YES', 'YES'),
(4, 'Valorant', 'valorant.jpg', 'Yes', 'Yes'),
(5, 'Genshin Impact', 'genshin.jpg', 'Yes', 'Yes'),
(6, 'League Of Legends: Wild Rift', 'lol.jpg', 'YES', 'YES'),
(7, 'Ragnarok M: Eternal Love', 'ragnarok.jpg', 'YES', 'YES'),
(8, 'MARVEL Super War', 'marvel.png', 'YES', 'YES'),
(9, 'Call Of Duty: Mobile', 'codm.jpg', 'YES', 'YES'),
(10, 'Stumble Guys', 'stumble.png', 'YES', 'YES'),
(11, 'Higgs Domino', 'domino.jpg', 'YES', 'YES'),
(14, 'Bigo Live', 'bigo.jpg', 'YES', 'YES'),
(15, 'Dragon Hunters: Heroes Legends', 'dh.jpg', 'YES', 'YES'),
(16, 'Honkai Impact 3', 'honkai.png', 'YES', 'YES'),
(17, 'Super Sus', 'Supersus.jpg', 'YES', 'YES'),
(18, 'MARVEL SNAP', 'marvelsnap.jpg', 'YES', 'YES'),
(28, 'Nimo TV', 'Items_category_1679560706.png', 'YES', 'YES'),
(29, 'HAGO', 'Items_category_1679565674.jpg', 'YES', 'YES'),
(30, 'Girls Connect: Idle RPG', 'Food_category_1679568310.png', 'YES', 'YES'),
(31, 'Game of Sultans', 'Food_category_1679569027.jpg', 'YES', 'YES'),
(32, 'Thetan Arena', 'Food_category_1679569450.png', 'YES', 'YES'),
(33, 'MU ORIGIN 3', 'Food_category_1679569559.jpg', 'YES', 'YES'),
(34, 'ONE PUNCH MAN: The Strongest', 'Food_category_1679569646.png', 'YES', 'YES'),
(35, 'Top Eleven', 'Food_category_1679583550.jpeg', 'YES', 'YES'),
(36, 'Onmyoji Arena', 'Food_category_1679583819.jpg', 'YES', 'YES'),
(37, 'Lords Mobile', 'Food_category_1679583866.jpeg', 'YES', 'YES'),
(38, 'Arena of Valor', 'Food_category_1679583937.jpg', 'YES', 'YES'),
(39, 'Webnovel', 'Food_category_1679584236.png', 'YES', 'YES'),
(40, 'Crisis Action', 'Food_category_1679587441.jpg', 'YES', 'YES'),
(48, 'Mobile Legends: Adventure', 'Food_category_1682418693.png', 'YES', 'YES'),
(49, 'Point Blank', 'Food_category_1682418737.jpg', 'YES', 'YES');

-- --------------------------------------------------------

--
-- Table structure for table `kontak`
--

CREATE TABLE `kontak` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kontak`
--

INSERT INTO `kontak` (`id`, `name`, `email`, `subject`, `message`) VALUES
(1, 'iman', 'imancarrazi777@gmail.com', 'tytry', 'dfdsfdccafdsfdsfdfafadfdsf'),
(25, 'iman Carrazi Syamsidi', 'imancarrazi777@gmail.com', 'cara topup', 'Kurang mengerti om ku'),
(26, 'iman Carrazi Syamsidi', 'imancarrazi777@gmail.com', 'cara topup', 'Kurang mengerti om ku'),
(27, 'mama', 'mama@gmail.com', 'imannnn', 'imannnnn'),
(28, 'imannnnnn', 'imancarrazi777@gmail.com', 'judul', 'jelek sekali'),
(29, 'pandik', 'iman@gmail.com', 'Complain', 'MAnual toololl'),
(30, 'iman', 'imancarrazi777@gmail.com', 'p', 'after'),
(31, 'sdsad', 'iman@gmail.com', 'dads', 'sadasd'),
(32, 'adasd', 'iman@gmail.com', 'sdasd', 'asdasdas'),
(33, 'iman', 'iman@gmail.com', 'apa', 'kenapa jelek sekali');

-- --------------------------------------------------------

--
-- Table structure for table `pesanan`
--

CREATE TABLE `pesanan` (
  `id` int(10) UNSIGNED NOT NULL,
  `item` varchar(150) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `status` varchar(50) NOT NULL,
  `customer_id_game` varchar(40) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_pay` varchar(255) NOT NULL,
  `customer_contact` varchar(20) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `pay_img` varchar(200) NOT NULL,
  `total_price` decimal(50,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pesanan`
--

INSERT INTO `pesanan` (`id`, `item`, `price`, `status`, `customer_id_game`, `customer_name`, `customer_pay`, `customer_contact`, `customer_email`, `pay_img`, `total_price`) VALUES
(126, '4B Koin Emas-D', '500000', 'Delivered', '021214511411', 'prot', 'DANA', '3248977', 'iman@gmail.com', 'pay1682417519.png', '480000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrator`
--
ALTER TABLE `administrator`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kontak`
--
ALTER TABLE `kontak`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pesanan`
--
ALTER TABLE `pesanan`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrator`
--
ALTER TABLE `administrator`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `kontak`
--
ALTER TABLE `kontak`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `pesanan`
--
ALTER TABLE `pesanan`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=127;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

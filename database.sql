crate database pplbo

use pplbo

CREATE TABLE `administrator` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `full_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `kategori` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `image_name` varchar(255) NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `item` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image_name` varchar(255) NOT,
  `category_id` int(10) UNSIGNED NOT NULL,
  `featured` varchar(10) NOT NULL,
  `active` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `pesanan` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `item` varchar(150) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `status` varchar(50) NOT NULL,
  `customer_id_game` varchar(150) NOT NULL,
  `customer_name` varchar(150) NOT NULL,
  `customer_pay` varchar(255) NOT NULL,
  `customer_contact` varchar(20) NOT NULL,
  `customer_email` varchar(150) NOT NULL,
  `order_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE `kontak` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(10) NOT NULL,
  `message` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `administrator` VALUES
(1, 'admin', 'admin', '21232f297a57a5a743894a0e');

INSERT INTO `kategori` VALUES
(1, 'Mobile Legends', 'ml.jpg', 'YES', 'YES'),
(2, 'Free Fire', 'ff.jpg', 'YES', 'YES'),
(3, 'PUBG Mobile', 'pubg.jpg', 'YES', 'YES'),
(4, 'Valorant', 'valorant.jpg', 'YES', 'YES'),
(5, 'Genshin Impact', 'genshin.jpg', 'YES', 'YES'),
(6, 'League Of Legends', 'lol.jpg', 'YES', 'YES'),
(7, 'Apex Legends Mobile', 'apex.jpg', 'YES', 'YES'),
(1, 'MARVEL Super War', 'marvel.png', 'YES', 'YES');

INSERT INTO `item` VALUES
(1, 'Mobile Legends 100 Diamonds', '+22 Diamonds', '20000', '100dm.jpg', 1, 'YES', 'YES'),
(2, 'Mobile Legends 200 Diamonds', '+28 Diamonds', '40000', '200dm.jpg', 1, 'YES', 'YES'),
(3, 'Mobile Legends 500 Diamonds', '+30 Diamonds', '100000', '500dm.jpg', 1, 'YES', 'YES');






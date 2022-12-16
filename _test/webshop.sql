-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Vært: 127.0.0.1:3306
-- Genereringstid: 12. 11 2022 kl. 22:29:53
-- Serverversion: 5.7.36
-- PHP-version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `webshop`
--

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `brand`
--

DROP TABLE IF EXISTS `brand`;
CREATE TABLE IF NOT EXISTS `brand` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_bin NOT NULL,
  `image` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Data dump for tabellen `brand`
--

INSERT INTO `brand` (`id`, `title`, `image`) VALUES
(1, 'Nike', 'Nike-Logo.png'),
(2, 'Adidas', 'Adidas_Logo.svg.png'),
(3, 'Reebok', '551064.png'),
(4, 'Jordan', 'Air-Jordan-Logo.png'),
(5, 'New Balance', 'New-Balance-Emblem.png'),
(6, 'Vans', '4a92e0bc55d3109f494e00436eeb07cc.png');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_bin NOT NULL,
  `image` varchar(255) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Data dump for tabellen `category`
--

INSERT INTO `category` (`cat_id`, `title`, `image`) VALUES
(1, 'Men', 'pexels-wesley-carvalho-7116191.jpg'),
(2, 'Women', 'pexels-eduarda-portrait-2602628.jpg'),
(3, 'Limited', 'Nike6.jpg'),
(4, 'Sale', 'downloadasas.jpg'),
(5, 'Daily Offer', '1828961.png');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `company`
--

DROP TABLE IF EXISTS `company`;
CREATE TABLE IF NOT EXISTS `company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `description` text COLLATE utf8_bin,
  `email` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `fk_opening` int(11) DEFAULT NULL,
  `fk_user` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Data dump for tabellen `company`
--

INSERT INTO `company` (`id`, `description`, `email`, `phone`, `image`, `fk_opening`, `fk_user`) VALUES
(1, 'This is the company Description', 'sdcsdcs@mail.dk', '+45 48 48 48 48', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `company_hours`
--

DROP TABLE IF EXISTS `company_hours`;
CREATE TABLE IF NOT EXISTS `company_hours` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `day` varchar(255) COLLATE utf8_bin NOT NULL,
  `open` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `close` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Data dump for tabellen `company_hours`
--

INSERT INTO `company_hours` (`id`, `day`, `open`, `close`) VALUES
(1, 'Monday', NULL, NULL),
(2, 'Tuesday', NULL, NULL),
(3, 'Wednesday', NULL, NULL),
(4, 'Thursday', NULL, NULL),
(5, 'Friday', NULL, NULL),
(6, 'Saturday', NULL, NULL),
(7, '', '', '');

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `contact`
--

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `lname` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `email` varchar(80) COLLATE utf8_bin DEFAULT NULL,
  `comment` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `dt` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `f_name` varchar(255) COLLATE utf8_bin NOT NULL,
  `l_name` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `phone` varchar(255) COLLATE utf8_bin NOT NULL,
  `street` varchar(255) COLLATE utf8_bin NOT NULL,
  `fk_zip` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_bin NOT NULL,
  `rubric` text COLLATE utf8_bin NOT NULL,
  `content` text COLLATE utf8_bin,
  `image` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `fk_user` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Data dump for tabellen `news`
--

INSERT INTO `news` (`id`, `title`, `rubric`, `content`, `image`, `time`, `fk_user`) VALUES
(1, 'sdcsdcs', 'sdcsdcsdc', 'csdcsdcsdcscds', 'ezgif.com-gif-maker (7).png', NULL, NULL),
(2, 'sdcsdcsdc', 'dscsdcsdc', 'sdcsdcsdc', 'ezgif.com-gif-maker (8).png', NULL, NULL),
(3, 'sdcscdcsdc', 'dscsdcsdc', 'cdsdcsdc', 'ezgif.com-gif-maker (9).png', NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8_bin NOT NULL,
  `last_name` varchar(255) COLLATE utf8_bin NOT NULL,
  `email` varchar(255) COLLATE utf8_bin NOT NULL,
  `address` varchar(255) COLLATE utf8_bin NOT NULL,
  `address2` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `country` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `state` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `zipcode` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `total_price` float(6,2) NOT NULL DEFAULT '0.00',
  `order_status` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `order_details`
--

DROP TABLE IF EXISTS `order_details`;
CREATE TABLE IF NOT EXISTS `order_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `product_name` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `product_price` float(6,2) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `total_price` double(6,2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Data dump for tabellen `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `product_name`, `product_price`, `qty`, `total_price`) VALUES
(1, 1, 11, 'sdcsc', 250.00, 1, 250.00),
(2, 2, 11, 'sdcsc', 250.00, 1, 250.00),
(3, 3, 11, 'sdcsc', 250.00, 1, 250.00),
(4, 4, 11, 'sdcsc', 250.00, 1, 250.00);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_bin NOT NULL,
  `description` text COLLATE utf8_bin NOT NULL,
  `price` double DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `fk_brand` int(11) DEFAULT NULL,
  `fk_cat` int(11) DEFAULT NULL,
  `daily_offer` int(11) DEFAULT NULL,
  `fk_related` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Data dump for tabellen `product`
--

INSERT INTO `product` (`id`, `title`, `description`, `price`, `image`, `fk_brand`, `fk_cat`, `daily_offer`, `fk_related`) VALUES
(11, 'sdcsc', 'sdcsdcsdc', NULL, 'templatesneakers-3-768x768.jpg', NULL, 1, NULL, NULL),
(9, 'sdcsdc', 'sdcsdcs', NULL, 'greendisrupt-768x768.jpg', NULL, 1, NULL, NULL),
(13, 'fgbfbfgb', 'fbgfgbf', NULL, 'sacaikawsblazer-768x768.jpg', NULL, 1, NULL, NULL),
(14, 'rtgrtgrtg', 'rtgrtgrtgt', NULL, 'spadej1low-768x768.jpg', NULL, 1, NULL, NULL),
(15, 'dfdfdfv', 'dfvdfvd', NULL, 'SORTNB-768x768.jpg', 5, 1, NULL, NULL),
(20, 'dfvdfvd', 'dfvdfvdf', NULL, 'dunkhigh-768x768.jpg', 3, NULL, NULL, NULL),
(19, 'sdcsdc', 'sdcsdc', NULL, 'ezgif.com-gif-maker (3).png', 2, NULL, NULL, NULL),
(21, 'sdcsdcsdc', 'sdcscsdc', NULL, 'dunklowunc-768x768.jpg', 3, NULL, NULL, NULL),
(22, 'grgtr', 'rtgrtgrtg', NULL, 'nb2002rgroen-768x768.jpg', 3, NULL, NULL, NULL),
(23, 'sdsdc', 'dsdcsd', NULL, 'vansoldskool-768x768.png', 2, NULL, NULL, NULL),
(26, 'sdsdcsc', 'sdsdcs', 345, 'dunkhigh-768x768.jpg', 2, NULL, NULL, NULL),
(27, 'tgtfgr', 'rtrtg', 45, 'greendisrupt-768x768.jpg', 3, NULL, NULL, NULL),
(28, 'tgtfgr', 'rtrtg', 45, 'cobaltbluedunklow-768x768.jpg', 3, NULL, NULL, NULL),
(29, 'fsdfs', 'sdfsdf', 1.22, 'sacaikawsblazer-768x768.jpg', 3, NULL, NULL, NULL),
(30, 'fsdfs', 'sdfsdf', 1.22, 'vansoldskool-768x768.png', 3, NULL, NULL, NULL),
(31, 'fsdfs', 'sdfsdf', 1.22, 'ezgif.com-gif-maker (3).png', 3, NULL, NULL, NULL),
(32, 'rgdgd', 'dggf', 45, 'templatesneakers-3-768x768.jpg', 3, NULL, NULL, NULL),
(33, 'rgdgd', 'dggf', 45, 'nb2002rgroen-768x768.jpg', 3, NULL, NULL, NULL),
(34, 'rgdgd', 'dggf', 45, 'SORTNB-768x768.jpg', 3, NULL, NULL, NULL),
(35, 'fdfggd', 'dfgdfg', 432, 'ocendunk-768x768.jpg', 3, NULL, NULL, NULL),
(36, 'fdfggd', 'dfgdfg', 432, 'spadej1low-768x768.jpg', 3, NULL, NULL, NULL),
(37, 'rgdfvd', 'ddfggdfg', 234, 'dunklowunc-768x768.jpg', 3, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `product_categories`
--

DROP TABLE IF EXISTS `product_categories`;
CREATE TABLE IF NOT EXISTS `product_categories` (
  `fk_product` int(11) DEFAULT NULL,
  `fk_category` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Data dump for tabellen `product_categories`
--

INSERT INTO `product_categories` (`fk_product`, `fk_category`) VALUES
(1, 2),
(1, 3),
(34, 1),
(34, 2),
(34, 3),
(35, 1),
(35, 2),
(35, 3),
(36, 1),
(36, 2),
(36, 3),
(37, 2),
(37, 4);

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `product_image`
--

DROP TABLE IF EXISTS `product_image`;
CREATE TABLE IF NOT EXISTS `product_image` (
  `fk_product` int(11) NOT NULL,
  `image` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `product_related`
--

DROP TABLE IF EXISTS `product_related`;
CREATE TABLE IF NOT EXISTS `product_related` (
  `product_id` int(11) NOT NULL,
  `fk_product` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Struktur-dump for tabellen `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(255) COLLATE utf8_bin NOT NULL,
  `pass` text COLLATE utf8_bin NOT NULL,
  `email` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Data dump for tabellen `users`
--

INSERT INTO `users` (`id`, `user`, `pass`, `email`) VALUES
(1, 'peter', '$2y$15$n/Z5oRfe6WW7Le0ZwLl0ReBJjRsoZczWaOt66RgBrqDj7Wh6Mw9jG', NULL),
(2, 'mowgli', '$2y$15$by5NTN.oVOtSZ2BnDP2y6OCjmJdK50LrF5MB9SdUGwke1ndm3OhOK', NULL),
(3, 'mowgli', '$2y$15$PFiuHiURqyQSiWqFOZRyyO/FK3.VfjybLaDABpuVLTLuNNyEZake2', NULL),
(4, 'mowgli', '$2y$15$9StRyl0JqssnSDuM1wjNm.aY7nu7tsof9nCWdSj3juTKw1k1qI0y2', NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

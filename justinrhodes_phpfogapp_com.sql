-- phpMyAdmin SQL Dump
-- version 3.3.9.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 17, 2012 at 07:24 PM
-- Server version: 5.5.9
-- PHP Version: 5.3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `justinrhodes_phpfogapp_com`
--

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_num` int(11) NOT NULL,
  `date` date NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=21 ;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` VALUES(1, 34, '2012-02-12', 7, 18);
INSERT INTO `orders` VALUES(2, 69, '2012-02-13', 9, 9);
INSERT INTO `orders` VALUES(3, 64, '2012-02-14', 1, 14);
INSERT INTO `orders` VALUES(4, 95, '2012-02-16', 6, 11);
INSERT INTO `orders` VALUES(5, 12, '2012-02-14', 1, 12);
INSERT INTO `orders` VALUES(6, 175, '2012-02-12', 4, 20);
INSERT INTO `orders` VALUES(7, 152, '2012-02-15', 1, 12);
INSERT INTO `orders` VALUES(8, 189, '2012-02-14', 5, 10);
INSERT INTO `orders` VALUES(9, 90, '2012-02-14', 4, 5);
INSERT INTO `orders` VALUES(10, 231, '2012-02-12', 7, 10);
INSERT INTO `orders` VALUES(11, 132, '2012-02-16', 2, 4);
INSERT INTO `orders` VALUES(12, 286, '2012-02-12', 7, 19);
INSERT INTO `orders` VALUES(13, 196, '2012-02-12', 5, 11);
INSERT INTO `orders` VALUES(14, 120, '2012-02-14', 6, 2);
INSERT INTO `orders` VALUES(15, 384, '2012-02-14', 7, 15);
INSERT INTO `orders` VALUES(16, 153, '2012-02-15', 3, 14);
INSERT INTO `orders` VALUES(17, 126, '2012-02-12', 10, 2);
INSERT INTO `orders` VALUES(18, 361, '2012-02-14', 6, 4);
INSERT INTO `orders` VALUES(19, 200, '2012-02-15', 4, 6);
INSERT INTO `orders` VALUES(20, 189, '2012-02-13', 2, 18);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product` varchar(2000) COLLATE utf8_unicode_ci NOT NULL,
  `product_id` int(11) NOT NULL,
  `avail` int(11) NOT NULL,
  `on_order` int(11) NOT NULL,
  `arrival` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=11 ;

--
-- Dumping data for table `product`
--

INSERT INTO `product` VALUES(1, 'Green Boots', 1, 4, 96, '2012-02-20');
INSERT INTO `product` VALUES(2, 'White Boots', 2, 0, 100, '2012-02-22');
INSERT INTO `product` VALUES(3, 'Brown Sneakers', 3, 78, 22, '2012-02-22');
INSERT INTO `product` VALUES(4, 'Brown Gloves', 4, 32, 68, '2012-02-20');
INSERT INTO `product` VALUES(5, 'Blue Boots', 5, 53, 47, '2012-02-18');
INSERT INTO `product` VALUES(6, 'Pink Gloves', 6, 44, 56, '2012-02-21');
INSERT INTO `product` VALUES(7, 'Green Pants', 7, 3, 97, '2012-02-19');
INSERT INTO `product` VALUES(8, 'Red Boots', 8, 74, 26, '2012-02-18');
INSERT INTO `product` VALUES(9, 'Teal Boots', 9, 81, 19, '2012-02-21');
INSERT INTO `product` VALUES(10, 'Purple Sandals', 10, 76, 24, '2012-02-22');

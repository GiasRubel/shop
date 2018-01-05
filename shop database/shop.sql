-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 05, 2018 at 07:47 PM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `adminlogin`
--

DROP TABLE IF EXISTS `adminlogin`;
CREATE TABLE IF NOT EXISTS `adminlogin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `adminlogin`
--

INSERT INTO `adminlogin` (`id`, `name`, `username`, `password`) VALUES
(4, 'gias', 'gias', '123'),
(3, 'gias', 'gias', '123'),
(5, 'rubel', 'rubels', '123\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `brand`
--

DROP TABLE IF EXISTS `brand`;
CREATE TABLE IF NOT EXISTS `brand` (
  `brandid` int(11) NOT NULL AUTO_INCREMENT,
  `brandname` varchar(255) NOT NULL,
  PRIMARY KEY (`brandid`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brand`
--

INSERT INTO `brand` (`brandid`, `brandname`) VALUES
(1, 'skyshop'),
(2, 'tiger'),
(3, 'chita'),
(4, 'akkas'),
(5, 'tiger');

-- --------------------------------------------------------

--
-- Table structure for table `catagory`
--

DROP TABLE IF EXISTS `catagory`;
CREATE TABLE IF NOT EXISTS `catagory` (
  `catId` int(11) NOT NULL AUTO_INCREMENT,
  `catName` varchar(255) NOT NULL,
  PRIMARY KEY (`catId`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `catagory`
--

INSERT INTO `catagory` (`catId`, `catName`) VALUES
(4, 'stationary'),
(2, 'office exxecories'),
(3, 'shop excessories and delux'),
(5, 'tradmil'),
(6, 'sports'),
(7, 'electronics');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

DROP TABLE IF EXISTS `country`;
CREATE TABLE IF NOT EXISTS `country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `name`) VALUES
(2, 'chad'),
(3, 'Bangladesh');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `price` double(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  `image` varchar(255) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

DROP TABLE IF EXISTS `tbl_cart`;
CREATE TABLE IF NOT EXISTS `tbl_cart` (
  `cartId` int(11) NOT NULL AUTO_INCREMENT,
  `sId` varchar(255) NOT NULL,
  `productId` int(11) NOT NULL,
  `productName` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`cartId`)
) ENGINE=MyISAM AUTO_INCREMENT=72 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

DROP TABLE IF EXISTS `tbl_product`;
CREATE TABLE IF NOT EXISTS `tbl_product` (
  `productId` int(11) NOT NULL AUTO_INCREMENT,
  `productName` varchar(255) NOT NULL,
  `catId` int(11) NOT NULL,
  `body` text NOT NULL,
  `price` float NOT NULL,
  `type` int(3) NOT NULL,
  `brandId` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`productId`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`productId`, `productName`, `catId`, `body`, `price`, `type`, `brandId`, `image`) VALUES
(1, 'shoos', 3, '<p><span>Kabira is a song with a Sufi touch from Ranbir kapoor, Deepika Padukone starrer movie \"Yeh Jawaani Hai Deewani. </span></p>', 120.5, 1, 4, 'uploads/045f8cddac.jpg'),
(2, 'spa', 2, '<p><span>Kabira is a song with a Sufi touch from Ranbir kapoor, Deepika Padukone starrer movie \"Yeh Jawaani Hai Deewani. </span></p>', 52.5412, 2, 3, 'uploads/982cd78b5c.png'),
(3, 'lotus', 3, '<p><span>Kabira is a song with a Sufi touch from Ranbir kapoor, Deepika Padukone starrer movie \"Yeh Jawaani Hai Deewani. </span></p>', 892, 2, 3, 'uploads/ca801f69bb.jpg'),
(4, 'football', 6, '<p><span>Lorem ipsum dolor sit amet, sed do eiusmod.</span><span>Lorem ipsum dolor sit amet, sed do eiusmod.</span><span>Lorem ipsum dolor sit amet, sed do eiusmod.</span></p>', 52.5412, 1, 1, 'uploads/d45b88584c.jpg'),
(5, 'cooker', 5, '<p><span>Lorem ipsum dolor sit amet, sed do eiusmod.</span><span>Lorem ipsum dolor sit amet, sed do eiusmod.</span><span>Lorem ipsum dolor sit amet, sed do eiusmod.</span><span>Lorem ipsum dolor sit amet, sed do eiusmod.</span><span>Lorem ipsum dolor sit amet, sed do eiusmod.</span><span>Lorem ipsum dolor sit amet, sed do eiusmod.</span><span>Lorem ipsum dolor sit amet, sed do eiusmod.</span><span>Lorem ipsum dolor sit amet, sed do eiusmod.</span><span>Lorem ipsum dolor sit amet, sed do eiusmod.</span><span>Lorem ipsum dolor sit amet, sed do eiusmod.</span><span>Lorem ipsum dolor sit amet, sed do eiusmod.</span><span>Lorem ipsum dolor sit amet, sed do eiusmod.</span><span>Lorem ipsum dolor sit amet, sed do eiusmod.</span></p>', 5621, 2, 1, 'uploads/da6d388280.jpg'),
(6, 'tv', 7, '<p><span>Lorem ipsum dolor sit amet, sed do eiusmod.</span><span>Lorem ipsum dolor sit amet, sed do eiusmod.</span><span>Lorem ipsum dolor sit amet, sed do eiusmod.</span><span>Lorem ipsum dolor sit amet, sed do eiusmod.</span><span>Lorem ipsum dolor sit amet, sed do eiusmod.</span><span>Lorem ipsum dolor sit amet, sed do eiusmod.</span><span>Lorem ipsum dolor sit amet, sed do eiusmod.</span><span>Lorem ipsum dolor sit amet, sed do eiusmod.</span><span>Lorem ipsum dolor sit amet, sed do eiusmod.</span><span>Lorem ipsum dolor sit amet, sed do eiusmod.</span></p>', 89.23, 1, 2, 'uploads/08c865b415.jpg'),
(7, 'freez', 7, '<p><span>Lorem ipsum dolor sit amet, sed do eiusmod.</span><span>Lorem ipsum dolor sit amet, sed do eiusmod.</span><span>Lorem ipsum dolor sit amet, sed do eiusmod.</span><span>Lorem ipsum dolor sit amet, sed do eiusmod.</span><span>Lorem ipsum dolor sit amet, sed do eiusmod.</span><span>Lorem ipsum dolor sit amet, sed do eiusmod.</span><span>Lorem ipsum dolor sit amet, sed do eiusmod.</span><span>Lorem ipsum dolor sit amet, sed do eiusmod.</span><span>Lorem ipsum dolor sit amet, sed do eiusmod.</span><span>Lorem ipsum dolor sit amet, sed do eiusmod.</span><span>Lorem ipsum dolor sit amet, sed do eiusmod.</span><span>Lorem ipsum dolor sit amet, sed do eiusmod.</span><span>Lorem ipsum dolor sit amet, sed do eiusmod.</span></p>', 9992.24, 2, 4, 'uploads/f70f7d552c.jpg'),
(8, 'hiter', 2, '<p><span>Lorem ipsum dolor sit amet, sed do eiusmod.</span><span>Lorem ipsum dolor sit amet, sed do eiusmod.</span><span>Lorem ipsum dolor sit amet, sed do eiusmod.</span><span>Lorem ipsum dolor sit amet, sed do eiusmod.</span><span>Lorem ipsum dolor sit amet, sed do eiusmod.</span><span>Lorem ipsum dolor sit amet, sed do eiusmod.</span><span>Lorem ipsum dolor sit amet, sed do eiusmod.</span></p>', 5456, 1, 3, 'uploads/2c1c87f3a3.png');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `adress` text NOT NULL,
  `city` varchar(60) NOT NULL,
  `country` int(11) NOT NULL,
  `zip` int(11) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `adress`, `city`, `country`, `zip`, `phone`, `email`, `password`) VALUES
(1, 'mmd', 'dd', 'ss', 3, 12, '21', 'ksj', '123'),
(2, 'Gias', 'korimabad ,gaziabad', 'noakhali', 3, 3801, '01680735256', 'gias@gmail.com', 'e10adc3949ba59abbe56e057f20f883e'),
(3, 'gias', 'sdzc', 'jih', 3, 123, '322', 'gias@kkj', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Table structure for table `wishes`
--

DROP TABLE IF EXISTS `wishes`;
CREATE TABLE IF NOT EXISTS `wishes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` double(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

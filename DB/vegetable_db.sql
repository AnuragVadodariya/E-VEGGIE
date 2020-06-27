-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 02, 2020 at 04:09 PM
-- Server version: 5.7.24
-- PHP Version: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vegetable_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_login`
--

DROP TABLE IF EXISTS `admin_login`;
CREATE TABLE IF NOT EXISTS `admin_login` (
  `a_id` int(5) NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(30) NOT NULL,
  `pswd` varchar(255) NOT NULL,
  PRIMARY KEY (`a_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_login`
--

INSERT INTO `admin_login` (`a_id`, `admin_name`, `pswd`) VALUES
(1, 'anu', 'f09696910bdd874a99cd74c8f05b5c44');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

DROP TABLE IF EXISTS `city`;
CREATE TABLE IF NOT EXISTS `city` (
  `city_id` int(5) NOT NULL AUTO_INCREMENT,
  `city_name` varchar(20) NOT NULL,
  PRIMARY KEY (`city_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`city_id`, `city_name`) VALUES
(1, 'Amreli'),
(2, 'Lathi'),
(3, 'Liliya'),
(4, 'Dhari'),
(5, 'Rajkot'),
(6, 'Babara');

-- --------------------------------------------------------

--
-- Table structure for table `city_area`
--

DROP TABLE IF EXISTS `city_area`;
CREATE TABLE IF NOT EXISTS `city_area` (
  `city_id` int(5) NOT NULL,
  `area_id` int(5) NOT NULL AUTO_INCREMENT,
  `area_name` varchar(30) NOT NULL,
  PRIMARY KEY (`area_id`),
  KEY `city_id` (`city_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `city_area`
--

INSERT INTO `city_area` (`city_id`, `area_id`, `area_name`) VALUES
(1, 1, 'Sardar Colony'),
(1, 2, 'Mahadev Chok'),
(2, 3, 'OM Nagar'),
(3, 4, 'Jivraj Nagar'),
(4, 5, 'Amit colony'),
(4, 6, 'Khodiyar Nagar'),
(5, 7, 'Ajay Bhavan'),
(5, 8, 'Ketan Para'),
(1, 9, 'Svaminarayan chok'),
(2, 10, 'LK Nagar'),
(4, 11, 'Maa Amba Chok'),
(4, 12, 'Patel Chok'),
(5, 13, 'Viral-Dham Society'),
(5, 14, 'Fun World Colony'),
(6, 15, 'AP Colony'),
(6, 16, 'Savarkar Nagar'),
(6, 17, 'TG Panda Circle'),
(3, 18, 'Bavan Chok'),
(2, 19, 'Sambhu Para'),
(3, 20, 'Manibhai Chok'),
(3, 21, 'parth Colony');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `c_id` int(5) NOT NULL AUTO_INCREMENT,
  `c_name` varchar(20) NOT NULL,
  `addr` varchar(30) NOT NULL,
  `mob` bigint(10) NOT NULL,
  `email` varchar(30) NOT NULL,
  `pswd` varchar(255) NOT NULL,
  `city` varchar(20) NOT NULL,
  `addr_area` varchar(20) NOT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`c_id`, `c_name`, `addr`, `mob`, `email`, `pswd`, `city`, `addr_area`) VALUES
(5, 'anuragpatel', 'opp,bank of baroda,Badhada', 9898278874, 'anu@gmail.com', 'f09696910bdd874a99cd74c8f05b5c44', 'Amreli', 'Sardar Colony'),
(6, 'bri', 'Neshdi', 9012344321, 'bro@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Lathi', 'OM Nagar'),
(7, 'suresh', 'Vijpadi', 7979777971, 'suresh@gmail.com', '1e48c4420b7073bc11916c6c1de226bb', 'Liliya', 'Jivraj Nagar'),
(8, 'vaidip', 'Junuvadar', 9811111190, 'vaiii@gmail.com', 'b59c67bf196a4758191e42f76670ceba', 'Rajkot', 'Ketan Para'),
(9, 'aa', 'errk', 9999121314, 'jdjd@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Lathi', 'LK Nagar'),
(10, 'anurag', 'qrkr', 9998989898, 'ass@gmail.com', '1e48c4420b7073bc11916c6c1de226bb', 'Liliya', 'Bavan Chok'),
(11, 'vaidip', 'xlsa', 9191919191, 'vaii@gmail.com', 'dfc7defac6624a80f02b02e22b14e8fd', 'Amreli', 'Mahadev Chok'),
(12, 'chintan', 'qekfk', 9292929292, 'chintanpatel@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Lathi', 'LK Nagar'),
(13, 'Krunal', 'asdf', 9993939393, 'patel@gmail.com', '1415fe9fea0fa1e45dddcff5682239a0', 'Liliya', 'Jivraj Nagar'),
(14, 'xyz', 'adjd', 9494949494, 'qwe@gmail.com', 'e23c2278367627157eaf50e529528c2b', 'Amreli', 'Mahadev Chok'),
(15, 'vinodbhai', 'badhada', 9191919192, 'vinod1313@gmail.com', '76d80224611fc919a5d54f0ff9fba446', 'Lathi', 'Sambhu Para'),
(16, 'himanshu', 'qwkr', 9797979797, 'hims@gmail.com', 'a2fe8c05877ec786290dd1450c3385cd', 'Dhari', 'Khodiyar Nagar'),
(18, 'sanjay', 'ask', 9012345678, 'sass@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'Amreli', 'Mahadev Chok'),
(19, 'vinay', 'qwld', 9912121212, 'viju@gmail.com', 'a01610228fe998f515a72dd730294d87', 'Babara', 'Savarkar Nagar'),
(21, 'jsj', 'sdd', 9898111111, 'assdj@gmail.com', '7b9dc501afe4ee11c56a4831e20cee71', 'Amreli', 'Mahadev Chok'),
(22, 'abc', 'qwe', 9191911919, 'abc@gmail.com', '8c8a58fa97c205ff222de3685497742c', 'Lathi', 'Sambhu Para');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

DROP TABLE IF EXISTS `order_details`;
CREATE TABLE IF NOT EXISTS `order_details` (
  `o_id` int(5) NOT NULL,
  `v_id` int(5) NOT NULL,
  `v_name` varchar(20) NOT NULL,
  `250gm` int(5) NOT NULL,
  `500gm` int(5) NOT NULL,
  `1kg` int(5) NOT NULL,
  KEY `o_id` (`o_id`),
  KEY `v_id` (`v_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order_master`
--

DROP TABLE IF EXISTS `order_master`;
CREATE TABLE IF NOT EXISTS `order_master` (
  `o_id` int(5) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `amount` double(5,2) NOT NULL,
  `c_id` int(5) NOT NULL,
  `delivery_status` enum('confirm','packingvegetable','packing vegetable','onway','done') NOT NULL DEFAULT 'confirm',
  PRIMARY KEY (`o_id`),
  KEY `c_id` (`c_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `veg_sell`
--

DROP TABLE IF EXISTS `veg_sell`;
CREATE TABLE IF NOT EXISTS `veg_sell` (
  `v_id` int(5) NOT NULL AUTO_INCREMENT,
  `v_name` varchar(20) NOT NULL,
  `pr_250gm` int(5) NOT NULL,
  `pr_500gm` int(5) NOT NULL,
  `pr_1kg` int(5) NOT NULL,
  `v_qty` double(4,2) NOT NULL,
  `v_img` varchar(255) NOT NULL,
  `available` enum('y','n') NOT NULL,
  PRIMARY KEY (`v_id`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `veg_sell`
--

INSERT INTO `veg_sell` (`v_id`, `v_name`, `pr_250gm`, `pr_500gm`, `pr_1kg`, `v_qty`, `v_img`, `available`) VALUES
(30, 'Guvar', 10, 0, 20, 19.00, 'vegetable_image/46992809image_4.jpg', 'n'),
(31, 'Kobi', 0, 0, 20, 9.00, 'vegetable_image/51436182product-4.jpg', 'y'),
(32, 'Fulaver', 0, 0, 30, 14.00, 'vegetable_image/55581144product-6.jpg', 'y'),
(33, 'Gajar', 0, 20, 32, 6.50, 'vegetable_image/16009248product-7.jpg', 'y'),
(34, 'Marcha', 10, 18, 0, 13.00, 'vegetable_image/76806037product-12.jpg', 'n'),
(35, 'Lasan', 20, 0, 0, 7.75, 'vegetable_image/82808664product-11.jpg', 'y'),
(36, 'Tamata', 10, 15, 25, 5.00, 'vegetable_image/68633981product-5.jpg', 'y'),
(37, 'apple', 0, 50, 80, 3.50, 'vegetable_image/36869792product-10.jpg', 'y'),
(38, 'Adu', 20, 0, 0, 8.75, 'vegetable_image/153448111449702432684.jpeg', 'y'),
(41, 'Muli', 0, 25, 40, 12.00, 'vegetable_image/97018155th.jpeg', 'n'),
(43, 'dadam', 0, 0, 50, 15.00, 'vegetable_image/11742321shutterstock_196239605-pomegranate-jun15.jpg', 'y'),
(56, 'Nimbu', 30, 0, 0, 5.50, 'vegetable_image/79003717limbu.JPG', 'y'),
(57, 'sitafal', 0, 30, 55, 18.00, 'vegetable_image/25792487sitafal.jpeg', 'y'),
(58, 'Karela', 0, 0, 40, 14.00, 'vegetable_image/64374504Karel.jpeg', 'y'),
(59, 'drax', 0, 0, 45, 12.00, 'vegetable_image/16681918ertk.jpeg', 'n'),
(60, 'Kela', 0, 0, 40, 12.00, 'vegetable_image/91685083kerrk.jpeg', 'n'),
(61, 'Matar', 15, 20, 30, 14.50, 'vegetable_image/45674828errjr.jpeg', 'n'),
(64, 'Jamfal', 0, 0, 40, 13.00, 'vegetable_image/4e4a3dc473d2dc6ca4941d9391ed16cekkwqq.jpg', 'n'),
(65, 'Tuver', 0, 20, 30, 14.00, 'vegetable_image/267cec05660f549cb7a3d29eabcf56dc1401389340888.jpeg', 'n'),
(68, 'Bhindi', 0, 30, 55, 15.50, 'vegetable_image/43584779b.jpg', 'y');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `city_area`
--
ALTER TABLE `city_area`
  ADD CONSTRAINT `city_area_ibfk_1` FOREIGN KEY (`city_id`) REFERENCES `city` (`city_id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`o_id`) REFERENCES `order_master` (`o_id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`v_id`) REFERENCES `veg_sell` (`v_id`);

--
-- Constraints for table `order_master`
--
ALTER TABLE `order_master`
  ADD CONSTRAINT `order_master_ibfk_1` FOREIGN KEY (`c_id`) REFERENCES `customer` (`c_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

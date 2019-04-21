-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2019 at 09:39 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `durable_management_system`
--
CREATE DATABASE IF NOT EXISTS `durable_management_system` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `durable_management_system`;

-- --------------------------------------------------------

--
-- Table structure for table `borrows`
--

CREATE TABLE IF NOT EXISTS `borrows` (
  `borrow_id` int(11) NOT NULL AUTO_INCREMENT,
  `durable_id` int(11) NOT NULL,
  `borrow_date` datetime DEFAULT NULL,
  `due_date` date NOT NULL,
  `return_date` datetime DEFAULT NULL,
  `borrow_status_id` int(11) NOT NULL,
  `users_user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`borrow_id`),
  KEY `fk_borrows_durable_article1_idx` (`durable_id`),
  KEY `fk_borrows_borrow_status1_idx` (`borrow_status_id`),
  KEY `fk_borrows_users1_idx` (`users_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Triggers `borrows`
--
DELIMITER $$
CREATE TRIGGER `add_date_borrow` BEFORE INSERT ON `borrows` FOR EACH ROW BEGIN
	IF (NEW.borrow_date IS NULL) THEN
		SET   NEW.borrow_date  = NOW();
	END IF;
 END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `update_borrow` BEFORE UPDATE ON `borrows` FOR EACH ROW BEGIN
	IF (NEW.return_date IS NULL) THEN
		SET   NEW.return_date  = NOW();
	END IF;
 END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `borrow_detail`
--

CREATE TABLE IF NOT EXISTS `borrow_detail` (
  `borrow_detail_id` int(11) NOT NULL,
  `borrow_id` int(11) NOT NULL,
  `durable_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `borrow_status`
--

CREATE TABLE IF NOT EXISTS `borrow_status` (
  `borrow_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `borrow_status_name` varchar(255) NOT NULL,
  PRIMARY KEY (`borrow_status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `borrow_status`
--

INSERT INTO `borrow_status` (`borrow_status_id`, `borrow_status_name`) VALUES
(1, 'ยืม'),
(2, 'คืน');

-- --------------------------------------------------------

--
-- Table structure for table `buildings`
--

CREATE TABLE IF NOT EXISTS `buildings` (
  `building_id` int(11) NOT NULL AUTO_INCREMENT,
  `building_name` varchar(255) NOT NULL,
  `campus_id` int(11) NOT NULL,
  PRIMARY KEY (`building_id`),
  KEY `fk_buildings_campus1_idx` (`campus_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `buildings`
--

INSERT INTO `buildings` (`building_id`, `building_name`, `campus_id`) VALUES
(1, 'อาคาร 17', 1);

-- --------------------------------------------------------

--
-- Table structure for table `campus`
--

CREATE TABLE IF NOT EXISTS `campus` (
  `campus_id` int(11) NOT NULL AUTO_INCREMENT,
  `campus_name` varchar(255) NOT NULL,
  PRIMARY KEY (`campus_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `campus`
--

INSERT INTO `campus` (`campus_id`, `campus_name`) VALUES
(1, 'ศูนย์นนทบุรี'),
(3, 'ศูนย์สุพรรณบุรี'),
(4, 'ศูนย์หันตรา'),
(5, 'ศูนย์วาสุกรี');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(255) NOT NULL,
  `durable_age` int(11) NOT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`, `durable_age`) VALUES
(1, 'ครุภัณฑ์คอมพิวเตอร์', 3),
(3, 'ครุภัณฑ์ก่อสร้าง', 3),
(4, 'ครุภัณฑ์ไฟฟ้าและวิทยุ', 3),
(5, 'ครุภัณฑ์วิทยาศาสตร์การแพทย์', 3),
(6, 'ครุภัณฑ์งานบ้านงานครัว', 3),
(7, 'ครุภัณฑ์โรงงาน', 3),
(8, 'ครุภัณฑ์สํารวจ', 3),
(9, 'ครุภัณฑ์อาวุธ', 3),
(10, 'ครุภัณฑ์ดนตรีและนาฏศิลป์', 3),
(11, 'ครุภัณฑ์ยานพาหนะและขนส่ง', 3);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `course_id` int(11) NOT NULL AUTO_INCREMENT,
  `course_name` varchar(255) NOT NULL,
  `major_id` int(11) NOT NULL,
  PRIMARY KEY (`course_id`),
  KEY `major_id` (`major_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `course_name`, `major_id`) VALUES
(1, 'วิทยาการคอมพิวเตอร์', 1),
(2, 'เทคโนโลยีสารสนเทศ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `durable_article`
--

CREATE TABLE IF NOT EXISTS `durable_article` (
  `durable_id` int(11) NOT NULL AUTO_INCREMENT,
  `durable_code` varchar(255) NOT NULL,
  `durable_name` varchar(255) DEFAULT NULL,
  `use_date` date DEFAULT NULL,
  `add_date` datetime DEFAULT NULL,
  `cat_id` int(11) NOT NULL,
  `picture_path` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `price` double DEFAULT NULL,
  `durable_status_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `major_id` int(11) DEFAULT NULL,
  `description` longtext,
  `durable_age` int(11) DEFAULT NULL,
  `scrap_value` double DEFAULT NULL,
  `can_borrow` char(1) DEFAULT NULL,
  `borrow_status` int(11) NOT NULL,
  PRIMARY KEY (`durable_id`),
  UNIQUE KEY `durable_code_UNIQUE` (`durable_code`),
  KEY `fk_durable_article_durable_status_idx` (`durable_status_id`),
  KEY `fk_durable_article_users1_idx` (`user_id`),
  KEY `fk_durable_article_category1_idx` (`cat_id`),
  KEY `fk_durable_article_rooms1_idx` (`room_id`),
  KEY `borrow_status` (`borrow_status`),
  KEY `major_id` (`major_id`),
  KEY `course_id` (`course_id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `durable_article`
--

INSERT INTO `durable_article` (`durable_id`, `durable_code`, `durable_name`, `use_date`, `add_date`, `cat_id`, `picture_path`, `user_id`, `price`, `durable_status_id`, `room_id`, `course_id`, `major_id`, `description`, `durable_age`, `scrap_value`, `can_borrow`, `borrow_status`) VALUES
(1, 'วขน.งปม.คก. 010-109-387-2542', 'เก้าอี้', '2018-09-13', '2018-09-13 00:00:00', 1, 'b04f0c72f0467fe92c983c5c1aa84902.jpg', 1, 100000, 1, 2, 1, 1, 'test1', 3, 1, 'Y', 2),
(30, 'วขน.งปม.คก. 010-109-387-2544', 'เก้าอี้', '2019-01-31', '2019-01-31 14:18:03', 1, 'noimg.jpg', 1, 1, 1, 2, NULL, 1, '', 3, 0, 'N', 2);

--
-- Triggers `durable_article`
--
DELIMITER $$
CREATE TRIGGER `durable_add_date` BEFORE INSERT ON `durable_article` FOR EACH ROW BEGIN
	IF (NEW.add_date IS NULL) THEN
		SET   NEW.add_date  = NOW();
	END IF;
 END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `durable_status`
--

CREATE TABLE IF NOT EXISTS `durable_status` (
  `durable_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `durable_status_name` varchar(255) NOT NULL,
  PRIMARY KEY (`durable_status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `durable_status`
--

INSERT INTO `durable_status` (`durable_status_id`, `durable_status_name`) VALUES
(1, 'ปกติ'),
(2, 'อยู่ระหว่างดำเนินการจำหน่าย'),
(3, 'จำหน่ายเรียบร้อยแล้ว');

-- --------------------------------------------------------

--
-- Table structure for table `faculties`
--

CREATE TABLE IF NOT EXISTS `faculties` (
  `faculty_id` int(11) NOT NULL AUTO_INCREMENT,
  `faculty_name` varchar(45) NOT NULL,
  PRIMARY KEY (`faculty_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `faculties`
--

INSERT INTO `faculties` (`faculty_id`, `faculty_name`) VALUES
(1, 'วิทยาศาสตร์และเทคโนโลยี');

-- --------------------------------------------------------

--
-- Table structure for table `identify_log`
--

CREATE TABLE IF NOT EXISTS `identify_log` (
  `identify_log_id` int(11) NOT NULL AUTO_INCREMENT,
  `durable_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `identify_datetime` datetime NOT NULL,
  `identify_status_id` int(11) NOT NULL,
  PRIMARY KEY (`identify_log_id`),
  KEY `durable_id` (`durable_id`),
  KEY `user_id` (`user_id`),
  KEY `identify_status_id` (`identify_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Triggers `identify_log`
--
DELIMITER $$
CREATE TRIGGER `identify_datetime` BEFORE INSERT ON `identify_log` FOR EACH ROW BEGIN
	IF (NEW.identify_datetime IS NULL) THEN
		SET   NEW.identify_datetime  = NOW();
	END IF;
 END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `identify_status`
--

CREATE TABLE IF NOT EXISTS `identify_status` (
  `identify_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `identify_status_name` varchar(255) NOT NULL,
  PRIMARY KEY (`identify_status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `majors`
--

CREATE TABLE IF NOT EXISTS `majors` (
  `major_id` int(11) NOT NULL AUTO_INCREMENT,
  `major_name` varchar(45) DEFAULT NULL,
  `faculty_id` int(11) NOT NULL,
  PRIMARY KEY (`major_id`),
  KEY `fk_sub_departments_departments1_idx` (`faculty_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `majors`
--

INSERT INTO `majors` (`major_id`, `major_name`, `faculty_id`) VALUES
(1, 'วิทยาการคอมพิวเตอร์', 1);

-- --------------------------------------------------------

--
-- Table structure for table `problem_report`
--

CREATE TABLE IF NOT EXISTS `problem_report` (
  `problem_id` int(11) NOT NULL AUTO_INCREMENT,
  `problem_topic` varchar(255) NOT NULL,
  `problem_detail` longtext,
  `durable_id` int(11) NOT NULL,
  `problem_status_id` int(11) NOT NULL,
  `report_datetime` datetime DEFAULT NULL,
  `reporter_id` varchar(45) DEFAULT NULL,
  `reporter_name` varchar(45) DEFAULT NULL,
  `reporter_surname` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`problem_id`),
  KEY `fk_problem_report_durable_article1_idx` (`durable_id`),
  KEY `fk_problem_report_problem_status1_idx` (`problem_status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `problem_report`
--

INSERT INTO `problem_report` (`problem_id`, `problem_topic`, `problem_detail`, `durable_id`, `problem_status_id`, `report_datetime`, `reporter_id`, `reporter_name`, `reporter_surname`) VALUES
(1, 'ขาหัก', 'นั่งไม่ได้เก้าอี้ขาหัก', 1, 1, '2019-04-10 11:18:36', '158405241003', 'กฤติกาล', 'วีระกะลัส'),
(2, '', '', 30, 1, '2019-04-10 13:20:53', '', '', ''),
(3, '', '', 30, 1, '2019-04-10 13:21:18', '', '', ''),
(4, '11089009', 'นั่งแล้วหลับ', 30, 1, '2019-04-10 13:23:21', '1111', 'กรม', 'นามสกุล');

--
-- Triggers `problem_report`
--
DELIMITER $$
CREATE TRIGGER `report_add_time` BEFORE INSERT ON `problem_report` FOR EACH ROW BEGIN
	IF (NEW.report_datetime IS NULL) THEN
		SET   NEW.report_datetime  = NOW();
	END IF;
 END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `problem_status`
--

CREATE TABLE IF NOT EXISTS `problem_status` (
  `problem_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `problem_status_name` varchar(255) NOT NULL,
  PRIMARY KEY (`problem_status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `problem_status`
--

INSERT INTO `problem_status` (`problem_status_id`, `problem_status_name`) VALUES
(1, 'ใหม่'),
(2, 'ดำเนินการตรวจสอบ'),
(3, 'ดำเนินการแก้ไขปัญหา'),
(4, 'แก้ไขปัญหาเสร็จสิ้น'),
(5, 'ไม่สามารถแก้ไขปัญหาได้');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE IF NOT EXISTS `rooms` (
  `room_id` int(11) NOT NULL AUTO_INCREMENT,
  `room_name` varchar(255) DEFAULT NULL,
  `building_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`room_id`),
  KEY `fk_rooms_buildings1_idx` (`building_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_id`, `room_name`, `building_id`) VALUES
(1, 'ไม่มี', NULL),
(2, '17071', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sysconfig`
--

CREATE TABLE IF NOT EXISTS `sysconfig` (
  `syscode` char(3) NOT NULL COMMENT 'รหัส',
  `sysvalue` varchar(255) DEFAULT NULL COMMENT 'ค่า',
  `sysdesc` varchar(255) DEFAULT NULL COMMENT 'ราย',
  PRIMARY KEY (`syscode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sysconfig`
--

INSERT INTO `sysconfig` (`syscode`, `sysvalue`, `sysdesc`) VALUES
('FBP', './books/', 'Path book'),
('FHP', 'C:/xampp/htdocs/ebook/books/', 'Host path'),
('FIB', '/files/shot.png', 'Img book'),
('FPI', './pdfimage/', 'PDF image path'),
('FPP', './pdf/', 'PDF path'),
('HOS', 'rmutsb.ac.th', 'Domain E-mail สำหรับใช้งาน'),
('HOT', NULL, 'Domain E-mail สำหรับใช้งานของอาจารย์'),
('LIT', '12', 'Limit per page'),
('LMS', 'มีนักศึกษาได้ทำการแจ้งปัญหาเข้ามาค่ะ', 'ข้อความสำหรับใช้ใน Line Notify'),
('LTK', 'tkeqpOee6cn11o537QrwCpbJolKAYwBpzNNTNzbTHrO', 'โทเค่นสำหรับใช้ใน Line Notify'),
('MAL', 'durable.sci@gmail.com', 'E-mail for send mail'),
('PAS', 'p1o2r3n4', 'Password for send mail'),
('PRT', '465', 'mail PORT '),
('SER', 'ssl://smtp.gmail.com', 'Mail Server'),
('SYS', 'ระบบจัดการครุภัณฑ์', 'ชื่อระบบ'),
('URL', 'http://127.0.0.1/ebook/', 'URL ebook');

-- --------------------------------------------------------

--
-- Table structure for table `type_user`
--

CREATE TABLE IF NOT EXISTS `type_user` (
  `type_user_id` char(1) NOT NULL,
  `type_user_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`type_user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `type_user`
--

INSERT INTO `type_user` (`type_user_id`, `type_user_name`) VALUES
('A', 'Admin'),
('U', 'User');

-- --------------------------------------------------------

--
-- Table structure for table `usage_log`
--

CREATE TABLE IF NOT EXISTS `usage_log` (
  `usage_id` int(11) NOT NULL AUTO_INCREMENT,
  `durable_id` int(11) NOT NULL,
  `usage_datetime` datetime DEFAULT NULL,
  PRIMARY KEY (`usage_id`),
  KEY `fk_usage_log_durable_article1_idx` (`durable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `usage_log`
--

INSERT INTO `usage_log` (`usage_id`, `durable_id`, `usage_datetime`) VALUES
(1, 1, '2018-11-11 19:45:01'),
(2, 1, '2018-11-11 19:47:33'),
(3, 1, '2018-11-11 20:20:39'),
(4, 1, '2019-01-06 23:47:32'),
(5, 1, '2019-01-06 23:48:01'),
(6, 1, '2019-01-06 23:48:09'),
(7, 1, '2019-01-13 18:32:19'),
(8, 1, '2019-01-17 17:23:12'),
(9, 31, '2019-02-05 04:51:27'),
(10, 30, '2019-02-21 21:31:02'),
(11, 1, '2019-04-10 11:17:52'),
(12, 30, '2019-04-10 13:20:04'),
(13, 30, '2019-04-10 13:20:12'),
(14, 30, '2019-04-10 13:24:45');

--
-- Triggers `usage_log`
--
DELIMITER $$
CREATE TRIGGER `add_time_to_usagelog` BEFORE INSERT ON `usage_log` FOR EACH ROW BEGIN
	IF (NEW.usage_datetime IS NULL) THEN
		SET   NEW.usage_datetime  = NOW();
	END IF;
 END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) DEFAULT NULL,
  `user_surname` varchar(255) DEFAULT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(40) DEFAULT NULL,
  `user_status_id` char(1) DEFAULT NULL,
  `type_user_id` char(1) DEFAULT NULL,
  `register_date` datetime DEFAULT NULL,
  `major_id` int(11) NOT NULL,
  `user_token` char(40) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_email_UNIQUE` (`user_email`),
  KEY `fk_users_type_user1_idx` (`type_user_id`),
  KEY `fk_users_sub_departments1_idx` (`major_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_surname`, `user_email`, `user_password`, `user_status_id`, `type_user_id`, `register_date`, `major_id`, `user_token`) VALUES
(1, 'กฤติกาล', 'วีระกะลัส', 'krit@mail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'Y', 'A', '2018-09-12 00:00:00', 1, NULL),
(2, 'Krittikarn', 'Verakalas', 'krittikarn@mail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'Y', 'U', '2018-09-13 00:00:00', 1, NULL),
(3, 'Krittikarn3', 'Verakalas', 'vkrittikarn@mail.com', '2e19c8dbe45c3fabb7a018296e196e9705e40c46', 'Y', 'U', '2019-01-20 12:44:16', 1, 'N0ngPuE4AUNGPAlPSQSq00MjhFMsrOYgsW0DRuuU'),
(4, 'Krittikarn2', 'Verakalas2', 'vkrittikarn@gmail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'Y', 'U', '2019-02-18 11:37:06', 1, 'qkgzhfvs3g6Su4kshedveUk9Z2HOQcBTpgcddrMg'),
(6, 'dsafdfs', 'sfdafsdfs', 'v_Krittikarn@hotmail.com', NULL, 'N', 'U', '2019-04-04 16:06:55', 1, 'XuWDztqkz5R4bekKc5Atazp7yC3tNy3Qf3AoR7o4');

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `add_register_date_users` BEFORE INSERT ON `users` FOR EACH ROW BEGIN
	IF (NEW.register_date IS NULL) THEN
		SET   NEW.register_date  = NOW();
	END IF;
 END
$$
DELIMITER ;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `borrows`
--
ALTER TABLE `borrows`
  ADD CONSTRAINT `fk_borrows_borrow_status1` FOREIGN KEY (`borrow_status_id`) REFERENCES `borrow_status` (`borrow_status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_borrows_durable_article1` FOREIGN KEY (`durable_id`) REFERENCES `durable_article` (`durable_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_borrows_users1` FOREIGN KEY (`users_user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `buildings`
--
ALTER TABLE `buildings`
  ADD CONSTRAINT `fk_buildings_campus1` FOREIGN KEY (`campus_id`) REFERENCES `campus` (`campus_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_ibfk_1` FOREIGN KEY (`major_id`) REFERENCES `majors` (`major_id`);

--
-- Constraints for table `durable_article`
--
ALTER TABLE `durable_article`
  ADD CONSTRAINT `durable_article_ibfk_1` FOREIGN KEY (`borrow_status`) REFERENCES `borrow_status` (`borrow_status_id`),
  ADD CONSTRAINT `durable_article_ibfk_2` FOREIGN KEY (`major_id`) REFERENCES `majors` (`major_id`),
  ADD CONSTRAINT `durable_article_ibfk_3` FOREIGN KEY (`course_id`) REFERENCES `course` (`course_id`),
  ADD CONSTRAINT `durable_article_ibfk_4` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_durable_article_category1` FOREIGN KEY (`cat_id`) REFERENCES `category` (`cat_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_durable_article_durable_status` FOREIGN KEY (`durable_status_id`) REFERENCES `durable_status` (`durable_status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_durable_article_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `identify_log`
--
ALTER TABLE `identify_log`
  ADD CONSTRAINT `identify_log_ibfk_1` FOREIGN KEY (`durable_id`) REFERENCES `durable_article` (`durable_id`),
  ADD CONSTRAINT `identify_log_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `identify_log_ibfk_3` FOREIGN KEY (`identify_status_id`) REFERENCES `identify_status` (`identify_status_id`);

--
-- Constraints for table `majors`
--
ALTER TABLE `majors`
  ADD CONSTRAINT `fk_sub_departments_departments1` FOREIGN KEY (`faculty_id`) REFERENCES `faculties` (`faculty_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `problem_report`
--
ALTER TABLE `problem_report`
  ADD CONSTRAINT `fk_problem_report_durable_article1` FOREIGN KEY (`durable_id`) REFERENCES `durable_article` (`durable_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_problem_report_problem_status1` FOREIGN KEY (`problem_status_id`) REFERENCES `problem_status` (`problem_status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `fk_rooms_buildings1` FOREIGN KEY (`building_id`) REFERENCES `buildings` (`building_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `usage_log`
--
ALTER TABLE `usage_log`
  ADD CONSTRAINT `fk_usage_log_durable_article1` FOREIGN KEY (`durable_id`) REFERENCES `durable_article` (`durable_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_users_type_user1` FOREIGN KEY (`type_user_id`) REFERENCES `type_user` (`type_user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`major_id`) REFERENCES `majors` (`major_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

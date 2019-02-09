-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 09, 2019 at 07:23 PM
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

-- --------------------------------------------------------

--
-- Table structure for table `borrows`
--

CREATE TABLE `borrows` (
  `borrow_id` int(11) NOT NULL,
  `durable_id` int(11) NOT NULL,
  `borrow_date` datetime DEFAULT NULL,
  `due_date` date NOT NULL,
  `return_date` datetime DEFAULT NULL,
  `borrow_status_id` int(11) NOT NULL,
  `users_user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `borrows`
--

INSERT INTO `borrows` (`borrow_id`, `durable_id`, `borrow_date`, `due_date`, `return_date`, `borrow_status_id`, `users_user_id`) VALUES
(1, 1, '2019-02-03 23:47:42', '2019-02-07', '2019-02-07 00:00:00', 2, 1),
(13, 1, '2019-02-04 18:50:05', '2019-02-07', '2019-02-04 19:34:49', 2, 1),
(15, 1, '2019-02-04 19:35:13', '2019-02-08', '2019-02-04 19:35:18', 2, 1),
(16, 30, '2019-02-04 19:36:58', '2019-02-09', '2019-02-04 19:37:14', 2, 1),
(17, 30, '2019-02-05 13:32:10', '2019-02-10', '2019-02-05 13:32:21', 2, 1),
(18, 1, '2019-02-05 14:53:17', '2019-02-10', '2019-02-05 14:54:37', 2, 1),
(19, 1, '2019-02-09 15:17:27', '2019-02-28', '2019-02-09 15:20:06', 2, 1);

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

CREATE TABLE `borrow_detail` (
  `borrow_detail_id` int(11) NOT NULL,
  `borrow_id` int(11) NOT NULL,
  `durable_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `borrow_status`
--

CREATE TABLE `borrow_status` (
  `borrow_status_id` int(11) NOT NULL,
  `borrow_status_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `buildings` (
  `building_id` int(11) NOT NULL,
  `building_name` varchar(255) NOT NULL,
  `campus_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `buildings`
--

INSERT INTO `buildings` (`building_id`, `building_name`, `campus_id`) VALUES
(1, 'อาคาร 17', 1);

-- --------------------------------------------------------

--
-- Table structure for table `campus`
--

CREATE TABLE `campus` (
  `campus_id` int(11) NOT NULL,
  `campus_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `campus`
--

INSERT INTO `campus` (`campus_id`, `campus_name`) VALUES
(1, 'ศูนย์นนทบุรี');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `cat_id` int(11) NOT NULL,
  `cat_name` varchar(255) NOT NULL,
  `durable_age` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`cat_id`, `cat_name`, `durable_age`) VALUES
(1, 'ครุภัณฑ์คอมพิวเตอร์', 3),
(2, 'ครุภัณฑ์สํานักงาน', 3),
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
-- Table structure for table `durable_article`
--

CREATE TABLE `durable_article` (
  `durable_id` int(11) NOT NULL,
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
  `description` longtext,
  `durable_age` int(11) DEFAULT NULL,
  `scrap_value` double DEFAULT NULL,
  `can_borrow` char(1) DEFAULT NULL,
  `borrow_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `durable_article`
--

INSERT INTO `durable_article` (`durable_id`, `durable_code`, `durable_name`, `use_date`, `add_date`, `cat_id`, `picture_path`, `user_id`, `price`, `durable_status_id`, `room_id`, `description`, `durable_age`, `scrap_value`, `can_borrow`, `borrow_status`) VALUES
(1, 'วขน.งปม.คก. 010-109-387-2542', 'เก้าอี้', '2018-09-13', '2018-09-13 00:00:00', 1, 'noimg.jpg', 1, 100000, 1, 17071, 'test1', 3, 1, 'Y', 2),
(30, 'วขน.งปม.คก. 010-109-387-2544', 'เก้าอี้', '2019-01-31', '2019-01-31 14:18:03', 1, 'noimg.jpg', 1, 1, 1, 17071, '', 3, 0, 'Y', 2),
(31, 'วขน.งปม.คก. 010-109-387-2545', 'เก้าอี้', '2019-01-31', '2019-01-31 14:18:58', 1, 'noimg.jpg', 1, 1, 1, 17071, '', 3, 0, 'N', 2);

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

CREATE TABLE `durable_status` (
  `durable_status_id` int(11) NOT NULL,
  `durable_status_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `faculties` (
  `faculty_id` int(11) NOT NULL,
  `faculty_name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `faculties`
--

INSERT INTO `faculties` (`faculty_id`, `faculty_name`) VALUES
(1, 'วิทยาศาสตร์และเทคโนโลยี');

-- --------------------------------------------------------

--
-- Table structure for table `identify_log`
--

CREATE TABLE `identify_log` (
  `identify_log_id` int(11) NOT NULL,
  `durable_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `identify_datetime` datetime NOT NULL,
  `identify_status_id` int(11) NOT NULL
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

CREATE TABLE `identify_status` (
  `identify_status_id` int(11) NOT NULL,
  `identify_status_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `majors`
--

CREATE TABLE `majors` (
  `major_id` int(11) NOT NULL,
  `major_name` varchar(45) DEFAULT NULL,
  `faculty_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `majors`
--

INSERT INTO `majors` (`major_id`, `major_name`, `faculty_id`) VALUES
(1, 'วิทยาการคอมพิวเตอร์', 1);

-- --------------------------------------------------------

--
-- Table structure for table `problem_report`
--

CREATE TABLE `problem_report` (
  `problem_id` int(11) NOT NULL,
  `problem_topic` varchar(255) NOT NULL,
  `problem_detail` longtext,
  `durable_id` int(11) NOT NULL,
  `problem_status_id` int(11) NOT NULL,
  `report_datetime` datetime DEFAULT NULL,
  `reporter_id` varchar(45) DEFAULT NULL,
  `reporter_name` varchar(45) DEFAULT NULL,
  `reporter_surname` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `problem_report`
--

INSERT INTO `problem_report` (`problem_id`, `problem_topic`, `problem_detail`, `durable_id`, `problem_status_id`, `report_datetime`, `reporter_id`, `reporter_name`, `reporter_surname`) VALUES
(13, 'เก้าอี้ชำรุด', 'ล้อของเก้าอี้ เกิดการหลุด', 1, 2, '2019-01-15 12:43:32', '158405241003', 'กฤติกาล', 'วีระกะลัส'),
(17, 'เก้าอี้ชำรุด', 'เก้าอี้ชำรุด', 1, 1, '2019-01-15 16:03:12', '158405241003', 'กฤติกาล', 'วีระกะลัส'),
(18, '123123', '123', 1, 1, '2019-01-16 10:00:56', '123', '123', '123');

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

CREATE TABLE `problem_status` (
  `problem_status_id` int(11) NOT NULL,
  `problem_status_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE TABLE `rooms` (
  `room_id` int(11) NOT NULL,
  `room_name` varchar(255) DEFAULT NULL,
  `building_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_id`, `room_name`, `building_id`) VALUES
(17071, '17071', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sysconfig`
--

CREATE TABLE `sysconfig` (
  `syscode` char(3) NOT NULL COMMENT 'รหัส',
  `sysvalue` varchar(255) DEFAULT NULL COMMENT 'ค่า',
  `sysdesc` varchar(255) DEFAULT NULL COMMENT 'ราย'
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
('SYS', 'Durable Article Management System', 'ชื่อระบบ'),
('URL', 'http://127.0.0.1/ebook/', 'URL ebook');

-- --------------------------------------------------------

--
-- Table structure for table `type_user`
--

CREATE TABLE `type_user` (
  `type_user_id` char(1) NOT NULL,
  `type_user_name` varchar(255) DEFAULT NULL
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

CREATE TABLE `usage_log` (
  `usage_id` int(11) NOT NULL,
  `durable_id` int(11) NOT NULL,
  `usage_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(9, 31, '2019-02-05 04:51:27');

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

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `user_surname` varchar(255) DEFAULT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_password` varchar(40) DEFAULT NULL,
  `user_status_id` char(1) DEFAULT NULL,
  `type_user_id` char(1) DEFAULT NULL,
  `register_date` datetime DEFAULT NULL,
  `major_id` int(11) NOT NULL,
  `user_token` char(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_surname`, `user_email`, `user_password`, `user_status_id`, `type_user_id`, `register_date`, `major_id`, `user_token`) VALUES
(1, 'กฤติกาล', 'วีระกะลัส', 'krit@mail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'Y', 'A', '2018-09-12 00:00:00', 1, NULL),
(2, 'Krittikarn', 'Verakalas', 'krittikarn@mail.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 'Y', 'U', '2018-09-13 00:00:00', 1, NULL),
(3, 'Krittikarn3', 'Verakalas', 'vkrittikarn@gmail.com', '2e19c8dbe45c3fabb7a018296e196e9705e40c46', 'Y', 'U', '2019-01-20 12:44:16', 1, 'N0ngPuE4AUNGPAlPSQSq00MjhFMsrOYgsW0DRuuU');

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
-- Indexes for dumped tables
--

--
-- Indexes for table `borrows`
--
ALTER TABLE `borrows`
  ADD PRIMARY KEY (`borrow_id`),
  ADD KEY `fk_borrows_durable_article1_idx` (`durable_id`),
  ADD KEY `fk_borrows_borrow_status1_idx` (`borrow_status_id`),
  ADD KEY `fk_borrows_users1_idx` (`users_user_id`);

--
-- Indexes for table `borrow_status`
--
ALTER TABLE `borrow_status`
  ADD PRIMARY KEY (`borrow_status_id`);

--
-- Indexes for table `buildings`
--
ALTER TABLE `buildings`
  ADD PRIMARY KEY (`building_id`),
  ADD KEY `fk_buildings_campus1_idx` (`campus_id`);

--
-- Indexes for table `campus`
--
ALTER TABLE `campus`
  ADD PRIMARY KEY (`campus_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `durable_article`
--
ALTER TABLE `durable_article`
  ADD PRIMARY KEY (`durable_id`),
  ADD UNIQUE KEY `durable_code_UNIQUE` (`durable_code`),
  ADD KEY `fk_durable_article_durable_status_idx` (`durable_status_id`),
  ADD KEY `fk_durable_article_users1_idx` (`user_id`),
  ADD KEY `fk_durable_article_category1_idx` (`cat_id`),
  ADD KEY `fk_durable_article_rooms1_idx` (`room_id`),
  ADD KEY `borrow_status` (`borrow_status`);

--
-- Indexes for table `durable_status`
--
ALTER TABLE `durable_status`
  ADD PRIMARY KEY (`durable_status_id`);

--
-- Indexes for table `faculties`
--
ALTER TABLE `faculties`
  ADD PRIMARY KEY (`faculty_id`);

--
-- Indexes for table `identify_log`
--
ALTER TABLE `identify_log`
  ADD PRIMARY KEY (`identify_log_id`),
  ADD KEY `durable_id` (`durable_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `identify_status_id` (`identify_status_id`);

--
-- Indexes for table `identify_status`
--
ALTER TABLE `identify_status`
  ADD PRIMARY KEY (`identify_status_id`);

--
-- Indexes for table `majors`
--
ALTER TABLE `majors`
  ADD PRIMARY KEY (`major_id`),
  ADD KEY `fk_sub_departments_departments1_idx` (`faculty_id`);

--
-- Indexes for table `problem_report`
--
ALTER TABLE `problem_report`
  ADD PRIMARY KEY (`problem_id`),
  ADD KEY `fk_problem_report_durable_article1_idx` (`durable_id`),
  ADD KEY `fk_problem_report_problem_status1_idx` (`problem_status_id`);

--
-- Indexes for table `problem_status`
--
ALTER TABLE `problem_status`
  ADD PRIMARY KEY (`problem_status_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_id`),
  ADD KEY `fk_rooms_buildings1_idx` (`building_id`);

--
-- Indexes for table `sysconfig`
--
ALTER TABLE `sysconfig`
  ADD PRIMARY KEY (`syscode`);

--
-- Indexes for table `type_user`
--
ALTER TABLE `type_user`
  ADD PRIMARY KEY (`type_user_id`);

--
-- Indexes for table `usage_log`
--
ALTER TABLE `usage_log`
  ADD PRIMARY KEY (`usage_id`),
  ADD KEY `fk_usage_log_durable_article1_idx` (`durable_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email_UNIQUE` (`user_email`),
  ADD KEY `fk_users_type_user1_idx` (`type_user_id`),
  ADD KEY `fk_users_sub_departments1_idx` (`major_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `borrows`
--
ALTER TABLE `borrows`
  MODIFY `borrow_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `borrow_status`
--
ALTER TABLE `borrow_status`
  MODIFY `borrow_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `buildings`
--
ALTER TABLE `buildings`
  MODIFY `building_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `campus`
--
ALTER TABLE `campus`
  MODIFY `campus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `durable_article`
--
ALTER TABLE `durable_article`
  MODIFY `durable_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `durable_status`
--
ALTER TABLE `durable_status`
  MODIFY `durable_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `faculties`
--
ALTER TABLE `faculties`
  MODIFY `faculty_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `identify_log`
--
ALTER TABLE `identify_log`
  MODIFY `identify_log_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `identify_status`
--
ALTER TABLE `identify_status`
  MODIFY `identify_status_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `majors`
--
ALTER TABLE `majors`
  MODIFY `major_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `problem_report`
--
ALTER TABLE `problem_report`
  MODIFY `problem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `problem_status`
--
ALTER TABLE `problem_status`
  MODIFY `problem_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `usage_log`
--
ALTER TABLE `usage_log`
  MODIFY `usage_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

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
-- Constraints for table `durable_article`
--
ALTER TABLE `durable_article`
  ADD CONSTRAINT `durable_article_ibfk_1` FOREIGN KEY (`borrow_status`) REFERENCES `borrow_status` (`borrow_status_id`),
  ADD CONSTRAINT `fk_durable_article_category1` FOREIGN KEY (`cat_id`) REFERENCES `category` (`cat_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_durable_article_durable_status` FOREIGN KEY (`durable_status_id`) REFERENCES `durable_status` (`durable_status_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_durable_article_rooms1` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
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

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2026 at 03:05 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `job_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `city_name` varchar(100) DEFAULT 'All',
  `township` varchar(100) DEFAULT 'Meiktila'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `password`, `city_name`, `township`) VALUES
(1, 'Khaing Admin', 'shwe123@gmail.com', 'shwe123', 'All', 'All'),
(2, 'Yangon Admin', 'ygn@gmail.com', '123456', 'Yangon', 'Yangon'),
(3, 'Mandalay Admin', 'mdy@gmail.com', '123456', 'Mandalay', 'Mandalay'),
(4, 'Naypyitaw Admin', 'npt@gmail.com', '123456', 'Naypyitaw', 'Naypyitaw'),
(5, 'Taunggyi Admin', 'tgi@gmail.com', '123456', 'Taunggyi', 'Taunggyi'),
(6, 'Meiktila Admin', 'mtl@gmail.com', '123456', 'Meiktila', 'Meiktila');

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

CREATE TABLE `application` (
  `id` int(11) NOT NULL,
  `job_id` int(11) DEFAULT NULL,
  `applicant_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `township` varchar(100) DEFAULT NULL,
  `applicant_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `about_me` text DEFAULT NULL,
  `cv_file` varchar(255) DEFAULT NULL,
  `job_title` varchar(100) DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `experience` varchar(50) DEFAULT NULL,
  `university` varchar(255) DEFAULT NULL,
  `bachelor` varchar(100) DEFAULT NULL,
  `degree` varchar(255) DEFAULT NULL,
  `major` varchar(255) DEFAULT NULL,
  `skills` text DEFAULT NULL,
  `applied_date` date DEFAULT NULL,
  `status` enum('Pending','Approved','Rejected') DEFAULT 'Pending',
  `job_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`id`, `user_id`, `township`, `applicant_name`, `email`, `phone`, `address`, `about_me`, `cv_file`, `job_title`, `company_name`, `experience`, `university`, `bachelor`, `degree`, `major`, `skills`, `applied_date`, `status`, `job_id`) VALUES
(1, NULL, NULL, 'Thida Oo', 'thida@email.com', NULL, NULL, NULL, NULL, 'Senior Software Engineer', NULL, '5 years', NULL, NULL, NULL, NULL, NULL, '2026-01-16', 'Approved', NULL),
(2, NULL, NULL, 'Su Su', 'susu@email.com', NULL, NULL, NULL, NULL, 'Marketing Manager', NULL, '3 years', NULL, NULL, NULL, NULL, NULL, '2026-01-18', 'Approved', NULL),
(3, NULL, NULL, 'Zaw Zaw', 'zaw@email.com', NULL, NULL, NULL, NULL, 'Graphic Designer', NULL, '2 years', NULL, NULL, NULL, NULL, NULL, '2026-01-17', 'Approved', NULL),
(4, NULL, NULL, 'Shwe Yee Win', 'shweyeehtetwint2411@gmail.com', '09123456', 'Meiktila', 'want to be a cybersecurity developer', '1770545977_download (3).jpg', 'Bank Teller', NULL, 'Certificate from the forage', NULL, NULL, NULL, NULL, NULL, '2026-02-08', 'Approved', NULL),
(5, NULL, NULL, 'Shwe Yee Win', 'shweyeehtetwint2411@gmail.com', '0912345678', 'Meiktila', 'want to be a fullstack developer', '1770556256_30s businesswoman in white background _ Premium AI-generated PSD.jpg', 'Bank Teller', NULL, 'heuek', 'UCSMTLA', NULL, 'B.C.Sc', 'Computer Science', 'Python', '2026-02-08', 'Rejected', 0),
(6, NULL, NULL, 'HelenaIrish', 'shweyeehtetwint2411@gmail.com', '0926483392', 'Meiktila', 'heiw', '1770557228_30s businesswoman in white background _ Premium AI-generated PSD.jpg', 'Civil Engineer', NULL, '6 Years', NULL, NULL, NULL, NULL, NULL, '2026-02-08', 'Rejected', NULL),
(7, NULL, NULL, 'Shwe Yee Win', 'shweyeehtetwint2411@gmail.com', '091273939383', 'HDje', 'aheye', '1770557482_30s businesswoman in white background _ Premium AI-generated PSD.jpg', 'Civil Engineer', NULL, 'hsyw', NULL, NULL, NULL, NULL, NULL, '2026-02-08', 'Approved', NULL),
(8, NULL, NULL, 'Shwe Yee Win', 'shweyeehtetwint2411@gmail.com', '09123456', 'mg', 'fuuuuuu', '1770558016_30s businesswoman in white background _ Premium AI-generated PSD.jpg', 'Bank Teller', NULL, 'dggg', NULL, NULL, NULL, NULL, NULL, '2026-02-08', 'Approved', 0),
(9, NULL, NULL, 'Shwe Yee Win', 'shweyiwin507@gmail.com', '0945762346', 'Meiktila', 'hwuw', '1770954780_download (8).jpg', 'Graphic Designer', NULL, '6 years', NULL, NULL, NULL, NULL, NULL, '2026-02-13', 'Approved', NULL),
(10, NULL, NULL, 'Shwe Yee Win', 'shweyiwin507@gmail.com', '0923456789', 'Meiktila', 'hwuwu', '1770955948_30s businesswoman in white background _ Premium AI-generated PSD.jpg', 'Bank Teller', 'KBZ', '5 years', NULL, NULL, NULL, NULL, NULL, '2026-02-13', 'Rejected', NULL),
(11, NULL, NULL, 'Shwe Yee Win', 'shweyiwin507@gmail.com', '09123456789', 'Yangon', 'want to be a developer', '1770956960_30s businesswoman in white background _ Premium AI-generated PSD.jpg', 'Civil Engineer', 'Myanmar Net', '3 years', NULL, NULL, NULL, NULL, NULL, '2026-02-13', 'Approved', NULL),
(12, NULL, NULL, 'Shwe Yee Win', 'shweyeehtetwint2411@gmail.com', '09123456789', 'Mandalay', 'wjowhei', '1770985799_30s businesswoman in white background _ Premium AI-generated PSD.jpg', 'Civil Engineer', 'KBZ Bank', '3 years', NULL, NULL, NULL, NULL, NULL, '2026-02-13', 'Approved', NULL),
(13, NULL, NULL, 'Shwe Yee', 'shweyiwin507@gmail.com', '09 123456789', 'Meiktila', 'whiwowi', '1771149603_30s businesswoman in white background _ Premium AI-generated PSD.jpg', 'Civil Engineer', 'Kumo Solutions', '3 years', NULL, NULL, NULL, NULL, NULL, '2026-02-15', 'Rejected', NULL),
(14, 0, 'Mandalay', 'Shwe Yee Win', 'shweyeehtetwint2411@gmail.com', '0912345678', 'Meiktila', 'want to be software engineer', '1771169537_Screenshot (9).png', 'Civil Engineer', 'T-WORK SYSTEM', 'weew', 'UCSMTLA', 'B.C.Sc', NULL, 'Computer Science', 'python', '2026-02-15', '', NULL),
(15, 0, 'Mandalay', 'Shwe Yee Win', 'shweyeehtetwint2411@gmail.com', '0912345678', 'Meiktila', 'want to be software engineer', '1771169831_Screenshot (9).png', 'Civil Engineer', 'T-WORK SYSTEM', 'weew', 'UCSMTLA', 'B.C.Sc', NULL, 'Computer Science', 'python', '2026-02-15', '', NULL),
(16, NULL, NULL, 'Shwe Yee Win', 'shweyeehtetwint2411@gmail.com', '0912345678', 'Meiktila', 'want to be software engineer', '1771170199_Screenshot (9).png', 'Civil Engineer', 'T-WORK SYSTEM', 'weew', 'UCSMTLA', 'B.C.Sc', NULL, 'Computer Science', 'python', '2026-02-15', 'Rejected', NULL),
(17, 0, 'Mandalay', 'Shwe Yee Win', 'shweyeehtetwint2411@gmail.com', '091273939383', 'mgyyy', 'rt', '1771170613_Screenshot (11).png', 'Bank Teller', '', 'yuu', 'UCSM', 'B.C.Tech', NULL, 'Computer Science', 'jh', '2026-02-15', 'Pending', NULL),
(18, 0, 'Mandalay', 'Shwe Yee Win', 'shweyeehtetwint2411@gmail.com', '0926483392', 'mgyyy', 'www', '1771173544_Screenshot (11).png', 'Civil Engineer', 'Kumo Solutions', 'wee', 'UCSM', 'B.C.Tech', NULL, 'computer technology', 'ww', '2026-02-15', 'Pending', NULL),
(19, 0, 'Yangon', 'Chit San Htay', 'chitsanhtay1124@gamil.com', '09-123456789', 'Meiktila', 'want to be a developer', '1771231534_download (2).jpg', 'DB Adminstrator', 'Global New Wave', 'worked for 2 years in KMD', 'UCSMTLA', 'B.C.Sc', NULL, 'Computer Science', 'PHP, Database', '2026-02-16', 'Approved', NULL),
(20, 0, 'Naypyitaw', 'Moe Thet Wai', 'moethet@gmail.com', '0926483392', 'Yangon', 'want to be a fullstack developer', '1771233739_30s businesswoman in white background _ Premium AI-generated PSD.jpg', 'Junior Web Dev', 'Info Sys (Myanmar)', '1 years ', 'UCSMTLA', 'B.C.Sc', NULL, 'Computer Science', 'Html,CSS, JS,PHP', '2026-02-16', 'Pending', NULL),
(21, 0, 'Naypyitaw', 'Yadanar', 'yadanar@gmail.com', '0945762346', 'Meiktila', 'want to be developer', '1771234258_m.jpg', 'Web Developer', 'Amazing Tech TGI', '2 years', 'UCSMTLA', 'B.C.Sc', NULL, 'Computer Science', 'Python', '2026-02-16', 'Pending', NULL),
(22, 0, 'Naypyitaw', 'Yadanar', 'yadanar@gmail.com', '0945762346', 'Meiktila', 'want to be developer', '1771234357_m.jpg', 'Web Developer', 'Amazing Tech TGI', '2 years', 'UCSMTLA', 'B.C.Sc', NULL, 'Computer Science', 'Python', '2026-02-16', 'Pending', NULL),
(23, 0, 'Taunggyi', 'Yadanar', 'yadanar@gmail.com', '09123456357', 'Taunggyi', 'want to be a developer', '1771234882_m.jpg', 'Web Developer', 'Amazing Tech TGI', '2 years', 'UCSMTLA', 'B.C.Sc', NULL, 'Computer Science', 'Python', '2026-02-16', 'Pending', NULL),
(24, 0, 'Taunggyi', 'Yadanar', 'yadanar@gmail.com', '09123456357', 'Taunggyi', 'want to be a developer', '1771234935_m.jpg', 'Web Developer', 'Amazing Tech TGI', '2 years', 'UCSMTLA', 'B.C.Sc', NULL, 'Computer Science', 'Python', '2026-02-16', 'Pending', 56),
(25, 0, 'Yangon', 'Shwe Yee Win', 'shweyeehtetwint2411@gmail.com', '0912345678', 'Natmauk', 'want to be a cybersecurity developer', '1771235446_15.jpg', 'Graphic Designer', 'Amazing Tech TGI', 'worked for 3 years in the Forage', 'UCSY', 'B.C.Sc', NULL, 'Computer Science', 'Python, C1 level for English', '2026-02-16', 'Pending', NULL),
(26, 0, 'Yangon', 'Htet Arkar Linn', 'arkar@gmail.com', '0945762346', 'Yangon', 'want to be a fullstack developer', '1771323351_30s businesswoman in white background _ Premium AI-generated PSD.jpg', 'Junior Web Dev', 'Cyber King Co., Ltd.', 'worked for 3 years in the Forage', 'UCSY', 'B.C.Sc', NULL, 'Computer Science', 'Python, PHP', '2026-02-17', 'Pending', NULL),
(27, 0, 'Yangon', 'Htet Arkar Linn', 'arkar@gmail.com', '0926483392', 'Yangon', 'want to be a developer', '1771324282_30s businesswoman in white background _ Premium AI-generated PSD.jpg', 'Scrum Master', 'Global New Wave', '2 years', 'UCSY', NULL, '', 'Computer Science', 'Mysql,PHP', '2026-02-17', 'Pending', NULL),
(28, 0, 'Yangon', 'Htet Arkar Linn', 'arkar@gmail.com', '0945762346', 'Yangon', 'want to be a dveloper', '1771324522_15.jpg', 'Junior Web Dev', 'Cyber King Co., Ltd.', '1 year', 'UCSY', NULL, '', 'Computer Science', 'PHP,JS', '2026-02-17', 'Pending', NULL),
(29, 0, 'Yangon', 'Nyein', 'nyein@gmail.com', '0926483392', 'Meiktila', '............', '1771324739_30s businesswoman in white background _ Premium AI-generated PSD.jpg', 'Civil Engineer', 'DIR-ACE Tech', '2 years', 'UCSMTLA', NULL, 'B.C.Tech', 'computer technology', 'Database,JS', '2026-02-17', 'Pending', 0),
(30, 0, 'Mandalay', 'Shwe Yee Win', 'shweyeehtetwint2411@gmail.com', '0912345678', 'mgyyy', '........', '1771325054_30s businesswoman in white background _ Premium AI-generated PSD.jpg', 'Civil Engineer', 'Global New Wave', 'w', 'UCSY', NULL, 'B.C.Tech', 'computer technology', 'hss', '2026-02-17', 'Pending', 0),
(31, 0, 'Yangon', 'Sandar Soe', 'sandar@gmail.com', '0912345678', 'Natmauk', '.ss', '1771325310_30s businesswoman in white background _ Premium AI-generated PSD.jpg', 'Cyber Security', 'Global New Wave', 'wh', 'UCSMTLA', NULL, 'B.C.Tech', 'computer technology', 'Sjjiw', '2026-02-17', 'Pending', 0),
(32, 0, 'Naypyitaw', 'Wang Yibo', 'wangyibo@gmail.com', '09234761265', 'Mandalay', 'want to be a software Engineer', '1771336045_l.jpg', 'Software Engineer', 'Amazing Tech TGI', '2 years ........................................', 'UIT', NULL, 'B.I.S', 'Computer Science', 'Python,JS,J2EE', '2026-02-17', 'Pending', 0),
(33, 0, 'Meiktila', 'Mee Mee', 'mm@gmail.com', '09127393933', 'Meiktila', 'interest in cyber security', '1771338343_download (2).jpg', 'Cyber Security Developer', 'Myanmar Net', 'mmmm.............', 'UCSMTLA', NULL, 'B.C.Tech', 'computer technology', 'IT,J2EE', '2026-02-17', 'Pending', 0),
(34, 0, 'Meiktila', 'Nyein Nyein Ei', 'shweyiwin507@gmail.com', '091273939383', 'Yangon', 'sssssssss', '1771339329_15.jpg', 'Cyber Security Developer', 'Myanmar Net', '1 year...........', 'UCSMTLA', NULL, 'B.C.Tech', 'computer technology', 'Python, PHP,J2EE', '2026-02-17', 'Pending', NULL),
(35, 0, 'All City', 'Htet Arkar Linn', 'arkar@gmail.com', '0945762346', 'Yangon', '..........', '1771339649_c1.jpg', 'Cyber Security Developer', 'Myanmar Net', '.......', 'UCSY', NULL, 'B.C.Tech', 'computer technology', 'J2EE', '2026-02-17', 'Pending', 60),
(36, 0, 'Meiktila', 'Htet Arkar Linn', 'arkar@gmail.com', '0945762346', 'yangon', 'sssssssss', '1771340027_15.jpg', 'Cyber Security Developer', 'Myanmar Net', 'wwwwwwwww', 'UCSY', NULL, 'B.C.Tech', 'computer technology', 'wwwwww', '2026-02-17', 'Pending', 60),
(37, 0, 'Taunggyi', 'Zon Moe Pyae', 'zmp@gmail.com', '09123456443', 'Mandalay', 'wwssssssss', '1771340406_book6.jpg', 'Software Engineer', 'Amazing Tech TGI', 'wwwwww', 'UCSM', NULL, 'B.C.Tech', 'computer technology', 'ffff', '2026-02-17', 'Approved', NULL),
(38, 0, 'Taunggyi', 'Zon Moe Pyae', 'zmp@gmail.com', '0912345633', 'Mandalay', 'vvvvvvvvvv', '1771340692_book1.jpg', 'Software Engineer', 'Amazing Tech TGI', 'w', 'UCSMTLA', NULL, 'B.C.Tech', 'computer technology', 'ssssssss', '2026-02-17', 'Rejected', NULL),
(39, 0, 'Yangon', 'Khaing Mar Htay', 'Khaingmar123098@gmail.com', '0945762346', 'Mandalay', 'h...........', '1771400969_30s businesswoman in white background _ Premium AI-generated PSD.jpg', 'Hacker', 'NTT DATA Myanmar', 'jjjjjjjjjjjjjjj,.......', 'UCSMTLA', NULL, 'B.C.Sc', 'Computer Science', '..............', '2026-02-18', 'Rejected', NULL),
(40, 0, 'Yangon', 'Moe Thet Wai', 'moet00154@gmail.com', '0926483392', 'Meiktila', '.........', '1771401454_30s businesswoman in white background _ Premium AI-generated PSD.jpg', 'Hacker', 'NTT DATA Myanmar', ',,,,,,,,,', 'UCSMTLA', NULL, 'B.C.Sc', 'Computer Science', '.........', '2026-02-18', 'Rejected', NULL),
(41, 0, 'Yangon', 'Moe Thet Wai', 'moet00154@gmail.com', '0945762346', 'Meiktila', 'sssssssss', '1771422072_30s businesswoman in white background _ Premium AI-generated PSD.jpg', 'Hacker', 'NTT DATA Myanmar', 'eeeeeeeeeee', 'UCSMTLA', NULL, 'B.C.Sc', 'Computer Science', 'dddddddddddd', '2026-02-18', 'Rejected', 61),
(42, 0, 'Yangon', 'Zon Moe Pyae', 'zmp@gmail.com', '0945762346', 'Naypyitaw', 'fffffff', '1771422941_30s businesswoman in white background _ Premium AI-generated PSD.jpg', 'Cyber Security', 'Global New Wave', 'sssssss', 'UCSMTLA', 'B.C.Tech', NULL, 'computer technology', 'eeeeeeee', '2026-02-18', 'Pending', 57);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `icon_class` varchar(50) DEFAULT 'fa-briefcase',
  `active_jobs` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `icon_class`, `active_jobs`, `created_at`) VALUES
(3, 'Design', 'fa-palette', 28, '2026-01-20 05:03:02'),
(4, 'Finance', 'fa-sack-dollar', 23, '2026-01-20 05:03:02'),
(6, 'Healthcare', 'fa-hospital', 19, '2026-01-20 05:03:02'),
(7, 'Education', 'fa-book-bookmark', 27, '2026-01-20 05:03:02'),
(9, 'Education', 'fa-book-bookmark', 7, '2026-01-20 05:29:23'),
(10, 'Technology', 'fa-laptop', 7, '2026-01-20 05:29:55'),
(11, 'Technology', 'fa-laptop', 7, '2026-01-20 05:30:43'),
(12, 'Technology', 'fa-laptop', 2, '2026-01-20 05:43:01'),
(14, 'Technology', 'fa-laptop', 1, '2026-01-21 06:01:55'),
(17, 'e', 'fa-book-bookmark', 3, '2026-01-22 19:56:25');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` int(11) NOT NULL,
  `job_title` varchar(255) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `type` enum('Full-time','Part-time','Internship') DEFAULT 'Full-time',
  `salary` varchar(255) DEFAULT NULL,
  `age` varchar(255) DEFAULT NULL,
  `status` enum('Approved','Pending','Rejected') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `job_title`, `company`, `location`, `type`, `salary`, `age`, `status`, `created_at`) VALUES
(41, 'Junior Software Developer', 'Global Marketing Co.', 'Mandalay', 'Full-time', NULL, NULL, 'Approved', '2026-01-22 10:21:29'),
(46, 'web Developer', 'KBZ', 'Mandalay', 'Part-time', NULL, NULL, 'Rejected', '2026-01-22 11:27:28'),
(47, 'Software Developer', 'Global Marketing Co.', 'Mandalay', 'Part-time', NULL, NULL, 'Approved', '2026-01-22 11:31:06'),
(53, 'DB Adminstrator', 'Global New Wave', 'Yangon', 'Part-time', NULL, NULL, 'Approved', '2026-02-16 08:47:57'),
(55, 'Hacker', 'Cyber King', 'Yangon', 'Full-time', NULL, NULL, 'Pending', '2026-02-17 09:42:15'),
(56, 'Junior Web Dev', 'Cyber King Co., Ltd.', 'Yangon', 'Full-time', '450,000', '20-26', 'Approved', '2026-02-17 10:02:28'),
(57, 'Cyber Security', 'Global New Wave', 'Yangon', 'Full-time', '500,000', '24-32', 'Approved', '2026-02-17 10:42:57'),
(58, 'Software Engineer', 'Amazing Tech TGI', 'Taunggyi', 'Full-time', '850,000', '21-27', 'Approved', '2026-02-17 13:37:11'),
(59, 'Python Developer', 'Linn IT Solution', 'Naypyitaw', 'Internship', '350,000', '20-25', 'Approved', '2026-02-17 14:09:19'),
(60, 'Cyber Security Developer', 'Myanmar Net', 'Meiktila', '', '400,000', '20-33', 'Approved', '2026-02-17 14:23:03'),
(61, 'Hacker', 'NTT DATA Myanmar', 'Yangon', 'Full-time', '500,000', '20-25', 'Approved', '2026-02-18 07:35:22');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `message` text NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `message`, `type`, `created_at`) VALUES
(10, 'Admin updated job details: Software Developer (MPT)', 'job', '2026-01-23 07:12:28'),
(11, 'Admin approved a new job post: Software Developer', 'job', '2026-01-23 07:13:50'),
(12, 'Admin rejected the job post: web Developer', 'job', '2026-01-23 07:16:03'),
(13, 'Admin deleted a user: Khayay (ID: 27)', 'user', '2026-01-23 07:18:25'),
(14, 'Admin updated details for user: Khayay (Jobseeker)', 'user', '2026-01-23 07:21:00'),
(15, 'Admin updated the category: Design', 'category', '2026-01-23 07:21:19'),
(16, 'Admin deleted a category: Technology', 'category', '2026-01-23 07:21:29'),
(17, 'Admin deleted a category: Design', 'category', '2026-01-23 07:21:34'),
(18, 'Admin security credentials (email/password) were changed', 'password', '2026-01-23 07:23:41'),
(19, 'Admin updated general system settings', 'info', '2026-01-23 07:24:12'),
(20, 'Khaing Admin has logged out of the system', 'info', '2026-01-23 07:25:47'),
(21, 'Khaing Admin has logged out of the system', 'info', '2026-01-23 07:27:56'),
(22, 'Khaing Admin has logged into the admin panel', 'info', '2026-01-23 07:28:19'),
(23, 'Khaing Admin has logged into the admin panel', 'info', '2026-02-08 10:21:29'),
(24, 'Khaing Admin has logged out of the system', 'info', '2026-02-08 10:22:27'),
(25, 'Khaing Admin has logged into the admin panel', 'info', '2026-02-08 10:22:43'),
(26, 'Khaing Admin has logged into the admin panel', 'info', '2026-02-08 13:20:29'),
(27, 'Khaing Admin has logged into the admin panel', 'info', '2026-02-13 04:05:45'),
(28, 'Khaing Admin has logged into the admin panel', 'info', '2026-02-13 12:31:15'),
(29, 'Khaing Admin has logged into the admin panel', 'info', '2026-02-14 12:28:11'),
(30, 'Khaing Admin has logged into the admin panel', 'info', '2026-02-14 12:28:45'),
(31, 'Admin has logged out of the system', 'info', '2026-02-14 12:34:24'),
(32, 'Khaing Admin has logged into the admin panel', 'info', '2026-02-14 12:35:19'),
(33, 'Khaing Admin has logged into the admin panel', 'info', '2026-02-14 13:01:02'),
(34, 'Khaing Admin has logged into the admin panel', 'info', '2026-02-14 15:33:20'),
(35, 'Admin deleted a user: Unknown User (ID: 2)', 'user', '2026-02-14 16:32:28'),
(36, 'Admin deleted a user: Unknown User (ID: 1)', 'user', '2026-02-14 16:32:34'),
(37, 'Khaing Admin has logged into the admin panel', 'info', '2026-02-15 06:25:12'),
(38, 'Khaing Admin has logged into the admin panel', 'info', '2026-02-15 06:26:57'),
(39, 'Yangon Admin has logged into the admin panel', 'info', '2026-02-15 07:28:54'),
(40, 'Mandalay Admin has logged into the admin panel', 'info', '2026-02-15 07:30:49'),
(41, 'Yangon Admin has logged into the admin panel', 'info', '2026-02-15 07:49:15'),
(42, 'Khaing Admin has logged into the admin panel', 'info', '2026-02-15 10:06:50'),
(43, 'Yangon Admin has logged into the admin panel', 'info', '2026-02-15 10:10:29'),
(44, 'New job posted: Hacker at KMD', 'job', '2026-02-15 10:16:13'),
(45, 'Khaing Admin has logged into the admin panel', 'info', '2026-02-15 10:32:53'),
(46, 'Yangon Admin has logged into the admin panel', 'info', '2026-02-15 15:24:56'),
(47, 'Meiktila Admin has logged into the admin panel', 'info', '2026-02-15 16:12:56'),
(48, 'Admin has logged out of the system', 'info', '2026-02-15 16:21:56'),
(49, 'Yangon Admin has logged into the admin panel', 'info', '2026-02-15 16:22:11'),
(50, 'Admin has logged out of the system', 'info', '2026-02-15 16:28:25'),
(51, 'Mandalay Admin has logged into the admin panel', 'info', '2026-02-15 16:28:35'),
(52, 'Admin has logged out of the system', 'info', '2026-02-15 16:29:30'),
(53, 'Meiktila Admin has logged into the admin panel', 'info', '2026-02-15 16:29:39'),
(54, 'Admin has logged out of the system', 'info', '2026-02-15 16:35:05'),
(55, 'Yangon Admin has logged into the admin panel', 'info', '2026-02-15 16:35:15'),
(56, 'Admin has logged out of the system', 'info', '2026-02-15 16:35:57'),
(57, 'Khaing Admin has logged into the admin panel', 'info', '2026-02-15 16:36:14'),
(58, 'Meiktila Admin has logged into the admin panel', 'info', '2026-02-15 16:41:11'),
(59, 'Yangon Admin has logged into the admin panel', 'info', '2026-02-16 08:27:42'),
(60, 'Admin has logged out of the system', 'info', '2026-02-16 08:32:22'),
(61, 'Khaing Admin has logged into the admin panel', 'info', '2026-02-16 08:32:33'),
(62, 'Admin has logged out of the system', 'info', '2026-02-16 08:32:54'),
(63, 'Mandalay Admin has logged into the admin panel', 'info', '2026-02-16 08:33:02'),
(64, 'Admin has logged out of the system', 'info', '2026-02-16 08:33:15'),
(65, 'Meiktila Admin has logged into the admin panel', 'info', '2026-02-16 08:33:25'),
(66, 'Admin has logged out of the system', 'info', '2026-02-16 08:33:44'),
(67, 'Taunggyi Admin has logged into the admin panel', 'info', '2026-02-16 08:34:09'),
(68, 'Admin has logged out of the system', 'info', '2026-02-16 08:34:37'),
(69, 'Naypyitaw Admin has logged into the admin panel', 'info', '2026-02-16 08:35:01'),
(70, 'Yangon Admin has logged into the admin panel', 'info', '2026-02-16 08:46:17'),
(71, 'New job posted: DB Adminstrator at Global New Wave', 'job', '2026-02-16 08:47:57'),
(72, 'Admin approved a new job post: DB Adminstrator', 'job', '2026-02-16 08:52:55'),
(73, 'Admin updated details for user: Shwe Yee Win (Jobseeker)', 'user', '2026-02-16 09:00:16'),
(74, 'Khaing Admin has logged into the admin panel', 'info', '2026-02-16 09:28:19'),
(75, 'Yangon Admin has logged into the admin panel', 'info', '2026-02-16 09:42:45'),
(76, 'Admin has logged out of the system', 'info', '2026-02-16 09:43:34'),
(77, 'Taunggyi Admin has logged into the admin panel', 'info', '2026-02-16 09:43:43'),
(78, 'Yangon Admin has logged into the admin panel', 'info', '2026-02-16 09:48:15'),
(79, 'Admin has logged out of the system', 'info', '2026-02-16 09:52:16'),
(80, 'Taunggyi Admin has logged into the admin panel', 'info', '2026-02-16 09:52:24'),
(81, 'New job posted: Web Developer at ITSN', 'job', '2026-02-16 09:53:08'),
(82, 'Khaing Admin has logged into the admin panel', 'info', '2026-02-16 10:06:05'),
(83, 'Admin deleted a user: Unknown User (ID: 5)', 'user', '2026-02-16 10:08:35'),
(84, 'Admin deleted a user: Khaing Admin (ID: 9)', 'user', '2026-02-16 10:08:45'),
(85, 'Yangon Admin has logged into the admin panel', 'info', '2026-02-17 08:37:51'),
(86, 'Admin updated details for user: Shwe Yee Win (Jobseeker)', 'user', '2026-02-17 09:10:56'),
(87, 'Admin added a new user: Htet Arkar Linn (Employer)', 'user', '2026-02-17 09:12:46'),
(88, 'Admin added a new user: Htet Arkar Linn (Employer)', 'user', '2026-02-17 09:21:02'),
(89, 'Admin added a new user: Htet Arkar Linn (Employer)', 'user', '2026-02-17 09:23:38'),
(90, 'Admin added a new user: Htet Arkar Linn (Employer)', 'user', '2026-02-17 09:26:02'),
(91, 'New job posted: Hacker at Cyber King', 'job', '2026-02-17 09:42:15'),
(92, 'Khaing Admin has logged into the admin panel', 'info', '2026-02-17 13:09:54'),
(93, 'Admin deleted a user: Htet Arkar Linn (ID: 16)', 'user', '2026-02-17 13:10:19'),
(94, 'Admin deleted a user: Htet Arkar Linn (ID: 15)', 'user', '2026-02-17 13:10:23'),
(95, 'Admin deleted a user: Unknown User (ID: 17)', 'user', '2026-02-17 13:11:19'),
(96, 'Admin deleted a user: Unknown User (ID: 10)', 'user', '2026-02-17 13:18:06'),
(97, 'Admin deleted a user: Shwe Yee (ID: 11)', 'user', '2026-02-17 13:18:16'),
(98, 'Admin deleted a user: Shwe Yee Win (ID: 3)', 'user', '2026-02-17 13:18:21'),
(99, 'Khaing Admin has logged into the admin panel', 'info', '2026-02-17 13:28:24'),
(100, 'Admin has logged out of the system', 'info', '2026-02-17 13:35:37'),
(101, 'Taunggyi Admin has logged into the admin panel', 'info', '2026-02-17 13:35:47'),
(102, 'Admin updated job details: Software Engineer (Amazing Tech TGI)', 'job', '2026-02-17 13:40:43'),
(103, 'Naypyitaw Admin has logged into the admin panel', 'info', '2026-02-17 13:47:51'),
(104, 'Admin has logged out of the system', 'info', '2026-02-17 14:20:09'),
(105, 'Meiktila Admin has logged into the admin panel', 'info', '2026-02-17 14:20:18'),
(106, 'Meiktila Admin has logged into the admin panel', 'info', '2026-02-17 14:26:07'),
(107, 'Admin has logged out of the system', 'info', '2026-02-17 14:52:07'),
(108, 'Khaing Admin has logged into the admin panel', 'info', '2026-02-17 14:52:17'),
(109, 'Admin has logged out of the system', 'info', '2026-02-17 14:54:11'),
(110, 'Meiktila Admin has logged into the admin panel', 'info', '2026-02-17 14:54:19'),
(111, 'Yangon Admin has logged into the admin panel', 'info', '2026-02-18 07:30:16'),
(112, 'Admin has logged out of the system', 'info', '2026-02-18 07:30:59'),
(113, 'Khaing Admin has logged into the admin panel', 'info', '2026-02-18 07:31:13'),
(114, 'Admin has logged out of the system', 'info', '2026-02-18 07:33:47'),
(115, 'Yangon Admin has logged into the admin panel', 'info', '2026-02-18 07:34:02'),
(116, 'Khaing Admin has logged into the admin panel', 'info', '2026-02-18 13:36:10'),
(117, 'Khaing Admin has logged into the admin panel', 'info', '2026-02-18 13:58:56');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `site_name` varchar(255) DEFAULT NULL,
  `contact_email` varchar(255) DEFAULT NULL,
  `contact_phone` varchar(255) DEFAULT NULL,
  `notify_job` tinyint(1) DEFAULT 1,
  `notify_app` tinyint(1) DEFAULT 1,
  `notify_user` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `site_name`, `contact_email`, `contact_phone`, `notify_job`, `notify_app`, `notify_user`) VALUES
(1, 'Management Myanmar', 'admin@jobportal.com', '09-772504189', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('Employer','Jobseeker') DEFAULT 'Jobseeker',
  `admin_city` varchar(100) DEFAULT 'All',
  `company` varchar(100) DEFAULT '-',
  `status` tinyint(1) DEFAULT 1,
  `profile_image` varchar(255) DEFAULT 'default.png',
  `township` varchar(100) DEFAULT 'Meiktila'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `email`, `phone`, `password`, `role`, `admin_city`, `company`, `status`, `profile_image`, `township`) VALUES
(6, 'Nyein Nyein Ei', NULL, 'shweyiwin507@gmail.com', NULL, '$2y$10$M2Y309P1INWerC30RwByzOiLxVCfUTQ157MaWEWDymNOL5F68vB0u', 'Jobseeker', 'All', '-', 1, 'default.png', 'Mandalay'),
(12, 'Chit San Htay', 'Chit San Htay', 'chitsanhtay1124@gamil.com', NULL, '$2y$10$8BpxHJGh6CPhvEkoxINHvegVV7nRcYFEEPJSE69Z1qotSHMBq2aZK', 'Jobseeker', 'All', '-', 1, 'default.png', 'Meiktila'),
(13, 'Moe Thet Wai', 'Moe Thet Wai', 'moethet@gmail.com', NULL, '$2y$10$nmPQfAt4XGBU/BRROz3Rle9trC9gXRD8PW/08/0C1ILfNiOR5vXTW', 'Jobseeker', 'All', '-', 1, '1771233739_30s businesswoman in white background _ Premium AI-generated PSD.jpg', 'Meiktila'),
(14, 'Yadanar', 'Yadanar', 'yadanar@gmail.com', NULL, '$2y$10$hkzQu.nLOxCBNJxAYWabH.AtFl7TjsZYRbGI2mmAKVtPUN5vyYoz2', 'Jobseeker', 'All', '-', 1, '1771234935_m.jpg', 'Meiktila'),
(18, 'Htet Arkar Linn', 'Htet Arkar Linn', 'arkar@gmail.com', '0945762346', '$2y$10$HHn/RQaNN3Ra1lDn5Xo1Eeq7TlTiyPDhcpmr4kwwH0IzOtNCO6T86', 'Employer', 'All', 'Cyber King', 1, '1771324522_15.jpg', 'Yangon'),
(19, 'Nyein', NULL, 'nyein@gmail.com', NULL, '$2y$10$K.PDtvCWQZXyQKMcxunv0OsEwsg88HKp0AxRdM0RkUHllkBJ3TAqm', 'Jobseeker', 'All', '-', 1, '1771324739_30s businesswoman in white background _ Premium AI-generated PSD.jpg', 'Yangon'),
(20, 'Sandar Soe', 'Sandar Soe', 'sandar@gmail.com', NULL, '$2y$10$KX/EirrgvHd4cwKBVdLXpuw5snFhpUdslay.60at5z1fVe9d6hty2', 'Jobseeker', 'All', '-', 1, '1771325310_30s businesswoman in white background _ Premium AI-generated PSD.jpg', 'Meiktila'),
(21, 'Mee Mee', 'Mee Mee', 'mm@gmail.com', NULL, '$2y$10$JGkGzYIdY8sStZqTNVmUqeXIlp2FoHZFuookiM/nHJ8OLPylAmmTi', 'Jobseeker', 'All', '-', 1, '1771338343_download (2).jpg', 'Naypyitaw'),
(22, 'Wang Yibo', NULL, 'wangyibo@gmail.com', NULL, '$2y$10$oQTIeXThoaxT48MTP2UWFeBOSAVEyLA0AJ7HMjYrImk8ZErstpsWm', 'Jobseeker', 'All', '-', 1, '1771336045_l.jpg', 'Naypyitaw'),
(23, 'Zon Moe Pyae', 'Zon Moe Pyae', 'zmp@gmail.com', NULL, '$2y$10$6ByK1y/c6BKj3ri.2YQNduZRs7qgXXNwEm/rN8oFWu/XW3czrc6m2', 'Jobseeker', 'All', '-', 1, '1771340300_book6.jpg', 'Mandalay'),
(24, 'Khaing Mar Htay', 'Khaing Mar Htay', 'Khaingmar123098@gmail.com', NULL, '$2y$10$5rDLWoeA06KiMkcQUn8mGebRAGUg1rTtE4EijFTwy2fgtSWjzGd9C', 'Jobseeker', 'All', '-', 1, 'default.png', 'Yangon'),
(25, 'Moe Thet Wai', 'Moe Thet Wai', 'moet00154@gmail.com', NULL, '$2y$10$3T5uOABFW9/fsFxFf/4IXeNdjB9Hh/rMvq1aQBAhpeJ/xrw6Cw6ue', 'Jobseeker', 'All', '-', 1, 'default.png', 'Meiktila');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `application`
--
ALTER TABLE `application`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_id` (`job_id`);

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `application`
--
ALTER TABLE `application`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `application`
--
ALTER TABLE `application`
  ADD CONSTRAINT `application_ibfk_1` FOREIGN KEY (`job_id`) REFERENCES `jobs` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

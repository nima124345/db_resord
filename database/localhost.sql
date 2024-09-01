-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 03, 2024 at 02:36 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_resort`
--
CREATE DATABASE IF NOT EXISTS `db_resort` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `db_resort`;

-- --------------------------------------------------------

--
-- Table structure for table `tb_ac_admin`
--

CREATE TABLE `tb_ac_admin` (
  `admin_id` int(3) NOT NULL,
  `status_id` int(3) NOT NULL DEFAULT 1,
  `admin_name` varchar(100) NOT NULL,
  `admin_password` varchar(100) NOT NULL,
  `admin_firstname` varchar(100) NOT NULL,
  `admin_surname` varchar(100) NOT NULL,
  `admin_phone` varchar(10) NOT NULL,
  `admin_show` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `admin_address` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_ac_admin`
--

INSERT INTO `tb_ac_admin` (`admin_id`, `status_id`, `admin_name`, `admin_password`, `admin_firstname`, `admin_surname`, `admin_phone`, `admin_show`, `admin_address`) VALUES
(1, 1, 'admin', 'admin', 'Mr.Admin', 'test', '0111111111', 1, NULL),
(2, 1, 'mmm', 'mmm', 'นายนิมะ', 'มะยี', '0926593907', 1, 'ปัตตานี'),
(3, 1, 'staff', 'staff', 'นายพนง.', 'ระบบ', '0020202020', 1, NULL),
(8, 3, 'mem1', 'mem1', 'mem', 'mem', '0202020200', 1, '11 aa bbb ccc 111'),
(9, 3, 'mem', 'mem', 'นายสมาชิก', 'คนที่1', '0200202020', 1, '101 อำเภอ ตำบล จังหวัด'),
(10, 3, 'aa', 'aa', 'นายสมาชิก', 'ทดลองจอง', '0002222222', 1, '111 ddd 111 1111'),
(11, 4, 'superadmin', 'superadmin', 'superadmin', 'test001', '0454545456', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_ac_admin_role`
--

CREATE TABLE `tb_ac_admin_role` (
  `no` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `admin_role` int(11) NOT NULL,
  `admin_status` int(1) NOT NULL DEFAULT 1 COMMENT '0 = ban, 1 = online'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tb_ac_admin_role`
--

INSERT INTO `tb_ac_admin_role` (`no`, `admin_id`, `admin_role`, `admin_status`) VALUES
(1, 1, 1, 1),
(2, 2, 1, 1),
(3, 2, 2, 1),
(4, 3, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_ac_status`
--

CREATE TABLE `tb_ac_status` (
  `status_id` int(3) NOT NULL,
  `status_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_ac_status`
--

INSERT INTO `tb_ac_status` (`status_id`, `status_name`) VALUES
(1, 'ผู้ดูแลระบบ'),
(2, 'พนักงาน'),
(3, 'สมาชิก');

-- --------------------------------------------------------

--
-- Table structure for table `tb_bank`
--

CREATE TABLE `tb_bank` (
  `bank_id` int(3) NOT NULL,
  `bank_name` varchar(100) NOT NULL,
  `ac_name` varchar(100) NOT NULL,
  `bank_number` varchar(100) NOT NULL,
  `bank_branch` varchar(100) NOT NULL,
  `bank_img` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_bank`
--

INSERT INTO `tb_bank` (`bank_id`, `bank_name`, `ac_name`, `bank_number`, `bank_branch`, `bank_img`) VALUES
(1, 'กรุงไทย', 'นายธนาคาร', '1111111111', 'กทม', 'img_166291366920230619_113637.png'),
(2, 'กรุงไทย', 'นายธนาคาร', '2222222222', 'ปทุมธานี', 'img_66790739920230619_113649.png');

-- --------------------------------------------------------

--
-- Table structure for table `tb_banner`
--

CREATE TABLE `tb_banner` (
  `banner_id` int(11) NOT NULL,
  `banner_title` varchar(255) NOT NULL,
  `banner_img` varchar(100) NOT NULL,
  `banner_link` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tb_banner`
--

INSERT INTO `tb_banner` (`banner_id`, `banner_title`, `banner_img`, `banner_link`) VALUES
(3, '001', 'img_125806516020230531_111046.jpg', 'https://www.facebook.com/'),
(4, '002', 'img_141143389420230531_111103.jpg', 'https://www.facebook.com/'),
(5, '003', 'img_91668445520230531_111115.jpg', 'https://www.facebook.com/');

-- --------------------------------------------------------

--
-- Table structure for table `tb_booking`
--

CREATE TABLE `tb_booking` (
  `booking_id` int(5) UNSIGNED ZEROFILL NOT NULL,
  `user_id` int(11) NOT NULL,
  `room_id` int(11) DEFAULT 0,
  `checkInDate` datetime NOT NULL,
  `checkOutDate` datetime NOT NULL,
  `totalDate` int(11) NOT NULL,
  `booking_amount` int(11) NOT NULL COMMENT 'ยอดรวม',
  `booking_status` int(11) NOT NULL DEFAULT 2 COMMENT '0 ยกเลิก 1 เช็คเอ้า 2 รอชำระเงิน, 3 รอตรวจสอบชำระเงิน 4 รอเข้าพัก 5 เช็คอิน',
  `staff_id` int(11) NOT NULL DEFAULT 0 COMMENT 'ไอดี พนง. ที่ทำรายการ',
  `bank_id` int(11) NOT NULL DEFAULT 0,
  `slip` varchar(100) DEFAULT NULL COMMENT 'สลิปโอนเงิน',
  `payDate` date DEFAULT NULL COMMENT 'วันที่จ่าย',
  `remark` text DEFAULT NULL COMMENT 'ระบุเหตุผลที่ยกเลิก',
  `car_no` varchar(100) DEFAULT NULL COMMENT 'ทะเบียนรถ',
  `damage_detail` varchar(200) DEFAULT NULL COMMENT 'ความเสียหายที่เกิดขึ้น',
  `damage_total` int(5) NOT NULL DEFAULT 0 COMMENT 'ค่าเสียหาย (บาท)',
  `dateCreate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tb_booking`
--

INSERT INTO `tb_booking` (`booking_id`, `user_id`, `room_id`, `checkInDate`, `checkOutDate`, `totalDate`, `booking_amount`, `booking_status`, `staff_id`, `bank_id`, `slip`, `payDate`, `remark`, `car_no`, `damage_detail`, `damage_total`, `dateCreate`) VALUES
(00001, 9, 5, '2023-07-09 14:00:00', '2023-07-11 12:00:00', 2, 7400, 1, 2, 1, 'img_62586429820230709_093548.jpg', '2023-07-09', NULL, '', '', 0, '2023-07-09 02:35:31'),
(00002, 9, 4, '2023-07-12 14:00:00', '2023-07-13 12:00:00', 1, 3700, 1, 3, 2, 'img_46893927220230709_155616.png', '2023-07-09', NULL, '', '', 0, '2023-07-09 02:36:39'),
(00003, 9, 3, '2023-07-16 14:00:00', '2023-07-20 12:00:00', 4, 10000, 1, 3, 1, 'img_202108150020230709_155409.png', '2023-07-09', NULL, '', '', 0, '2023-07-09 02:37:16'),
(00004, 8, 4, '2023-07-30 14:00:00', '2023-08-01 12:00:00', 2, 7400, 0, 2, 0, NULL, NULL, 'ไม่ชำระเงิน', NULL, NULL, 0, '2023-07-09 02:47:47'),
(00005, 9, 1, '2023-07-10 14:00:00', '2023-07-11 12:00:00', 1, 2500, 1, 3, 2, 'img_120946542420230709_160522.png', '2023-07-09', NULL, '', '', 0, '2023-07-09 09:05:05'),
(00006, 9, 4, '2023-07-14 14:00:00', '2023-07-15 12:00:00', 1, 3700, 1, 3, 1, 'img_90542231520230709_223302.png', '2023-07-09', NULL, '', '', 0, '2023-07-09 15:32:37'),
(00007, 9, 5, '2023-07-16 14:00:00', '2023-07-19 12:00:00', 3, 11100, 1, 3, 1, 'img_191525657820230711_101421.jpg', '2023-07-11', NULL, '', '', 0, '2023-07-11 03:14:00'),
(00008, 9, 6, '2023-07-19 14:00:00', '2023-07-21 12:00:00', 2, 5000, 0, 0, 0, NULL, NULL, 'ลูกค้ายกเลิก', NULL, NULL, 0, '2023-07-11 03:26:34'),
(00009, 9, 2, '2023-07-11 14:00:00', '2023-07-14 12:00:00', 3, 7500, 0, 0, 0, NULL, NULL, 'ลูกค้ายกเลิก', NULL, NULL, 0, '2023-07-11 12:11:22'),
(00010, 9, 1, '2023-07-14 14:00:00', '2023-07-15 12:00:00', 1, 2500, 1, 9, 2, 'img_10287200320230713_122625.jpg', '2023-07-13', NULL, '', '', 0, '2023-07-13 05:26:08'),
(00011, 9, 1, '2023-07-20 14:00:00', '2023-07-21 12:00:00', 1, 2500, 2, 0, 0, NULL, NULL, NULL, NULL, NULL, 0, '2023-07-19 07:08:16'),
(00012, 10, 1, '2023-11-20 14:00:00', '2023-11-21 12:00:00', 1, 2500, 0, 3, 0, NULL, NULL, 'dddd', NULL, NULL, 0, '2023-11-20 14:43:04'),
(00013, 8, 1, '2024-07-01 14:00:00', '2024-07-03 12:00:00', 2, 5000, 5, 3, 1, 'img_178060828420240701_120809.png', '2024-07-01', NULL, '', NULL, 0, '2024-07-01 05:07:47'),
(00014, 1, 8, '2024-07-03 14:00:00', '2024-07-11 12:00:00', 8, 800, 1, 2, 1, 'img_43588313520240702_153449.jpg', '2024-07-02', NULL, '15869', '', 0, '2024-07-02 08:29:42'),
(00015, 13, 9, '2024-07-03 14:00:00', '2024-07-04 12:00:00', 1, 2800, 1, 2, 1, 'img_84336725920240702_220943.jpg', '2024-07-02', NULL, '7894', '', 0, '2024-07-02 15:08:59'),
(00016, 2, 9, '2024-07-03 14:00:00', '2024-07-05 12:00:00', 2, 5600, 5, 3, 2, 'img_208170798020240702_223709.jpg', '2024-07-02', NULL, 'dfdf', NULL, 0, '2024-07-02 15:36:47'),
(00017, 2, 8, '2024-07-12 14:00:00', '2024-07-13 12:00:00', 1, 100, 5, 2, 1, 'img_141002880820240702_224359.jpg', '2024-07-04', NULL, 'กส545', NULL, 0, '2024-07-02 15:42:52'),
(00018, 2, 9, '2024-07-06 14:00:00', '2024-07-07 12:00:00', 1, 2800, 1, 3, 1, 'img_75086015920240706_152307.jpg', '2024-07-06', NULL, '15869', '12313132', 12222, '2024-07-06 08:22:38'),
(00019, 14, 9, '2024-07-15 14:00:00', '2024-07-16 12:00:00', 1, 2800, 1, 2, 1, 'img_21710945720240706_153759.jpg', '2024-07-06', NULL, '1234', 'ไม่มี', 0, '2024-07-06 08:37:28'),
(00020, 2, 8, '2024-07-28 14:00:00', '2024-07-30 12:00:00', 2, 200, 5, 2, 1, 'img_184156313720240727_215616.jpg', '2024-07-27', NULL, 'กส545', NULL, 0, '2024-07-27 14:55:04'),
(00021, 15, 7, '2024-07-30 14:00:00', '2024-08-02 12:00:00', 3, 9000, 1, 2, 1, 'img_18235057120240727_220627.jpg', '2024-07-27', NULL, 'นราธิวาส', 'ไม่มี', 0, '2024-07-27 15:01:46'),
(00022, 2, 9, '2024-07-31 14:00:00', '2024-08-01 12:00:00', 1, 2800, 2, 0, 0, NULL, NULL, NULL, NULL, NULL, 0, '2024-07-31 09:06:19'),
(00023, 2, 9, '2024-07-31 14:00:00', '2024-08-01 12:00:00', 1, 2800, 2, 0, 0, NULL, NULL, NULL, NULL, NULL, 0, '2024-07-31 09:07:30'),
(00024, 2, 9, '2024-07-31 14:00:00', '2024-08-01 12:00:00', 1, 2800, 2, 0, 0, NULL, NULL, NULL, NULL, NULL, 0, '2024-07-31 09:07:37'),
(00025, 15, 9, '2024-07-31 14:00:00', '2024-08-02 12:00:00', 2, 5600, 2, 0, 0, NULL, NULL, NULL, NULL, NULL, 0, '2024-07-31 09:09:16'),
(00026, 16, 9, '2024-08-02 14:00:00', '2024-08-03 12:00:00', 1, 2800, 5, 2, 1, 'img_150684491820240731_161707.jpg', '2024-07-31', NULL, 'กส545', NULL, 0, '2024-07-31 09:14:47'),
(00027, 17, 4, '2024-08-01 14:00:00', '2024-08-02 12:00:00', 1, 3700, 4, 17, 2, 'img_187749498120240801_145604.jpg', '2024-08-01', NULL, NULL, NULL, 0, '2024-08-01 07:55:33');

-- --------------------------------------------------------

--
-- Table structure for table `tb_news`
--

CREATE TABLE `tb_news` (
  `news_id` int(11) NOT NULL,
  `news_head` varchar(200) NOT NULL,
  `news_detail` text NOT NULL,
  `news_img` varchar(100) NOT NULL,
  `news_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tb_news`
--

INSERT INTO `tb_news` (`news_id`, `news_head`, `news_detail`, `news_img`, `news_date`) VALUES
(1, 'Learn How To Motivate Yourself', 'How many free autoresponders have you tried? And how many emails did you get through using them?', 'img_27191152820230531_112222.jpg', '2023-05-30 21:22:22'),
(2, 'Learn How To Motivate Yourself', 'How many free autoresponders have you tried? And how many emails did you get through using them?', 'img_27191152820230531_112222.jpg', '2023-05-30 21:22:22'),
(3, 'Learn How To Motivate Yourself', 'How many free autoresponders have you tried? And how many emails did you get through using them?', 'img_27191152820230531_112222.jpg', '2023-05-30 21:22:22'),
(4, 'Learn How To Motivate Yourself', 'How many free autoresponders have you tried? And how many emails did you get through using them?', 'img_27191152820230531_112222.jpg', '2023-05-30 21:22:22'),
(5, 'Learn How To Motivate Yourself', 'How many free autoresponders have you tried? And how many emails did you get through using them?', 'img_27191152820230531_112222.jpg', '2023-05-30 21:22:22'),
(6, 'Learn How To Motivate Yourself', 'How many free autoresponders have you tried? And how many emails did you get through using them?', 'img_27191152820230531_112222.jpg', '2023-05-30 21:22:22');

-- --------------------------------------------------------

--
-- Table structure for table `tb_room`
--

CREATE TABLE `tb_room` (
  `room_id` int(3) NOT NULL,
  `type_id` int(11) NOT NULL,
  `room_number` varchar(100) NOT NULL,
  `room_detail` text NOT NULL,
  `room_service` varchar(500) NOT NULL,
  `room_price` varchar(100) NOT NULL,
  `room_capacity` int(2) NOT NULL DEFAULT 0 COMMENT 'จำนวนผู้เข้าพักสูงสุด',
  `room_size` int(3) NOT NULL DEFAULT 0 COMMENT 'ขนาดห้องพัก ตรม.',
  `room_bed` varchar(100) DEFAULT NULL COMMENT 'ประเภทเตียง',
  `room_img` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_room`
--

INSERT INTO `tb_room` (`room_id`, `type_id`, `room_number`, `room_detail`, `room_service`, `room_price`, `room_capacity`, `room_size`, `room_bed`, `room_img`) VALUES
(1, 1, 'บ้าน ก', 'รายละเอียด รายละเอียด', 'Wifi, TV', '2500', 2, 30, 'เตียงใหญ่', 'img_213127485520230529_090813.jpg'),
(2, 1, 'บ้าน ข', 'รายละเอียด รายละเอียด', 'Wifi, TV', '2500', 3, 35, '1 เตียงใหญ่ + 1 เตียงเล็ก', 'img_213127485520230529_090813.jpg'),
(3, 1, 'บ้าน ค', 'รายละเอียดห้อง', 'Wifi, TV', '2500', 2, 30, 'เตียงใหญ่', 'img_213127485520230529_090813.jpg'),
(4, 2, 'บ้าน A', 'รายละเอียด รายละเอียด', 'Wifi, TV', '3700', 2, 30, 'เตียงคู่', 'img_213127485520230529_090813.jpg'),
(5, 2, 'บ้าน B', 'รายละเอียด รายละเอียด', 'สิ่งอำนวยความสะดวก สิ่งอำนวยความสะดวก', '3700', 2, 30, 'เตียงขนาดใหญ่', 'img_213127485520230529_090813.jpg'),
(6, 2, 'บ้าน C', 'รายละเอียด รายละเอียด', 'Wifi, TV', '2500', 2, 35, 'เตียงคู่', 'img_213127485520230529_090813.jpg'),
(7, 1, 'บ้าน D', 'รายละเอียด  901', 'Wifi, TV', '3000', 2, 30, 'เตียงใหญ่', 'img_18046807520230702_113121.jpg'),
(8, 2, '147', 'gfbgfgb', 'fbgdbfdv', '100', 2, 4, 'เตียงใหญ่', 'img_19818529320240702_152816.png'),
(9, 5, '1133', 'ใกล้ทะเล', 'มีทุกอย่าง', '2800', 5, 30, '1 เตียงใหญ่ + 1 เตียงเล็ก', 'img_26923068120240702_215808.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_room_image`
--

CREATE TABLE `tb_room_image` (
  `image_id` int(3) NOT NULL,
  `image_url` varchar(500) NOT NULL,
  `room_id` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_room_image`
--

INSERT INTO `tb_room_image` (`image_id`, `image_url`, `room_id`) VALUES
(1, '202306011152531091144413.jpg', 1),
(2, '20230601115253247269490.jpg', 1),
(3, '2023060111525349650247.jpg', 1),
(4, '20230601115253918632606.jpg', 1),
(5, '20230608120639444504120.jpg', 2),
(6, '202306081206391654974173.jpg', 2),
(7, '20230608120639939877699.jpg', 2),
(8, '202306081206392089093002.jpg', 2),
(9, '202306081206392065046365.jpg', 2),
(10, '202306081206391922175988.jpg', 2),
(11, '20230610090905390169461.jpg', 3),
(12, '20230610090905415809086.jpg', 3),
(13, '202306100909052004824890.jpg', 3),
(14, '202306100930481654937600.jpg', 6),
(15, '20230610093048948315840.jpg', 6),
(16, '202306100930482132067406.jpg', 6),
(17, '202306100930481194490836.jpg', 6),
(18, '202307021131371787742537.jpg', 7),
(19, '202307021145341379148823.jpg', 7),
(20, '20230709230803459884249.jpg', 3),
(22, '202307131207241245230255.jpg', 7),
(26, '202407041445321992458289.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tb_room_type`
--

CREATE TABLE `tb_room_type` (
  `type_id` int(3) NOT NULL,
  `type_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_room_type`
--

INSERT INTO `tb_room_type` (`type_id`, `type_name`) VALUES
(1, 'ห้องมาตรฐาน'),
(2, 'ห้องลักชูรี่'),
(5, 'ปาร์ม บีช'),
(6, 'อเมซอน');

-- --------------------------------------------------------

--
-- Table structure for table `tb_setting`
--

CREATE TABLE `tb_setting` (
  `wst_id` int(3) NOT NULL,
  `wst_about` text NOT NULL,
  `wst_name` varchar(100) NOT NULL,
  `wst_title` varchar(100) NOT NULL,
  `wst_email` varchar(100) NOT NULL,
  `wst_phone` varchar(100) NOT NULL,
  `wst_img` varchar(500) NOT NULL,
  `wst_show` tinyint(3) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_setting`
--

INSERT INTO `tb_setting` (`wst_id`, `wst_about`, `wst_name`, `wst_title`, `wst_email`, `wst_phone`, `wst_img`, `wst_show`) VALUES
(1, 'รีสอร์ต สุขสบาย ร่มเย็น ชื่นใจ ราคาถูก เดินทางสะดวก', 'รีสอร์ต สุขสบาย ร่มเย็น ชื่นใจ ราคาถูก เดินทางสะดวก ใกล้ตลาด', 'รีสอร์ต', 'resort-abc@gg.com', '05487414741', 'img_59715112920230531_122750.jpg', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_ac_admin`
--
ALTER TABLE `tb_ac_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tb_ac_admin_role`
--
ALTER TABLE `tb_ac_admin_role`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `tb_ac_status`
--
ALTER TABLE `tb_ac_status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `tb_bank`
--
ALTER TABLE `tb_bank`
  ADD PRIMARY KEY (`bank_id`);

--
-- Indexes for table `tb_banner`
--
ALTER TABLE `tb_banner`
  ADD PRIMARY KEY (`banner_id`);

--
-- Indexes for table `tb_booking`
--
ALTER TABLE `tb_booking`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `tb_news`
--
ALTER TABLE `tb_news`
  ADD PRIMARY KEY (`news_id`);

--
-- Indexes for table `tb_room`
--
ALTER TABLE `tb_room`
  ADD PRIMARY KEY (`room_id`);

--
-- Indexes for table `tb_room_image`
--
ALTER TABLE `tb_room_image`
  ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `tb_room_type`
--
ALTER TABLE `tb_room_type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `tb_setting`
--
ALTER TABLE `tb_setting`
  ADD PRIMARY KEY (`wst_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_ac_admin`
--
ALTER TABLE `tb_ac_admin`
  MODIFY `admin_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tb_ac_admin_role`
--
ALTER TABLE `tb_ac_admin_role`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tb_ac_status`
--
ALTER TABLE `tb_ac_status`
  MODIFY `status_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_bank`
--
ALTER TABLE `tb_bank`
  MODIFY `bank_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tb_banner`
--
ALTER TABLE `tb_banner`
  MODIFY `banner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_booking`
--
ALTER TABLE `tb_booking`
  MODIFY `booking_id` int(5) UNSIGNED ZEROFILL NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tb_news`
--
ALTER TABLE `tb_news`
  MODIFY `news_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_room`
--
ALTER TABLE `tb_room`
  MODIFY `room_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tb_room_image`
--
ALTER TABLE `tb_room_image`
  MODIFY `image_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `tb_room_type`
--
ALTER TABLE `tb_room_type`
  MODIFY `type_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_setting`
--
ALTER TABLE `tb_setting`
  MODIFY `wst_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 31, 2023 at 10:04 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tatcshop`
--
CREATE DATABASE IF NOT EXISTS `tatcshop` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `tatcshop`;

-- --------------------------------------------------------

--
-- Table structure for table `buy`
--

CREATE TABLE `buy` (
  `Buy_id` varchar(5) NOT NULL,
  `Emp_id` varchar(5) NOT NULL,
  `Buy_date` datetime NOT NULL,
  `Receive_date` datetime DEFAULT NULL,
  `Paid_date` datetime DEFAULT NULL,
  `Net_price` decimal(6,2) NOT NULL,
  `Paid_by` int(5) DEFAULT NULL,
  `Receive_by` int(5) DEFAULT NULL,
  `Buy_status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buy`
--

INSERT INTO `buy` (`Buy_id`, `Emp_id`, `Buy_date`, `Receive_date`, `Paid_date`, `Net_price`, `Paid_by`, `Receive_by`, `Buy_status`) VALUES
('B0001', 'EMP01', '2017-11-28 00:00:00', '2017-11-29 00:00:00', '2017-11-29 00:00:00', 9999.99, 0, 0, 3),
('B0002', 'EMP03', '2017-11-30 00:00:00', '2017-12-07 00:00:00', '2017-12-07 00:00:00', 3100.00, 0, 0, 3),
('B0003', 'EMP01', '2017-12-01 00:00:00', '2017-12-09 00:00:00', '2017-12-09 00:00:00', 9999.99, 0, 0, 3),
('B0004', 'EMP05', '2017-12-23 00:00:00', '2017-12-25 00:00:00', '2017-12-25 00:00:00', 9999.99, 0, 0, 3),
('B0005', 'EMP11', '2017-12-30 00:00:00', '2017-12-31 00:00:00', '2017-12-31 00:00:00', 9999.99, 0, 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `buy_detail`
--

CREATE TABLE `buy_detail` (
  `buy_id` varchar(5) NOT NULL,
  `pro_id` varchar(8) NOT NULL,
  `Amount` int(5) NOT NULL,
  `price` decimal(6,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `buy_detail`
--

INSERT INTO `buy_detail` (`buy_id`, `pro_id`, `Amount`, `price`) VALUES
('B0001', 'PRO01', 3, 8100.00),
('B0001', 'PRO06', 10, 7000.00),
('B0001', 'PRO15', 1, 4750.00),
('B0002', 'PRO02', 1, 3100.00),
('B0003', 'PRO04', 2, 3400.00),
('B0003', 'PRO08', 10, 6500.00),
('B0003', 'PRO09', 10, 2500.00),
('B0003', 'PRO11', 1, 250.00),
('B0003', 'PRO15', 1, 4750.00),
('B0004', 'PRO03', 2, 7000.00),
('B0004', 'PRO12', 3, 1800.00),
('B0004', 'PRO14', 2, 4000.00),
('B0004', 'PRO15', 1, 4750.00),
('B0004', 'PRO17', 1, 8000.00),
('B0004', 'PRO18', 1, 3500.00),
('B0004', 'PRO20', 1, 2000.00),
('B0005', 'PRO03', 2, 7000.00),
('B0005', 'PRO06', 10, 7000.00),
('B0005', 'PRO11', 10, 2500.00),
('B0005', 'PRO12', 2, 1200.00);

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE `customer` (
  `Cust_id` varchar(8) NOT NULL,
  `Cust_name` varchar(50) NOT NULL,
  `Cust_lastName` varchar(50) NOT NULL,
  `Cust_addresa` varchar(100) NOT NULL,
  `Province_id` int(2) NOT NULL,
  `Cust_tel` varchar(20) NOT NULL,
  `Admit_date` varchar(8) NOT NULL,
  `Cust_picture` mediumblob DEFAULT NULL,
  `Cust_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`Cust_id`, `Cust_name`, `Cust_lastName`, `Cust_addresa`, `Province_id`, `Cust_tel`, `Admit_date`, `Cust_picture`, `Cust_status`) VALUES
('C0001', 'นาย อภิวิชญ์', 'ธิปภาดา', '233/39', 9, '0970981519', '2017-11-', NULL, 1),
('C0002', 'นาย ชัยยศ', 'พรหมจารีย์', '49/13', 11, '0846517465', '2017-11-', NULL, 1),
('C0003', 'นาย วรต ', 'กระโทก', '52/223', 65, '0684941621', '2017-11-', NULL, 1),
('C0004', 'นาย นักรบ', 'ชนะราวี', '447/74', 12, '0914465541', '2017-11-', NULL, 1),
('C0005', 'นาย สงคราม', 'ชนะราวี', '24/3', 3, '0855162465', '2017-11-', NULL, 1),
('C0006', 'นาย นิธินัย', 'เหินเวหา', '24/20', 5, '0511657625', '2017-11-', NULL, 1),
('C0007', 'นาย ติ๊บ', 'บุญนำ ', '525/35', 1, '0884516545', '2017-11-', NULL, 1),
('C0008', 'นาย บรรพต', 'ร่วมใจ', '26/47', 1, '0629845215', '2017-11-', NULL, 1),
('C0009', 'นาย ชาติชาญ', 'ขำสนิท', '98/16', 9, '0877546546', '2017-11-', NULL, 1),
('C0010', 'นาย บุญศรัทธา', 'มหามงคล', '44/2', 9, '0989846546', '2017-11-', NULL, 1),
('C0011', 'นาย หินชนวน', 'อโศก', '99/99', 9, '0568795465', '2017-11-', NULL, 1),
('C0012', 'นาย บุญพอ', 'มีเท', '22/22', 2, '0351498462', '2017-11-', NULL, 1),
('C0013', 'นาย จันมี', 'มีมูล', '29/34', 11, '0847162164', '2017-11-', NULL, 1),
('C0014', 'นาย นนนที', 'กะโทก', '71/28', 11, '0847951651', '2017-11-', NULL, 1),
('C0015', 'นาย การหาญ', 'โดนอม', '63/36', 9, '0949516546', '2017-11-', NULL, 1),
('C0016', 'นาย สมศักดิ์', 'พัดลม', '89/89', 9, '0251494868', '2017-11-', NULL, 1),
('C0017', 'นาย หวังนที', 'ขอพันธุ์', '15/98', 2, '0354968465', '2017-11-', NULL, 1),
('C0018', 'นาย กันภัยพาล', 'ใจแข่งกล้า', '16/23', 9, '0879546521', '2017-11-', NULL, 1),
('C0019', 'นาย อิทธิ', 'แจงใส', '44/12', 9, '0548465184', '2017-11-', NULL, 1),
('C0020', 'นาย อธิป', 'สูญสิ้นภัย', '12/5', 9, '0231565489', '2017-11-', NULL, 1),
('C0021', 'สาย สายชล', 'สุขนิ่ม', '11/1', 47, '07777777777', '2566-03-', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `Emp_id` varchar(5) NOT NULL,
  `User_name` varchar(20) NOT NULL,
  `Pass_word` varchar(20) NOT NULL,
  `Emp_name` varchar(50) NOT NULL,
  `Emp_status` int(1) NOT NULL,
  `Emp_type` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`Emp_id`, `User_name`, `Pass_word`, `Emp_name`, `Emp_status`, `Emp_type`) VALUES
('EMP01', 'admin', '1122', 'นาย องค์อาจ ชาตินักรบ', 1, 2),
('EMP02', 'owner01', '4466', 'นางสาว สายใจ เกาะมหาสนุก', 1, 2),
('EMP03', 'joe_44', '1254', 'นาย สมศักดิ์ หวังดีเสมอ', 1, 2),
('EMP04', 'srit', '2529', 'นาย หวังนที ชาติยืนยง', 1, 1),
('EMP05', 'makin', '8747', 'นาย ณรงค์ นัดใช้ปืน', 1, 2),
('EMP06', 'coco28', '1216', 'นาง กันภัย สูญสิ้นภัย', 1, 1),
('EMP07', 'cokeza1', '1516', 'นางสาว อูโน่ หลาวทอง', 1, 1),
('EMP08', 'desert_ez', '4856', 'นาย อธิป จันทร์กระจ่าง', 2, 1),
('EMP09', 'weed', '191', 'นาย อาทิตย์ ชอบมามาตร', 2, 1),
('EMP10', 'god2517', '5474', 'นาย ศักดิพันธ์ ชอบมามาตร', 2, 1),
('EMP11', 'ggwp09', '1150', 'นางสาว บรรจง หนึ่งในยุทธจักร', 1, 1),
('EMP12', 'qwertp', '1684', 'นางสาว กนกกร เวหา', 1, 1),
('EMP13', 'Worapot2', '9874', 'นายสาว นารัตน์ พัดลม', 1, 1),
('EMP14', 'fujisu', '4475', 'นาง ลำเทียน คล้องพันธุ์', 2, 1),
('EMP15', 'mewtara', '8975', 'นาย มนศักดิ์ คล้องพันธ์', 1, 1),
('EMP16', 'maigg', '0875', 'นาย ดิน แจงใส', 1, 1),
('EMP17', 'fifa17', '0987', 'นาง สร้อยฟ้า ฟางน้อย', 2, 1),
('EMP18', 'giggs44', '0369', 'นางสาง ไพรัตน์ สุขแจ่มใส', 1, 1),
('EMP19', 'mawto', '1150', 'นาย ภาคภูมิ สุดใจ', 1, 1),
('EMP20', 'dew02', '0202', 'นาย หรูหรา อมตะ', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_detail`
--

CREATE TABLE `order_detail` (
  `Order_id` varchar(10) NOT NULL,
  `Pro_id` varchar(8) NOT NULL,
  `Amount` int(5) NOT NULL,
  `Sale_price` decimal(6,2) NOT NULL,
  `Discount` decimal(6,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_detail`
--

INSERT INTO `order_detail` (`Order_id`, `Pro_id`, `Amount`, `Sale_price`, `Discount`) VALUES
('OR001', 'PRO01', 3, 7800.00, 300.00),
('OR001', 'PRO02', 1, 3000.00, 100.00),
('OR001', 'PRO03', 1, 3300.00, 200.00),
('OR001', 'PRO05', 3, 4800.00, 300.00),
('OR002', 'PRO06', 5, 3250.00, 250.00),
('OR003', 'PRO06', 1, 650.00, 50.00),
('OR002', 'PRO07', 10, 3000.00, 500.00),
('OR003', 'PRO08', 1, 520.00, 30.00),
('OR003', 'PRO09', 1, 200.00, 50.00),
('OR003', 'PRO10', 1, 550.00, 50.00),
('OR003', 'PRO11', 1, 200.00, 50.00),
('OR003', 'PRO12', 1, 550.00, 50.00),
('OR004', 'PRO13', 2, 3800.00, 200.00),
('OR004', 'PRO15', 1, 4500.00, 250.00),
('OR004', 'PRO16', 2, 9999.99, 600.00),
('OR004', 'PRO18', 2, 6400.00, 600.00);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `Pro_id` varchar(8) NOT NULL,
  `Pro_name` varchar(100) NOT NULL,
  `Pro_cost` decimal(6,2) NOT NULL,
  `Pro_salePrice` decimal(6,2) NOT NULL,
  `Pro_memberPrice` decimal(6,2) NOT NULL,
  `Pro_amount` int(5) NOT NULL,
  `Cate_id` int(4) NOT NULL,
  `Shelf_no` varchar(5) NOT NULL,
  `Sup_id` varchar(8) NOT NULL,
  `Point_ofSale` int(5) NOT NULL,
  `Pro_status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`Pro_id`, `Pro_name`, `Pro_cost`, `Pro_salePrice`, `Pro_memberPrice`, `Pro_amount`, `Cate_id`, `Shelf_no`, `Sup_id`, `Point_ofSale`, `Pro_status`) VALUES
('PRO00', 'เฟิร์ท', 1000.00, 1200.00, 1100.00, 10, 1, 'SH05', 'SUP09', 1, 1),
('PRO01', 'AK-47', 2500.00, 2700.00, 2600.00, 29, 1, 'SH02', 'SUP05', 5, 1),
('PRO02', 'M16-A1', 2800.00, 3100.00, 3000.00, 4, 1, 'SH02', 'SUP04', 3, 1),
('PRO03', 'M4A1-S', 3000.00, 3500.00, 3300.00, 3, 5, 'SH02', 'SUP03', 3, 1),
('PRO04', 'M1887', 1400.00, 1700.00, 1500.00, 3, 3, 'SH02', 'SUP02', 3, 1),
('PRO05', 'Double-Barrel', 1500.00, 1700.00, 1600.00, 0, 3, 'SH01', 'SUP05', 2, 1),
('PRO06', 'Desert-Eagle', 600.00, 700.00, 650.00, 5, 3, 'SH05', 'SUP05', 6, 1),
('PRO07', 'P250', 200.00, 350.00, 300.00, 15, 3, 'SH01', 'SUP07', 5, 1),
('PRO08', 'P1911', 500.00, 550.00, 520.00, 8, 3, 'SH01', 'SUP08', 5, 1),
('PRO09', 'G-18', 100.00, 250.00, 200.00, 7, 3, 'SH03', 'SUP09', 2, 1),
('PRO10', 'FIVE7', 500.00, 600.00, 550.00, 10, 3, 'SH03', 'SUP10', 2, 1),
('PRO11', 'P2000', 100.00, 250.00, 200.00, 8, 3, 'SH03', 'SUP11', 3, 1),
('PRO12', 'TEC-9', 500.00, 600.00, 550.00, 15, 3, 'SH05', 'SUP12', 10, 1),
('PRO13', 'M249', 5000.00, 5350.00, 5100.00, 4, 4, 'SH04', 'SUP13', 2, 1),
('PRO14', 'Negav', 1500.00, 2000.00, 1900.00, 5, 4, 'SH05', 'SUP14', 2, 1),
('PRO15', 'AWP', 4000.00, 4750.00, 4500.00, 8, 1, 'SH05', 'SUP15', 2, 1),
('PRO16', 'M107', 5000.00, 5500.00, 5200.00, 11, 1, 'SH05', 'SUP16', 2, 1),
('PRO17', 'M14', 8000.00, 8500.00, 8300.00, 8, 1, 'SH04', 'SUP17', 2, 1),
('PRO18', 'R93', 3000.00, 3500.00, 3200.00, 15, 1, 'SH04', 'SUP18', 2, 1),
('PRO19', 'SP66', 2700.00, 3200.00, 3000.00, 20, 1, 'SH04', 'SUP19', 5, 1),
('PRO20', 'VSS', 2000.00, 2500.00, 2300.00, 40, 1, 'SH01', 'SUP20', 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `Cate_id` int(4) NOT NULL,
  `Cate_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`Cate_id`, `Cate_name`) VALUES
(1, 'ปืนไรเฟิล'),
(2, 'ปืนสั้น'),
(3, 'ปืนลูกซอง'),
(4, 'ปืนกลหนัก'),
(5, 'ปืนกลเบา');

-- --------------------------------------------------------

--
-- Table structure for table `product_order`
--

CREATE TABLE `product_order` (
  `Order_id` varchar(10) NOT NULL,
  `Cust_id` varchar(8) NOT NULL,
  `Order_date` datetime NOT NULL,
  `Net_price` decimal(6,2) NOT NULL,
  `FirstPaid` decimal(6,2) NOT NULL,
  `isPaidAll` int(1) DEFAULT NULL,
  `isReciveAll` int(1) DEFAULT NULL,
  `Recive_date` datetime NOT NULL,
  `Order_status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_order`
--

INSERT INTO `product_order` (`Order_id`, `Cust_id`, `Order_date`, `Net_price`, `FirstPaid`, `isPaidAll`, `isReciveAll`, `Recive_date`, `Order_status`) VALUES
('OR001', 'C0001', '2017-11-07 00:00:00', 9999.99, 1800.00, 2, 2, '2017-11-08 00:00:00', 2),
('OR002', 'C0003', '2017-11-09 00:00:00', 6250.00, 620.00, 2, 2, '2017-11-10 00:00:00', 2),
('OR003', 'C0005', '2017-11-25 00:00:00', 2670.00, 260.00, 2, 2, '2017-11-28 00:00:00', 2),
('OR004', 'C0007', '2017-12-02 00:00:00', 9999.99, 2500.00, 2, 2, '2017-12-05 00:00:00', 2);

-- --------------------------------------------------------

--
-- Table structure for table `product_return`
--

CREATE TABLE `product_return` (
  `Rel_id` int(11) NOT NULL,
  `Sale_id` varchar(10) NOT NULL,
  `Pro_id` varchar(8) NOT NULL,
  `Amount` int(5) NOT NULL,
  `Return_date` datetime NOT NULL,
  `Comment` varchar(100) DEFAULT NULL,
  `Return_type` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_return`
--

INSERT INTO `product_return` (`Rel_id`, `Sale_id`, `Pro_id`, `Amount`, `Return_date`, `Comment`, `Return_type`) VALUES
(1, 'SA127', 'PRO01', 17, '2566-03-07 00:00:00', NULL, 1),
(2, 'SA128', 'PRO01', 11, '2566-03-07 00:00:00', NULL, 1),
(3, 'SA129', 'PRO01', 14, '2566-03-07 00:00:00', NULL, 1),
(4, 'SA131', 'PRO01', 20, '2566-03-07 00:00:00', NULL, 1),
(5, 'SA132', 'PRO01', 9, '2566-03-07 00:00:00', NULL, 1),
(6, 'SA121', 'PRO05', 7, '2566-02-27 00:00:00', NULL, 1),
(7, 'SA135', 'PRO05', 2, '2566-03-07 00:00:00', NULL, 1),
(8, 'SA004', 'PRO07', 3, '2017-12-13 00:00:00', 'สินค้าหมดอายุ', 2),
(9, 'SA001', 'PRO08', 2, '2017-11-04 00:00:00', 'สินค้าห่วยเเตก', 1),
(10, 'SA004', 'PRO08', 1, '2017-12-13 00:00:00', 'สินค้าเสียหาย', 1),
(11, 'SA005', 'PRO16', 11, '2566-03-07 00:00:00', NULL, 1),
(12, 'SA129', 'PRO01', 22, '2566-03-07 00:00:00', NULL, 1),
(13, 'SA128', 'PRO01', 23, '2566-03-07 00:00:00', NULL, 1),
(14, 'SA126', 'PRO01', 25, '2566-03-07 00:00:00', NULL, 1),
(15, 'SA126', 'PRO01', 27, '2566-03-07 00:00:00', NULL, 1),
(16, 'SA125', 'PRO01', 32, '2566-03-07 00:00:00', NULL, 1),
(17, 'SA139', 'PRO06', 6, '2566-03-07 00:00:00', NULL, 1),
(18, 'SA140', 'PRO11', 12, '2566-03-07 00:00:00', NULL, 1),
(19, 'SA141', 'PRO11', 9, '2566-03-07 00:00:00', NULL, 1),
(20, 'SA142', 'PRO13', 4, '2566-03-07 00:00:00', NULL, 1),
(21, 'SA144', 'PRO11', 8, '2566-03-07 00:00:00', 'พัง', 1),
(22, 'SA145', 'PRO04', 3, '2566-03-08 00:00:00', NULL, 1),
(23, 'SA146', 'PRO06', 5, '2566-03-08 00:00:00', 'เสียหาย', 1),
(24, 'SA147', 'PRO01', 25, '2566-03-08 00:00:00', 'คืน', 1),
(25, 'SA147', 'PRO01', 29, '2566-03-08 00:00:00', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `province`
--

CREATE TABLE `province` (
  `Province_id` int(2) NOT NULL,
  `Province_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `province`
--

INSERT INTO `province` (`Province_id`, `Province_name`) VALUES
(1, 'กระบี่'),
(2, 'กรุงเทพ'),
(3, 'กาญจนบุรี'),
(4, 'กาฬสินธุ์'),
(5, 'กำแพงเพชร'),
(6, 'ขอนแก่น'),
(7, 'จันทบุรี'),
(8, 'ฉะเชิงเทรา'),
(9, 'ชลบุรี'),
(10, 'ชัยนาท'),
(11, 'ชัยภูมิ'),
(12, 'ชุมพร'),
(13, 'เชียงราย'),
(14, 'เชียงใหม่'),
(15, 'ตรัง'),
(16, 'ตราด'),
(17, 'ตาก'),
(18, 'นครนายก'),
(19, 'นครปฐม'),
(20, 'นครพนม'),
(21, 'นครราชสีมา'),
(22, 'นครศรีธรรมราช'),
(23, 'นครสวรรค์'),
(24, 'นนทบุรี'),
(25, 'นราธิวาส'),
(26, 'น่าน'),
(27, 'บุรีรัมย์'),
(28, 'ปทุมธานี'),
(29, 'ประจวบคีรีขันธ์'),
(30, 'ปราจีนบุรี'),
(31, 'ปัตตานี'),
(32, 'พระนครศรีอยุธยา'),
(33, 'พะเยา'),
(34, 'พังงา'),
(35, 'พัทลุง'),
(36, 'พิจิตร'),
(37, 'พิษณุโลก'),
(38, 'เพชรบุรี'),
(39, 'เพชรบูรณ์'),
(40, 'แพร่'),
(41, 'ภูเก็ต'),
(42, 'มหาสารคาม'),
(43, 'มุกดาหาร'),
(44, 'แม่ฮ่องสอน'),
(45, 'ยโสธร'),
(46, 'ยะลา'),
(47, 'ร้อยเอ็ด'),
(48, 'ระนอง'),
(49, 'ระยอง'),
(50, 'ราชบุรี'),
(51, 'ลพบุรี'),
(52, 'ลำปาง'),
(53, 'ลำพูน'),
(54, 'เลย'),
(55, 'ศรีสะเกษ'),
(56, 'สกลนคร'),
(57, 'สงขลา'),
(58, 'สตูล'),
(59, 'สมุทรปราการ'),
(60, 'สมุทรสงคราม'),
(61, 'สมุทรสาคร'),
(62, 'สระแก้ว'),
(63, 'สระบุรี'),
(64, 'สิงห์บุรี'),
(65, 'สุโขทัย'),
(66, 'สุพรรณบุรี'),
(67, 'สุราษฎร์ธานี'),
(68, 'สุรินทร์'),
(69, 'หนองคาย'),
(70, 'หนองบัวลำภู'),
(71, 'อ่างทอง'),
(72, 'อำนาจเจริญ'),
(73, 'อุดรธานี'),
(74, 'อุตรดิตถ์'),
(75, 'อุทัยธานี'),
(76, 'อุบลราชธานี'),
(77, 'บึงกาฬ');

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE `sale` (
  `Sale_id` varchar(10) NOT NULL,
  `Cust_id` varchar(8) NOT NULL,
  `Sale_date` datetime NOT NULL,
  `Net_price` decimal(6,2) NOT NULL,
  `Net_discount` decimal(6,2) NOT NULL,
  `Sale_status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sale`
--

INSERT INTO `sale` (`Sale_id`, `Cust_id`, `Sale_date`, `Net_price`, `Net_discount`, `Sale_status`) VALUES
('139', 'C0014', '2566-03-07 00:00:00', 300.00, 0.00, 0),
('SA001', 'C0002', '2017-11-02 00:00:00', 550.00, 0.00, 1),
('SA002', 'C0004', '2017-11-05 00:00:00', 5500.00, 0.00, 0),
('SA003', 'C0006', '2017-11-15 00:00:00', 8700.00, 0.00, 0),
('SA004', 'C0008', '2017-12-08 00:00:00', 9999.99, 425.00, 0),
('SA005', 'C0010', '2017-12-20 00:00:00', 9999.99, 570.00, 0),
('SA006', 'C0010', '2022-12-29 00:00:00', 9999.99, 5220.00, 1),
('SA008', 'C0008', '2566-02-27 00:00:00', 2800.00, 0.00, 0),
('SA009', 'C0003', '2566-02-27 00:00:00', 2800.00, 0.00, 0),
('SA111', 'C0010', '2566-02-27 00:00:00', 2800.00, 0.00, 0),
('SA112', 'C0003', '2566-02-27 00:00:00', 4500.00, 0.00, 0),
('SA113', 'C0001', '2566-02-27 00:00:00', 9000.00, 0.00, 0),
('SA114', 'C0004', '2566-02-27 00:00:00', 9000.00, 0.00, 0),
('SA115', 'C0007', '2566-02-27 00:00:00', 6000.00, 0.00, 0),
('SA116', 'C0003', '2566-02-27 00:00:00', 9000.00, 0.00, 0),
('SA117', 'C0006', '2566-02-27 00:00:00', 8400.00, 0.00, 0),
('SA118', 'C0002', '2566-02-27 00:00:00', 2000.00, 0.00, 0),
('SA119', 'C0003', '2566-02-27 00:00:00', 8000.00, 0.00, 0),
('SA120', 'C0016', '2566-02-27 00:00:00', 9999.99, 0.00, 0),
('SA121', 'C0015', '2566-02-27 00:00:00', 6000.00, 0.00, 0),
('SA122', 'C0001', '2566-02-27 00:00:00', 9999.99, 0.00, 0),
('SA123', 'C0008', '2566-02-27 00:00:00', 9999.99, 0.00, 0),
('SA124', 'C0006', '2566-02-27 00:00:00', 9999.99, 0.00, 0),
('SA125', 'C0004', '2566-02-27 00:00:00', 9999.99, 0.00, 0),
('SA126', 'C0003', '2566-02-27 00:00:00', 9999.99, 0.00, 0),
('SA127', 'C0006', '2566-02-27 00:00:00', 9999.99, 0.00, 0),
('SA128', 'C0002', '2566-02-27 00:00:00', 9999.99, 0.00, 0),
('SA129', 'C0003', '2566-02-27 00:00:00', 9999.99, 0.00, 0),
('SA130', 'C0003', '2566-02-27 00:00:00', 9999.99, 0.00, 0),
('SA131', 'C0002', '2566-02-27 00:00:00', 9999.99, 0.00, 0),
('SA132', 'C0002', '2566-02-27 00:00:00', 9999.99, 0.00, 0),
('SA133', 'C0004', '2566-03-07 00:00:00', 9999.99, 0.00, 0),
('SA134', 'C0004', '2566-03-07 00:00:00', 9999.99, 0.00, 0),
('SA135', 'C0010', '2566-03-07 00:00:00', 9999.99, 0.00, 0),
('SA136', 'C0006', '2566-03-07 00:00:00', 4200.00, 0.00, 0),
('SA137', 'C0006', '2566-03-07 00:00:00', 9999.99, 0.00, 0),
('SA138', 'C0004', '2566-03-07 00:00:00', 6000.00, 0.00, 0),
('SA139', 'C0008', '2566-03-07 00:00:00', 1800.00, 0.00, 0),
('SA140', 'C0007', '2566-03-07 00:00:00', 2300.00, 0.00, 0),
('SA141', 'C0009', '2566-03-07 00:00:00', 600.00, 0.00, 0),
('SA142', 'C0010', '2566-03-07 00:00:00', 9999.99, 0.00, 0),
('SA143', 'C0005', '2566-03-07 00:00:00', 6000.00, 0.00, 0),
('SA144', 'C0015', '2566-03-07 00:00:00', 200.00, 0.00, 0),
('SA145', 'C0021', '2566-03-08 00:00:00', 2800.00, 0.00, 0),
('SA146', 'C0020', '2566-03-08 00:00:00', 1800.00, 0.00, 0),
('SA147', 'C0001', '2566-03-08 00:00:00', 9999.99, 0.00, 0);

-- --------------------------------------------------------

--
-- Table structure for table `sale_detail`
--

CREATE TABLE `sale_detail` (
  `Sale_id` varchar(10) NOT NULL,
  `Pro_id` varchar(8) NOT NULL,
  `Amount` int(5) NOT NULL,
  `Sale_price` decimal(6,2) NOT NULL,
  `Discount` decimal(6,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sale_detail`
--

INSERT INTO `sale_detail` (`Sale_id`, `Pro_id`, `Amount`, `Sale_price`, `Discount`) VALUES
('139', 'PRO09', 3, 100.00, 0.00),
('SA001', 'PRO08', 2, 550.00, 0.00),
('SA002', 'PRO02', 1, 3100.00, 0.00),
('SA002', 'PRO04', 1, 1700.00, 0.00),
('SA002', 'PRO06', 1, 700.00, 0.00),
('SA003', 'PRO03', 1, 3500.00, 0.00),
('SA003', 'PRO05', 1, 1700.00, 0.00),
('SA003', 'PRO07', 10, 3500.00, 0.00),
('SA004', 'PRO06', 5, 3500.00, 0.00),
('SA004', 'PRO07', 5, 1750.00, 0.00),
('SA004', 'PRO08', 5, 2750.00, 0.00),
('SA004', 'PRO09', 5, 1250.00, 0.00),
('SA004', 'PRO10', 5, 3000.00, 300.00),
('SA004', 'PRO11', 5, 1250.00, 125.00),
('SA004', 'PRO12', 5, 3000.00, 0.00),
('SA005', 'PRO15', 2, 9500.00, 950.00),
('SA005', 'PRO16', 1, 9999.99, 1100.00),
('SA005', 'PRO17', 1, 8500.00, 850.00),
('SA005', 'PRO18', 5, 9999.99, 1750.00),
('SA005', 'PRO19', 1, 3200.00, 320.00),
('SA005', 'PRO20', 1, 2500.00, 250.00),
('SA006', 'PRO15', 2, 9500.00, 950.00),
('SA006', 'PRO16', 2, 9999.99, 1100.00),
('SA006', 'PRO17', 1, 8500.00, 850.00),
('SA006', 'PRO18', 5, 9999.99, 1750.00),
('SA006', 'PRO19', 1, 3200.00, 320.00),
('SA006', 'PRO20', 1, 2500.00, 250.00),
('SA112', 'PRO05', 1500, 3.00, 0.00),
('SA113', 'PRO03', 3000, 3.00, 0.00),
('SA114', 'PRO03', 3000, 3.00, 0.00),
('SA115', 'PRO05', 1500, 4.00, 0.00),
('SA116', 'PRO03', 3000, 3.00, 0.00),
('SA117', 'PRO06', 600, 14.00, 0.00),
('SA118', 'PRO10', 500, 4.00, 0.00),
('SA119', 'PRO15', 4000, 2.00, 0.00),
('SA120', 'PRO01', 2500, 10.00, 0.00),
('SA121', 'PRO05', 1, 1500.00, 0.00),
('SA122', 'PRO01', 10, 2500.00, 0.00),
('SA123', 'PRO01', 10, 2500.00, 0.00),
('SA124', 'PRO01', 10, 2500.00, 0.00),
('SA125', 'PRO01', 5, 2500.00, 0.00),
('SA126', 'PRO01', 1, 2500.00, 0.00),
('SA127', 'PRO01', 2, 2500.00, 0.00),
('SA128', 'PRO01', 2, 2500.00, 0.00),
('SA129', 'PRO01', 1, 2500.00, 0.00),
('SA130', 'PRO01', 5, 2500.00, 0.00),
('SA131', 'PRO01', 1, 2500.00, 0.00),
('SA132', 'PRO01', 1, 2500.00, 0.00),
('SA133', 'PRO03', 5, 3000.00, 0.00),
('SA134', 'PRO02', 2800, 5.00, 0.00),
('SA135', 'PRO05', 1, 1500.00, 0.00),
('SA136', 'PRO04', 1400, 3.00, 0.00),
('SA137', 'PRO06', 600, 6.00, 0.00),
('SA138', 'PRO04', 1400, 3.00, 0.00),
('SA139', 'PRO06', 1, 600.00, 0.00),
('SA140', 'PRO11', 1, 100.00, 0.00),
('SA141', 'PRO11', 3, 100.00, 0.00),
('SA142', 'PRO13', 1, 5000.00, 0.00),
('SA143', 'PRO03', 2, 3000.00, 0.00),
('SA144', 'PRO11', 1, 100.00, 0.00),
('SA145', 'PRO04', 1, 1400.00, 0.00),
('SA146', 'PRO06', 1, 600.00, 0.00),
('SA147', 'PRO01', 3, 2500.00, 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `shelf`
--

CREATE TABLE `shelf` (
  `Shelf_no` varchar(8) NOT NULL,
  `Shelf_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `shelf`
--

INSERT INTO `shelf` (`Shelf_no`, `Shelf_name`) VALUES
('SH01', 'ตู้โชว์หน้าร้าน'),
('SH02', 'ชั้นวางกำแพง'),
('SH03', 'ตู้หน้าร้าน'),
('SH04', 'ตู้หลังร้าน'),
('SH05', 'ล็อคเกอร์');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `Sup_id` varchar(8) NOT NULL,
  `Sup_name` varchar(50) NOT NULL,
  `Sup_Address` varchar(100) DEFAULT NULL,
  `Sup_tel` varchar(20) NOT NULL,
  `Contract_name` varchar(50) DEFAULT NULL,
  `Province_id` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`Sup_id`, `Sup_name`, `Sup_Address`, `Sup_tel`, `Contract_name`, `Province_id`) VALUES
('SUP00', 'ร้าน TATC', '11/11', '0894304218', 'คุณเฟิร์ท', 20),
('SUP01', 'ร้าน GUN Ammy', '44/89', '021654984', 'คุณ เก๋า', 9),
('SUP02', 'ร้าน มาแรง', '889/23', '039721651', 'คุณ พรต', 9),
('SUP03', 'ร้าน ซอมบี้', '226/58', '022151325', 'คุณ โก๋', 1),
('SUP04', 'ร้าน บ้านอารักขา', '12/41', '095181621', 'คุณ นนท์', 12),
('SUP05', 'ร้าน สถานีตำรวจชลบุรี', '33/8', '191', 'คุณ กิ๊ก', 9),
('SUP06', 'ร้าน Weapon for you', '55/55', '0323164588', 'คุณ มิ้ว', 50),
('SUP07', 'ร้าน กันกัน', '66/66', '0982181654', 'คุณ ฟ่า', 30),
('SUP08', 'ร้าน ปลอดภัยกว่ามีด', '77/77', '0970981519', 'คุณ ตาล', 1),
('SUP09', 'ร้าน นาวีนาวี', '88/88', '0231865484', 'คุณ นิ้ง', 9),
('SUP10', 'ร้าน สมปอง', '99/99', '0318154621', 'คุณ เดย์', 9),
('SUP11', 'ร้าน สามัญประจำบ้าน', '10/10', '0981816516', 'คุณ เนส', 9),
('SUP12', 'ร้าน Shotgun', '012/215', '0979051654', 'คุณ ตอง', 9),
('SUP13', 'ร้าน Handgun', '336/48', '0315184213', 'คุณ เเฮ่ม', 9),
('SUP14', 'ร้าน Run and gun', '954/51', '0856422442', 'คุณ บีม', 12),
('SUP15', 'ร้าน cover me', '29/56', '0318159985', 'คุณ เเชมม์', 9),
('SUP16', 'ร้าน top gun', '25/29', '0233484548', 'คุณ ช้าง', 12),
('SUP17', 'ร้าน manman', '87/47', '0368484621', 'คุณ ใหม่', 12),
('SUP18', 'ร้าน Gunta GTA', '68/45', '0564916519', 'คุณ เก้า', 9),
('SUP19', 'ร้าน PUBG', '24/46', '0381646516', 'คุณ สาย', 10),
('SUP20', 'ร้าน รักสงบ', '11/11', '0897455416', 'คุณ ชล', 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buy`
--
ALTER TABLE `buy`
  ADD PRIMARY KEY (`Buy_id`),
  ADD KEY `Emp_id` (`Emp_id`);

--
-- Indexes for table `buy_detail`
--
ALTER TABLE `buy_detail`
  ADD PRIMARY KEY (`buy_id`,`pro_id`),
  ADD KEY `pro_id` (`pro_id`);

--
-- Indexes for table `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`Cust_id`),
  ADD KEY `Province_id` (`Province_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`Emp_id`);

--
-- Indexes for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD PRIMARY KEY (`Pro_id`,`Order_id`),
  ADD KEY `Order_id` (`Order_id`),
  ADD KEY `Pro_id` (`Pro_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`Pro_id`),
  ADD KEY `Cate_id` (`Cate_id`),
  ADD KEY `Shelf_no` (`Shelf_no`),
  ADD KEY `Sup_id` (`Sup_id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`Cate_id`);

--
-- Indexes for table `product_order`
--
ALTER TABLE `product_order`
  ADD PRIMARY KEY (`Order_id`),
  ADD KEY `Cust_id` (`Cust_id`);

--
-- Indexes for table `product_return`
--
ALTER TABLE `product_return`
  ADD PRIMARY KEY (`Rel_id`,`Sale_id`,`Pro_id`),
  ADD KEY `Pro_id` (`Pro_id`),
  ADD KEY `Sale_id` (`Sale_id`);

--
-- Indexes for table `province`
--
ALTER TABLE `province`
  ADD PRIMARY KEY (`Province_id`);

--
-- Indexes for table `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`Sale_id`),
  ADD KEY `Cust_id` (`Cust_id`);

--
-- Indexes for table `sale_detail`
--
ALTER TABLE `sale_detail`
  ADD PRIMARY KEY (`Sale_id`,`Pro_id`),
  ADD KEY `Pro_id` (`Pro_id`),
  ADD KEY `Sale_id` (`Sale_id`);

--
-- Indexes for table `shelf`
--
ALTER TABLE `shelf`
  ADD PRIMARY KEY (`Shelf_no`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`Sup_id`),
  ADD KEY `Province_id` (`Province_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `product_return`
--
ALTER TABLE `product_return`
  MODIFY `Rel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buy`
--
ALTER TABLE `buy`
  ADD CONSTRAINT `buy_ibfk_1` FOREIGN KEY (`Emp_id`) REFERENCES `employee` (`Emp_id`);

--
-- Constraints for table `buy_detail`
--
ALTER TABLE `buy_detail`
  ADD CONSTRAINT `buy_detail_ibfk_1` FOREIGN KEY (`buy_id`) REFERENCES `buy` (`Buy_id`),
  ADD CONSTRAINT `buy_detail_ibfk_2` FOREIGN KEY (`pro_id`) REFERENCES `product` (`Pro_id`);

--
-- Constraints for table `customer`
--
ALTER TABLE `customer`
  ADD CONSTRAINT `customer_ibfk_1` FOREIGN KEY (`Province_id`) REFERENCES `province` (`Province_id`);

--
-- Constraints for table `order_detail`
--
ALTER TABLE `order_detail`
  ADD CONSTRAINT `order_detail_ibfk_1` FOREIGN KEY (`Order_id`) REFERENCES `product_order` (`Order_id`),
  ADD CONSTRAINT `order_detail_ibfk_2` FOREIGN KEY (`Pro_id`) REFERENCES `product` (`Pro_id`);

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`Cate_id`) REFERENCES `product_category` (`Cate_id`),
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`Shelf_no`) REFERENCES `shelf` (`Shelf_no`),
  ADD CONSTRAINT `product_ibfk_3` FOREIGN KEY (`Sup_id`) REFERENCES `supplier` (`Sup_id`);

--
-- Constraints for table `product_order`
--
ALTER TABLE `product_order`
  ADD CONSTRAINT `product_order_ibfk_1` FOREIGN KEY (`Cust_id`) REFERENCES `customer` (`Cust_id`);

--
-- Constraints for table `product_return`
--
ALTER TABLE `product_return`
  ADD CONSTRAINT `product_return_ibfk_1` FOREIGN KEY (`Sale_id`) REFERENCES `sale` (`Sale_id`),
  ADD CONSTRAINT `product_return_ibfk_2` FOREIGN KEY (`Pro_id`) REFERENCES `product` (`Pro_id`);

--
-- Constraints for table `sale`
--
ALTER TABLE `sale`
  ADD CONSTRAINT `sale_ibfk_1` FOREIGN KEY (`Cust_id`) REFERENCES `customer` (`Cust_id`);

--
-- Constraints for table `sale_detail`
--
ALTER TABLE `sale_detail`
  ADD CONSTRAINT `sale_detail_ibfk_1` FOREIGN KEY (`Sale_id`) REFERENCES `sale` (`Sale_id`),
  ADD CONSTRAINT `sale_detail_ibfk_2` FOREIGN KEY (`Pro_id`) REFERENCES `product` (`Pro_id`);

--
-- Constraints for table `supplier`
--
ALTER TABLE `supplier`
  ADD CONSTRAINT `supplier_ibfk_1` FOREIGN KEY (`Province_id`) REFERENCES `province` (`Province_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

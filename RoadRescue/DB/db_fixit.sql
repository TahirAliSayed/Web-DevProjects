-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2023 at 08:25 AM
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
-- Database: `db_fixit`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(11) NOT NULL,
  `admin_email` varchar(50) NOT NULL,
  `admin_password` varchar(50) NOT NULL,
  `admin_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `admin_email`, `admin_password`, `admin_name`) VALUES
(1, 'mechfinder@gmail.com', '123', 'Mech Finder'),
(3, 'fixitrepairs@gmail.com', 'fixit123', 'Adhin ');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_booking`
--

CREATE TABLE `tbl_booking` (
  `booking_id` int(11) NOT NULL,
  `booking_date` date NOT NULL,
  `booking_status` int(11) NOT NULL DEFAULT 0,
  `booking_amount` int(11) NOT NULL,
  `mechanic_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_booking`
--

INSERT INTO `tbl_booking` (`booking_id`, `booking_date`, `booking_status`, `booking_amount`, `mechanic_id`) VALUES
(18, '2023-11-07', 1, 8450, 6),
(19, '2023-11-07', 1, 8450, 6),
(20, '2022-11-28', 2, 1700, 2),
(21, '2023-10-17', 2, 3000, 1),
(22, '2023-11-07', 2, 8450, 6),
(23, '0000-00-00', 0, 0, 6);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_brand`
--

CREATE TABLE `tbl_brand` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_brand`
--

INSERT INTO `tbl_brand` (`brand_id`, `brand_name`) VALUES
(1, 'Bosch'),
(2, 'Motul'),
(3, 'Castrol'),
(4, 'Gulf Oil'),
(5, 'Servo'),
(6, 'Mobil'),
(7, 'Shell'),
(8, 'Valvoline'),
(9, 'Amaron'),
(10, 'Exide'),
(11, 'SF Sonic'),
(12, 'Prestone'),
(13, 'Apollo'),
(15, 'J K'),
(16, 'M R F'),
(17, 'BridgeStone'),
(18, 'GoodYear');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cart`
--

CREATE TABLE `tbl_cart` (
  `cart_id` int(11) NOT NULL,
  `cart_qty` int(11) NOT NULL DEFAULT 1,
  `cart_status` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_cart`
--

INSERT INTO `tbl_cart` (`cart_id`, `cart_qty`, `cart_status`, `product_id`, `booking_id`) VALUES
(81, 34, 1, 3, 18),
(82, 116, 1, 4, 18),
(83, 35, 1, 6, 18),
(84, 10, 1, 5, 19),
(85, 1, 1, 1, 20),
(86, 1, 1, 2, 20),
(87, 1, 1, 32, 21),
(88, 1, 1, 7, 22),
(89, 1, 1, 32, 22),
(90, 1, 0, 7, 23);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE `tbl_category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`category_id`, `category_name`) VALUES
(21, 'Engine Parts'),
(22, 'Suspension'),
(24, 'Brake Parts'),
(25, 'Transmission Parts'),
(26, 'Electrical Parts'),
(27, 'Body Parts'),
(28, 'Interior Parts'),
(29, 'Tyres and Wheels');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_complaint`
--

CREATE TABLE `tbl_complaint` (
  `complaint_id` int(11) NOT NULL,
  `complainttype_id` int(11) NOT NULL,
  `complaint_content` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT 0,
  `workshop_id` int(11) NOT NULL DEFAULT 0,
  `complaint_status` varchar(50) NOT NULL DEFAULT '0',
  `complaint_reply` varchar(50) NOT NULL DEFAULT 'Not Yet Replyed',
  `complaint_date` date NOT NULL,
  `shop_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_complaint`
--

INSERT INTO `tbl_complaint` (`complaint_id`, `complainttype_id`, `complaint_content`, `user_id`, `workshop_id`, `complaint_status`, `complaint_reply`, `complaint_date`, `shop_id`) VALUES
(10, 6, 'not conneting', 8, 0, '1', 'Thank u for info we will set right', '2023-01-02', 0),
(11, 6, 'Unavailable', 0, 1, '1', 'ok\r\n', '2023-10-03', 0),
(12, 10, 'shit srvice', 2, 0, '1', 'thanks', '2023-10-16', 0),
(13, 5, 'its too late', 0, 0, '0', 'Not Yet Replyed', '2023-11-07', 7);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_complainttype`
--

CREATE TABLE `tbl_complainttype` (
  `complainttype_id` int(11) NOT NULL,
  `complainttype_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_complainttype`
--

INSERT INTO `tbl_complainttype` (`complainttype_id`, `complainttype_name`) VALUES
(5, 'Long wait and Hold'),
(6, 'Unavailable'),
(7, 'Lack of Follow Up'),
(10, 'Doesn\'t Respond'),
(11, 'Poor Service'),
(12, 'No First Call Resolution');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_district`
--

CREATE TABLE `tbl_district` (
  `district_id` int(11) NOT NULL,
  `district_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_district`
--

INSERT INTO `tbl_district` (`district_id`, `district_name`) VALUES
(25, 'Kollam'),
(26, 'Pathanamthitta'),
(27, 'Alappuzha'),
(28, 'Kottayam'),
(29, 'Idukki'),
(30, 'Ernakulam'),
(31, 'Thrissur'),
(32, 'Palakkad'),
(33, 'Malapuram'),
(34, 'Kozhikode'),
(35, 'Wayanad'),
(36, 'Kannur'),
(37, 'Kasargod'),
(38, 'Thiruvananthapuram');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_feedback`
--

CREATE TABLE `tbl_feedback` (
  `feedback_id` int(11) NOT NULL,
  `feedback_content` varchar(40) NOT NULL,
  `feedback_date` date NOT NULL,
  `feedback_reply` varchar(40) NOT NULL DEFAULT 'Waiting',
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_feedback`
--

INSERT INTO `tbl_feedback` (`feedback_id`, `feedback_content`, `feedback_date`, `feedback_reply`, `user_id`) VALUES
(5, 'hello', '2022-12-05', 'Thank You', 2),
(6, ' Excellent Service', '2023-01-12', 'Thank u for your feedback\r\n', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_location`
--

CREATE TABLE `tbl_location` (
  `location_id` int(11) NOT NULL,
  `location_name` varchar(30) NOT NULL,
  `place_id` int(11) NOT NULL,
  `location_langitude` varchar(50) NOT NULL,
  `location_latitude` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_location`
--

INSERT INTO `tbl_location` (`location_id`, `location_name`, `place_id`, `location_langitude`, `location_latitude`) VALUES
(2, 'Pezhakkapilly', 23, '', ''),
(3, 'Kuttipilly', 27, '', ''),
(4, 'Allapra', 28, '', ''),
(5, 'Kilikulam', 27, '', ''),
(6, 'Kandanthara', 28, '', ''),
(7, 'Kummanode', 17, '', ''),
(8, 'Chengara', 17, '', ''),
(9, 'Ashokapuram', 62, '', ''),
(10, 'Choondy', 62, '', ''),
(11, 'Manjapra', 63, '', ''),
(12, 'Kavaraparambu', 63, '', ''),
(13, 'Thoppumpady', 64, '', ''),
(14, 'Palluruthy', 64, '', ''),
(15, 'Vathuruthy', 64, '', ''),
(16, 'Fort Kochi', 64, '', ''),
(17, 'Nellikuzhy', 65, '', ''),
(18, 'Nellimattom', 65, '', ''),
(19, 'Chelad', 65, '', ''),
(20, 'Thuruthiply', 66, '', ''),
(21, 'Vattakattupady', 28, '', ''),
(22, 'Kuttipadam', 66, '', ''),
(23, 'Kizhakkupuram', 32, '', ''),
(24, 'Kulathummal', 33, '', ''),
(25, 'Puthiyakavu', 34, '', ''),
(26, 'Melamcode', 35, '', ''),
(27, 'Cherukunnam', 36, '', ''),
(28, 'Karoda', 99, '', ''),
(29, 'Vellur', 95, '', ''),
(30, 'madamon', 108, '', ''),
(31, 'malayalapuzha', 110, '', ''),
(32, 'edathua', 51, '', ''),
(33, 'kanjirapally', 52, '', ''),
(34, 'villayadaserry', 49, '', ''),
(35, 'puthenpally', 54, '', ''),
(36, 'anicadu', 102, '', ''),
(37, 'Kappiset', 90, '', ''),
(38, 'keyaattingal', 32, '', ''),
(39, 'Ooruttambalam', 33, '', ''),
(40, 'Thattathumala', 34, '', ''),
(41, 'Vaalikodi', 35, '', ''),
(42, 'Ayoor', 37, '', ''),
(43, 'Chirakkara', 38, '', ''),
(44, 'Ochira', 39, '', ''),
(45, 'Nalllila', 40, '', ''),
(46, 'Thukkupalam', 41, '', ''),
(47, 'Mavalikara', 46, '', ''),
(48, 'Parakode', 47, '', ''),
(49, 'Eloor', 49, '', ''),
(50, 'Paipad', 51, '', ''),
(51, 'Thalappalam', 52, '', ''),
(52, 'Kothanallor', 53, '', ''),
(53, 'Lalam', 54, '', ''),
(54, 'Meenadom', 55, '', ''),
(55, 'Vranad', 56, '', ''),
(56, 'Koompanpara', 57, '', ''),
(57, 'Nedumkandam', 58, '', ''),
(58, 'Lambakada', 59, '', ''),
(59, 'Chakkuppalam', 60, '', ''),
(60, 'Thadiyampad', 61, '', ''),
(61, 'Choware', 62, '', ''),
(62, 'Vypin', 63, '', ''),
(63, 'Cheari', 64, '', ''),
(64, 'Thattekadi', 65, '', ''),
(65, 'Chengamanadu', 67, '', ''),
(66, 'Chalakduy', 68, '', ''),
(67, 'Mammiyoor', 69, '', ''),
(68, 'Mukundapuram', 70, '', ''),
(69, 'Koratty', 71, '', ''),
(70, 'Adichanallur', 32, '', ''),
(71, 'Attakulamkara', 32, '', ''),
(72, 'Kilimanoor', 34, '', ''),
(73, 'Palod', 35, '', ''),
(74, 'Kulathupuzha', 37, '', ''),
(75, 'Nedumbana', 38, '', ''),
(76, 'Odanavattom', 40, '', ''),
(77, 'Veliyam', 41, '', ''),
(78, 'Cherthala', 43, '', ''),
(79, 'Kayamkulam', 46, '', ''),
(80, 'Kaipattur', 47, '', ''),
(81, 'Nooranadu', 49, '', ''),
(82, 'Bharaniganam', 52, '', ''),
(83, 'Ettumanoor', 53, '', ''),
(84, 'Pala', 54, '', ''),
(85, 'Aruvikuzhi', 55, '', ''),
(86, 'Kokkamangalam', 56, '', ''),
(87, 'Vaisamvally', 57, '', ''),
(88, 'Kulumavu', 58, '', ''),
(89, '20 Acre', 59, '', ''),
(90, 'Nalam mile', 60, '', ''),
(91, 'Painavu', 61, '', ''),
(92, 'Kuttamasheri', 62, '', ''),
(93, 'Alleppey', 63, '', ''),
(94, 'Palarivattom', 64, '', ''),
(95, 'Ayyankavu', 65, '', ''),
(96, 'Mala', 67, '', ''),
(97, 'Chalakudy', 68, '', ''),
(98, 'Thikkad', 69, '', ''),
(99, 'Pullur', 70, '', ''),
(100, 'Kadukutty', 71, '', ''),
(101, 'Ottapalam', 72, '', ''),
(102, 'Pottassery', 73, '', ''),
(103, 'Kodalooor', 74, '', ''),
(104, 'Kulappully', 75, '', ''),
(105, 'Ayakkad', 76, '', ''),
(106, 'Palunda', 77, '', ''),
(107, 'Karunechi', 78, '', ''),
(108, 'Palliyal', 79, '', ''),
(109, 'Chaguvetty', 80, '', ''),
(110, 'Myladi', 81, '', ''),
(111, 'Mankvu', 82, '', ''),
(112, 'Melur', 83, '', ''),
(113, 'Parattupara', 84, '', ''),
(114, 'Adivaram', 85, '', ''),
(115, 'Purakkara', 86, '', ''),
(116, 'Muttil', 87, '', ''),
(117, 'Dashanakkara', 88, '', ''),
(118, 'Chungam', 89, '', ''),
(119, 'MunnanamKuzhi', 91, '', ''),
(120, 'Azhikode', 92, '', ''),
(121, 'Iritty', 93, '', ''),
(122, 'Anapalam', 94, '', ''),
(123, 'Kandankali', 95, '', ''),
(124, 'Kadiur', 96, '', ''),
(125, 'Kundili', 97, '', ''),
(126, 'Chettukundu', 98, '', ''),
(127, 'Parappadi', 100, '', ''),
(128, 'Mulinja', 101, '', ''),
(129, 'Vazhakulam', 102, '', ''),
(130, 'Chotupara', 103, '', ''),
(131, 'Vattavilla', 105, '', ''),
(132, 'Vakkom', 106, '', ''),
(133, 'Prakulam', 107, '', ''),
(134, 'Kuriyanoor', 108, '', ''),
(135, 'Muzhiyar', 109, '', ''),
(136, 'Arikkakavu', 111, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_mechanic`
--

CREATE TABLE `tbl_mechanic` (
  `mechanic_id` int(11) NOT NULL,
  `mechanic_name` varchar(30) NOT NULL,
  `mechanic_contact` varchar(10) NOT NULL,
  `mechanic_email` varchar(50) NOT NULL,
  `mechanic_address` varchar(100) NOT NULL,
  `mechanic_photo` varchar(20) NOT NULL,
  `workshop_id` int(11) NOT NULL,
  `mechanic_password` varchar(30) NOT NULL,
  `mechanic_doj` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_mechanic`
--

INSERT INTO `tbl_mechanic` (`mechanic_id`, `mechanic_name`, `mechanic_contact`, `mechanic_email`, `mechanic_address`, `mechanic_photo`, `workshop_id`, `mechanic_password`, `mechanic_doj`) VALUES
(1, 'Soman P', '9947652340', 'sp@gmail.com', 'Panayanchery (H),Choondy', 'images (18).jpeg', 1, '999', '2022-09-10'),
(2, 'Prabhakaran', '8765924106', 'prabha@gmail.com', 'Pattiparambil (H),Choondy', 'pic.png', 1, '888', '2022-09-10'),
(3, 'Mani K', '9857451254', 'mk@gmail.com', 'Parambil (H),Manjapra', 'images (21).jpeg', 2, '777', '2022-09-10'),
(4, 'Manoj M', '9856745895', 'mm@gmail.com', 'Madaparambil (H),Manjapra', 'images (3).png', 2, '888', '2022-09-10'),
(5, 'Alexander K', '9541028745', 'ak@gmail.com', 'Pilappilly (H),Manjapra', 'images (3).png', 2, '999', '2022-09-10'),
(6, 'Gopinathan K V', '8765456789', 'gopi@gmail.com', 'vazhathottathil (H) Pattimattom', 'download14.png', 3, '123456789', '2022-11-11'),
(10, 'Adhin Shaji', '9544366231', 'adhinshaji@gmail.com', 'Madapattel(ho)\r\nSasimala(po)\r\nPulpally \r\nParakkaduve\r\n673579', 'istockphoto-12891437', 1, 'adhinshaji8590', '2023-10-03');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_place`
--

CREATE TABLE `tbl_place` (
  `place_id` int(11) NOT NULL,
  `district_id` int(11) NOT NULL,
  `place_name` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_place`
--

INSERT INTO `tbl_place` (`place_id`, `district_id`, `place_name`) VALUES
(32, 24, 'Attingal'),
(33, 24, 'Kattakada'),
(34, 24, 'Kilimanoor'),
(35, 24, 'Nedumangad'),
(37, 25, 'Ayoor'),
(38, 25, 'Chathannoor'),
(39, 25, 'Karunagappalli'),
(40, 25, 'Kottarakkara'),
(41, 25, 'Punalur'),
(43, 26, 'Arookutty'),
(46, 27, 'Kayamkulam'),
(47, 27, 'Adoor'),
(49, 27, 'Pandalam'),
(51, 27, 'Thiruvalla'),
(52, 28, 'Erattupetta'),
(53, 28, 'Ettumanoor'),
(54, 28, 'Pala'),
(55, 28, 'Pampady'),
(56, 28, 'Vaikom'),
(57, 29, 'Adimali'),
(58, 29, 'Cheruthoni'),
(59, 29, 'Kattapana'),
(60, 29, 'Kumily'),
(61, 29, 'Painavu'),
(62, 30, 'Aluva'),
(63, 30, 'Angamaly'),
(64, 30, 'Kochi'),
(65, 30, 'Kothamangalam'),
(67, 31, 'Annamanada'),
(68, 31, 'Chalakudy'),
(69, 31, 'Guruvayur'),
(70, 31, 'Iringalakuda'),
(71, 31, 'Koratty'),
(72, 32, 'Manissery'),
(73, 32, 'Mannarkkad'),
(74, 32, 'Pattambi'),
(75, 32, 'Shoranur'),
(76, 32, 'Vadakkanchery'),
(77, 33, 'Chungathara'),
(78, 33, 'Edakkara'),
(79, 33, 'Kadampuzha'),
(80, 33, 'Kottakal'),
(81, 33, 'Nilambur'),
(82, 34, 'Kinassery'),
(83, 34, 'Koyilandy'),
(84, 34, 'Perambra'),
(85, 34, 'Thamarassery'),
(86, 34, 'Vatakara'),
(87, 35, 'Kalpetta'),
(88, 35, 'Mananthavady'),
(89, 35, 'Sulthan Batheri'),
(90, 35, 'Pulpally'),
(91, 35, 'Meenangadi'),
(92, 36, 'Azhikode'),
(93, 36, 'Iritty'),
(94, 36, 'Kadachira'),
(95, 36, 'Payyanur'),
(96, 36, 'Thalassery'),
(97, 37, 'Cheruvathur'),
(98, 37, 'Kanhangad'),
(99, 37, 'Manjeshwar'),
(100, 37, 'Puthur'),
(101, 37, 'Uppala'),
(102, 30, 'Muvattupuzha'),
(103, 30, 'Pattimattom'),
(105, 24, 'Neyyattinkara'),
(106, 24, 'Chirayinkeezhu'),
(107, 25, 'perinad'),
(108, 26, 'kozhencherry'),
(109, 26, 'Gavi'),
(110, 26, 'kumbazha'),
(111, 26, 'maniyar');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE `tbl_product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `product_details` varchar(50) NOT NULL,
  `product_photo` varchar(50) NOT NULL,
  `product_price` varchar(20) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`product_id`, `product_name`, `product_details`, `product_photo`, `product_price`, `shop_id`, `subcategory_id`, `type_id`, `brand_id`) VALUES
(7, 'Exide (55 Month Warrenty)', '40 Amp Hour', 'exide red new-min.png', '5450', 1, 39, 1, 10),
(8, 'Exide (55 Month Warrenty)', '40 Amp Hour', 'exide red new-min.png', '5450', 2, 39, 1, 10),
(9, 'Exide (55 Month Warrenty)', '40 Amp Hour', 'exide red new-min.png', '5450', 5, 39, 1, 10),
(10, 'Exide (55 Month Warrenty)', '40 Amp Hour', 'exide red new-min.png', '5450', 6, 39, 1, 10),
(11, 'Amaron (55 Month Warrenty)', '35Amp hour', 'amaron go new-min.png', '5650', 7, 39, 1, 9),
(12, 'Amaron (55 Month Warrenty)', '35Amp hour', 'amaron go new-min.png', '5650', 8, 39, 1, 9),
(13, 'Amaron (55 Month Warrenty)', '35Amp hour', 'amaron go new-min.png', '5650', 9, 39, 1, 9),
(14, 'Amaron (55 Month Warrenty)', '35Amp hour', 'amaron go new-min.png', '5650', 10, 39, 1, 9),
(15, 'Amaron (55 Month Warrenty)', '35Amp hour', 'amaron go new-min.png', '5650', 1, 39, 1, 9),
(16, 'Amaron (55 Month Warrenty)', '35Amp hour', 'amaron go new-min.png', '5650', 2, 39, 1, 9),
(17, 'Amaron (55 Month Warrenty)', '35Amp hour', 'amaron go new-min.png', '5650', 5, 39, 1, 9),
(18, 'Amaron (55 Month Warrenty)', '35Amp hour', 'amaron go new-min.png', '5650', 6, 39, 1, 9),
(20, 'Apollo Alnac 5GS', '• Size - 175/65 R15 84H  • 5 years warranty  • Tub', 'Apollo Alnac 4GS.jpg', '6090', 7, 59, 1, 13),
(21, 'Apollo Alnac 5GS', '• Size - 175/65 R15 84H  • 5 years warranty  • Tub', 'Apollo Alnac 4GS.jpg', '6090', 1, 59, 1, 13),
(22, 'Apollo Alnac 5GS', '• Size - 175/65 R15 84H  • 5 years warranty  • Tub', 'Apollo Alnac 4GS.jpg', '6090', 2, 59, 1, 13),
(23, 'Apollo Alnac 5GS', '• Size - 175/65 R15 84H  • 5 years warranty  • Tub', 'Apollo Alnac 4GS.jpg', '6090', 5, 59, 1, 13),
(24, 'Apollo Alnac 5GS', '• Size - 175/65 R15 84H  • 5 years warranty  • Tub', 'Apollo Alnac 4GS.jpg', '6090', 6, 59, 1, 13),
(25, 'Apollo Alnac 5GS', '• Size - 175/65 R15 84H  • 5 years warranty  • Tub', 'Apollo Alnac 4GS.jpg', '6090', 8, 59, 1, 13),
(26, 'Apollo Alnac 5GS', '• Size - 175/65 R15 84H  • 5 years warranty  • Tub', 'Apollo Alnac 4GS.jpg', '6090', 9, 59, 1, 13),
(27, 'Apollo Alnac 5GS', '• Size - 175/65 R15 84H  • 5 years warranty  • Tub', 'Apollo Alnac 4GS.jpg', '6090', 10, 59, 1, 13),
(32, 'adarsh', 'Mdapattel(ho) Sasimala(po) Pulpully parakkaduve', '5557.jpg', '3000', 1, 15, 3, 4),
(33, 'Adhin Shaji', 'Mdapattel(ho) Sasimala(po) Pulpully parakkaduve', 'pic.png', '5000', 7, 15, 4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_request`
--

CREATE TABLE `tbl_request` (
  `request_id` int(11) NOT NULL,
  `workshop_id` int(11) NOT NULL,
  `request_details` varchar(100) NOT NULL,
  `user_id` int(11) NOT NULL,
  `request_date` date NOT NULL,
  `request_status` varchar(20) NOT NULL DEFAULT '0',
  `payment_status` varchar(20) NOT NULL DEFAULT '0',
  `mechanic_id` int(11) NOT NULL,
  `request_bill` varchar(100) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_request`
--

INSERT INTO `tbl_request` (`request_id`, `workshop_id`, `request_details`, `user_id`, `request_date`, `request_status`, `payment_status`, `mechanic_id`, `request_bill`) VALUES
(27, 3, 'dfghdfsyh', 1, '2022-12-27', '6', '0', 6, 'download (2).jfif'),
(28, 3, 'dfghdfsyh', 1, '2022-12-27', '4', '0', 6, ''),
(29, 1, 'my car not starting', 10, '2023-03-02', '6', '0', 2, ''),
(30, 9, 'tire puncher', 8, '2023-10-03', '6', '0', 10, '42e98_7e2e9_Auto_Repair_Invoice_Template.png'),
(31, 9, 'I want  to change my tire.', 9, '2023-10-06', '5', '0', 2, ''),
(32, 1, 'on road assitance required\r\n', 2, '2023-10-16', '0', '0', 0, ''),
(33, 1, 'engine damage', 2, '2023-10-17', '3', '0', 10, ''),
(34, 1, 'hello', 1, '2023-10-17', '6', '0', 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_shop`
--

CREATE TABLE `tbl_shop` (
  `shop_id` int(11) NOT NULL,
  `shop_name` varchar(50) NOT NULL,
  `shop_contact` varchar(10) NOT NULL,
  `shop_email` varchar(50) NOT NULL,
  `shop_address` varchar(50) NOT NULL,
  `shop_logo` varchar(50) NOT NULL,
  `shop_proof` varchar(50) NOT NULL,
  `shop_password` varchar(40) NOT NULL,
  `shop_doj` date NOT NULL,
  `shop_location` int(11) NOT NULL,
  `shop_status` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_shop`
--

INSERT INTO `tbl_shop` (`shop_id`, `shop_name`, `shop_contact`, `shop_email`, `shop_address`, `shop_logo`, `shop_proof`, `shop_password`, `shop_doj`, `shop_location`, `shop_status`) VALUES
(1, 'C4 Car Accessories', '9845325678', 'c4@gmail.com', 'C4 Car Accessories Choondy Aluva', 'IMG_20220804_095805.jpg', 'download.jpeg', '576447656', '2022-09-10', 10, 1),
(2, 'Taj Automobiles', '9865347524', 'taj@gmail.com', 'Taj Automobiles Manjapra Angamaly', 'images (13).jpeg', 'images (3).png', '87687678576', '2022-09-10', 11, 1),
(5, 'SK Automotive', '7012376611', 'skauto@gmail.com', 'SK Automotive,Vazhapilly,Muvattupzha', 'images (4).png', 'download (3).jfif', '12345678', '2022-11-19', 1, 1),
(6, 'Auto Parts', '7614800275', 'ap@gmail.com', 'Auto Parts, Puthiyakavu, Kilimanoor P.O', 'download (8).jfif', 'download.jfif', '13579864', '2023-01-07', 25, 0),
(7, 'Roger Car Accessories', '9845325678', 'roger@gmail.com', 'Roger Car Accessories  Kilikulam Perumbavoor', 'IMG_20220804_095805.jpg', '2.jpg', '576447656', '2022-09-10', 5, 1),
(8, ' Drago Automobiles', '9865347524', 'drago@gmail.com', 'Drago Automobiles Ashokapuram Aluva', 'images (13).jpeg', 'widget-table-pic2.png', '87687678576', '2022-09-10', 9, 1),
(9, 'Tech Automotive', '7012376611', 'techauto@gmail.com', 'Tech Automotive,Pezhakkapilly,Muvattupzha', 'images (4).png', 'team-3,jpg', '12345678', '2022-11-19', 2, 1),
(10, 'spare Parts', '7614800275', 'spb@gmail.com', 'Spare Parts, Allapra Perumbavoor', 'download (8).jfif', '3.png', '13579864', '2023-01-07', 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_stock`
--

CREATE TABLE `tbl_stock` (
  `stock_id` int(11) NOT NULL,
  `stock_date` date NOT NULL,
  `stock_qty` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_stock`
--

INSERT INTO `tbl_stock` (`stock_id`, `stock_date`, `stock_qty`, `product_id`) VALUES
(9, '2023-03-02', 50, 7),
(10, '2023-03-02', 30, 8),
(11, '2023-03-02', 50, 9),
(12, '2023-03-02', 30, 10),
(13, '2023-03-02', 50, 11),
(14, '2023-03-02', 30, 20),
(15, '2023-10-04', 5, 31),
(16, '2023-10-04', 50, 9),
(17, '2023-10-17', 200, 32);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subcategory`
--

CREATE TABLE `tbl_subcategory` (
  `subcategory_id` int(11) NOT NULL,
  `subcategory_name` varchar(50) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_subcategory`
--

INSERT INTO `tbl_subcategory` (`subcategory_id`, `subcategory_name`, `category_id`) VALUES
(15, 'Pistons and Rings', 21),
(16, 'Bearings and Bushes', 21),
(17, 'Timing Belts and Chains', 21),
(18, 'Oil Pumps and Filters', 21),
(19, 'Gaskets and Seals', 21),
(20, 'Water Pumps and Thermostat', 21),
(21, 'Fuel Injectors and Pumps', 21),
(22, 'Ignition Coils and Spark Plugs', 21),
(23, 'Shocks and Struts', 22),
(24, 'Control Arms and Ball Joints', 22),
(25, 'Steering Stabilizers and Dampers', 22),
(26, 'Brake Pads and Shoes', 24),
(27, 'Brake Rotors and Drums', 24),
(28, 'Calibers and Wheel Cylinders', 24),
(29, 'Lines and Hoses', 24),
(31, 'Cables and Levers', 24),
(32, 'Fluids', 24),
(33, 'Clutch Kits and Flywheels', 25),
(34, 'Filters and Fluids', 25),
(35, 'Mounts and Bushings', 25),
(36, 'Gear Sets and Bearings', 25),
(39, 'Batteries and Cables', 26),
(40, 'Alternators and Generators', 26),
(41, 'Alternators and Generators', 26),
(42, 'Alternators and Generators', 26),
(43, 'Alternators and Generators', 26),
(44, 'Starters and Solenoids', 26),
(45, 'Wires', 26),
(46, 'Fuses and Circuit Breakers', 26),
(47, 'Switches and Bulbs', 26),
(48, 'Bumpers and Grills', 27),
(49, 'Doors and Windows', 27),
(50, 'Hoods and Trunks', 27),
(51, 'Mirrors and Glass', 27),
(52, 'Fenders', 27),
(53, 'Seats and Covers', 28),
(54, 'Mats and Carpets', 28),
(55, 'Dashboards', 28),
(56, 'Door Panels', 28),
(57, 'Steering Wheels and Horns', 28),
(58, 'Gear Knobs and Pedal Pads', 28),
(59, 'Tyres and Tubes', 29),
(60, 'Wheels and Rims', 29),
(61, 'Wheel Bearing and Seals', 29),
(62, 'Wheel Balancers and Aligners', 29),
(63, 'Oil', 21);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_type`
--

CREATE TABLE `tbl_type` (
  `type_id` int(11) NOT NULL,
  `type_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_type`
--

INSERT INTO `tbl_type` (`type_id`, `type_name`) VALUES
(1, 'Car'),
(2, 'Bike'),
(3, 'Heavy'),
(4, 'All');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(30) NOT NULL,
  `user_contact` varchar(10) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_gender` varchar(10) NOT NULL,
  `user_address` varchar(100) NOT NULL,
  `user_dob` date NOT NULL,
  `place_id` int(11) NOT NULL,
  `user_photo` varchar(30) NOT NULL,
  `user_password` varchar(20) NOT NULL,
  `user_doj` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `user_name`, `user_contact`, `user_email`, `user_gender`, `user_address`, `user_dob`, `place_id`, `user_photo`, `user_password`, `user_doj`) VALUES
(1, 'David Paul', '9854235687', 'abhith@gmail.com', 'Male', 'Madathiparambil (H),Aluva', '1993-04-01', 62, 'images (20).jpeg', '15151', '2022-09-10'),
(2, 'Mariya Joy', '9998885472', 'mj@gmail.com', 'Female', 'Vettukattil (H),Angamaly', '1999-06-04', 63, 'images (24).jpeg', '657435323', '2022-09-10'),
(4, 'Rajan ', '8769544356', 'rajan@gmail.com', 'Male', 'Madathiparambil (H),Allapra', '1975-12-30', 66, 'download.jpeg', '7434353535', '2022-09-16'),
(6, 'Basil Mathu', '8075254998', 'basil23@gmail.com', 'Male', 'Njattukalil(H) Varkala', '2002-02-05', 36, 'images (10).jfif', 'basil1234', '2022-12-22'),
(8, 'Alan Joy', '2354765467', 'alanj123@gmail.com', 'Male', 'Pulikkal (H) Nedumagad', '2000-12-23', 35, 'download (2).jfif', 'alan12345', '2023-01-02'),
(9, 'Aswin R', '8521963475', 'aswinr@gmail.com', 'Male', 'Kottarathil (H), Mananthavady', '1998-05-28', 88, 'images.png', '78965432', '2023-01-07'),
(10, 'Chandran P', '8653644820', 'chandranp@gmail.com', 'Male', 'Kuzhimundayil (H), Thamarassery', '1989-01-27', 85, 'images (1).jfif', '12345678', '2023-01-07'),
(11, 'Jiraiya Galet', '6747667645', 'jiraya@gmail.com', 'Male', '156S (H) Chalakudy', '2000-11-23', 68, '1-old.jpg', 'ddddddddd', '2023-03-02'),
(12, 'athul', '9745162689', 'athul@gmail.com', 'Male', 'lhoesiou[oesuophxpi]l.khsoihp9ao[', '2021-12-31', 43, 'f20049b8fad05d06d03a425db86121', 'password', '2023-09-18'),
(13, 'Adithi', '6564478686', 'adity@GMAIL.COM', 'Female', 'puthenpurrakal house p.o maniyar', '2002-05-04', 38, 'f20049b8fad05d06d03a425db86121', 'aditya123', '2023-10-03'),
(14, 'Adithya P Shine', '9895533550', 'adithyaps@gmail.com', 'Female', 'NORTH CENTER SQUARE PO KANNUR 986549', '2003-08-02', 93, 'unnamed.webp', 'adithya123', '2023-10-03');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_workshop`
--

CREATE TABLE `tbl_workshop` (
  `workshop_id` int(11) NOT NULL,
  `workshop_name` varchar(30) NOT NULL,
  `workshop_contact` varchar(10) NOT NULL,
  `workshop_email` varchar(50) NOT NULL,
  `workshop_address` varchar(50) NOT NULL,
  `workshop_logo` varchar(100) NOT NULL,
  `workshop_proof` varchar(50) NOT NULL,
  `workshop_password` varchar(30) NOT NULL,
  `workshop_doj` date NOT NULL,
  `workshoptype_id` int(11) NOT NULL,
  `workshop_location` int(11) NOT NULL,
  `workshop_status` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_workshop`
--

INSERT INTO `tbl_workshop` (`workshop_id`, `workshop_name`, `workshop_contact`, `workshop_email`, `workshop_address`, `workshop_logo`, `workshop_proof`, `workshop_password`, `workshop_doj`, `workshoptype_id`, `workshop_location`, `workshop_status`) VALUES
(1, 'MS Motors', '7598426851', 'ms@gmail.com', 'MS Motors,Choondy,Aluva', 'images (12).jpeg', 'images (22).jpeg', '679687658', '2022-09-10', 2, 10, 1),
(2, 'MotorWorks', '9588420426', 'rxanto93@gmail.co', 'MotorWorks,Manjapra,Angamaly', 'images (11).jpeg', 'images (3).png', '675857978', '2022-09-10', 4, 11, 1),
(3, 'Lal Auto Workshop', '9447205882', 'lal@gmail.com', 'Lal Auto Workshop,Kilimanoor P.O,Puthiyakavu', 'images (9).jpeg', 'download.jpeg', 'lalan999', '2022-10-07', 3, 25, 1),
(5, 'Carz Tech', '7538296410', 'ct@gmail.com', 'Carz Tech,Nellikuzhy,Kothamangalam', 'images (2).png', 'images (8).jfif', '85296374', '2022-11-19', 3, 17, 1),
(6, 'Omega Motors', '9446141280', 'ms@gmail.com', 'Omega Motors,Muvattupuzha', 'download (1).png', 'images (1).jfif', 'omega1234', '2022-12-22', 2, 1, 0),
(7, '4 wheel Hub', '9512348756', '4wheelh@gmail.com', '4 Wheel Hub, Karoda, Manjeshwar P.O', 'images (2).png', 'download (2).jfif', '09876543', '2023-01-07', 3, 28, 2),
(9, 'High tech automobiles', '8075501396', 'abhith@gmail.com', 'mathiyathu(ho) koottar(po),685515', 'automobilerepair1-1.jpg', 'download.jpg', 'abhith123', '2023-10-03', 8, 89, 1),
(10, 'Driveway Medics', '8590903116', 'drivewaymedics@gmail.comA', 'Driveway Medics\nkappiset \npulpally\noppsite ration ', 'download (1).jpg', 'download.jpg', 'Driveway123', '2023-10-04', 8, 37, 0),
(11, 'abcd', '7896541235', 'adarsh@gmail.com', 'Mathiyathu ', 'download.jpg', 'voterid2.jpg', 'adarsh123', '2023-10-18', 2, 58, 0),
(12, 'Craft ‘N’ Go', '8562320151', 'craftandgo@gmail.com', 'Craft ‘N’ Go\r\nkappiset opposite ration shop\r\npulpa', 'craft and go.png', 'proof.png', 'craftandgo123', '2023-10-30', 3, 37, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_workshoptype`
--

CREATE TABLE `tbl_workshoptype` (
  `workshoptype_id` int(11) NOT NULL,
  `workshoptype_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_workshoptype`
--

INSERT INTO `tbl_workshoptype` (`workshoptype_id`, `workshoptype_name`) VALUES
(2, '2 Wheeler'),
(3, '4 Wheeler'),
(6, '6 Wheeler'),
(7, 'Heavy'),
(8, 'All');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  ADD PRIMARY KEY (`booking_id`);

--
-- Indexes for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `tbl_complaint`
--
ALTER TABLE `tbl_complaint`
  ADD PRIMARY KEY (`complaint_id`);

--
-- Indexes for table `tbl_complainttype`
--
ALTER TABLE `tbl_complainttype`
  ADD PRIMARY KEY (`complainttype_id`);

--
-- Indexes for table `tbl_district`
--
ALTER TABLE `tbl_district`
  ADD PRIMARY KEY (`district_id`);

--
-- Indexes for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indexes for table `tbl_location`
--
ALTER TABLE `tbl_location`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `tbl_mechanic`
--
ALTER TABLE `tbl_mechanic`
  ADD PRIMARY KEY (`mechanic_id`);

--
-- Indexes for table `tbl_place`
--
ALTER TABLE `tbl_place`
  ADD PRIMARY KEY (`place_id`);

--
-- Indexes for table `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `tbl_request`
--
ALTER TABLE `tbl_request`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `tbl_shop`
--
ALTER TABLE `tbl_shop`
  ADD PRIMARY KEY (`shop_id`);

--
-- Indexes for table `tbl_stock`
--
ALTER TABLE `tbl_stock`
  ADD PRIMARY KEY (`stock_id`);

--
-- Indexes for table `tbl_subcategory`
--
ALTER TABLE `tbl_subcategory`
  ADD PRIMARY KEY (`subcategory_id`);

--
-- Indexes for table `tbl_type`
--
ALTER TABLE `tbl_type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_workshop`
--
ALTER TABLE `tbl_workshop`
  ADD PRIMARY KEY (`workshop_id`);

--
-- Indexes for table `tbl_workshoptype`
--
ALTER TABLE `tbl_workshoptype`
  ADD PRIMARY KEY (`workshoptype_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_booking`
--
ALTER TABLE `tbl_booking`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `tbl_brand`
--
ALTER TABLE `tbl_brand`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_cart`
--
ALTER TABLE `tbl_cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tbl_complaint`
--
ALTER TABLE `tbl_complaint`
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_complainttype`
--
ALTER TABLE `tbl_complainttype`
  MODIFY `complainttype_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_district`
--
ALTER TABLE `tbl_district`
  MODIFY `district_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_location`
--
ALTER TABLE `tbl_location`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT for table `tbl_mechanic`
--
ALTER TABLE `tbl_mechanic`
  MODIFY `mechanic_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_place`
--
ALTER TABLE `tbl_place`
  MODIFY `place_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `tbl_request`
--
ALTER TABLE `tbl_request`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tbl_shop`
--
ALTER TABLE `tbl_shop`
  MODIFY `shop_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_stock`
--
ALTER TABLE `tbl_stock`
  MODIFY `stock_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `tbl_subcategory`
--
ALTER TABLE `tbl_subcategory`
  MODIFY `subcategory_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `tbl_type`
--
ALTER TABLE `tbl_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_workshop`
--
ALTER TABLE `tbl_workshop`
  MODIFY `workshop_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_workshoptype`
--
ALTER TABLE `tbl_workshoptype`
  MODIFY `workshoptype_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

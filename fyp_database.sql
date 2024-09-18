-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2022 at 04:39 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fyp_database`
--

CREATE DATABASE fyp_database;

USE fyp_database;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `quantity` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `name`, `price`, `image`, `quantity`) VALUES
(23, 7, 'Unitek Cable UTP Cat6 PC-HUB', '89', 'Cable_UTP_Cat6.jpg', 1),
(24, 7, 'Logitech G560 LIGHTSYNC PC Gaming Speake', '799', 'Logitech_G560_LIGHTSYNC.jpg', 1),
(29, 6, 'Logitech G560 LIGHTSYNC PC Gaming Speake', '799', 'Logitech_G560_LIGHTSYNC.jpg', 1),
(30, 1, 'Asus Vivobook M1502I-AE8163WS Laptop (AM', '3099', 'asus_vivobook_M1502I.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(35) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `description`) VALUES
(3, 'PC & LAPTOPS', 'pc & laptops contain apple, microsoft surface, laptops, gaming laptops, desktop pc, computer parts, software, laptop bags, accessories.'),
(4, 'STORAGE', 'storage contain hard drives, solid state drives (SSD), flash drives, memory cards, network attached storage (NAS).'),
(5, 'AUDIO', 'audio contain headphones & headsets, speakers, microphone, digital voice recorders.'),
(6, 'NETWORKING', 'networking contain WI-FI 6, wireless routers, home plug, WI-FI range extenders, wireless adapters, network switches, IP cameras, repeater'),
(7, 'GAMING', 'gaming contain gaming mouse, gaming keyboard, gaming audio, gaming console.');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `chat_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `chat_message` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login_details`
--

CREATE TABLE `login_details` (
  `login_details_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `last_activity` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_type` enum('no','yes') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `number` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `method` varchar(255) NOT NULL,
  `flat` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `postal_code` varchar(255) NOT NULL,
  `total_product` varchar(255) NOT NULL,
  `total_price` varchar(255) NOT NULL,
  `delivery_mode` varchar(255) NOT NULL,
  `store_send` varchar(255) NOT NULL,
  `delivery_status` varchar(255) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `name`, `number`, `email`, `method`, `flat`, `street`, `city`, `state`, `country`, `postal_code`, `total_product`, `total_price`, `delivery_mode`, `store_send`, `delivery_status`, `date`) VALUES
(6, 'Fong Jun Yi', '0127184553', 'fongjunyi11@gmail.com', 'cash on delivery', 'No27, Jalan Bunga Raya', '5/1, Taman Bunga Raya', 'Kuala Lumpur', 'Kuala Lumpur', 'Malaysia', '53000', 'Unitek Cable UTP Cat6 PC-HUB (1) , Logitech G560 LIGHTSYNC PC Gaming Speake (1) ', '888', '', 'Mega Tech Ipoh Computer Store', 'Packaging', '2022-12-08'),
(7, 'Nano', '0178789989', 'nano@gmail.com', 'cash on delivery', 'No29', 'Jalan Genting Klang', 'Setapak', 'Kuala Lumpur', 'Malaysia', '53300', 'Unitek Cable UTP Cat6 PC-HUB (1) , Logitech G560 LIGHTSYNC PC Gaming Speake (1) , Acer Gaming Laptop Nitro 5 AN515-46-R5DM (1) , Unitek Cable UTP Cat6 PC-HUB (2) ', '3278', '', 'Mega Tech Melaka Computer Store', 'Packaging', '2022-12-08'),
(8, 'Nano', '01789899001', 'nano@gmail.com', 'credit cart', 'No27, Jalan Bunga Raya', '5/1, Taman Bunga Raya', 'Setapak', 'Kuala Lumpur', 'Malaysia', '53000', 'Unitek Cable UTP Cat6 PC-HUB (1) , Logitech G560 LIGHTSYNC PC Gaming Speake (1) , Logitech G560 LIGHTSYNC PC Gaming Speake (1) ', '799', '', 'HQ Mega Tech Computer Store', 'Packaging', '2022-12-08');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `description` text NOT NULL,
  `price` double NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `store_id` int(11) NOT NULL,
  `store_name` varchar(255) NOT NULL,
  `store_type` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `name`, `description`, `price`, `category_name`, `store_id`, `store_name`, `store_type`, `quantity`, `image`) VALUES
(34, 'G15 Gaming Laptop', 'Operating System : Available with Windows 11: Gaming is better than ever on Windows, with games in 4K, DirectX 12 and gameplay streaming.*', 3849, 'PC & LAPTOPS', 3, 'HQ Mega Tech Computer Store', 'Headquarters', 800, 'G15_gaming_laptop.jpg'),
(35, 'Asus Vivobook M1502I-AE8163WS Laptop (AM', 'SPECIFICATIONS:Processor: AMD Ryzen™ 7 4800H Mobile .Processor Memory: 8GB DDR4 on board (Extra 1x Sodimm slot) .Storage: 512GB M.2 NVMe™ PCIe® 3.0 SSD. Graphic Card: AMD Radeon™ Graphics. Display:Touch screen,15.6-inch, FHD (1920 x 1080) 16:9 aspect ratio,IPS-level Panel, 45% NTSC color gamut for non-OLED,Anti-glare display, Screen-to-body ratio: 82 ％', 3099, 'PC & LAPTOPS', 3, 'HQ Mega Tech Computer Store', 'Headquarters', 1221, 'asus_vivobook_M1502I.jpg'),
(36, 'Logitech G560 LIGHTSYNC PC Gaming Speake', 'PART NUMBER :Black: 980-001304\r\nWARRANTY INFORMATION :1-Year Limited Hardware Warranty\r\nSYSTEM REQUIREMENTS:Windows¬®10, Windows 8.1, or Windows 7\r\nmacOSX (DTS:X not supported)\r\nUSB port for PCs or 3.5 mm audio port for PC and mobile\r\nBluetooth :enabled devices including a computer, smartphone, tablet and music player\r\nInternet access for Logitech Gaming Software and DTS:X surround sound software installation2', 799, 'AUDIO', 3, 'HQ Mega Tech Computer Store', 'Headquarters', 1550, 'Logitech_G560_LIGHTSYNC.jpg'),
(37, 'JBL Quantum Duo PC Gaming Speakers', 'Level up with powerful JBL Quantum Duo PC gaming speakers. Go deeper into the action with pitch-perfect sound and unique lighting effects. Easily pinpoint incoming fire, hear enemies creeping up on you and feel the roar of explosive action. With JBL proprietary gaming surround sound and Dolby Digital in a cool, distinctive design. Never miss a step, shot or jump with exposed drivers and tweeters for incredible sound clarity. With the different colour presets and lighting patterns to personalize your setup, gaming has never felt more real.', 800, 'AUDIO', 3, 'HQ Mega Tech Computer Store', 'Headquarters', 770, 'JBL_Quantum_Duo.jpg'),
(49, 'G15 Gaming Laptop', 'Operating System : Available with Windows 11: Gaming is better than ever on Windows, with games in 4K, DirectX 12 and gameplay streaming.*', 3849, 'PC & LAPTOPS', 5, 'Mega Tech Johor Computer Store', 'Branch', 100, 'G15_gaming_laptop.jpg'),
(50, 'Asus Vivobook M1502I-AE8163WS Laptop (AM', 'SPECIFICATIONS:Processor: AMD Ryzen™ 7 4800H Mobile .Processor Memory: 8GB DDR4 on board (Extra 1x Sodimm slot) .Storage: 512GB M.2 NVMe™ PCIe® 3.0 SSD. Graphic Card: AMD Radeon™ Graphics. Display:Touch screen,15.6-inch, FHD (1920 x 1080) 16:9 aspect ratio,IPS-level Panel, 45% NTSC color gamut for non-OLED,Anti-glare display, Screen-to-body ratio: 82 ％', 3099, 'PC & LAPTOPS', 6, 'Mega Tech Penang Computer Store', 'Branch', 500, 'asus_vivobook_M1502I.jpg'),
(51, 'JBL Quantum Duo PC Gaming Speakers', 'Level up with powerful JBL Quantum Duo PC gaming speakers. Go deeper into the action with pitch-perfect sound and unique lighting effects. Easily pinpoint incoming fire, hear enemies creeping up on you and feel the roar of explosive action. With JBL proprietary gaming surround sound and Dolby Digital in a cool, distinctive design. Never miss a step, shot or jump with exposed drivers and tweeters for incredible sound clarity. With the different colour presets and lighting patterns to personalize your setup, gaming has never felt more real.', 800, 'AUDIO', 8, 'Mega Tech Kedah Computer Store', 'Branch', 130, 'JBL_Quantum_Duo.jpg'),
(52, 'Logitech G560 LIGHTSYNC PC Gaming Speake', 'PART NUMBER :Black: 980-001304\r\nWARRANTY INFORMATION :1-Year Limited Hardware Warranty\r\nSYSTEM REQUIREMENTS:Windows¬®10, Windows 8.1, or Windows 7\r\nmacOSX (DTS:X not supported)\r\nUSB port for PCs or 3.5 mm audio port for PC and mobile\r\nBluetooth :enabled devices including a computer, smartphone, tablet and music player\r\nInternet access for Logitech Gaming Software and DTS:X surround sound software installation2', 799, 'AUDIO', 5, 'Mega Tech Johor Computer Store', 'Branch', 250, 'Logitech_G560_LIGHTSYNC.jpg'),
(53, 'Asus Vivobook M1502I-AE8163WS Laptop (AM', 'SPECIFICATIONS:Processor: AMD Ryzen™ 7 4800H Mobile .Processor Memory: 8GB DDR4 on board (Extra 1x Sodimm slot) .Storage: 512GB M.2 NVMe™ PCIe® 3.0 SSD. Graphic Card: AMD Radeon™ Graphics. Display:Touch screen,15.6-inch, FHD (1920 x 1080) 16:9 aspect ratio,IPS-level Panel, 45% NTSC color gamut for non-OLED,Anti-glare display, Screen-to-body ratio: 82 ％', 3099, 'PC & LAPTOPS', 4, 'Mega Tech Melaka Computer Store', 'Branch', 82, 'asus_vivobook_M1502I.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `promotion`
--

CREATE TABLE `promotion` (
  `promo_id` int(11) NOT NULL,
  `title` varchar(40) NOT NULL,
  `description` text NOT NULL,
  `promo_code` varchar(6) NOT NULL,
  `expiry_date` date NOT NULL,
  `discount_rate` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `promotion`
--

INSERT INTO `promotion` (`promo_id`, `title`, `description`, `promo_code`, `expiry_date`, `discount_rate`) VALUES
(4, '12.12 promotion', '12.12 promotion ', 'xxKH8v', '2022-12-19', 20),
(5, '11.11 promotion', '11.11 promotion', 'QlR6MC', '2022-11-11', 35),
(6, 'Black Firday', 'black firday big big offer in today', 'xMu7bF', '2022-12-30', 50),
(7, 'Summer promotion', '25% summer offer', 'rQhR9y', '2022-08-31', 25),
(8, 'Year end offer', 'Big discount at the end of the year', 'cp7K5t', '2022-12-31', 35);

-- --------------------------------------------------------

--
-- Table structure for table `rating`
--

CREATE TABLE `rating` (
  `rate_id` int(11) NOT NULL,
  `pid` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `rate` int(255) NOT NULL,
  `comment` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rating`
--

INSERT INTO `rating` (`rate_id`, `pid`, `name`, `rate`, `comment`) VALUES
(9, 37, 'Nano', 5, 'Nice'),
(10, 49, 'Nano', 4, 'This is a comment'),
(11, 37, 'Nano', 5, 'this product is working and good quality'),
(12, 37, 'Nano', 4, 'This is a comment');

-- --------------------------------------------------------

--
-- Table structure for table `removed_detail`
--

CREATE TABLE `removed_detail` (
  `removed_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `store_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `store_name` varchar(255) NOT NULL,
  `reason` text NOT NULL,
  `quantity` int(11) NOT NULL,
  `removed_date` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `removed_detail`
--

INSERT INTO `removed_detail` (`removed_id`, `product_id`, `store_id`, `product_name`, `store_name`, `reason`, `quantity`, `removed_date`) VALUES
(10, 34, 3, 'G15 Gaming Laptop', 'HQ Mega Tech Computer Store', 'broken', 3, '2022-12-08'),
(11, 38, 3, 'Unitek Cable UTP Cat6 PC-HUB', 'HQ Mega Tech Computer Store', 'broken', 50, '2022-12-08');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` int(11) NOT NULL,
  `staff_username` varchar(40) NOT NULL,
  `staff_password` varchar(12) NOT NULL,
  `staff_name` varchar(40) NOT NULL,
  `staff_ic` varchar(16) NOT NULL,
  `staff_age` int(11) NOT NULL,
  `staff_position` varchar(40) NOT NULL,
  `staff_email` varchar(40) NOT NULL,
  `staff_contactNo` varchar(15) NOT NULL,
  `staff_recoveryPasswordKey` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`staff_id`, `staff_username`, `staff_password`, `staff_name`, `staff_ic`, `staff_age`, `staff_position`, `staff_email`, `staff_contactNo`, `staff_recoveryPasswordKey`) VALUES
(1009, 'JunyiHR', 'JunyiHR123@', 'Fong Jun Yi', '000509017708', 22, 'Human Resource Manager', 'fongjunyi111@gmail.com', '0127196636', '78MVf8'),
(1010, 'ZhenXianSM', 'ZhenXian123#', 'Zhen Xian Wang', '950509017708', 27, 'Sales Manager', 'fongjy-wm19@student.tarc.edu.my', '60127323246', 'aWvOZX'),
(1011, 'zhengyiSS', 'zhenyiZ123#', 'Zheng Yi Ng', '0001208012202', 22, 'Staff Supervisor', 'fongj8465@gmail.com', '60114756636', 'fDSeql'),
(1012, 'Benedict', 'Ben123@', 'TEA SHANG ZHE BENEDICT', '001123015501', 22, 'Business Manager', 'benedicttsz-wm19@student.tarc.edu.my', '60127789953', 'ac7sds'),
(1013, 'John', 'John123!', 'YOU JOHN CHAN', '990425013306', 23, 'Employee', 'chanyj-wm19@student.tarc.edu.my', '60123354876', 'A5jAga'),
(1014, 'Dominic', 'Dominic123#', 'GOH JUN WAI DOMINIC', '980123018801', 24, 'Employee', 'gohjwd-wm19@student.tarc.edu.my', '60112351234', 'sXXuxT'),
(1015, 'EnTin', 'Testing123!', 'En Tong', '0000508019902', 22, 'Staff Supervisor', 'fongjunyi11@gmail.com', '60127325333', '7C9cEj');

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `store_id` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `type` varchar(15) NOT NULL,
  `address` varchar(255) NOT NULL,
  `state` varchar(35) NOT NULL,
  `postal_code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `store`
--

INSERT INTO `store` (`store_id`, `name`, `type`, `address`, `state`, `postal_code`) VALUES
(3, 'HQ Mega Tech Computer Store', 'Headquarters', 'G035, G Floor, Plaza Low Yat, 7, Jalan Bintang, 55100 Kuala Lumpur', 'Kuala Lumpur', 53000),
(4, 'Mega Tech Melaka Computer Store', 'Branch', '2, Lot 3-01, 3rd Floor, Jalan Lagenda 2, Taman 1 Lagenda, ', 'Melaka', 75400),
(5, 'Mega Tech Johor Computer Store', 'Branch', '3, jalan dato onn 3, bandar dato onn', 'Johor Bahru', 81100),
(6, 'Mega Tech Penang Computer Store', 'Branch', 'No. 8, Jalan Jelutong, 11600 George Town, Pulau Pinang', 'Pulau Pinang', 11600),
(7, 'Mega Tech Ipoh Computer Store', 'Branch', 'No.2, Susunan Stesen 18, Station 18, 31650 Ipoh, Perak', 'Perak', 31650),
(8, 'Mega Tech Kedah Computer Store', 'Branch', '1, Pekan Changlun, Changloon, Taman Kempas, 06010 Changlun, Kedah', 'Kedah', 6010);

-- --------------------------------------------------------

--
-- Table structure for table `transfer_product`
--

CREATE TABLE `transfer_product` (
  `transfer_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `from_store` varchar(100) NOT NULL,
  `fromStore_id` int(11) NOT NULL,
  `to_store` varchar(100) NOT NULL,
  `toStore_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `transfer_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transfer_product`
--

INSERT INTO `transfer_product` (`transfer_id`, `product_name`, `from_store`, `fromStore_id`, `to_store`, `toStore_id`, `quantity`, `transfer_date`) VALUES
(41, 'G15 Gaming Laptop', 'HQ Mega Tech Computer Store', 3, 'Mega Tech Johor Computer Store', 5, 100, '2022-12-14'),
(42, 'Asus Vivobook M1502I-AE8163WS Laptop (AM', 'HQ Mega Tech Computer Store', 3, 'Mega Tech Penang Computer Store', 6, 500, '2022-12-14'),
(43, 'JBL Quantum Duo PC Gaming Speakers', 'HQ Mega Tech Computer Store', 3, 'Mega Tech Kedah Computer Store', 8, 200, '2022-12-14'),
(44, 'Logitech G560 LIGHTSYNC PC Gaming Speake', 'HQ Mega Tech Computer Store', 3, 'Mega Tech Johor Computer Store', 5, 250, '2022-12-14'),
(45, 'Asus Vivobook M1502I-AE8163WS Laptop (AM', 'HQ Mega Tech Computer Store', 3, 'Mega Tech Melaka Computer Store', 4, 2, '2022-12-14'),
(46, 'Asus Vivobook M1502I-AE8163WS Laptop (AM', 'HQ Mega Tech Computer Store', 3, 'Mega Tech Melaka Computer Store', 4, 50, '2022-12-14'),
(47, 'Asus Vivobook M1502I-AE8163WS Laptop (AM', 'HQ Mega Tech Computer Store', 3, 'Mega Tech Melaka Computer Store', 4, 10, '2022-12-14'),
(48, 'Asus Vivobook M1502I-AE8163WS Laptop (AM', 'HQ Mega Tech Computer Store', 3, 'Mega Tech Melaka Computer Store', 4, 20, '2022-12-14'),
(49, 'JBL Quantum Duo PC Gaming Speakers', 'Mega Tech Kedah Computer Store', 8, 'HQ Mega Tech Computer Store', 3, 5, '2022-12-14'),
(50, 'JBL Quantum Duo PC Gaming Speakers', 'Mega Tech Kedah Computer Store', 8, 'HQ Mega Tech Computer Store', 3, 10, '2022-12-14'),
(51, 'JBL Quantum Duo PC Gaming Speakers', 'Mega Tech Kedah Computer Store', 8, 'HQ Mega Tech Computer Store', 3, 15, '2022-12-14'),
(52, 'JBL Quantum Duo PC Gaming Speakers', 'Mega Tech Kedah Computer Store', 8, 'HQ Mega Tech Computer Store', 3, 20, '2022-12-14'),
(53, 'JBL Quantum Duo PC Gaming Speakers', 'Mega Tech Kedah Computer Store', 8, 'HQ Mega Tech Computer Store', 3, 20, '2022-12-14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `trn_date` datetime NOT NULL,
  `Department` varchar(30) NOT NULL,
  `pss` varchar(100) NOT NULL,
  `question` varchar(80) NOT NULL,
  `answer` varchar(80) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_form`
--

CREATE TABLE `user_form` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `state` varchar(35) NOT NULL,
  `contactNo` varchar(100) NOT NULL,
  `post_code` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_form`
--

INSERT INTO `user_form` (`id`, `name`, `email`, `password`, `image`, `address`, `state`, `contactNo`, `post_code`) VALUES
(1, 'Roy', 'roy@gasd', '202cb962ac59075b964b07152d234b70', 'B1ED164B-3C86-4DB9-9C3E-1FE1695D079B.jpeg', '', '', '', 0),
(3, 'King1', 'king@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', 'B1ED164B-3C86-4DB9-9C3E-1FE1695D079B.jpeg', '', '', '', 0),
(4, 'Sotoru123', 'sotoru@gmail.com', '202cb962ac59075b964b07152d234b70', 'received_812336056885854.jpg', '', '', '', 0),
(6, 'nano', 'nano@gmail.com', 'caf1a3dfb505ffed0d024130f58c5cfa', 'spongebob-spongbob-cartoon-Favim.com-7743362.jpg', '', '', '', 0),
(7, 'Fong', 'demo123@gmail.com', 'a72404015fbed3b8c34a9347c5674ad0', '', '', '', '', 0),
(8, 'Demo1', 'demo@gmail.com', 'd41d8cd98f00b204e9800998ecf8427e', 'spongebob-spongbob-cartoon-Favim.com-7743362.jpg', '', '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `wish`
--

CREATE TABLE `wish` (
  `id` int(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `wish`
--

INSERT INTO `wish` (`id`, `user_id`, `name`, `price`, `image`) VALUES
(9, '6', 'Asus Vivobook M1502I-AE8163WS Laptop (AM', '3099', 'asus_vivobook_M1502I.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`chat_id`);

--
-- Indexes for table `login_details`
--
ALTER TABLE `login_details`
  ADD PRIMARY KEY (`login_details_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `promotion`
--
ALTER TABLE `promotion`
  ADD PRIMARY KEY (`promo_id`);

--
-- Indexes for table `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`rate_id`);

--
-- Indexes for table `removed_detail`
--
ALTER TABLE `removed_detail`
  ADD PRIMARY KEY (`removed_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`store_id`);

--
-- Indexes for table `transfer_product`
--
ALTER TABLE `transfer_product`
  ADD PRIMARY KEY (`transfer_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_form`
--
ALTER TABLE `user_form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wish`
--
ALTER TABLE `wish`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `login_details`
--
ALTER TABLE `login_details`
  MODIFY `login_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `promotion`
--
ALTER TABLE `promotion`
  MODIFY `promo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `rating`
--
ALTER TABLE `rating`
  MODIFY `rate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `removed_detail`
--
ALTER TABLE `removed_detail`
  MODIFY `removed_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1017;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `store_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `transfer_product`
--
ALTER TABLE `transfer_product`
  MODIFY `transfer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_form`
--
ALTER TABLE `user_form`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `wish`
--
ALTER TABLE `wish`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 30, 2024 at 01:54 PM
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
-- Database: `contact_vault`
--
CREATE DATABASE IF NOT EXISTS `contact_vault` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `contact_vault`;

-- --------------------------------------------------------

--
-- Table structure for table `add_to_contacts_tbl`
--

CREATE TABLE `add_to_contacts_tbl` (
  `contact_id` varchar(26) NOT NULL,
  `user_phno` varchar(13) NOT NULL,
  `contact_phno` varchar(13) NOT NULL,
  `contact_email` varchar(40) NOT NULL,
  `contact_name` varchar(50) NOT NULL,
  `contact_address` varchar(50) DEFAULT NULL,
  `contact_dob` date DEFAULT NULL,
  `contact_img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `add_to_contacts_tbl`
--

INSERT INTO `add_to_contacts_tbl` (`contact_id`, `user_phno`, `contact_phno`, `contact_email`, `contact_name`, `contact_address`, `contact_dob`, `contact_img`) VALUES
('76799540467894561230', '7679954046', '7894561230', 'shinchan05@gmail.com', 'Shinchan', 'Kassukabe Town', '1992-05-05', '76799540467894561230.png'),
('76799540469832961542', '7679954046', '9832961542', 'bpaulc21@gmail.com', 'Basudeb', 'Janai Road, Hooghly, WB, India', '2002-02-21', '76799540469832961542.jpg'),
('76799540469876543210', '7679954046', '9876543210', 'doraemon@gmail.com', 'Doraemon', 'Twenty 2nd century', '2112-09-03', '76799540469876543210.jpeg'),
('98329615427412589630', '9832961542', '7412589630', 'ashke22@gmail.com', 'Ash Ketchum', 'Palate Town', '1996-05-22', '98329615427412589630.jpeg'),
('98329615427894561230', '9832961542', '7894561230', 'shinchan05@gmail.com', 'Shinchan Nohara', 'Kassukabe Town', '1992-05-05', '98329615427894561230.png'),
('98329615429630258741', '9832961542', '9630258741', 'ben10@gmail.com', 'Ben Tenison', 'USA', '1995-12-27', '98329615429630258741.jpeg'),
('98329615429832961542', '9832961542', '9832961542', 'bpaulc21@gmail.com', 'Basudeb', 'Janai Road, Hooghly, WB, India', '2002-02-21', '98329615429832961542.jpg'),
('98329615429876543210', '9832961542', '9876543210', 'doraemon@gmail.com', 'Doraemon', 'Twenty 2nd century', '2112-09-03', '98329615429876543210.jpeg'),
('98765432107679954046', '9876543210', '7679954046', 'itstack21@gmail.com', 'ITStack', 'Janai Road, Hooghly, WB, India', '2021-01-01', '98765432107679954046.png'),
('98765432107894561230', '9876543210', '7894561230', 'shinchan05@gmail.com', 'Shinchan', 'Kassukabe Town', '1992-05-05', '98765432107894561230.png'),
('98765432109630258741', '9876543210', '9630258741', 'ben10@gmail.com', 'Ben', 'USA', '1995-12-27', '98765432109630258741.jpeg'),
('98765432109832961542', '9876543210', '9832961542', 'bpaulc21@gmail.com', 'Basudeb', 'Janai Road, Hooghly, WB, India', '2002-02-21', '98765432109832961542.jpg'),
('98765432109876543210', '9876543210', '9876543210', 'doraemon@gmail.com', 'MR. Dora', 'Twenty 2nd century', '2112-09-03', '98765432109876543210.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `global_contacts`
--

CREATE TABLE `global_contacts` (
  `contact_phone` varchar(13) NOT NULL,
  `contact_name` varchar(255) NOT NULL,
  `contact_email` varchar(255) DEFAULT NULL,
  `contact_address` text DEFAULT NULL,
  `contact_dob` date DEFAULT NULL,
  `contact_img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `global_contacts`
--

INSERT INTO `global_contacts` (`contact_phone`, `contact_name`, `contact_email`, `contact_address`, `contact_dob`, `contact_img`) VALUES
('7412589630', 'Ash Ketchum&cvnil', 'ashke22@gmail.com', 'Palate Town', '1996-05-22', NULL),
('7679954046', 'ITStack&cvnilITStack&cvnilIT Stack&cvnil', 'itstack21@gmail.com', '', '2021-01-01', NULL),
('7894561230', 'Shinchan Nohara&cvnilShinchan&cvnilShinchan&cvnil', 'shinchan05@gmail.com', 'Kassukabe Town', '1992-05-05', NULL),
('9630258741', 'Ben Tenison&cvnilBen&cvnilBen Tenision&cvnil', 'ben10@gmail.com', '', '1995-12-27', NULL),
('9832961542', 'Basudeb Paul&cvnilBasudeb&cvnilBasudeb&cvnilBasudeb&cvnil', 'bpaulc21@gmail.com', 'Janai Road, Hooghly, WB, India', '0000-00-00', NULL),
('9876543210', 'Doraemon&cvnilDora Doraemon&cvnilMR. Dora&cvnilDoraemon&cvnil', 'doraemon@gmail.com', 'Twenty 2nd century', '2112-09-03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_signup_tbl`
--

CREATE TABLE `user_signup_tbl` (
  `user_name` varchar(30) NOT NULL,
  `user_phone` varchar(13) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_password` varchar(20) NOT NULL,
  `user_subscription` tinyint(1) DEFAULT NULL,
  `user_birthdate` date DEFAULT NULL,
  `user_address` varchar(20) DEFAULT NULL,
  `date_of_join` datetime NOT NULL DEFAULT current_timestamp(),
  `user_img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_signup_tbl`
--

INSERT INTO `user_signup_tbl` (`user_name`, `user_phone`, `user_email`, `user_password`, `user_subscription`, `user_birthdate`, `user_address`, `date_of_join`, `user_img`) VALUES
('IT Stack', '7679954046', 'itstack21@gmail.com', 'ITST21@', NULL, '2021-01-01', 'Janai Road', '2024-07-30 02:02:38', '7679954046.png'),
('Ben Tenision', '9630258741', 'ben10@gmail.com', 'Ben10@#', NULL, NULL, NULL, '2024-07-30 12:31:29', NULL),
('Basudeb Paul', '9832961542', 'bpaulc21@gmail.com', 'Nil21@', NULL, '2002-02-21', 'Janai Road, Hooghly,', '2024-07-30 01:11:33', '9832961542.jpg'),
('Dora Doraemon', '9876543210', 'doraemon@gmail.com', 'Dora@1234', NULL, '2112-09-03', 'Twenty 2nd century', '2024-07-30 01:53:23', '9876543210.jpeg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_to_contacts_tbl`
--
ALTER TABLE `add_to_contacts_tbl`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `global_contacts`
--
ALTER TABLE `global_contacts`
  ADD PRIMARY KEY (`contact_phone`);

--
-- Indexes for table `user_signup_tbl`
--
ALTER TABLE `user_signup_tbl`
  ADD PRIMARY KEY (`user_phone`),
  ADD UNIQUE KEY `user_email` (`user_email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

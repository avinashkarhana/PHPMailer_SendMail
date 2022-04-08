-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 05, 2022 at 06:40 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mailer_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_for_emails`
--

CREATE TABLE `account_for_emails` (
  `Sender_name` varchar(100) NOT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `SMTP_Host` varchar(100) NOT NULL,
  `SMTP_Port` int(6) NOT NULL,
  `SMTP_Security` varchar(10) NOT NULL,
  `Daily_Email_Limit` int(5) NOT NULL,
  `Consequtive_Email_Count` int(4) NOT NULL,
  `Next_Date` date NOT NULL,
  `Enabled` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account_for_emails`
--

INSERT INTO `account_for_emails` (`Sender_name`, `UserName`, `Password`, `SMTP_Host`, `SMTP_Port`, `SMTP_Security`, `Daily_Email_Limit`, `Consequtive_Email_Count`, `Next_Date`, `Enabled`) VALUES
('ABC', 'ABC@yahoo.com', 'APP_Password_From_Security_Page_from_yahoo', 'smtp.mail.yahoo.com', 587, 'tls', 500, 0, '2022-04-03', '1'),
('CDE', 'CDE@gmail.com', 'GMAIL_PASSWORD', 'smtp.gmail.com', 587, 'tls', 500, 50, '2022-04-03', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_for_emails`
--
ALTER TABLE `account_for_emails`
  ADD PRIMARY KEY (`UserName`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

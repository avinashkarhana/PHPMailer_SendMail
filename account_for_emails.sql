-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 05, 2022 at 01:01 PM
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
  `SMTPSecure` varchar(10) NOT NULL,
  `email_count` int(4) NOT NULL,
  `next_Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account_for_emails`
--

INSERT INTO `account_for_emails` (`Sender_name`, `UserName`, `Password`, `SMTP_Host`, `SMTP_Port`, `SMTPSecure`, `email_count`, `next_Date`) VALUES
('ABC', 'ABC@yahoo.com', 'APP_Password_From_Security_Page_from_yahoo', 'smtp.mail.yahoo.com', 587, 'tls', 0, '2022-04-03'),
('CDE', 'CDE@gmail.com', 'GMAIL_PASSWORD', 'smtp.gmail.com', 587, 'tls', 500, '2022-04-03');

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

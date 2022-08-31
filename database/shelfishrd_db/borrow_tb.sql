-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 31, 2022 at 11:24 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shelfishrd_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `borrow_tb`
--

CREATE TABLE `borrow_tb` (
  `borrow_id` tinyint(11) NOT NULL,
  `issue_date` date DEFAULT NULL,
  `expiry_date` date DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `status` varchar(200) NOT NULL,
  `b_id` tinyint(11) NOT NULL,
  `user_id` tinyint(11) NOT NULL,
  `extend_times` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `borrow_tb`
--

INSERT INTO `borrow_tb` (`borrow_id`, `issue_date`, `expiry_date`, `return_date`, `status`, `b_id`, `user_id`, `extend_times`) VALUES
(1, NULL, NULL, NULL, 'requesting', 19, 4, 0),
(2, '2022-08-31', '2022-09-30', '2022-09-21', 'borrowed', 13, 4, 0),
(3, NULL, NULL, NULL, 'borrowing', 14, 4, 0),
(4, NULL, NULL, NULL, 'borrowing', 17, 5, 0),
(5, NULL, NULL, NULL, 'rejected', 2, 4, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `borrow_tb`
--
ALTER TABLE `borrow_tb`
  ADD PRIMARY KEY (`borrow_id`),
  ADD KEY `book_cons` (`b_id`),
  ADD KEY `user_cons` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `borrow_tb`
--
ALTER TABLE `borrow_tb`
  MODIFY `borrow_id` tinyint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `borrow_tb`
--
ALTER TABLE `borrow_tb`
  ADD CONSTRAINT `book_cons` FOREIGN KEY (`b_id`) REFERENCES `books_tb` (`b_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_cons` FOREIGN KEY (`user_id`) REFERENCES `user_tb` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

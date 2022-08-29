-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 29, 2022 at 08:25 PM
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
-- Database: `student_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `book_b&s_tb`
--

CREATE TABLE `book_b&s_tb` (
  `productid` int(11) NOT NULL,
  `productName` varchar(250) NOT NULL,
  `authorName` varchar(250) NOT NULL,
  `productDetails` varchar(1000) NOT NULL,
  `price` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book_b&s_tb`
--

INSERT INTO `book_b&s_tb` (`productid`, `productName`, `authorName`, `productDetails`, `price`) VALUES
(7, 'Ikigai', ' Hector Garcia', 'The Japanese Secret to a Long and Happy Life', 100),
(8, 'Essentialism', ' Greg McKeown', 'The Disciplined Pursuit of Less', 150),
(9, 'Factfulness', 'Anna Rosling', ' Ten Reasons We are Wrong About the World', 184),
(15, 'The Third Door', 'Alex Banayan', 'The Wild Quest to Uncover How the Worlds Most Successful People Launched Their Careers', 199),
(16, 'Factfulness', ' Anna Rosling Rönnlund, Hans Rosling, and Ola Rosling', 'Ten Reasons We are Wrong About the World', 199),
(17, 'The Go-Giver', 'Bob Burg and John David Mann', 'A Little Story About a Powerful Business Idea is a business book', 300),
(18, 'Rework', 'David Heinemeier Hansson and Jason Fried', 'A radical new business book from business trailblazers Jason Fried and David Heinemeier Hansson that offers a reappraisal of business best practice ', 349);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book_b&s_tb`
--
ALTER TABLE `book_b&s_tb`
  ADD PRIMARY KEY (`productid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book_b&s_tb`
--
ALTER TABLE `book_b&s_tb`
  MODIFY `productid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

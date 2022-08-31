-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 31, 2022 at 07:02 AM
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
-- Database: `books_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `books_tb`
--

CREATE TABLE `books_tb` (
  `productid` int(11) NOT NULL,
  `productName` varchar(250) NOT NULL,
  `authorName` varchar(250) NOT NULL,
  `productDetails` varchar(1000) NOT NULL,
  `price` float NOT NULL,
  `sourceImg` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books_tb`
--

INSERT INTO `books_tb` (`productid`, `productName`, `authorName`, `productDetails`, `price`, `sourceImg`) VALUES
(24, 'Ikigai', 'Francesc Miralles and Hector Garcia	', '	The Japanese Secret to a Long and Happy Life', 150, './BookImages/ikigaiimg.webpbook-1.webp'),
(25, 'Essentialism', 'Greg McKeown', 'The Disciplined Pursuit of Less', 150, './BookImages/Essentialismimg.webpbook-2.webp'),
(26, 'Factfulness', 'Anna Rosling', '	Ten Reasons We are Wrong About the World', 135, './Bookimages/Factfulnessimg.webp'),
(27, 'The Third Door', 'Alex Banayan', '	The Wild Quest to Uncover How the Worlds Most Successful People Launched Their Careers', 160, './Bookimages/The_Third_Doorimg.webp'),
(28, 'The Go-Giver', 'Bob Burg and John David Mann', 'A Little Story About a Powerful Business Idea is a business book', 125, './Bookimages/The_Go-Giverimg.webp'),
(29, 'Rework', 'David Heinemeier Hansson and Jason Fried', 'A radical new business book from business trailblazers Jason Fried and David Heinemeier Hansson that offers a reappraisal of business best practice', 299, './Bookimages/Reworkimg.webp');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books_tb`
--
ALTER TABLE `books_tb`
  ADD PRIMARY KEY (`productid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books_tb`
--
ALTER TABLE `books_tb`
  MODIFY `productid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

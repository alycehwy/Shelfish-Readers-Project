-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 29, 2022 at 07:45 PM
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
-- Table structure for table `books_tb`
--

CREATE TABLE `books_tb` (
  `b_id` tinyint(150) NOT NULL,
  `b_title` varchar(50) NOT NULL,
  `b_author` varchar(50) NOT NULL,
  `b_price` float NOT NULL,
  `b_description` varchar(200) NOT NULL,
  `b_keywords` varchar(100) NOT NULL,
  `b_likes` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books_tb`
--

INSERT INTO `books_tb` (`b_id`, `b_title`, `b_author`, `b_price`, `b_description`, `b_keywords`, `b_likes`) VALUES
(1, 'book 1', 'marcelo', 2.99, 'description of book 1 ', 'css, terror, magic ', 0),
(2, 'book 2', 'Sam', 44.1, 'the description of books 2 is a bit longer and yeah this is it ', 'css, technology, fantasy', 0),
(13, 'book 3 ', 'Wun-Yu', 10, 'description of book 3', 'css, magic', 0),
(14, 'book 4', 'Milad', 99.9, 'fourth book description so far', 'key, keywords', 0),
(15, 'book five ', 'Henry', 3.53, 'description of the fifth book', 'book, five, book five', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books_tb`
--
ALTER TABLE `books_tb`
  ADD PRIMARY KEY (`b_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books_tb`
--
ALTER TABLE `books_tb`
  MODIFY `b_id` tinyint(150) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

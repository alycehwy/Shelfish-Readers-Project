-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 02, 2022 at 05:40 AM
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
  `b_id` tinyint(11) NOT NULL,
  `b_title` varchar(50) NOT NULL,
  `b_author` varchar(50) NOT NULL,
  `b_price` float NOT NULL,
  `b_description` varchar(200) NOT NULL,
  `b_keywords` varchar(100) NOT NULL,
  `b_likes` int(10) NOT NULL,
  `available` varchar(50) NOT NULL DEFAULT 'true'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `books_tb`
--

INSERT INTO `books_tb` (`b_id`, `b_title`, `b_author`, `b_price`, `b_description`, `b_keywords`, `b_likes`, `available`) VALUES
(1, 'book 1', 'marcelo', 2.99, 'description of book 1 ', 'css, terror', 2, 'true'),
(2, 'book 2', 'Sam', 44.1, 'the description of books 2 is a bit longer and yeah this is it ', 'css, technology, fantasy', 1, 'false'),
(13, 'book 3 ', 'Wun-Yu', 10, 'description of book 3', 'css, magic', 0, 'false'),
(15, 'book five ', 'Henry', 3.53, 'description of the fifth book', 'book, five, book five', 0, 'true'),
(16, 'Web', 'Milad', 23.99, 'Be a great Web Developer', 'web,css,html', 0, 'true'),
(17, 'PHP', 'Milad', 13.99, 'Backend developer', 'php,web', 0, 'false'),
(19, 'JavaScript', 'Milad', 49.99, 'Be a good student', 'javascript', 13, 'false'),
(20, 'Web dep', 'Milad', 49.99, 'Practice, Practice, Practice!!', 'PHP, JavaScript', 0, 'true');

-- --------------------------------------------------------

--
-- Table structure for table `book_bs_tb`
--

CREATE TABLE `book_bs_tb` (
  `productid` int(11) NOT NULL,
  `productName` varchar(250) NOT NULL,
  `authorName` varchar(250) NOT NULL,
  `productDetails` varchar(1000) NOT NULL,
  `price` float NOT NULL,
  `sourceImg` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book_bs_tb`
--

INSERT INTO `book_bs_tb` (`productid`, `productName`, `authorName`, `productDetails`, `price`, `sourceImg`) VALUES
(24, 'Ikigai', 'Francesc Miralles and Hector Garcia	', '	The Japanese Secret to a Long and Happy Life', 150, './BookImages/ikigaiimg.webpbook-1.webp'),
(25, 'Essentialism', 'Greg McKeown', 'The Disciplined Pursuit of Less', 150, './BookImages/Essentialismimg.webpbook-2.webp'),
(26, 'Factfulness', 'Anna Rosling', '	Ten Reasons We are Wrong About the World', 135, './Bookimages/Factfulnessimg.webp'),
(27, 'The Third Door', 'Alex Banayan', '	The Wild Quest to Uncover How the Worlds Most Successful People Launched Their Careers', 160, './Bookimages/The_Third_Doorimg.webp'),
(28, 'The Go-Giver', 'Bob Burg and John David Mann', 'A Little Story About a Powerful Business Idea is a business book', 125, './Bookimages/The_Go-Giverimg.webp'),
(29, 'Rework', 'David Heinemeier Hansson and Jason Fried', 'A radical new business book from business trailblazers Jason Fried and David Heinemeier Hansson that offers a reappraisal of business best practice', 299, './Bookimages/Reworkimg.webp');

-- --------------------------------------------------------

--
-- Table structure for table `borrow_tb`
--

CREATE TABLE `borrow_tb` (
  `borrow_id` int(11) NOT NULL,
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
(1, '2022-09-01', '2022-10-01', NULL, 'borrowing', 19, 4, 0),
(2, '2022-08-31', '2022-09-30', '2022-09-21', 'borrowed', 13, 4, 0),
(4, '2022-08-31', '2022-09-30', NULL, 'borrowing', 17, 5, 0),
(6, NULL, NULL, NULL, 'requesting', 2, 4, 0),
(13, NULL, NULL, NULL, 'requesting', 1, 10, 0);

-- --------------------------------------------------------

--
-- Table structure for table `like_control`
--

CREATE TABLE `like_control` (
  `user_id` tinyint(11) NOT NULL,
  `b_id` tinyint(11) NOT NULL,
  `like_chk` varchar(50) DEFAULT 'false'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `like_control`
--

INSERT INTO `like_control` (`user_id`, `b_id`, `like_chk`) VALUES
(4, 1, 'false'),
(4, 2, 'false'),
(4, 13, 'false'),
(4, 15, 'false'),
(4, 16, 'false'),
(4, 17, 'false'),
(4, 1, 'false'),
(4, 2, 'false'),
(4, 13, 'false'),
(4, 15, 'false'),
(4, 16, 'false'),
(4, 17, 'false'),
(4, 1, 'false'),
(4, 2, 'false'),
(4, 13, 'false'),
(4, 15, 'false'),
(4, 16, 'false'),
(4, 17, 'false'),
(4, 19, 'false'),
(4, 20, 'false'),
(5, 1, 'false'),
(5, 2, 'false'),
(5, 13, 'false'),
(5, 15, 'false'),
(5, 16, 'false'),
(5, 17, 'false'),
(5, 19, 'false'),
(5, 20, 'false'),
(10, 1, 'false'),
(10, 2, 'false'),
(10, 13, 'false'),
(10, 15, 'false'),
(10, 16, 'false'),
(10, 17, 'false'),
(10, 19, 'false'),
(10, 20, 'false'),
(12, 1, 'false'),
(12, 2, 'false'),
(12, 13, 'false'),
(12, 15, 'false'),
(12, 16, 'false'),
(12, 17, 'false'),
(12, 19, 'false'),
(12, 20, 'false');

-- --------------------------------------------------------

--
-- Table structure for table `user_tb`
--

CREATE TABLE `user_tb` (
  `user_id` tinyint(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL,
  `title` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_tb`
--

INSERT INTO `user_tb` (`user_id`, `username`, `password`, `first_name`, `last_name`, `email`, `title`) VALUES
(1, 'admin', '$2y$09$Z9Xt1EsdG7NUGWNiIsgbKOPWTmYAOEW2TNG/I4sQBwgPjupBdugcG', 'Shelfish', 'Readers', 'info@tamwood.com', 'admin'),
(4, 'user', '$2y$09$JACiF7jyDtMnMx1P9zY3x.bUfpHbyhSknJ5on.oat5qE1zFuU3SCC', 'User', 'Readers', 'user@tamwood.com', 'user'),
(5, 'alyce', '$2y$09$TT6PeX7WytrIx3nw1a3dHuKCBESRH8ZqZwwcWnO5tth7iAJSz.uq6', 'WunYu', 'Huang', 'wunyu@tamwood.com', 'user'),
(10, 'marcelo', '$2y$09$nOzGovorL9K2bFvCyOV67u8fXivb4bupezICw/f220dWnuym4HIVK', 'Marcelo', 'Romero', 'marcelo@tamwood.com', 'user'),
(12, 'sam', '$2y$09$R9d2sJpau9MATLhwfkRiO.wBURqG8HMfNbs60pDr4AcjmfCUqweai', 'Samridh', 'Chawla', 'sam@tamwood.com', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books_tb`
--
ALTER TABLE `books_tb`
  ADD PRIMARY KEY (`b_id`);

--
-- Indexes for table `book_bs_tb`
--
ALTER TABLE `book_bs_tb`
  ADD PRIMARY KEY (`productid`);

--
-- Indexes for table `borrow_tb`
--
ALTER TABLE `borrow_tb`
  ADD PRIMARY KEY (`borrow_id`),
  ADD KEY `book_cons` (`b_id`),
  ADD KEY `user_cons` (`user_id`);

--
-- Indexes for table `like_control`
--
ALTER TABLE `like_control`
  ADD KEY `user_con` (`user_id`),
  ADD KEY `b_con` (`b_id`);

--
-- Indexes for table `user_tb`
--
ALTER TABLE `user_tb`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books_tb`
--
ALTER TABLE `books_tb`
  MODIFY `b_id` tinyint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `book_bs_tb`
--
ALTER TABLE `book_bs_tb`
  MODIFY `productid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `borrow_tb`
--
ALTER TABLE `borrow_tb`
  MODIFY `borrow_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user_tb`
--
ALTER TABLE `user_tb`
  MODIFY `user_id` tinyint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `borrow_tb`
--
ALTER TABLE `borrow_tb`
  ADD CONSTRAINT `book_cons` FOREIGN KEY (`b_id`) REFERENCES `books_tb` (`b_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_cons` FOREIGN KEY (`user_id`) REFERENCES `user_tb` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `like_control`
--
ALTER TABLE `like_control`
  ADD CONSTRAINT `b_con` FOREIGN KEY (`b_id`) REFERENCES `books_tb` (`b_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_con` FOREIGN KEY (`user_id`) REFERENCES `user_tb` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

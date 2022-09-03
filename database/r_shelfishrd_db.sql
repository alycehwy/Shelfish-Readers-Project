-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 03, 2022 at 06:34 PM
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
-- Database: `r_shelfishrd_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `book_tb`
--

CREATE TABLE `book_tb` (
  `b_id` tinyint(11) NOT NULL,
  `b_title` varchar(100) NOT NULL,
  `b_author` varchar(200) NOT NULL,
  `b_description` varchar(1500) NOT NULL,
  `b_price` float NOT NULL,
  `b_source_img` varchar(200) NOT NULL,
  `b_keywords` varchar(400) NOT NULL,
  `b_available` tinyint(1) NOT NULL DEFAULT 1,
  `b_type` tinyint(1) NOT NULL,
  `b_like` int(14) NOT NULL DEFAULT 0,
  `puser_id` tinyint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `book_tb`
--

INSERT INTO `book_tb` (`b_id`, `b_title`, `b_author`, `b_description`, `b_price`, `b_source_img`, `b_keywords`, `b_available`, `b_type`, `b_like`, `puser_id`) VALUES
(1, 'book 1', 'marcelo', 'description of book 1', 2.99, '', 'css,horror,magic', 0, 1, 12, 1),
(2, 'book 2', 'Sam', 'the description of book 2 is a bit longer and yeah this is it', 44.1, '', 'css,technology,fantasy', 1, 1, 17, 1),
(13, 'book 3', 'Wun-Yu', 'description of book 3', 10, '', 'css,magic', 0, 1, 10, 1),
(14, 'book 4', 'Milad', 'fourth book description so far', 9.99, '', 'key,keywrords', 0, 1, 5, 1),
(15, 'book five', 'Henry', 'description of fitfh book', 3.53, '', 'book,five,book five', 0, 1, 3, 1),
(16, 'Web', 'Milad', 'Be a great Web Developer', 23.99, '', 'web,css,html', 0, 1, 1, 1),
(17, 'PHP', 'Milad', 'Backend developer', 13.99, '', 'php,web', 0, 1, 1, 1),
(19, 'JavaScript', 'Milad', 'Be a good student', 49.99, '', 'javascript', 0, 1, 13, 1),
(20, 'Web dep', 'Milad', 'Practice, Practice, Practice!!', 49.99, '', 'PHP, JavaScript', 0, 1, 0, 1),
(24, 'Ikigai', 'Francesc Miralles and Hector Garcia', '	The Japanese Secret to a Long and Happy Life', 300, '../BookImages/ikigaiimg.webpbook-1.webp', 'Japanese,ikigai,eastern,asian', 1, 0, 22, 4),
(25, 'Essentialism', 'Greg McKeown', 'The Disciplined Pursuit of Less', 150, '../BookImages/Essentialismimg.webpbook-2.webp', 'Greg mcKeown, Essesentialism,minimalism', 1, 0, 89, 5),
(26, 'Factfulness', 'Anna Rosling', 'Ten Reasons We are Wrong About the World', 135, '../Bookimages/Factfulnessimg.webp', 'World,philosific,philosofical', 1, 0, 34, 12),
(27, 'The Third Door', 'Alex Banayan', '	The Wild Quest to Uncover How the Worlds Most Successful People Launched Their Careers', 160, '../Bookimages/The_Third_Doorimg.webp', 'World,Success,successful people,career', 1, 0, 54, 12),
(28, 'The Go-Giver', 'Bob Burg and John David Mann', 'A Little Story About a Powerful Business Idea is a business book', 125, '../Bookimages/The_Go-Giverimg.webp', 'Business,World,entrepreneur', 1, 0, 24, 12),
(29, 'Rework', 'David Heinemeier Hansson and Jason Fried', 'A radical new business book from business trailblazers Jason Fried and David Heinemeier Hansson that offers a reappraisal of business best practice', 299, '../Bookimages/Reworkimg.webp', 'Business,work,future', 1, 0, 31, 12),
(36, 'CSS', 'CSS', 'CSS designer', 23.99, '', 'css,web', 1, 1, 0, 1);

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
  `buser_id` tinyint(11) NOT NULL,
  `extend_times` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `borrow_tb`
--

INSERT INTO `borrow_tb` (`borrow_id`, `issue_date`, `expiry_date`, `return_date`, `status`, `b_id`, `buser_id`, `extend_times`) VALUES
(33, '2022-09-03', '2022-10-03', NULL, 'borrowing', 19, 4, 1),
(34, '2022-08-31', '2022-09-30', '2022-09-21', 'borrowed', 13, 4, 0),
(35, '2022-08-31', '2022-09-30', NULL, 'borrowing', 17, 5, 0),
(36, '2022-09-02', '2022-10-02', '2022-09-03', 'borrowed', 2, 4, 0),
(37, '2022-09-02', '2022-10-02', NULL, 'borrowing', 1, 10, 0),
(38, '2022-09-02', '2022-10-31', NULL, 'returning', 13, 4, 1),
(39, '2022-09-03', '2022-10-03', NULL, 'extending', 20, 4, 0),
(40, '2022-09-03', '2022-10-03', NULL, 'borrowing', 15, 4, 0),
(41, NULL, NULL, NULL, 'requesting', 14, 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `like_control`
--

CREATE TABLE `like_control` (
  `user_id` tinyint(11) NOT NULL,
  `b_id` tinyint(11) NOT NULL,
  `like_chk` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `like_control`
--

INSERT INTO `like_control` (`user_id`, `b_id`, `like_chk`) VALUES
(4, 1, 'false'),
(4, 2, 'true'),
(4, 13, 'true'),
(4, 14, 'true'),
(4, 15, 'true'),
(4, 16, 'false'),
(4, 17, 'false'),
(4, 19, 'false'),
(4, 20, 'false'),
(5, 1, 'false'),
(5, 2, 'false'),
(5, 13, 'false'),
(5, 14, 'false'),
(5, 15, 'false'),
(5, 16, 'false'),
(5, 17, 'false'),
(5, 19, 'false'),
(5, 20, 'false'),
(10, 1, 'false'),
(12, 2, 'false'),
(12, 13, 'false'),
(12, 14, 'false'),
(12, 15, 'false'),
(12, 16, 'false'),
(12, 17, 'false'),
(12, 19, 'false'),
(12, 20, 'false'),
(28, 1, 'false'),
(28, 2, 'false'),
(28, 13, 'false'),
(28, 14, 'false'),
(28, 15, 'false'),
(28, 16, 'false'),
(28, 17, 'false'),
(28, 19, 'false'),
(28, 20, 'false'),
(30, 1, 'false'),
(30, 2, 'false'),
(30, 13, 'false'),
(30, 14, 'false'),
(30, 15, 'false'),
(30, 16, 'false'),
(30, 17, 'false'),
(30, 19, 'false'),
(30, 20, 'false'),
(1, 36, ''),
(4, 36, ''),
(5, 36, ''),
(10, 36, ''),
(12, 36, ''),
(28, 36, ''),
(30, 36, '');

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
(4, 'user', '$2y$09$JACiF7jyDtMnMx1P9zY3x.bUfpHbyhSknJ5on.oat5qE1zFuU3SCC', 'User', 'Reader', 'user@tamwood.com', 'user'),
(5, 'alyce', '$2y$09$TT6PeX7WytrIx3nw1a3dHuKCBESRH8ZqZwwcWnO5tth7iAJSz.uq6', 'WunYu', 'Huang', 'wunyu@tamwood.com', 'user'),
(10, 'marcelo', '$2y$09$nOzGovorL9K2bFvCyOV67u8fXivb4bupezICw/f220dWnuym4HIVK', 'Marcelo', 'Romero', 'marcelo@tamwood.com', 'user'),
(12, 'sam', '$2y$09$R9d2sJpau9MATLhwfkRiO.wBURqG8HMfNbs60pDr4AcjmfCUqweai', 'Samridh', 'Chawla', 'sam@tamwood.com', 'user'),
(28, 'aaa', '$2y$09$g1Jcs08Sqx97JkXW/EE/T.DDU0iawGJHbqNGCGgo5R5HTRxhdbIWe', 'WunYu', 'Huang', 'info@tamwood.com', 'user'),
(30, 'bbb', '$2y$09$hZS3rOv2MpVkzKVtvM8Qgu3dyrs9leDVDAbGCir243jRq5QMPHnIK', 'Alyce', 'Huang', 'info@tamwood.com', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book_tb`
--
ALTER TABLE `book_tb`
  ADD PRIMARY KEY (`b_id`);

--
-- Indexes for table `borrow_tb`
--
ALTER TABLE `borrow_tb`
  ADD PRIMARY KEY (`borrow_id`),
  ADD KEY `book_cons` (`b_id`),
  ADD KEY `user_cons` (`buser_id`);

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
-- AUTO_INCREMENT for table `book_tb`
--
ALTER TABLE `book_tb`
  MODIFY `b_id` tinyint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `borrow_tb`
--
ALTER TABLE `borrow_tb`
  MODIFY `borrow_id` tinyint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `user_tb`
--
ALTER TABLE `user_tb`
  MODIFY `user_id` tinyint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `borrow_tb`
--
ALTER TABLE `borrow_tb`
  ADD CONSTRAINT `book_cons` FOREIGN KEY (`b_id`) REFERENCES `book_tb` (`b_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_cons` FOREIGN KEY (`buser_id`) REFERENCES `user_tb` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `like_control`
--
ALTER TABLE `like_control`
  ADD CONSTRAINT `b_con` FOREIGN KEY (`b_id`) REFERENCES `book_tb` (`b_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_con` FOREIGN KEY (`user_id`) REFERENCES `user_tb` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

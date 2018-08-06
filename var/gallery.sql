-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 06, 2018 at 01:18 PM
-- Server version: 5.6.39-83.1
-- PHP Version: 7.1.15-1+ubuntu16.04.1+deb.sury.org+2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gallery`
--

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `image_id` tinyint(4) UNSIGNED NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `thumbnail_path` varchar(255) DEFAULT NULL,
  `description` text,
  `author_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `user_id` tinyint(4) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`image_id`, `image_path`, `thumbnail_path`, `description`, `author_name`, `created_at`, `user_id`) VALUES
(21, 'images/10770526225b488961cf7730.21534908.jpg', 'images/thumb/10770526225b488961cf7730.21534908.jpg', 'Good Morning', 'Leonardo Da Vinci', '2018-07-13 11:13:38', 37),
(22, 'images/5816797195b4889ce7ddc00.36628292.jpg', 'images/thumb/5816797195b4889ce7ddc00.36628292.jpg', 'Some nice picture', 'Vincent van Gogh', '2018-07-13 11:15:26', 37),
(23, 'images/17966983805b488a4bc2c5a0.66757929.jpg', 'images/thumb/17966983805b488a4bc2c5a0.66757929.jpg', 'Picture of late Piccaso', 'Picasso', '2018-07-13 11:17:31', 37),
(24, 'images/9044889945b488a5be23923.90058842.jpg', 'images/thumb/9044889945b488a5be23923.90058842.jpg', 'Happy birthday', 'Uknown', '2018-07-13 11:17:48', 37),
(25, 'images/1952565175b488a6fecda67.36023472.jpg', 'images/thumb/1952565175b488a6fecda67.36023472.jpg', 'Good Night', 'Uknown', '2018-07-13 11:18:08', 37),
(26, 'images/14460771265b488a90055361.28915643.jpg', 'images/thumb/14460771265b488a90055361.28915643.jpg', 'Photography of cacadu', 'Photography', '2018-07-13 11:18:40', 37),
(29, 'images/10205214005b48903aec6396.58469911.jpg', 'images/thumb/10205214005b48903aec6396.58469911.jpg', 'Some nice screenshot', 'Screenshot', '2018-07-13 11:42:51', 36),
(30, 'images/7611884725b4890719b0103.14681106.jpg', 'images/thumb/7611884725b4890719b0103.14681106.jpg', 'Ufo Hotel', 'Uknown', '2018-07-13 11:43:45', 36),
(31, 'images/439086165b4890b65e7f10.91873233.jpg', 'images/thumb/439086165b4890b65e7f10.91873233.jpg', 'Kids running into wilderness', 'Uknown', '2018-07-13 11:44:54', 36),
(32, 'images/20580888635b489171579428.58406328.jpg', 'images/thumb/20580888635b489171579428.58406328.jpg', 'Screenshot of nature', 'Uknown', '2018-07-13 11:48:01', 36),
(33, 'images/18815259575b48922c14d6b8.75027200.jpg', 'images/thumb/18815259575b48922c14d6b8.75027200.jpg', 'Sleepy hollow autumn forest', 'Picaso', '2018-07-13 11:51:08', 38),
(34, 'images/6813066535b4892fed19ad3.82311541.jpg', 'images/thumb/6813066535b4892fed19ad3.82311541.jpg', 'Birds in park', 'Leonardo Da Vinci', '2018-07-13 11:54:38', 38),
(35, 'images/20389860515b4894a84d2395.98492279.jpg', 'images/thumb/20389860515b4894a84d2395.98492279.jpg', 'Dog image', 'Uknown', '2018-07-13 12:01:44', 38);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` tinyint(4) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(10) NOT NULL,
  `last_name` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `first_name`, `last_name`) VALUES
(36, 'Vitaly', '$2y$10$f3w0aDZogeRJ/owYEZ4VeOEaE6ixDIbLQiKMQIPkP4y5siSlC2NsG', '', ''),
(37, 'admin', '$2y$10$JJUD5Ce.Tq7iyLCrBkZaLuenJzIjqGXxCPTISg2A.yEch7.YJ4nJ2', '', ''),
(38, 'user', '$2y$10$ZRIymDOLouVL14vCLuZE.epRtFzr/h.9uM8jwPCsQg0UCLfkxNdfG', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `image_id` tinyint(4) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

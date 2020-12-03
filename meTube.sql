-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 04, 2020 at 12:54 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `meTube`
--

-- --------------------------------------------------------

--
-- Table structure for table `block`
--

CREATE TABLE `block` (
  `id` int(10) NOT NULL,
  `blockedBy` varchar(50) NOT NULL,
  `blockedTo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'Film & Animation'),
(2, 'Autos & Vehicles '),
(3, 'Music'),
(4, 'Pets & Animals'),
(5, 'Sports'),
(6, 'Travel & Events'),
(7, 'Gaming'),
(8, 'People & Blogs'),
(9, 'Comedy'),
(10, 'Entertainment'),
(11, 'News & Politics'),
(12, 'How to & Style'),
(13, 'Education'),
(14, 'Science & Technology'),
(15, 'Non Profits & Activism');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `postedBy` varchar(50) NOT NULL,
  `videoId` int(11) NOT NULL,
  `responseTo` int(11) DEFAULT NULL,
  `body` text NOT NULL,
  `datePosted` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `postedBy`, `videoId`, `responseTo`, `body`, `datePosted`) VALUES
(1, 'anubhav', 77, 0, 'sdafdfadsfa', '2020-11-30 21:18:48'),
(2, 'anubhav', 77, 0, 'fasdfadfa', '2020-11-30 21:41:30'),
(3, 'anubhav', 77, 0, 'sdfadf', '2020-11-30 21:44:33'),
(4, 'anubhav', 77, 0, 'dfgsdfgs', '2020-11-30 21:49:40'),
(5, 'anubhav', 77, 1, 'gfdslkjfglksdjf', '2020-11-30 22:13:32'),
(6, 'abknave', 77, 0, 'fasdfasdf', '2020-12-02 14:33:11'),
(7, 'anubhav', 78, 0, 'dfsadfasdf', '2020-12-03 04:41:38'),
(8, 'anubhav', 78, 0, 'safdsadf', '2020-12-03 05:15:26'),
(9, 'eshwar', 77, 0, 'eshwar\n', '2020-12-03 10:45:08'),
(10, 'eshwar', 77, 9, 'clemson ', '2020-12-03 10:45:17'),
(11, 'eshwar', 80, 0, 'Team G5\nProfessor: Zijug Wang ', '2020-12-03 23:03:02');

-- --------------------------------------------------------

--
-- Table structure for table `dislikes`
--

CREATE TABLE `dislikes` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `commentid` int(11) DEFAULT NULL,
  `videoId` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dislikes`
--

INSERT INTO `dislikes` (`id`, `username`, `commentid`, `videoId`) VALUES
(30, 'abknave', NULL, 75);

-- --------------------------------------------------------

--
-- Table structure for table `family`
--

CREATE TABLE `family` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `fname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `family`
--

INSERT INTO `family` (`id`, `username`, `fname`) VALUES
(2, 'eshwar', 'abknave'),
(3, 'abknave', 'eshwar'),
(4, 'abknave', 'anubhav'),
(5, 'anubhav', 'abknave');

-- --------------------------------------------------------

--
-- Table structure for table `favourites`
--

CREATE TABLE `favourites` (
  `id` int(11) NOT NULL,
  `videoid` int(11) DEFAULT NULL,
  `username` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `favourites`
--

INSERT INTO `favourites` (`id`, `videoid`, `username`) VALUES
(9, 77, 'anubhav'),
(10, 77, 'abknave'),
(18, 77, 'eshwar');

-- --------------------------------------------------------

--
-- Table structure for table `friend`
--

CREATE TABLE `friend` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `fname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `commentid` int(11) DEFAULT 0,
  `videoId` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `username`, `commentid`, `videoId`) VALUES
(94, 'abknave', 0, 77),
(95, 'abknave', 0, 78),
(98, 'abknave', 11, 0),
(99, 'abknave', 0, 80);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(10) NOT NULL,
  `messageTo` varchar(50) NOT NULL,
  `messageBy` varchar(50) NOT NULL,
  `body` text NOT NULL,
  `datePosted` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `messageTo`, `messageBy`, `body`, `datePosted`) VALUES
(1, 'anubhav', 'anubhav', 'dfsfda', '2020-12-03 05:06:59'),
(2, 'anubhav', 'anubhav', 'asdfasd', '2020-12-03 06:28:56'),
(3, 'abknave', 'anubhav', 'dasfasdf', '2020-12-03 06:29:16'),
(4, 'abknave', 'anubhav', 'asdfasd', '2020-12-03 06:37:22'),
(5, 'abknave', 'anubhav', 'ASFDAS', '2020-12-03 07:18:27'),
(6, 'anubhav', 'abknave', 'lkfjsljdflas', '2020-12-03 08:15:43'),
(7, 'anubhav', 'abknave', 'sadfa', '2020-12-03 08:18:21'),
(8, 'anubhav', 'abknave', 'asfdas', '2020-12-03 08:18:45'),
(9, 'anubhav', 'abknave', 'sdfasd', '2020-12-03 08:21:00'),
(10, 'anubhav', 'anubhav', 'sdfsdfs', '2020-12-03 08:29:24'),
(11, 'abknave', 'eshwar', 'askjdhfas', '2020-12-03 10:26:31'),
(12, 'abknave', 'eshwar', 'new message', '2020-12-03 10:29:04'),
(13, 'eshwar', 'abknave', 'abhinav', '2020-12-03 10:48:14'),
(14, 'eshwar', 'eshwar', 'sadfsa', '2020-12-03 15:03:16'),
(15, 'abknave', 'eshwar', 'new message', '2020-12-03 20:35:14'),
(16, 'abknave', 'abknave', 'dfas', '2020-12-03 23:31:28'),
(17, 'abknave', 'abknave', 'Group Discussion ', '2020-12-03 23:32:16');

-- --------------------------------------------------------

--
-- Table structure for table `playlists`
--

CREATE TABLE `playlists` (
  `id` int(11) NOT NULL,
  `Playlist_name` varchar(10) NOT NULL,
  `username` int(11) NOT NULL,
  `privacy` int(10) NOT NULL,
  `videoId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(11) NOT NULL,
  `userTo` varchar(50) NOT NULL,
  `userFrom` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subscribers`
--

INSERT INTO `subscribers` (`id`, `userTo`, `userFrom`) VALUES
(28, 'anubhav', 'abknave');

-- --------------------------------------------------------

--
-- Table structure for table `thumbnails`
--

CREATE TABLE `thumbnails` (
  `id` int(11) NOT NULL,
  `videoid` int(11) NOT NULL,
  `filePath` varchar(250) NOT NULL,
  `selected` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `thumbnails`
--

INSERT INTO `thumbnails` (`id`, `videoid`, `filePath`, `selected`) VALUES
(1, 62, 'upload/videos/thumbnails/62-5fbd7283d614e.jpg', 1),
(2, 63, 'upload/videos/thumbnails/63-5fbd74159d953.jpg', 1),
(3, 64, 'upload/videos/thumbnails/64-5fbd74f5d4559.jpg', 1),
(4, 65, 'upload/videos/thumbnails/65-5fbd780902283.jpg', 1),
(5, 67, 'upload/videos/thumbnails/67-5fbd913bd3271.jpg', 1),
(6, 68, 'uploads/videos/thumbnails/68-5fbd924da4702.jpg', 1),
(7, 68, 'uploads/videos/thumbnails/68-5fbd924dc2019.jpg', 0),
(8, 68, 'uploads/videos/thumbnails/68-5fbd924e0bfb7.jpg', 0),
(9, 69, 'uploads/videos/thumbnails/69-5fbd92d71834b.jpg', 1),
(10, 69, 'uploads/videos/thumbnails/69-5fbd92d73a0c1.jpg', 0),
(11, 69, 'uploads/videos/thumbnails/69-5fbd92d774880.jpg', 0),
(12, 70, 'uploads/videos/thumbnails/70-5fbd957fbf7a2.jpg', 1),
(13, 70, 'uploads/videos/thumbnails/70-5fbd957fdd21a.jpg', 0),
(14, 70, 'uploads/videos/thumbnails/70-5fbd9580210b3.jpg', 0),
(15, 71, 'uploads/videos/thumbnails/71-5fbd960121b30.jpg', 1),
(16, 71, 'uploads/videos/thumbnails/71-5fbd96014b949.jpg', 0),
(17, 71, 'uploads/videos/thumbnails/71-5fbd9601a835e.jpg', 0),
(18, 72, 'uploads/videos/thumbnails/72-5fbd960b04f33.jpg', 1),
(19, 72, 'uploads/videos/thumbnails/72-5fbd960b20eaa.jpg', 0),
(20, 72, 'uploads/videos/thumbnails/72-5fbd960b5d221.jpg', 0),
(21, 73, 'uploads/videos/thumbnails/73-5fbd96bd51677.jpg', 1),
(22, 73, 'uploads/videos/thumbnails/73-5fbd96bd6e9eb.jpg', 0),
(23, 73, 'uploads/videos/thumbnails/73-5fbd96bda3cbe.jpg', 0),
(24, 74, 'uploads/videos/thumbnails/74-5fbd96f922eed.jpg', 1),
(25, 74, 'uploads/videos/thumbnails/74-5fbd96f941219.jpg', 0),
(33, 77, 'uploads/videos/thumbnails/77-5fc32f683ec1d.jpg', 0),
(34, 77, 'uploads/videos/thumbnails/77-5fc32f6854bca.jpg', 0),
(35, 77, 'uploads/videos/thumbnails/77-5fc32f687e6e7.jpg', 1),
(36, 78, 'uploads/videos/thumbnails/78-5fc5b9f80e746.jpg', 1),
(37, 78, 'uploads/videos/thumbnails/78-5fc5b9f83ba4e.jpg', 0),
(38, 78, 'uploads/videos/thumbnails/78-5fc5b9f8901eb.jpg', 0),
(39, 79, 'uploads/videos/thumbnails/79-5fc6f09b66f33.jpg', 1),
(40, 79, 'uploads/videos/thumbnails/79-5fc6f09c507c2.jpg', 0),
(41, 79, 'uploads/videos/thumbnails/79-5fc6f09e165de.jpg', 0),
(42, 80, 'uploads/videos/thumbnails/80-5fc94f94528a0.jpg', 1),
(43, 80, 'uploads/videos/thumbnails/80-5fc94f9536f02.jpg', 0),
(44, 80, 'uploads/videos/thumbnails/80-5fc94f96e9c42.jpg', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstName` varchar(25) NOT NULL,
  `lastName` varchar(25) NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `signUpDate` datetime NOT NULL DEFAULT current_timestamp(),
  `profilePic` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `username`, `email`, `password`, `signUpDate`, `profilePic`) VALUES
(4, 'Abhinav', 'Singh', 'abknave', 'abhinav.coder@gmail.com', '115e85111601105d3f41f5d72edec21e32168d94d6c7f27024f2ef22721a07a3b578cec84a0e92850c4d2ac71df6ad8d9d4eb166d19baae6d7a310a1ee24eb08', '2020-11-26 04:57:34', 'assets/images/profilePictures/Default.png'),
(5, 'Anubhav', 'Singh', 'anubhav', 'anubhavsinghit@gmail.com', '115e85111601105d3f41f5d72edec21e32168d94d6c7f27024f2ef22721a07a3b578cec84a0e92850c4d2ac71df6ad8d9d4eb166d19baae6d7a310a1ee24eb08', '2020-11-29 08:32:54', 'assets/images/profilePictures/Default.png'),
(6, 'Eshwar', 'Clemson', 'eshwar', 'Eshwar@gmail.com', '274689249a723d0f0dbac1750b32e3a458ad10f890980b79176aeb0f5b05ef69f12cad342767ec9fa3f4540ffdb883f47bc21c0bb39b95bfa640692b11935521', '2020-12-03 10:26:12', 'assets/images/profilePictures/Default.png');

-- --------------------------------------------------------

--
-- Table structure for table `videos`
--

CREATE TABLE `videos` (
  `id` int(11) NOT NULL,
  `uploadedBy` varchar(50) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(1000) NOT NULL,
  `privacy` int(11) NOT NULL DEFAULT 0,
  `filePath` varchar(500) NOT NULL,
  `category` int(11) NOT NULL DEFAULT 0,
  `uploadDate` datetime NOT NULL DEFAULT current_timestamp(),
  `views` int(11) NOT NULL DEFAULT 0,
  `duration` varchar(20) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `videos`
--

INSERT INTO `videos` (`id`, `uploadedBy`, `title`, `description`, `privacy`, `filePath`, `category`, `uploadDate`, `views`, `duration`) VALUES
(77, 'abknave', 'jurassic', 'adfasd', 1, 'uploads/videos/5fc32f6491631.mp4', 1, '2020-11-29 05:19:32', 377, '00:06'),
(78, 'anubhav', 'Test Video 2', 'Test Video 2 Description', 1, 'uploads/videos/5fc5b9f3d4414.mp4', 2, '2020-12-01 03:35:15', 93, '00:30'),
(79, 'abknave', 'EArth ', 'for checking Categories', 0, 'uploads/videos/5fc6f07d53ad5.mp4', 14, '2020-12-02 01:40:13', 5, '00:30'),
(80, 'eshwar', 'Earth 2', 'for experimental Purposes', 1, 'uploads/videos/5fc94f7886899.mp4', 4, '2020-12-03 20:50:00', 4, '00:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `block`
--
ALTER TABLE `block`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dislikes`
--
ALTER TABLE `dislikes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `family`
--
ALTER TABLE `family`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favourites`
--
ALTER TABLE `favourites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friend`
--
ALTER TABLE `friend`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `thumbnails`
--
ALTER TABLE `thumbnails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `videos`
--
ALTER TABLE `videos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `block`
--
ALTER TABLE `block`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `dislikes`
--
ALTER TABLE `dislikes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `family`
--
ALTER TABLE `family`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `favourites`
--
ALTER TABLE `favourites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `friend`
--
ALTER TABLE `friend`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `thumbnails`
--
ALTER TABLE `thumbnails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `videos`
--
ALTER TABLE `videos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

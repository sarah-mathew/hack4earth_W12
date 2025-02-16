-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 16, 2025 at 07:35 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `techlio_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `community_feedback`
--

CREATE TABLE `community_feedback` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `feedback` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `community_feedback`
--

INSERT INTO `community_feedback` (`id`, `user_id`, `username`, `feedback`, `created_at`) VALUES
(1, 4, 'bhavya', 'hiii', '2025-02-16 02:15:54'),
(2, 4, 'bhavya', 'very nice', '2025-02-16 02:36:09');

-- --------------------------------------------------------

--
-- Table structure for table `community_posts`
--

CREATE TABLE `community_posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `media_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `likes` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `community_posts`
--

INSERT INTO `community_posts` (`id`, `user_id`, `username`, `message`, `media_path`, `created_at`, `likes`) VALUES
(1, 1, 'JohnDoe', 'hiii', NULL, '2025-02-16 00:33:43', 0),
(2, 1, 'JohnDoe', 'hiii', NULL, '2025-02-16 00:41:01', 0),
(3, 1, 'JohnDoe', 'hello community', NULL, '2025-02-16 00:41:13', 1),
(4, 1, 'JohnDoe', 'hey', NULL, '2025-02-16 00:47:53', 1),
(5, 1, 'root', 'hello', NULL, '2025-02-16 00:54:21', 0),
(6, 1, 'susansaju', 'welcome', NULL, '2025-02-16 00:54:49', 1),
(7, 1, 'susansaju', 'hi everyone', NULL, '2025-02-16 01:21:37', 1),
(8, 4, 'bhavya', 'hiiii', NULL, '2025-02-16 02:26:17', 0),
(9, 4, 'bhavya', 'welcome to community', NULL, '2025-02-16 02:35:52', 0);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `feedback` text NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `group_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`group_id`, `name`, `description`, `created_by`, `created_at`) VALUES
(1, 'hack4earth', 'save', NULL, '2025-02-15 23:55:03'),
(5, 'sustain_earth', 'adapt to ecofriendly methods', NULL, '2025-02-16 01:15:12');

-- --------------------------------------------------------

--
-- Table structure for table `group_members`
--

CREATE TABLE `group_members` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `joined_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `post_likes`
--

CREATE TABLE `post_likes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `post_likes`
--

INSERT INTO `post_likes` (`id`, `user_id`, `post_id`) VALUES
(2, 4, 3),
(4, 4, 4),
(1, 4, 6),
(3, 4, 7);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `reset_token` varchar(255) DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT 'images/default-avatar.png',
  `posts` int(11) DEFAULT 0,
  `upvotes` int(11) DEFAULT 0,
  `comments` int(11) DEFAULT 0,
  `badges` text DEFAULT '[]',
  `progress` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`, `reset_token`, `reset_expires`, `profile_picture`, `posts`, `upvotes`, `comments`, `badges`, `progress`) VALUES
(1, 'susansaju', 'susansaju05@gmail.com', '$2y$10$6FRKs/On1v52tlyhBkbUfe66VB8Xo6qbnhZPXBGIQ2W5nwQKT6NQ6', '2025-02-14 10:34:06', '01e6399efe9be8b205cc33450cca9eb7c7798a0ff0f26daf388d6a387898e26129bb354857eb2e64462b60b987be919944c6', '2025-02-14 16:33:00', 'images/default-avatar.png', 0, 0, 0, '[]', 0),
(2, 'sarahmariam', 'sarahmathew848@gmail.com', '$2y$10$LPtvIfsa1lT5lfHx0TOLPeEkcXTOQBMURvaTO/P4xXtD5tQRVIb3e', '2025-02-15 05:05:05', NULL, NULL, 'images/default-avatar.png', 0, 0, 0, '[]', 0),
(3, 'akshata', 'akshata1522@gmail.com', '$2y$10$MwG/H2PznPXW9MESoBpHr.e6bDt1oEOomkrX3tJy1zX9RpqY4GN.a', '2025-02-15 10:18:25', NULL, NULL, 'images/default-avatar.png', 0, 0, 0, '[]', 0),
(4, 'bhavya', 'bhavyashree2454@gmail.com', '$2y$10$QxwjAqY3WS/BSg3AJCz4d.OQk.O.oNyLH3Rzi7NzssEBdHKtRgbJW', '2025-02-15 10:45:17', NULL, NULL, 'images/default-avatar.png', 0, 0, 0, '[]', 0),
(5, 'sarasaju', 'susanaikkarakudyil@gmail.com', '$2y$10$uwIWmY5.5/ve4xV1CjkLhuPnkqZ5v7sgML.p8WObS0yXO2m/2lh9S', '2025-02-15 18:59:50', NULL, NULL, 'images/default-avatar.png', 0, 0, 0, '[]', 0),
(6, 'ritu', 'ritu123@gmail.com', '$2y$10$74wJVtsresWpHOmO/5qjluZEYCxyB.ECkXp9o/IPZzSu/U8n99HjK', '2025-02-16 03:44:10', NULL, NULL, 'images/default-avatar.png', 0, 0, 0, '[]', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `community_feedback`
--
ALTER TABLE `community_feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `community_posts`
--
ALTER TABLE `community_posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`group_id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `created_by` (`created_by`);

--
-- Indexes for table `group_members`
--
ALTER TABLE `group_members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `post_likes`
--
ALTER TABLE `post_likes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`post_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `community_feedback`
--
ALTER TABLE `community_feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `community_posts`
--
ALTER TABLE `community_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `group_members`
--
ALTER TABLE `group_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `post_likes`
--
ALTER TABLE `post_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `community_feedback`
--
ALTER TABLE `community_feedback`
  ADD CONSTRAINT `community_feedback_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `community_posts`
--
ALTER TABLE `community_posts`
  ADD CONSTRAINT `community_posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `groups`
--
ALTER TABLE `groups`
  ADD CONSTRAINT `groups_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `group_members`
--
ALTER TABLE `group_members`
  ADD CONSTRAINT `group_members_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `group_members_ibfk_2` FOREIGN KEY (`group_id`) REFERENCES `groups` (`group_id`) ON DELETE CASCADE;

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `post_likes`
--
ALTER TABLE `post_likes`
  ADD CONSTRAINT `post_likes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `post_likes_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `community_posts` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

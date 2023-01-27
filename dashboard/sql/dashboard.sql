-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 27, 2020 at 11:48 AM
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
-- Database: `dashboard`
--
CREATE DATABASE IF NOT EXISTS `dashboard` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `dashboard`;

-- --------------------------------------------------------

--
-- Table structure for table `devise_conversion`
--

CREATE TABLE `devise_conversion` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `devise_target` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `devise_format` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `quantity` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `timer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `name`, `description`) VALUES
(8, 'steam', 'permets de voir des informations sur steam'),
(10, 'meteo', 'widget sur la météo en fonction d un endroit'),
(11, 'devise conversion', 'permet la conversion entre 2 devises et d obtenir le resultat'),
(12, 'youtube video', 'permet d avoir des informations sur une vidéo youtube');

-- --------------------------------------------------------

--
-- Table structure for table `steam_app_news`
--

CREATE TABLE `steam_app_news` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `game_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `timer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `steam_app_news`
--

INSERT INTO `steam_app_news` (`id`, `name`, `user_id`, `game_id`, `service_name`, `timer`) VALUES
(4, 'steam app news', 10, '252490', 'steam', 10),
(5, 'steam app news', 10, '1134480', 'steam', 10);

-- --------------------------------------------------------

--
-- Table structure for table `steam_profile`
--

CREATE TABLE `steam_profile` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `profileid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `timer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `steam_profile`
--

INSERT INTO `steam_profile` (`id`, `name`, `user_id`, `profileid`, `service_name`, `timer`) VALUES
(1, 'steam profile', 10, '76561198402553230', 'steam', 10);

-- --------------------------------------------------------

--
-- Table structure for table `steam_recent_games`
--

CREATE TABLE `steam_recent_games` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `profileid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gamenumber` int(11) NOT NULL,
  `service_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `timer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `steam_recent_games`
--

INSERT INTO `steam_recent_games` (`id`, `name`, `user_id`, `profileid`, `gamenumber`, `service_name`, `timer`) VALUES
(1, 'steam recents games', 10, '76561198402553230', 3, 'steam', 10);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`roles`)),
  `google_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `google_auth` tinyint(1) NOT NULL,
  `facebook_auth` tinyint(1) NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `check_token` text COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `mail`, `password`, `roles`, `google_token`, `facebook_token`, `google_auth`, `facebook_auth`, `enabled`, `check_token`) VALUES
(10, 'farragut', 'neilcauet@epitech.eu', '$2y$13$qo8djCEd1uDCtNSMkoU.u.Si6XZczUV.vkwwHtRMVHdikyTWfIqua', '[\"ROLE_USER\"]', NULL, NULL, 0, 0, 1, NULL),
(11, 'admin', 'neilcauet@epitech.eu', '$2y$13$w3Z3jUdezp5rvHGxGmtVXOlI5oT1gvpszYusJX9PeDg868E3EYRTm', '[\"ROLE_USER\",\"ROLE_ADMIN\"]', NULL, NULL, 0, 0, 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `weather`
--

CREATE TABLE `weather` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `town` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `service_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `timer` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `weather`
--

INSERT INTO `weather` (`id`, `name`, `user_id`, `town`, `service_name`, `timer`) VALUES
(7, 'weather api', 10, 'Lille', 'meteo', 10);

-- --------------------------------------------------------

--
-- Table structure for table `youtube_video`
--

CREATE TABLE `youtube_video` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `video_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `service_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `timer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `youtube_video`
--

INSERT INTO `youtube_video` (`id`, `name`, `video_id`, `user_id`, `service_name`, `timer`) VALUES
(1, 'youtube video', 'Cc0lWpm7zMs', 10, 'youtube video', 50),
(2, 'youtube video', 'Cc0lWpm7zMs', 11, 'youtube video', 50),
(3, 'youtube video', 'Cc0lWpm7zMs', 18, 'youtube video', 100);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `devise_conversion`
--
ALTER TABLE `devise_conversion`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `steam_app_news`
--
ALTER TABLE `steam_app_news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `steam_profile`
--
ALTER TABLE `steam_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `steam_recent_games`
--
ALTER TABLE `steam_recent_games`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `weather`
--
ALTER TABLE `weather`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `youtube_video`
--
ALTER TABLE `youtube_video`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `devise_conversion`
--
ALTER TABLE `devise_conversion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `steam_app_news`
--
ALTER TABLE `steam_app_news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `steam_profile`
--
ALTER TABLE `steam_profile`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `steam_recent_games`
--
ALTER TABLE `steam_recent_games`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `weather`
--
ALTER TABLE `weather`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `youtube_video`
--
ALTER TABLE `youtube_video`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

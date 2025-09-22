-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2025 at 03:16 PM
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
-- Database: `mydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `author_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `role` varchar(50) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`, `role`) VALUES
(1, 'root', 'root@gmail.com', '$2y$10$xFlHtGIYLhojK5xlcOHyOuJTIjIdu9ZVicoUJPrlRaRcRUk4tZI5i', '2025-09-09 12:38:04', 'user'),
(3, 'ave_driller', 'Muthomi@gmail.com', '$2y$10$la9.GOyvJaD5vJfZxIvC1uJXgy/n0zvXbGM3wVFaN/Lflb9T/Qi4C', '2025-09-09 12:39:49', 'user'),
(5, 'ricospider', 'muthomieverton@gmail.com', '$2y$10$AVHUrnOo7z/fVRLA20j4HeisxCcBmAQimGYJtMBeZB/wcD.eO0IAe', '2025-09-09 12:43:12', 'user'),
(6, 'jew', 'jew@gmail.com', '$2y$10$Y1JSyNBd4vIMXBuWrJW.nuS0u4k1DU6Nvr3mrKTJou2Y5dyLnqJFi', '2025-09-09 21:51:24', 'user'),
(7, 'jake', 'jake@gmail.com', '$2y$10$FfTyBVibaQF6ZibkowGM6eCh3qoiiXj7L0R9jBremiNmXzsfCdZdm', '2025-09-09 22:30:25', 'user'),
(8, 'ave', 'avedriller@gmail.com', '$2y$10$hP0ZSqgX.gkyI99Rx54YyuWtJEY328PUGyHBciIni7rC5qrCRRdDG', '2025-09-15 11:49:47', 'user'),
(10, 'hae', 'hae@gmail.com', '$2y$10$f5c3JwAJa4sNfTCJaTHycOFyeWg9eboMHLasJQlitrj6UpBLqfmSm', '2025-09-15 12:12:57', 'user'),
(11, 'jjjj', 'jjjj@gmail.com', '$2y$10$7LWtEJbRDgRAUEgfIAPdROsbhWmJMH/X/FPK29EKXpFiR0NHrCJ9G', '2025-09-15 12:17:37', 'user'),
(12, 'mark', 'mark@gmail.com', '$2y$10$Mz3U1y.smbXykWUuNOG47.fjAx6zj1QP6/Vik4WZNo.BtoLrXHgBu', '2025-09-15 22:40:42', 'user'),
(14, 'hey', 'hey@gmail.com', '$2y$10$Zbyav1VBfYzGzO3htvMw/.ACJ4dqN.zQwUV.qGnp906gq3l1PFdEm', '2025-09-15 22:50:19', 'user'),
(15, 'everton kimathi', '', '$2y$10$ln78NbSVffx0ApDFJj445.NF29xwsDUG8uktRzICAbgFH/mQu834m', '2025-09-21 19:46:44', 'admin'),
(19, 'ahe', 'ahe@gmail.com', '$2y$10$6ncOSks0KLryjimCH/ol.OcZy/LluxR9pKfeSkLfhB9dzKtihFTSW', '2025-09-21 21:02:02', 'user'),
(20, 'nesh', 'nesh@gmail.com', '$2y$10$VHJUN.hVAAR9gwkayNNC6.ilJ0hWgGRanqhZj0MN3E8exdLRc5L4i', '2025-09-21 21:05:05', 'admin'),
(21, 'johnte', 'johnte@gmail.com', '$2y$10$aPeW0UauD35LuK.vjM/8pOx/wya3sxOpSqJ5B7HYbO08rCEvuNjjy', '2025-09-22 12:29:43', 'user'),
(22, 'cain', 'cainn@gmail.com', '$2y$10$D.1ip6gvEZQ/6njUhq0w6.cYHvlKR9UiVisnIEHqPOTt7svT239eu', '2025-09-22 12:34:07', 'blogger'),
(23, 'ham', 'ham@gmail.com', '$2y$10$E7DdTHtQWXuDQ//OJt2BQejAVBN7m5t/dujbSVc3QIxdsxfn0sXhW', '2025-09-22 12:43:01', 'blogger'),
(24, 'nam', 'nam@gmail.com', '$2y$10$m4MVQ46vSBPQ32aRGd21xO3ExCJqNljamtHmSmRb9DyWOL9BEW9va', '2025-09-22 13:11:41', 'blogger');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `author_id` (`author_id`);

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
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blogs`
--
ALTER TABLE `blogs`
  ADD CONSTRAINT `blogs_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

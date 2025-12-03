-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2025 at 01:53 PM
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
-- Database: `lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `instructor_id` int(11) NOT NULL,
  `price` decimal(10,2) DEFAULT 0.00,
  `status` enum('Approve','Reject','Pending') DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `title`, `description`, `instructor_id`, `price`, `status`) VALUES
(24, 'Front-end web Developer', 'Front End Web Developer. Master HTML, CSS, and JavaScript to build responsive websites and dynamic web applications with hands-on', 13, 100.00, 'Approve'),
(25, 'Ultimate Beginner Electric Guitar Masterclass', 'Learn step-by-step, proven electric guitar method that will teach you to play electric guitar for beginners in a month', 13, 150.00, 'Approve'),
(26, 'Practical Git and GitHub: From Basics to Pro Workflows', 'Learn the essential Git commands and real-world GitHub workflows used by modern development teams.', 13, 80.00, 'Approve'),
(27, 'Beginners Guide to Learning PHP 5', 'Learn how to write PHP code. Beginners quick start guide to learning the foundations of PHP coding', 14, 130.00, 'Approve'),
(28, 'Complete web development course', 'Only web development course that you will need. Covers HTML, CSS, Tailwind, Node, React, MongoDB, Prisma, Deployment etc', 14, 130.00, 'Approve'),
(29, 'Master React JS and Tailwind CSS with Real-World Projects', 'Learn how to build a game listing app with React, Tailwind CSS, Vite, and Vercel.', 14, 100.00, 'Approve'),
(30, 'Repudiandae ullamco ', 'Consequatur Deserun', 13, 465.00, 'Reject');

-- --------------------------------------------------------

--
-- Table structure for table `enrollments`
--

CREATE TABLE `enrollments` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `progress` int(11) DEFAULT 0,
  `enrolled_at` datetime DEFAULT current_timestamp(),
  `enroll` enum('enroll','Not_enroll') DEFAULT 'Not_enroll'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enrollments`
--

INSERT INTO `enrollments` (`id`, `course_id`, `student_id`, `progress`, `enrolled_at`, `enroll`) VALUES
(223, 24, 15, 0, '2025-12-03 17:21:56', 'enroll'),
(224, 25, 15, 0, '2025-12-03 17:28:21', 'enroll'),
(225, 26, 15, 0, '2025-12-03 17:28:28', 'enroll'),
(226, 24, 16, 0, '2025-12-03 17:41:29', 'enroll');

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

CREATE TABLE `lessons` (
  `id` int(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `content` text DEFAULT NULL,
  `video_url` varchar(255) DEFAULT NULL,
  `Active` enum('Complete','Not_Complete') DEFAULT 'Not_Complete'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lessons`
--

INSERT INTO `lessons` (`id`, `course_id`, `title`, `content`, `video_url`, `Active`) VALUES
(7, 24, 'Rodmap of forntend Dev', 'Rodmap of forntend Dev for Beginner', 'https://www.youtube.com/embed/1IVopxj8q8U', 'Complete'),
(8, 24, 'stact a html', 'html a hmt will tag section etc', 'https://www.youtube.com/embed/1IVopxj8q8U', 'Complete'),
(9, 24, 'start Css ', 'start Css for Begger', 'https://www.youtube.com/embed/1IVopxj8q8U', 'Complete'),
(10, 24, 'start js ', 'start js for begger', 'https://www.youtube.com/embed/1IVopxj8q8U', 'Complete'),
(11, 24, 'start git and github', 'start git and github for Beggin', 'https://www.youtube.com/embed/1IVopxj8q8U', 'Complete'),
(15, 24, 'qwerty', 'rtyuio', 'wert', 'Complete'),
(16, 24, 'Consequatur Nesciun', 'Repudiandae dignissi', 'Sed quam deserunt qu', 'Complete'),
(17, 25, 'Consequat Voluptate', 'Illum voluptas omni', 'Perferendis in corru', 'Complete'),
(18, 25, 'Quo quaerat reiciend', 'Soluta architecto au', 'Quo nobis et exercit', 'Not_Complete'),
(19, 25, 'Voluptatibus dolor e', 'Dolorem est aut magn', 'Ut accusantium rem q', 'Not_Complete'),
(20, 25, 'Omnis ipsum veniam ', 'Ea enim qui culpa in', 'Fugiat ut ea pariatu', 'Not_Complete'),
(21, 25, 'Mollit ea nisi inven', 'Iure unde officiis a', 'Nulla quidem volupta', 'Not_Complete');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','instructor','student') DEFAULT 'student'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`) VALUES
(7, 'Madadali Memon', 'madadalimemon90@gmail.com', '$2y$10$sxsQB4mS7xv1sQuBLA.hVePLTTtpW3n4A1JlFbH5Qf8mIstxPj2fi', 'admin'),
(13, 'Basit Ali', 'basitali90@gmail.com', '$2y$10$tZCivqVJ4wz7F6KN06TvBOwuUghQK.xYyLmKLUYPD2NLz8soMqGBu', 'instructor'),
(14, 'Shaheer', 'Shaheermemon90@gmail.com', '$2y$10$330tDytdz1.GDIPTx456T.4QL/u9RHkgTETuJRalJIMLUVz5i0j4C', 'instructor'),
(15, 'saad memon', 'madadalim803@gmail.com', '$2y$10$D3slOoCtlyHCCO5b0O6iBu6fjMdy7EZug2ejscRf3LGx44AJu/hTe', 'student'),
(16, 'buriroabdul', 'buriroabdulqayoom2002@gmail.com', '$2y$10$plV.HnQp.5dAqIxp6MHms.5xGMT7ZRpJCqjMkLuThTovHJrxJNQ8K', 'student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_instructor` (`instructor_id`);

--
-- Indexes for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=227;

--
-- AUTO_INCREMENT for table `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `fk_instructor` FOREIGN KEY (`instructor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD CONSTRAINT `enrollments_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `enrollments_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lessons`
--
ALTER TABLE `lessons`
  ADD CONSTRAINT `lessons_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

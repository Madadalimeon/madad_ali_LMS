-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 30, 2025 at 04:48 PM
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
(26, 'Front-end web Developer', 'Front End Web Developer. Master HTML, CSS, and JavaScript to build responsive websites and dynamic web applications with hands-on', 14, 100.00, 'Approve'),
(27, 'Ultimate Beginner Electric Guitar Masterclass', 'Learn step-by-step, proven electric guitar method that will teach you to play electric guitar for beginners in a month', 14, 150.00, 'Approve'),
(28, 'Practical Git and GitHub: From Basics to Pro Workflows', 'Learn the essential Git commands and real-world GitHub workflows used by modern development teams.', 14, 80.00, 'Approve'),
(29, 'Beginners Guide to Learning PHP 5', 'Learn how to write PHP code. Beginners quick start guide to learning the foundations of PHP coding', 15, 90.00, 'Approve'),
(30, 'Complete web development course', 'Only web development course that you will need. Covers HTML, CSS, Tailwind, Node, React, MongoDB, Prisma, Deployment etc', 15, 130.00, 'Approve'),
(31, 'Master React JS and Tailwind CSS with Real-World Projects', 'Learn how to build a game listing app with React, Tailwind CSS, Vite, and Vercel.', 15, 100.00, 'Approve');

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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `fk_instructor` FOREIGN KEY (`instructor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

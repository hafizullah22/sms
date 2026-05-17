-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2026 at 03:03 AM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 7.4.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sms`
--

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` bigint(20) NOT NULL,
  `class_name` varchar(50) NOT NULL,
  `class_numeric` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `class_name`, `class_numeric`) VALUES
(1, 'class one', 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `class_id` int(2) NOT NULL,
  `month` int(2) NOT NULL,
  `year` int(4) NOT NULL,
  `payment_type` int(2) NOT NULL,
  `amount` int(6) NOT NULL,
  `paid_amount` int(6) NOT NULL,
  `due_amount` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `pay_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`id`, `student_id`, `class_id`, `month`, `year`, `payment_type`, `amount`, `paid_amount`, `due_amount`, `status`, `pay_date`) VALUES
(5, 3, 1, 1, 2026, 1, 1000, 1000, 0, 'paid', '2026-05-14'),
(6, 4, 1, 1, 2026, 1, 1000, 1000, 0, 'paid', '2026-05-14'),
(7, 5, 1, 1, 2026, 1, 1000, 1000, 0, 'paid', '2026-05-14'),
(8, 8, 1, 1, 2026, 1, 1000, 0, 1000, 'unpaid', '0000-00-00'),
(9, 3, 1, 2, 2026, 1, 1000, 1000, 0, 'paid', '2026-05-14');

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `id` bigint(20) NOT NULL,
  `student_id` bigint(20) NOT NULL,
  `class_id` bigint(20) NOT NULL,
  `subject_id` bigint(20) NOT NULL,
  `exam_name` varchar(100) DEFAULT NULL,
  `year` varchar(10) DEFAULT NULL,
  `marks` decimal(5,2) DEFAULT NULL,
  `grade` varchar(5) DEFAULT NULL,
  `grade_point` decimal(3,2) DEFAULT NULL,
  `is_pass` tinyint(4) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`id`, `student_id`, `class_id`, `subject_id`, `exam_name`, `year`, `marks`, `grade`, `grade_point`, `is_pass`, `created_at`) VALUES
(1, 3, 1, 1, NULL, NULL, '78.00', NULL, NULL, 1, '2026-05-10 09:56:32'),
(2, 4, 1, 1, NULL, NULL, '78.00', NULL, NULL, 1, '2026-05-10 09:56:32'),
(3, 5, 1, 1, NULL, NULL, '67.00', NULL, NULL, 1, '2026-05-10 09:56:32'),
(4, 3, 1, 2, NULL, NULL, '60.00', NULL, NULL, 1, '2026-05-10 10:56:40'),
(5, 4, 1, 2, NULL, NULL, '40.00', NULL, NULL, 1, '2026-05-10 10:56:40'),
(6, 5, 1, 2, NULL, NULL, '90.00', NULL, NULL, 1, '2026-05-10 10:56:40'),
(7, 3, 1, 3, NULL, NULL, '90.00', NULL, NULL, 1, '2026-05-10 11:22:40'),
(8, 4, 1, 3, NULL, NULL, '89.00', NULL, NULL, 1, '2026-05-10 11:22:40'),
(9, 5, 1, 3, NULL, NULL, '90.00', NULL, NULL, 1, '2026-05-10 11:22:40'),
(10, 3, 1, 4, NULL, NULL, '89.00', NULL, NULL, 1, '2026-05-14 06:43:44'),
(11, 4, 1, 4, NULL, NULL, '56.00', NULL, NULL, 1, '2026-05-14 06:43:44'),
(12, 5, 1, 4, NULL, NULL, '67.00', NULL, NULL, 1, '2026-05-14 06:43:44'),
(13, 8, 1, 4, NULL, NULL, '56.00', NULL, NULL, 1, '2026-05-14 06:43:44'),
(14, 8, 1, 3, NULL, NULL, '89.00', NULL, NULL, 1, '2026-05-14 06:43:52'),
(15, 3, 1, 5, NULL, NULL, '65.00', NULL, NULL, 1, '2026-05-14 06:45:23'),
(16, 4, 1, 5, NULL, NULL, '56.00', NULL, NULL, 1, '2026-05-14 06:45:23'),
(17, 5, 1, 5, NULL, NULL, '77.00', NULL, NULL, 1, '2026-05-14 06:45:23'),
(18, 8, 1, 5, NULL, NULL, '23.00', NULL, NULL, 1, '2026-05-14 06:45:23'),
(19, 3, 1, 6, NULL, NULL, '55.00', NULL, NULL, 1, '2026-05-14 06:47:01'),
(20, 4, 1, 6, NULL, NULL, '78.00', NULL, NULL, 1, '2026-05-14 06:47:01'),
(21, 5, 1, 6, NULL, NULL, '56.00', NULL, NULL, 1, '2026-05-14 06:47:01'),
(22, 8, 1, 6, NULL, NULL, '45.00', NULL, NULL, 1, '2026-05-14 06:47:01'),
(23, 3, 1, 7, NULL, NULL, '56.00', NULL, NULL, 1, '2026-05-14 06:47:13'),
(24, 4, 1, 7, NULL, NULL, '67.00', NULL, NULL, 1, '2026-05-14 06:47:13'),
(25, 5, 1, 7, NULL, NULL, '56.00', NULL, NULL, 1, '2026-05-14 06:47:13'),
(26, 8, 1, 7, NULL, NULL, '56.00', NULL, NULL, 1, '2026-05-14 06:47:13'),
(27, 8, 1, 1, NULL, NULL, '56.00', NULL, NULL, 1, '2026-05-14 06:47:22'),
(28, 8, 1, 2, NULL, NULL, '56.00', NULL, NULL, 1, '2026-05-14 06:47:29');

-- --------------------------------------------------------

--
-- Table structure for table `school_info`
--

CREATE TABLE `school_info` (
  `id` int(11) NOT NULL,
  `school_name_en` mediumtext NOT NULL,
  `school_name_bn` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(15) NOT NULL,
  `eiin_number` int(11) NOT NULL,
  `address` varchar(2000) NOT NULL,
  `establishment_year` int(4) NOT NULL,
  `logo` varchar(2000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `school_info`
--

INSERT INTO `school_info` (`id`, `school_name_en`, `school_name_bn`, `phone`, `eiin_number`, `address`, `establishment_year`, `logo`) VALUES
(1, 'Prof. Dr. Ruhul Amin Technical School and College', 'প্রফেসর ডা রুহুল আমিন আর ডি ইনস্টিটিউট অব টেকনোলজি', '01723411400', 13140, 'মহিদপুর, ঝলম, বরুড়া, কুমিল্লা', 2020, 'images/42560527c09e16ae67d781c2ff7ed09e.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) NOT NULL,
  `student_uid` varchar(50) DEFAULT NULL,
  `roll_no` varchar(20) DEFAULT NULL,
  `registration_no` varchar(50) DEFAULT NULL,
  `full_name` varchar(150) NOT NULL,
  `gender` enum('Male','Female','Other') DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `father_name` varchar(150) DEFAULT NULL,
  `mother_name` varchar(150) DEFAULT NULL,
  `guardian_phone` varchar(20) DEFAULT NULL,
  `permanent_address` text DEFAULT NULL,
  `present_address` int(11) NOT NULL,
  `class_id` bigint(20) NOT NULL,
  `session_year` varchar(20) DEFAULT NULL,
  `admission_date` date DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `student_uid`, `roll_no`, `registration_no`, `full_name`, `gender`, `date_of_birth`, `father_name`, `mother_name`, `guardian_phone`, `permanent_address`, `present_address`, `class_id`, `session_year`, `admission_date`, `photo`, `status`) VALUES
(3, NULL, '10001', '', 'মোঃ হাফিজ উল্লাহ', 'Male', '1995-01-03', 'মোঃ সফি উল্লাহ', 'নাজনিন সুলতানা', '01723411403', 'HAJARPAR,HAJARPAR,BARURA,CUMILLA', 0, 1, '2026-27', NULL, NULL, 1),
(4, NULL, '10002', '', 'MD. SAKIB ', '', '0000-00-00', NULL, NULL, NULL, NULL, 0, 1, '2026-27', NULL, NULL, 1),
(5, NULL, '10003', '', 'MD. RAHAMAT ULLAH', '', '0000-00-00', NULL, NULL, NULL, NULL, 0, 1, '2026-27', NULL, NULL, 1),
(8, NULL, '10004', '', 'MD. HAFIZ ULLAH', '', '0000-00-00', NULL, NULL, NULL, NULL, 0, 1, '2026-27', NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` bigint(20) NOT NULL,
  `class_id` bigint(20) NOT NULL,
  `subject_name` varchar(150) NOT NULL,
  `subject_type` int(2) DEFAULT NULL,
  `total_marks` int(11) DEFAULT 100,
  `year` int(4) NOT NULL,
  `pass_marks` int(11) DEFAULT 33
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `class_id`, `subject_name`, `subject_type`, `total_marks`, `year`, `pass_marks`) VALUES
(1, 1, 'Bangla', 1, 100, 2026, 33),
(2, 1, 'English', 1, 100, 2026, 33),
(3, 1, 'Mathematics', 1, 100, 2026, 33),
(4, 1, 'Religion', 1, 100, 2026, 33),
(5, 1, 'Drawing', 1, 100, 2026, 33),
(6, 1, 'history', 1, 100, 2024, 33),
(7, 1, 'GEO', 1, 100, 2026, 33),
(8, 1, 'Economics', 1, 100, 2025, 33);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `role` enum('super_admin','admin','teacher','student') NOT NULL,
  `name` varchar(150) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(4) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `name`, `username`, `email`, `phone`, `password`, `status`, `created_at`) VALUES
(1, 'super_admin', 'Md. Hafiz Ullah', 'hafizullah', 'hafiz@gmail.com', '01723411403', '$2y$10$AFMXHTAj7I6DyIHuifO6QuNoagcoiCByJ1mx7TDDi/oGcWip/5ffu', 1, '2026-05-16 13:27:58');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `class_numeric` (`class_numeric`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `class_id` (`class_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `school_info`
--
ALTER TABLE `school_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_uid` (`student_uid`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD KEY `class_id` (`class_id`);

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
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `school_info`
--
ALTER TABLE `school_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `results`
--
ALTER TABLE `results`
  ADD CONSTRAINT `results_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `results_ibfk_2` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `results_ibfk_3` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`);

--
-- Constraints for table `subjects`
--
ALTER TABLE `subjects`
  ADD CONSTRAINT `subjects_ibfk_1` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

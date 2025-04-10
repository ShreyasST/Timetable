-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Apr 10, 2025 at 07:02 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `devops`
--

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `class_id` int(11) NOT NULL,
  `class_name` varchar(50) NOT NULL,
  `sem` int(11) NOT NULL,
  `section` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `subject_id` varchar(10) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `standard` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subject_id`, `name`, `standard`) VALUES
('10BIO', 'Biology', 10),
('10CHE', 'Chemistry', 10),
('10ENG', 'English', 10),
('10HISN', 'Hindi / Sanskrit', 10),
('10KAN', 'Kannada', 10),
('10MTH', 'Maths', 10),
('10PE', 'Physical Education', 10),
('10PHY', 'Physics', 10),
('10SOC', 'Social Science', 10),
('1DRW', 'Drawing/Craft', 1),
('1ENG', 'English', 1),
('1EVS', 'EVS', 1),
('1KAN', 'Kannada', 1),
('1MTH', 'Maths', 1),
('1PE', 'Physical Education', 1),
('2DRW', 'Drawing', 2),
('2ENG', 'English', 2),
('2EVS', 'EVS', 2),
('2KAN', 'Kannada', 2),
('2MTH', 'Maths', 2),
('2PE', 'Physical Education', 2),
('3DRW', 'Drawing', 3),
('3ENG', 'English', 3),
('3EVS', 'EVS', 3),
('3KAN', 'Kannada', 3),
('3MOR', 'Moral Values', 3),
('3MTH', 'Maths', 3),
('3PE', 'Physical Education', 3),
('4CCA', 'Co-Curricular Activities', 4),
('4ENG', 'English', 4),
('4HISN', 'Hindi / Sanskrit ', 4),
('4KAN', 'Kannada', 4),
('4MTH', 'Maths', 4),
('4PE', 'Physical Education', 4),
('4POL', 'Political Science', 4),
('4SCI', 'General Science', 4),
('5CCA', 'Co-Curricular Activities', 5),
('5ENG', 'English', 5),
('5HISN', 'Hindi / Sanskrit', 5),
('5KAN', 'Kannada', 5),
('5MTH', 'Maths', 5),
('5PE', 'Physical Education', 5),
('5POL', 'Political Science', 5),
('5SCI', 'General Science', 5),
('6CCA', 'Co-Curricular Activities', 6),
('6ENG', 'English', 6),
('6HISN', 'Hindi / Sanskrit', 6),
('6KAN', 'Kannada', 6),
('6MOR', 'Moral Science', 6),
('6MTH', 'Maths', 6),
('6PE', 'Physical Education', 6),
('6POL', 'Political Science', 6),
('6SCI', 'General Science', 6),
('7CCA', 'Co-Curricular Activities', 7),
('7ENG', 'English', 7),
('7HISN', 'Hindi / Sanskrit ', 7),
('7KAN', 'Kannada', 7),
('7MOR', 'Moral Science', 7),
('7MTH', 'Maths', 7),
('7PE', 'Physical Education', 7),
('7POL', 'Political Science', 7),
('7SCI', 'General Science', 7),
('8BIO', 'Biology', 8),
('8CHE', 'Chemistry', 8),
('8ENG', 'English', 8),
('8HISN', 'Hindi / Sanskrit', 8),
('8KAN', 'Kannada', 8),
('8MTH', 'Maths', 8),
('8PE', 'Physical Education', 8),
('8PHY', 'Physics', 8),
('8SOC', 'Social Science', 8),
('9BIO', 'Biology', 9),
('9CHE', 'Chemistry', 9),
('9ENG', 'English', 9),
('9HISN', 'Hindi / Sanskrit', 9),
('9KAN', 'Kannada', 9),
('9MTH', 'Maths', 9),
('9PE', 'Physical Education', 9),
('9PHY', 'Physics', 9),
('9SOC', 'Social Science', 9);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `full_name` varchar(255) NOT NULL,
  `teacher_id` varchar(50) NOT NULL,
  `qualification` varchar(100) DEFAULT NULL,
  `specialization` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `experience` int(11) DEFAULT NULL,
  `photo` varchar(100) NOT NULL,
  `status` enum('Active','Inactive') DEFAULT 'Active',
  `dob` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`full_name`, `teacher_id`, `qualification`, `specialization`, `email`, `phone`, `experience`, `photo`, `status`, `dob`) VALUES
('Meena Rao', 'TCH101', 'B.Sc, B.Ed', 'Mathematics', 'meena.rao@school.in', '+91 98765 43201', 6, '', 'Active', '1987-03-15'),
('Lakshmi Nair', 'TCH102', 'B.Ed', 'Environmental Studies', 'lakshmi.nair@school.in', '+91 98765 43202', 5, '', 'Active', '1990-07-08'),
('Asha Iyer', 'TCH103', 'M.A, B.Ed', 'English', 'asha.iyer@school.in', '+91 98765 43203', 8, '', 'Active', '1985-11-22'),
('Geetha Patil', 'TCH104', 'M.A Kannada, B.Ed', 'Kannada', 'geetha.patil@school.in', '+91 98765 43204', 7, '', 'Active', '1986-06-30'),
('Ravi Kumar', 'TCH105', 'B.P.Ed', 'Physical Education', 'ravi.kumar@school.in', '+91 98765 43205', 6, '', 'Active', '1988-12-01'),
('Sneha Joshi', 'TCH106', 'BFA, B.Ed', 'Drawing', 'sneha.joshi@school.in', '+91 98765 43206', 4, '', 'Active', '1992-09-17'),
('Kiran Desai', 'TCH107', 'B.Ed', 'Co-Curricular', 'kiran.desai@school.in', '+91 98765 43207', 5, '', 'Active', '1991-04-10'),
('Deepa R', 'TCH108', 'B.A, B.Ed', 'Moral Education', 'deepa.r@school.in', '+91 98765 43208', 3, '', 'Active', '1993-08-25'),
('Suresh Hegde', 'TCH109', 'M.A Hindi, B.Ed', 'Hindi', 'suresh.hegde@school.in', '+91 98765 43209', 9, '', 'Active', '1983-01-05'),
('Rajeshwari Bhat', 'TCH201', 'M.Sc, B.Ed', 'General Science', 'rajeshwari.bhat@school.in', '+91 98765 43210', 10, '', 'Active', '1982-02-11'),
('Manoj Shetty', 'TCH202', 'M.Sc, B.Ed', 'Mathematics', 'manoj.shetty@school.in', '+91 98765 43211', 7, '', 'Active', '1987-05-29'),
('Vidya Rao', 'TCH203', 'M.A, B.Ed', 'English', 'vidya.rao@school.in', '+91 98765 43212', 8, '', 'Active', '1985-10-04'),
('Nandini K', 'TCH204', 'M.A Kannada, B.Ed', 'Kannada', 'nandini.k@school.in', '+91 98765 43213', 6, '', 'Active', '1990-01-19'),
('Kavita Singh', 'TCH205', 'M.A Hindi, B.Ed', 'Hindi', 'kavita.singh@school.in', '+91 98765 43214', 5, '', 'Active', '1991-07-03'),
('Ajay Varma', 'TCH206', 'M.A, B.Ed', 'Social Science', 'ajay.varma@school.in', '+91 98765 43215', 9, '', 'Active', '1984-09-14'),
('Pratibha K', 'TCH207', 'M.A, B.Ed', 'Political Science', 'pratibha.k@school.in', '+91 98765 43216', 4, '', 'Active', '1992-03-21'),
('Yogesh P', 'TCH208', 'B.P.Ed', 'Physical Education', 'yogesh.p@school.in', '+91 98765 43217', 5, '', 'Active', '1989-12-28'),
('Rekha Nayak', 'TCH209', 'B.Ed', 'Co-Curricular', 'rekha.nayak@school.in', '+91 98765 43218', 3, '', 'Active', '1994-06-11'),
('Anita Deshmukh', 'TCH301', 'M.Sc, B.Ed', 'Chemistry', 'anita.d@school.in', '+91 98765 43219', 8, '', 'Active', '1985-07-22'),
('Vivek Nair', 'TCH302', 'M.Sc, B.Ed', 'Physics', 'vivek.nair@school.in', '+91 98765 43220', 10, '', 'Active', '1980-12-10'),
('Pallavi Joshi', 'TCH303', 'M.Sc, B.Ed', 'Biology', 'pallavi.j@school.in', '+91 98765 43221', 7, '', 'Active', '1986-05-01'),
('Arjun S', 'TCH304', 'M.Sc, B.Ed', 'Mathematics', 'arjun.s@school.in', '+91 98765 43222', 9, '', 'Active', '1982-10-12'),
('Neeta Sharma', 'TCH305', 'M.A, B.Ed', 'English', 'neeta.sharma@school.in', '+91 98765 43223', 8, '', 'Active', '1983-03-09'),
('Rakesh Menon', 'TCH306', 'M.A Hindi, B.Ed', 'Hindi', 'rakesh.menon@school.in', '+91 98765 43224', 6, '', 'Active', '1987-06-30'),
('Chaitra K', 'TCH307', 'M.A Kannada, B.Ed', 'Kannada', 'chaitra.k@school.in', '+91 98765 43225', 5, '', 'Active', '1989-11-18'),
('Sanjay Rao', 'TCH308', 'M.A, B.Ed', 'Social Science', 'sanjay.rao@school.in', '+91 98765 43226', 7, '', 'Active', '1984-08-05'),
('Priya Shenoy', 'TCH309', 'B.P.Ed', 'Physical Education', 'priya.shenoy@school.in', '+91 98765 43227', 4, '', 'Active', '1993-02-14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`class_id`),
  ADD UNIQUE KEY `class_name` (`class_name`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subject_id`),
  ADD KEY `standard` (`standard`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`teacher_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `classes`
--
ALTER TABLE `classes`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

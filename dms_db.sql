-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 23, 2023 at 05:43 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dms_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(50) NOT NULL,
  `department_name` varchar(50) NOT NULL,
  `table_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `director`
--

CREATE TABLE `director` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `filename` varchar(50) NOT NULL,
  `folder_path` varchar(50) NOT NULL,
  `time_stamp` datetime(6) NOT NULL,
  `uploaded_by` varchar(50) NOT NULL,
  `department` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `selected_users` varchar(100) NOT NULL,
  `uploader` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `director`
--

INSERT INTO `director` (`id`, `title`, `filename`, `folder_path`, `time_stamp`, `uploaded_by`, `department`, `category`, `status`, `selected_users`, `uploader`) VALUES
(126, 'Lwazie Document', 'Book1 (2).xlsx', '../uploads/director/', '2023-10-23 16:24:00.000000', 'concern@gmail.com', 'director', 'Planning', 'approved', 'blessings@gmail.com', 'concern Matita'),
(127, 'Concern Document', 'Business Plan Draft (3).docx', '../uploads/director/', '2023-10-23 17:27:00.000000', 'mada@gmail.com', 'director', 'Operation', 'pending', 'concern@gmail.com', 'madalitso Mzunga');

-- --------------------------------------------------------

--
-- Table structure for table `finance`
--

CREATE TABLE `finance` (
  `id` int(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `filename` varchar(50) NOT NULL,
  `folder_path` varchar(50) NOT NULL,
  `time_stamp` datetime(6) NOT NULL,
  `uploaded_by` varchar(50) NOT NULL,
  `department` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `selected_users` varchar(100) NOT NULL,
  `uploader` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `metrology`
--

CREATE TABLE `metrology` (
  `id` int(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `filename` varchar(50) NOT NULL,
  `folder_path` varchar(50) NOT NULL,
  `time_stamp` datetime(6) NOT NULL,
  `uploaded_by` varchar(50) NOT NULL,
  `department` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `selected_users` varchar(100) NOT NULL,
  `uploader` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `quality`
--

CREATE TABLE `quality` (
  `id` int(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `filename` varchar(50) NOT NULL,
  `folder_path` varchar(50) NOT NULL,
  `time_stamp` datetime(6) NOT NULL,
  `uploaded_by` varchar(50) NOT NULL,
  `department` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL,
  `category` varchar(100) NOT NULL,
  `selected_users` varchar(100) NOT NULL,
  `uploader` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `standards`
--

CREATE TABLE `standards` (
  `id` int(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `filename` varchar(50) NOT NULL,
  `folder_path` varchar(50) NOT NULL,
  `time_stamp` datetime(6) NOT NULL,
  `uploaded_by` varchar(50) NOT NULL,
  `department` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `selected_users` varchar(100) NOT NULL,
  `uploader` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `testing`
--

CREATE TABLE `testing` (
  `id` int(50) NOT NULL,
  `title` varchar(50) NOT NULL,
  `filename` varchar(50) NOT NULL,
  `folder_path` varchar(50) NOT NULL,
  `time_stamp` datetime(6) NOT NULL,
  `uploaded_by` varchar(50) NOT NULL,
  `department` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `selected_users` varchar(100) NOT NULL,
  `uploader` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `fName` varchar(50) NOT NULL,
  `lName` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `department` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fName`, `lName`, `email`, `password`, `department`, `role`) VALUES
(1, 'Thapson K', 'Nyirenda', 'nyirenda@gmail.com', '1234567', 'finance', 'admin'),
(42, 'Madalitso', 'Mzunga', 'admin@gmail.com', '12345678', 'director', 'admin'),
(45, 'blesings', 'Lwazieh', 'blessings@gmail.com', '123456', 'director', 'user'),
(46, 'madalitso', 'Mzunga', 'mada@gmail.com', '123456', 'director', 'user'),
(47, 'concern', 'Matita', 'concern@gmail.com', '123456', 'director', 'user'),
(48, 'Precious', 'Kamkwete', 'precious@gmail.com', '123456', 'director', 'manager');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `director`
--
ALTER TABLE `director`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `finance`
--
ALTER TABLE `finance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `metrology`
--
ALTER TABLE `metrology`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quality`
--
ALTER TABLE `quality`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `standards`
--
ALTER TABLE `standards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testing`
--
ALTER TABLE `testing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `director`
--
ALTER TABLE `director`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `finance`
--
ALTER TABLE `finance`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `metrology`
--
ALTER TABLE `metrology`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `quality`
--
ALTER TABLE `quality`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `standards`
--
ALTER TABLE `standards`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `testing`
--
ALTER TABLE `testing`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

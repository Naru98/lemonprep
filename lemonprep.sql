-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2021 at 05:35 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lemonprep`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `date`) VALUES
(1, 'admin', '3fc0a7acf087f549ac2b266baf94b8b1', '2021-05-09 19:32:17');

-- --------------------------------------------------------

--
-- Table structure for table `athlete`
--

CREATE TABLE `athlete` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `company_id` int(11) NOT NULL,
  `sdate` date DEFAULT NULL,
  `edate` date DEFAULT NULL,
  `csdate` date DEFAULT NULL,
  `cedate` date DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `isVerifiyed` tinyint(1) NOT NULL DEFAULT 0,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `athlete`
--

INSERT INTO `athlete` (`id`, `name`, `email`, `company_id`, `sdate`, `edate`, `csdate`, `cedate`, `status`, `password`, `image`, `isVerifiyed`, `created`, `updated`) VALUES
(11, 'test', 'test@gmail.com', 4, '2021-05-03', '2021-05-27', NULL, NULL, 0, '3fc0a7acf087f549ac2b266baf94b8b1', NULL, 0, '2021-03-11 17:47:15', '2021-05-26 17:44:16'),
(12, 'Jennifer H', 'athlete@gmail.com', 5, '2021-03-09', '2021-03-25', '2021-05-25', '2021-06-10', 0, '3fc0a7acf087f549ac2b266baf94b8b1', NULL, 0, '2021-03-14 03:06:38', '2021-05-27 03:33:14');

-- --------------------------------------------------------

--
-- Table structure for table `check_in`
--

CREATE TABLE `check_in` (
  `id` int(11) NOT NULL,
  `athlete_id` int(11) NOT NULL,
  `comp_id` int(11) NOT NULL,
  `data` longtext DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `check_in`
--

INSERT INTO `check_in` (`id`, `athlete_id`, `comp_id`, `data`, `created`) VALUES
(2, 12, 5, '{\"Date\":{\"t\":\"Text\",\"v\":\"04\\/14\\/2021\"},\"Picture\":{\"t\":\"Image\",\"v\":\"uploads\\/check_in\\/1618434560-signature.png\"},\"Note\":{\"t\":\"File\",\"v\":\"uploads\\/check_in\\/1618434560-signature1.png\"},\"Weight\":{\"t\":\"Text\",\"v\":\"66\"}}', '2021-04-14 21:09:20');

-- --------------------------------------------------------

--
-- Table structure for table `coach`
--

CREATE TABLE `coach` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `company_id` int(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `isVerifiyed` tinyint(1) NOT NULL DEFAULT 0,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coach`
--

INSERT INTO `coach` (`id`, `name`, `email`, `company_id`, `password`, `image`, `isVerifiyed`, `created`, `updated`) VALUES
(7, 'Abhinav Chavan', 'abhi@gmail.com', 4, '3fc0a7acf087f549ac2b266baf94b8b1', NULL, 0, '2021-03-08 17:34:16', '2021-03-21 01:46:02'),
(8, 'Sahil Keluskar', 'sahil@gmail.com', 4, '3fc0a7acf087f549ac2b266baf94b8b1', NULL, 0, '2021-03-11 17:46:36', '2021-03-21 01:46:08'),
(9, 'kora', 'koraogra@gmail.com', 5, 'ffd108bdde5f9a4bd1d0655c324a2345', NULL, 0, '2021-03-12 10:22:01', '2021-03-21 01:46:13'),
(10, 'coach ', 'coach@gmail.com', 5, '3fc0a7acf087f549ac2b266baf94b8b1', NULL, 1, '2021-03-14 03:05:50', '2021-05-02 06:47:50');

-- --------------------------------------------------------

--
-- Table structure for table `coach_athlete`
--

CREATE TABLE `coach_athlete` (
  `id` int(11) NOT NULL,
  `coach_id` int(11) NOT NULL,
  `athlete_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coach_athlete`
--

INSERT INTO `coach_athlete` (`id`, `coach_id`, `athlete_id`) VALUES
(11, 8, 11),
(14, 10, 12);

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `data` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `name`, `image`, `data`, `created`, `updated`) VALUES
(4, 'SAG', NULL, '[{\"f\": 1, \"l\": \"\", \"m\": 0, \"o\": 1, \"r\": 0, \"t\": \"Date\"}, {\"f\": 2, \"l\": \"\", \"m\": 0, \"o\": 2, \"r\": 0, \"t\": \"Date\"}, {\"f\": 3, \"l\": \"\", \"m\": 0, \"o\": 3, \"r\": 0, \"t\": \"Date\"}, {\"f\": 4, \"l\": \"\", \"m\": 0, \"o\": 4, \"r\": 0, \"t\": \"Image\"}, {\"f\": 5, \"l\": \"\", \"m\": 0, \"o\": 5, \"r\": 0, \"t\": \"Image\"}, {\"f\": 6, \"l\": \"\", \"m\": 0, \"o\": 6, \"r\": 0, \"t\": \"Image\"}, {\"f\": 7, \"l\": \"\", \"m\": 0, \"o\": 7, \"r\": 0, \"t\": \"File\"}, {\"f\": 8, \"l\": \"\", \"m\": 0, \"o\": 8, \"r\": 0, \"t\": \"Text\"}, {\"f\": 9, \"l\": \"\", \"m\": 0, \"o\": 9, \"r\": 0, \"t\": \"Text\"}, {\"f\": 10, \"l\": \"\", \"m\": 0, \"o\": 10, \"r\": 0, \"t\": \"Text\"}, {\"f\": 11, \"l\": \"\", \"m\": 0, \"o\": 11, \"r\": 0, \"t\": \"Text\"}, {\"f\": 12, \"l\": \"\", \"m\": 0, \"o\": 12, \"r\": 0, \"t\": \"Text\"}, {\"f\": 13, \"l\": \"\", \"m\": 0, \"o\": 13, \"r\": 0, \"t\": \"Text\"}, {\"f\": 14, \"l\": \"\", \"m\": 0, \"o\": 14, \"r\": 0, \"t\": \"Text\"}, {\"f\": 15, \"l\": \"\", \"m\": 0, \"o\": 15, \"r\": 0, \"t\": \"Text\"}, {\"f\": 16, \"l\": \"\", \"m\": 0, \"o\": 16, \"r\": 0, \"t\": \"Text\"}, {\"f\": 17, \"l\": \"\", \"m\": 0, \"o\": 17, \"r\": 0, \"t\": \"Text\"}, {\"f\": 18, \"l\": \"\", \"m\": 0, \"o\": 18, \"r\": 0, \"t\": \"Text\"}, {\"f\": 19, \"l\": \"\", \"m\": 0, \"o\": 19, \"r\": 0, \"t\": \"Text\"}, {\"f\": 20, \"l\": \"\", \"m\": 0, \"o\": 20, \"r\": 0, \"t\": \"Text\"}, {\"f\": 21, \"l\": \"\", \"m\": 0, \"o\": 21, \"r\": 0, \"t\": \"Text\"}]', '2021-02-27 20:59:39', '2021-03-21 01:45:00'),
(5, 'Test', NULL, '[{\"f\":1,\"t\":\"Date\",\"o\":\"1\",\"r\":1,\"m\":0,\"l\":\"Date\"},{\"f\":2,\"t\":\"Date\",\"o\":\"2\",\"r\":0,\"m\":0,\"l\":\"\"},{\"f\":3,\"t\":\"Date\",\"o\":\"3\",\"r\":0,\"m\":0,\"l\":\"\"},{\"f\":4,\"t\":\"Image\",\"o\":\"4\",\"r\":1,\"m\":1,\"l\":\"Picture\"},{\"f\":5,\"t\":\"Image\",\"o\":\"5\",\"r\":0,\"m\":0,\"l\":\"\"},{\"f\":6,\"t\":\"Image\",\"o\":\"6\",\"r\":0,\"m\":0,\"l\":\"\"},{\"f\":7,\"t\":\"File\",\"o\":\"7\",\"r\":1,\"m\":0,\"l\":\"Note\"},{\"f\":8,\"t\":\"Text\",\"o\":\"8\",\"r\":1,\"m\":1,\"l\":\"Weight\"},{\"f\":9,\"t\":\"Text\",\"o\":\"9\",\"r\":0,\"m\":0,\"l\":\"\"},{\"f\":10,\"t\":\"Text\",\"o\":\"10\",\"r\":0,\"m\":0,\"l\":\"\"},{\"f\":11,\"t\":\"Text\",\"o\":\"11\",\"r\":0,\"m\":0,\"l\":\"\"},{\"f\":12,\"t\":\"Text\",\"o\":\"12\",\"r\":0,\"m\":0,\"l\":\"\"},{\"f\":13,\"t\":\"Text\",\"o\":\"13\",\"r\":0,\"m\":0,\"l\":\"\"},{\"f\":14,\"t\":\"Text\",\"o\":\"14\",\"r\":0,\"m\":0,\"l\":\"\"},{\"f\":15,\"t\":\"Text\",\"o\":\"15\",\"r\":0,\"m\":0,\"l\":\"\"},{\"f\":16,\"t\":\"Text\",\"o\":\"16\",\"r\":0,\"m\":0,\"l\":\"\"},{\"f\":17,\"t\":\"Text\",\"o\":\"17\",\"r\":0,\"m\":0,\"l\":\"\"},{\"f\":18,\"t\":\"Text\",\"o\":\"18\",\"r\":0,\"m\":0,\"l\":\"\"},{\"f\":19,\"t\":\"Text\",\"o\":\"19\",\"r\":0,\"m\":0,\"l\":\"\"},{\"f\":20,\"t\":\"Text\",\"o\":\"20\",\"r\":0,\"m\":0,\"l\":\"\"},{\"f\":21,\"t\":\"Text\",\"o\":\"21\",\"r\":0,\"m\":0,\"l\":\"\"}]', '2021-02-28 04:13:53', '2021-05-02 04:19:45'),
(13, 'new', NULL, '[{\"f\":1,\"t\":\"Date\",\"o\":1,\"r\":0,\"m\":0,\"l\":\"\"},{\"f\":2,\"t\":\"Date\",\"o\":2,\"r\":0,\"m\":0,\"l\":\"\"},{\"f\":3,\"t\":\"Date\",\"o\":3,\"r\":0,\"m\":0,\"l\":\"\"},{\"f\":4,\"t\":\"Image\",\"o\":4,\"r\":0,\"m\":0,\"l\":\"\"},{\"f\":5,\"t\":\"Image\",\"o\":5,\"r\":0,\"m\":0,\"l\":\"\"},{\"f\":6,\"t\":\"Image\",\"o\":6,\"r\":0,\"m\":0,\"l\":\"\"},{\"f\":7,\"t\":\"File\",\"o\":7,\"r\":0,\"m\":0,\"l\":\"\"},{\"f\":8,\"t\":\"Text\",\"o\":8,\"r\":0,\"m\":0,\"l\":\"\"},{\"f\":9,\"t\":\"Text\",\"o\":9,\"r\":0,\"m\":0,\"l\":\"\"},{\"f\":10,\"t\":\"Text\",\"o\":10,\"r\":0,\"m\":0,\"l\":\"\"},{\"f\":11,\"t\":\"Text\",\"o\":11,\"r\":0,\"m\":0,\"l\":\"\"},{\"f\":12,\"t\":\"Text\",\"o\":12,\"r\":0,\"m\":0,\"l\":\"\"},{\"f\":13,\"t\":\"Text\",\"o\":13,\"r\":0,\"m\":0,\"l\":\"\"},{\"f\":14,\"t\":\"Text\",\"o\":14,\"r\":0,\"m\":0,\"l\":\"\"},{\"f\":15,\"t\":\"Text\",\"o\":15,\"r\":0,\"m\":0,\"l\":\"\"},{\"f\":16,\"t\":\"Text\",\"o\":16,\"r\":0,\"m\":0,\"l\":\"\"},{\"f\":17,\"t\":\"Text\",\"o\":17,\"r\":0,\"m\":0,\"l\":\"\"},{\"f\":18,\"t\":\"Text\",\"o\":18,\"r\":0,\"m\":0,\"l\":\"\"},{\"f\":19,\"t\":\"Text\",\"o\":19,\"r\":0,\"m\":0,\"l\":\"\"},{\"f\":20,\"t\":\"Text\",\"o\":20,\"r\":0,\"m\":0,\"l\":\"\"},{\"f\":21,\"t\":\"Text\",\"o\":21,\"r\":0,\"m\":0,\"l\":\"\"}]', '2021-05-17 16:13:19', '2021-05-17 16:13:19');

-- --------------------------------------------------------

--
-- Table structure for table `diet`
--

CREATE TABLE `diet` (
  `id` int(11) NOT NULL,
  `sdate` date NOT NULL,
  `edate` date NOT NULL,
  `data` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL,
  `per` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `coach_id` int(11) NOT NULL,
  `athlete_id` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `diet`
--

INSERT INTO `diet` (`id`, `sdate`, `edate`, `data`, `per`, `company_id`, `coach_id`, `athlete_id`, `created`, `updated`) VALUES
(1, '2021-03-05', '2021-03-06', '', 0, 4, 7, 11, '2021-03-14 02:51:06', '2021-03-21 01:42:36'),
(3, '2021-05-03', '2021-05-03', 'grdsgrdsfg', 0, 5, 0, 12, '2021-05-02 14:18:26', '2021-05-02 14:18:35');

-- --------------------------------------------------------

--
-- Table structure for table `forms`
--

CREATE TABLE `forms` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `file` longtext NOT NULL,
  `type` int(11) NOT NULL,
  `comp_id` int(11) NOT NULL,
  `coach_id` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updaed` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `forms`
--

INSERT INTO `forms` (`id`, `name`, `file`, `type`, `comp_id`, `coach_id`, `created`, `updaed`) VALUES
(3, 'Registration', 'uploads/forms/1618434398-dummy.pdf', 0, 5, 10, '2021-04-14 21:06:39', '2021-05-02 04:41:41');

-- --------------------------------------------------------

--
-- Table structure for table `forms_data`
--

CREATE TABLE `forms_data` (
  `id` int(11) NOT NULL,
  `forms_id` int(11) NOT NULL,
  `athlete_id` int(11) NOT NULL,
  `data` longtext NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `forms_data`
--

INSERT INTO `forms_data` (`id`, `forms_id`, `athlete_id`, `data`, `created`) VALUES
(5, 3, 12, 'data:image/png;base64,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', '2021-04-14 21:08:40');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `key` varchar(255) NOT NULL,
  `value` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `key`, `value`) VALUES
(1, 'logo', 'Logo  with round borders ', '0');

-- --------------------------------------------------------

--
-- Table structure for table `shows`
--

CREATE TABLE `shows` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `company_id` int(11) NOT NULL,
  `coach_id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shows`
--

INSERT INTO `shows` (`id`, `title`, `date`, `company_id`, `coach_id`, `type`, `created`, `updated`) VALUES
(1, 'Powerlifting', '2021-03-17', 5, 10, 0, '2021-03-21 03:44:21', '2021-04-14 13:01:36'),
(4, 'test', '2021-05-24', 5, 0, 1, '2021-05-02 01:29:41', '2021-05-02 01:29:41');

-- --------------------------------------------------------

--
-- Table structure for table `shows_athlete`
--

CREATE TABLE `shows_athlete` (
  `id` int(11) NOT NULL,
  `athlete_id` int(11) NOT NULL,
  `shows_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `shows_athlete`
--

INSERT INTO `shows_athlete` (`id`, `athlete_id`, `shows_id`) VALUES
(2, 12, 1),
(4, 12, 3),
(5, 12, 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `company_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `isVerifiyed` tinyint(1) NOT NULL DEFAULT 0,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `company_id`, `email`, `password`, `isVerifiyed`, `created`, `updated`) VALUES
(3, NULL, 4, 'sag@gmail.com', '3fc0a7acf087f549ac2b266baf94b8b1', 0, '2021-02-27 20:59:39', '2021-02-27 20:59:39'),
(4, NULL, 5, 'Test@gmail.com', '3fc0a7acf087f549ac2b266baf94b8b1', 1, '2021-02-28 04:13:54', '2021-05-17 16:46:29'),
(9, NULL, 13, 'rawoolnaru98@gmail.com', 'bfd59291e825b5f2bbf1eb76569f8fe7', 0, '2021-05-17 16:13:19', '2021-05-17 16:33:22');

-- --------------------------------------------------------

--
-- Table structure for table `workouts`
--

CREATE TABLE `workouts` (
  `id` int(11) NOT NULL,
  `sdate` date DEFAULT NULL,
  `edate` date DEFAULT NULL,
  `data` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `per` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `coach_id` int(11) NOT NULL,
  `athlete_id` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `workouts`
--

INSERT INTO `workouts` (`id`, `sdate`, `edate`, `data`, `per`, `company_id`, `coach_id`, `athlete_id`, `created`, `updated`) VALUES
(13, '2021-03-09', '2021-03-23', 'test', 0, 5, 10, 12, '2021-03-16 01:40:42', '2021-05-02 14:09:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `athlete`
--
ALTER TABLE `athlete`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `check_in`
--
ALTER TABLE `check_in`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coach`
--
ALTER TABLE `coach`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coach_athlete`
--
ALTER TABLE `coach_athlete`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `diet`
--
ALTER TABLE `diet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forms`
--
ALTER TABLE `forms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forms_data`
--
ALTER TABLE `forms_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shows`
--
ALTER TABLE `shows`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shows_athlete`
--
ALTER TABLE `shows_athlete`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `workouts`
--
ALTER TABLE `workouts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `athlete`
--
ALTER TABLE `athlete`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `check_in`
--
ALTER TABLE `check_in`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `coach`
--
ALTER TABLE `coach`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `coach_athlete`
--
ALTER TABLE `coach_athlete`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `diet`
--
ALTER TABLE `diet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `forms`
--
ALTER TABLE `forms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `forms_data`
--
ALTER TABLE `forms_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shows`
--
ALTER TABLE `shows`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `shows_athlete`
--
ALTER TABLE `shows_athlete`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `workouts`
--
ALTER TABLE `workouts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

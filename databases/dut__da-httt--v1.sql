-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 20, 2018 at 10:49 PM
-- Server version: 5.7.21-0ubuntu0.16.04.1
-- PHP Version: 7.0.28-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dut_da-httt`
--

-- --------------------------------------------------------

--
-- Table structure for table `area`
--

CREATE TABLE `area` (
  `id_area` int(10) NOT NULL,
  `name_area` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `total_slot` int(10) NOT NULL,
  `empty_slot` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `id_client` int(10) NOT NULL,
  `fullname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `date_of_birth` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `identity_card` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `license_plate` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) NOT NULL,
  `registed_id` int(10) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `historymonthticket`
--

CREATE TABLE `historymonthticket` (
  `id_history_month_ticket` int(10) NOT NULL,
  `client_id` int(10) NOT NULL,
  `begin_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `finish_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `picture_license_plate` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `historyregularticket`
--

CREATE TABLE `historyregularticket` (
  `id_history_regular_ticket` int(10) NOT NULL,
  `regular_ticket_id` int(10) NOT NULL,
  `card_code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `begin_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `finish_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `picture_license_plate` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id_location` int(10) NOT NULL,
  `name_location` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `area_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `managemonthticket`
--

CREATE TABLE `managemonthticket` (
  `id_manage_month_ticket` int(10) NOT NULL,
  `client_id` int(10) NOT NULL,
  `month_revenvue_id` int(10) NOT NULL,
  `date_finish` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `monthticket`
--

CREATE TABLE `monthticket` (
  `id_month_ticket` int(10) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `price` double NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `month_revenue`
--

CREATE TABLE `month_revenue` (
  `id_month_revenue` int(10) NOT NULL,
  `client_id` int(10) NOT NULL,
  `month_ticket_id` int(10) NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `registedcode`
--

CREATE TABLE `registedcode` (
  `id_registed` int(10) NOT NULL,
  `card_code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `month_ticket_id` int(10) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `regularticket`
--

CREATE TABLE `regularticket` (
  `Id_regular_ticket` int(10) NOT NULL,
  `price` double NOT NULL,
  `date_create` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id_role` int(10) NOT NULL,
  `name_role` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shift`
--

CREATE TABLE `shift` (
  `id_shift` int(10) NOT NULL,
  `name_shift` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id_user` int(10) NOT NULL,
  `user_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `salt` char(30) COLLATE utf8_unicode_ci NOT NULL,
  `full_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `gender` tinyint(1) NOT NULL,
  `date_of_birth` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `identity_card` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `date_begin` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `shift_id` int(10) NOT NULL,
  `role_id` int(10) NOT NULL,
  `active` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id_user`, `user_name`, `password`, `salt`, `full_name`, `phone`, `gender`, `date_of_birth`, `identity_card`, `date_begin`, `email`, `address`, `shift_id`, `role_id`, `active`) VALUES
(1, 'admin', '202cb962ac59075b964b07152d234b70', 'dahtt', 'Admin', '0123456789', 1, '2018-04-16 14:36:58', '123456789', '2018-04-16 14:36:58', 'admin@gmail.com', 'Admin', 1, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `area`
--
ALTER TABLE `area`
  ADD PRIMARY KEY (`id_area`);

--
-- Indexes for table `historymonthticket`
--
ALTER TABLE `historymonthticket`
  ADD PRIMARY KEY (`id_history_month_ticket`);

--
-- Indexes for table `historyregularticket`
--
ALTER TABLE `historyregularticket`
  ADD PRIMARY KEY (`id_history_regular_ticket`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id_location`);

--
-- Indexes for table `managemonthticket`
--
ALTER TABLE `managemonthticket`
  ADD PRIMARY KEY (`id_manage_month_ticket`);

--
-- Indexes for table `monthticket`
--
ALTER TABLE `monthticket`
  ADD PRIMARY KEY (`id_month_ticket`);

--
-- Indexes for table `month_revenue`
--
ALTER TABLE `month_revenue`
  ADD PRIMARY KEY (`id_month_revenue`);

--
-- Indexes for table `regularticket`
--
ALTER TABLE `regularticket`
  ADD PRIMARY KEY (`Id_regular_ticket`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id_role`);

--
-- Indexes for table `shift`
--
ALTER TABLE `shift`
  ADD PRIMARY KEY (`id_shift`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `area`
--
ALTER TABLE `area`
  MODIFY `id_area` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `historymonthticket`
--
ALTER TABLE `historymonthticket`
  MODIFY `id_history_month_ticket` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id_location` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `managemonthticket`
--
ALTER TABLE `managemonthticket`
  MODIFY `id_manage_month_ticket` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `monthticket`
--
ALTER TABLE `monthticket`
  MODIFY `id_month_ticket` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `month_revenue`
--
ALTER TABLE `month_revenue`
  MODIFY `id_month_revenue` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `regularticket`
--
ALTER TABLE `regularticket`
  MODIFY `Id_regular_ticket` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id_role` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `shift`
--
ALTER TABLE `shift`
  MODIFY `id_shift` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id_user` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 18, 2022 at 08:16 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id19436597_rgukt_att_sys_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `links`
--

CREATE TABLE `links` (
  `course` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `sem` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `section` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `api_link` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `norm_link` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `links`
--

INSERT INTO `links` (`course`, `sem`, `section`, `api_link`, `norm_link`) VALUES
('puc-2', 'sem-2', 'B3', 'https://api.steinhq.com/v1/storages/62f0e5a6bca21f053ea776ec/', 'https://docs.google.com/spreadsheets/d/1-hCRFfJ_x0xmg1Yt61zFuJiyG9YsRdvRRdAaX08EHww'),
('puc-2', 'sem-2', 'B1', 'https://api.steinhq.com/v1/storages/62f0e81ebca21f053ea77753/', 'https://docs.google.com/spreadsheets/d/150ovWDMQ3g8W540jc6bRaUDYulQ489je8Sj31t37wEQ'),
('puc-2', 'sem-2', 'B2', 'https://api.steinhq.com/v1/storages/62f0e8bcbca21f053ea7776e/', 'https://docs.google.com/spreadsheets/d/1m2wWHENFQw6rS0gj0d-NX0llcKwLTshSH0oCq-7h2mo'),
('puc-2', 'sem-2', 'B4', 'https://api.steinhq.com/v1/storages/62f0e92b4906bb0537576a64/', 'https://docs.google.com/spreadsheets/d/1NNPp2wT4bVvmgPyneBDycOpumSiDa6RwxeurWgccA-c'),
('puc-2', 'sem-2', 'B5', 'https://api.steinhq.com/v1/storages/62f0e9a34906bb0537576a6f/', 'https://docs.google.com/spreadsheets/d/18JbYfsldrrQ9HeB3dyotY73mJGh--0zmHXJ4qcy3KxE'),
('puc-2', 'sem-2', 'B6', 'https://api.steinhq.com/v1/storages/62f332e6bca21f053ea7b88d/', 'https://docs.google.com/spreadsheets/d/1BbiKPyGZ625s7u4A5XxvfveeN0-4lBvSc6SVKhtzw4M'),
('puc-2', 'sem-2', 'B7', 'https://api.steinhq.com/v1/storages/62f333824906bb053757ab26/', 'https://docs.google.com/spreadsheets/d/1Fql39ZjrZzjCMGEJm1FLY-sdQOxBJc2FQepFtrXuxBo'),
('puc-2', 'sem-2', 'B8', 'https://api.steinhq.com/v1/storages/62f334434906bb053757ab2c/', 'https://docs.google.com/spreadsheets/d/1W_eyZ36KTTqcD-Dyaj7R9Ibl9vvq5dSAFX28bXt3A8A'),
('puc-2', 'sem-2', 'B9', 'https://api.steinhq.com/v1/storages/62f3348fbca21f053ea7b8b8/', 'https://docs.google.com/spreadsheets/d/17yrSMfyoZfZme4-3l-WVo8NwW8jb5tkgi3eSZ23FfD8');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `s_no` int(11) NOT NULL,
  `username` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`s_no`, `username`, `password`, `name`, `subject`) VALUES
(1, 'delhi', 'secret', 'DILEEPKUMAR ADARI', 'INFORMATION TECHNOLOGY');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `links`
--
ALTER TABLE `links`
  ADD UNIQUE KEY `api_link` (`api_link`),
  ADD UNIQUE KEY `norm_link` (`norm_link`),
  ADD KEY `course` (`course`),
  ADD KEY `sem` (`sem`),
  ADD KEY `section` (`section`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`s_no`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `subject` (`subject`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `s_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

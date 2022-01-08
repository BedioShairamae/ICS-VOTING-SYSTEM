-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 26, 2021 at 07:56 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `iscvs_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `type` varchar(40) NOT NULL,
  `user` varchar(40) NOT NULL,
  `pass` varchar(100) NOT NULL,
  `photo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `name`, `type`, `user`, `pass`, `photo`) VALUES
(1, 'PACBOG', 'main', 'admin', 'password', 'Photo_download.png');

-- --------------------------------------------------------

--
-- Table structure for table `adviser`
--

CREATE TABLE `adviser` (
  `adv_id` int(11) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `middlename` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `photo` text NOT NULL,
  `scope_section` int(11) NOT NULL,
  `scope_course` int(11) NOT NULL,
  `password` varchar(50) NOT NULL,
  `date_registered` datetime DEFAULT NULL,
  `changepass` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `adviser`
--

INSERT INTO `adviser` (`adv_id`, `lastname`, `firstname`, `middlename`, `email`, `photo`, `scope_section`, `scope_course`, `password`, `date_registered`, `changepass`, `status`) VALUES
(19, 'adviser', 'a-only', '', 'Adviser-A@wmsu.edu.ph', '', 7, 1, 'password', '2021-09-23 11:42:50', 1, 1),
(20, 'adviser', 'B-only', '', 'Adviser-B@wmsu.edu.ph', '', 11, 1, 'password', '2021-09-23 11:43:07', 0, 0),
(21, 'adviser', 'C-only', '', 'Adviser-C@wmsu.edu.ph', '', 13, 1, 'password', '2021-09-23 11:43:20', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `candidate`
--

CREATE TABLE `candidate` (
  `cid` int(11) NOT NULL,
  `sv_id` varchar(100) NOT NULL,
  `votes` int(11) DEFAULT NULL,
  `voters` mediumtext DEFAULT NULL,
  `pos_id` int(11) NOT NULL,
  `advocacy` varchar(5000) DEFAULT NULL,
  `date_registered` datetime NOT NULL,
  `election_id` int(11) NOT NULL,
  `partylist` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `courseid` int(11) NOT NULL,
  `course` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`courseid`, `course`) VALUES
(1, 'BSIT'),
(2, 'BSCS'),
(3, 'BSPUTI');

-- --------------------------------------------------------

--
-- Table structure for table `election_sched`
--

CREATE TABLE `election_sched` (
  `election_id` int(11) NOT NULL,
  `semester` varchar(40) NOT NULL,
  `year` year(4) NOT NULL,
  `title` varchar(50) NOT NULL,
  `eventstart` datetime DEFAULT NULL,
  `eventend` datetime DEFAULT NULL,
  `date-modified` datetime NOT NULL,
  `voterlogin` varchar(40) NOT NULL,
  `status` varchar(40) NOT NULL,
  `result` int(11) NOT NULL,
  `notification` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `election_sched`
--

INSERT INTO `election_sched` (`election_id`, `semester`, `year`, `title`, `eventstart`, `eventend`, `date-modified`, `voterlogin`, `status`, `result`, `notification`) VALUES
(1, '1', 2021, 'ICS Local election', NULL, NULL, '2021-06-19 20:25:51', 'enabled', 'inactive', 0, 0),
(7, '1', 2021, '(Re-Elect) ICS ELECTION                 \r\n        ', NULL, NULL, '2021-09-19 23:53:32', 'enabled', 'active', 0, 0),
(15, '1', 2032, 'test                 \r\n               ', NULL, NULL, '2021-09-26 13:28:22', 'enabled', 'inactive', 0, 0),
(16, '1', 2027, 'sadasd                 \r\n               ', NULL, NULL, '2021-09-26 13:31:39', 'enabled', 'inactive', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `partylist`
--

CREATE TABLE `partylist` (
  `party_id` int(11) NOT NULL,
  `partylist` varchar(100) NOT NULL,
  `date_created` datetime NOT NULL,
  `election_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `partylist`
--

INSERT INTO `partylist` (`party_id`, `partylist`, `date_created`, `election_id`) VALUES
(32, 'Sanguniang kabataan', '2021-09-19 22:05:00', 1),
(33, 'isulong ang kagaguhan.inc', '2021-09-19 22:05:20', 1),
(34, 'adasd', '2021-09-19 22:05:26', 1);

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `pos_id` int(11) NOT NULL,
  `pos_name` varchar(50) NOT NULL,
  `pos_noofwinner` int(11) NOT NULL,
  `pos_maxcandidate` int(11) NOT NULL,
  `maxvote` int(11) NOT NULL,
  `date_registered` datetime NOT NULL,
  `election_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`pos_id`, `pos_name`, `pos_noofwinner`, `pos_maxcandidate`, `maxvote`, `date_registered`, `election_id`) VALUES
(28, 'Mayor', 1, 3, 1, '2021-09-19 22:05:06', 1),
(29, 'Vice Mayor', 1, 2, 1, '2021-09-19 22:05:11', 1),
(30, 'Auditor', 1, 3, 1, '2021-09-19 22:10:40', 1),
(31, 'CS Councilor', 1, 3, 1, '2021-09-19 22:10:45', 1);

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `sec_id` int(11) NOT NULL,
  `section` varchar(50) NOT NULL,
  `date_registered` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`sec_id`, `section`, `date_registered`) VALUES
(7, 'A', '2021-09-21 17:49:43'),
(11, 'B', '2021-09-21 17:50:51'),
(13, 'C', '2021-09-21 17:51:03');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `s_id` int(11) NOT NULL,
  `sv_id` varchar(100) NOT NULL,
  `name` varchar(40) NOT NULL,
  `surname` varchar(40) NOT NULL,
  `middle_name` varchar(40) NOT NULL,
  `gender` varchar(40) NOT NULL,
  `course` varchar(40) NOT NULL,
  `year` int(11) NOT NULL,
  `section` int(11) NOT NULL,
  `date_registered` datetime NOT NULL,
  `logintype` varchar(40) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) DEFAULT NULL,
  `photo` varchar(100) DEFAULT NULL,
  `election_id` int(11) NOT NULL,
  `voted` int(50) NOT NULL,
  `con` int(11) NOT NULL,
  `isverified` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`s_id`, `sv_id`, `name`, `surname`, `middle_name`, `gender`, `course`, `year`, `section`, `date_registered`, `logintype`, `email`, `password`, `photo`, `election_id`, `voted`, `con`, `isverified`) VALUES
(14, 'bg201802799', 'Robert', 'Anulhasim', 'Baguisan', 'male', '1', 4, 11, '2021-09-15 10:59:47', 'personal', 'bg201802799@wmsu.edu.ph', 'Gel09068381147', NULL, 1, 0, 0, 1),
(17, 'bg201803286', 'Jiezel', 'Camlian', 'Alforque', 'female', '1', 4, 13, '2021-09-15 13:56:39', 'personal', 'bg201803286@wmsu.edu.ph', 'Camlian14_WMSU', NULL, 1, 0, 0, 1),
(18, 'sm201600099', 'Nathalie Joyce', 'Frones', 'Campos', 'female', '1', 4, 7, '2021-09-15 14:56:49', 'personal', 'sm201600099@wmsu.edu.ph', 'Biby_468', NULL, 1, 0, 0, 0),
(19, 'bg201803173', 'Jessiekelly', 'Eguac', 'Bazan', 'male', '1', 4, 11, '2021-09-15 15:09:06', 'personal', 'bg201803173@wmsu.edu.ph', 'Runningoutoftim3', NULL, 1, 0, 0, 1),
(20, 'GT201902479', 'JAIVE', 'CORPUZ', 'OMAMALIN', 'male', '1', 3, 13, '2021-09-16 10:05:26', 'personal', 'GT201902479@wmsu.edu.ph', '_Jaivecorpuz02', NULL, 1, 0, 0, 0),
(21, 'marjorierojas', 'Marjorie', 'Rojas', ' ', 'female', '1', 4, 7, '2021-09-16 20:54:36', 'personal', 'marjorierojas@wmsu.edu.ph', 'marjoriE77', NULL, 1, 0, 0, 0),
(22, 'bg201802115', 'Ansar', 'Osamad', 'Masuhol', 'male', '1', 4, 11, '2021-09-16 21:24:33', 'personal', 'bg201802115@wmsu.edu.ph', 'uo86iomf', NULL, 1, 0, 0, 1),
(33, 'sm201600747', 'reenjay', 'caimor', 'magaan', 'male', '1', 1, 7, '2021-09-21 21:21:22', 'personal', 'sm201600747@wmsu.edu.ph', 'bahnijn0', NULL, 1, 1, 0, 0),
(194, 'bg201802799', 'Robert', 'Anulhasim', 'Baguisan', 'male', '1', 4, 11, '2021-09-15 10:59:47', 'personal', 'bg201802799@wmsu.edu.ph', 'Gel09068381147', '', 7, 0, 0, 1),
(195, 'bg201803286', 'Jiezel', 'Camlian', 'Alforque', 'female', '1', 4, 13, '2021-09-15 13:56:39', 'personal', 'bg201803286@wmsu.edu.ph', 'Camlian14_WMSU', '', 7, 0, 0, 0),
(196, 'sm201600099', 'Nathalie Joyce', 'Frones', 'Campos', 'female', '1', 4, 7, '2021-09-15 14:56:49', 'personal', 'sm201600099@wmsu.edu.ph', 'Biby_468', '', 7, 0, 0, 0),
(197, 'bg201803173', 'Jessiekelly', 'Eguac', 'Bazan', 'male', '1', 4, 11, '2021-09-15 15:09:06', 'personal', 'bg201803173@wmsu.edu.ph', 'Runningoutoftim3', '', 7, 0, 0, 0),
(198, 'GT201902479', 'JAIVE', 'CORPUZ', 'OMAMALIN', 'male', '1', 3, 13, '2021-09-16 10:05:26', 'personal', 'GT201902479@wmsu.edu.ph', '_Jaivecorpuz02', '', 7, 0, 0, 0),
(199, 'marjorierojas', 'Marjorie', 'Rojas', ' ', 'female', '1', 4, 7, '2021-09-16 20:54:36', 'personal', 'marjorierojas@wmsu.edu.ph', 'marjoriE77', '', 7, 0, 0, 0),
(200, 'bg201802115', 'Ansar', 'Osamad', 'Masuhol', 'male', '1', 4, 11, '2021-09-16 21:24:33', 'personal', 'bg201802115@wmsu.edu.ph', 'uo86iomf', '', 7, 0, 0, 0),
(201, 'sm201600747', 'reenjay', 'caimor', 'magaan', 'male', '1', 1, 7, '2021-09-21 21:21:22', 'personal', 'sm201600747@wmsu.edu.ph', 'bahnijn0', '', 7, 0, 0, 0),
(205, 'bg201802799', 'Robert', 'Anulhasim', 'Baguisan', 'male', '1', 4, 11, '2021-09-15 10:59:47', 'personal', 'bg201802799@wmsu.edu.ph', 'Gel09068381147', '', 15, 0, 0, 0),
(206, 'bg201803286', 'Jiezel', 'Camlian', 'Alforque', 'female', '1', 4, 13, '2021-09-15 13:56:39', 'personal', 'bg201803286@wmsu.edu.ph', 'Camlian14_WMSU', '', 15, 0, 0, 0),
(207, 'sm201600099', 'Nathalie Joyce', 'Frones', 'Campos', 'female', '1', 4, 7, '2021-09-15 14:56:49', 'personal', 'sm201600099@wmsu.edu.ph', 'Biby_468', '', 15, 0, 0, 0),
(208, 'bg201803173', 'Jessiekelly', 'Eguac', 'Bazan', 'male', '1', 4, 11, '2021-09-15 15:09:06', 'personal', 'bg201803173@wmsu.edu.ph', 'Runningoutoftim3', '', 15, 0, 0, 0),
(209, 'GT201902479', 'JAIVE', 'CORPUZ', 'OMAMALIN', 'male', '1', 3, 13, '2021-09-16 10:05:26', 'personal', 'GT201902479@wmsu.edu.ph', '_Jaivecorpuz02', '', 15, 0, 0, 0),
(210, 'marjorierojas', 'Marjorie', 'Rojas', ' ', 'female', '1', 4, 7, '2021-09-16 20:54:36', 'personal', 'marjorierojas@wmsu.edu.ph', 'marjoriE77', '', 15, 0, 0, 0),
(211, 'bg201802115', 'Ansar', 'Osamad', 'Masuhol', 'male', '1', 4, 11, '2021-09-16 21:24:33', 'personal', 'bg201802115@wmsu.edu.ph', 'uo86iomf', '', 15, 0, 0, 0),
(212, 'sm201600747', 'reenjay', 'caimor', 'magaan', 'male', '1', 1, 7, '2021-09-21 21:21:22', 'personal', 'sm201600747@wmsu.edu.ph', 'bahnijn0', '', 15, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `temp`
--

CREATE TABLE `temp` (
  `tempid` int(11) NOT NULL,
  `ipaddress` varchar(500) NOT NULL,
  `code` varchar(100) NOT NULL,
  `date-visited` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `temp`
--

INSERT INTO `temp` (`tempid`, `ipaddress`, `code`, `date-visited`) VALUES
(80, '::1', 'op4zo6os', '2021-09-19 12:30:40');

-- --------------------------------------------------------

--
-- Table structure for table `temp_votes`
--

CREATE TABLE `temp_votes` (
  `tmpvote_id` int(11) NOT NULL,
  `sv_id` int(11) NOT NULL,
  `posid` int(11) NOT NULL,
  `election_id` int(11) NOT NULL,
  `vote` int(11) DEFAULT NULL,
  `voters` mediumtext DEFAULT NULL,
  `advocacy` longtext NOT NULL,
  `partylist` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `year`
--

CREATE TABLE `year` (
  `yearid` int(11) NOT NULL,
  `year` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `year`
--

INSERT INTO `year` (`yearid`, `year`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `adviser`
--
ALTER TABLE `adviser`
  ADD PRIMARY KEY (`adv_id`);

--
-- Indexes for table `candidate`
--
ALTER TABLE `candidate`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`courseid`);

--
-- Indexes for table `election_sched`
--
ALTER TABLE `election_sched`
  ADD PRIMARY KEY (`election_id`);

--
-- Indexes for table `partylist`
--
ALTER TABLE `partylist`
  ADD PRIMARY KEY (`party_id`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`pos_id`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`sec_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `temp`
--
ALTER TABLE `temp`
  ADD PRIMARY KEY (`tempid`);

--
-- Indexes for table `temp_votes`
--
ALTER TABLE `temp_votes`
  ADD PRIMARY KEY (`tmpvote_id`);

--
-- Indexes for table `year`
--
ALTER TABLE `year`
  ADD PRIMARY KEY (`yearid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `adviser`
--
ALTER TABLE `adviser`
  MODIFY `adv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `candidate`
--
ALTER TABLE `candidate`
  MODIFY `cid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `courseid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `election_sched`
--
ALTER TABLE `election_sched`
  MODIFY `election_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `partylist`
--
ALTER TABLE `partylist`
  MODIFY `party_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `pos_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `sec_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=213;

--
-- AUTO_INCREMENT for table `temp`
--
ALTER TABLE `temp`
  MODIFY `tempid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `temp_votes`
--
ALTER TABLE `temp_votes`
  MODIFY `tmpvote_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `year`
--
ALTER TABLE `year`
  MODIFY `yearid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

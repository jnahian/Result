-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2015 at 05:37 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `jnahian_result`
--

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE IF NOT EXISTS `class` (
`id` int(11) NOT NULL,
  `class` varchar(100) NOT NULL,
  `c_sec1` varchar(100) NOT NULL,
  `c_sec2` varchar(100) NOT NULL,
  `c_sec3` varchar(100) NOT NULL,
  `c_subjects` varchar(1000) NOT NULL,
  `c_extra` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `class`, `c_sec1`, `c_sec2`, `c_sec3`, `c_subjects`, `c_extra`) VALUES
(2, 'Class 6', 'Ka', 'Kha', 'Ga', '', ''),
(4, 'Class 8', 'Ka', 'Kha', 'Ga', '', ''),
(5, 'Class 9', 'Science', 'Art&#039;s', 'Commerce ', '', ''),
(6, 'Class 10', 'Science', 'Art&#039;s', 'Commerce ', '', ''),
(7, 'Class 7', 'Ka', 'Kha', 'Ga', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `class_subject`
--

CREATE TABLE IF NOT EXISTS `class_subject` (
`id` int(11) NOT NULL,
  `subname` varchar(20) NOT NULL,
  `class` varchar(20) NOT NULL,
  `section` tinyint(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class_subject`
--

INSERT INTO `class_subject` (`id`, `subname`, `class`, `section`) VALUES
(1, 'Bangla', 'Class 6', 1),
(2, 'English', 'Class 6', 1),
(3, 'Mathematics', 'Class 6', 1),
(4, 'Science', 'Class 6', 1),
(5, 'Social Science', 'Class 6', 1),
(6, 'Religion', 'Class 6', 1),
(7, 'Bangla', 'Class 6', 2),
(8, 'English', 'Class 6', 2),
(9, 'Mathematics', 'Class 6', 2),
(10, 'Science', 'Class 6', 2),
(11, 'Social Science', 'Class 6', 2),
(12, 'Religion', 'Class 6', 2),
(13, 'Bangla', 'Class 6', 3),
(14, 'English', 'Class 6', 3),
(15, 'Mathematics', 'Class 6', 3),
(16, 'Science', 'Class 6', 3),
(17, 'Social Science', 'Class 6', 3),
(18, 'Religion', 'Class 6', 3),
(33, 'Bangla', 'Class 7', 1),
(34, 'English', 'Class 7', 1),
(35, 'Mathematics', 'Class 7', 1),
(36, 'Science', 'Class 7', 1),
(37, 'Social Science', 'Class 7', 1),
(38, 'Religion', 'Class 7', 1),
(39, 'Bangla', 'Class 7', 2),
(40, 'English', 'Class 7', 2),
(41, 'Mathematics', 'Class 7', 2),
(42, 'Science', 'Class 7', 2),
(43, 'Social Science', 'Class 7', 2),
(44, 'Religion', 'Class 7', 2),
(45, 'Bangla', 'Class 7', 3),
(46, 'English', 'Class 7', 3),
(47, 'Mathematics', 'Class 7', 3),
(48, 'Science', 'Class 7', 3),
(49, 'Social Science', 'Class 7', 3),
(50, 'Religion', 'Class 7', 3),
(51, 'Bangla', 'Class 8', 1),
(52, 'English', 'Class 8', 1),
(53, 'Mathematics', 'Class 8', 1),
(54, 'Science', 'Class 8', 1),
(55, 'Social Science', 'Class 8', 1),
(56, 'Religion', 'Class 8', 1),
(57, 'Bangla', 'Class 8', 2),
(58, 'English', 'Class 8', 2),
(59, 'Mathematics', 'Class 8', 2),
(60, 'Science', 'Class 8', 2),
(61, 'Social Science', 'Class 8', 2),
(62, 'Religion', 'Class 8', 2),
(63, 'Bangla', 'Class 8', 3),
(64, 'English', 'Class 8', 3),
(65, 'Mathematics', 'Class 8', 3),
(66, 'Science', 'Class 8', 3),
(67, 'Social Science', 'Class 8', 3),
(68, 'Religion', 'Class 8', 3),
(69, 'Bangla', 'Class 9', 1),
(70, 'English', 'Class 9', 1),
(71, 'Mathematics', 'Class 9', 1),
(72, 'Science', 'Class 9', 1),
(73, 'Social Science', 'Class 9', 1),
(74, 'Religion', 'Class 9', 1),
(75, 'Physics', 'Class 9', 1),
(76, 'Chemistry', 'Class 9', 1),
(77, 'Biology', 'Class 9', 1),
(78, 'Bangla', 'Class 10', 1),
(79, 'English', 'Class 10', 1),
(80, 'Mathematics', 'Class 10', 1),
(81, 'Science', 'Class 10', 1),
(82, 'Social Science', 'Class 10', 1),
(83, 'Religion', 'Class 10', 1),
(84, 'Physics', 'Class 10', 1),
(85, 'Chemistry', 'Class 10', 1),
(86, 'Biology', 'Class 10', 1);

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE IF NOT EXISTS `permission` (
`id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `p_name` varchar(100) NOT NULL,
  `p_read` tinyint(1) NOT NULL DEFAULT '0',
  `p_write` tinyint(1) NOT NULL DEFAULT '0',
  `p_delete` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`id`, `uid`, `p_name`, `p_read`, `p_write`, `p_delete`) VALUES
(1, 0, 'Create Class', 0, 0, 0),
(2, 0, 'Create Subjects', 0, 0, 0),
(3, 0, 'Register Student', 0, 0, 0),
(4, 0, 'Create Result', 0, 0, 0),
(5, 0, 'Create User', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `result`
--

CREATE TABLE IF NOT EXISTS `result` (
`r_id` int(11) NOT NULL,
  `stuid` int(11) NOT NULL,
  `sub_name` varchar(100) NOT NULL,
  `marks` tinyint(3) NOT NULL DEFAULT '0',
  `exam_id` int(1) NOT NULL,
  `class` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `result`
--

INSERT INTO `result` (`r_id`, `stuid`, `sub_name`, `marks`, `exam_id`, `class`) VALUES
(19, 10021, 'Bangla', 45, 1, 'Class 10'),
(20, 10021, 'English', 67, 1, 'Class 10'),
(21, 10021, 'Mathematics', 86, 1, 'Class 10'),
(22, 10021, 'Science', 34, 1, 'Class 10'),
(23, 10021, 'Social Science', 76, 1, 'Class 10'),
(24, 10021, 'Religion', 91, 1, 'Class 10'),
(25, 10021, 'Physics', 79, 1, 'Class 10'),
(26, 10021, 'Chemistry', 61, 1, 'Class 10'),
(27, 10021, 'Biology', 54, 1, 'Class 10'),
(28, 10011, 'Bangla', 72, 1, 'Class 9'),
(29, 10011, 'English', 84, 1, 'Class 9'),
(30, 10011, 'Mathematics', 96, 1, 'Class 9'),
(31, 10011, 'Science', 81, 1, 'Class 9'),
(32, 10011, 'Social Science', 78, 1, 'Class 9'),
(33, 10011, 'Religion', 85, 1, 'Class 9'),
(34, 10011, 'Physics', 67, 1, 'Class 9'),
(35, 10011, 'Chemistry', 78, 1, 'Class 9'),
(36, 10011, 'Biology', 64, 1, 'Class 9');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
`id` int(11) NOT NULL,
  `s_name` varchar(100) NOT NULL,
  `s_fname` varchar(100) NOT NULL,
  `s_mname` varchar(100) NOT NULL,
  `s_address` varchar(200) NOT NULL,
  `class` varchar(100) NOT NULL,
  `s_section` varchar(100) NOT NULL,
  `s_dob` date NOT NULL,
  `s_img` varchar(200) NOT NULL,
  `stuid` varchar(20) NOT NULL,
  `s_email` varchar(50) NOT NULL,
  `s_pass` varchar(200) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `s_name`, `s_fname`, `s_mname`, `s_address`, `class`, `s_section`, `s_dob`, `s_img`, `stuid`, `s_email`, `s_pass`) VALUES
(1, 'Md Mostafa kamal', 'Abdul Jalil Mia', 'Rashida Akter', '5 no, Anandi Madhyapara, Madhabdi, Narsingdi-1604', 'Class 7', '1', '0000-00-00', 'STU-1441173485man494.png', '10020', 'mmkjony11@gmail.com', 'mmk123456'),
(10, 'Sh Julkar Naen Nahian', 'Sh Sultan Mehdi', 'Mst Monowara Mehdi', 'Rahimpur', 'Class 9', '1', '2015-08-13', 'STU-1442336703IMG_3823.jpg', '10011', 'nahian_is@yahoo.com', '9492dc46cb3b543275cc9c2a8ad27344'),
(11, 'Farid', 'Abdur Rahman', 'Rahima', 'Sagorkandi', 'Class 10', '1', '1991-05-15', 'STU-1442669807Farid.jpg', '10021', 'farid07007@gmail.com', '10fadc2981c5d4e062a690518b7f14e2');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE IF NOT EXISTS `subject` (
`id` int(11) NOT NULL,
  `subid` tinyint(4) NOT NULL,
  `s_name` varchar(100) NOT NULL,
  `s_total` varchar(100) NOT NULL,
  `s_pass` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `subid`, `s_name`, `s_total`, `s_pass`) VALUES
(35, 101, 'Bangla', '100', '33'),
(37, 102, 'English', '100', '33'),
(38, 103, 'Mathematics', '100', '33'),
(39, 104, 'Science', '100', '33'),
(40, 105, 'Social Science', '100', '33'),
(41, 106, 'Religion', '100', '33'),
(42, 107, 'Physics', '100', '33'),
(43, 108, 'Chemistry', '100', '33'),
(44, 109, 'Biology', '100', '33');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
`uid` tinyint(4) NOT NULL,
  `name` varchar(100) NOT NULL,
  `uname` varchar(50) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(300) NOT NULL,
  `role` tinyint(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `name`, `uname`, `designation`, `email`, `pass`, `role`) VALUES
(15, 'Nahian', 'nahian', 'Web Developer', 'nahian_pbn@hotmail.com', 'cc6afb1343f92c867d90ee21d670be0e6bfbbd63', 3),
(18, 'Md. Mostofa Kamal', 'mmkjony', 'Chairman', 'mmkjony11@gmail.com', 'c0fe656dbeb8fdbeeaf34ffd990833962f846b5a', 2),
(22, 'Sh Julkar Naen Nahian', 'admin', 'Admin', 'nahian_is@yahoo.com', 'cc6afb1343f92c867d90ee21d670be0e6bfbbd63', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `class`
--
ALTER TABLE `class`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `class_subject`
--
ALTER TABLE `class_subject`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permission`
--
ALTER TABLE `permission`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `result`
--
ALTER TABLE `result`
 ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `s_sid` (`stuid`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `s_name` (`s_name`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
 ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `class_subject`
--
ALTER TABLE `class_subject`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=87;
--
-- AUTO_INCREMENT for table `permission`
--
ALTER TABLE `permission`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `result`
--
ALTER TABLE `result`
MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
MODIFY `uid` tinyint(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=23;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

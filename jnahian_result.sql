-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 15, 2015 at 12:53 PM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`id`, `class`, `c_sec1`, `c_sec2`, `c_sec3`, `c_subjects`, `c_extra`) VALUES
(1, 'Class 7', 'KA', 'KHA ', 'GA', '["fsafsafg,","fasfasfa,",";lsnklgdng,"]', ''),
(2, 'Class 6', 'Ka', 'Kha', 'Ga', '', ''),
(4, 'Class 8', 'Ka', 'Kha', 'Ga', '', '');

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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `result`
--

INSERT INTO `result` (`r_id`, `stuid`, `sub_name`, `marks`, `exam_id`, `class`) VALUES
(1, 10020, 'Bangla', 50, 1, ''),
(2, 10020, 'English', 60, 1, ''),
(3, 10020, 'Math', 70, 1, ''),
(4, 1000023, 'Bangla', 90, 1, ''),
(5, 1000023, 'English', 90, 1, ''),
(6, 1000023, 'Mathematics', 90, 1, ''),
(7, 1000023, 'Science', 90, 1, ''),
(8, 1000023, 'Social Science', 90, 1, ''),
(9, 1000023, 'Religion', 90, 1, ''),
(10, 1000004, 'Bangla', 80, 2, ''),
(11, 1000004, 'English', 80, 2, ''),
(12, 1000004, 'Mathematics', 80, 2, ''),
(13, 1000004, 'Science', 80, 2, ''),
(14, 1000004, 'Social Science', 80, 2, ''),
(15, 1000004, 'Religion', 80, 2, ''),
(16, 10020, 'Bangla', 12, 1, ''),
(17, 10020, 'English', 127, 1, ''),
(18, 10020, 'Math', 127, 1, '');

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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `s_name`, `s_fname`, `s_mname`, `s_address`, `class`, `s_section`, `s_dob`, `s_img`, `stuid`, `s_email`, `s_pass`) VALUES
(1, 'Md Mostafa kamal', 'Abdul Jalil Mia', 'Rashida Akter', '5 no, Anandi Madhyapara, Madhabdi, Narsingdi-1604', 'Class 7', '1', '0000-00-00', 'STU-1441173485man494.png', '10020', 'mmkjony11@gmail.com', 'mmk123456'),
(5, 'Md Nayeem farid', 'Abdur Rahman', 'Fozila Khatun', 'Sararkandi, Sujanagar, Pabna', 'Class 7', '1', '2015-09-09', 'STU-1441174088male80.png', '1000004', 'farid07007@gmail.com', 'f7b75b9987520c1c71ea595c563fc68e'),
(8, 'Sh Julkar Naen Nahian', 'Sh Sultan Mehdi', 'Mst Monowar Mehdi', 'Rahimpur, Ishwardi, Pabna', 'Class 7', '1', '1988-12-20', 'STU-1441174393_MG_5003.jpg', '1000023', 'nahian_is@yahoo.com', '9492dc46cb3b543275cc9c2a8ad27344');

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
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `subid`, `s_name`, `s_total`, `s_pass`) VALUES
(35, 101, 'Bangla', '100', '33');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` tinyint(4) NOT NULL,
  `name` varchar(100) NOT NULL,
  `uname` varchar(50) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `pass` varchar(300) NOT NULL,
  `role` tinyint(4) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `uname`, `designation`, `email`, `pass`, `role`) VALUES
(15, 'Nahian', 'nahian', 'Web Developer', 'nahian_pbn@hotmail.com', 'cc6afb1343f92c867d90ee21d670be0e6bfbbd63', 0),
(18, 'Md. Mostofa Kamal', 'mmkjony', 'Chairman', 'mmkjony11@gmail.com', 'c0fe656dbeb8fdbeeaf34ffd990833962f846b5a', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

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
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `result`
--
ALTER TABLE `result`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=22;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

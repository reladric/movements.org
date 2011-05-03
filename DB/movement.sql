-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 24, 2011 at 05:43 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `movement`
--

-- --------------------------------------------------------

--
-- Table structure for table `authen_records`
--

CREATE TABLE IF NOT EXISTS `authen_records` (
  `id` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `authen_records`
--

INSERT INTO `authen_records` (`id`, `type`) VALUES
(100, 'Nobody'),
(1, 'Administrator'),
(2, 'Transport Admin'),
(3, 'News Admin'),
(4, 'Library admin'),
(5, 'Canteen admin');

-- --------------------------------------------------------

--
-- Table structure for table `needcommenttable`
--

CREATE TABLE IF NOT EXISTS `needcommenttable` (
  `comment_id` int(5) NOT NULL AUTO_INCREMENT,
  `post_id` int(5) NOT NULL,
  `uid` int(3) NOT NULL,
  `content` varchar(500) NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  PRIMARY KEY (`comment_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `needcommenttable`
--

INSERT INTO `needcommenttable` (`comment_id`, `post_id`, `uid`, `content`, `date`, `time`) VALUES
(1, 1, 1, 'jhasjfdags;jaklh', '2011-03-27', '14:12:22'),
(2, 3, 3, 'Hello!!!!', '2011-04-24', '17:23:26'),
(3, 3, 3, 'Haahaha', '2011-04-24', '17:29:03'),
(4, 3, 4, 'dj\r\n;lasj', '2011-04-24', '17:29:15'),
(5, 3, 4, 'Tonight We Dine In HELL!!!', '2011-04-24', '17:29:40'),
(6, 4, 4, 'I need a million dollars!!!!', '2011-04-24', '17:34:55'),
(7, 4, 3, 'I need more', '2011-04-24', '17:35:14');

-- --------------------------------------------------------

--
-- Table structure for table `needstable`
--

CREATE TABLE IF NOT EXISTS `needstable` (
  `needId` int(8) NOT NULL AUTO_INCREMENT,
  `categId` int(4) NOT NULL,
  `deadline` date NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `uid` int(3) NOT NULL,
  `point` int(4) NOT NULL,
  `title` varchar(50) NOT NULL,
  `content` varchar(500) NOT NULL,
  PRIMARY KEY (`needId`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `needstable`
--

INSERT INTO `needstable` (`needId`, `categId`, `deadline`, `date`, `time`, `uid`, `point`, `title`, `content`) VALUES
(1, 1, '2011-03-14', '2011-03-13', '19:32:54', 1, 1, 'Adadf', 'sadsd\\ndadsas'),
(2, 5, '2011-03-14', '2011-03-13', '19:34:56', 2, 5, '', ''),
(3, 5, '2011-03-31', '2011-03-27', '14:12:22', 1, 5, 'asdasd', 'sadsd\\ndadsas'),
(4, 0, '2011-04-28', '2011-04-24', '17:34:12', 4, 20, 'adsfdasfsda', 'asddgadfw');

-- --------------------------------------------------------

--
-- Table structure for table `needtransacationtable`
--

CREATE TABLE IF NOT EXISTS `needtransacationtable` (
  `transid` int(5) NOT NULL AUTO_INCREMENT,
  `needid` int(5) NOT NULL,
  `author_uid` int(3) NOT NULL,
  `resp_uid` int(3) NOT NULL,
  PRIMARY KEY (`transid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `needtransacationtable`
--


-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `uid` int(3) NOT NULL,
  `points` int(3) NOT NULL,
  `firstname` varchar(25) NOT NULL,
  `lastname` varchar(25) NOT NULL,
  `dob` date NOT NULL,
  `disp_dob` int(1) NOT NULL,
  `addr1` varchar(30) NOT NULL,
  `addr2` varchar(30) NOT NULL,
  `city` varchar(20) NOT NULL,
  `state` varchar(15) NOT NULL,
  `country` varchar(15) NOT NULL,
  `zip` int(6) NOT NULL,
  `phone` int(12) NOT NULL,
  `sec_email` varchar(25) NOT NULL,
  `nickname` varchar(25) NOT NULL,
  `twitter` varchar(25) NOT NULL,
  `fb` varchar(25) NOT NULL,
  `linkedin` varchar(25) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `points`, `firstname`, `lastname`, `dob`, `disp_dob`, `addr1`, `addr2`, `city`, `state`, `country`, `zip`, `phone`, `sec_email`, `nickname`, `twitter`, `fb`, `linkedin`) VALUES
(3, 0, '', '', '0000-00-00', 0, '', '', '', '', '', 0, 0, '', 'asdasdasdas', '', '', ''),
(4, 0, '', '', '0000-00-00', 0, '', '', '', '', '', 0, 0, '', 'Sarvo', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `auth` int(100) NOT NULL,
  `session` varchar(100) NOT NULL,
  `ip` varchar(100) NOT NULL,
  `cookie` varchar(100) NOT NULL,
  `course` int(11) NOT NULL,
  `dept` int(11) NOT NULL,
  `email` varchar(500) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `univreg` varchar(20) NOT NULL,
  `fname` varchar(5000) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `auth`, `session`, `ip`, `cookie`, `course`, `dept`, `email`, `contact`, `univreg`, `fname`) VALUES
(1, '2008CSE425', 'd6a90310763608c2c88e2f4e9e2e2c138ab869ee', '2ebfb1090f840af87828ac2d46671a33f9dc7cc6', 1, 'rCNENEgC4YVEQCzC4oQYru4yNepCDe2u', '127.0.0.1', '', 1, 4, 'asd', 'asd', 'asd', 'asd'),
(2, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', '70564c0902e6d5b6782625c99371f95463a2ac79', 1, 'KErUQo2E2yQUpaHa6ejE4uDYDYXY$ypC', '127.0.0.1', '', 0, 0, '', '', '', ''),
(3, 'user', '12dea96fec20593566ab75692c9949596833adc9', '8f3cb11e984bb113de005157e56e29d161e8dfda', 2, 'BEWAmo3EhUZYqA3y%a%eha#evuZo%Y9Y', '127.0.0.1', '', 0, 0, '', '', '', ''),
(4, 'user1', 'b3daa77b4c04a9551b8781d03191fe098f325e67', '8390d13926b52c3aa7d4f2fc1206e8811e4d902f', 2, 'Ho8anCDapo$EzUHiNo8ANy2UQu8A8Uzy', '122.164.211.116', '', 0, 0, '', '', '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

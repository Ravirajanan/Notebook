-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 08, 2017 at 07:31 PM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `notebook`
--

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE IF NOT EXISTS `branch` (
  `id` int(11) unsigned NOT NULL,
  `branch_name` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`id`, `branch_name`) VALUES
(1, 'construction'),
(2, 'mechanical'),
(3, 'electronics'),
(4, 'electrical'),
(5, 'medical'),
(6, 'software');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) unsigned NOT NULL,
  `comment` text NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `posted_at` datetime NOT NULL,
  `post_id` int(11) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `comment`, `user_id`, `posted_at`, `post_id`) VALUES
(24, 'i am fine', 12, '2017-09-12 22:19:05', 15),
(25, 'i am fine', 12, '2017-09-12 22:21:08', 15),
(26, 'ho hai', 12, '2017-10-14 17:55:12', 26),
(27, 'ho hai', 12, '2017-10-14 17:55:32', 26),
(28, 'Comment', 12, '2017-10-14 18:03:48', 26),
(29, 'Comment', 12, '2017-10-14 18:03:58', 26),
(30, 'yeswanth', 12, '2017-10-14 18:04:25', 26),
(31, 'great', 12, '2017-10-14 18:08:10', 26),
(32, 'great', 12, '2017-10-14 18:11:10', 26),
(33, 'great', 12, '2017-10-14 18:11:27', 26),
(34, 'raviraja', 12, '2017-10-14 18:11:39', 26),
(35, 'this is an comment that automatic refresh', 12, '2017-10-14 18:12:18', 26),
(36, 'love you', 12, '2017-10-14 18:15:06', 26),
(37, 'love you', 12, '2017-10-14 18:16:13', 26),
(38, 'hi how are you', 12, '2017-10-14 19:57:35', 35),
(39, 'hello\r\n', 12, '2017-10-14 20:04:33', 89),
(40, 'raviraja', 12, '2017-10-14 20:04:43', 89),
(41, 'this is reddy yeswanth', 12, '2017-10-14 20:05:44', 89),
(42, 'king', 12, '2017-10-14 20:06:11', 89),
(43, 'jjj', 12, '2017-10-14 20:21:19', 34),
(44, 'jjj', 12, '2017-10-14 20:22:24', 34),
(45, 'yes reddy garu soo great', 12, '2017-10-14 20:23:16', 73),
(46, 'this is soo large cintet', 12, '2017-10-14 20:25:26', 18),
(47, 'this is soo large cintet', 12, '2017-10-14 20:33:17', 18),
(48, 'i love you', 12, '2017-10-14 20:49:15', 43),
(49, 'ji', 12, '2017-10-14 21:12:22', 35),
(50, 'ravi raja', 12, '2017-10-14 21:12:41', 34),
(51, 'i love you', 12, '2017-10-30 19:25:09', 34);

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

CREATE TABLE IF NOT EXISTS `followers` (
  `id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `follower_id` int(11) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `followers`
--

INSERT INTO `followers` (`id`, `user_id`, `follower_id`) VALUES
(5, 10, 9),
(6, 10, 12),
(7, 12, 10),
(8, 9, 12);

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE IF NOT EXISTS `jobs` (
  `id` int(11) unsigned NOT NULL,
  `userid` int(11) NOT NULL,
  `branch` char(13) NOT NULL,
  `active` bit(1) NOT NULL DEFAULT b'0'
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`id`, `userid`, `branch`, `active`) VALUES
(13, 12, 'construction', b'0'),
(14, 12, 'software', b'0'),
(15, 12, 'electrical', b'0'),
(16, 12, 'electronics', b'0'),
(17, 12, 'mechanical', b'0'),
(18, 12, 'construction', b'0'),
(19, 12, 'electrical', b'0'),
(20, 12, 'constructio', b'0'),
(21, 12, 'electrical', b'0'),
(22, 12, 'software', b'0'),
(23, 12, 'electronics', b'0'),
(24, 12, 'mechanical', b'0'),
(25, 12, 'construction', b'0'),
(26, 12, 'electrical', b'0'),
(27, 12, 'software', b'0'),
(28, 12, 'electronics', b'0'),
(29, 12, 'mechanical', b'0'),
(30, 12, 'constructio', b'0'),
(31, 12, 'electrical', b'0'),
(32, 12, 'software', b'0'),
(33, 12, 'electronics', b'0'),
(34, 12, 'mechanical', b'0'),
(35, 12, 'constructio', b'0'),
(36, 12, 'electrical', b'0'),
(37, 12, 'software', b'0'),
(38, 12, 'electronics', b'0'),
(39, 12, 'mechanical', b'0'),
(40, 12, 'constructio', b'0'),
(41, 12, 'electrical', b'0'),
(42, 12, 'software', b'0'),
(43, 12, 'electronics', b'0'),
(44, 12, 'mechanical', b'0'),
(45, 9, 'constructio', b'0'),
(46, 9, 'electrical', b'0'),
(47, 9, 'constructio', b'0'),
(48, 9, 'electrical', b'0'),
(49, 9, 'constructio', b'0'),
(50, 9, 'electrical', b'0'),
(51, 25, 'constructio', b'1'),
(52, 25, 'mechanical', b'1'),
(53, 25, 'electronics', b'1'),
(54, 25, 'electrical', b'1'),
(55, 25, 'medical', b'1'),
(56, 26, 'construction', b'1'),
(57, 26, 'mechanical', b'1'),
(58, 26, 'electronics', b'1'),
(59, 26, 'electrical', b'1'),
(60, 26, 'medical', b'1'),
(61, 26, 'software', b'1'),
(62, 27, 'construction', b'1'),
(63, 27, 'mechanical', b'1'),
(64, 27, 'electronics', b'1'),
(65, 27, 'electrical', b'1'),
(66, 27, 'medical', b'1'),
(67, 27, 'software', b'1'),
(68, 28, 'construction', b'1'),
(69, 28, 'mechanical', b'1'),
(70, 28, 'electronics', b'1'),
(71, 28, 'electrical', b'1'),
(72, 28, 'medical', b'1'),
(73, 28, 'software', b'1'),
(74, 29, 'construction', b'1'),
(75, 29, 'mechanical', b'1'),
(76, 29, 'electronics', b'1'),
(77, 29, 'electrical', b'1'),
(78, 29, 'medical', b'1'),
(79, 29, 'software', b'1'),
(80, 30, 'construction', b'1'),
(81, 30, 'mechanical', b'1'),
(82, 30, 'electronics', b'1'),
(83, 30, 'electrical', b'1'),
(84, 30, 'medical', b'1'),
(85, 30, 'software', b'1'),
(86, 31, 'construction', b'1'),
(87, 31, 'mechanical', b'1'),
(88, 31, 'electronics', b'1'),
(89, 31, 'electrical', b'1'),
(90, 31, 'medical', b'1'),
(91, 31, 'software', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `jobsdata`
--

CREATE TABLE IF NOT EXISTS `jobsdata` (
  `id` int(11) unsigned NOT NULL,
  `branch` char(13) NOT NULL,
  `jobtitle_data` varchar(2000) NOT NULL,
  `joblink` varchar(1000) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jobsdata`
--

INSERT INTO `jobsdata` (`id`, `branch`, `jobtitle_data`, `joblink`) VALUES
(1, 'electronics', 'jto', 'shfsdfh'),
(2, 'software', 'web designer', 'lldskfjoi'),
(3, 'construction', 'survet=y', 'lzhgosifl'),
(4, 'software', 'tcs ', 'www.tcs.com'),
(5, 'electrical', 'web designer- hsotihwrog wrigowrowerivkdvoierhgmsdvnoierghdnvoiewrvnidvnoeihfowief', 'hhtppa'),
(6, 'construction', 'ghghgghgPersonal Digital Assistants (PDAs), and wireless networking. In 1895, Guglielmo Marconi\nopened the way for modern wireless communications by transmitting the three-dot Morse code\nfor the letter ‘S’ over a distance of three kilometers using electromagnetic waves. From this\nbeginning, wireless communications has developed into a key element of modern society', 'haiahfidPersonal Digital Assistants (PDAs), and wireless networking. In 1895, Guglielmo MarconiPersonal Digital Assistants (PDAs), and wireless networking. In 1895, Guglielmo Marconi\nopened the way for modern wireless communications by transmitting the three-dot Morse code\nfor the letter ‘S’ over a distance of three kilometers using electromagnetic waves. From this\nbeginning, wireless communications has developed into a key element of modern society\nopen'),
(7, 'construction', 'web designer- hsotihwrog wrigowrowerivkdvoierhgmsdvnoierghdnvoiewrvnidvnoeihfow\n1111111111ief', 'hhtppa');

-- --------------------------------------------------------

--
-- Table structure for table `login_tokens`
--

CREATE TABLE IF NOT EXISTS `login_tokens` (
  `id` int(11) unsigned NOT NULL,
  `token` char(64) NOT NULL,
  `user_id` int(11) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=225 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_tokens`
--

INSERT INTO `login_tokens` (`id`, `token`, `user_id`) VALUES
(175, '641c276294708845768c65ed52c0584b25de3e69', 12),
(176, '38e3579c897ecfc17c4f9783fd1238dc3e76575d', 12),
(177, '211f4efebda7002e29f4c4e97d5a3a8902eadea6', 12),
(178, '2874a577aed0f964e50f3bfea218647ad545d893', 12),
(179, 'd988eb1b4e94fc31519dc0e391720775e7f816a1', 12),
(198, '863198e68c3eda9d3fb6ca4ee75f4b8e03d7616e', 12),
(202, 'f43b6cc924b97cf9f6ac71662c09c94bbc60c85b', 25),
(210, '8f39020f8d64390c926d566e8c2b6b0e1aadda14', 12),
(211, '1cd2772f0da0d9a25a3b61c74c89e3378e535b68', 12),
(212, '88d9958f0f14e1c900ab4e04b96e9baf35471c07', 12),
(214, 'ff76d8289f5bd1218d6deff6d054439aac09845d', 26),
(216, '3d1c1aa60adaa8955fc42c9228408fbeebae432f', 26),
(221, 'f34cd19fd7235bd0b451c15e6743d7e34591f3da', 26),
(222, 'a8f4e2205fa2c9bc70fb06b2b879bcfec021e0dd', 12),
(223, '9349d3e0d9a5773852517d08f94bab9db4c9a441', 12),
(224, '857f525f76a504f4891a5f18112c6f11ed2f0180', 26);

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE IF NOT EXISTS `notes` (
  `id` int(11) unsigned NOT NULL,
  `userid` int(11) unsigned NOT NULL,
  `postid` int(11) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `userid`, `postid`) VALUES
(1, 12, 11),
(2, 12, 9),
(3, 12, 26),
(4, 9, 15),
(5, 12, 78),
(6, 12, 13),
(7, 12, 75),
(8, 12, 13),
(9, 12, 18),
(10, 12, 70),
(11, 12, 60),
(12, 9, 14);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) unsigned NOT NULL,
  `type` int(11) unsigned DEFAULT NULL,
  `receiver` int(11) unsigned DEFAULT NULL,
  `sender` int(11) unsigned DEFAULT NULL,
  `extra` text
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `type`, `receiver`, `sender`, `extra`) VALUES
(1, 2, 12, 12, ''),
(2, 2, 12, 12, ''),
(3, 2, 12, 12, ''),
(4, 2, 9, 9, ''),
(5, 2, 9, 9, ''),
(6, 2, 9, 9, ''),
(7, 2, 9, 9, ''),
(8, 2, 9, 9, ''),
(9, 2, 9, 9, ''),
(10, 2, 9, 9, ''),
(11, 2, 9, 9, ''),
(12, 2, 9, 9, ''),
(13, 2, 9, 9, ''),
(14, 2, 9, 9, ''),
(15, 2, 9, 9, ''),
(16, 2, 9, 9, ''),
(17, 2, 9, 9, ''),
(18, 2, 9, 9, ''),
(19, 2, 9, 9, ''),
(20, 2, 9, 9, ''),
(21, 2, 9, 9, ''),
(22, 2, 9, 9, ''),
(23, 2, 9, 9, ''),
(24, 2, 9, 9, ''),
(25, 2, 10, 10, ''),
(26, 2, 10, 10, ''),
(27, 2, 10, 10, ''),
(28, 2, 12, 12, ''),
(29, 2, 12, 12, ''),
(30, 2, 12, 12, ''),
(31, 2, 12, 12, ''),
(32, 2, 10, 10, ''),
(33, 2, 10, 10, ''),
(34, 2, 10, 10, ''),
(35, 2, 10, 10, ''),
(36, 2, 10, 10, ''),
(37, 2, 12, 12, ''),
(38, 2, 12, 12, ''),
(39, 2, 9, 9, ''),
(40, 2, 9, 9, ''),
(41, 2, 9, 9, ''),
(42, 2, 9, 9, ''),
(43, 2, 9, 12, ''),
(44, 2, 9, 12, ''),
(45, 2, 9, 12, ''),
(46, 2, 9, 9, ''),
(47, 2, 9, 9, ''),
(48, 2, 9, 9, ''),
(49, 2, 9, 9, ''),
(50, 2, 9, 9, ''),
(51, 2, 9, 9, ''),
(52, 2, 9, 9, ''),
(53, 2, 9, 9, ''),
(54, 2, 9, 9, ''),
(55, 2, 9, 9, ''),
(56, 2, 9, 9, ''),
(57, 2, 9, 9, ''),
(58, 2, 9, 9, ''),
(59, 2, 9, 9, ''),
(60, 2, 9, 9, ''),
(61, 2, 9, 9, ''),
(62, 2, 9, 9, ''),
(63, 2, 9, 9, ''),
(64, 2, 9, 9, ''),
(65, 2, 9, 9, ''),
(66, 2, 9, 9, ''),
(67, 2, 9, 9, ''),
(68, 2, 9, 9, ''),
(69, 2, 9, 12, ''),
(70, 2, 9, 12, ''),
(71, 2, 9, 12, ''),
(72, 2, 9, 12, ''),
(73, 2, 9, 12, ''),
(74, 2, 9, 12, ''),
(75, 2, 9, 12, ''),
(76, 2, 9, 12, ''),
(77, 2, 9, 12, ''),
(78, 2, 9, 12, ''),
(79, 2, 9, 12, ''),
(80, 2, 9, 12, ''),
(81, 2, 12, 12, ''),
(82, 2, 12, 12, ''),
(83, 2, 12, 12, ''),
(84, 2, 12, 12, ''),
(85, 2, 9, 9, ''),
(86, 2, 12, 12, ''),
(87, 2, 12, 12, ''),
(88, 2, 12, 12, ''),
(89, 2, 9, 9, ''),
(90, 2, 9, 9, ''),
(91, 2, 9, 9, ''),
(92, 2, 9, 9, ''),
(93, 2, 9, 9, ''),
(94, 2, 12, 12, ''),
(95, 2, 9, 9, ''),
(96, 2, 22, 22, ''),
(97, 2, 10, 10, ''),
(98, 2, 10, 10, ''),
(99, 2, 9, 12, ''),
(100, 2, 12, 9, ''),
(101, 2, 12, 12, ''),
(102, 2, 12, 12, ''),
(103, 2, 12, 9, ''),
(104, 2, 12, 9, ''),
(105, 2, 12, 9, ''),
(106, 2, 12, 12, ''),
(107, 2, 9, 12, ''),
(108, 2, 9, 9, ''),
(109, 2, 12, 9, ''),
(110, 2, 12, 12, ''),
(111, 2, 12, 26, '');

-- --------------------------------------------------------

--
-- Table structure for table `password_tokens`
--

CREATE TABLE IF NOT EXISTS `password_tokens` (
  `id` int(11) unsigned NOT NULL,
  `token` char(64) NOT NULL,
  `user_id` int(11) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) unsigned NOT NULL,
  `title` varchar(200) NOT NULL,
  `body` varchar(16000) NOT NULL,
  `image` varchar(255) NOT NULL,
  `posted_at` datetime NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `likes` int(11) unsigned NOT NULL,
  `branchid` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=98 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `body`, `image`, `posted_at`, `user_id`, `likes`, `branchid`) VALUES
(8, '', 'hai how are u', '', '2017-07-08 14:24:55', 9, 1, 'civil'),
(9, '', 'cool', '', '2017-07-08 14:25:03', 9, 2, 'civil'),
(11, '', 'coool', '', '2017-07-08 14:30:02', 10, 1, ''),
(12, '', 'yeswanth', '', '2017-07-08 17:36:00', 10, 0, ''),
(13, '', 'reddy yeswanth', '', '2017-07-08 17:36:10', 10, 0, ''),
(14, '', 'reddyThis book is here to help you get your job done. In general, you may use the code in this book in your programs and documentation. You do not need to contact us for permission unless you’re reproducing a significant portion of the code. For example, writing a program that uses several chunks of code from this book does not require permission. Selling or distributing a CD-ROM of examples from O’Reilly books does require permission. Answering a question by citing this book and quoting example code does not require permission. Incorporating a significant amount of example code from this book into your product’s documentation does require permission.', '', '2017-07-10 19:12:30', 10, 2, ''),
(15, 'fine', 'how are u', '', '2017-07-10 19:12:58', 10, 3, 'civil'),
(16, '', 'HaiThis book is here to help you get your job done. In general, you may use the code in this book in your programs and documentation. You do not need to contact us for permission unless you’re reproducing a significant portion of the code. For example, writing a program that uses several chunks of code from this book does not require permission. Selling or distributing a CD-ROM of examples from O’Reilly books does require permission. Answering a question by citing this book and quoting example code does not require permission. Incorporating a significant amount of example code from this book into your product’s documentation does require permission.', '', '2017-07-13 09:27:42', 11, 0, ''),
(17, '', 'sdfghjk', '', '2017-07-16 19:57:38', 9, 0, 'civil'),
(18, '', 'hi\nThis book is here to help you get your job done. In general, you may use the code in this book in your programs and documentation. You do not need to contact us for permission unless you’re reproducing a significant portion of the code. For example, writing a program that uses several chunks of code from this book does not require permission. Selling or distributing a CD-ROM of examples from O’Reilly books does require permission. Answering a question by citing this book and quoting example code does not require permission. Incorporating a significant amount of example code from this book into your product’s documentation does require permission.', '', '2017-08-03 17:58:29', 9, 1, ''),
(26, '', 'dfghjThis book is here to help you get your job done. In general, you may use the code in this book in your programs and documentation. You do not need to contact us for permission unless you’re reproducing a significant portion of the code. For example, writing a program that uses several chunks of code from this book does not require permission. Selling or distributing a CD-ROM of examples from O’Reilly books does require permission. Answering a question by citing this book and quoting example code does not require permission. Incorporating a significant amount of example code from this book into your product’s documentation does require permission.', '', '2017-08-03 19:13:26', 9, 1, ''),
(27, '', 'This book is here to help you get your job done. In general, you may use the code in this book in your programs and documentation. You do not need to contact us for permission unless you’re reproducing a significant portion of the code. For example, writing a program that uses several chunks of code from this book does not require permission. Selling or distributing a CD-ROM of examples from O’Reilly books does require permission. Answering a question by citing this book and quoting example code does not require permission. Incorporating a significant amount of example code from this book into your product’s documentation does require permission.', '', '2017-08-03 19:14:24', 9, 1, ''),
(28, '', 'juke', '', '2017-08-03 19:19:14', 9, 1, ''),
(29, '', 'lukeThis book is here to help you get your job done. In general, you may use the code in this book in your programs and documentation. You do not need to contact us for permission unless you’re reproducing a significant portion of the code. For example, writing a program that uses several chunks of code from this book does not require permission. Selling or distributing a CD-ROM of examples from O’Reilly books does require permission. Answering a question by citing this book and quoting example code does not require permission. Incorporating a significant amount of example code from this book into your product’s documentation does require permission.', '', '2017-08-03 19:20:10', 9, 1, ''),
(30, '', 'dfh', '', '2017-09-02 22:03:48', 9, 2, ''),
(31, '', 'jkvhjhvhjvgggvbbvnbbvhhvg', '', '2017-09-02 22:03:57', 9, 0, ''),
(32, '', 'iugiu', '', '2017-09-03 08:49:19', 9, 0, ''),
(33, '', 'lgl', '', '2017-09-03 08:49:28', 9, 0, ''),
(34, '', 'king\r\n', '', '2017-09-03 08:53:28', 12, 2, ''),
(35, '', 'king', '', '2017-09-03 08:53:35', 12, 1, ''),
(36, '', 'king', '', '2017-09-03 08:56:57', 12, 2, ''),
(38, '', 'hai how at ', '', '2017-09-03 12:24:58', 12, 1, ''),
(39, '', 'hai how are you\r\n', '', '2017-09-03 18:51:31', 12, 1, ''),
(41, '', 'hai how are you', '', '2017-09-03 19:00:44', 9, 0, ''),
(42, '', 'qwertyuiop', '', '2017-09-11 21:33:43', 12, 1, 'ece'),
(43, '', 'asdfghjkl;', '', '2017-09-11 21:34:06', 12, 1, 'ece'),
(44, '', 'nandhini suhasini lakshmi devi', '', '2017-09-11 21:58:06', 12, 1, 'ece'),
(45, '', 'lovely', '', '2017-09-11 22:11:02', 12, 0, 'ece'),
(46, '', 'hai', '', '2017-09-11 22:25:34', 15, 0, 'civil'),
(47, '', 'how are you my baby', '', '2017-09-11 22:29:10', 15, 0, 'civil'),
(48, '', 'hi jonney', '', '2017-09-11 22:41:15', 15, 0, 'civil'),
(49, '', 'hi', '', '2017-09-11 22:43:15', 15, 0, 'civil'),
(50, '', 'hi', '', '2017-09-11 22:43:44', 15, 0, 'civil'),
(51, '', 'hi', '', '2017-09-11 22:44:10', 15, 0, 'civil'),
(52, '', 'hi', '', '2017-09-11 22:44:25', 15, 0, 'civil'),
(53, '', 'hi', '', '2017-09-11 22:44:30', 15, 0, 'civil'),
(54, '', 'love', '', '2017-09-11 22:46:40', 15, 0, 'civil'),
(55, '', 'king love', '', '2017-09-11 22:56:40', 15, 0, 'civil'),
(56, 'ravi', 'love u baby', '', '2017-09-11 22:58:20', 12, 1, 'ece'),
(57, 'raja', 'love u baby 2', '', '2017-09-11 22:58:40', 12, 0, 'ece'),
(58, '', 'raviraja is mine', '', '2017-09-11 23:04:09', 17, 0, 'civil'),
(59, '', 'oerighero', '', '2017-09-12 20:50:51', 12, 0, 'ece'),
(60, '', 'lekrwoie', '', '2017-09-12 21:23:12', 12, 0, 'ece'),
(61, '', 'ewhfoewfi', '', '2017-09-12 21:30:31', 12, 0, 'ece'),
(62, 'hi ', 'loveyou', '', '2017-09-12 21:49:46', 12, 0, 'ece'),
(63, 'hi', 'nandu', '', '2017-09-12 21:57:21', 12, 0, 'ece'),
(64, '', 'i created an post which can have a title or no', '', '2017-09-12 22:28:05', 12, 0, 'ece'),
(65, 'TITLE', 'i created 598dde57685e15.74997643.jpg an post which can have a title or no', '598dde57685e15.74997643.jpg', '2017-09-12 22:28:38', 12, 0, 'ece'),
(70, 'no image', 'hi', '598dde57685e15.74997643.jpg', '2017-09-14 20:52:08', 9, 0, 'civil'),
(71, 'hj.jk25.jpg', 'hj.jk25.jpg', '598dde57685e15.74997643.jpg', '2017-09-14 21:08:23', 12, 0, 'ece'),
(72, '', 'mypic', '59baa30fab1181.12044377.jpg', '2017-09-14 21:11:03', 12, 1, 'ece'),
(73, 'notify', '#reddy', '0', '2017-09-14 21:44:30', 12, 0, 'ece'),
(74, 'image', 'its not working ', '59c29583239d96.41063518.jpg', '2017-09-20 21:51:23', 12, 1, 'civil'),
(75, 'it is an new webdesign ', 'This book is here to help you get your job done. In general, you\r\nmay use the code in this book in your programs and documentation.\r\nYou do not need to contact ', '59c29b35a3f3b1.83704338.jpg', '2017-09-25 17:29:21', 9, 0, 'civil'),
(76, 'IT IS AN NEW DESIGN', 'This book is here to help you get your job done. In general, you\r\nmay use the code in this book in your programs and documentation.\r\nYou do not need to contact us for permission unless\r\nyou’re reproducing a significant portion of the code. For example,\r\nwriting a program that uses several chunks of code from\r\nthis book does not require permission. Selling or distributing\r\na CD-ROM of examples from O’Reilly books does require permission.\r\nAnswering a question by citing this book and quoting\r\nexample code does not require permission. Incorporating a\r\nsignificant amount of example code from this book into your\r\nproduct’s documentation does require permission.', '59c29b35a3f3b1.83704338.jpg', '2017-09-25 17:30:51', 9, 1, 'civil'),
(77, 'IT IS AN NEW DESIGN', 'This book is here to help you get your job done. In general, you\r\nmay use the code in this book in your programs and documentation.\r\nYou do not need to contact us for permission unless\r\nyou’re reproducing a significant portion of the code. For example,\r\nwriting a program that uses several chunks of code from\r\nthis book does not require permission. Selling or distributing\r\na CD-ROM of examples from O’Reilly books does require permission.\r\nAnswering a question by citing this book and quoting\r\nexample code does not require permission. Incorporating a\r\nsignificant amount of example code from this book into your\r\nproduct’s documentation does require permission.', '59c29b35a3f3b1.83704338.jpg', '2017-09-25 17:31:11', 9, 1, 'civil'),
(78, 'IT IS AN NEW DESIGN', 'This book is here to help you get your job done. In general, you\r\nmay use the code in this book in your programs and documentation.\r\nYou do not need to contact us for permission unless\r\nyou’re reproducing a significant portion of the code. For example,\r\nwriting a program that uses several chunks of code from\r\nthis book does not require permission. Selling or distributing\r\na CD-ROM of examples from O’Reilly books does require permission.\r\nAnswering a question by citing this book and quoting\r\nexample code does not require permission. Incorporating a\r\nsignificant amount of example code from this book into your\r\nproduct’s documentation does require permission.', '59c29b35a3f3b1.83704338.jpg', '2017-09-25 17:31:49', 9, 0, 'civil'),
(79, 'sai', 'yadava', '0', '2017-10-09 22:48:19', 22, 1, 'civil'),
(80, '', '', '59dfb464837248.96615397.png', '2017-10-12 23:58:52', 12, 0, 'ece'),
(81, '', '', '59dfb4de7fbd17.18852938.png', '2017-10-13 00:00:54', 12, 0, 'ece'),
(82, '', '', '59dfb50480b984.45150143.png', '2017-10-13 00:01:32', 12, 0, 'ece'),
(83, 'skhfoisd', 'sfoisdfkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkk', '0', '2017-10-13 00:02:20', 12, 0, 'ece'),
(84, '', '', '59dfb570e309a4.27630193.png', '2017-10-13 00:03:20', 12, 0, 'ece'),
(85, '', '', '59dfb5c57b8a54.39182883.png', '2017-10-13 00:04:45', 12, 0, 'ece'),
(86, '', '', '59dfb5dc153ae5.68072050.png', '2017-10-13 00:05:08', 12, 0, 'ece'),
(87, 'how are you swetha i am soo sorry', 'because i am already in love', '59dfb60e21ec21.10962979.jpg', '2017-10-13 00:05:58', 12, 0, 'ece'),
(88, '', '', '59dfb6d22f0016.21512372.jpg', '2017-10-13 00:09:14', 12, 0, 'ece'),
(89, '', '', '59dfb7080f9620.88686743.jpg', '2017-10-13 00:10:08', 12, 0, 'ece'),
(90, 'check one', 'its matlab passed or not', '0', '2017-10-14 21:21:03', 12, 0, 'ece'),
(91, 'raj', 'lavely raj', '0', '2017-10-14 21:33:39', 12, 0, 'ece'),
(92, 'raj', 'lavely raj', '0', '2017-10-14 21:34:01', 12, 0, 'ece'),
(93, 'sri sweetha', 'trying to flurt raviraja', '0', '2017-10-14 21:34:42', 12, 0, 'ece'),
(94, 'raviraja', 'loves only nandu and marries her', '0', '2017-10-14 21:35:27', 12, 0, 'ece'),
(95, 'reddy', 'trying to get sleep', '0', '2017-10-14 21:35:52', 12, 1, 'ece'),
(96, 'the timer', 'is it working', '0', '2017-10-14 21:37:20', 12, 0, 'ece'),
(97, 'the timer', 'is it working', '0', '2017-10-14 21:37:52', 12, 0, 'ece');

-- --------------------------------------------------------

--
-- Table structure for table `post_likes`
--

CREATE TABLE IF NOT EXISTS `post_likes` (
  `id` int(11) unsigned NOT NULL,
  `post_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=130 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post_likes`
--

INSERT INTO `post_likes` (`id`, `post_id`, `user_id`) VALUES
(9, 8, 9),
(10, 9, 9),
(11, 10, 10),
(12, 11, 10),
(20, 14, 10),
(21, 15, 10),
(22, 15, 11),
(23, 14, 11),
(24, 29, 9),
(25, 28, 9),
(27, 30, 9),
(30, 36, 12),
(37, 39, 12),
(38, 38, 12),
(46, 18, 9),
(54, 42, 12),
(57, 15, 12),
(61, 43, 12),
(62, 30, 12),
(103, 76, 9),
(104, 44, 12),
(106, 74, 12),
(108, 27, 9),
(110, 34, 9),
(111, 36, 9),
(117, 56, 12),
(118, 9, 12),
(119, 79, 22),
(122, 26, 12),
(125, 35, 12),
(126, 77, 9),
(127, 34, 12),
(128, 72, 12),
(129, 95, 26);

-- --------------------------------------------------------

--
-- Table structure for table `profileimg`
--

CREATE TABLE IF NOT EXISTS `profileimg` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

CREATE TABLE IF NOT EXISTS `question` (
  `id` int(11) unsigned NOT NULL,
  `userid` int(11) unsigned NOT NULL,
  `questionid` int(11) unsigned NOT NULL,
  `question` varchar(1000) DEFAULT NULL,
  `option` varchar(1000) CHARACTER SET latin1 COLLATE latin1_spanish_ci DEFAULT NULL,
  `answer` int(1) unsigned NOT NULL DEFAULT '0',
  `explination` varchar(2000) NOT NULL,
  `challenge` int(1) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`id`, `userid`, `questionid`, `question`, `option`, `answer`, `explination`, `challenge`) VALUES
(1, 12, 1, 'king', 'raj', 0, 'dkjghfdgi', 0),
(2, 12, 1, 'king', 'ravi', 0, 'dkjghfdgi', 0),
(3, 12, 1, 'king', 'reddy', 0, 'dkjghfdgi', 0),
(4, 12, 1, 'king', 'raviraja', 0, 'dkjghfdgi', 0),
(5, 12, 1, 'king', 'kkk', 0, 'dkjghfdgi', 0),
(18, 12, 1, 'king ', 'yes', 0, '', 0),
(19, 12, 1, 'king ', 'sam', 0, '', 0),
(20, 12, 1, 'king ', 'manoj', 0, '', 0),
(21, 12, 1, 'king ', 'ravi', 0, '', 0),
(22, 12, 1, 'king ', 'pj', 1, '', 0),
(23, 12, 1, 'king', 'GOD', 0, 'DFOIGO', 1),
(24, 12, 1, 'king', 'RULER', 1, 'DFOIGO', 1);

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE IF NOT EXISTS `reports` (
  `id` int(11) unsigned NOT NULL,
  `userid` int(11) unsigned NOT NULL,
  `postid` int(11) unsigned NOT NULL,
  `report` int(2) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `userid`, `postid`, `report`) VALUES
(28, 12, 15, 1),
(29, 12, 15, 1),
(30, 12, 15, 1),
(31, 12, 15, 1),
(32, 12, 15, 1),
(33, 12, 14, 1),
(34, 12, 14, 1),
(35, 12, 8, 1),
(36, 12, 11, 1),
(37, 12, 11, 1),
(38, 12, 30, 1),
(39, 12, 70, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL,
  `username` varchar(32) DEFAULT NULL,
  `password` varchar(60) DEFAULT NULL,
  `email` text,
  `verified` tinyint(1) DEFAULT NULL,
  `profile_pic` varchar(255) NOT NULL,
  `branch` text NOT NULL,
  `college` varchar(100) NOT NULL,
  `location` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `verified`, `profile_pic`, `branch`, `college`, `location`) VALUES
(9, 'reddy', '$2y$10$vf6PuK1OqKDKoh3nDBtpveRT0R46.g40bD7jObY3Gal0KdFcz1OcW', 'reddyyeswanth246@gmail.com', 0, '', 'civil', '', ''),
(10, 'hemanth', '$2y$10$x8FUFpPa296uuVLlfTXTn.nGe8aQP1yMYG7g9A9V/3kjOdsTQG3xS', 'reddyhemanth123@gmail.com', 0, '', '', '', ''),
(11, 'sai praveen', '$2y$10$abENE3KsY8L1XLFMyl1bCOS6Og7nKzwvBO.WCFrh/P27eOog9NHD2', 'saipraveen334@gmail.com', 0, '', '', '', ''),
(12, 'raviraja', '$2y$10$icjXG/xjjm6cMEsnXVtX6uEkavOkO0Jtx6RnIxhD5h4lC2PqGACOG', 'raviraja951@gmail.com', 0, '59ccca45ad8175.13902257.jpg', 'ece', '', ''),
(13, 'suryateja', '$2y$10$a0uRmIq/fYWB8.1BrhNfIe59ebzqgyvk4T/Tl7pIMfdChYBaQM1/W', 'suryateja@gmail.com', 0, '', 'cse', '', ''),
(15, 'saipraveen2', '$2y$10$dmW6z0S5dA3Hxwn0IGzl2.Y6vegRCU2KNwfuWZohRcuBFYRO5y93u', 'saisexy@gmail.com', 0, '', 'civil', '', ''),
(16, 'nandhni', '$2y$10$7RHfug3xX9t6bSGSMbqdv.NtJqNEtYC2C2Du6Xof68DQ9K8CptHba', 'suhasini@gmail.com', 1, '59c29b35a3f3b1.83704338.jpg', 'ece', '', ''),
(17, 'nandu', '$2y$10$pljLJMuZz3c5OyfLvsTLMOsDjFnmCBuL4QG/gLv1zGAewoSYk9t9W', 'nandu@gmail.com', 1, '59c29b35a3f3b1.83704338.jpg', 'civil', '', ''),
(18, 'king', '$2y$10$FuwfxJxDTWnK9fNK1QWucODnA/t6I9hODAK244H1FD9scbe9dTbDa', 'king@gmail.com', 1, '', 'ece', '', ''),
(19, 'hai', '$2y$10$bVFLMCx491sSMh0EzuZUo.dLhcE31KQ7j2YLV1aUjKeAgC5kguiJ6', 'hai@gmail.com', 1, '', 'ece', '', ''),
(20, 'hello', '$2y$10$jFe7ABz3qNhvCyr.1s4Gz.N9/EsPtnfMH7xaLWG7kRY2YU7MQB4eO', 'hello@gmail.com', 1, '', '', '', ''),
(21, 'jjjj', '$2y$10$H5Zxm3iYLjfDIfFdUyRIS.eoyIai3fBPxK8Rd3/nQyjUqbdZVjCu6', 'jjjj@gmail.cim', 1, '', 'cse', '', ''),
(22, 'VSPJ', '$2y$10$NVcODq/4HspF4B4dArbPL.lvUvsPOCbQBejaoF.whrT1Wll4Gt0Lm', 'saiprave33@gmail.com', 1, '', 'civil', '', ''),
(23, 'sri', '$2y$10$jciRZedioJFHbNPbauaJwuMOBkKVyOFOBM9QbV6UNfJu31mjuM8OW', 'sri@gmail.com', 1, '', 'ece', '', ''),
(24, 'sweetha', '$2y$10$9nk18RtkG1vLYEtJ1cpV0.R1fMr0gKs3xq/1JVbylbAk/Xf3uT/DS', 'sweetha@gmail.com', 1, '', 'ece', '', ''),
(25, 'akka', '$2y$10$95Ffg/FTJSDcW/EOqrUV4ubmU0.UD95UGQqP6xXSfH3EzJS1PNs.u', 'akka@gmail.com', 1, '', 'cse', '', ''),
(26, 'devi', '$2y$10$xt1f.42bWLSXu7iQQER50.//VFqHT56y3nRldlf2oH9WUAcxv/pFy', 'devi@gmail.com', 1, '', 'ece', 'ttc college', 'bhattiprolu'),
(27, 'raviraj', '$2y$10$ciNkCTBQGAc/6Gw0VoNvtudLqxJMcozYrZhiW2ZJsiUFXUxjnl.CG', 'raviraja1@gmail.com', 1, '', 'mech', '', ''),
(28, 'ravir', '$2y$10$hwHeS/OmukaartlmENcEVeYESRrOYITRvROBfR5cr1xm/PqYgSiK2', 'ra@gmail.com', 1, '', ' ', '', ''),
(30, 'chella', '$2y$10$b3ljaXyWCNgwVMLcPuECTOZgkl0Cv1bRJ/QDfYd6OYNS4Sq/oQt9K', 'chella@gmail.com', 1, '', 'mech', 'rvr & jc college of engneering', 'guntur'),
(31, 'vinod', '$2y$10$ZVWEU4vJPtbN6YZqjKNA/e2A4mhuqHCb/hz5F45O2TKUJGbpn7QhO', 'goku@gmail.com', 1, '', 'ece', 'kdgsjwlhg', 'hydewde');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`), ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `followers`
--
ALTER TABLE `followers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobsdata`
--
ALTER TABLE `jobsdata`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_tokens`
--
ALTER TABLE `login_tokens`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `token` (`token`), ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_tokens`
--
ALTER TABLE `password_tokens`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `token` (`token`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`), ADD KEY `user_id` (`user_id`) USING BTREE;

--
-- Indexes for table `post_likes`
--
ALTER TABLE `post_likes`
  ADD PRIMARY KEY (`id`), ADD KEY `post_id` (`post_id`), ADD KEY `post_likes_ibfk_1` (`user_id`);

--
-- Indexes for table `profileimg`
--
ALTER TABLE `profileimg`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
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
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=52;
--
-- AUTO_INCREMENT for table `followers`
--
ALTER TABLE `followers`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=92;
--
-- AUTO_INCREMENT for table `jobsdata`
--
ALTER TABLE `jobsdata`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `login_tokens`
--
ALTER TABLE `login_tokens`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=225;
--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=112;
--
-- AUTO_INCREMENT for table `password_tokens`
--
ALTER TABLE `password_tokens`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=98;
--
-- AUTO_INCREMENT for table `post_likes`
--
ALTER TABLE `post_likes`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=130;
--
-- AUTO_INCREMENT for table `profileimg`
--
ALTER TABLE `profileimg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=40;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=32;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`);

--
-- Constraints for table `login_tokens`
--
ALTER TABLE `login_tokens`
ADD CONSTRAINT `login_tokens_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `post_likes`
--
ALTER TABLE `post_likes`
ADD CONSTRAINT `post_likes_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

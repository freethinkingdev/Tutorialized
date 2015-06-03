-- phpMyAdmin SQL Dump
-- version 3.5.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 03, 2013 at 07:08 PM
-- Server version: 5.5.29
-- PHP Version: 5.4.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `tutorialez`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nameOfTheAssignment` varchar(45) NOT NULL,
  `typeOfTheAssignment` int(11) DEFAULT NULL,
  `isItPublic` varchar(3) DEFAULT NULL,
  `closingDate` date DEFAULT NULL,
  `q1` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `assignmentsquestion`
--

CREATE TABLE `assignmentsquestion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nameOfTheAssignment` varchar(45) NOT NULL,
  `forTheCourseNumber` int(11) NOT NULL,
  `typeOfTheAssignment` int(11) NOT NULL,
  `isItPublic` varchar(3) NOT NULL,
  `closingDate` date NOT NULL,
  `q1` int(11) NOT NULL,
  `q2` int(11) DEFAULT NULL,
  `q3` int(11) DEFAULT NULL,
  `q4` int(11) DEFAULT NULL,
  `q5` int(11) DEFAULT NULL,
  `q6` int(11) DEFAULT NULL,
  `q7` int(11) DEFAULT NULL,
  `q8` int(11) DEFAULT NULL,
  `q9` int(11) DEFAULT NULL,
  `q10` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `assignmentsquestion`
--

INSERT INTO `assignmentsquestion` (`id`, `nameOfTheAssignment`, `forTheCourseNumber`, `typeOfTheAssignment`, `isItPublic`, `closingDate`, `q1`, `q2`, `q3`, `q4`, `q5`, `q6`, `q7`, `q8`, `q9`, `q10`) VALUES
(30, 'Adobe HQ', 20, 1, 'no', '0000-00-00', 23, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(31, 'Adobe again...', 20, 1, 'yes', '0000-00-00', 24, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(32, 'All', 20, 3, 'yes', '0000-00-00', 23, 24, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(33, 'All at once...', 21, 3, 'yes', '0000-00-00', 27, 28, 29, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(35, 'Adobe Animate', 20, 3, 'yes', '0000-00-00', 39, 40, 41, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `assignmenttypes`
--

CREATE TABLE `assignmenttypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `typeOfAssignment` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `assignmenttypes`
--

INSERT INTO `assignmenttypes` (`id`, `typeOfAssignment`) VALUES
(1, 'question'),
(2, 'quiz'),
(3, 'questionnaire');

-- --------------------------------------------------------

--
-- Table structure for table `courseanswers`
--

CREATE TABLE `courseanswers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `answerString` varchar(45) DEFAULT NULL,
  `answerForTheQuestionNumber` int(11) DEFAULT NULL,
  `isItValid` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=123 ;

--
-- Dumping data for table `courseanswers`
--

INSERT INTO `courseanswers` (`id`, `answerString`, `answerForTheQuestionNumber`, `isItValid`) VALUES
(72, 'True', 23, 0),
(73, 'False', 23, 1),
(74, 'IOS 6', 24, 0),
(75, 'Edge Animate', 24, 1),
(76, 'Photoshop', 24, 1),
(77, 'Windows 7', 24, 0),
(78, 'No', 25, 0),
(79, 'Yes', 25, 1),
(80, '1GB', 26, 0),
(81, '2GB', 26, 1),
(82, '4GB', 26, 0),
(83, 'No', 27, 1),
(84, 'Yes', 27, 0),
(85, 'February', 28, 0),
(86, 'June', 28, 0),
(87, 'December', 28, 0),
(88, 'May', 28, 1),
(89, '14/02/2004', 29, 0),
(90, '20/06/2012', 29, 0),
(91, '15/05/2011', 29, 1),
(92, '10/08/2009', 29, 0),
(113, 'Adobe Flash Professional', 39, 1),
(114, 'Flash builder', 39, 0),
(115, 'Adobe After Effects', 39, 1),
(116, 'Microsoft .NET', 39, 0),
(117, 'IOS 6', 40, 1),
(118, 'Edge Animate', 40, 0),
(119, 'Photoshop', 40, 0),
(120, 'Windows 7', 40, 1),
(121, 'True', 41, 0),
(122, 'False', 41, 1);

-- --------------------------------------------------------

--
-- Table structure for table `coursecontent`
--

CREATE TABLE `coursecontent` (
  `ifOfCourseContent` int(11) NOT NULL AUTO_INCREMENT,
  `nameOfTheContent` varchar(45) NOT NULL,
  `filePath` varchar(200) NOT NULL,
  `contentForTheCourseID` int(11) NOT NULL,
  PRIMARY KEY (`ifOfCourseContent`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `coursecontent`
--

INSERT INTO `coursecontent` (`ifOfCourseContent`, `nameOfTheContent`, `filePath`, `contentForTheCourseID`) VALUES
(13, 'responsiveweb.jpg', 'CourseData/Skeleton CSS/responsiveweb.jpg', 16),
(14, 'Capture.PNG', 'CourseData/Adobe Edge/Capture.PNG', 15),
(15, 'Capture.PNG', 'CourseData/Adobe Edge/Capture.PNG', 20),
(40, 'Screen Shot 2012-11-02 at 19.03.27.png', 'CourseData/Adobe Edge/Screen Shot 2012-11-02 at 19.03.27.png', 20),
(41, 'Capture.PNG', 'CourseData/Skeleton CSS/Capture.PNG', 21);

-- --------------------------------------------------------

--
-- Table structure for table `coursequestions`
--

CREATE TABLE `coursequestions` (
  `idOfQuestion` int(11) NOT NULL AUTO_INCREMENT,
  `questionString` varchar(100) DEFAULT NULL,
  `questionForTheCourseNumber` int(11) NOT NULL,
  `typeOfTheQuestion` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`idOfQuestion`),
  UNIQUE KEY `questionString_UNIQUE` (`questionString`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `coursequestions`
--

INSERT INTO `coursequestions` (`idOfQuestion`, `questionString`, `questionForTheCourseNumber`, `typeOfTheQuestion`) VALUES
(23, 'Adobe HQ is located in Albania.', 20, 4),
(24, 'Which software was made by Adobe?', 20, 2),
(25, 'Can you preview css files in Edge Code Preview?', 20, 3),
(26, 'What is the minimal RAM requirement for Edge Reflow?', 20, 3),
(27, 'Was Skeleton used to make PeerWise web site?', 21, 3),
(28, 'In which month was Apples touch icons added to the Skeleton framework?', 21, 2),
(29, 'When was the initial release of Skeleton?', 21, 3),
(39, 'To which program, Adobe Edge Animate is similar to?', 20, 2),
(40, 'Which software was not made by Adobe?', 20, 3),
(41, 'Main Adobe HQ is located in Glasgow. True or false?', 20, 4);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `idOfTheCourse` int(11) NOT NULL AUTO_INCREMENT,
  `nameOfTheCourse` varchar(45) NOT NULL,
  `descriptionOfTheCourse` text NOT NULL,
  PRIMARY KEY (`idOfTheCourse`),
  UNIQUE KEY `nameOfTheCourse_UNIQUE` (`nameOfTheCourse`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`idOfTheCourse`, `nameOfTheCourse`, `descriptionOfTheCourse`) VALUES
(20, 'Adobe Edge', 'Learn JavaScript animation'),
(21, 'Skeleton CSS', 'Skeleton css');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` smallint(2) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(10) NOT NULL,
  `last_name` varchar(15) NOT NULL,
  `email` varchar(20) NOT NULL,
  `username` varchar(10) NOT NULL,
  `password` varchar(32) NOT NULL,
  `date_signed` date NOT NULL,
  `role` int(1) NOT NULL,
  `course` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  KEY `role` (`role`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `first_name`, `last_name`, `email`, `username`, `password`, `date_signed`, `role`, `course`) VALUES
(1, 'Marcin', 'Wuu', 'w.marcin@yahoo.co.uk', 'marcinw', '5f4dcc3b5aa765d61d8327deb882cf99', '2012-10-18', 1, NULL),
(2, 'Iwona', 'Grabi', 'grabo@gmail.com', 'iwka', 'd097be9bcc917331e1cb526e09a4ac5a', '2012-10-18', 3, NULL),
(3, 'Johnatan', 'Smithe', 'smith@calteces.com', 'jSmith', '5b57221ec6e2ee0a755547717ee460eb', '2012-10-18', 3, NULL),
(4, 'Anna', 'Donner', 'dona@anna.com', 'ado', '500711d41246f7b9b5002f9893f66214', '2012-10-18', 2, NULL),
(34, 'Maja', 'Wiezbowska', 'majka3@gmail.com', 'adoo', '6a01bfa30172639e770a6aacb78a3ed4', '2013-02-13', 3, NULL),
(35, 'Marki', 'Wiliabcdef', 'demo@wp.pl', 'demo', 'fe01ce2a7fbac8fafaed7c982a04e229', '2013-03-11', 3, NULL),
(36, 'Mathew', 'Smith', 'demo1@demo.com', 'demo1', 'e368b9938746fa090d6afd3628355133', '2013-03-24', 3, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `questiontypes`
--

CREATE TABLE `questiontypes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `questiontypes`
--

INSERT INTO `questiontypes` (`id`, `type`) VALUES
(1, 'likert'),
(2, 'multiplechoice'),
(3, 'onechoice'),
(4, 'true/false');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `idOfRole` int(11) NOT NULL AUTO_INCREMENT,
  `role` text NOT NULL,
  PRIMARY KEY (`idOfRole`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`idOfRole`, `role`) VALUES
(1, 'admin'),
(2, 'author'),
(3, 'user');

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(10) DEFAULT NULL,
  `surname` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`id`, `name`, `surname`) VALUES
(1, 'maricn', 'w'),
(2, 'iwona', 'gie'),
(4, 'darek', 'azor');

-- --------------------------------------------------------

--
-- Table structure for table `userans`
--

CREATE TABLE `userans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idOfUser` int(11) NOT NULL,
  `idOfAssignment` int(11) NOT NULL,
  `idOfQuestion` int(11) NOT NULL,
  `validAnswerId` int(11) DEFAULT NULL,
  `userAnswerId` int(11) DEFAULT NULL,
  `isUserAnswerValid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=513 ;

--
-- Dumping data for table `userans`
--

INSERT INTO `userans` (`id`, `idOfUser`, `idOfAssignment`, `idOfQuestion`, `validAnswerId`, `userAnswerId`, `isUserAnswerValid`) VALUES
(465, 3, 32, 23, 0, 72, 0),
(466, 3, 32, 23, 73, 0, 0),
(467, 3, 32, 24, 0, 75, 1),
(468, 3, 32, 24, 75, 76, 1),
(469, 3, 32, 24, 76, 0, 0),
(470, 3, 32, 24, 0, 0, 0),
(471, 2, 32, 23, 0, 73, 1),
(472, 2, 32, 23, 73, 0, 0),
(473, 2, 32, 24, 0, 74, 0),
(474, 2, 32, 24, 75, 75, 1),
(475, 2, 32, 24, 76, 76, 1),
(476, 2, 32, 24, 0, 0, 0),
(477, 3, 33, 27, 83, 84, 0),
(478, 3, 33, 27, 0, 0, 0),
(479, 3, 33, 28, 0, 87, 0),
(480, 3, 33, 28, 0, 0, 0),
(481, 3, 33, 28, 0, 0, 0),
(482, 3, 33, 28, 88, 0, 0),
(483, 3, 33, 29, 0, 90, 0),
(484, 3, 33, 29, 0, 0, 0),
(485, 3, 33, 29, 91, 0, 0),
(486, 3, 33, 29, 0, 0, 0),
(493, 36, 32, 23, 0, 72, 0),
(494, 36, 32, 23, 73, 0, 0),
(495, 36, 32, 24, 0, 74, 0),
(496, 36, 32, 24, 75, 75, 1),
(497, 36, 32, 24, 76, 76, 1),
(498, 36, 32, 24, 0, 0, 0),
(499, 2, 35, 39, 113, 113, 1),
(500, 2, 35, 39, 0, 114, 0),
(501, 2, 35, 39, 115, 116, 0),
(502, 2, 35, 39, 0, 0, 0),
(503, 2, 35, 40, 117, 120, 1),
(504, 2, 35, 40, 0, 0, 0),
(505, 2, 35, 40, 0, 0, 0),
(506, 2, 35, 40, 120, 0, 0),
(507, 2, 35, 41, 0, 122, 1),
(508, 2, 35, 41, 122, 0, 0),
(509, 2, 31, 24, 0, 0, 0),
(510, 2, 31, 24, 75, 0, 0),
(511, 2, 31, 24, 76, 0, 0),
(512, 2, 31, 24, 0, 0, 0);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `members_ibfk_1` FOREIGN KEY (`role`) REFERENCES `roles` (`idOfRole`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

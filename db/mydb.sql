-- phpMyAdmin SQL Dump
-- version 4.3.13.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 02, 2015 at 05:25 PM
-- Server version: 5.6.25
-- PHP Version: 5.5.14

drop schema if exists `mydb` ;

create schema `mydb`;
use `mydb`;


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `mydb`
--

-- --------------------------------------------------------

--
-- Table structure for table `USERS`
--

CREATE TABLE IF NOT EXISTS `USERS` (
  `User_id` int(11) NOT NULL,
  `User_name` varchar(45) DEFAULT NULL,
  `User_pwd` varchar(150) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `User_Acc` float DEFAULT NULL,
  `User_email` varchar(45) DEFAULT NULL,
  `checkone` int(11) NOT NULL,
  `checktwo` int(11) NOT NULL,
  `checkthree` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `USERS`
--

INSERT INTO `USERS` (`User_id`, `User_name`, `User_pwd`, `image`, `User_Acc`, `User_email`, `checkone`, `checktwo`, `checkthree`) VALUES
(22, 'test', '$2y$10$PCsLZP5Ds8umz5hFauA.WOSWrPefk/yTpcfMLFcCHhi.58WDo.fa6', 'default.jpg', 33, 'test@test.com', 1, 3, 1),
(23, 'a''', '$2y$10$EUiKHsgFZswHw9.sl4fkm.iWgybkTwTpU3DIGst7gbrlDo2dOEfny', 'default.jpg', 66, 'fdfd@ff.comff', 6, 10, 5),
(24, 'a', '$2y$10$mPO93InErX2kWXgZrRdWo.lfFyDzUq2lOpPqTRtT/S7cPd3siNf0W', 'default.jpg', 0, 'f2ff@fdf.cn', 7, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `USERWORD`
--

CREATE TABLE IF NOT EXISTS `USERWORD` (
  `id` int(10) unsigned zerofill NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `word_id` int(11) DEFAULT NULL,
  `state` int(45) DEFAULT NULL,
  `class` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=245 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `USERWORD`
--

INSERT INTO `USERWORD` (`id`, `user_id`, `word_id`, `state`, `class`) VALUES
(0000000208, 23, 2, 2, 1),
(0000000209, 23, 5, 1, 1),
(0000000210, 23, 6, 1, 1),
(0000000211, 23, 7, 2, 1),
(0000000212, 23, 8, 3, 1),
(0000000213, 23, 18, 3, 2),
(0000000214, 23, 19, 2, 2),
(0000000215, 23, 20, 2, 2),
(0000000216, 23, 22, 1, 3),
(0000000217, 23, 23, 1, 3),
(0000000218, 23, 24, 1, 3),
(0000000219, 23, 25, 1, 3),
(0000000230, 22, 12, 1, 2),
(0000000231, 22, 13, 1, 2),
(0000000232, 22, 14, 1, 2),
(0000000233, 22, 15, 1, 2),
(0000000234, 24, 2, 2, 1),
(0000000235, 24, 5, 1, 1),
(0000000236, 24, 6, 2, 1),
(0000000237, 24, 7, 3, 1),
(0000000238, 24, 8, 3, 1),
(0000000239, 24, 3, 1, 1),
(0000000240, 24, 12, 3, 2),
(0000000241, 24, 13, 1, 2),
(0000000242, 24, 14, 3, 2),
(0000000243, 24, 15, 3, 2),
(0000000244, 24, 16, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `WORDS`
--

CREATE TABLE IF NOT EXISTS `WORDS` (
  `Words_id` int(11) NOT NULL,
  `word` varchar(45) DEFAULT NULL,
  `word_def` varchar(200) DEFAULT NULL,
  `classification` int(11) DEFAULT NULL,
  `classSequID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `WORDS`
--

INSERT INTO `WORDS` (`Words_id`, `word`, `word_def`, `classification`, `classSequID`) VALUES
(1, 'actress', 'a female actor.', 1, 1),
(2, 'address', 'the particulars of the place where someone lives or an organization is situated.', 1, 2),
(3, 'airport', 'a complex of runways and buildings for the takeoff, landing, and maintenance of civil aircraft, with facilities for passengers.', 1, 7),
(4, 'xiaomi', 'Chinese mobile phone''s brand', 1, 8),
(5, 'cartoon', 'a motion picture using animation techniques to photograph a sequence of drawings rather than real people or objects.', 1, 3),
(6, 'cousin', 'a child of one''s uncle or aunt.', 1, 4),
(7, 'dizzy', 'having or involving a sensation of spinning around and losing one''s balance.', 1, 5),
(8, 'examine', 'test the knowledge or proficiency of (someone) by requiring them to answer questions or perform tasks.', 1, 6),
(9, 'future', 'at a later time; going or likely to happen or exist.', 1, 9),
(10, 'mention', 'a reference to someone or something.', 1, 10),
(11, 'biology', 'the study of living organisms, divided into many specialized fields that cover their morphology, physiology, anatomy, behavior, origin, and distribution.', 2, 1),
(12, 'breathe', 'take air into the lungs and then expel it, especially as a regular physiological process.', 2, 2),
(13, 'church', 'a building used for public Christian worship.', 2, 3),
(14, 'cause', 'a person or thing that gives rise to an action, phenomenon, or condition.', 2, 4),
(15, 'disturb', 'interfere with the normal arrangement or functioning of.', 2, 5),
(16, 'downstairs', 'down a flight of stairs.', 2, 6),
(17, 'congratulate', 'give (someone) one''s good wishes when something special or pleasant has happened to them.', 2, 7),
(18, 'crowded', ' full of people, leaving little or no room for movement; packed.', 2, 8),
(19, 'fragile', '(of an object) easily broken or damaged.', 2, 9),
(20, 'frighten', 'make (someone) afraid or anxious.', 2, 10),
(21, 'electricity', 'a form of energy resulting from the existence of charged particles (such as electrons or protons), either statically as an accumulation of charge or dynamically as a current.', 3, 1),
(22, 'lively', 'full of life and energy; active and outgoing.', 3, 2),
(23, 'ascend', 'go up or climb.', 3, 3),
(24, 'arrangement', 'he action, process, or result of arranging or being arranged.', 3, 4),
(25, 'audience', 'the assembled spectators or listeners at a public event, such as a play, movie, concert, or meeting.', 3, 5),
(26, 'average', 'constituting the result obtained by adding together several quantities and then dividing this total by the number of quantities.', 3, 6),
(27, 'championship', 'a contest for the position of champion in a sport, often involving a series of games or matches.', 3, 7),
(28, 'canned', '(of food or drink) preserved or supplied in a sealed can.', 3, 8),
(29, 'conquer', 'overcome and take control of (a place or people) by use of military force.', 3, 9),
(30, 'constant', 'occurring continuously over a period of time.', 3, 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `USERS`
--
ALTER TABLE `USERS`
  ADD PRIMARY KEY (`User_id`);

--
-- Indexes for table `USERWORD`
--
ALTER TABLE `USERWORD`
  ADD PRIMARY KEY (`id`), ADD KEY `fk_uw_id_idx` (`user_id`);

--
-- Indexes for table `WORDS`
--
ALTER TABLE `WORDS`
  ADD PRIMARY KEY (`Words_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `USERS`
--
ALTER TABLE `USERS`
  MODIFY `User_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `USERWORD`
--
ALTER TABLE `USERWORD`
  MODIFY `id` int(10) unsigned zerofill NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=245;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `USERWORD`
--
ALTER TABLE `USERWORD`
ADD CONSTRAINT `fk_uw_id` FOREIGN KEY (`user_id`) REFERENCES `USERS` (`User_id`) ON DELETE CASCADE ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

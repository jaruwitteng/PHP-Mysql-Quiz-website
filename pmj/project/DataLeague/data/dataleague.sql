-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dataleague`
--

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `clubs`
--

CREATE TABLE IF NOT EXISTS `clubs` (
  `club_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `league` varchar(3) DEFAULT NULL,
  `club_name` varchar(100) DEFAULT NULL,
  `logo` varchar(50) DEFAULT NULL,
  `played` tinyint(3) unsigned NOT NULL,
  `won` tinyint(3) unsigned NOT NULL,
  `drawn` tinyint(3) unsigned NOT NULL,
  `lost` tinyint(3) unsigned NOT NULL,
  `points` tinyint(4) NOT NULL,
  `goals_for` tinyint(3) unsigned NOT NULL,
  `goals_against` tinyint(3) unsigned NOT NULL,
  `goals_diff` tinyint(4) NOT NULL,
  PRIMARY KEY (`club_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- dump ตาราง `clubs`
--

INSERT INTO `clubs` (`club_id`, `league`, `club_name`, `logo`, `played`, `won`, `drawn`, `lost`, `points`, `goals_for`, `goals_against`, `goals_diff`) VALUES
(1, 'pm', 'Sunderland', 'pm20140331130343.png', 2, 0, 1, 1, 1, 1, 2, -1),
(2, 'pm', 'Manchester United', 'pm20140331133706.png', 2, 1, 0, 1, 3, 4, 3, 1),
(3, 'pm', 'Arsenal', 'pm20140331135219.png', 2, 1, 1, 0, 4, 7, 4, 3),
(4, 'pm', 'Liverpool', 'pm20140331135526.png', 2, 2, 0, 0, 6, 6, 4, 2),
(5, 'la', 'Real Madrid', 'la20140331135813.png', 1, 1, 0, 0, 3, 3, 1, 2),
(6, 'la', 'Barcelona', 'la20140331135850.png', 1, 1, 0, 0, 3, 4, 2, 2),
(7, 'bd', 'Bayern Munich', 'bd20140331145229.png', 0, 0, 0, 0, 0, 0, 0, 0),
(8, 'sa', 'Juventus', 'sa20140331164823.png', 0, 0, 0, 0, 0, 0, 0, 0),
(19, 'pm', 'Newcastle', 'pm20140409110531.png', 2, 0, 0, 2, 0, 0, 3, -3),
(10, 'sa', 'Napoli', 'sa20140406125407.png', 0, 0, 0, 0, 0, 0, 0, 0),
(11, 'pm', 'Manchester City', 'pm20140407152001.png', 2, 1, 0, 1, 3, 5, 5, 0),
(23, 'pm', 'Chelsea', 'pm20140423085312.png', 2, 1, 1, 0, 4, 6, 4, 2),
(13, 'pm', 'Everton', 'pm20140407152044.png', 2, 0, 0, 2, 0, 3, 6, -3),
(14, 'pm', 'West Ham', 'pm20140407152407.png', 2, 1, 0, 1, 3, 3, 5, -2),
(17, 'pm', 'Spur', 'pm20140407184138.png', 2, 1, 1, 0, 4, 1, 0, 1),
(22, 'la', 'Atletico Madrid', 'la20140410154346.png', 1, 0, 0, 1, 0, 2, 4, -2),
(21, 'la', 'Valencia', 'la20140410152932.png', 1, 0, 0, 1, 0, 1, 3, -2);

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `matches`
--

CREATE TABLE IF NOT EXISTS `matches` (
  `match_id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `match_datetime` datetime DEFAULT NULL,
  `league` varchar(3) DEFAULT NULL,
  `home_id` smallint(6) DEFAULT NULL,
  `away_id` smallint(6) DEFAULT NULL,
  `watch` varchar(250) DEFAULT NULL,
  `home_goals` tinyint(4) DEFAULT NULL,
  `away_goals` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`match_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=46 ;

--
-- dump ตาราง `matches`
--

INSERT INTO `matches` (`match_id`, `match_datetime`, `league`, `home_id`, `away_id`, `watch`, `home_goals`, `away_goals`) VALUES
(25, '2014-04-23 01:00:00', 'pm', 23, 13, '', 3, 1),
(24, '2014-04-16 01:45:00', 'pm', 1, 14, '', 1, 2),
(23, '2014-04-16 02:00:00', 'pm', 19, 17, '', 0, 1),
(6, '2014-04-09 01:00:00', 'sa', 8, 10, '', NULL, NULL),
(45, '2014-04-30 01:30:00', 'la', 6, 5, '', NULL, NULL),
(44, '2014-04-30 01:30:00', 'la', 21, 22, '', NULL, NULL),
(22, '2014-04-16 01:45:00', 'pm', 11, 2, 'Real Sport 555', 3, 2),
(21, '2014-04-16 01:30:00', 'pm', 13, 4, '', 2, 3),
(20, '2014-04-16 01:30:00', 'pm', 3, 23, 'True Football 999', 3, 3),
(26, '2014-04-23 01:30:00', 'pm', 4, 11, 'à¸Šà¹ˆà¸­à¸‡ 333', 3, 2),
(27, '2014-04-23 01:30:00', 'pm', 2, 19, '', 2, 0),
(28, '2014-04-23 02:00:00', 'pm', 17, 1, '', 0, 0),
(29, '2014-04-23 01:45:00', 'pm', 14, 3, '', 1, 4),
(30, '2014-04-30 01:30:00', 'pm', 23, 11, 'à¸Šà¹ˆà¸­à¸‡ 123, 456', NULL, NULL),
(31, '2014-04-30 01:45:00', 'pm', 13, 14, '', NULL, NULL),
(32, '2014-04-30 01:30:00', 'pm', 19, 3, '', NULL, NULL),
(33, '2014-04-30 01:30:00', 'pm', 1, 17, '', NULL, NULL),
(34, '2014-04-30 02:00:00', 'pm', 2, 4, 'à¸Šà¹ˆà¸­à¸‡ 333, 555', NULL, NULL),
(43, '2014-04-23 01:00:00', 'la', 5, 21, '', 3, 1),
(42, '2014-04-23 01:00:00', 'la', 22, 6, '', 2, 4);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

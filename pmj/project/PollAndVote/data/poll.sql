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
-- Database: `poll`
--

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `poll_choice`
--

CREATE TABLE IF NOT EXISTS `poll_choice` (
  `choice_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `topic_id` smallint(5) unsigned DEFAULT NULL,
  `choice_text` varchar(250) DEFAULT NULL,
  `score` mediumint(8) unsigned DEFAULT NULL,
  `graph_color` varchar(7) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- dump ตาราง `poll_choice`
--

INSERT INTO `poll_choice` (`choice_id`, `topic_id`, `choice_text`, `score`, `graph_color`) VALUES
(11, 4, 'à¸›à¹ˆà¸²à¹€à¸‚à¸²', 0, '#00b900'),
(4, 3, 'à¹à¸¡à¸™à¸¢à¸¹', 2, '#ff0000'),
(5, 3, 'à¸¥à¸´à¹€à¸§à¸­à¸£à¹Œà¸žà¸¹à¸¥', 2, '#ff8000'),
(6, 3, 'à¹€à¸Šà¸¥à¸‹à¸µ', 4, '#0000a0'),
(7, 3, 'à¸­à¸²à¸£à¹Œà¹€à¸‹à¸™à¸­à¸¥', 8, '#008000'),
(8, 3, 'à¹à¸¡à¸™à¸‹à¸´à¸•à¸µà¹‰', 3, '#ff0080'),
(10, 4, 'à¸™à¹‰à¸³à¸•à¸', 0, '#ffffff'),
(9, 4, 'à¸—à¸°à¹€à¸¥', 0, '#2d96ff'),
(12, 4, 'à¸ªà¸§à¸™à¸ªà¸±à¸•à¸§à¹Œ', 0, '#a2a2a2'),
(13, 5, 'IE', 0, '#0080ff'),
(14, 5, 'Firefox', 0, '#ff8000'),
(15, 5, 'Chrome', 0, '#00ff00'),
(16, 5, 'Safari', 0, '#8080ff'),
(17, 5, 'Opera', 0, '#ff0080');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `poll_ip`
--

CREATE TABLE IF NOT EXISTS `poll_ip` (
  `topic_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `ip` varchar(15) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- dump ตาราง `poll_ip`
--

INSERT INTO `poll_ip` (`topic_id`, `ip`) VALUES
(3, '108.81.141.137'),
(3, '124.26.102.80'),
(3, '126.154.190.9'),
(3, '15.192.30.82'),
(3, '161.104.192.147'),
(3, '162.26.203.182'),
(3, '177.45.100.194'),
(3, '18.190.130.107'),
(3, '184.30.87.147'),
(3, '192.245.240.47'),
(3, '195.190.108.71'),
(3, '204.46.183.209'),
(3, '209.158.6.145'),
(3, '219.111.52.98'),
(3, '236.181.126.60'),
(3, '244.68.64.211'),
(3, '254.156.127.130'),
(3, '46.104.67.111'),
(3, '67.102.179.14');

-- --------------------------------------------------------

--
-- โครงสร้างตาราง `poll_topic`
--

CREATE TABLE IF NOT EXISTS `poll_topic` (
  `topic_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `topic_text` varchar(250) DEFAULT NULL,
  `status` set('active','inactive') DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- dump ตาราง `poll_topic`
--

INSERT INTO `poll_topic` (`topic_id`, `topic_text`, `status`) VALUES
(4, 'à¸—à¹ˆà¸²à¸™à¸­à¸¢à¸²à¸à¹„à¸›à¹€à¸—à¸µà¹ˆà¸¢à¸§à¸—à¸µà¹ˆà¹ƒà¸”à¸¡à¸²à¸à¸—à¸µà¹ˆà¸ªà¸¸à¸”', 'inactive'),
(3, 'à¸—à¸µà¸¡à¹ƒà¸”à¸™à¹ˆà¸²à¸ˆà¸°à¹„à¸”à¹‰à¹à¸Šà¸¡à¸›à¹Œà¸žà¸£à¸µà¹€à¸¡à¸µà¸¢à¸£à¹Œà¸¥à¸µà¸', 'active'),
(5, 'à¸—à¹ˆà¸²à¸™à¹ƒà¸Šà¹‰à¹€à¸§à¹‡à¸šà¹€à¸šà¸£à¸²à¹€à¸‹à¸­à¸£à¹Œà¹ƒà¸”à¹€à¸›à¹‡à¸™à¸«à¸¥à¸±à¸', 'inactive');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

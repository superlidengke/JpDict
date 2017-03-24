-- phpMyAdmin SQL Dump
-- version phpStudy 2014
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 01, 2016 at 02:15 PM
-- Server version: 5.5.38
-- PHP Version: 5.3.29

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `jpword`
--

-- --------------------------------------------------------

--
-- Table structure for table `dict_simple_meaning`
--

CREATE TABLE IF NOT EXISTS `dict_simple_meaning` (
  `id` char(32) NOT NULL,
  `meaning` longtext NOT NULL COMMENT '解析后的意思',
  `html` longtext NOT NULL COMMENT '从网上得到的原始数据',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='单词的简单解释';

-- --------------------------------------------------------

--
-- Table structure for table `dict_std_meaning`
--

CREATE TABLE IF NOT EXISTS `dict_std_meaning` (
  `id` char(32) NOT NULL,
  `meaning` longtext NOT NULL COMMENT '解析后的意思',
  `html` longtext NOT NULL COMMENT '从网上得到的原始数据',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='标准解释';

-- --------------------------------------------------------

--
-- Table structure for table `dict_todo`
--

CREATE TABLE IF NOT EXISTS `dict_todo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `isDone` tinyint(1) NOT NULL DEFAULT '0',
  `isFound` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否查到解释',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `dict_words`
--

CREATE TABLE IF NOT EXISTS `dict_words` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `simple_id` char(32) NOT NULL COMMENT '简单解释的id',
  `standard_id` char(32) NOT NULL COMMENT '标准解释的id',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='字典所有的词' AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

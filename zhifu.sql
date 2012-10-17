-- phpMyAdmin SQL Dump
-- version 3.3.10.4
-- http://www.phpmyadmin.net
--
-- 主机: mysql.91jishu.cn
-- 生成日期: 2012 年 10 月 17 日 07:17
-- 服务器版本: 5.1.53
-- PHP 版本: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `91jishu`
--

-- --------------------------------------------------------

--
-- 表的结构 `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `flag` tinyint(4) DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `limit` int(11) DEFAULT NULL,
  `lastlogin` datetime DEFAULT NULL,
  `lastip` varchar(100) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `applys`
--

CREATE TABLE IF NOT EXISTS `applys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `identity` tinyint(4) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `sex` tinyint(4) DEFAULT NULL,
  `age` tinyint(4) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `degree` tinyint(4) DEFAULT NULL,
  `year` tinyint(4) DEFAULT NULL,
  `description` text,
  `evaluate` text,
  `available` varchar(255) DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `belong` int(11) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `articles`
--

CREATE TABLE IF NOT EXISTS `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `content` text,
  `admin` int(11) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `click` int(11) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `lastmodify` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `categorys`
--

CREATE TABLE IF NOT EXISTS `categorys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `parent` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `object` int(11) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `user` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `user_type` varchar(20) DEFAULT NULL,
  `content` varchar(511) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `companys`
--

CREATE TABLE IF NOT EXISTS `companys` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `contact` varchar(255) DEFAULT NULL,
  `description` text,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `budget` double DEFAULT NULL,
  `rate_total` int(11) DEFAULT NULL,
  `rate_num` int(11) DEFAULT NULL,
  `license` varchar(255) DEFAULT NULL,
  `verified` tinyint(4) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `lastlogin` datetime DEFAULT NULL,
  `lastip` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `deals`
--

CREATE TABLE IF NOT EXISTS `deals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patent` int(11) DEFAULT NULL,
  `pname` varchar(255) DEFAULT NULL,
  `belong` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `experts`
--

CREATE TABLE IF NOT EXISTS `experts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `workplace` varchar(255) DEFAULT NULL,
  `job` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `budget` double DEFAULT NULL,
  `rate_total` int(11) DEFAULT NULL,
  `rate_num` int(11) DEFAULT NULL,
  `verified` tinyint(4) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `lastlogin` datetime DEFAULT NULL,
  `lastip` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `files`
--

CREATE TABLE IF NOT EXISTS `files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `path` varchar(255) DEFAULT NULL,
  `belong` int(11) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `ideas`
--

CREATE TABLE IF NOT EXISTS `ideas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `cat` smallint(6) DEFAULT NULL,
  `subcat` smallint(6) DEFAULT NULL,
  `budget` double DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `description` text,
  `one` tinyint(4) DEFAULT NULL,
  `one_m` double DEFAULT NULL,
  `two` tinyint(4) DEFAULT NULL,
  `two_m` double DEFAULT NULL,
  `three` tinyint(4) DEFAULT NULL,
  `three_m` double DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `closed` tinyint(4) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `lastmodify` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `idea_items`
--

CREATE TABLE IF NOT EXISTS `idea_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idea` int(11) DEFAULT NULL,
  `pname` varchar(255) DEFAULT NULL,
  `expert` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content` text,
  `status` tinyint(4) DEFAULT NULL,
  `c_score` tinyint(4) DEFAULT NULL,
  `c_comment` varchar(255) DEFAULT NULL,
  `e_score` tinyint(4) DEFAULT NULL,
  `e_comment` varchar(255) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `links`
--

CREATE TABLE IF NOT EXISTS `links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `order` tinyint(4) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `logs`
--

CREATE TABLE IF NOT EXISTS `logs` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `admin` int(11) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `type` tinyint(4) DEFAULT NULL,
  `ip` varchar(100) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `content` text,
  `read` tinyint(4) DEFAULT NULL,
  `from` int(11) DEFAULT NULL,
  `from_type` varchar(20) DEFAULT NULL,
  `from_name` varchar(255) DEFAULT NULL,
  `from_author` varchar(255) DEFAULT NULL,
  `to` int(11) DEFAULT NULL,
  `to_type` varchar(20) DEFAULT NULL,
  `to_name` varchar(255) DEFAULT NULL,
  `to_author` varchar(255) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `options`
--

CREATE TABLE IF NOT EXISTS `options` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `value` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `patents`
--

CREATE TABLE IF NOT EXISTS `patents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat` smallint(6) DEFAULT NULL,
  `subcat` smallint(6) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `pid` varchar(255) DEFAULT NULL,
  `budget` double DEFAULT NULL,
  `description` text,
  `phone` varchar(20) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `app` tinyint(4) DEFAULT NULL,
  `skill` tinyint(4) DEFAULT NULL,
  `example` tinyint(4) DEFAULT NULL,
  `kind` tinyint(4) DEFAULT NULL,
  `transfer` tinyint(4) DEFAULT NULL,
  `owner` tinyint(4) DEFAULT NULL,
  `expert` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `lastmodify` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `pay`
--

CREATE TABLE IF NOT EXISTS `pay` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `belong` int(11) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `kind` varchar(20) DEFAULT NULL,
  `method` varchar(20) DEFAULT NULL,
  `paid` double DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `problems`
--

CREATE TABLE IF NOT EXISTS `problems` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cat` smallint(6) DEFAULT NULL,
  `subcat` smallint(6) DEFAULT NULL,
  `province` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `district` varchar(50) DEFAULT NULL,
  `budget` double DEFAULT NULL,
  `deadline` date DEFAULT NULL,
  `company` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `description` text,
  `status` tinyint(4) DEFAULT NULL,
  `closed` tinyint(4) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `verify` tinyint(4) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `lastmodify` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `recruits`
--

CREATE TABLE IF NOT EXISTS `recruits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `num` int(4) DEFAULT NULL,
  `identity` tinyint(4) DEFAULT NULL,
  `specialty` varchar(255) DEFAULT NULL,
  `area` varchar(255) DEFAULT NULL,
  `degree` tinyint(4) DEFAULT NULL,
  `pay` varchar(255) DEFAULT NULL,
  `age` varchar(255) DEFAULT NULL,
  `eatroom` tinyint(4) DEFAULT NULL,
  `description` text,
  `belong` int(11) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `recruit_items`
--

CREATE TABLE IF NOT EXISTS `recruit_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `recruit` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `sex` tinyint(4) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `belong` int(11) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `resume` varchar(255) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `reset_code`
--

CREATE TABLE IF NOT EXISTS `reset_code` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) DEFAULT NULL,
  `type` varchar(10) DEFAULT NULL,
  `code` varchar(32) DEFAULT NULL,
  `time` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `solutions`
--

CREATE TABLE IF NOT EXISTS `solutions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `problem` int(11) DEFAULT NULL,
  `pname` varchar(255) DEFAULT NULL,
  `expert` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `c_score` tinyint(4) DEFAULT NULL,
  `c_comment` varchar(255) DEFAULT NULL,
  `e_score` tinyint(4) DEFAULT NULL,
  `e_comment` varchar(255) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `count` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `tag_items`
--

CREATE TABLE IF NOT EXISTS `tag_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag` bigint(20) DEFAULT NULL,
  `belong` int(11) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `topics`
--

CREATE TABLE IF NOT EXISTS `topics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `content` text,
  `parent` int(11) DEFAULT NULL,
  `comments` int(11) DEFAULT NULL,
  `belong` int(11) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `videos`
--

CREATE TABLE IF NOT EXISTS `videos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `desc` varchar(511) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `click` int(11) DEFAULT NULL,
  `belong` int(11) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `words`
--

CREATE TABLE IF NOT EXISTS `words` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8;


--
-- 数据库: `local`
--
CREATE DATABASE `local` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `local`;

-- --------------------------------------------------------

--
-- 表的结构 `big_category`
--

CREATE TABLE IF NOT EXISTS `big_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `index` smallint(3) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- 表的结构 `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `big_category` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `index` smallint(3) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `big_category` (`big_category`,`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- 表的结构 `city`
--

CREATE TABLE IF NOT EXISTS `city` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `province` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `index` smallint(3) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `province` (`province`,`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `district`
--

CREATE TABLE IF NOT EXISTS `district` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `city` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `index` smallint(3) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `city` (`city`,`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- 表的结构 `province`
--

CREATE TABLE IF NOT EXISTS `province` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `index` smallint(3) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `shop`
--

CREATE TABLE IF NOT EXISTS `shop` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category` int(10) unsigned NOT NULL,
  `type` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `latilongi` char(22) NOT NULL,
  `latitude` decimal(9,6) NOT NULL,
  `longitude` decimal(9,6) NOT NULL,
  `district` int(10) unsigned NOT NULL,
  `phone` varchar(20) NOT NULL,
  `average` decimal(10,2) unsigned NOT NULL,
  `address` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- 表的结构 `shop_image`
--

CREATE TABLE IF NOT EXISTS `shop_image` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `shop` int(10) unsigned NOT NULL,
  `src` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- 表的结构 `type`
--

CREATE TABLE IF NOT EXISTS `type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `big_category` int(10) unsigned NOT NULL,
  `name` varchar(50) NOT NULL,
  `index` smallint(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(20) NOT NULL,
  `password` char(64) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

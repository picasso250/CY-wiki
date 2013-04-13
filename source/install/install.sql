
--
-- 数据库: `cywiki`
--
CREATE DATABASE `cywiki` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `cywiki`;

-- --------------------------------------------------------

--
-- 表的结构 `entry`
--

CREATE TABLE IF NOT EXISTS `entry` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `creator` int(10) unsigned NOT NULL,
  `title` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL,
  `latest` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` char(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` char(64) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- 表的结构 `version`
--

CREATE TABLE IF NOT EXISTS `version` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `entry` int(10) unsigned NOT NULL,
  `editor` int(10) unsigned NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `reason` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `edited` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=10 ;

-- --------------------------------------------------------

--
-- 表的结构 `watch`
--

CREATE TABLE IF NOT EXISTS `watch` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user` int(10) unsigned NOT NULL,
  `entry` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `u_e` (`user`,`entry`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;


--------------------

ALTER TABLE  `entry` ADD  `category` INT( 10 ) UNSIGNED NOT NULL AFTER  `title`;
ALTER TABLE  `version` ADD  `title` VARCHAR( 200 ) NOT NULL AFTER  `editor`;
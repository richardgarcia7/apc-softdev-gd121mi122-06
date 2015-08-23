-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 22, 2015 at 10:58 PM
-- Server version: 5.5.42-37.1
-- PHP Version: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `angsalit_website`
--

-- --------------------------------------------------------

--
-- Table structure for table `molc_assets`
--

CREATE TABLE IF NOT EXISTS `molc_assets` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `parent_id` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set parent.',
  `lft` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set lft.',
  `rgt` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set rgt.',
  `level` int(10) unsigned NOT NULL COMMENT 'The cached level in the nested tree.',
  `name` varchar(50) NOT NULL COMMENT 'The unique name for the asset.\n',
  `title` varchar(100) NOT NULL COMMENT 'The descriptive title for the asset.',
  `rules` varchar(5120) NOT NULL COMMENT 'JSON encoded access control.',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_asset_name` (`name`),
  KEY `idx_lft_rgt` (`lft`,`rgt`),
  KEY `idx_parent_id` (`parent_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=57 ;

--
-- Dumping data for table `molc_assets`
--

INSERT INTO `molc_assets` (`id`, `parent_id`, `lft`, `rgt`, `level`, `name`, `title`, `rules`) VALUES
(1, 0, 1, 109, 0, 'root.1', 'Root Asset', '{"core.login.site":{"6":1,"2":1},"core.login.admin":{"6":1},"core.login.offline":{"6":1},"core.admin":{"8":1},"core.manage":{"7":1},"core.create":{"6":1,"3":1},"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1},"core.edit.own":{"6":1,"3":1}}'),
(2, 1, 1, 2, 1, 'com_admin', 'com_admin', '{}'),
(3, 1, 3, 6, 1, 'com_banners', 'com_banners', '{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(4, 1, 7, 8, 1, 'com_cache', 'com_cache', '{"core.admin":{"7":1},"core.manage":{"7":1}}'),
(5, 1, 9, 10, 1, 'com_checkin', 'com_checkin', '{"core.admin":{"7":1},"core.manage":{"7":1}}'),
(6, 1, 11, 12, 1, 'com_config', 'com_config', '{}'),
(7, 1, 13, 16, 1, 'com_contact', 'com_contact', '{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[],"core.edit.own":[]}'),
(8, 1, 17, 52, 1, 'com_content', 'com_content', '{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":{"3":1},"core.delete":[],"core.edit":{"4":1},"core.edit.state":{"5":1},"core.edit.own":[]}'),
(9, 1, 53, 54, 1, 'com_cpanel', 'com_cpanel', '{}'),
(10, 1, 55, 56, 1, 'com_installer', 'com_installer', '{"core.admin":[],"core.manage":{"7":0},"core.delete":{"7":0},"core.edit.state":{"7":0}}'),
(11, 1, 57, 58, 1, 'com_languages', 'com_languages', '{"core.admin":{"7":1},"core.manage":[],"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(12, 1, 59, 60, 1, 'com_login', 'com_login', '{}'),
(13, 1, 61, 62, 1, 'com_mailto', 'com_mailto', '{}'),
(14, 1, 63, 64, 1, 'com_massmail', 'com_massmail', '{}'),
(15, 1, 65, 66, 1, 'com_media', 'com_media', '{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":{"3":1},"core.delete":{"5":1}}'),
(16, 1, 67, 68, 1, 'com_menus', 'com_menus', '{"core.admin":{"7":1},"core.manage":[],"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(17, 1, 69, 70, 1, 'com_messages', 'com_messages', '{"core.admin":{"7":1},"core.manage":{"7":1}}'),
(18, 1, 71, 72, 1, 'com_modules', 'com_modules', '{"core.admin":{"7":1},"core.manage":[],"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(19, 1, 73, 76, 1, 'com_newsfeeds', 'com_newsfeeds', '{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[],"core.edit.own":[]}'),
(20, 1, 77, 78, 1, 'com_plugins', 'com_plugins', '{"core.admin":{"7":1},"core.manage":[],"core.edit":[],"core.edit.state":[]}'),
(21, 1, 79, 80, 1, 'com_redirect', 'com_redirect', '{"core.admin":{"7":1},"core.manage":[]}'),
(22, 1, 81, 82, 1, 'com_search', 'com_search', '{"core.admin":{"7":1},"core.manage":{"6":1}}'),
(23, 1, 83, 84, 1, 'com_templates', 'com_templates', '{"core.admin":{"7":1},"core.manage":[],"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(24, 1, 85, 88, 1, 'com_users', 'com_users', '{"core.admin":{"7":1},"core.manage":[],"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(25, 1, 89, 94, 1, 'com_weblinks', 'com_weblinks', '{"core.admin":{"7":1},"core.manage":{"6":1},"core.create":{"3":1},"core.delete":[],"core.edit":{"4":1},"core.edit.state":{"5":1},"core.edit.own":[]}'),
(26, 1, 95, 96, 1, 'com_wrapper', 'com_wrapper', '{}'),
(27, 8, 18, 25, 2, 'com_content.category.2', 'Notes', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[],"core.edit.own":[]}'),
(28, 3, 4, 5, 2, 'com_banners.category.3', 'Uncategorised', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(29, 7, 14, 15, 2, 'com_contact.category.4', 'Uncategorised', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[],"core.edit.own":[]}'),
(30, 19, 74, 75, 2, 'com_newsfeeds.category.5', 'Uncategorised', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[],"core.edit.own":[]}'),
(31, 25, 90, 91, 2, 'com_weblinks.category.6', 'Uncategorised', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[],"core.edit.own":[]}'),
(32, 24, 86, 87, 1, 'com_users.category.7', 'Uncategorised', '{"core.create":[],"core.delete":[],"core.edit":[],"core.edit.state":[]}'),
(33, 1, 97, 98, 1, 'com_finder', 'com_finder', '{"core.admin":{"7":1},"core.manage":{"6":1}}'),
(34, 1, 99, 100, 1, 'com_joomlaupdate', 'com_joomlaupdate', '{"core.admin":[],"core.manage":[],"core.delete":[],"core.edit.state":[]}'),
(35, 8, 26, 35, 2, 'com_content.category.8', 'General', '{"core.create":{"6":1,"3":1},"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1},"core.edit.own":{"6":1,"3":1}}'),
(36, 8, 36, 41, 2, 'com_content.category.9', 'Reflections and Guide to Sunday Mass Readings', '{"core.create":{"6":1,"3":1},"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1},"core.edit.own":{"6":1,"3":1}}'),
(37, 8, 42, 51, 2, 'com_content.category.10', 'Daily Mass Readings', '{"core.create":{"6":1,"3":1},"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1},"core.edit.own":{"6":1,"3":1}}'),
(38, 1, 101, 102, 1, 'com_jce', 'jce', '{}'),
(39, 1, 103, 104, 1, 'com_icagenda', 'icagenda', '{"core.manage":{"6":1},"icagenda.access.categories":{"7":1},"icagenda.access.events":{"6":1},"icagenda.access.registrations":{"7":1},"icagenda.access.newsletter":{"7":1},"icagenda.access.themes":{"7":1}}'),
(40, 35, 27, 28, 3, 'com_content.article.1', 'A Message from the Archbishop of Manila', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(41, 35, 29, 30, 3, 'com_content.article.2', 'Pahatid', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(42, 35, 31, 32, 3, 'com_content.article.3', 'A Proclaimer''s Prayer', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(43, 35, 33, 34, 3, 'com_content.article.4', 'Pope Francis'' 48th WCD message', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(44, 25, 92, 93, 2, 'com_weblinks.category.11', 'Useful Websites for Lectors and Commentators', '{"core.create":{"6":1,"3":1},"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1},"core.edit.own":{"6":1,"3":1}}'),
(45, 36, 37, 38, 3, 'com_content.article.5', 'Solemnity of the Lord''s Ascension', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(46, 37, 43, 46, 3, 'com_content.category.12', 'Daily Mass Readings - English', '{"core.create":{"6":1,"3":1},"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1},"core.edit.own":{"6":1,"3":1}}'),
(47, 37, 47, 48, 3, 'com_content.category.13', 'Daily Mass Readings - Filipino', '{"core.create":{"6":1,"3":1},"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1},"core.edit.own":{"6":1,"3":1}}'),
(48, 1, 105, 106, 1, 'com_multicalendar', 'multicalendar', '{}'),
(49, 37, 49, 50, 3, 'com_content.article.6', 'Daily Mass Readings - English', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(50, 46, 44, 45, 4, 'com_content.article.7', 'Daily Mass Readings - English - 09-01-2014', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(51, 36, 39, 40, 3, 'com_content.article.8', 'Solemnity of Pentecost', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(52, 1, 107, 108, 1, '#__icagenda_events.1', '#__icagenda_events.1', ''),
(54, 27, 19, 20, 3, 'com_content.article.9', 'Links', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(55, 27, 21, 22, 3, 'com_content.article.10', 'Dictionary', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}'),
(56, 27, 23, 24, 3, 'com_content.article.11', 'Useful Websites for Lectors and Commentators', '{"core.delete":{"6":1},"core.edit":{"6":1,"4":1},"core.edit.state":{"6":1,"5":1}}');

-- --------------------------------------------------------

--
-- Table structure for table `molc_associations`
--

CREATE TABLE IF NOT EXISTS `molc_associations` (
  `id` varchar(50) NOT NULL COMMENT 'A reference to the associated item.',
  `context` varchar(50) NOT NULL COMMENT 'The context of the associated item.',
  `key` char(32) NOT NULL COMMENT 'The key for the association computed from an md5 on associated ids.',
  PRIMARY KEY (`context`,`id`),
  KEY `idx_key` (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `molc_banners`
--

CREATE TABLE IF NOT EXISTS `molc_banners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` int(11) NOT NULL DEFAULT '0',
  `type` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `imptotal` int(11) NOT NULL DEFAULT '0',
  `impmade` int(11) NOT NULL DEFAULT '0',
  `clicks` int(11) NOT NULL DEFAULT '0',
  `clickurl` varchar(200) NOT NULL DEFAULT '',
  `state` tinyint(3) NOT NULL DEFAULT '0',
  `catid` int(10) unsigned NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `custombannercode` varchar(2048) NOT NULL,
  `sticky` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `metakey` text NOT NULL,
  `params` text NOT NULL,
  `own_prefix` tinyint(1) NOT NULL DEFAULT '0',
  `metakey_prefix` varchar(255) NOT NULL DEFAULT '',
  `purchase_type` tinyint(4) NOT NULL DEFAULT '-1',
  `track_clicks` tinyint(4) NOT NULL DEFAULT '-1',
  `track_impressions` tinyint(4) NOT NULL DEFAULT '-1',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `reset` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `language` char(7) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `idx_state` (`state`),
  KEY `idx_own_prefix` (`own_prefix`),
  KEY `idx_metakey_prefix` (`metakey_prefix`),
  KEY `idx_banner_catid` (`catid`),
  KEY `idx_language` (`language`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `molc_banner_clients`
--

CREATE TABLE IF NOT EXISTS `molc_banner_clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `contact` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `extrainfo` text NOT NULL,
  `state` tinyint(3) NOT NULL DEFAULT '0',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `metakey` text NOT NULL,
  `own_prefix` tinyint(4) NOT NULL DEFAULT '0',
  `metakey_prefix` varchar(255) NOT NULL DEFAULT '',
  `purchase_type` tinyint(4) NOT NULL DEFAULT '-1',
  `track_clicks` tinyint(4) NOT NULL DEFAULT '-1',
  `track_impressions` tinyint(4) NOT NULL DEFAULT '-1',
  PRIMARY KEY (`id`),
  KEY `idx_own_prefix` (`own_prefix`),
  KEY `idx_metakey_prefix` (`metakey_prefix`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `molc_banner_tracks`
--

CREATE TABLE IF NOT EXISTS `molc_banner_tracks` (
  `track_date` datetime NOT NULL,
  `track_type` int(10) unsigned NOT NULL,
  `banner_id` int(10) unsigned NOT NULL,
  `count` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`track_date`,`track_type`,`banner_id`),
  KEY `idx_track_date` (`track_date`),
  KEY `idx_track_type` (`track_type`),
  KEY `idx_banner_id` (`banner_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `molc_categories`
--

CREATE TABLE IF NOT EXISTS `molc_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `asset_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'FK to the #__assets table.',
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0',
  `lft` int(11) NOT NULL DEFAULT '0',
  `rgt` int(11) NOT NULL DEFAULT '0',
  `level` int(10) unsigned NOT NULL DEFAULT '0',
  `path` varchar(255) NOT NULL DEFAULT '',
  `extension` varchar(50) NOT NULL DEFAULT '',
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `note` varchar(255) NOT NULL DEFAULT '',
  `description` mediumtext NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(11) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `access` int(10) unsigned NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  `metadesc` varchar(1024) NOT NULL COMMENT 'The meta description for the page.',
  `metakey` varchar(1024) NOT NULL COMMENT 'The meta keywords for the page.',
  `metadata` varchar(2048) NOT NULL COMMENT 'JSON encoded metadata properties.',
  `created_user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `created_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `modified_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  `language` char(7) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cat_idx` (`extension`,`published`,`access`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_path` (`path`),
  KEY `idx_left_right` (`lft`,`rgt`),
  KEY `idx_alias` (`alias`),
  KEY `idx_language` (`language`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `molc_categories`
--

INSERT INTO `molc_categories` (`id`, `asset_id`, `parent_id`, `lft`, `rgt`, `level`, `path`, `extension`, `title`, `alias`, `note`, `description`, `published`, `checked_out`, `checked_out_time`, `access`, `params`, `metadesc`, `metakey`, `metadata`, `created_user_id`, `created_time`, `modified_user_id`, `modified_time`, `hits`, `language`) VALUES
(1, 0, 0, 0, 25, 0, '', 'system', 'ROOT', 'root', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{}', '', '', '', 0, '2009-10-18 16:07:09', 0, '0000-00-00 00:00:00', 0, '*'),
(2, 27, 1, 1, 2, 1, 'notes', 'com_content', 'Notes', 'notes', '', '<table class="category" style="width: 698.181823730469px; color: #ffffff; font-size: 14px; line-height: 21px;">\r\n<tbody>\r\n<tr class="cat-list-row0">\r\n<td class="title" style="margin: 0px; vertical-align: top;">\r\n<p>Web Link <a href="index.php/links?task=weblink.go&amp;id=1" target="_blank" rel="nofollow" class="category" style="outline-style: none; color: #dc3e29;">United States Conference of Catholic Bishops</a></p>\r\n<p>Daily Mass Readings based on the New American Bible Lectionary with podcast</p>\r\n</td>\r\n<td class="hits" style="margin: 0px; vertical-align: top;">7</td>\r\n</tr>\r\n<tr class="cat-list-row1">\r\n<td class="title" style="margin: 0px; vertical-align: top;">\r\n<p>Web Link <a href="index.php/links?task=weblink.go&amp;id=2" target="_blank" rel="nofollow" class="category" style="outline-style: none; color: #dc3e29;">Biblical Words Pronunciation Guide</a></p>\r\n<p>Audio recordings of Biblical words'' pronunciation.</p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>', 1, 876, '2015-08-03 09:27:27', 1, '{"category_layout":"","image":""}', '', '', '{"author":"","robots":""}', 42, '2010-06-28 13:26:37', 876, '2015-08-03 09:27:27', 0, '*'),
(3, 28, 1, 3, 4, 1, 'uncategorised', 'com_banners', 'Uncategorised', 'uncategorised', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":"","foobar":""}', '', '', '{"page_title":"","author":"","robots":""}', 42, '2010-06-28 13:27:35', 0, '0000-00-00 00:00:00', 0, '*'),
(4, 29, 1, 5, 6, 1, 'uncategorised', 'com_contact', 'Uncategorised', 'uncategorised', '', '', 1, 876, '2015-08-10 02:58:11', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 42, '2010-06-28 13:27:57', 0, '0000-00-00 00:00:00', 0, '*'),
(5, 30, 1, 7, 8, 1, 'uncategorised', 'com_newsfeeds', 'Uncategorised', 'uncategorised', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 42, '2010-06-28 13:28:15', 0, '0000-00-00 00:00:00', 0, '*'),
(6, 31, 1, 9, 10, 1, 'uncategorised', 'com_weblinks', 'Uncategorised', 'uncategorised', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 42, '2010-06-28 13:28:33', 0, '0000-00-00 00:00:00', 0, '*'),
(7, 32, 1, 11, 12, 1, 'uncategorised', 'com_users', 'Uncategorised', 'uncategorised', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"target":"","image":""}', '', '', '{"page_title":"","author":"","robots":""}', 42, '2010-06-28 13:28:33', 0, '0000-00-00 00:00:00', 0, '*'),
(8, 35, 1, 13, 14, 1, 'general', 'com_content', 'General', 'general', '', '', 1, 876, '2015-08-03 09:25:48', 1, '{"category_layout":"","image":""}', '', '', '{"author":"","robots":""}', 876, '2014-08-24 14:57:12', 0, '0000-00-00 00:00:00', 0, '*'),
(9, 36, 1, 15, 16, 1, 'reflections-and-guide-to-sunday-mass-readings', 'com_content', 'Reflections and Guide to Sunday Mass Readings', 'reflections-and-guide-to-sunday-mass-readings', '', '', 1, 876, '2015-08-03 09:26:14', 1, '{"category_layout":"","image":""}', '', '', '{"author":"","robots":""}', 876, '2014-08-24 14:57:49', 876, '2014-08-25 03:47:24', 0, '*'),
(10, 37, 1, 17, 22, 1, 'daily-mass-readings', 'com_content', 'Daily Mass Readings', 'daily-mass-readings', '', '', 1, 876, '2015-08-03 09:25:54', 1, '{"category_layout":"","image":""}', '', '', '{"author":"","robots":""}', 876, '2014-08-24 14:58:07', 876, '2014-08-25 04:52:07', 0, '*'),
(11, 44, 1, 23, 24, 1, 'useful-websites-for-lectors-and-commentators', 'com_weblinks', 'Useful Websites for Lectors and Commentators', 'useful-websites-for-lectors-and-commentators', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"category_layout":"","image":""}', '', '', '{"author":"","robots":""}', 876, '2014-08-25 03:28:13', 0, '0000-00-00 00:00:00', 0, '*'),
(12, 46, 10, 18, 19, 2, 'daily-mass-readings/english', 'com_content', 'Daily Mass Readings - English', 'english', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"category_layout":"","image":""}', '', '', '{"author":"","robots":""}', 876, '2014-08-25 04:52:28', 876, '2014-08-25 05:14:12', 0, '*'),
(13, 47, 10, 20, 21, 2, 'daily-mass-readings/filipino', 'com_content', 'Daily Mass Readings - Filipino', 'filipino', '', '', 1, 0, '0000-00-00 00:00:00', 1, '{"category_layout":"","image":""}', '', '', '{"author":"","robots":""}', 876, '2014-08-25 04:52:39', 876, '2014-08-25 05:14:27', 0, '*');

-- --------------------------------------------------------

--
-- Table structure for table `molc_contact_details`
--

CREATE TABLE IF NOT EXISTS `molc_contact_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `con_position` varchar(255) DEFAULT NULL,
  `address` text,
  `suburb` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `postcode` varchar(100) DEFAULT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `fax` varchar(255) DEFAULT NULL,
  `misc` mediumtext,
  `image` varchar(255) DEFAULT NULL,
  `imagepos` varchar(20) DEFAULT NULL,
  `email_to` varchar(255) DEFAULT NULL,
  `default_con` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `params` text NOT NULL,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `catid` int(11) NOT NULL DEFAULT '0',
  `access` int(10) unsigned NOT NULL DEFAULT '0',
  `mobile` varchar(255) NOT NULL DEFAULT '',
  `webpage` varchar(255) NOT NULL DEFAULT '',
  `sortname1` varchar(255) NOT NULL,
  `sortname2` varchar(255) NOT NULL,
  `sortname3` varchar(255) NOT NULL,
  `language` char(7) NOT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) unsigned NOT NULL DEFAULT '0',
  `created_by_alias` varchar(255) NOT NULL DEFAULT '',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) unsigned NOT NULL DEFAULT '0',
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `metadata` text NOT NULL,
  `featured` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Set if article is featured.',
  `xreference` varchar(50) NOT NULL COMMENT 'A reference to enable linkages to external data sets.',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_state` (`published`),
  KEY `idx_catid` (`catid`),
  KEY `idx_createdby` (`created_by`),
  KEY `idx_featured_catid` (`featured`,`catid`),
  KEY `idx_language` (`language`),
  KEY `idx_xreference` (`xreference`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `molc_contact_details`
--

INSERT INTO `molc_contact_details` (`id`, `name`, `alias`, `con_position`, `address`, `suburb`, `state`, `country`, `postcode`, `telephone`, `fax`, `misc`, `image`, `imagepos`, `email_to`, `default_con`, `published`, `checked_out`, `checked_out_time`, `ordering`, `params`, `user_id`, `catid`, `access`, `mobile`, `webpage`, `sortname1`, `sortname2`, `sortname3`, `language`, `created`, `created_by`, `created_by_alias`, `modified`, `modified_by`, `metakey`, `metadesc`, `metadata`, `featured`, `xreference`, `publish_up`, `publish_down`) VALUES
(1, 'Web Administrator', 'web-administrator', '', '', '', '', '', '', '', '', '', '', NULL, '', 0, 1, 0, '0000-00-00 00:00:00', 1, '{"show_contact_category":"","show_contact_list":"","presentation_style":"plain","show_name":"","show_position":"","show_email":"","show_street_address":"","show_suburb":"","show_state":"","show_postcode":"","show_country":"","show_telephone":"","show_mobile":"","show_fax":"","show_webpage":"","show_misc":"","show_image":"","allow_vcard":"","show_articles":"","show_profile":"","show_links":"","linka_name":"","linka":false,"linkb_name":"","linkb":false,"linkc_name":"","linkc":false,"linkd_name":"","linkd":false,"linke_name":"","linke":"","contact_layout":"","show_email_form":"","show_email_copy":"","banned_email":"","banned_subject":"","banned_text":"","validate_session":"","custom_reply":"","redirect":""}', 877, 4, 1, '', '', '', '', '', '*', '2014-08-25 03:31:44', 876, '', '2014-08-25 05:10:45', 876, '', '', '{"robots":"","rights":""}', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `molc_content`
--

CREATE TABLE IF NOT EXISTS `molc_content` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `asset_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'FK to the #__assets table.',
  `title` varchar(255) NOT NULL DEFAULT '',
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `title_alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '' COMMENT 'Deprecated in Joomla! 3.0',
  `introtext` mediumtext NOT NULL,
  `fulltext` mediumtext NOT NULL,
  `state` tinyint(3) NOT NULL DEFAULT '0',
  `sectionid` int(10) unsigned NOT NULL DEFAULT '0',
  `mask` int(10) unsigned NOT NULL DEFAULT '0',
  `catid` int(10) unsigned NOT NULL DEFAULT '0',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) unsigned NOT NULL DEFAULT '0',
  `created_by_alias` varchar(255) NOT NULL DEFAULT '',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `images` text NOT NULL,
  `urls` text NOT NULL,
  `attribs` varchar(5120) NOT NULL,
  `version` int(10) unsigned NOT NULL DEFAULT '1',
  `parentid` int(10) unsigned NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `access` int(10) unsigned NOT NULL DEFAULT '0',
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  `metadata` text NOT NULL,
  `featured` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Set if article is featured.',
  `language` char(7) NOT NULL COMMENT 'The language code for the article.',
  `xreference` varchar(50) NOT NULL COMMENT 'A reference to enable linkages to external data sets.',
  PRIMARY KEY (`id`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_state` (`state`),
  KEY `idx_catid` (`catid`),
  KEY `idx_createdby` (`created_by`),
  KEY `idx_featured_catid` (`featured`,`catid`),
  KEY `idx_language` (`language`),
  KEY `idx_xreference` (`xreference`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `molc_content`
--

INSERT INTO `molc_content` (`id`, `asset_id`, `title`, `alias`, `title_alias`, `introtext`, `fulltext`, `state`, `sectionid`, `mask`, `catid`, `created`, `created_by`, `created_by_alias`, `modified`, `modified_by`, `checked_out`, `checked_out_time`, `publish_up`, `publish_down`, `images`, `urls`, `attribs`, `version`, `parentid`, `ordering`, `metakey`, `metadesc`, `access`, `hits`, `metadata`, `featured`, `language`, `xreference`) VALUES
(1, 40, 'A Message from the Archbishop of Manila', 'a-message-from-the-archbishop-of-manila', '', '<p>&nbsp;</p>\r\n<p><img style="margin-bottom: 10px; vertical-align: top; display: block; margin-left: auto; margin-right: auto;" src="images/general/cardinal-tagle.jpg" alt="cardinal-tagle" /></p>\r\n<p><img style="display: block; margin-left: auto; margin-right: auto;" src="images/msgfromcardinaltagle.jpg" alt="msgfromcardinaltagle" /></p>\r\n<p style="text-align: center;"><span style="color: #51600d;">My dear brothers and sisters in Christ,</span></p>\r\n<p style="text-align: center;"><span style="color: #51600d;">God speaks to us in time and history. God communicates through time and history. From a faith perspective, we can say that history owes its existence to God whose voice is at the origin of human history. Through the revelation of God, human history becomes salvation history.</span></p>\r\n<p style="text-align: center;"><span style="color: #51600d;">Using the eyes of faith, we are able to discern the dynamic presence of divine action, intervention or communication in our personal and communal histories. The peak of God’s intervention is in Jesus Christ, the Word of God made flesh, and by doing so, was immersed in the drama of human history. Revelation is not a mere communication of the content of God’s identity and plan but effects in history what God intends.</span></p>\r\n<p style="text-align: center;"><span style="color: #51600d;">Our people come to church with the expectation of being guided in discovering the meaning of life in the light of faith. They bring their frustrations, needs, sins, wounds and dying to us that the power of the Paschal Mystery may kindle hope and strength for the journey.</span></p>\r\n<p style="text-align: center;"><span style="color: #51600d;">We hope that in our ministry of proclaiming God’s Word, they may hear the word that the Lord has put in every prophet’s mouth. Then somehow, the joyful and painful experiences begin to speak of a God who faithfully walks with them.</span></p>\r\n<p style="text-align: center;"><span style="color: #51600d;">Welcome to angsalitangdiyos.com!</span></p>\r\n<p style="text-align: center;"><span style="color: #51600d;">+LUIS ANTONIO G. CARDINAL TAGLE</span></p>', '', 1, 0, 0, 8, '2014-08-24 15:06:19', 876, '', '2015-08-10 03:53:35', 876, 876, '2015-08-10 04:18:04', '2014-08-24 15:06:19', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":false,"urlatext":"","targeta":"","urlb":false,"urlbtext":"","targetb":"","urlc":false,"urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":""}', 5, 0, 3, '', '', 1, 10, '{"robots":"","author":"","rights":"","xreference":""}', 1, '*', ''),
(2, 41, 'Pahatid', 'pahatid', '', '<p><img style="margin-bottom: 10px; vertical-align: top; display: block; margin-left: auto; margin-right: auto;" src="images/general/apat_na_taon.jpg" alt="apat na taon" /></p>\r\n<p>May kakaibang pakiramdam kapag nakakasaksi ng mga una – unang ngiti, unang hikab, unang hakbang, unang salita. Biyaya ng Diyos ang mga una. Kaya nga para sa mga Hudyo, ang una, ang panganay ay inaalay sa Diyos bilang handog ng pasasalamat.</p>\r\n<p>Sa unang pagkakataon, itatampok sa isang website ang audio recording ng mga pagbasa sa Filipino. Ang mga piling lector mula sa iba’t ibang parokya ay nag-magandang loob na gumanap para magkaroon ng huwarang sipi ng tamang pagpapahayag ng mga pagbasa sa liturhiya.</p>\r\n<p>Layunin ng website na ito ang tulungan ang mga lektor sa kanilang mahalagang tungkulin. Mariing ipinaala ni Papa Benito XVI na ang mga naatasang magpapahayag ng Salita ng Diyos sa liturhiya ay dapat sumailalim sa paghuhubog, paghahanda at pagsasanay (Cf. Sacramentum Caritatis, 45). Dahil ang Diyos mismo ang nangungusap sa kanyang bayan sa tuwing ipapahayag ang Salita ng Diyos (Cf. Sacrosanctum Concilium, 33), kailangang paghandaan ito ng mga lector sa pamamagitan ng pag-aaral, pagninilay at pagsasabuhay nito.</p>\r\n<p>Ang website na ito ay patunay ng hindi matatawarang ambag ng mga layko sa buhay at misyon ng simbahan. Mula sa pawis, pagod, talino at kakayahan ng mga masisipag na lektor ng Arkidiyosesis ng Maynila, ang website na ito ay sinimulan, ipinagpapatuloy at pinalalago. Salamat sa kanila. Salamat sa Diyos.</p>\r\n<p>Tuloy po kayo!</p>\r\n<p>Reb. Padre Carmelo P. Arada, Jr.</p>\r\n<p>Minister - Ministry on Lectors and Commentators</p>', '', 1, 0, 0, 8, '2014-08-24 15:16:12', 876, '', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', '2014-08-24 15:16:12', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":false,"urlatext":"","targeta":"","urlb":false,"urlbtext":"","targetb":"","urlc":false,"urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":""}', 1, 0, 2, '', '', 1, 11, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(3, 42, 'A Proclaimer''s Prayer', 'a-proclaimer-s-prayer', '', '<p><img style="display: block; margin-left: auto; margin-right: auto; margin-bottom: 10px;" src="images/general/jeremiah.jpg" alt="jeremiah" />Praise to you, Lord God, King of the universe,</p>\r\n<p>And all glory to your name.</p>\r\n<p>I praise you and thank you for calling me</p>\r\n<p>To proclaim your word to your beloved people.</p>\r\n<p>Open the hearts of all who worship with us,</p>\r\n<p>So that they may hear your voice when I read.</p>\r\n<p>Let nothing in my life or manner disturb your people</p>\r\n<p>Or close their hearts to the action of your Spirit.</p>\r\n<p>Cleanse my heart and mind,</p>\r\n<p>And open my lips so that I may proclaim your glory.</p>\r\n<p>All praise to you, heavenly Father, through the Lord Jesus, in the Holy Spirit,</p>\r\n<p>Now and forever. Amen.</p>\r\n<p class="sources">- published as “A Reader’s Prayer” in the National Bulletin on Liturgy, #50</p>', '', 1, 0, 0, 8, '2014-08-25 02:32:36', 876, '', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', '2014-08-25 02:32:36', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":false,"urlatext":"","targeta":"","urlb":false,"urlbtext":"","targetb":"","urlc":false,"urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":""}', 1, 0, 1, '', '', 1, 3, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(4, 43, 'Pope Francis'' 48th WCD message', 'pope-francis-48th-wcd-message', '', '<p><img style="display: block; margin-left: auto; margin-right: auto; margin-bottom: 10px;" src="images/general/48th_wcd_msg.png" alt="48th wcd msg" />Communication at the service of an Authentic Culture of Encounter</p>\r\n<p>{youtube}0p-P92YGtLQ{/youtube}</p>\r\n<p>&nbsp;</p>', '', 1, 0, 0, 8, '2014-08-25 02:44:53', 876, '', '2014-08-25 03:11:49', 876, 0, '0000-00-00 00:00:00', '2014-08-25 02:44:53', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":false,"urlatext":"","targeta":"","urlb":false,"urlbtext":"","targetb":"","urlc":false,"urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":""}', 6, 0, 0, '', '', 1, 17, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(5, 45, 'Solemnity of the Lord''s Ascension', 'solemnity-of-the-lord-s-ascension', '', '<h2>First Reading: Acts 1:1-11</h2>\r\n<h3>Background/Context of the Reading</h3>\r\n<p>After his resurrection, having spent 40 days with his beloved disciples, Jesus ascends to His Father in heaven. Today we read about the intimate moment of separation between friends as Jesus bids his disciples farewell.</p>\r\n<p>St. Luke presents to Theophilus, who apparently is an important person, the testimonies of several apostles who have seen Jesus after his Resurrection from the Dead until he ascended to heaven right before their eyes.</p>\r\n<p>St. Luke also illustrates the significance of the sacred number "40" as it relates to "purification" : 40 days and nights of the great flood during Noah''s time, 40 years of exile in the desert for the Israelites, and the Lord''s 40 days and nights again in the desert before he began his three-year public ministry and now, 40 days after his Resurrection, Jesus returns to heaven to prepare his apostles for the coming of the Holy Spirit and the beginning of their individual missions to proclaim the Good News.</p>\r\n', '\r\n<h3>Message/Meaning of the Reading</h3>\r\n<h3>How to Proclaim</h3>\r\n<p>The disciples were still at a loss as to the meaning of all that has happened - they still expected the restoration of Israel. They had barely gotten over the shock of Jesus’ death and resurrection and now Jesus is leaving them again. But Jesus consoles them and leaves them with the gift of the Holy Spirit: a gift of understanding, a gift of power so that they can do what He did and even more, and a promise that He will not abandon them. The wonderful mystery of the Ascension is that Jesus had to ascend to heaven so that we can receive the Spirit. Jesus’ physical presence was replaced by a more intimate, more pure and more permanent presence.</p>\r\n<h3>Word Watch</h3>\r\n<p><em>Theophilus - thee-OF-uh-luhs</em></p>\r\n<h2>Responsorial Psalm: GOD MOUNTS HIS THRONE AMID SHOUTS OF JOY, A BLARE OF TRUMPETS FOR THE LORD!</h2>\r\n<p>This enthronement psalm is a joyful hymn of praise as God mounts his throne after his ascension.</p>\r\n<h2>Second Reading:<strong>Ephesians 1:17-23</strong></h2>\r\n<h3>Background/Context of the Reading</h3>\r\n<p>The letter of St Paul to the Ephesians was not merely addressed to the Christians of Ephesus but also to the other Christian communities of Hierapolis, Laodicea and Colossus and reveals God''s plan for the world.</p>\r\n<h3><strong><span style="text-decoration: underline;">Message/Meaning of the Reading</span></strong></h3>\r\n<p>Paul prays that we may be enlightened so that we can appreciate what God has done for us and live a life worthy of our calling. And just as we are called to continue Christ’s mission on earth, we are also called to share in the glory of Christ. Today we are hemmed in by suffering and disbelief. Our faith is challenged. But we cling to the hope, even as we are struggling, that there is only one ending to the story - that we will claim our inheritance as God’s children and be with Him forever!</p>\r\n<h3>How to Proclaim</h3>\r\n<p>Note the second sentence which contains 11 clauses separated by 13 commas. Read the passage slowly observing the pauses which will allow you to group the thoughts together. This letter was written to the area of Ephesus which was then experiencing "growing pains" as Jewish converts and Gentiles who chose to follow the apostles'' teachings were given the chance to belong to Christ''s fold. Let the spirit of awe and exultation fill your voice as they exhorted the converts with the great privilege and wealth that have been gifted with through their faith in Jesus Christ.</p>\r\n<h2>Gospel: <strong>Matthew 28:16-20</strong></h2>\r\n<h3>Background/Context of the Reading</h3>\r\n<p>A few verses before today’s reading, Jesus warned his listeners about false prophets who draw attention to themselves with their pious practices. The Great Commission, the Gospel reading for today, takes place on a mountain during Jesus’ final appearance. Matthew places this scene in Galilee while Luke in Acts relates that Jesus’ appearance was in Jerusalem. The emphasis should not be on where Jesus appeared but on what Jesus had to say before he ascended to Heaven.</p>\r\n<p>&nbsp;</p>\r\n<h3>Message/Meaning of the Reading</h3>\r\n<p>Jesus initially declares his authority from the Father. And then he gives his disciples his mission, as he passes his own authority to them.</p>\r\n<p>The Ascension portrays a different kind of faith. This time, God entrusts man with the mission of working for the coming of God’s Kingdom. God knew that man, filled with His Spirit, will rise to the occasion and courageously carry out the commission.</p>\r\n<p>Two thousand years after, we have the same duty to proclaim the Good News, in words and deeds. By the power of the Hoy Spirit, we are to continue the work of Jesus: teaching, healing, spreading love and forgiveness, promoting justice, and caring for the poor.</p>\r\n<h3><strong><span style="text-decoration: underline;">Reflections</span></strong></h3>\r\n<p>As lectors, we have been given the unique privilege to literally proclaim God’s Word. Do we do it with love, reverence and joy?</p>\r\n<p>What is Christ’s personal commission for you?</p>\r\n<hr />\r\n<p><em>*We thank the lectors of the Sacred Heart Parish in Kamuning, QC for allowing us to feature excerpts from their book, "Lector''s Guide". For copies, please contact Logos publications at telephone number (+632) 7111323.</em></p>', 1, 0, 0, 9, '2014-08-25 03:49:25', 876, '', '2014-08-25 03:55:23', 876, 876, '2015-08-03 09:37:22', '2014-08-25 03:49:25', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":false,"urlatext":"","targeta":"","urlb":false,"urlbtext":"","targetb":"","urlc":false,"urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":""}', 3, 0, 1, '', '', 1, 8, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(6, 49, 'Daily Mass Readings - English', 'daily-mass-readings-english', '', '<p>Click on a date in the calendar below to view and to listen to the readings for that day.</p>', '', 1, 0, 0, 10, '2014-08-27 14:27:15', 876, '', '2014-08-27 15:08:57', 876, 876, '2015-08-03 08:47:57', '2014-08-27 14:27:15', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":false,"urlatext":"","targeta":"","urlb":false,"urlbtext":"","targetb":"","urlc":false,"urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":""}', 2, 0, 0, '', '', 1, 28, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(7, 50, 'Daily Mass Readings - English - 09-01-2014', 'daily-mass-readings-english-09-01-2014', '', '<p>1 Cor 2: 1-5</p>\r\n<p>{mp3}ord_w22_1_r1_y2{/mp3}</p>\r\n<p>&nbsp;</p>\r\n<p>Ps 119:97.98.99.100.101.102</p>\r\n<p>{mp3}ord_w22_1_r1p_y2{/mp3}</p>\r\n<p>&nbsp;</p>\r\n<p>Lk 4:16-30</p>\r\n<p>{mp3}ord_w22_1_r2g_y2{/mp3}</p>\r\n<p>&nbsp;</p>\r\n<p>Click on a date in the calendar below to view and to listen to the readings for that day.</p>', '', 1, 0, 0, 12, '2014-08-27 14:56:49', 876, '', '2014-08-27 15:08:43', 876, 0, '0000-00-00 00:00:00', '2014-08-27 14:56:49', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":false,"urlatext":"","targeta":"","urlb":false,"urlbtext":"","targetb":"","urlc":false,"urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":""}', 4, 0, 0, '', '', 1, 21, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(8, 51, 'Solemnity of Pentecost', 'solemnity-of-pentecost', '', '<h2>First Reading: Acts 2:1-11</h2>\r\n<h3>Background/Context of the Reading</h3>\r\n<p>The Jewish Pentecost was the second most important Jewish feast. Every year, on this day, devout Jews from all around the world gather to celebrate the birth of Israel as God’s chosen people, in the covenant Law given to Moses on Mt. Sinai. Jesus’ disciples gathered, not to celebrate the feast, but to wait for the fulfillment of a promise made by Jesus before He ascended into Heaven.</p>\r\n', '\r\n<h3>Message/Meaning of the Reading</h3>\r\n<p>The timing was very fitting. Christ’s church was born on the feast day of God’s covenant with his chosen people! The birth of the chosen people became the birth of the church, the new people of God. The feast of the Law became the feast of the Spirit.</p>\r\n<p>The Holy Spirit, unleashed on Jesus’ disciples, transformed a timid and anxious group into bold and powerful witnesses for Christ. From a confused and scattered lot, they were united into a community characterized by brotherly love and filled with a deep sense of mission. The same Spirit is the origin of all the great movements in the Church, transforming and renewing it in every generation.</p>\r\n<p>We, too, receive the Holy Spirit in the sacraments - quietly, but just as powerfully. The Holy Spirit, who is completely and truly God now dwells within us, transforming us to become like Christ, transforming us to be God’s pride and joy. But to feel the transforming effect of the Holy Spirit in our lives, our cooperation is indispensable. We have to listen to the promptings of the Spirit and be open to Him. Mary Most Holy and all the saints are eloquent proofs of the transforming power of the Holy Spirit.</p>\r\n<h3>How to Proclaim</h3>\r\n<p>Beginning with the words, “And suddenly,” build momentum in your proclamation through the words, “as the spirit enabled. . .”, by progressively increasing the energy in your voice as you are telling of this dramatic event. Pause before the words, “Now there were devout Jew. . .” Lower the tone of your voice and resume a narrative tone as you read this sentence. Practice the pronunciation of the words in Word Watch, This reading is both challenging and rewarding because of the concentration of Biblical Words in one sentence. Do not rush through the enumeration; enunciate each name in the list, to further emphasize to the assembly the universal reach of God’s saving work through Christ in the Holy Spirit. Proclaim the concluding line of the reading (“yet we hear them speaking”) without rushing and with marvel and excitement in your voice.</p>\r\n<h3>Word Watch</h3>\r\n<p><em> Galileans – gal-ih-LEE-unz</em></p>\r\n<p><em>Parthians – PAR-thee-unz</em></p>\r\n<p><em>Medes – meedz</em></p>\r\n<p><em>Elamites – EE-luh-mites</em></p>\r\n<p><em>Mesopotamia – mes-uh-poh-TAY-mee-uh</em></p>\r\n<p><em>Judea – joo-DEE-uh</em></p>\r\n<p><em>Cappadocia – kap-uh-DOH-see-ah</em></p>\r\n<p><em>Pontus – PON–tus</em></p>\r\n<p><em>Phrygia – FRIJ-ee-uh</em></p>\r\n<p><em>Pamphilia – pam-FILI-ee-uh</em></p>\r\n<p><em>Egypt – EE-jipt</em></p>\r\n<p><em>Libya – LIB-ee-uh</em></p>\r\n<p><em>Cyrene–SAI-REE-neh</em></p>\r\n<p><em>Cretans – KREE-tans</em></p>\r\n<p><em>Arabs – ER-rubs</em></p>\r\n<h2>Responsorial Psalm: LORD, SEND OUT YOUR SPIRIT AND RENEW THE FACE OF THE EARTH!</h2>\r\n<p>The Psalmist praises God for his wonderful works in creation. When the psalmist talks about the Spirit renewing the earth, he was most probably referring to springtime. For Christians, the renewal of the face of the earth can be viewed as a renewal of creation with the church being its first fruits.</p>\r\n<h2>Second Reading:<strong>1 Cor. 12:3b-7, 12-13</strong></h2>\r\n<h3>Background/Context of the Reading</h3>\r\n<p>The church in Corinth, composed of mostly Jewish and Greek converts, faced many issues – internal divisions and questions on faith. Paul writes to the Corinthians to address the problems encountered by the young church.</p>\r\n<h3>How to Proclaim</h3>\r\n<p>Pause briefly between Paul’s expressions of difference and sameness. Look up the assembly and proclaim clearly and solemnly, emphasizing each word of the phrase, “so also Christ”. Emphasize each occurrence of the word,”one” to drive home Paul’s support and encouragement for unity in the Church.</p>\r\n<h2>Gospel: <strong>Gospel John 20:19-23</strong></h2>\r\n<h3>Background/Context of the Reading</h3>\r\n<p>After Jesus’ crucifixion, his disciples were afraid for their lives. Their master is dead and they fear that the authorities would be looking for them next.</p>\r\n<h3>Message/Meaning of the Reading</h3>\r\n<p>Jesus’ first words to his disciples were “Peace be with you.” He knew that they were afraid and anxious. The disciples rejoiced and Jesus reiterated his greeting, “Peace be with you”, gave them their mission as He breathed the Holy Spirit in them.&nbsp;&nbsp;</p>\r\n<p>“Peace be with you” is a normal Jewish greeting. But Jesus was not wishing his disciples peace; He was assuring them that they have peace. The disciples were told to continue the mission of Jesus - they are to continue doing what He did. And when Jesus breathed on his disciples the Holy Spirit, he breathed new life into them, as God breathed on the man he formed from clay and gave it life.</p>\r\n<p>The power that came with the Holy Spirit was the authority to forgive. For the power of God, his Spirit, is a power for forgiveness, for bringing people back to God. The same mission is given to each of us. We are sent to help other people be reconciled to God, to work with God to build his Kingdom. And each of us has a role in this mission, which is why the Spirit has given us different gifts which we should use for the benefit of the one body of Christ, His Church. &nbsp;</p>\r\n<h3><strong><span style="text-decoration: underline;">Reflections</span></strong></h3>\r\n<p>What are your gifts? For whose benefit do you use your gifts? How can these be used for the benefit of God’s people? What evidence of the Spirit’s working in you can be observed? What fruits of the Spirit can be seen in your life?</p>', 1, 0, 0, 9, '2014-08-27 15:32:50', 876, '', '0000-00-00 00:00:00', 0, 0, '0000-00-00 00:00:00', '2014-08-27 15:32:50', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":false,"urlatext":"","targeta":"","urlb":false,"urlbtext":"","targetb":"","urlc":false,"urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":""}', 1, 0, 0, '', '', 1, 7, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(9, 54, 'Links', 'links', '', '<p style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;">Web Link&nbsp;<a href="index.php/notes?task=weblink.go&amp;id=1" target="_blank" rel="nofollow" class="category" style="outline-style: none; color: #ffff99;">United States Conference of Catholic Bishops</a></p>\r\n<p style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;">Daily Mass Readings based on the New American Bible Lectionary with podcast</p>\r\n<p style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;">Web Link&nbsp;<a href="index.php/notes?task=weblink.go&amp;id=2" target="_blank" rel="nofollow" class="category" style="outline-style: none; text-decoration: none; color: #ffff99;">Biblical Words Pronunciation Guide</a></p>\r\n<p style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;">Audio recordings of Biblical words'' pronunciation.</p>', '', 1, 0, 0, 2, '2015-08-03 09:40:43', 876, '', '2015-08-10 05:39:15', 876, 876, '2015-08-10 05:39:15', '2015-08-03 09:40:43', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":false,"urlatext":"","targeta":"","urlb":false,"urlbtext":"","targetb":"","urlc":false,"urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":""}', 4, 0, 2, '', '', 1, 19, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(10, 55, 'Dictionary', 'dictionary', '', '<p style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;">Web Link&nbsp;<a href="index.php/notes?task=weblink.go&amp;id=3" target="_blank" rel="nofollow" class="category" style="outline-style: none; color: #ffff99;">Downloads - Word &amp; Life</a></p>\r\n<p style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;">Download PDF copies of the Euchalette</p>\r\n<p style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;">Web Link&nbsp;<a href="index.php/notes?task=weblink.go&amp;id=4" target="_blank" rel="nofollow" class="category" style="outline-style: none; color: #ffff99;">Sambuhay</a></p>\r\n<p style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;">To subscribe to Sambuhay Online</p>\r\n<p>&nbsp;</p>', '', 1, 0, 0, 2, '2015-08-03 09:42:42', 876, '', '2015-08-10 05:40:44', 876, 876, '2015-08-10 05:40:44', '2015-08-03 09:42:42', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":false,"urlatext":"","targeta":"","urlb":false,"urlbtext":"","targetb":"","urlc":false,"urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":""}', 6, 0, 1, '', '', 1, 8, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', ''),
(11, 56, 'Useful Websites for Lectors and Commentators', 'useful-websites', '', '<p style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;">Web Link&nbsp;<a href="index.php/notes?task=weblink.go&amp;id=1" target="_blank" rel="nofollow" class="category" style="outline-style: none; color: #ffff99;">United States Conference of Catholic Bishops</a></p>\r\n<p style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;">Daily Mass Readings based on the New American Bible Lectionary with podcast</p>\r\n<p>&nbsp;</p>\r\n<p style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;">Web Link&nbsp;<a href="index.php/notes?task=weblink.go&amp;id=2" target="_blank" rel="nofollow" class="category" style="outline-style: none; text-decoration: none; color: #ffff99;">Biblical Words Pronunciation Guide</a></p>\r\n<p style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;">Audio recordings of Biblical words'' pronunciation.</p>\r\n<p style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;">&nbsp;</p>\r\n<p style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;">Web Link&nbsp;<a href="index.php/notes?task=weblink.go&amp;id=3" target="_blank" rel="nofollow" class="category" style="outline-style: none; color: #ffff99;">Downloads - Word &amp; Life</a></p>\r\n<p style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;">Download PDF copies of the Euchalette</p>\r\n<p style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;">&nbsp;</p>\r\n<p style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;">Web Link&nbsp;<a href="index.php/notes?task=weblink.go&amp;id=4" target="_blank" rel="nofollow" class="category" style="outline-style: none; color: #ffff99;">Sambuhay</a></p>\r\n<p style="font-family: Verdana, Arial, Helvetica, sans-serif; font-size: 11px;">To subscribe to Sambuhay Online</p>', '', 1, 0, 0, 2, '2015-08-10 05:30:13', 876, '', '0000-00-00 00:00:00', 0, 876, '2015-08-10 05:37:24', '2015-08-10 05:30:13', '0000-00-00 00:00:00', '{"image_intro":"","float_intro":"","image_intro_alt":"","image_intro_caption":"","image_fulltext":"","float_fulltext":"","image_fulltext_alt":"","image_fulltext_caption":""}', '{"urla":false,"urlatext":"","targeta":"","urlb":false,"urlbtext":"","targetb":"","urlc":false,"urlctext":"","targetc":""}', '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_vote":"","show_hits":"","show_noauth":"","urls_position":"","alternative_readmore":"","article_layout":"","show_publishing_options":"","show_article_options":"","show_urls_images_backend":"","show_urls_images_frontend":""}', 1, 0, 0, '', '', 1, 5, '{"robots":"","author":"","rights":"","xreference":""}', 0, '*', '');

-- --------------------------------------------------------

--
-- Table structure for table `molc_content_frontpage`
--

CREATE TABLE IF NOT EXISTS `molc_content_frontpage` (
  `content_id` int(11) NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`content_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `molc_content_frontpage`
--

INSERT INTO `molc_content_frontpage` (`content_id`, `ordering`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `molc_content_rating`
--

CREATE TABLE IF NOT EXISTS `molc_content_rating` (
  `content_id` int(11) NOT NULL DEFAULT '0',
  `rating_sum` int(10) unsigned NOT NULL DEFAULT '0',
  `rating_count` int(10) unsigned NOT NULL DEFAULT '0',
  `lastip` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`content_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `molc_core_log_searches`
--

CREATE TABLE IF NOT EXISTS `molc_core_log_searches` (
  `search_term` varchar(128) NOT NULL DEFAULT '',
  `hits` int(10) unsigned NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `molc_dc_mv_calendars`
--

CREATE TABLE IF NOT EXISTS `molc_dc_mv_calendars` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `permissions` text,
  `owner` int(11) DEFAULT NULL,
  `subjectlist` text,
  `locationlist` text,
  `ordering` int(11) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(11) NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `molc_dc_mv_calendars`
--

INSERT INTO `molc_dc_mv_calendars` (`id`, `title`, `permissions`, `owner`, `subjectlist`, `locationlist`, `ordering`, `published`, `checked_out`, `checked_out_time`) VALUES
(1, 'Daily Mass Readings', 'groups1=8;users1=876;groups2=8;users2=876;groups3=8;users3=876;', 877, '', '', 0, 1, 0, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `molc_dc_mv_configuration`
--

CREATE TABLE IF NOT EXISTS `molc_dc_mv_configuration` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `palettes` text,
  `administration` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `molc_dc_mv_configuration`
--

INSERT INTO `molc_dc_mv_configuration` (`id`, `palettes`, `administration`) VALUES
(1, 'a:2:{i:0;a:3:{s:4:"name";s:7:"Default";s:6:"colors";a:70:{i:0;s:3:"FFF";i:1;s:3:"FCC";i:2;s:3:"FC9";i:3;s:3:"FF9";i:4;s:3:"FFC";i:5;s:3:"9F9";i:6;s:3:"9FF";i:7;s:3:"CFF";i:8;s:3:"CCF";i:9;s:3:"FCF";i:10;s:3:"CCC";i:11;s:3:"F66";i:12;s:3:"F96";i:13;s:3:"FF6";i:14;s:3:"FF3";i:15;s:3:"6F9";i:16;s:3:"3FF";i:17;s:3:"6FF";i:18;s:3:"99F";i:19;s:3:"F9F";i:20;s:3:"BBB";i:21;s:3:"F00";i:22;s:3:"F90";i:23;s:3:"FC6";i:24;s:3:"FF0";i:25;s:3:"3F3";i:26;s:3:"6CC";i:27;s:3:"3CF";i:28;s:3:"66C";i:29;s:3:"C6C";i:30;s:3:"999";i:31;s:3:"C00";i:32;s:3:"F60";i:33;s:3:"FC3";i:34;s:3:"FC0";i:35;s:3:"3C0";i:36;s:3:"0CC";i:37;s:3:"36F";i:38;s:3:"63F";i:39;s:3:"C3C";i:40;s:3:"666";i:41;s:3:"900";i:42;s:3:"C60";i:43;s:3:"C93";i:44;s:3:"990";i:45;s:3:"090";i:46;s:3:"399";i:47;s:3:"33F";i:48;s:3:"60C";i:49;s:3:"939";i:50;s:3:"333";i:51;s:3:"600";i:52;s:3:"930";i:53;s:3:"963";i:54;s:3:"660";i:55;s:3:"060";i:56;s:3:"366";i:57;s:3:"009";i:58;s:3:"339";i:59;s:3:"636";i:60;s:3:"000";i:61;s:3:"300";i:62;s:3:"630";i:63;s:3:"633";i:64;s:3:"330";i:65;s:3:"030";i:66;s:3:"033";i:67;s:3:"006";i:68;s:3:"309";i:69;s:3:"303";}s:7:"default";s:3:"F00";}i:1;a:3:{s:4:"name";s:9:"Semaphore";s:6:"colors";a:3:{i:0;s:3:"F00";i:1;s:3:"FF3";i:2;s:3:"3C0";}s:7:"default";s:3:"3C0";}}', 'a:15:{s:5:"views";a:4:{i:0;s:7:"viewDay";i:1;s:8:"viewWeek";i:2;s:9:"viewMonth";i:3;s:10:"viewNMonth";}s:11:"viewdefault";s:5:"month";s:8:"language";s:5:"en-GB";s:13:"start_weekday";s:1:"0";s:8:"cssStyle";s:9:"cupertino";s:12:"paletteColor";s:1:"0";s:6:"btoday";s:1:"1";s:11:"bnavigation";s:1:"1";s:8:"brefresh";s:1:"1";s:14:"numberOfMonths";s:2:"12";s:7:"sample0";N;s:7:"sample1";s:5:"click";s:7:"sample2";N;s:7:"sample3";s:0:"";s:7:"sample4";s:10:"new_window";}');

-- --------------------------------------------------------

--
-- Table structure for table `molc_dc_mv_events`
--

CREATE TABLE IF NOT EXISTS `molc_dc_mv_events` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `calid` int(10) unsigned DEFAULT NULL,
  `starttime` datetime DEFAULT NULL,
  `endtime` datetime DEFAULT NULL,
  `title` varchar(250) DEFAULT NULL,
  `location` varchar(250) DEFAULT NULL,
  `description` text,
  `isalldayevent` tinyint(3) unsigned DEFAULT NULL,
  `color` varchar(10) DEFAULT NULL,
  `owner` int(11) DEFAULT NULL,
  `published` tinyint(1) DEFAULT NULL,
  `rrule` varchar(255) DEFAULT NULL,
  `uid` int(10) DEFAULT NULL,
  `exdate` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `molc_dc_mv_free`
--

CREATE TABLE IF NOT EXISTS `molc_dc_mv_free` (
  `id` int(11) unsigned NOT NULL,
  `a` text,
  `b` text,
  `c` text,
  `d` text,
  `e` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `molc_dc_mv_free`
--

INSERT INTO `molc_dc_mv_free` (`id`, `a`, `b`, `c`, `d`, `e`) VALUES
(1, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `molc_easyjoomlabackup`
--

CREATE TABLE IF NOT EXISTS `molc_easyjoomlabackup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `comment` tinytext NOT NULL,
  `type` varchar(32) NOT NULL,
  `size` varchar(12) NOT NULL,
  `duration` varchar(8) NOT NULL,
  `name` tinytext NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `molc_easyjoomlabackup`
--

INSERT INTO `molc_easyjoomlabackup` (`id`, `date`, `comment`, `type`, `size`, `duration`, `name`) VALUES
(1, '2015-08-03 05:58:49', '1st db backup', 'databasebackup', '38964', '1.2', '192.185.194.27-~angsalit_2015-08-03_05-58-49.zip');

-- --------------------------------------------------------

--
-- Table structure for table `molc_extensions`
--

CREATE TABLE IF NOT EXISTS `molc_extensions` (
  `extension_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `type` varchar(20) NOT NULL,
  `element` varchar(100) NOT NULL,
  `folder` varchar(100) NOT NULL,
  `client_id` tinyint(3) NOT NULL,
  `enabled` tinyint(3) NOT NULL DEFAULT '1',
  `access` int(10) unsigned NOT NULL DEFAULT '1',
  `protected` tinyint(3) NOT NULL DEFAULT '0',
  `manifest_cache` text NOT NULL,
  `params` text NOT NULL,
  `custom_data` text NOT NULL,
  `system_data` text NOT NULL,
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) DEFAULT '0',
  `state` int(11) DEFAULT '0',
  PRIMARY KEY (`extension_id`),
  KEY `element_clientid` (`element`,`client_id`),
  KEY `element_folder_clientid` (`element`,`folder`,`client_id`),
  KEY `extension` (`type`,`element`,`folder`,`client_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10016 ;

--
-- Dumping data for table `molc_extensions`
--

INSERT INTO `molc_extensions` (`extension_id`, `name`, `type`, `element`, `folder`, `client_id`, `enabled`, `access`, `protected`, `manifest_cache`, `params`, `custom_data`, `system_data`, `checked_out`, `checked_out_time`, `ordering`, `state`) VALUES
(1, 'com_mailto', 'component', 'com_mailto', '', 0, 1, 1, 1, '{"legacy":false,"name":"com_mailto","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"COM_MAILTO_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(2, 'com_wrapper', 'component', 'com_wrapper', '', 0, 1, 1, 1, '{"legacy":false,"name":"com_wrapper","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.\\n\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"COM_WRAPPER_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(3, 'com_admin', 'component', 'com_admin', '', 1, 1, 1, 1, '{"legacy":false,"name":"com_admin","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.\\n\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"COM_ADMIN_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(4, 'com_banners', 'component', 'com_banners', '', 1, 1, 1, 0, '{"legacy":false,"name":"com_banners","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.\\n\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"COM_BANNERS_XML_DESCRIPTION","group":""}', '{"purchase_type":"3","track_impressions":"0","track_clicks":"0","metakey_prefix":""}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(5, 'com_cache', 'component', 'com_cache', '', 1, 1, 1, 1, '{"legacy":false,"name":"com_cache","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"COM_CACHE_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(6, 'com_categories', 'component', 'com_categories', '', 1, 1, 1, 1, '{"legacy":false,"name":"com_categories","type":"component","creationDate":"December 2007","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"COM_CATEGORIES_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(7, 'com_checkin', 'component', 'com_checkin', '', 1, 1, 1, 1, '{"legacy":false,"name":"com_checkin","type":"component","creationDate":"Unknown","author":"Joomla! Project","copyright":"(C) 2005 - 2008 Open Source Matters. All rights reserved.\\n\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"COM_CHECKIN_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(8, 'com_contact', 'component', 'com_contact', '', 1, 1, 1, 0, '{"legacy":false,"name":"com_contact","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.\\n\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"COM_CONTACT_XML_DESCRIPTION","group":""}', '{"show_contact_category":"hide","show_contact_list":"0","presentation_style":"sliders","show_name":"1","show_position":"1","show_email":"0","show_street_address":"1","show_suburb":"1","show_state":"1","show_postcode":"1","show_country":"1","show_telephone":"1","show_mobile":"1","show_fax":"1","show_webpage":"1","show_misc":"1","show_image":"1","image":"","allow_vcard":"0","show_articles":"0","show_profile":"0","show_links":"0","linka_name":"","linkb_name":"","linkc_name":"","linkd_name":"","linke_name":"","contact_icons":"0","icon_address":"","icon_email":"","icon_telephone":"","icon_mobile":"","icon_fax":"","icon_misc":"","show_headings":"1","show_position_headings":"1","show_email_headings":"0","show_telephone_headings":"1","show_mobile_headings":"0","show_fax_headings":"0","allow_vcard_headings":"0","show_suburb_headings":"1","show_state_headings":"1","show_country_headings":"1","show_email_form":"1","show_email_copy":"1","banned_email":"","banned_subject":"","banned_text":"","validate_session":"1","custom_reply":"0","redirect":"","show_category_crumb":"0","metakey":"","metadesc":"","robots":"","author":"","rights":"","xreference":""}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(9, 'com_cpanel', 'component', 'com_cpanel', '', 1, 1, 1, 1, '{"legacy":false,"name":"com_cpanel","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"COM_CPANEL_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10, 'com_installer', 'component', 'com_installer', '', 1, 1, 1, 1, '{"legacy":false,"name":"com_installer","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"COM_INSTALLER_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(11, 'com_languages', 'component', 'com_languages', '', 1, 1, 1, 1, '{"legacy":false,"name":"com_languages","type":"component","creationDate":"2006","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.\\n\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"COM_LANGUAGES_XML_DESCRIPTION","group":""}', '{"administrator":"en-GB","site":"en-GB"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(12, 'com_login', 'component', 'com_login', '', 1, 1, 1, 1, '{"legacy":false,"name":"com_login","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"COM_LOGIN_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(13, 'com_media', 'component', 'com_media', '', 1, 1, 0, 1, '{"legacy":false,"name":"com_media","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"COM_MEDIA_XML_DESCRIPTION","group":""}', '{"upload_extensions":"bmp,csv,doc,gif,ico,jpg,jpeg,odg,odp,ods,odt,pdf,png,ppt,swf,txt,xcf,xls,BMP,CSV,DOC,GIF,ICO,JPG,JPEG,ODG,ODP,ODS,ODT,PDF,PNG,PPT,SWF,TXT,XCF,XLS","upload_maxsize":"10","file_path":"images","image_path":"images","restrict_uploads":"1","allowed_media_usergroup":"3","check_mime":"1","image_extensions":"bmp,gif,jpg,png","ignore_extensions":"","upload_mime":"image\\/jpeg,image\\/gif,image\\/png,image\\/bmp,application\\/x-shockwave-flash,application\\/msword,application\\/excel,application\\/pdf,application\\/powerpoint,text\\/plain,application\\/x-zip","upload_mime_illegal":"text\\/html"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(14, 'com_menus', 'component', 'com_menus', '', 1, 1, 1, 1, '{"legacy":false,"name":"com_menus","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"COM_MENUS_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(15, 'com_messages', 'component', 'com_messages', '', 1, 1, 1, 1, '{"legacy":false,"name":"com_messages","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"COM_MESSAGES_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(16, 'com_modules', 'component', 'com_modules', '', 1, 1, 1, 1, '{"legacy":false,"name":"com_modules","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"COM_MODULES_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(17, 'com_newsfeeds', 'component', 'com_newsfeeds', '', 1, 1, 1, 0, '{"legacy":false,"name":"com_newsfeeds","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"COM_NEWSFEEDS_XML_DESCRIPTION","group":""}', '{"show_feed_image":"1","show_feed_description":"1","show_item_description":"1","feed_word_count":"0","show_headings":"1","show_name":"1","show_articles":"0","show_link":"1","show_description":"1","show_description_image":"1","display_num":"","show_pagination_limit":"1","show_pagination":"1","show_pagination_results":"1","show_cat_items":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(18, 'com_plugins', 'component', 'com_plugins', '', 1, 1, 1, 1, '{"legacy":false,"name":"com_plugins","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"COM_PLUGINS_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(19, 'com_search', 'component', 'com_search', '', 1, 1, 1, 1, '{"legacy":false,"name":"com_search","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.\\n\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"COM_SEARCH_XML_DESCRIPTION","group":""}', '{"enabled":"0","show_date":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(20, 'com_templates', 'component', 'com_templates', '', 1, 1, 1, 1, '{"legacy":false,"name":"com_templates","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"COM_TEMPLATES_XML_DESCRIPTION","group":""}', '{"template_positions_display":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(21, 'com_weblinks', 'component', 'com_weblinks', '', 1, 1, 1, 0, '{"legacy":false,"name":"com_weblinks","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.\\n\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"COM_WEBLINKS_XML_DESCRIPTION","group":""}', '{"show_comp_description":"1","comp_description":"","show_link_hits":"1","show_link_description":"1","show_other_cats":"0","show_headings":"0","show_numbers":"0","show_report":"1","count_clicks":"1","target":"0","link_icons":""}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(22, 'com_content', 'component', 'com_content', '', 1, 1, 0, 1, '{"legacy":false,"name":"com_content","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"COM_CONTENT_XML_DESCRIPTION","group":""}', '{"article_layout":"_:default","show_title":"1","link_titles":"0","show_intro":"1","show_category":"0","link_category":"0","show_parent_category":"0","link_parent_category":"0","show_author":"0","link_author":"0","show_create_date":"0","show_modify_date":"0","show_publish_date":"0","show_item_navigation":"0","show_vote":"0","show_readmore":"1","show_readmore_title":"0","readmore_limit":"100","show_icons":"1","show_print_icon":"1","show_email_icon":"1","show_hits":"0","show_noauth":"0","urls_position":"0","show_publishing_options":"1","show_article_options":"1","show_urls_images_frontend":"0","show_urls_images_backend":"1","targeta":0,"targetb":0,"targetc":0,"float_intro":"left","float_fulltext":"left","category_layout":"_:blog","show_category_heading_title_text":"1","show_category_title":"0","show_description":"0","show_description_image":"0","maxLevel":"1","show_empty_categories":"0","show_no_articles":"1","show_subcat_desc":"1","show_cat_num_articles":"0","show_base_description":"1","maxLevelcat":"-1","show_empty_categories_cat":"0","show_subcat_desc_cat":"1","show_cat_num_articles_cat":"1","num_leading_articles":"1","num_intro_articles":"4","num_columns":"1","num_links":"0","multi_column_order":"0","show_subcategory_content":"0","show_pagination_limit":"1","filter_field":"hide","show_headings":"1","list_show_date":"0","date_format":"","list_show_hits":"1","list_show_author":"1","orderby_pri":"order","orderby_sec":"rdate","order_date":"published","show_pagination":"2","show_pagination_results":"1","show_feed_link":"1","feed_summary":"0","feed_show_readmore":"0"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(23, 'com_config', 'component', 'com_config', '', 1, 1, 0, 1, '{"legacy":false,"name":"com_config","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"COM_CONFIG_XML_DESCRIPTION","group":""}', '{"filters":{"1":{"filter_type":"NH","filter_tags":"","filter_attributes":""},"6":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"7":{"filter_type":"NONE","filter_tags":"","filter_attributes":""},"2":{"filter_type":"NH","filter_tags":"","filter_attributes":""},"3":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"4":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"5":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"10":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"12":{"filter_type":"BL","filter_tags":"","filter_attributes":""},"8":{"filter_type":"NONE","filter_tags":"","filter_attributes":""}}}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(24, 'com_redirect', 'component', 'com_redirect', '', 1, 1, 0, 1, '{"legacy":false,"name":"com_redirect","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"COM_REDIRECT_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(25, 'com_users', 'component', 'com_users', '', 1, 1, 0, 1, '{"legacy":false,"name":"com_users","type":"component","creationDate":"April 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"COM_USERS_XML_DESCRIPTION","group":""}', '{"allowUserRegistration":"1","new_usertype":"2","guest_usergroup":"1","sendpassword":"1","useractivation":"2","mail_to_admin":"1","captcha":"","frontend_userparams":"1","site_language":"0","change_login_name":"0","reset_count":"10","reset_time":"1","mailSubjectPrefix":"","mailBodySuffix":""}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(27, 'com_finder', 'component', 'com_finder', '', 1, 1, 0, 0, '{"legacy":false,"name":"com_finder","type":"component","creationDate":"August 2011","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"COM_FINDER_XML_DESCRIPTION","group":""}', '{"show_description":"1","description_length":255,"allow_empty_query":"0","show_url":"1","show_advanced":"1","expand_advanced":"0","show_date_filters":"0","highlight_terms":"1","opensearch_name":"","opensearch_description":"","batch_size":"50","memory_table_limit":30000,"title_multiplier":"1.7","text_multiplier":"0.7","meta_multiplier":"1.2","path_multiplier":"2.0","misc_multiplier":"0.3","stemmer":"snowball"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(28, 'com_joomlaupdate', 'component', 'com_joomlaupdate', '', 1, 1, 0, 1, '{"legacy":false,"name":"com_joomlaupdate","type":"component","creationDate":"February 2012","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.\\t","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"COM_JOOMLAUPDATE_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(100, 'PHPMailer', 'library', 'phpmailer', '', 0, 1, 1, 1, '{"legacy":false,"name":"PHPMailer","type":"library","creationDate":"2001","author":"PHPMailer","copyright":"(c) 2001-2003, Brent R. Matzelle, (c) 2004-2009, Andy Prevost. All Rights Reserved., (c) 2010-2011, Jim Jagielski. All Rights Reserved.","authorEmail":"jimjag@gmail.com","authorUrl":"https:\\/\\/code.google.com\\/a\\/apache-extras.org\\/p\\/phpmailer\\/","version":"5.2","description":"LIB_PHPMAILER_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(101, 'SimplePie', 'library', 'simplepie', '', 0, 1, 1, 1, '{"legacy":false,"name":"SimplePie","type":"library","creationDate":"2004","author":"SimplePie","copyright":"Copyright (c) 2004-2009, Ryan Parman and Geoffrey Sneddon","authorEmail":"","authorUrl":"http:\\/\\/simplepie.org\\/","version":"1.2","description":"LIB_SIMPLEPIE_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(102, 'phputf8', 'library', 'phputf8', '', 0, 1, 1, 1, '{"legacy":false,"name":"phputf8","type":"library","creationDate":"2006","author":"Harry Fuecks","copyright":"Copyright various authors","authorEmail":"hfuecks@gmail.com","authorUrl":"http:\\/\\/sourceforge.net\\/projects\\/phputf8","version":"0.5","description":"LIB_PHPUTF8_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(103, 'Joomla! Platform', 'library', 'joomla', '', 0, 1, 1, 1, '{"legacy":false,"name":"Joomla! Platform","type":"library","creationDate":"2008","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"http:\\/\\/www.joomla.org","version":"11.4","description":"LIB_JOOMLA_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(200, 'mod_articles_archive', 'module', 'mod_articles_archive', '', 0, 1, 1, 1, '{"legacy":false,"name":"mod_articles_archive","type":"module","creationDate":"July 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters.\\n\\t\\tAll rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_ARTICLES_ARCHIVE_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(201, 'mod_articles_latest', 'module', 'mod_articles_latest', '', 0, 1, 1, 1, '{"legacy":false,"name":"mod_articles_latest","type":"module","creationDate":"July 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_LATEST_NEWS_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(202, 'mod_articles_popular', 'module', 'mod_articles_popular', '', 0, 1, 1, 0, '{"legacy":false,"name":"mod_articles_popular","type":"module","creationDate":"July 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_POPULAR_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(203, 'mod_banners', 'module', 'mod_banners', '', 0, 1, 1, 0, '{"legacy":false,"name":"mod_banners","type":"module","creationDate":"July 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_BANNERS_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(204, 'mod_breadcrumbs', 'module', 'mod_breadcrumbs', '', 0, 1, 1, 1, '{"legacy":false,"name":"mod_breadcrumbs","type":"module","creationDate":"July 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_BREADCRUMBS_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(205, 'mod_custom', 'module', 'mod_custom', '', 0, 1, 1, 1, '{"legacy":false,"name":"mod_custom","type":"module","creationDate":"July 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_CUSTOM_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(206, 'mod_feed', 'module', 'mod_feed', '', 0, 1, 1, 1, '{"legacy":false,"name":"mod_feed","type":"module","creationDate":"July 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_FEED_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(207, 'mod_footer', 'module', 'mod_footer', '', 0, 1, 1, 1, '{"legacy":false,"name":"mod_footer","type":"module","creationDate":"July 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_FOOTER_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(208, 'mod_login', 'module', 'mod_login', '', 0, 1, 1, 1, '{"legacy":false,"name":"mod_login","type":"module","creationDate":"July 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_LOGIN_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(209, 'mod_menu', 'module', 'mod_menu', '', 0, 1, 1, 1, '{"legacy":false,"name":"mod_menu","type":"module","creationDate":"July 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_MENU_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(210, 'mod_articles_news', 'module', 'mod_articles_news', '', 0, 1, 1, 0, '{"legacy":false,"name":"mod_articles_news","type":"module","creationDate":"July 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_ARTICLES_NEWS_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(211, 'mod_random_image', 'module', 'mod_random_image', '', 0, 1, 1, 0, '{"legacy":false,"name":"mod_random_image","type":"module","creationDate":"July 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_RANDOM_IMAGE_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(212, 'mod_related_items', 'module', 'mod_related_items', '', 0, 1, 1, 0, '{"legacy":false,"name":"mod_related_items","type":"module","creationDate":"July 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_RELATED_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(213, 'mod_search', 'module', 'mod_search', '', 0, 1, 1, 0, '{"legacy":false,"name":"mod_search","type":"module","creationDate":"July 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_SEARCH_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(214, 'mod_stats', 'module', 'mod_stats', '', 0, 1, 1, 0, '{"legacy":false,"name":"mod_stats","type":"module","creationDate":"July 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_STATS_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(215, 'mod_syndicate', 'module', 'mod_syndicate', '', 0, 1, 1, 1, '{"legacy":false,"name":"mod_syndicate","type":"module","creationDate":"May 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_SYNDICATE_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(216, 'mod_users_latest', 'module', 'mod_users_latest', '', 0, 1, 1, 1, '{"legacy":false,"name":"mod_users_latest","type":"module","creationDate":"December 2009","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_USERS_LATEST_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(217, 'mod_weblinks', 'module', 'mod_weblinks', '', 0, 1, 1, 0, '{"legacy":false,"name":"mod_weblinks","type":"module","creationDate":"July 2009","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_WEBLINKS_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(218, 'mod_whosonline', 'module', 'mod_whosonline', '', 0, 1, 1, 0, '{"legacy":false,"name":"mod_whosonline","type":"module","creationDate":"July 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_WHOSONLINE_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(219, 'mod_wrapper', 'module', 'mod_wrapper', '', 0, 1, 1, 0, '{"legacy":false,"name":"mod_wrapper","type":"module","creationDate":"October 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_WRAPPER_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(220, 'mod_articles_category', 'module', 'mod_articles_category', '', 0, 1, 1, 1, '{"legacy":false,"name":"mod_articles_category","type":"module","creationDate":"February 2010","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_ARTICLES_CATEGORY_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(221, 'mod_articles_categories', 'module', 'mod_articles_categories', '', 0, 1, 1, 1, '{"legacy":false,"name":"mod_articles_categories","type":"module","creationDate":"February 2010","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_ARTICLES_CATEGORIES_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(222, 'mod_languages', 'module', 'mod_languages', '', 0, 1, 1, 1, '{"legacy":false,"name":"mod_languages","type":"module","creationDate":"February 2010","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_LANGUAGES_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(223, 'mod_finder', 'module', 'mod_finder', '', 0, 1, 0, 0, '{"legacy":false,"name":"mod_finder","type":"module","creationDate":"August 2011","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_FINDER_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(300, 'mod_custom', 'module', 'mod_custom', '', 1, 1, 1, 1, '{"legacy":false,"name":"mod_custom","type":"module","creationDate":"July 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_CUSTOM_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(301, 'mod_feed', 'module', 'mod_feed', '', 1, 1, 1, 0, '{"legacy":false,"name":"mod_feed","type":"module","creationDate":"July 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_FEED_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(302, 'mod_latest', 'module', 'mod_latest', '', 1, 1, 1, 0, '{"legacy":false,"name":"mod_latest","type":"module","creationDate":"July 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_LATEST_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(303, 'mod_logged', 'module', 'mod_logged', '', 1, 1, 1, 0, '{"legacy":false,"name":"mod_logged","type":"module","creationDate":"January 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_LOGGED_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(304, 'mod_login', 'module', 'mod_login', '', 1, 1, 1, 1, '{"legacy":false,"name":"mod_login","type":"module","creationDate":"March 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_LOGIN_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(305, 'mod_menu', 'module', 'mod_menu', '', 1, 1, 1, 0, '{"legacy":false,"name":"mod_menu","type":"module","creationDate":"March 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_MENU_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(307, 'mod_popular', 'module', 'mod_popular', '', 1, 1, 1, 0, '{"legacy":false,"name":"mod_popular","type":"module","creationDate":"July 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_POPULAR_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(308, 'mod_quickicon', 'module', 'mod_quickicon', '', 1, 1, 1, 1, '{"legacy":false,"name":"mod_quickicon","type":"module","creationDate":"Nov 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_QUICKICON_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(309, 'mod_status', 'module', 'mod_status', '', 1, 1, 1, 0, '{"legacy":false,"name":"mod_status","type":"module","creationDate":"Feb 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_STATUS_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(310, 'mod_submenu', 'module', 'mod_submenu', '', 1, 1, 1, 0, '{"legacy":false,"name":"mod_submenu","type":"module","creationDate":"Feb 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_SUBMENU_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(311, 'mod_title', 'module', 'mod_title', '', 1, 1, 1, 0, '{"legacy":false,"name":"mod_title","type":"module","creationDate":"Nov 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_TITLE_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(312, 'mod_toolbar', 'module', 'mod_toolbar', '', 1, 1, 1, 1, '{"legacy":false,"name":"mod_toolbar","type":"module","creationDate":"Nov 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_TOOLBAR_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(313, 'mod_multilangstatus', 'module', 'mod_multilangstatus', '', 1, 1, 1, 0, '{"legacy":false,"name":"mod_multilangstatus","type":"module","creationDate":"September 2011","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_MULTILANGSTATUS_XML_DESCRIPTION","group":""}', '{"cache":"0"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(314, 'mod_version', 'module', 'mod_version', '', 1, 1, 1, 0, '{"legacy":false,"name":"mod_version","type":"module","creationDate":"January 2012","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"MOD_VERSION_XML_DESCRIPTION","group":""}', '{"format":"short","product":"1","cache":"0"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(400, 'plg_authentication_gmail', 'plugin', 'gmail', 'authentication', 0, 0, 1, 0, '{"legacy":false,"name":"plg_authentication_gmail","type":"plugin","creationDate":"February 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_GMAIL_XML_DESCRIPTION","group":""}', '{"applysuffix":"0","suffix":"","verifypeer":"1","user_blacklist":""}', '', '', 0, '0000-00-00 00:00:00', 1, 0),
(401, 'plg_authentication_joomla', 'plugin', 'joomla', 'authentication', 0, 1, 1, 1, '{"legacy":false,"name":"plg_authentication_joomla","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_AUTH_JOOMLA_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(402, 'plg_authentication_ldap', 'plugin', 'ldap', 'authentication', 0, 0, 1, 0, '{"legacy":false,"name":"plg_authentication_ldap","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_LDAP_XML_DESCRIPTION","group":""}', '{"host":"","port":"389","use_ldapV3":"0","negotiate_tls":"0","no_referrals":"0","auth_method":"bind","base_dn":"","search_string":"","users_dn":"","username":"admin","password":"bobby7","ldap_fullname":"fullName","ldap_email":"mail","ldap_uid":"uid"}', '', '', 0, '0000-00-00 00:00:00', 3, 0),
(404, 'plg_content_emailcloak', 'plugin', 'emailcloak', 'content', 0, 1, 1, 0, '{"legacy":false,"name":"plg_content_emailcloak","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_CONTENT_EMAILCLOAK_XML_DESCRIPTION","group":""}', '{"mode":"1"}', '', '', 0, '0000-00-00 00:00:00', 1, 0),
(405, 'plg_content_geshi', 'plugin', 'geshi', 'content', 0, 0, 1, 0, '{"legacy":false,"name":"plg_content_geshi","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"","authorUrl":"qbnz.com\\/highlighter","version":"2.5.0","description":"PLG_CONTENT_GESHI_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 2, 0),
(406, 'plg_content_loadmodule', 'plugin', 'loadmodule', 'content', 0, 1, 1, 0, '{"legacy":false,"name":"plg_content_loadmodule","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_LOADMODULE_XML_DESCRIPTION","group":""}', '{"style":"xhtml"}', '', '', 0, '2011-09-18 15:22:50', 0, 0),
(407, 'plg_content_pagebreak', 'plugin', 'pagebreak', 'content', 0, 1, 1, 1, '{"legacy":false,"name":"plg_content_pagebreak","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_CONTENT_PAGEBREAK_XML_DESCRIPTION","group":""}', '{"title":"1","multipage_toc":"1","showall":"1"}', '', '', 0, '0000-00-00 00:00:00', 4, 0),
(408, 'plg_content_pagenavigation', 'plugin', 'pagenavigation', 'content', 0, 1, 1, 1, '{"legacy":false,"name":"plg_content_pagenavigation","type":"plugin","creationDate":"January 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_PAGENAVIGATION_XML_DESCRIPTION","group":""}', '{"position":"1"}', '', '', 0, '0000-00-00 00:00:00', 5, 0),
(409, 'plg_content_vote', 'plugin', 'vote', 'content', 0, 1, 1, 1, '{"legacy":false,"name":"plg_content_vote","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_VOTE_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 6, 0),
(410, 'plg_editors_codemirror', 'plugin', 'codemirror', 'editors', 0, 1, 1, 1, '{"legacy":false,"name":"plg_editors_codemirror","type":"plugin","creationDate":"28 March 2011","author":"Marijn Haverbeke","copyright":"","authorEmail":"N\\/A","authorUrl":"","version":"1.0","description":"PLG_CODEMIRROR_XML_DESCRIPTION","group":""}', '{"linenumbers":"0","tabmode":"indent"}', '', '', 0, '0000-00-00 00:00:00', 1, 0),
(411, 'plg_editors_none', 'plugin', 'none', 'editors', 0, 1, 1, 1, '{"legacy":false,"name":"plg_editors_none","type":"plugin","creationDate":"August 2004","author":"Unknown","copyright":"","authorEmail":"N\\/A","authorUrl":"","version":"2.5.0","description":"PLG_NONE_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 2, 0),
(412, 'plg_editors_tinymce', 'plugin', 'tinymce', 'editors', 0, 1, 1, 1, '{"legacy":false,"name":"plg_editors_tinymce","type":"plugin","creationDate":"2005-2013","author":"Moxiecode Systems AB","copyright":"Moxiecode Systems AB","authorEmail":"N\\/A","authorUrl":"tinymce.moxiecode.com\\/","version":"3.5.4.1","description":"PLG_TINY_XML_DESCRIPTION","group":""}', '{"mode":"1","skin":"0","entity_encoding":"raw","lang_mode":"0","lang_code":"en","text_direction":"ltr","content_css":"1","content_css_custom":"","relative_urls":"1","newlines":"0","invalid_elements":"script,applet,iframe","extended_elements":"","toolbar":"top","toolbar_align":"left","html_height":"550","html_width":"750","resizing":"true","resize_horizontal":"false","element_path":"1","fonts":"1","paste":"1","searchreplace":"1","insertdate":"1","format_date":"%Y-%m-%d","inserttime":"1","format_time":"%H:%M:%S","colors":"1","table":"1","smilies":"1","media":"1","hr":"1","directionality":"1","fullscreen":"1","style":"1","layer":"1","xhtmlxtras":"1","visualchars":"1","nonbreaking":"1","template":"1","blockquote":"1","wordcount":"1","advimage":"1","advlink":"1","advlist":"1","autosave":"1","contextmenu":"1","inlinepopups":"1","custom_plugin":"","custom_button":""}', '', '', 0, '0000-00-00 00:00:00', 3, 0),
(413, 'plg_editors-xtd_article', 'plugin', 'article', 'editors-xtd', 0, 1, 1, 1, '{"legacy":false,"name":"plg_editors-xtd_article","type":"plugin","creationDate":"October 2009","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_ARTICLE_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 1, 0),
(414, 'plg_editors-xtd_image', 'plugin', 'image', 'editors-xtd', 0, 1, 1, 0, '{"legacy":false,"name":"plg_editors-xtd_image","type":"plugin","creationDate":"August 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_IMAGE_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 2, 0),
(415, 'plg_editors-xtd_pagebreak', 'plugin', 'pagebreak', 'editors-xtd', 0, 1, 1, 0, '{"legacy":false,"name":"plg_editors-xtd_pagebreak","type":"plugin","creationDate":"August 2004","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_EDITORSXTD_PAGEBREAK_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 3, 0),
(416, 'plg_editors-xtd_readmore', 'plugin', 'readmore', 'editors-xtd', 0, 1, 1, 0, '{"legacy":false,"name":"plg_editors-xtd_readmore","type":"plugin","creationDate":"March 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_READMORE_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 4, 0),
(417, 'plg_search_categories', 'plugin', 'categories', 'search', 0, 1, 1, 0, '{"legacy":false,"name":"plg_search_categories","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_SEARCH_CATEGORIES_XML_DESCRIPTION","group":""}', '{"search_limit":"50","search_content":"1","search_archived":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(418, 'plg_search_contacts', 'plugin', 'contacts', 'search', 0, 1, 1, 0, '{"legacy":false,"name":"plg_search_contacts","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_SEARCH_CONTACTS_XML_DESCRIPTION","group":""}', '{"search_limit":"50","search_content":"1","search_archived":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(419, 'plg_search_content', 'plugin', 'content', 'search', 0, 1, 1, 0, '{"legacy":false,"name":"plg_search_content","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_SEARCH_CONTENT_XML_DESCRIPTION","group":""}', '{"search_limit":"50","search_content":"1","search_archived":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(420, 'plg_search_newsfeeds', 'plugin', 'newsfeeds', 'search', 0, 1, 1, 0, '{"legacy":false,"name":"plg_search_newsfeeds","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_SEARCH_NEWSFEEDS_XML_DESCRIPTION","group":""}', '{"search_limit":"50","search_content":"1","search_archived":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(421, 'plg_search_weblinks', 'plugin', 'weblinks', 'search', 0, 1, 1, 0, '{"legacy":false,"name":"plg_search_weblinks","type":"plugin","creationDate":"November 2005","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_SEARCH_WEBLINKS_XML_DESCRIPTION","group":""}', '{"search_limit":"50","search_content":"1","search_archived":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(422, 'plg_system_languagefilter', 'plugin', 'languagefilter', 'system', 0, 0, 1, 1, '{"legacy":false,"name":"plg_system_languagefilter","type":"plugin","creationDate":"July 2010","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_SYSTEM_LANGUAGEFILTER_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 1, 0),
(423, 'plg_system_p3p', 'plugin', 'p3p', 'system', 0, 1, 1, 1, '{"legacy":false,"name":"plg_system_p3p","type":"plugin","creationDate":"September 2010","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_P3P_XML_DESCRIPTION","group":""}', '{"headers":"NOI ADM DEV PSAi COM NAV OUR OTRo STP IND DEM"}', '', '', 0, '0000-00-00 00:00:00', 2, 0),
(424, 'plg_system_cache', 'plugin', 'cache', 'system', 0, 0, 1, 1, '{"legacy":false,"name":"plg_system_cache","type":"plugin","creationDate":"February 2007","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_CACHE_XML_DESCRIPTION","group":""}', '{"browsercache":"0","cachetime":"15"}', '', '', 0, '0000-00-00 00:00:00', 9, 0),
(425, 'plg_system_debug', 'plugin', 'debug', 'system', 0, 1, 1, 0, '{"legacy":false,"name":"plg_system_debug","type":"plugin","creationDate":"December 2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_DEBUG_XML_DESCRIPTION","group":""}', '{"profile":"1","queries":"1","memory":"1","language_files":"1","language_strings":"1","strip-first":"1","strip-prefix":"","strip-suffix":""}', '', '', 0, '0000-00-00 00:00:00', 4, 0),
(426, 'plg_system_log', 'plugin', 'log', 'system', 0, 1, 1, 1, '{"legacy":false,"name":"plg_system_log","type":"plugin","creationDate":"April 2007","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_LOG_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 5, 0);
INSERT INTO `molc_extensions` (`extension_id`, `name`, `type`, `element`, `folder`, `client_id`, `enabled`, `access`, `protected`, `manifest_cache`, `params`, `custom_data`, `system_data`, `checked_out`, `checked_out_time`, `ordering`, `state`) VALUES
(427, 'plg_system_redirect', 'plugin', 'redirect', 'system', 0, 1, 1, 1, '{"legacy":false,"name":"plg_system_redirect","type":"plugin","creationDate":"April 2009","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_REDIRECT_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 6, 0),
(428, 'plg_system_remember', 'plugin', 'remember', 'system', 0, 1, 1, 1, '{"legacy":false,"name":"plg_system_remember","type":"plugin","creationDate":"April 2007","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_REMEMBER_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 7, 0),
(429, 'plg_system_sef', 'plugin', 'sef', 'system', 0, 1, 1, 0, '{"legacy":false,"name":"plg_system_sef","type":"plugin","creationDate":"December 2007","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_SEF_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 8, 0),
(430, 'plg_system_logout', 'plugin', 'logout', 'system', 0, 1, 1, 1, '{"legacy":false,"name":"plg_system_logout","type":"plugin","creationDate":"April 2009","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_SYSTEM_LOGOUT_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 3, 0),
(431, 'plg_user_contactcreator', 'plugin', 'contactcreator', 'user', 0, 0, 1, 1, '{"legacy":false,"name":"plg_user_contactcreator","type":"plugin","creationDate":"August 2009","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_CONTACTCREATOR_XML_DESCRIPTION","group":""}', '{"autowebpage":"","category":"34","autopublish":"0"}', '', '', 0, '0000-00-00 00:00:00', 1, 0),
(432, 'plg_user_joomla', 'plugin', 'joomla', 'user', 0, 1, 1, 0, '{"legacy":false,"name":"plg_user_joomla","type":"plugin","creationDate":"December 2006","author":"Joomla! Project","copyright":"(C) 2005 - 2009 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_USER_JOOMLA_XML_DESCRIPTION","group":""}', '{"autoregister":"1"}', '', '', 0, '0000-00-00 00:00:00', 2, 0),
(433, 'plg_user_profile', 'plugin', 'profile', 'user', 0, 0, 1, 1, '{"legacy":false,"name":"plg_user_profile","type":"plugin","creationDate":"January 2008","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_USER_PROFILE_XML_DESCRIPTION","group":""}', '{"register-require_address1":"1","register-require_address2":"1","register-require_city":"1","register-require_region":"1","register-require_country":"1","register-require_postal_code":"1","register-require_phone":"1","register-require_website":"1","register-require_favoritebook":"1","register-require_aboutme":"1","register-require_tos":"1","register-require_dob":"1","profile-require_address1":"1","profile-require_address2":"1","profile-require_city":"1","profile-require_region":"1","profile-require_country":"1","profile-require_postal_code":"1","profile-require_phone":"1","profile-require_website":"1","profile-require_favoritebook":"1","profile-require_aboutme":"1","profile-require_tos":"1","profile-require_dob":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(434, 'plg_extension_joomla', 'plugin', 'joomla', 'extension', 0, 1, 1, 1, '{"legacy":false,"name":"plg_extension_joomla","type":"plugin","creationDate":"May 2010","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_EXTENSION_JOOMLA_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 1, 0),
(435, 'plg_content_joomla', 'plugin', 'joomla', 'content', 0, 1, 1, 0, '{"legacy":false,"name":"plg_content_joomla","type":"plugin","creationDate":"November 2010","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_CONTENT_JOOMLA_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(436, 'plg_system_languagecode', 'plugin', 'languagecode', 'system', 0, 0, 1, 0, '{"legacy":false,"name":"plg_system_languagecode","type":"plugin","creationDate":"November 2011","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_SYSTEM_LANGUAGECODE_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 10, 0),
(437, 'plg_quickicon_joomlaupdate', 'plugin', 'joomlaupdate', 'quickicon', 0, 1, 1, 1, '{"legacy":false,"name":"plg_quickicon_joomlaupdate","type":"plugin","creationDate":"August 2011","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_QUICKICON_JOOMLAUPDATE_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(438, 'plg_quickicon_extensionupdate', 'plugin', 'extensionupdate', 'quickicon', 0, 1, 1, 1, '{"legacy":false,"name":"plg_quickicon_extensionupdate","type":"plugin","creationDate":"August 2011","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_QUICKICON_EXTENSIONUPDATE_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(439, 'plg_captcha_recaptcha', 'plugin', 'recaptcha', 'captcha', 0, 0, 1, 0, '{"legacy":false,"name":"plg_captcha_recaptcha","type":"plugin","creationDate":"December 2011","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_CAPTCHA_RECAPTCHA_XML_DESCRIPTION","group":""}', '{"public_key":"","private_key":"","theme":"clean"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(440, 'plg_system_highlight', 'plugin', 'highlight', 'system', 0, 1, 1, 0, '{"legacy":false,"name":"plg_system_highlight","type":"plugin","creationDate":"August 2011","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_SYSTEM_HIGHLIGHT_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 7, 0),
(441, 'plg_content_finder', 'plugin', 'finder', 'content', 0, 0, 1, 0, '{"legacy":false,"name":"plg_content_finder","type":"plugin","creationDate":"December 2011","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_CONTENT_FINDER_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(442, 'plg_finder_categories', 'plugin', 'categories', 'finder', 0, 1, 1, 0, '{"legacy":false,"name":"plg_finder_categories","type":"plugin","creationDate":"August 2011","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_FINDER_CATEGORIES_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 1, 0),
(443, 'plg_finder_contacts', 'plugin', 'contacts', 'finder', 0, 1, 1, 0, '{"legacy":false,"name":"plg_finder_contacts","type":"plugin","creationDate":"August 2011","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_FINDER_CONTACTS_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 2, 0),
(444, 'plg_finder_content', 'plugin', 'content', 'finder', 0, 1, 1, 0, '{"legacy":false,"name":"plg_finder_content","type":"plugin","creationDate":"August 2011","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_FINDER_CONTENT_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 3, 0),
(445, 'plg_finder_newsfeeds', 'plugin', 'newsfeeds', 'finder', 0, 1, 1, 0, '{"legacy":false,"name":"plg_finder_newsfeeds","type":"plugin","creationDate":"August 2011","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_FINDER_NEWSFEEDS_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 4, 0),
(446, 'plg_finder_weblinks', 'plugin', 'weblinks', 'finder', 0, 1, 1, 0, '{"legacy":false,"name":"plg_finder_weblinks","type":"plugin","creationDate":"August 2011","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"PLG_FINDER_WEBLINKS_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 5, 0),
(500, 'atomic', 'template', 'atomic', '', 0, 1, 1, 0, '{"legacy":false,"name":"atomic","type":"template","creationDate":"10\\/10\\/09","author":"Ron Severdia","copyright":"Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.","authorEmail":"contact@kontentdesign.com","authorUrl":"http:\\/\\/www.kontentdesign.com","version":"2.5.0","description":"TPL_ATOMIC_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(502, 'bluestork', 'template', 'bluestork', '', 1, 1, 1, 0, '{"legacy":false,"name":"bluestork","type":"template","creationDate":"07\\/02\\/09","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.0","description":"TPL_BLUESTORK_XML_DESCRIPTION","group":""}', '{"useRoundedCorners":"1","showSiteName":"0","textBig":"0","highContrast":"0"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(503, 'beez_20', 'template', 'beez_20', '', 0, 1, 1, 0, '{"legacy":false,"name":"beez_20","type":"template","creationDate":"25 November 2009","author":"Angie Radtke","copyright":"Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.","authorEmail":"a.radtke@derauftritt.de","authorUrl":"http:\\/\\/www.der-auftritt.de","version":"2.5.0","description":"TPL_BEEZ2_XML_DESCRIPTION","group":""}', '{"wrapperSmall":"53","wrapperLarge":"72","sitetitle":"","sitedescription":"","navposition":"center","templatecolor":"nature"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(504, 'hathor', 'template', 'hathor', '', 1, 1, 1, 0, '{"legacy":false,"name":"hathor","type":"template","creationDate":"May 2010","author":"Andrea Tarr","copyright":"Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.","authorEmail":"hathor@tarrconsulting.com","authorUrl":"http:\\/\\/www.tarrconsulting.com","version":"2.5.0","description":"TPL_HATHOR_XML_DESCRIPTION","group":""}', '{"showSiteName":"0","colourChoice":"0","boldText":"0"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(505, 'beez5', 'template', 'beez5', '', 0, 1, 1, 0, '{"legacy":false,"name":"beez5","type":"template","creationDate":"21 May 2010","author":"Angie Radtke","copyright":"Copyright (C) 2005 - 2014 Open Source Matters, Inc. All rights reserved.","authorEmail":"a.radtke@derauftritt.de","authorUrl":"http:\\/\\/www.der-auftritt.de","version":"2.5.0","description":"TPL_BEEZ5_XML_DESCRIPTION","group":""}', '{"wrapperSmall":"53","wrapperLarge":"72","sitetitle":"","sitedescription":"","navposition":"center","html5":"0"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(600, 'English (United Kingdom)', 'language', 'en-GB', '', 0, 1, 1, 1, '{"legacy":false,"name":"English (United Kingdom)","type":"language","creationDate":"2008-03-15","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.19","description":"en-GB site language","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(601, 'English (United Kingdom)', 'language', 'en-GB', '', 1, 1, 1, 1, '{"legacy":false,"name":"English (United Kingdom)","type":"language","creationDate":"2008-03-15","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.19","description":"en-GB administrator language","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(700, 'files_joomla', 'file', 'joomla', '', 0, 1, 1, 1, '{"legacy":false,"name":"files_joomla","type":"file","creationDate":"July 2014","author":"Joomla! Project","copyright":"(C) 2005 - 2014 Open Source Matters. All rights reserved","authorEmail":"admin@joomla.org","authorUrl":"www.joomla.org","version":"2.5.24","description":"FILES_JOOMLA_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(800, 'PKG_JOOMLA', 'package', 'pkg_joomla', '', 0, 1, 1, 1, '{"legacy":false,"name":"PKG_JOOMLA","type":"package","creationDate":"2006","author":"Joomla! Project","copyright":"Copyright (C) 2005 - 2014 Open Source Matters. All rights reserved.","authorEmail":"admin@joomla.org","authorUrl":"http:\\/\\/www.joomla.org","version":"2.5.0","description":"PKG_JOOMLA_XML_DESCRIPTION","group":""}', '', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10000, 'jp_dailypraise2_j1.5', 'template', 'jp_dailypraise2_j1.5', '', 0, 1, 1, 0, '{"legacy":true,"name":"jp_dailypraise2_j1.5","type":"template","creationDate":"02\\/15\\/10","author":"www.joomlapraise.com","copyright":"Copyright 2010 PixelPraise LLC, All rights reserved.","authorEmail":"support@joomlapraise.com","authorUrl":"http:\\/\\/www.joomlapraise.com","version":"2.0.1","description":"DailyPraise Redux Joomla! Template with K2 compatibility","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10001, 'jp_bloq_j25', 'template', 'jp_bloq_j25', '', 0, 1, 1, 0, '{"legacy":false,"name":"jp_bloq_j25","type":"template","creationDate":"04\\/03\\/12","author":"JoomlaPraise","copyright":"Copyright 2010 JoomlaPraise, All rights reserved.","authorEmail":"support@joomlapraise.com","authorUrl":"http:\\/\\/www.joomlapraise.com","version":"2.5.0","description":"Bloq 2.5 Joomla! Template","group":""}', '{"templateTheme":"theme1","switchSidebar":"right","fontFamily":"arial","headingFontFamily":"yanone","fontColor":"","headingColor":"","linkColor":"","linkHoverColor":"","topMenuColor":"","headerColor":"","mainMenuColor":"","bannerColor":"","pathwayColor":"","insetColor":"","posColor":"","elementsColor":"","searchColor":"","footerColor":""}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10002, 'Lof ArticlesSlideShow Module', 'module', 'mod_lofarticlesslideshow', '', 0, 1, 0, 0, '{"legacy":false,"name":"Lof ArticlesSlideShow Module","type":"module","creationDate":"Jan 2012","author":"LandOfCoder","copyright":"GNU \\/ GPL2 http:\\/\\/www.gnu.org\\/licenses\\/gpl-2.0.html","authorEmail":"landofcoder@gmail.com","authorUrl":"http:\\/\\/www.landofcoder.com","version":"2.2","description":"\\n    <div style=\\"font-size:11px;\\">\\n      <i>\\n      The ArticleSlideshow Module is as best choice and \\n      the most eye-catching way to display featured  articles on in a rich\\n      slideshow, usually put in the head position of the main site. \\n      The module supports flexible showing content\\n      of each slider and easy to fit your website with one of themes, \\n      skins.\\n      <\\/i>\\n      <p><img src=\\"..\\/modules\\/mod_lofarticlesslideshow\\/assets\\/lof-articleslideshow.png\\" style=\\"width:100%\\"><h4>Module Information:<\\/h4><ul><li><a href=''http:\\/\\/landofcoder.com\\/joomla\\/f33\\/lof-articlesslideshow-module'' target=''_blank''>+ Detail<\\/a><\\/li>\\n      <li><a href=''http:\\/\\/landofcoder.com\\/forum\\/supports.html'' target=''_blank''>+ Forum Support<\\/a><\\/li><li><a href=\\"http:\\/\\/landofcoder.com\\/submit-request.html\\" target=''_blank''>+ Email Request<\\/a><\\/li>\\n      <\\/ul><\\/p><br><div>@Copyright: <a href=''http:\\/\\/landofcoder.com'' target=''_blank''>LandOfCoder.com<\\/a><\\/div>\\n  ","group":""}', '{"moduleclass_sfx":"","theme":"","enable_css3":"1","limit_description_by":"char","title_max_chars":"100","description_max_chars":"100","replacer":"...","module_height":"auto","module_width":"auto","preload":"1","start_item":"0","main_height":"300","main_width":"650","slider_information":"1","enable_image_link":"0","enable_playstop":"1","display_button":"1","desc_opacity":"1","enable_blockdescription":"1","override_links":"","custom_slider_class":"","navigator_pos":"right","navitem_height":"100","navitem_width":"310","max_items_display":"3","thumbnail_width":"60","thumbnail_height":"60","enable_thumbnail":"1","enable_navtitle":"1","enable_navdate":"1","enable_navcate":"0","source":"category","article_ids":"","category":"0","user_id":"0","show_featured":"","ordering":"created-asc","limit_items":"5","layout_style":"vrdown","interval":"5000","duration":"500","effect":"Fx.Transitions.Quad.easeInOut","auto_start":"1","enable_cache":"0","cache_time":"30","auto_renderthumb":"1","auto_strip_tags":"1","open_target":"parent"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10003, 'plg_editors_jce', 'plugin', 'jce', 'editors', 0, 1, 1, 0, '{"legacy":false,"name":"plg_editors_jce","type":"plugin","creationDate":"28 July 2014","author":"Ryan Demmer","copyright":"2006-2010 Ryan Demmer","authorEmail":"info@joomlacontenteditor.net","authorUrl":"http:\\/\\/www.joomlacontenteditor.net","version":"2.4.2","description":"WF_EDITOR_PLUGIN_DESC","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10004, 'plg_quickicon_jcefilebrowser', 'plugin', 'jcefilebrowser', 'quickicon', 0, 1, 1, 0, '{"legacy":false,"name":"plg_quickicon_jcefilebrowser","type":"plugin","creationDate":"28 July 2014","author":"Ryan Demmer","copyright":"Copyright (C) 2006 - 2014 Ryan Demmer. All rights reserved","authorEmail":"@@email@@","authorUrl":"www.joomalcontenteditor.net","version":"2.4.2","description":"PLG_QUICKICON_JCEFILEBROWSER_XML_DESCRIPTION","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10005, 'jce', 'component', 'com_jce', '', 1, 1, 0, 0, '{"legacy":false,"name":"JCE","type":"component","creationDate":"28 July 2014","author":"Ryan Demmer","copyright":"Copyright (C) 2006 - 2014 Ryan Demmer. All rights reserved","authorEmail":"info@joomlacontenteditor.net","authorUrl":"www.joomlacontenteditor.net","version":"2.4.2","description":"WF_ADMIN_DESC","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10006, 'iCagenda - Calendar', 'module', 'mod_iccalendar', '', 0, 1, 0, 0, '{"legacy":false,"name":"iCagenda - Calendar","type":"module","creationDate":"2014-05-16","author":"Jooml!C","copyright":"Copyright (c)2012-2014 JoomliC. All rights reserved.","authorEmail":"info@joomlic.com","authorUrl":"www.joomlic.com","version":"3.3.6","description":"Calendar module for iCagenda component","group":""}', '{"template":"default","iCmenuitem":"","mcatid":"0","onlyStDate":"","header_text":"","tipwidth":"390","position":"center","posmiddle":"top","verticaloffset":"50","padding":"0","mouseover":"click","format":"0","date_separator":"","dp_time":"1","dp_city":"1","dp_country":"1","dp_venuename":"1","dp_shortDesc":"1","filtering_shortDesc":"","dp_regInfos":"1","calendarclosebtn":"0","calendarclosebtn_Content":"X","firstday":"1","calfontcolor":" ","OneEventbgcolor":" ","Eventsbgcolor":" ","bgcolor":" ","bgimage":"","bgimagerepeat":"repeat","mon":" ","tue":" ","wed":" ","thu":" ","fri":" ","sat":" ","sun":" ","loadJquery":"auto","setTodayTimezone":"","cache":"0","cachemode":"itemid"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10007, 'ICAGENDA_PLG_SEARCH', 'plugin', 'icagenda', 'search', 0, 1, 1, 0, '{"legacy":false,"name":"ICAGENDA_PLG_SEARCH","type":"plugin","creationDate":"2014-04-20","author":"Jooml!C","copyright":"Copyright (c)2012-2014 Cyril Rez\\u00e9, Jooml!C - All rights reserved","authorEmail":"info@joomlic.com","authorUrl":"www.joomlic.com","version":"1.1","description":"ICAGENDA_PLG_SEARCH_XML_DESCRIPTION","group":""}', '{"search_name":"","search_limit":"50","search_target":"0"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10008, 'System - iCagenda :: Autologin', 'plugin', 'ic_autologin', 'system', 0, 1, 1, 0, '{"legacy":false,"name":"System - iCagenda :: Autologin","type":"plugin","creationDate":"2014-03-17","author":"Jooml!C","copyright":"Copyright (c)2012-2014 Cyril Rez\\u00e9, Jooml!C - All rights reserved","authorEmail":"info@joomlic.com","authorUrl":"www.joomlic.com","version":"1.2","description":"The iCagenda Autologin plugin allows to automatically connect an authorized user when clicking on a not public URL inserted in a notification email.","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10009, 'icagenda', 'component', 'com_icagenda', '', 1, 1, 0, 0, '{"legacy":false,"name":"iCagenda","type":"component","creationDate":"2014-07-04","author":"Jooml!C","copyright":"Copyright (c)2012-2014 Cyril Rez\\u00e9, Jooml!C - All rights reserved","authorEmail":"info@joomlic.com","authorUrl":"www.joomlic.com","version":"3.3.8","description":"COM_ICAGENDA_DESC","group":""}', '{"version":" <b style=\\"font-size:0.5em;\\">v 3.3.8<\\/b>","release":"3.3.8","author":"JoomliC","icsys":"core","copy":"1","atlist":"1","atevent":"1","atfloat":"2","aticon":"2","arrowtext":"1","statutReg":"1","maxRlist":"5","navposition":"0","targetLink":"1","participantList":"1","participantSlide":"1","participantDisplay":"1","fullListColumns":"tiers","regEmailUser":"1","timeformat":"1","ShortDescLimit":"100","limitRegEmail":"1","limitRegDate":"1","phoneRequired":"2","headerList":"1","largewidththreshold":"1201","mediumwidththreshold":"769","smallwidththreshold":"481","emailRequired":"1"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10010, 'AllVideos (by JoomlaWorks)', 'plugin', 'jw_allvideos', 'content', 0, 1, 1, 0, '{"legacy":false,"name":"AllVideos (by JoomlaWorks)","type":"plugin","creationDate":"June 4th, 2014","author":"JoomlaWorks","copyright":"Copyright (c) 2006 - 2014 JoomlaWorks Ltd. All rights reserved.","authorEmail":"please-use-the-contact-form@joomlaworks.net","authorUrl":"www.joomlaworks.net","version":"4.6.1","description":"JW_PLG_AV_XML_DESC","group":""}', '{"playerTemplate":"Responsive","vfolder":"images\\/videos","vwidth":"400","vheight":"300","transparency":"transparent","background":"#010101","controls":"1","backgroundQT":"black","afolder":"images\\/audio","awidth":"480","aheight":"24","abackground":"#010101","afrontcolor":"#FFFFFF","alightcolor":"#00ADE3","allowAudioDownloading":"0","autoplay":"0","jwPlayerLoading":"local","jwPlayerAPIKey":"","jwPlayerCDNUrl":"","gzipScripts":"0"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10011, 'Newsletter Subscriber', 'module', 'mod_newsletter_subscriber', '', 0, 1, 0, 0, '{"legacy":false,"name":"Newsletter Subscriber","type":"module","creationDate":"March 2011","author":"Christopher Mavros","copyright":"Copyright (C) 2008-2011 Christopher Mavros. All rights reserved.","authorEmail":"mavrosxristoforos@gmail.com","authorUrl":"http:\\/\\/www.mavrosxristoforos.com\\/","version":"1.2","description":"A simple subscription module. Sends an email to the recipient with user''s submitted data.","group":""}', '{"name_label":"Name:","email_label":"Email:","email_recipient":"email@email.com","button_text":"Subscribe to Newsletter","page_text":"Thank you for subscribing to our site.","thank_text_color":"#000000","error_text":"Your subscription could not be submitted. Please try again.","error_text_color":"#000000","subject":"New subscription to your site!","from_name":"Newsletter Subscriber","from_email":"newsletter_subscriber@yoursite.com","sending_from_set":"1","no_name":"Please write your name","no_email":"Please write your email","invalid_email":"Please write a valid email","name_width":"20","email_width":"20","button_width":"100","save_list":"1","save_path":"mailing_list.txt","exact_url":"1","disable_https":"1","pre_text":"","fixed_url":"0","fixed_url_address":"","unique_id":"","enable_anti_spam":"0","anti_spam_q":"How many eyes has a typical person? (ex: 1)","anti_spam_a":"2","moduleclass_sfx":"","addcss":"div.modns tr, div.modns td { border: none; padding: 3px; }"}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10012, 'multicalendar', 'component', 'com_multicalendar', '', 1, 1, 0, 0, '{"legacy":false,"name":"Multi Calendar","type":"component","creationDate":"2011-07-30","author":"CodePeople","copyright":"(c)\\t2011 CodePeople\\tLLC\\t- www.codepeople.net","authorEmail":"info@joomlacalendars.com","authorUrl":"www.joomlacalendars.com","version":"5.4.1","description":"Provides an Multi Calendar Component","group":""}', '{}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10013, 'Multi Calendar', 'module', 'mod_multicalendar', '', 0, 1, 0, 0, '{"legacy":false,"name":"Multi Calendar","type":"module","creationDate":"2011-12-10","author":"CodePeople","copyright":"(c) 2010 CodePeople LLC - www.codepeople.net","authorEmail":"info@joomlacalendars.com","authorUrl":"www.joomlacalendars.com","version":"1.0.0","description":"Provides an Multi View Calendar","group":""}', '{"the_calendar_id":"","views":"viewDay,viewWeek,viewMonth,viewNMonth","viewdefault":"month","start_weekday":"0","cssStyle":"cupertino","palette":"","buttons":"bnavigation","numberOfMonths":"6","sample":""}', '', '', 0, '0000-00-00 00:00:00', 0, 0),
(10014, 'PLG_EASYJOOMLABACKUPCRONJOB', 'plugin', 'easyjoomlabackupcronjob', 'system', 0, 1, 1, 0, '{"legacy":false,"name":"PLG_EASYJOOMLABACKUPCRONJOB","type":"plugin","creationDate":"2015-07-23","author":"Viktor Vogel","copyright":"Copyright 2015 Viktor Vogel. All rights reserved.","authorEmail":"","authorUrl":"","version":"2.5-5","description":"PLG_EASYJOOMLABACKUPCRONJOB_XML_DESCRIPTION","group":""}', '{"token":"","type":"1","donation_code":""}', '', '', 0, '0000-00-00 00:00:00', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `molc_finder_filters`
--

CREATE TABLE IF NOT EXISTS `molc_finder_filters` (
  `filter_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) unsigned NOT NULL,
  `created_by_alias` varchar(255) NOT NULL,
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `map_count` int(10) unsigned NOT NULL DEFAULT '0',
  `data` text NOT NULL,
  `params` mediumtext,
  PRIMARY KEY (`filter_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `molc_finder_links`
--

CREATE TABLE IF NOT EXISTS `molc_finder_links` (
  `link_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `route` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `indexdate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `md5sum` varchar(32) DEFAULT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `state` int(5) DEFAULT '1',
  `access` int(5) DEFAULT '0',
  `language` varchar(8) NOT NULL,
  `publish_start_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_end_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `start_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `end_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `list_price` double unsigned NOT NULL DEFAULT '0',
  `sale_price` double unsigned NOT NULL DEFAULT '0',
  `type_id` int(11) NOT NULL,
  `object` mediumblob NOT NULL,
  PRIMARY KEY (`link_id`),
  KEY `idx_type` (`type_id`),
  KEY `idx_title` (`title`),
  KEY `idx_md5` (`md5sum`),
  KEY `idx_url` (`url`(75)),
  KEY `idx_published_list` (`published`,`state`,`access`,`publish_start_date`,`publish_end_date`,`list_price`),
  KEY `idx_published_sale` (`published`,`state`,`access`,`publish_start_date`,`publish_end_date`,`sale_price`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `molc_finder_links_terms0`
--

CREATE TABLE IF NOT EXISTS `molc_finder_links_terms0` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `molc_finder_links_terms1`
--

CREATE TABLE IF NOT EXISTS `molc_finder_links_terms1` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `molc_finder_links_terms2`
--

CREATE TABLE IF NOT EXISTS `molc_finder_links_terms2` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `molc_finder_links_terms3`
--

CREATE TABLE IF NOT EXISTS `molc_finder_links_terms3` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `molc_finder_links_terms4`
--

CREATE TABLE IF NOT EXISTS `molc_finder_links_terms4` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `molc_finder_links_terms5`
--

CREATE TABLE IF NOT EXISTS `molc_finder_links_terms5` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `molc_finder_links_terms6`
--

CREATE TABLE IF NOT EXISTS `molc_finder_links_terms6` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `molc_finder_links_terms7`
--

CREATE TABLE IF NOT EXISTS `molc_finder_links_terms7` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `molc_finder_links_terms8`
--

CREATE TABLE IF NOT EXISTS `molc_finder_links_terms8` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `molc_finder_links_terms9`
--

CREATE TABLE IF NOT EXISTS `molc_finder_links_terms9` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `molc_finder_links_termsa`
--

CREATE TABLE IF NOT EXISTS `molc_finder_links_termsa` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `molc_finder_links_termsb`
--

CREATE TABLE IF NOT EXISTS `molc_finder_links_termsb` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `molc_finder_links_termsc`
--

CREATE TABLE IF NOT EXISTS `molc_finder_links_termsc` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `molc_finder_links_termsd`
--

CREATE TABLE IF NOT EXISTS `molc_finder_links_termsd` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `molc_finder_links_termse`
--

CREATE TABLE IF NOT EXISTS `molc_finder_links_termse` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `molc_finder_links_termsf`
--

CREATE TABLE IF NOT EXISTS `molc_finder_links_termsf` (
  `link_id` int(10) unsigned NOT NULL,
  `term_id` int(10) unsigned NOT NULL,
  `weight` float unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`term_id`),
  KEY `idx_term_weight` (`term_id`,`weight`),
  KEY `idx_link_term_weight` (`link_id`,`term_id`,`weight`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `molc_finder_taxonomy`
--

CREATE TABLE IF NOT EXISTS `molc_finder_taxonomy` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL,
  `state` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `access` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `ordering` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `parent_id` (`parent_id`),
  KEY `state` (`state`),
  KEY `ordering` (`ordering`),
  KEY `access` (`access`),
  KEY `idx_parent_published` (`parent_id`,`state`,`access`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `molc_finder_taxonomy`
--

INSERT INTO `molc_finder_taxonomy` (`id`, `parent_id`, `title`, `state`, `access`, `ordering`) VALUES
(1, 0, 'ROOT', 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `molc_finder_taxonomy_map`
--

CREATE TABLE IF NOT EXISTS `molc_finder_taxonomy_map` (
  `link_id` int(10) unsigned NOT NULL,
  `node_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`link_id`,`node_id`),
  KEY `link_id` (`link_id`),
  KEY `node_id` (`node_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `molc_finder_terms`
--

CREATE TABLE IF NOT EXISTS `molc_finder_terms` (
  `term_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `term` varchar(75) NOT NULL,
  `stem` varchar(75) NOT NULL,
  `common` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `phrase` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `weight` float unsigned NOT NULL DEFAULT '0',
  `soundex` varchar(75) NOT NULL,
  `links` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`term_id`),
  UNIQUE KEY `idx_term` (`term`),
  KEY `idx_term_phrase` (`term`,`phrase`),
  KEY `idx_stem_phrase` (`stem`,`phrase`),
  KEY `idx_soundex_phrase` (`soundex`,`phrase`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `molc_finder_terms_common`
--

CREATE TABLE IF NOT EXISTS `molc_finder_terms_common` (
  `term` varchar(75) NOT NULL,
  `language` varchar(3) NOT NULL,
  KEY `idx_word_lang` (`term`,`language`),
  KEY `idx_lang` (`language`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `molc_finder_terms_common`
--

INSERT INTO `molc_finder_terms_common` (`term`, `language`) VALUES
('a', 'en'),
('about', 'en'),
('after', 'en'),
('ago', 'en'),
('all', 'en'),
('am', 'en'),
('an', 'en'),
('and', 'en'),
('ani', 'en'),
('any', 'en'),
('are', 'en'),
('aren''t', 'en'),
('as', 'en'),
('at', 'en'),
('be', 'en'),
('but', 'en'),
('by', 'en'),
('for', 'en'),
('from', 'en'),
('get', 'en'),
('go', 'en'),
('how', 'en'),
('if', 'en'),
('in', 'en'),
('into', 'en'),
('is', 'en'),
('isn''t', 'en'),
('it', 'en'),
('its', 'en'),
('me', 'en'),
('more', 'en'),
('most', 'en'),
('must', 'en'),
('my', 'en'),
('new', 'en'),
('no', 'en'),
('none', 'en'),
('not', 'en'),
('noth', 'en'),
('nothing', 'en'),
('of', 'en'),
('off', 'en'),
('often', 'en'),
('old', 'en'),
('on', 'en'),
('onc', 'en'),
('once', 'en'),
('onli', 'en'),
('only', 'en'),
('or', 'en'),
('other', 'en'),
('our', 'en'),
('ours', 'en'),
('out', 'en'),
('over', 'en'),
('page', 'en'),
('she', 'en'),
('should', 'en'),
('small', 'en'),
('so', 'en'),
('some', 'en'),
('than', 'en'),
('thank', 'en'),
('that', 'en'),
('the', 'en'),
('their', 'en'),
('theirs', 'en'),
('them', 'en'),
('then', 'en'),
('there', 'en'),
('these', 'en'),
('they', 'en'),
('this', 'en'),
('those', 'en'),
('thus', 'en'),
('time', 'en'),
('times', 'en'),
('to', 'en'),
('too', 'en'),
('true', 'en'),
('under', 'en'),
('until', 'en'),
('up', 'en'),
('upon', 'en'),
('use', 'en'),
('user', 'en'),
('users', 'en'),
('veri', 'en'),
('version', 'en'),
('very', 'en'),
('via', 'en'),
('want', 'en'),
('was', 'en'),
('way', 'en'),
('were', 'en'),
('what', 'en'),
('when', 'en'),
('where', 'en'),
('whi', 'en'),
('which', 'en'),
('who', 'en'),
('whom', 'en'),
('whose', 'en'),
('why', 'en'),
('wide', 'en'),
('will', 'en'),
('with', 'en'),
('within', 'en'),
('without', 'en'),
('would', 'en'),
('yes', 'en'),
('yet', 'en'),
('you', 'en'),
('your', 'en'),
('yours', 'en');

-- --------------------------------------------------------

--
-- Table structure for table `molc_finder_tokens`
--

CREATE TABLE IF NOT EXISTS `molc_finder_tokens` (
  `term` varchar(75) NOT NULL,
  `stem` varchar(75) NOT NULL,
  `common` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `phrase` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `weight` float unsigned NOT NULL DEFAULT '1',
  `context` tinyint(1) unsigned NOT NULL DEFAULT '2',
  KEY `idx_word` (`term`),
  KEY `idx_context` (`context`)
) ENGINE=MEMORY DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `molc_finder_tokens_aggregate`
--

CREATE TABLE IF NOT EXISTS `molc_finder_tokens_aggregate` (
  `term_id` int(10) unsigned NOT NULL,
  `map_suffix` char(1) NOT NULL,
  `term` varchar(75) NOT NULL,
  `stem` varchar(75) NOT NULL,
  `common` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `phrase` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `term_weight` float unsigned NOT NULL,
  `context` tinyint(1) unsigned NOT NULL DEFAULT '2',
  `context_weight` float unsigned NOT NULL,
  `total_weight` float unsigned NOT NULL,
  KEY `token` (`term`),
  KEY `keyword_id` (`term_id`)
) ENGINE=MEMORY DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `molc_finder_types`
--

CREATE TABLE IF NOT EXISTS `molc_finder_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `mime` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title` (`title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `molc_icagenda`
--

CREATE TABLE IF NOT EXISTS `molc_icagenda` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `version` varchar(255) DEFAULT NULL,
  `releasedate` varchar(255) DEFAULT NULL,
  `params` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `molc_icagenda`
--

INSERT INTO `molc_icagenda` (`id`, `version`, `releasedate`, `params`) VALUES
(3, '3.3.8', '2014-07-04', '{"msg_procp":"0"}');

-- --------------------------------------------------------

--
-- Table structure for table `molc_icagenda_category`
--

CREATE TABLE IF NOT EXISTS `molc_icagenda_category` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ordering` int(11) NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT '1',
  `checked_out` int(11) NOT NULL,
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `desc` mediumtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `molc_icagenda_category`
--

INSERT INTO `molc_icagenda_category` (`id`, `ordering`, `state`, `checked_out`, `checked_out_time`, `title`, `alias`, `color`, `desc`) VALUES
(1, 1, 1, 0, '0000-00-00 00:00:00', 'Seminar', 'seminar', '#0b7014', '');

-- --------------------------------------------------------

--
-- Table structure for table `molc_icagenda_customfields`
--

CREATE TABLE IF NOT EXISTS `molc_icagenda_customfields` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ordering` int(11) NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT '1',
  `checked_out` int(11) NOT NULL,
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `parent_form` int(11) NOT NULL DEFAULT '0',
  `type` varchar(255) NOT NULL,
  `options` mediumtext,
  `default` varchar(255) NOT NULL,
  `required` tinyint(3) NOT NULL DEFAULT '0',
  `language` varchar(10) NOT NULL DEFAULT '*',
  `params` mediumtext,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) unsigned NOT NULL DEFAULT '0',
  `created_by_alias` varchar(255) NOT NULL DEFAULT '',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `molc_icagenda_events`
--

CREATE TABLE IF NOT EXISTS `molc_icagenda_events` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `asset_id` int(10) NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT '1',
  `approval` int(11) NOT NULL DEFAULT '0',
  `checked_out` int(11) NOT NULL,
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `title` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  `access` int(10) unsigned NOT NULL DEFAULT '0',
  `language` char(7) NOT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) unsigned NOT NULL DEFAULT '0',
  `created_by_alias` varchar(255) NOT NULL,
  `created_by_email` varchar(100) NOT NULL,
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) unsigned NOT NULL DEFAULT '0',
  `username` varchar(255) NOT NULL,
  `catid` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `displaytime` int(10) NOT NULL DEFAULT '1',
  `weekdays` varchar(255) NOT NULL,
  `daystime` varchar(255) NOT NULL,
  `startdate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `enddate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `period` mediumtext NOT NULL,
  `dates` mediumtext NOT NULL,
  `next` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `time` varchar(255) NOT NULL,
  `place` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `coordinate` varchar(255) NOT NULL,
  `lat` float(20,16) NOT NULL,
  `lng` float(20,16) NOT NULL,
  `desc` mediumtext NOT NULL,
  `metadesc` text NOT NULL,
  `params` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `molc_icagenda_events`
--

INSERT INTO `molc_icagenda_events` (`id`, `asset_id`, `ordering`, `state`, `approval`, `checked_out`, `checked_out_time`, `title`, `alias`, `access`, `language`, `created`, `created_by`, `created_by_alias`, `created_by_email`, `modified`, `modified_by`, `username`, `catid`, `image`, `file`, `displaytime`, `weekdays`, `daystime`, `startdate`, `enddate`, `period`, `dates`, `next`, `time`, `place`, `website`, `email`, `phone`, `name`, `city`, `country`, `address`, `coordinate`, `lat`, `lng`, `desc`, `metadesc`, `params`) VALUES
(1, 52, 1, 1, 0, 876, '2014-08-27 15:56:38', 'DOCTRINAL FORMATION', 'doctrinal-formation', 1, '*', '0000-00-00 00:00:00', 876, '', '', '0000-00-00 00:00:00', 0, 'Super User', 1, '', '', 1, '', '', '2014-09-06 08:00:00', '2014-09-06 17:00:00', 'a:1:{i:0;s:16:"2014-09-06 08:00";}', 'a:1:{i:0;s:19:"0000-00-00 00:00:00";}', '2014-09-06 08:00:00', '', 'Lay Formation Center (LAYFORCE)', 'http://www.angsalitangdiyos.com', 'webadmin@angsalitangdiyos.com', '(63 2) 4043891', '', 'Makati', 'Philippines', 'Epifanio de los Santos Avenue, Makati, Philippines', '', 14.5636711120605470, 121.0429000854492200, '<p>1. This is the second seminar for all EMHC and Lectors and Commentators to complete the requirement for the Basic Seminar.</p>\r\n<p>2. Please bring your ID for your attendance.<strong> No ID, no attendance.</strong></p>\r\n<p>3. This is open to all those lay liturgical ministers who have not attended their Basic Doctrinal Seminar</p>', '', '{"statutReg":"","accessReg":"1","RegButtonLink":"","RegButtonLink_Article":"","RegButtonLink_Url":"","typeReg":"1","maxReg":"","maxRlistGlobal":"","maxRlist":"","RegButtonText":"","RegButtonTarget":"0","atevent":""}');

-- --------------------------------------------------------

--
-- Table structure for table `molc_icagenda_registration`
--

CREATE TABLE IF NOT EXISTS `molc_icagenda_registration` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `ordering` int(11) NOT NULL,
  `state` tinyint(1) NOT NULL DEFAULT '1',
  `checked_out` int(11) NOT NULL,
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `userid` int(11) NOT NULL,
  `itemid` int(11) NOT NULL,
  `eventid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `date` mediumtext NOT NULL,
  `period` tinyint(1) NOT NULL DEFAULT '0',
  `people` int(2) NOT NULL,
  `notes` mediumtext NOT NULL,
  `custom_fields` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `molc_languages`
--

CREATE TABLE IF NOT EXISTS `molc_languages` (
  `lang_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `lang_code` char(7) NOT NULL,
  `title` varchar(50) NOT NULL,
  `title_native` varchar(50) NOT NULL,
  `sef` varchar(50) NOT NULL,
  `image` varchar(50) NOT NULL,
  `description` varchar(512) NOT NULL,
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `sitename` varchar(1024) NOT NULL DEFAULT '',
  `published` int(11) NOT NULL DEFAULT '0',
  `access` int(10) unsigned NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`lang_id`),
  UNIQUE KEY `idx_sef` (`sef`),
  UNIQUE KEY `idx_image` (`image`),
  UNIQUE KEY `idx_langcode` (`lang_code`),
  KEY `idx_access` (`access`),
  KEY `idx_ordering` (`ordering`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `molc_languages`
--

INSERT INTO `molc_languages` (`lang_id`, `lang_code`, `title`, `title_native`, `sef`, `image`, `description`, `metakey`, `metadesc`, `sitename`, `published`, `access`, `ordering`) VALUES
(1, 'en-GB', 'English (UK)', 'English (UK)', 'en', 'en', '', '', '', '', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `molc_menu`
--

CREATE TABLE IF NOT EXISTS `molc_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menutype` varchar(24) NOT NULL COMMENT 'The type of menu this item belongs to. FK to #__menu_types.menutype',
  `title` varchar(255) NOT NULL COMMENT 'The display title of the menu item.',
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL COMMENT 'The SEF alias of the menu item.',
  `note` varchar(255) NOT NULL DEFAULT '',
  `path` varchar(1024) NOT NULL COMMENT 'The computed path of the menu item based on the alias field.',
  `link` varchar(1024) NOT NULL COMMENT 'The actually link the menu item refers to.',
  `type` varchar(16) NOT NULL COMMENT 'The type of link: Component, URL, Alias, Separator',
  `published` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'The published state of the menu link.',
  `parent_id` int(10) unsigned NOT NULL DEFAULT '1' COMMENT 'The parent menu item in the menu tree.',
  `level` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'The relative level in the tree.',
  `component_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'FK to #__extensions.id',
  `ordering` int(11) NOT NULL DEFAULT '0' COMMENT 'The relative ordering of the menu item in the tree.',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'FK to #__users.id',
  `checked_out_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'The time the menu item was checked out.',
  `browserNav` tinyint(4) NOT NULL DEFAULT '0' COMMENT 'The click behaviour of the link.',
  `access` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'The access level required to view the menu item.',
  `img` varchar(255) NOT NULL COMMENT 'The image of the menu item.',
  `template_style_id` int(10) unsigned NOT NULL DEFAULT '0',
  `params` text NOT NULL COMMENT 'JSON encoded data for the menu item.',
  `lft` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set lft.',
  `rgt` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set rgt.',
  `home` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Indicates if this menu item is the home or default page.',
  `language` char(7) NOT NULL DEFAULT '',
  `client_id` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_client_id_parent_id_alias_language` (`client_id`,`parent_id`,`alias`,`language`),
  KEY `idx_componentid` (`component_id`,`menutype`,`published`,`access`),
  KEY `idx_menutype` (`menutype`),
  KEY `idx_left_right` (`lft`,`rgt`),
  KEY `idx_alias` (`alias`),
  KEY `idx_path` (`path`(255)),
  KEY `idx_language` (`language`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=135 ;

--
-- Dumping data for table `molc_menu`
--

INSERT INTO `molc_menu` (`id`, `menutype`, `title`, `alias`, `note`, `path`, `link`, `type`, `published`, `parent_id`, `level`, `component_id`, `ordering`, `checked_out`, `checked_out_time`, `browserNav`, `access`, `img`, `template_style_id`, `params`, `lft`, `rgt`, `home`, `language`, `client_id`) VALUES
(1, '', 'Menu_Item_Root', 'root', '', '', '', '', 1, 0, 0, 0, 0, 0, '0000-00-00 00:00:00', 0, 0, '', 0, '', 0, 99, 0, '*', 0),
(2, 'menu', 'com_banners', 'Banners', '', 'Banners', 'index.php?option=com_banners', 'component', 0, 1, 1, 4, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:banners', 0, '', 1, 10, 0, '*', 1),
(3, 'menu', 'com_banners', 'Banners', '', 'Banners/Banners', 'index.php?option=com_banners', 'component', 0, 2, 2, 4, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:banners', 0, '', 2, 3, 0, '*', 1),
(4, 'menu', 'com_banners_categories', 'Categories', '', 'Banners/Categories', 'index.php?option=com_categories&extension=com_banners', 'component', 0, 2, 2, 6, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:banners-cat', 0, '', 4, 5, 0, '*', 1),
(5, 'menu', 'com_banners_clients', 'Clients', '', 'Banners/Clients', 'index.php?option=com_banners&view=clients', 'component', 0, 2, 2, 4, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:banners-clients', 0, '', 6, 7, 0, '*', 1),
(6, 'menu', 'com_banners_tracks', 'Tracks', '', 'Banners/Tracks', 'index.php?option=com_banners&view=tracks', 'component', 0, 2, 2, 4, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:banners-tracks', 0, '', 8, 9, 0, '*', 1),
(7, 'menu', 'com_contact', 'Contacts', '', 'Contacts', 'index.php?option=com_contact', 'component', 0, 1, 1, 8, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:contact', 0, '', 11, 16, 0, '*', 1),
(8, 'menu', 'com_contact', 'Contacts', '', 'Contacts/Contacts', 'index.php?option=com_contact', 'component', 0, 7, 2, 8, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:contact', 0, '', 12, 13, 0, '*', 1),
(9, 'menu', 'com_contact_categories', 'Categories', '', 'Contacts/Categories', 'index.php?option=com_categories&extension=com_contact', 'component', 0, 7, 2, 6, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:contact-cat', 0, '', 14, 15, 0, '*', 1),
(10, 'menu', 'com_messages', 'Messaging', '', 'Messaging', 'index.php?option=com_messages', 'component', 0, 1, 1, 15, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:messages', 0, '', 17, 22, 0, '*', 1),
(11, 'menu', 'com_messages_add', 'New Private Message', '', 'Messaging/New Private Message', 'index.php?option=com_messages&task=message.add', 'component', 0, 10, 2, 15, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:messages-add', 0, '', 18, 19, 0, '*', 1),
(12, 'menu', 'com_messages_read', 'Read Private Message', '', 'Messaging/Read Private Message', 'index.php?option=com_messages', 'component', 0, 10, 2, 15, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:messages-read', 0, '', 20, 21, 0, '*', 1),
(13, 'menu', 'com_newsfeeds', 'News Feeds', '', 'News Feeds', 'index.php?option=com_newsfeeds', 'component', 0, 1, 1, 17, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:newsfeeds', 0, '', 23, 28, 0, '*', 1),
(14, 'menu', 'com_newsfeeds_feeds', 'Feeds', '', 'News Feeds/Feeds', 'index.php?option=com_newsfeeds', 'component', 0, 13, 2, 17, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:newsfeeds', 0, '', 24, 25, 0, '*', 1),
(15, 'menu', 'com_newsfeeds_categories', 'Categories', '', 'News Feeds/Categories', 'index.php?option=com_categories&extension=com_newsfeeds', 'component', 0, 13, 2, 6, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:newsfeeds-cat', 0, '', 26, 27, 0, '*', 1),
(16, 'menu', 'com_redirect', 'Redirect', '', 'Redirect', 'index.php?option=com_redirect', 'component', 0, 1, 1, 24, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:redirect', 0, '', 43, 44, 0, '*', 1),
(17, 'menu', 'com_search', 'Basic Search', '', 'Basic Search', 'index.php?option=com_search', 'component', 0, 1, 1, 19, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:search', 0, '', 33, 34, 0, '*', 1),
(18, 'menu', 'com_weblinks', 'Weblinks', '', 'Weblinks', 'index.php?option=com_weblinks', 'component', 0, 1, 1, 21, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:weblinks', 0, '', 35, 40, 0, '*', 1),
(19, 'menu', 'com_weblinks_links', 'Links', '', 'Weblinks/Links', 'index.php?option=com_weblinks', 'component', 0, 18, 2, 21, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:weblinks', 0, '', 36, 37, 0, '*', 1),
(20, 'menu', 'com_weblinks_categories', 'Categories', '', 'Weblinks/Categories', 'index.php?option=com_categories&extension=com_weblinks', 'component', 0, 18, 2, 6, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:weblinks-cat', 0, '', 38, 39, 0, '*', 1),
(21, 'menu', 'com_finder', 'Smart Search', '', 'Smart Search', 'index.php?option=com_finder', 'component', 0, 1, 1, 27, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:finder', 0, '', 31, 32, 0, '*', 1),
(22, 'menu', 'com_joomlaupdate', 'Joomla! Update', '', 'Joomla! Update', 'index.php?option=com_joomlaupdate', 'component', 0, 1, 1, 28, 0, 0, '0000-00-00 00:00:00', 0, 0, 'class:joomlaupdate', 0, '', 41, 42, 0, '*', 1),
(101, 'mainmenu', 'Home', 'home', '', 'home', 'index.php?option=com_content&view=featured', 'component', 1, 1, 1, 22, 0, 876, '2015-08-03 11:32:20', 0, 1, '', 0, '{"featured_categories":[""],"num_leading_articles":"1","num_intro_articles":"3","num_columns":"3","num_links":"0","orderby_pri":"","orderby_sec":"front","order_date":"","multi_column_order":"1","show_pagination":"2","show_pagination_results":"1","show_noauth":"","article-allow_ratings":"","article-allow_comments":"","show_feed_link":"1","feed_summary":"","show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_readmore":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","show_page_heading":1,"page_title":"","page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0}', 29, 30, 1, '*', 0),
(107, 'main', 'COM_ICAGENDA_MENU', 'com-icagenda-menu', '', 'com-icagenda-menu', 'index.php?option=com_icagenda', 'component', 0, 1, 1, 10009, 0, 0, '0000-00-00 00:00:00', 0, 1, '../media/com_icagenda/images/iconicagenda16.png', 0, '', 45, 60, 0, '', 1),
(108, 'main', 'COM_ICAGENDA_TITLE_ICAGENDA', 'com-icagenda-title-icagenda', '', 'com-icagenda-menu/com-icagenda-title-icagenda', 'index.php?option=com_icagenda&view=icagenda', 'component', 0, 107, 2, 10009, 0, 0, '0000-00-00 00:00:00', 0, 1, '../media/com_icagenda/images/iconicagenda16.png', 0, '', 46, 47, 0, '', 1),
(109, 'main', 'COM_ICAGENDA_MENU_CATEGORIES', 'com-icagenda-menu-categories', '', 'com-icagenda-menu/com-icagenda-menu-categories', 'index.php?option=com_icagenda&view=categories', 'component', 0, 107, 2, 10009, 0, 0, '0000-00-00 00:00:00', 0, 1, '../media/com_icagenda/images/all_cats-16.png', 0, '', 48, 49, 0, '', 1),
(110, 'main', 'COM_ICAGENDA_EVENTS', 'com-icagenda-events', '', 'com-icagenda-menu/com-icagenda-events', 'index.php?option=com_icagenda&view=events', 'component', 0, 107, 2, 10009, 0, 0, '0000-00-00 00:00:00', 0, 1, '../media/com_icagenda/images/all_events-16.png', 0, '', 50, 51, 0, '', 1),
(111, 'main', 'COM_ICAGENDA_REGISTRATION', 'com-icagenda-registration', '', 'com-icagenda-menu/com-icagenda-registration', 'index.php?option=com_icagenda&view=registrations', 'component', 0, 107, 2, 10009, 0, 0, '0000-00-00 00:00:00', 0, 1, '../media/com_icagenda/images/registration-16.png', 0, '', 52, 53, 0, '', 1),
(112, 'main', 'COM_ICAGENDA_MAIL', 'com-icagenda-mail', '', 'com-icagenda-menu/com-icagenda-mail', 'index.php?option=com_icagenda&view=mail&layout=edit', 'component', 0, 107, 2, 10009, 0, 0, '0000-00-00 00:00:00', 0, 1, '../media/com_icagenda/images/newsletter-16.png', 0, '', 54, 55, 0, '', 1),
(113, 'main', 'COM_ICAGENDA_THEMES', 'com-icagenda-themes', '', 'com-icagenda-menu/com-icagenda-themes', 'index.php?option=com_icagenda&view=themes', 'component', 0, 107, 2, 10009, 0, 0, '0000-00-00 00:00:00', 0, 1, '../media/com_icagenda/images/themes-16.png', 0, '', 56, 57, 0, '', 1),
(114, 'main', 'COM_ICAGENDA_INFO', 'com-icagenda-info', '', 'com-icagenda-menu/com-icagenda-info', 'index.php?option=com_icagenda&view=info', 'component', 0, 107, 2, 10009, 0, 0, '0000-00-00 00:00:00', 0, 1, '../media/com_icagenda/images/info-16.png', 0, '', 58, 59, 0, '', 1),
(115, 'main', 'JCE', 'jce', '', 'jce', 'index.php?option=com_jce', 'component', 0, 1, 1, 10005, 0, 0, '0000-00-00 00:00:00', 0, 1, 'components/com_jce/media/img/menu/logo.png', 0, '', 61, 70, 0, '', 1),
(116, 'main', 'WF_MENU_CPANEL', 'wf-menu-cpanel', '', 'jce/wf-menu-cpanel', 'index.php?option=com_jce', 'component', 0, 115, 2, 10005, 0, 0, '0000-00-00 00:00:00', 0, 1, 'components/com_jce/media/img/menu/jce-cpanel.png', 0, '', 62, 63, 0, '', 1),
(117, 'main', 'WF_MENU_CONFIG', 'wf-menu-config', '', 'jce/wf-menu-config', 'index.php?option=com_jce&view=config', 'component', 0, 115, 2, 10005, 0, 0, '0000-00-00 00:00:00', 0, 1, 'components/com_jce/media/img/menu/jce-config.png', 0, '', 64, 65, 0, '', 1),
(118, 'main', 'WF_MENU_PROFILES', 'wf-menu-profiles', '', 'jce/wf-menu-profiles', 'index.php?option=com_jce&view=profiles', 'component', 0, 115, 2, 10005, 0, 0, '0000-00-00 00:00:00', 0, 1, 'components/com_jce/media/img/menu/jce-profiles.png', 0, '', 66, 67, 0, '', 1),
(119, 'main', 'WF_MENU_INSTALL', 'wf-menu-install', '', 'jce/wf-menu-install', 'index.php?option=com_jce&view=installer', 'component', 0, 115, 2, 10005, 0, 0, '0000-00-00 00:00:00', 0, 1, 'components/com_jce/media/img/menu/jce-install.png', 0, '', 68, 69, 0, '', 1),
(120, 'mainmenu', 'Activities', 'activities', '', 'activities', 'index.php?option=com_icagenda&view=list', 'component', 1, 1, 1, 10009, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"template":"default","mcatid":["0"],"time":"1","orderby":"2","datesDisplay":"","displayCatDesc_menu":"global","number":"5","format":"0","date_separator":"","limitGlobal":"1","limit":"100","m_width":"100%","m_height":"300px","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0}', 71, 72, 0, '*', 0),
(121, 'mainmenu', 'Reflections', 'reflections', '', 'reflections', 'index.php?option=com_content&view=category&layout=blog&id=9', 'component', 1, 1, 1, 22, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"layout_type":"blog","show_category_heading_title_text":"","show_category_title":"1","show_description":"","show_description_image":"","maxLevel":"","show_empty_categories":"","show_no_articles":"","show_subcat_desc":"","show_cat_num_articles":"","page_subheading":"","num_leading_articles":"","num_intro_articles":"","num_columns":"","num_links":"","multi_column_order":"","show_subcategory_content":"","orderby_pri":"","orderby_sec":"","order_date":"","show_pagination":"","show_pagination_results":"","show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_readmore":"","show_readmore_title":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_noauth":"","show_feed_link":"","feed_summary":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0}', 73, 74, 0, '*', 0),
(122, 'mainmenu', 'Daily Mass Readings', 'daily-mass-readings', '', 'daily-mass-readings', '#', 'url', 1, 1, 1, 22, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1}', 75, 80, 0, '*', 0),
(123, 'mainmenu', 'Notes', 'notes', '', 'notes', 'index.php?option=com_content&view=article&id=11', 'component', 1, 1, 1, 22, 0, 876, '2015-08-10 10:36:36', 0, 1, '', 0, '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0}', 81, 88, 0, '*', 0),
(124, 'mainmenu', 'Contact Us', 'contact-us', '', 'contact-us', 'index.php?option=com_contact&view=contact&id=1', 'component', 1, 1, 1, 8, 0, 876, '2015-08-10 08:16:57', 0, 1, '', 0, '{"presentation_style":"","show_contact_category":"","show_contact_list":"","show_name":"","show_position":"","show_email":"","show_street_address":"","show_suburb":"","show_state":"","show_postcode":"","show_country":"","show_telephone":"","show_mobile":"","show_fax":"","show_webpage":"","show_misc":"","show_image":"","allow_vcard":"","show_articles":"","show_links":"","linka_name":"","linkb_name":"","linkc_name":"","linkd_name":"","linke_name":"","show_email_form":"","show_email_copy":"","banned_email":"","banned_subject":"","banned_text":"","validate_session":"","custom_reply":"","redirect":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0}', 89, 90, 0, '*', 0),
(125, 'mainmenu', 'English', 'english', '', 'daily-mass-readings/english', 'index.php?option=com_wrapper&view=wrapper', 'component', 1, 122, 2, 2, 0, 876, '2015-08-03 13:54:36', 0, 1, '', 0, '{"url":"http:\\/\\/192.185.194.26\\/~angsalit\\/calendar\\/asnd_lcmam\\/frontend\\/web\\/ALSCalendarForHost\\/calendar\\/test\\/testCalendar.php","scrolling":"no","width":"100%","height":"650","height_auto":"1","add_scheme":"1","frameborder":"1","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0}', 76, 77, 0, '*', 0),
(126, 'mainmenu', 'Filipino', 'filipino', '', 'daily-mass-readings/filipino', 'index.php?option=com_content&view=category&layout=blog&id=13', 'component', 1, 122, 2, 22, 0, 876, '2015-08-03 13:56:43', 0, 1, '', 0, '{"layout_type":"blog","show_category_heading_title_text":"","show_category_title":"1","show_description":"","show_description_image":"","maxLevel":"","show_empty_categories":"","show_no_articles":"","show_subcat_desc":"","show_cat_num_articles":"","page_subheading":"","num_leading_articles":"","num_intro_articles":"","num_columns":"","num_links":"","multi_column_order":"","show_subcategory_content":"","orderby_pri":"","orderby_sec":"","order_date":"","show_pagination":"","show_pagination_results":"","show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_readmore":"","show_readmore_title":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_noauth":"","show_feed_link":"","feed_summary":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0}', 78, 79, 0, '*', 0),
(127, 'main', 'multi calendar', 'multi-calendar', '', 'multi-calendar', 'index.php?option=com_multicalendar', 'component', 0, 1, 1, 10012, 0, 0, '0000-00-00 00:00:00', 0, 1, 'components/com_multicalendar/images/menu/multi-icon-16.png', 0, '', 91, 96, 0, '', 1),
(128, 'main', 'multi calendar', 'multi-calendar', '', 'multi-calendar/multi-calendar', 'index.php?option=com_multicalendar', 'component', 0, 127, 2, 10012, 0, 0, '0000-00-00 00:00:00', 0, 1, 'components/com_multicalendar/images/menu/multi-icon-16.png', 0, '', 92, 93, 0, '', 1),
(129, 'main', 'configuration', 'configuration', '', 'multi-calendar/configuration', 'index.php?option=com_multicalendar&view=configuration', 'component', 0, 127, 2, 10012, 0, 0, '0000-00-00 00:00:00', 0, 1, 'components/com_multicalendar/images/menu/multi-icon-16.png', 0, '', 94, 95, 0, '', 1),
(130, 'mainmenu', 'Calendar Tool', '2015-04-16-06-09-17', '', '2015-04-16-06-09-17', 'http://192.185.194.26/~angsalit/calendar/asnd_lcmam/frontend/web/index.php', 'url', 1, 1, 1, 0, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1}', 97, 98, 0, '*', 0),
(132, 'mainmenu', 'United States Conference of Catholic Bishops', '2015-08-03-09-13-26', '', 'notes/2015-08-03-09-13-26', 'http://www.usccb.org/bible/', 'url', -2, 123, 2, 0, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1}', 82, 83, 0, '*', 0),
(133, 'mainmenu', 'Links', 'links', '', 'notes/links', 'index.php?option=com_content&view=article&id=9', 'component', 1, 123, 2, 22, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0}', 84, 85, 0, '*', 0),
(134, 'mainmenu', 'Dictionary', 'dictionary', '', 'notes/dictionary', 'index.php?option=com_content&view=article&id=10', 'component', 1, 123, 2, 22, 0, 0, '0000-00-00 00:00:00', 0, 1, '', 0, '{"show_title":"","link_titles":"","show_intro":"","show_category":"","link_category":"","show_parent_category":"","link_parent_category":"","show_author":"","link_author":"","show_create_date":"","show_modify_date":"","show_publish_date":"","show_item_navigation":"","show_vote":"","show_icons":"","show_print_icon":"","show_email_icon":"","show_hits":"","show_noauth":"","urls_position":"","menu-anchor_title":"","menu-anchor_css":"","menu_image":"","menu_text":1,"page_title":"","show_page_heading":0,"page_heading":"","pageclass_sfx":"","menu-meta_description":"","menu-meta_keywords":"","robots":"","secure":0}', 86, 87, 0, '*', 0);

-- --------------------------------------------------------

--
-- Table structure for table `molc_menu_types`
--

CREATE TABLE IF NOT EXISTS `molc_menu_types` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `menutype` varchar(24) NOT NULL,
  `title` varchar(48) NOT NULL,
  `description` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_menutype` (`menutype`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `molc_menu_types`
--

INSERT INTO `molc_menu_types` (`id`, `menutype`, `title`, `description`) VALUES
(1, 'mainmenu', 'Main Menu', 'The main menu for the site');

-- --------------------------------------------------------

--
-- Table structure for table `molc_messages`
--

CREATE TABLE IF NOT EXISTS `molc_messages` (
  `message_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id_from` int(10) unsigned NOT NULL DEFAULT '0',
  `user_id_to` int(10) unsigned NOT NULL DEFAULT '0',
  `folder_id` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `date_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `state` tinyint(1) NOT NULL DEFAULT '0',
  `priority` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `subject` varchar(255) NOT NULL DEFAULT '',
  `message` text NOT NULL,
  PRIMARY KEY (`message_id`),
  KEY `useridto_state` (`user_id_to`,`state`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `molc_messages_cfg`
--

CREATE TABLE IF NOT EXISTS `molc_messages_cfg` (
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `cfg_name` varchar(100) NOT NULL DEFAULT '',
  `cfg_value` varchar(255) NOT NULL DEFAULT '',
  UNIQUE KEY `idx_user_var_name` (`user_id`,`cfg_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `molc_modules`
--

CREATE TABLE IF NOT EXISTS `molc_modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL DEFAULT '',
  `note` varchar(255) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `position` varchar(50) NOT NULL DEFAULT '',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `module` varchar(50) DEFAULT NULL,
  `access` int(10) unsigned NOT NULL DEFAULT '0',
  `showtitle` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `params` text NOT NULL,
  `client_id` tinyint(4) NOT NULL DEFAULT '0',
  `language` char(7) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `published` (`published`,`access`),
  KEY `newsfeeds` (`module`,`published`),
  KEY `idx_language` (`language`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=98 ;

--
-- Dumping data for table `molc_modules`
--

INSERT INTO `molc_modules` (`id`, `title`, `note`, `content`, `ordering`, `position`, `checked_out`, `checked_out_time`, `publish_up`, `publish_down`, `published`, `module`, `access`, `showtitle`, `params`, `client_id`, `language`) VALUES
(1, 'Main Menu', '', '', 1, 'user6', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_menu', 1, 0, '{"menutype":"mainmenu","startLevel":"1","endLevel":"0","showAllChildren":"1","tag_id":"","class_sfx":"","window_open":"","layout":"_:default","moduleclass_sfx":"_menu","cache":"1","cache_time":"900","cachemode":"itemid"}', 0, '*'),
(2, 'Login', '', '', 1, 'login', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_login', 1, 1, '', 1, '*'),
(3, 'Popular Articles', '', '', 3, 'cpanel', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_popular', 3, 1, '{"count":"5","catid":"","user_id":"0","layout":"_:default","moduleclass_sfx":"","cache":"0","automatic_title":"1"}', 1, '*'),
(4, 'Recently Added Articles', '', '', 4, 'cpanel', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_latest', 3, 1, '{"count":"5","ordering":"c_dsc","catid":"","user_id":"0","layout":"_:default","moduleclass_sfx":"","cache":"0","automatic_title":"1"}', 1, '*'),
(8, 'Toolbar', '', '', 1, 'toolbar', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_toolbar', 3, 1, '', 1, '*'),
(9, 'Quick Icons', '', '', 1, 'icon', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_quickicon', 3, 1, '', 1, '*'),
(10, 'Logged-in Users', '', '', 2, 'cpanel', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_logged', 3, 1, '{"count":"5","name":"1","layout":"_:default","moduleclass_sfx":"","cache":"0","automatic_title":"1"}', 1, '*'),
(12, 'Admin Menu', '', '', 1, 'menu', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_menu', 3, 1, '{"layout":"","moduleclass_sfx":"","shownew":"1","showhelp":"1","cache":"0"}', 1, '*'),
(13, 'Admin Submenu', '', '', 1, 'submenu', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_submenu', 3, 1, '', 1, '*'),
(14, 'User Status', '', '', 2, 'status', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_status', 3, 1, '', 1, '*'),
(15, 'Title', '', '', 1, 'title', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_title', 3, 1, '', 1, '*'),
(16, 'Member Login', '', '', 2, 'right', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_login', 1, 1, '{"pretext":"","posttext":"","login":"","logout":"","greeting":"1","name":"0","usesecure":"0","layout":"_:default","moduleclass_sfx":"","cache":"0"}', 0, '*'),
(17, 'Breadcrumbs', '', '', 1, 'position-2', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_breadcrumbs', 1, 1, '{"moduleclass_sfx":"","showHome":"1","homeText":"Home","showComponent":"1","separator":"","cache":"1","cache_time":"900","cachemode":"itemid"}', 0, '*'),
(79, 'Multilanguage status', '', '', 1, 'status', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'mod_multilangstatus', 3, 1, '{"layout":"_:default","moduleclass_sfx":"","cache":"0"}', 1, '*'),
(86, 'Joomla Version', '', '', 1, 'footer', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_version', 3, 1, '{"format":"short","product":"1","layout":"_:default","moduleclass_sfx":"","cache":"0"}', 1, '*'),
(87, 'Search', '', '', 1, 'user5', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_search', 1, 0, '{"label":"","width":"20","text":"","button":"","button_pos":"right","imagebutton":"","button_text":"","opensearch":"1","opensearch_title":"","set_itemid":"","layout":"_:default","moduleclass_sfx":"","cache":"1","cache_time":"900","cachemode":"itemid"}', 0, '*'),
(88, 'Lof ArticlesSlideShow Module', '', '', 1, 'banner', 876, '2015-08-10 04:18:47', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_lofarticlesslideshow', 1, 0, '{"moduleclass_sfx":"","theme":"","enable_css3":"1","limit_description_by":"char","title_max_chars":"100","description_max_chars":"100","replacer":"...","module_height":"auto","module_width":"auto","preload":"1","start_item":"0","main_height":"400","main_width":"650","slider_information":"description","enable_image_link":"0","enable_playstop":"1","display_button":"1","desc_opacity":"1","enable_blockdescription":"1","navigator_pos":"right","navitem_height":"100","navitem_width":"310","max_items_display":"5","thumbnail_width":"60","thumbnail_height":"60","enable_thumbnail":"1","enable_navtitle":"1","enable_navdate":"0","enable_navcate":"0","source":"category","article_ids":"","category":["8"],"user_id":"0","show_featured":"2","ordering":"created-asc","limit_items":"5","layout_style":"hrleft","interval":"5000","duration":"500","effect":"Fx.Transitions.Quad.easeInOut","auto_start":"1","enable_cache":"0","cache_time":"30","auto_renderthumb":"1","auto_strip_tags":"1","open_target":"parent"}', 0, '*'),
(89, 'Activity Calendar', '', '', 1, 'right', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_iccalendar', 1, 1, '{"template":"default","iCmenuitem":"","mcatid":["0"],"onlyStDate":"","header_text":"","tipwidth":"390","position":"center","posmiddle":"top","verticaloffset":"50","padding":"0","mouseover":"click","format":"0","date_separator":"","dp_time":"1","dp_city":"1","dp_country":"1","dp_venuename":"1","dp_shortDesc":"1","filtering_shortDesc":"","dp_regInfos":"1","calendarclosebtn":"0","calendarclosebtn_Content":"X","firstday":"1","calfontcolor":" ","OneEventbgcolor":" ","Eventsbgcolor":" ","bgcolor":" ","bgimage":"","bgimagerepeat":"repeat","mon":" ","tue":" ","wed":" ","thu":" ","fri":" ","sat":" ","sun":" ","loadJquery":"auto","setTodayTimezone":"","moduleclass_sfx":"","cache":"0","cachemode":"itemid"}', 0, '*'),
(90, 'Main Menu ', '', '', 1, 'user22', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'mod_menu', 1, 1, '{"menutype":"mainmenu","startLevel":"1","endLevel":"0","showAllChildren":"0","tag_id":"","class_sfx":"","window_open":"","layout":"_:default","moduleclass_sfx":"_menu","cache":"1","cache_time":"900","cachemode":"itemid"}', 0, '*'),
(91, 'Subscribe to Our Newsletter', '', '', 1, 'user21', 876, '2015-08-03 09:36:41', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_newsletter_subscriber', 1, 1, '{"name_label":"Name:","email_label":"Email:","email_recipient":"webadmin@angsalitangdiyos.com","button_text":"Subscribe to Newsletter","page_text":"Thank you for subscribing to our site.","thank_text_color":"#000000","error_text":"Your subscription could not be submitted. Please try again.","error_text_color":"#000000","subject":"New subscription to your site!","from_name":"Newsletter Subscriber","from_email":"newsletter_subscriber@yoursite.com","sending_from_set":"1","no_name":"Please write your name","no_email":"Please write your email","invalid_email":"Please write a valid email","name_width":"20","email_width":"20","button_width":"100","save_list":"1","save_path":"mailing_list.txt","exact_url":"1","disable_https":"1","pre_text":"","fixed_url":"0","fixed_url_address":"","unique_id":"","enable_anti_spam":"0","anti_spam_q":"How many eyes has a typical person? (ex: 1)","anti_spam_a":"2","moduleclass_sfx":"","addcss":"div.modns tr, div.modns td { border: none; padding: 3px; }"}', 0, '*'),
(92, 'Most Read Content', '', '', 1, 'user22', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_articles_popular', 1, 1, '{"catid":[""],"count":"5","show_front":"1","layout":"_:default","moduleclass_sfx":"","cache":"1","cache_time":"900","cachemode":"static"}', 0, '*'),
(93, 'Featured Book', '', '<p>The New English Translation of the Roman Missal: A Catechetical Primer</p>\r\n<p>by Fr. Anscar J. Chupungco, OSB</p>\r\n<p><a href="http://sjbmakati.com/new-english-roman-missal.html" target="_blank"><img style="display: block; margin-left: auto; margin-right: auto; border: 0px solid #000000;" src="images/general/primer_book_fr_anscar_chupungco_small.png" alt="primer book fr anscar chupungco small" width="169" height="210" /></a></p>', 1, 'user23', 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_custom', 1, 1, '{"prepare_content":"0","backgroundimage":"","layout":"_:default","moduleclass_sfx":"","cache":"1","cache_time":"900","cachemode":"static"}', 0, '*'),
(94, 'Multi Calendar', '', '', 1, 'top', 876, '2015-08-03 07:04:24', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'mod_multicalendar', 1, 0, '{"the_calendar_id":"1","views":["viewMonth"],"viewdefault":"month","start_weekday":"0","cssStyle":"cupertino","palette":"0","edition":"1","buttons":["btoday","bnavigation","brefresh"],"numberOfMonths":"6","sample":["mouseover","","new_window"],"otherparams":"","moduleclass_sfx":""}', 0, '*'),
(95, 'Daily Mass Readings - Calendar (English)', '', '<h2>2014</h2>\r\n<table border="1" cellspacing="15" cellpadding="15">\r\n<tbody>\r\n<tr>\r\n<td style="height: 24px;">&nbsp;<strong>January</strong></td>\r\n<td style="height: 24px;">&nbsp;&nbsp;1</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;2</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;3</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;4</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;5</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;6</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;7</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;8</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;9</td>\r\n<td style="height: 24px;">&nbsp;10</td>\r\n<td style="height: 24px;">&nbsp;11</td>\r\n<td style="height: 24px;">&nbsp;12</td>\r\n<td style="height: 24px;">&nbsp;13</td>\r\n<td style="height: 24px;">&nbsp;14</td>\r\n<td style="height: 24px;">&nbsp;15</td>\r\n<td style="height: 24px;">&nbsp;16</td>\r\n<td style="height: 24px;">&nbsp;17</td>\r\n<td style="height: 24px;">&nbsp;18</td>\r\n<td style="height: 24px;">&nbsp;19</td>\r\n<td style="height: 24px;">&nbsp;20</td>\r\n<td style="height: 24px;">&nbsp;21</td>\r\n<td style="height: 24px;">&nbsp;22</td>\r\n<td style="height: 24px;">&nbsp;23</td>\r\n<td style="height: 24px;">&nbsp;24</td>\r\n<td style="height: 24px;">&nbsp;25</td>\r\n<td style="height: 24px;">&nbsp;26</td>\r\n<td style="height: 24px;">&nbsp;27</td>\r\n<td style="height: 24px;">&nbsp;28</td>\r\n<td style="height: 24px;">&nbsp;29</td>\r\n<td style="height: 24px;">&nbsp;30</td>\r\n<td style="height: 24px;">&nbsp;31</td>\r\n</tr>\r\n<tr>\r\n<td style="height: 24px;">&nbsp;<strong>February</strong></td>\r\n<td style="height: 24px;">&nbsp;&nbsp;1</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;2</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;3</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;4</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;5</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;6</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;7</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;8</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;9</td>\r\n<td style="height: 24px;">&nbsp;10</td>\r\n<td style="height: 24px;">&nbsp;11</td>\r\n<td style="height: 24px;">&nbsp;12</td>\r\n<td style="height: 24px;">&nbsp;13</td>\r\n<td style="height: 24px;">&nbsp;14</td>\r\n<td style="height: 24px;">&nbsp;15</td>\r\n<td style="height: 24px;">&nbsp;16</td>\r\n<td style="height: 24px;">&nbsp;17</td>\r\n<td style="height: 24px;">&nbsp;18</td>\r\n<td style="height: 24px;">&nbsp;19</td>\r\n<td style="height: 24px;">&nbsp;20</td>\r\n<td style="height: 24px;">&nbsp;21</td>\r\n<td style="height: 24px;">&nbsp;22</td>\r\n<td style="height: 24px;">&nbsp;23</td>\r\n<td style="height: 24px;">&nbsp;24</td>\r\n<td style="height: 24px;">&nbsp;25</td>\r\n<td style="height: 24px;">&nbsp;26</td>\r\n<td style="height: 24px;">&nbsp;27</td>\r\n<td style="height: 24px;">&nbsp;28</td>\r\n<td style="height: 24px;">&nbsp;</td>\r\n<td style="height: 24px;">&nbsp;</td>\r\n<td style="height: 24px;">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td style="height: 24px;">&nbsp;<strong>March</strong></td>\r\n<td style="height: 24px;">&nbsp;&nbsp;1</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;2</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;3</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;4</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;5</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;6</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;7</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;8</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;9</td>\r\n<td style="height: 24px;">&nbsp;10</td>\r\n<td style="height: 24px;">&nbsp;11</td>\r\n<td style="height: 24px;">&nbsp;12</td>\r\n<td style="height: 24px;">&nbsp;13</td>\r\n<td style="height: 24px;">&nbsp;14</td>\r\n<td style="height: 24px;">&nbsp;15</td>\r\n<td style="height: 24px;">&nbsp;16</td>\r\n<td style="height: 24px;">&nbsp;17</td>\r\n<td style="height: 24px;">&nbsp;18</td>\r\n<td style="height: 24px;">&nbsp;19</td>\r\n<td style="height: 24px;">&nbsp;20</td>\r\n<td style="height: 24px;">&nbsp;21</td>\r\n<td style="height: 24px;">&nbsp;22</td>\r\n<td style="height: 24px;">&nbsp;23</td>\r\n<td style="height: 24px;">&nbsp;24</td>\r\n<td style="height: 24px;">&nbsp;25</td>\r\n<td style="height: 24px;">&nbsp;26</td>\r\n<td style="height: 24px;">&nbsp;27</td>\r\n<td style="height: 24px;">&nbsp;28</td>\r\n<td style="height: 24px;">&nbsp;29</td>\r\n<td style="height: 24px;">&nbsp;30</td>\r\n<td style="height: 24px;">&nbsp;31</td>\r\n</tr>\r\n<tr>\r\n<td style="height: 24px;">&nbsp;<strong>April</strong></td>\r\n<td style="height: 24px;">&nbsp;&nbsp;1</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;2</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;3</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;4</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;5</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;6</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;7</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;8</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;9</td>\r\n<td style="height: 24px;">&nbsp;10</td>\r\n<td style="height: 24px;">&nbsp;11</td>\r\n<td style="height: 24px;">&nbsp;12</td>\r\n<td style="height: 24px;">&nbsp;13</td>\r\n<td style="height: 24px;">&nbsp;14</td>\r\n<td style="height: 24px;">&nbsp;15</td>\r\n<td style="height: 24px;">&nbsp;16</td>\r\n<td style="height: 24px;">&nbsp;17</td>\r\n<td style="height: 24px;">&nbsp;18</td>\r\n<td style="height: 24px;">&nbsp;19</td>\r\n<td style="height: 24px;">&nbsp;20</td>\r\n<td style="height: 24px;">&nbsp;21</td>\r\n<td style="height: 24px;">&nbsp;22</td>\r\n<td style="height: 24px;">&nbsp;23</td>\r\n<td style="height: 24px;">&nbsp;24</td>\r\n<td style="height: 24px;">&nbsp;25</td>\r\n<td style="height: 24px;">&nbsp;26</td>\r\n<td style="height: 24px;">&nbsp;27</td>\r\n<td style="height: 24px;">&nbsp;28</td>\r\n<td style="height: 24px;">&nbsp;29</td>\r\n<td style="height: 24px;">&nbsp;30</td>\r\n<td style="height: 24px;">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td style="height: 24px;">&nbsp;<strong>May</strong></td>\r\n<td style="height: 24px;">&nbsp;&nbsp;1</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;2</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;3</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;4</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;5</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;6</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;7</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;8</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;9</td>\r\n<td style="height: 24px;">&nbsp;10</td>\r\n<td style="height: 24px;">&nbsp;11</td>\r\n<td style="height: 24px;">&nbsp;12</td>\r\n<td style="height: 24px;">&nbsp;13</td>\r\n<td style="height: 24px;">&nbsp;14</td>\r\n<td style="height: 24px;">&nbsp;15</td>\r\n<td style="height: 24px;">&nbsp;16</td>\r\n<td style="height: 24px;">&nbsp;17</td>\r\n<td style="height: 24px;">&nbsp;18</td>\r\n<td style="height: 24px;">&nbsp;19</td>\r\n<td style="height: 24px;">&nbsp;20</td>\r\n<td style="height: 24px;">&nbsp;21</td>\r\n<td style="height: 24px;">&nbsp;22</td>\r\n<td style="height: 24px;">&nbsp;23</td>\r\n<td style="height: 24px;">&nbsp;24</td>\r\n<td style="height: 24px;">&nbsp;25</td>\r\n<td style="height: 24px;">&nbsp;26</td>\r\n<td style="height: 24px;">&nbsp;27</td>\r\n<td style="height: 24px;">&nbsp;28</td>\r\n<td style="height: 24px;">&nbsp;29</td>\r\n<td style="height: 24px;">&nbsp;30</td>\r\n<td style="height: 24px;">&nbsp;31</td>\r\n</tr>\r\n<tr>\r\n<td style="height: 24px;">&nbsp;<strong>June</strong></td>\r\n<td style="height: 24px;">&nbsp;&nbsp;1</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;2</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;3</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;4</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;5</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;6</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;7</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;8</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;9</td>\r\n<td style="height: 24px;">&nbsp;10</td>\r\n<td style="height: 24px;">&nbsp;11</td>\r\n<td style="height: 24px;">&nbsp;12</td>\r\n<td style="height: 24px;">&nbsp;13</td>\r\n<td style="height: 24px;">&nbsp;14</td>\r\n<td style="height: 24px;">&nbsp;15</td>\r\n<td style="height: 24px;">&nbsp;16</td>\r\n<td style="height: 24px;">&nbsp;17</td>\r\n<td style="height: 24px;">&nbsp;18</td>\r\n<td style="height: 24px;">&nbsp;19</td>\r\n<td style="height: 24px;">&nbsp;20</td>\r\n<td style="height: 24px;">&nbsp;21</td>\r\n<td style="height: 24px;">&nbsp;22</td>\r\n<td style="height: 24px;">&nbsp;23</td>\r\n<td style="height: 24px;">&nbsp;24</td>\r\n<td style="height: 24px;">&nbsp;25</td>\r\n<td style="height: 24px;">&nbsp;26</td>\r\n<td style="height: 24px;">&nbsp;27</td>\r\n<td style="height: 24px;">&nbsp;28</td>\r\n<td style="height: 24px;">&nbsp;29</td>\r\n<td style="height: 24px;">&nbsp;30</td>\r\n<td style="height: 24px;">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td style="height: 24px;">&nbsp;<strong>July</strong></td>\r\n<td style="height: 24px;">&nbsp;&nbsp;1</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;2</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;3</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;4</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;5</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;6</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;7</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;8</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;9</td>\r\n<td style="height: 24px;">&nbsp;10</td>\r\n<td style="height: 24px;">&nbsp;11</td>\r\n<td style="height: 24px;">&nbsp;12</td>\r\n<td style="height: 24px;">&nbsp;13</td>\r\n<td style="height: 24px;">&nbsp;14</td>\r\n<td style="height: 24px;">&nbsp;15</td>\r\n<td style="height: 24px;">&nbsp;16</td>\r\n<td style="height: 24px;">&nbsp;17</td>\r\n<td style="height: 24px;">&nbsp;18</td>\r\n<td style="height: 24px;">&nbsp;19</td>\r\n<td style="height: 24px;">&nbsp;20</td>\r\n<td style="height: 24px;">&nbsp;21</td>\r\n<td style="height: 24px;">&nbsp;22</td>\r\n<td style="height: 24px;">&nbsp;23</td>\r\n<td style="height: 24px;">&nbsp;24</td>\r\n<td style="height: 24px;">&nbsp;25</td>\r\n<td style="height: 24px;">&nbsp;26</td>\r\n<td style="height: 24px;">&nbsp;27</td>\r\n<td style="height: 24px;">&nbsp;28</td>\r\n<td style="height: 24px;">&nbsp;29</td>\r\n<td style="height: 24px;">&nbsp;30</td>\r\n<td style="height: 24px;">&nbsp;31</td>\r\n</tr>\r\n<tr>\r\n<td style="height: 24px;">&nbsp;<strong>August</strong></td>\r\n<td style="height: 24px;">&nbsp;&nbsp;1</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;2</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;3</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;4</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;5</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;6</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;7</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;8</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;9</td>\r\n<td style="height: 24px;">&nbsp;10</td>\r\n<td style="height: 24px;">&nbsp;11</td>\r\n<td style="height: 24px;">&nbsp;12</td>\r\n<td style="height: 24px;">&nbsp;13</td>\r\n<td style="height: 24px;">&nbsp;14</td>\r\n<td style="height: 24px;">&nbsp;15</td>\r\n<td style="height: 24px;">&nbsp;16</td>\r\n<td style="height: 24px;">&nbsp;17</td>\r\n<td style="height: 24px;">&nbsp;18</td>\r\n<td style="height: 24px;">&nbsp;19</td>\r\n<td style="height: 24px;">&nbsp;20</td>\r\n<td style="height: 24px;">&nbsp;21</td>\r\n<td style="height: 24px;">&nbsp;22</td>\r\n<td style="height: 24px;">&nbsp;23</td>\r\n<td style="height: 24px;">&nbsp;24</td>\r\n<td style="height: 24px;">&nbsp;25</td>\r\n<td style="height: 24px;">&nbsp;26</td>\r\n<td style="height: 24px;">&nbsp;27</td>\r\n<td style="height: 24px;">&nbsp;28</td>\r\n<td style="height: 24px;">&nbsp;29</td>\r\n<td style="height: 24px;">&nbsp;30</td>\r\n<td style="height: 24px;">&nbsp;31</td>\r\n</tr>\r\n<tr>\r\n<td style="height: 24px;">&nbsp;<strong>September</strong></td>\r\n<td style="height: 24px;">&nbsp;<a href="index.php?option=com_content&amp;view=article&amp;id=7:daily-mass-readings-english-09-01-2014&amp;catid=12:english" target="_self"> 1</a></td>\r\n<td style="height: 24px;">&nbsp;&nbsp;2</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;3</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;4</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;5</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;6</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;7</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;8</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;9</td>\r\n<td style="height: 24px;">&nbsp;10</td>\r\n<td style="height: 24px;">&nbsp;11</td>\r\n<td style="height: 24px;">&nbsp;12</td>\r\n<td style="height: 24px;">&nbsp;13</td>\r\n<td style="height: 24px;">&nbsp;14</td>\r\n<td style="height: 24px;">&nbsp;15</td>\r\n<td style="height: 24px;">&nbsp;16</td>\r\n<td style="height: 24px;">&nbsp;17</td>\r\n<td style="height: 24px;">&nbsp;18</td>\r\n<td style="height: 24px;">&nbsp;19</td>\r\n<td style="height: 24px;">&nbsp;20</td>\r\n<td style="height: 24px;">&nbsp;21</td>\r\n<td style="height: 24px;">&nbsp;22</td>\r\n<td style="height: 24px;">&nbsp;23</td>\r\n<td style="height: 24px;">&nbsp;24</td>\r\n<td style="height: 24px;">&nbsp;25</td>\r\n<td style="height: 24px;">&nbsp;26</td>\r\n<td style="height: 24px;">&nbsp;27</td>\r\n<td style="height: 24px;">&nbsp;28</td>\r\n<td style="height: 24px;">&nbsp;29</td>\r\n<td style="height: 24px;">&nbsp;30</td>\r\n<td style="height: 24px;">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td style="height: 24px;">&nbsp;<strong>October</strong></td>\r\n<td style="height: 24px;">&nbsp;&nbsp;1</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;2</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;3</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;4</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;5</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;6</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;7</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;8</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;9</td>\r\n<td style="height: 24px;">&nbsp;10</td>\r\n<td style="height: 24px;">&nbsp;11</td>\r\n<td style="height: 24px;">&nbsp;12</td>\r\n<td style="height: 24px;">&nbsp;13</td>\r\n<td style="height: 24px;">&nbsp;14</td>\r\n<td style="height: 24px;">&nbsp;15</td>\r\n<td style="height: 24px;">&nbsp;16</td>\r\n<td style="height: 24px;">&nbsp;17</td>\r\n<td style="height: 24px;">&nbsp;18</td>\r\n<td style="height: 24px;">&nbsp;19</td>\r\n<td style="height: 24px;">&nbsp;20</td>\r\n<td style="height: 24px;">&nbsp;21</td>\r\n<td style="height: 24px;">&nbsp;22</td>\r\n<td style="height: 24px;">&nbsp;23</td>\r\n<td style="height: 24px;">&nbsp;24</td>\r\n<td style="height: 24px;">&nbsp;25</td>\r\n<td style="height: 24px;">&nbsp;26</td>\r\n<td style="height: 24px;">&nbsp;27</td>\r\n<td style="height: 24px;">&nbsp;28</td>\r\n<td style="height: 24px;">&nbsp;29</td>\r\n<td style="height: 24px;">&nbsp;30</td>\r\n<td style="height: 24px;">&nbsp;31</td>\r\n</tr>\r\n<tr>\r\n<td style="height: 24px;">&nbsp;<strong>November</strong></td>\r\n<td style="height: 24px;">&nbsp;&nbsp;1</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;2</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;3</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;4</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;5</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;6</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;7</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;8</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;9</td>\r\n<td style="height: 24px;">&nbsp;10</td>\r\n<td style="height: 24px;">&nbsp;11</td>\r\n<td style="height: 24px;">&nbsp;12</td>\r\n<td style="height: 24px;">&nbsp;13</td>\r\n<td style="height: 24px;">&nbsp;14</td>\r\n<td style="height: 24px;">&nbsp;15</td>\r\n<td style="height: 24px;">&nbsp;16</td>\r\n<td style="height: 24px;">&nbsp;17</td>\r\n<td style="height: 24px;">&nbsp;18</td>\r\n<td style="height: 24px;">&nbsp;19</td>\r\n<td style="height: 24px;">&nbsp;20</td>\r\n<td style="height: 24px;">&nbsp;21</td>\r\n<td style="height: 24px;">&nbsp;22</td>\r\n<td style="height: 24px;">&nbsp;23</td>\r\n<td style="height: 24px;">&nbsp;24</td>\r\n<td style="height: 24px;">&nbsp;25</td>\r\n<td style="height: 24px;">&nbsp;26</td>\r\n<td style="height: 24px;">&nbsp;27</td>\r\n<td style="height: 24px;">&nbsp;28</td>\r\n<td style="height: 24px;">&nbsp;29</td>\r\n<td style="height: 24px;">&nbsp;30</td>\r\n<td style="height: 24px;">&nbsp;</td>\r\n</tr>\r\n<tr>\r\n<td style="height: 24px;">&nbsp;<strong>December</strong></td>\r\n<td style="height: 24px;">&nbsp;&nbsp;1</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;2</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;3</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;4</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;5</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;6</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;7</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;8</td>\r\n<td style="height: 24px;">&nbsp;&nbsp;9</td>\r\n<td style="height: 24px;">&nbsp;10</td>\r\n<td style="height: 24px;">&nbsp;11</td>\r\n<td style="height: 24px;">&nbsp;12</td>\r\n<td style="height: 24px;">&nbsp;13</td>\r\n<td style="height: 24px;">&nbsp;14</td>\r\n<td style="height: 24px;">&nbsp;15</td>\r\n<td style="height: 24px;">&nbsp;16</td>\r\n<td style="height: 24px;">&nbsp;17</td>\r\n<td style="height: 24px;">&nbsp;18</td>\r\n<td style="height: 24px;">&nbsp;19</td>\r\n<td style="height: 24px;">&nbsp;20</td>\r\n<td style="height: 24px;">&nbsp;21</td>\r\n<td style="height: 24px;">&nbsp;22</td>\r\n<td style="height: 24px;">&nbsp;23</td>\r\n<td style="height: 24px;">&nbsp;24</td>\r\n<td style="height: 24px;">&nbsp;25</td>\r\n<td style="height: 24px;">&nbsp;26</td>\r\n<td style="height: 24px;">&nbsp;27</td>\r\n<td style="height: 24px;">&nbsp;28</td>\r\n<td style="height: 24px;">&nbsp;29</td>\r\n<td style="height: 24px;">&nbsp;30</td>\r\n<td style="height: 24px;">&nbsp;31</td>\r\n</tr>\r\n</tbody>\r\n</table>', 1, 'bottom', 876, '2015-08-03 07:04:35', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 0, 'mod_custom', 1, 0, '{"prepare_content":"0","backgroundimage":"","layout":"_:default","moduleclass_sfx":"","cache":"1","cache_time":"900","cachemode":"static"}', 0, '*'),
(96, 'sidepicture', '', '<p><img src="images/sidepicture.jpg" alt="" /></p>', 2, 'right', 876, '2015-08-03 07:32:38', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_custom', 1, 0, '{"prepare_content":"0","backgroundimage":"","layout":"_:default","moduleclass_sfx":"","cache":"1","cache_time":"900","cachemode":"static"}', 0, '*'),
(97, 'Contact', '', '<p><strong><span style="color: #ffffff;">Ang Salita ng Diyos.com</span></strong></p>\r\n<p>&nbsp; &nbsp; <span style="font-size: 10pt;">&nbsp;&nbsp;<span style="font-size: 8pt; color: #000000;">www.angsalitangdiyos.com</span></span></p>\r\n<p><strong><span style="color: #ffffff;">Archdiocesan Liturgical Commision</span></strong></p>\r\n<p>&nbsp; &nbsp; &nbsp;<span style="color: #000000;"> &nbsp;<span style="font-size: 10.6666669845581px;">Arzobispo de Manila<br />&nbsp; &nbsp; &nbsp; &nbsp; 121 Arzobispo St., Intramuros, Manila<br />&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Telephone Nos: (632) 4043891<br />&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Email Address: angsalitangdiyos@gmail.com</span></span></p>\r\n<p><strong><span style="color: #ffffff;">Send A Message:</span></strong></p>\r\n<p>&nbsp;</p>', 1, 'banner', 876, '2015-08-10 03:33:41', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 1, 'mod_custom', 1, 1, '{"prepare_content":"0","backgroundimage":"","layout":"_:default","moduleclass_sfx":"","cache":"1","cache_time":"900","cachemode":"static"}', 0, '*');

-- --------------------------------------------------------

--
-- Table structure for table `molc_modules_menu`
--

CREATE TABLE IF NOT EXISTS `molc_modules_menu` (
  `moduleid` int(11) NOT NULL DEFAULT '0',
  `menuid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`moduleid`,`menuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `molc_modules_menu`
--

INSERT INTO `molc_modules_menu` (`moduleid`, `menuid`) VALUES
(1, 0),
(2, 0),
(3, 0),
(4, 0),
(6, 0),
(7, 0),
(8, 0),
(9, 0),
(10, 0),
(12, 0),
(13, 0),
(14, 0),
(15, 0),
(16, 0),
(17, 0),
(79, 0),
(86, 0),
(87, 0),
(88, 101),
(89, 0),
(90, 0),
(91, 0),
(92, 0),
(93, 0),
(94, 122),
(95, 125),
(96, 0),
(97, 124);

-- --------------------------------------------------------

--
-- Table structure for table `molc_newsfeeds`
--

CREATE TABLE IF NOT EXISTS `molc_newsfeeds` (
  `catid` int(11) NOT NULL DEFAULT '0',
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL DEFAULT '',
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `link` varchar(200) NOT NULL DEFAULT '',
  `filename` varchar(200) DEFAULT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `numarticles` int(10) unsigned NOT NULL DEFAULT '1',
  `cache_time` int(10) unsigned NOT NULL DEFAULT '3600',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `rtl` tinyint(4) NOT NULL DEFAULT '0',
  `access` int(10) unsigned NOT NULL DEFAULT '0',
  `language` char(7) NOT NULL DEFAULT '',
  `params` text NOT NULL,
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) unsigned NOT NULL DEFAULT '0',
  `created_by_alias` varchar(255) NOT NULL DEFAULT '',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) unsigned NOT NULL DEFAULT '0',
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `metadata` text NOT NULL,
  `xreference` varchar(50) NOT NULL COMMENT 'A reference to enable linkages to external data sets.',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_state` (`published`),
  KEY `idx_catid` (`catid`),
  KEY `idx_createdby` (`created_by`),
  KEY `idx_language` (`language`),
  KEY `idx_xreference` (`xreference`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `molc_overrider`
--

CREATE TABLE IF NOT EXISTS `molc_overrider` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `constant` varchar(255) NOT NULL,
  `string` text NOT NULL,
  `file` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `molc_redirect_links`
--

CREATE TABLE IF NOT EXISTS `molc_redirect_links` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `old_url` varchar(255) NOT NULL,
  `new_url` varchar(255) NOT NULL,
  `referer` varchar(150) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `hits` int(10) unsigned NOT NULL DEFAULT '0',
  `published` tinyint(4) NOT NULL,
  `created_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_link_old` (`old_url`),
  KEY `idx_link_modifed` (`modified_date`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `molc_redirect_links`
--

INSERT INTO `molc_redirect_links` (`id`, `old_url`, `new_url`, `referer`, `comment`, `hits`, `published`, `created_date`, `modified_date`) VALUES
(1, 'http://192.185.194.26/~angsalit/index.php/calendar', '', '', '', 1, 0, '2015-04-21 14:50:26', '0000-00-00 00:00:00'),
(2, 'http://192.185.194.27/~angsalit/index.php/notes', '', 'http://192.185.194.27/~angsalit/index.php/daily-mass-readings/english', '', 1, 0, '2015-07-18 03:08:05', '0000-00-00 00:00:00'),
(3, 'http://192.185.194.27/~angsalit/index.php/links/notes', '', 'http://192.185.194.27/~angsalit/index.php/contact-us', '', 2, 0, '2015-08-10 05:25:42', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `molc_schemas`
--

CREATE TABLE IF NOT EXISTS `molc_schemas` (
  `extension_id` int(11) NOT NULL,
  `version_id` varchar(20) NOT NULL,
  PRIMARY KEY (`extension_id`,`version_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `molc_schemas`
--

INSERT INTO `molc_schemas` (`extension_id`, `version_id`) VALUES
(700, '2.5.24'),
(10009, '3.3.8');

-- --------------------------------------------------------

--
-- Table structure for table `molc_session`
--

CREATE TABLE IF NOT EXISTS `molc_session` (
  `session_id` varchar(200) NOT NULL DEFAULT '',
  `client_id` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `guest` tinyint(4) unsigned DEFAULT '1',
  `time` varchar(14) DEFAULT '',
  `data` mediumtext,
  `userid` int(11) DEFAULT '0',
  `username` varchar(150) DEFAULT '',
  `usertype` varchar(50) DEFAULT '',
  PRIMARY KEY (`session_id`),
  KEY `whosonline` (`guest`,`usertype`),
  KEY `userid` (`userid`),
  KEY `time` (`time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `molc_session`
--

INSERT INTO `molc_session` (`session_id`, `client_id`, `guest`, `time`, `data`, `userid`, `username`, `usertype`) VALUES
('32cb841762aeea7266043e675b657a45', 1, 0, '1440302190', '__default|a:8:{s:15:"session.counter";i:13;s:19:"session.timer.start";i:1440301500;s:18:"session.timer.last";i:1440302187;s:17:"session.timer.now";i:1440302189;s:22:"session.client.browser";s:114:"Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.155 Safari/537.36";s:8:"registry";O:9:"JRegistry":1:{s:7:"\0*\0data";O:8:"stdClass":4:{s:11:"application";O:8:"stdClass":1:{s:4:"lang";s:0:"";}s:13:"com_installer";O:8:"stdClass":2:{s:7:"message";s:0:"";s:17:"extension_message";s:0:"";}s:13:"com_templates";O:8:"stdClass":2:{s:6:"styles";O:8:"stdClass":1:{s:10:"limitstart";i:0;}s:4:"edit";O:8:"stdClass":1:{s:6:"source";O:8:"stdClass":2:{s:2:"id";s:20:"MTAwMDE6aW5kZXgucGhw";s:4:"data";N;}}}s:6:"editor";O:8:"stdClass":1:{s:6:"source";O:8:"stdClass":1:{s:6:"syntax";s:3:"php";}}}}s:4:"user";O:5:"JUser":25:{s:9:"\0*\0isRoot";b:1;s:2:"id";s:3:"876";s:4:"name";s:10:"Super User";s:8:"username";s:7:"lcadmin";s:5:"email";s:25:"boogie@cyberoutsource.net";s:8:"password";s:34:"$P$DcoHUHmk44EUQ5exJoqO.Xa6LECEUl.";s:14:"password_clear";s:0:"";s:8:"usertype";s:10:"deprecated";s:5:"block";s:1:"0";s:9:"sendEmail";s:1:"1";s:12:"registerDate";s:19:"2014-08-24 07:16:34";s:13:"lastvisitDate";s:19:"2015-08-23 03:17:22";s:10:"activation";s:1:"0";s:6:"params";s:95:"{"admin_style":"","admin_language":"","language":"","editor":"jce","helpsite":"","timezone":""}";s:6:"groups";a:1:{i:8;s:1:"8";}s:5:"guest";i:0;s:13:"lastResetTime";s:19:"0000-00-00 00:00:00";s:10:"resetCount";s:1:"0";s:10:"\0*\0_params";O:9:"JRegistry":1:{s:7:"\0*\0data";O:8:"stdClass":6:{s:11:"admin_style";s:0:"";s:14:"admin_language";s:0:"";s:8:"language";s:0:"";s:6:"editor";s:3:"jce";s:8:"helpsite";s:0:"";s:8:"timezone";s:0:"";}}s:14:"\0*\0_authGroups";a:2:{i:0;i:1;i:1;i:8;}s:14:"\0*\0_authLevels";a:4:{i:0;i:1;i:1;i:1;i:2;i:2;i:3;i:3;}s:15:"\0*\0_authActions";N;s:12:"\0*\0_errorMsg";N;s:10:"\0*\0_errors";a:0:{}s:3:"aid";i:0;}s:13:"session.token";s:32:"99c60c08d8c88285f91f7958affeb3f8";}__wf|a:1:{s:13:"session.token";s:32:"67cb98b435b2948d06ceb49b85177754";}', 876, 'lcadmin', ''),
('395eb76fa3f65ab6982070b2f3af2424', 0, 1, '1440302089', '__default|a:9:{s:15:"session.counter";i:9;s:19:"session.timer.start";i:1440298591;s:18:"session.timer.last";i:1440301959;s:17:"session.timer.now";i:1440302088;s:22:"session.client.browser";s:114:"Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/44.0.2403.155 Safari/537.36";s:8:"registry";O:9:"JRegistry":1:{s:7:"\0*\0data";O:8:"stdClass":0:{}}s:4:"user";O:5:"JUser":25:{s:9:"\0*\0isRoot";b:0;s:2:"id";i:0;s:4:"name";N;s:8:"username";N;s:5:"email";N;s:8:"password";N;s:14:"password_clear";s:0:"";s:8:"usertype";N;s:5:"block";N;s:9:"sendEmail";i:0;s:12:"registerDate";N;s:13:"lastvisitDate";N;s:10:"activation";N;s:6:"params";N;s:6:"groups";a:0:{}s:5:"guest";i:1;s:13:"lastResetTime";N;s:10:"resetCount";N;s:10:"\0*\0_params";O:9:"JRegistry":1:{s:7:"\0*\0data";O:8:"stdClass":0:{}}s:14:"\0*\0_authGroups";a:1:{i:0;i:1;}s:14:"\0*\0_authLevels";a:2:{i:0;i:1;i:1;i:1;}s:15:"\0*\0_authActions";N;s:12:"\0*\0_errorMsg";N;s:10:"\0*\0_errors";a:0:{}s:3:"aid";i:0;}s:16:"com_mailto.links";a:1:{s:40:"0df8d38ab4cd514837c41e92f134f2b1cef10251";O:8:"stdClass":2:{s:4:"link";s:93:"http://192.185.194.27/~angsalit/index.php/8-general/1-a-message-from-the-archbishop-of-manila";s:6:"expiry";i:1440301960;}}s:13:"session.token";s:32:"de869b22cb06b25055388d503df8897c";}', 0, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `molc_template_styles`
--

CREATE TABLE IF NOT EXISTS `molc_template_styles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `template` varchar(50) NOT NULL DEFAULT '',
  `client_id` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `home` char(7) NOT NULL DEFAULT '0',
  `title` varchar(255) NOT NULL DEFAULT '',
  `params` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_template` (`template`),
  KEY `idx_home` (`home`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `molc_template_styles`
--

INSERT INTO `molc_template_styles` (`id`, `template`, `client_id`, `home`, `title`, `params`) VALUES
(2, 'bluestork', 1, '1', 'Bluestork - Default', '{"useRoundedCorners":"1","showSiteName":"0"}'),
(3, 'atomic', 0, '0', 'Atomic - Default', '{}'),
(4, 'beez_20', 0, '0', 'Beez2 - Default', '{"wrapperSmall":"53","wrapperLarge":"72","logo":"images\\/joomla_black.gif","sitetitle":"Joomla!","sitedescription":"Open Source Content Management","navposition":"left","templatecolor":"personal","html5":"0"}'),
(5, 'hathor', 1, '0', 'Hathor - Default', '{"showSiteName":"0","colourChoice":"","boldText":"0"}'),
(6, 'beez5', 0, '0', 'Beez5 - Default', '{"wrapperSmall":"53","wrapperLarge":"72","logo":"images\\/sampledata\\/fruitshop\\/fruits.gif","sitetitle":"Joomla!","sitedescription":"Open Source Content Management","navposition":"left","html5":"0"}'),
(7, 'jp_dailypraise2_j1.5', 0, '0', 'jp_dailypraise2_j1.5 - Default', '{}'),
(8, 'jp_bloq_j25', 0, '1', 'jp_bloq_j25 - Default', '{"templateTheme":"theme1","switchSidebar":"right","fontFamily":"arial","headingFontFamily":"yanone","fontColor":"#677D00","headingColor":"#677D00","linkColor":"#FFFF99","linkHoverColor":"#768E20","topMenuColor":"#738925","headerColor":"#B6D23B","mainMenuColor":"#738925","bannerColor":"#A2B25A","pathwayColor":"#B6D23B","insetColor":"#A2B25A","posColor":"#A2B25A","elementsColor":"#B6D23B","searchColor":"","footerColor":"#A2B25A"}');

-- --------------------------------------------------------

--
-- Table structure for table `molc_updates`
--

CREATE TABLE IF NOT EXISTS `molc_updates` (
  `update_id` int(11) NOT NULL AUTO_INCREMENT,
  `update_site_id` int(11) DEFAULT '0',
  `extension_id` int(11) DEFAULT '0',
  `categoryid` int(11) DEFAULT '0',
  `name` varchar(100) DEFAULT '',
  `description` text NOT NULL,
  `element` varchar(100) DEFAULT '',
  `type` varchar(20) DEFAULT '',
  `folder` varchar(20) DEFAULT '',
  `client_id` tinyint(3) DEFAULT '0',
  `version` varchar(10) DEFAULT '',
  `data` text NOT NULL,
  `detailsurl` text NOT NULL,
  `infourl` text NOT NULL,
  PRIMARY KEY (`update_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Available Updates' AUTO_INCREMENT=19 ;

--
-- Dumping data for table `molc_updates`
--

INSERT INTO `molc_updates` (`update_id`, `update_site_id`, `extension_id`, `categoryid`, `name`, `description`, `element`, `type`, `folder`, `client_id`, `version`, `data`, `detailsurl`, `infourl`) VALUES
(1, 4, 10005, 0, 'JCE Editor', '', 'com_jce', 'component', '', 1, '2.4.6', '', 'https://www.joomlacontenteditor.net/index.php?option=com_updates&view=update&format=xml&id=1&file=extension.xml', 'http://www.joomlacontenteditor.net/news/item/jce-246-released'),
(2, 5, 10010, 0, 'AllVideos', 'The ultimate media player for Joomla!', 'jw_allvideos', 'plugin', 'content', 0, '4.7.0', '', 'http://www.joomlaworks.net/updates/jw_allvideos.xml', 'http://www.joomlaworks.net/forum/product-updates/41200-april-20th,-2015-allvideos-v4-7-0'),
(3, 4, 0, 0, 'JCE Editor', '', 'com_jce', 'component', '', 1, '2.5.2', '', 'https://www.joomlacontenteditor.net/index.php?option=com_updates&view=update&format=xml&id=1&file=extension.xml', 'http://www.joomlacontenteditor.net/news/item/jce-252-released'),
(4, 4, 0, 0, 'JCE Editor', '', 'com_jce', 'component', '', 1, '2.5.2', '', 'https://www.joomlacontenteditor.net/index.php?option=com_updates&view=update&format=xml&id=1&file=extension.xml', 'http://www.joomlacontenteditor.net/news/item/jce-252-released'),
(5, 4, 0, 0, 'JCE Editor', '', 'com_jce', 'component', '', 1, '2.5.2', '', 'https://www.joomlacontenteditor.net/index.php?option=com_updates&view=update&format=xml&id=1&file=extension.xml', 'http://www.joomlacontenteditor.net/news/item/jce-252-released'),
(6, 4, 0, 0, 'JCE Editor', '', 'com_jce', 'component', '', 1, '2.5.2', '', 'https://www.joomlacontenteditor.net/index.php?option=com_updates&view=update&format=xml&id=1&file=extension.xml', 'http://www.joomlacontenteditor.net/news/item/jce-252-released'),
(7, 4, 0, 0, 'JCE Editor', '', 'com_jce', 'component', '', 1, '2.5.2', '', 'https://www.joomlacontenteditor.net/index.php?option=com_updates&view=update&format=xml&id=1&file=extension.xml', 'http://www.joomlacontenteditor.net/news/item/jce-252-released'),
(8, 4, 0, 0, 'JCE Editor', '', 'com_jce', 'component', '', 1, '2.5.2', '', 'https://www.joomlacontenteditor.net/index.php?option=com_updates&view=update&format=xml&id=1&file=extension.xml', 'http://www.joomlacontenteditor.net/news/item/jce-252-released'),
(9, 4, 0, 0, 'JCE Editor', '', 'com_jce', 'component', '', 1, '2.5.2', '', 'https://www.joomlacontenteditor.net/index.php?option=com_updates&view=update&format=xml&id=1&file=extension.xml', 'http://www.joomlacontenteditor.net/news/item/jce-252-released'),
(10, 4, 0, 0, 'JCE Editor', '', 'com_jce', 'component', '', 1, '2.5.2', '', 'https://www.joomlacontenteditor.net/index.php?option=com_updates&view=update&format=xml&id=1&file=extension.xml', 'http://www.joomlacontenteditor.net/news/item/jce-252-released'),
(11, 4, 0, 0, 'JCE Editor', '', 'com_jce', 'component', '', 1, '2.5.2', '', 'https://www.joomlacontenteditor.net/index.php?option=com_updates&view=update&format=xml&id=1&file=extension.xml', 'http://www.joomlacontenteditor.net/news/item/jce-252-released'),
(12, 4, 0, 0, 'JCE Editor', '', 'com_jce', 'component', '', 1, '2.5.2', '', 'https://www.joomlacontenteditor.net/index.php?option=com_updates&view=update&format=xml&id=1&file=extension.xml', 'http://www.joomlacontenteditor.net/news/item/jce-252-released'),
(13, 4, 0, 0, 'JCE Editor', '', 'com_jce', 'component', '', 1, '2.5.2', '', 'https://www.joomlacontenteditor.net/index.php?option=com_updates&view=update&format=xml&id=1&file=extension.xml', 'http://www.joomlacontenteditor.net/news/item/jce-252-released'),
(14, 4, 0, 0, 'JCE Editor', '', 'com_jce', 'component', '', 1, '2.5.2', '', 'https://www.joomlacontenteditor.net/index.php?option=com_updates&view=update&format=xml&id=1&file=extension.xml', 'http://www.joomlacontenteditor.net/news/item/jce-252-released'),
(15, 4, 0, 0, 'JCE Editor', '', 'com_jce', 'component', '', 1, '2.5.2', '', 'https://www.joomlacontenteditor.net/index.php?option=com_updates&view=update&format=xml&id=1&file=extension.xml', 'http://www.joomlacontenteditor.net/news/item/jce-252-released'),
(16, 4, 0, 0, 'JCE Editor', '', 'com_jce', 'component', '', 1, '2.5.2', '', 'https://www.joomlacontenteditor.net/index.php?option=com_updates&view=update&format=xml&id=1&file=extension.xml', 'http://www.joomlacontenteditor.net/news/item/jce-252-released'),
(17, 4, 0, 0, 'JCE Editor', '', 'com_jce', 'component', '', 1, '2.5.2', '', 'https://www.joomlacontenteditor.net/index.php?option=com_updates&view=update&format=xml&id=1&file=extension.xml', 'http://www.joomlacontenteditor.net/news/item/jce-252-released'),
(18, 4, 0, 0, 'JCE Editor', '', 'com_jce', 'component', '', 1, '2.5.2', '', 'https://www.joomlacontenteditor.net/index.php?option=com_updates&view=update&format=xml&id=1&file=extension.xml', 'http://www.joomlacontenteditor.net/news/item/jce-252-released');

-- --------------------------------------------------------

--
-- Table structure for table `molc_update_categories`
--

CREATE TABLE IF NOT EXISTS `molc_update_categories` (
  `categoryid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT '',
  `description` text NOT NULL,
  `parent` int(11) DEFAULT '0',
  `updatesite` int(11) DEFAULT '0',
  PRIMARY KEY (`categoryid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Update Categories' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `molc_update_sites`
--

CREATE TABLE IF NOT EXISTS `molc_update_sites` (
  `update_site_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT '',
  `type` varchar(20) DEFAULT '',
  `location` text NOT NULL,
  `enabled` int(11) DEFAULT '0',
  `last_check_timestamp` bigint(20) DEFAULT '0',
  PRIMARY KEY (`update_site_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='Update Sites' AUTO_INCREMENT=6 ;

--
-- Dumping data for table `molc_update_sites`
--

INSERT INTO `molc_update_sites` (`update_site_id`, `name`, `type`, `location`, `enabled`, `last_check_timestamp`) VALUES
(1, 'Joomla Core', 'collection', 'http://update.joomla.org/core/list.xml', 0, 1408864623),
(2, 'Joomla Extension Directory', 'collection', 'http://update.joomla.org/jed/list.xml', 0, 1408864623),
(3, 'Accredited Joomla! Translations', 'collection', 'http://update.joomla.org/language/translationlist.xml', 0, 1408864623),
(4, 'JCE Editor Updates', 'extension', 'https://www.joomlacontenteditor.net/index.php?option=com_updates&view=update&format=xml&id=1&file=extension.xml', 1, 1440299847),
(5, 'AllVideos', 'extension', 'http://www.joomlaworks.net/updates/jw_allvideos.xml', 1, 1440299847);

-- --------------------------------------------------------

--
-- Table structure for table `molc_update_sites_extensions`
--

CREATE TABLE IF NOT EXISTS `molc_update_sites_extensions` (
  `update_site_id` int(11) NOT NULL DEFAULT '0',
  `extension_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`update_site_id`,`extension_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Links extensions to update sites';

--
-- Dumping data for table `molc_update_sites_extensions`
--

INSERT INTO `molc_update_sites_extensions` (`update_site_id`, `extension_id`) VALUES
(1, 700),
(2, 700),
(3, 600),
(4, 10005),
(5, 10010);

-- --------------------------------------------------------

--
-- Table structure for table `molc_usergroups`
--

CREATE TABLE IF NOT EXISTS `molc_usergroups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Adjacency List Reference Id',
  `lft` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set lft.',
  `rgt` int(11) NOT NULL DEFAULT '0' COMMENT 'Nested set rgt.',
  `title` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_usergroup_parent_title_lookup` (`parent_id`,`title`),
  KEY `idx_usergroup_title_lookup` (`title`),
  KEY `idx_usergroup_adjacency_lookup` (`parent_id`),
  KEY `idx_usergroup_nested_set_lookup` (`lft`,`rgt`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `molc_usergroups`
--

INSERT INTO `molc_usergroups` (`id`, `parent_id`, `lft`, `rgt`, `title`) VALUES
(1, 0, 1, 20, 'Public'),
(2, 1, 6, 17, 'Registered'),
(3, 2, 7, 14, 'Author'),
(4, 3, 8, 11, 'Editor'),
(5, 4, 9, 10, 'Publisher'),
(6, 1, 2, 5, 'Manager'),
(7, 6, 3, 4, 'Administrator'),
(8, 1, 18, 19, 'Super Users');

-- --------------------------------------------------------

--
-- Table structure for table `molc_users`
--

CREATE TABLE IF NOT EXISTS `molc_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `username` varchar(150) NOT NULL DEFAULT '',
  `email` varchar(100) NOT NULL DEFAULT '',
  `password` varchar(100) NOT NULL DEFAULT '',
  `usertype` varchar(25) NOT NULL DEFAULT '',
  `block` tinyint(4) NOT NULL DEFAULT '0',
  `sendEmail` tinyint(4) DEFAULT '0',
  `registerDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `lastvisitDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `activation` varchar(100) NOT NULL DEFAULT '',
  `params` text NOT NULL,
  `lastResetTime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Date of last password reset',
  `resetCount` int(11) NOT NULL DEFAULT '0' COMMENT 'Count of password resets since lastResetTime',
  PRIMARY KEY (`id`),
  KEY `usertype` (`usertype`),
  KEY `idx_name` (`name`),
  KEY `idx_block` (`block`),
  KEY `username` (`username`),
  KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=878 ;

--
-- Dumping data for table `molc_users`
--

INSERT INTO `molc_users` (`id`, `name`, `username`, `email`, `password`, `usertype`, `block`, `sendEmail`, `registerDate`, `lastvisitDate`, `activation`, `params`, `lastResetTime`, `resetCount`) VALUES
(876, 'Super User', 'lcadmin', 'boogie@cyberoutsource.net', '$P$DcoHUHmk44EUQ5exJoqO.Xa6LECEUl.', 'deprecated', 0, 1, '2014-08-24 07:16:34', '2015-08-23 03:45:13', '0', '{"admin_style":"","admin_language":"","language":"","editor":"jce","helpsite":"","timezone":""}', '0000-00-00 00:00:00', 0),
(877, 'Web Administrator', 'webadmin', 'angsalitangdiyos@gmail.com', '$P$DLWEy1BuFkW2xb73bXo6vq4FMnmkoO.', '', 0, 0, '2014-08-25 03:31:05', '0000-00-00 00:00:00', '', '{"admin_style":"","admin_language":"","language":"","editor":"","helpsite":"","timezone":""}', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `molc_user_notes`
--

CREATE TABLE IF NOT EXISTS `molc_user_notes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `catid` int(10) unsigned NOT NULL DEFAULT '0',
  `subject` varchar(100) NOT NULL DEFAULT '',
  `body` text NOT NULL,
  `state` tinyint(3) NOT NULL DEFAULT '0',
  `checked_out` int(10) unsigned NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `created_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_user_id` int(10) unsigned NOT NULL,
  `modified_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `review_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `idx_user_id` (`user_id`),
  KEY `idx_category_id` (`catid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `molc_user_profiles`
--

CREATE TABLE IF NOT EXISTS `molc_user_profiles` (
  `user_id` int(11) NOT NULL,
  `profile_key` varchar(100) NOT NULL,
  `profile_value` varchar(255) NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  UNIQUE KEY `idx_user_id_profile_key` (`user_id`,`profile_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Simple user profile storage table';

-- --------------------------------------------------------

--
-- Table structure for table `molc_user_usergroup_map`
--

CREATE TABLE IF NOT EXISTS `molc_user_usergroup_map` (
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Foreign Key to #__users.id',
  `group_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Foreign Key to #__usergroups.id',
  PRIMARY KEY (`user_id`,`group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `molc_user_usergroup_map`
--

INSERT INTO `molc_user_usergroup_map` (`user_id`, `group_id`) VALUES
(876, 8),
(877, 5),
(877, 7);

-- --------------------------------------------------------

--
-- Table structure for table `molc_viewlevels`
--

CREATE TABLE IF NOT EXISTS `molc_viewlevels` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Primary Key',
  `title` varchar(100) NOT NULL DEFAULT '',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `rules` varchar(5120) NOT NULL COMMENT 'JSON encoded access control.',
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_assetgroup_title_lookup` (`title`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `molc_viewlevels`
--

INSERT INTO `molc_viewlevels` (`id`, `title`, `ordering`, `rules`) VALUES
(1, 'Public', 0, '[1]'),
(2, 'Registered', 1, '[6,2,8]'),
(3, 'Special', 2, '[6,3,8]');

-- --------------------------------------------------------

--
-- Table structure for table `molc_weblinks`
--

CREATE TABLE IF NOT EXISTS `molc_weblinks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `catid` int(11) NOT NULL DEFAULT '0',
  `sid` int(11) NOT NULL DEFAULT '0',
  `title` varchar(250) NOT NULL DEFAULT '',
  `alias` varchar(255) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL DEFAULT '',
  `url` varchar(250) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `hits` int(11) NOT NULL DEFAULT '0',
  `state` tinyint(1) NOT NULL DEFAULT '0',
  `checked_out` int(11) NOT NULL DEFAULT '0',
  `checked_out_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `archived` tinyint(1) NOT NULL DEFAULT '0',
  `approved` tinyint(1) NOT NULL DEFAULT '1',
  `access` int(11) NOT NULL DEFAULT '1',
  `params` text NOT NULL,
  `language` char(7) NOT NULL DEFAULT '',
  `created` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_by` int(10) unsigned NOT NULL DEFAULT '0',
  `created_by_alias` varchar(255) NOT NULL DEFAULT '',
  `modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modified_by` int(10) unsigned NOT NULL DEFAULT '0',
  `metakey` text NOT NULL,
  `metadesc` text NOT NULL,
  `metadata` text NOT NULL,
  `featured` tinyint(3) unsigned NOT NULL DEFAULT '0' COMMENT 'Set if link is featured.',
  `xreference` varchar(50) NOT NULL COMMENT 'A reference to enable linkages to external data sets.',
  `publish_up` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `publish_down` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `idx_access` (`access`),
  KEY `idx_checkout` (`checked_out`),
  KEY `idx_state` (`state`),
  KEY `idx_catid` (`catid`),
  KEY `idx_createdby` (`created_by`),
  KEY `idx_featured_catid` (`featured`,`catid`),
  KEY `idx_language` (`language`),
  KEY `idx_xreference` (`xreference`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `molc_weblinks`
--

INSERT INTO `molc_weblinks` (`id`, `catid`, `sid`, `title`, `alias`, `url`, `description`, `date`, `hits`, `state`, `checked_out`, `checked_out_time`, `ordering`, `archived`, `approved`, `access`, `params`, `language`, `created`, `created_by`, `created_by_alias`, `modified`, `modified_by`, `metakey`, `metadesc`, `metadata`, `featured`, `xreference`, `publish_up`, `publish_down`) VALUES
(1, 11, 0, 'United States Conference of Catholic Bishops', 'united-states-conference-of-catholic-bishops', 'http://www.usccb.org/nab', '<p>Daily Mass Readings based on the New American Bible Lectionary with podcast</p>', '0000-00-00 00:00:00', 7, 1, 876, '2015-07-03 04:38:52', 1, 0, 1, 1, '{"target":"1","width":"","height":"","count_clicks":""}', '*', '2014-08-27 15:11:39', 876, '', '2014-08-27 15:19:07', 876, '', '', '{"robots":"","rights":""}', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 11, 0, 'Biblical Words Pronunciation Guide', 'biblical-words-pronunciation-guide', 'http://netministries.org/Bbasics/bwords.htm', '<p>Audio recordings of Biblical words'' pronunciation.</p>', '0000-00-00 00:00:00', 6, 1, 876, '2015-07-03 04:34:22', 2, 0, 1, 1, '{"target":"1","width":"","height":"","count_clicks":""}', '*', '2014-08-27 15:14:33', 876, '', '2014-08-27 15:19:18', 876, '', '', '{"robots":"","rights":""}', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 11, 0, 'Downloads - Word & Life', 'downloads-word-life', 'http://www.wordandlife.org/downloads-2/', '<p>Download PDF copies of the Euchalette</p>', '0000-00-00 00:00:00', 3, 1, 0, '0000-00-00 00:00:00', 3, 0, 1, 1, '{"target":"1","width":"","height":"","count_clicks":""}', '*', '2014-08-27 15:17:01', 876, '', '2014-08-27 15:19:43', 876, '', '', '{"robots":"","rights":""}', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 11, 0, 'Sambuhay', 'sambuhay', 'http://ssp.ph/sambuhay/', '<p>To subscribe to Sambuhay Online</p>', '0000-00-00 00:00:00', 3, 1, 0, '0000-00-00 00:00:00', 4, 0, 1, 1, '{"target":"1","width":"","height":"","count_clicks":""}', '*', '2014-08-27 15:18:42', 876, '', '2014-08-27 15:19:32', 876, '', '', '{"robots":"","rights":""}', 0, '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `molc_wf_profiles`
--

CREATE TABLE IF NOT EXISTS `molc_wf_profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `users` text NOT NULL,
  `types` text NOT NULL,
  `components` text NOT NULL,
  `area` tinyint(3) NOT NULL,
  `device` varchar(255) NOT NULL,
  `rows` text NOT NULL,
  `plugins` text NOT NULL,
  `published` tinyint(3) NOT NULL,
  `ordering` int(11) NOT NULL,
  `checked_out` tinyint(3) NOT NULL,
  `checked_out_time` datetime NOT NULL,
  `params` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `molc_wf_profiles`
--

INSERT INTO `molc_wf_profiles` (`id`, `name`, `description`, `users`, `types`, `components`, `area`, `device`, `rows`, `plugins`, `published`, `ordering`, `checked_out`, `checked_out_time`, `params`) VALUES
(1, 'Default', 'Default Profile for all users', '', '3,4,5,6,8,7', '', 0, 'desktop,tablet,phone', 'help,newdocument,undo,redo,spacer,bold,italic,underline,strikethrough,justifyfull,justifycenter,justifyleft,justifyright,spacer,blockquote,formatselect,styleselect,removeformat,cleanup;fontselect,fontsizeselect,forecolor,backcolor,spacer,clipboard,indent,outdent,lists,sub,sup,textcase,charmap,hr;directionality,fullscreen,preview,source,print,searchreplace,spacer,table;visualaid,visualchars,visualblocks,nonbreaking,style,xhtmlxtras,anchor,unlink,link,imgmanager,spellchecker,article', 'charmap,contextmenu,browser,inlinepopups,media,help,clipboard,searchreplace,directionality,fullscreen,preview,source,table,textcase,print,style,nonbreaking,visualchars,visualblocks,xhtmlxtras,imgmanager,anchor,link,spellchecker,article,lists,formatselect,styleselect,fontselect,fontsizeselect,fontcolor', 1, 1, 0, '0000-00-00 00:00:00', ''),
(2, 'Front End', 'Sample Front-end Profile', '', '3,4,5', '', 1, 'desktop,tablet,phone', 'help,newdocument,undo,redo,spacer,bold,italic,underline,strikethrough,justifyfull,justifycenter,justifyleft,justifyright,spacer,formatselect,styleselect;clipboard,searchreplace,indent,outdent,lists,cleanup,charmap,removeformat,hr,sub,sup,textcase,nonbreaking,visualchars,visualblocks;fullscreen,preview,print,visualaid,style,xhtmlxtras,anchor,unlink,link,imgmanager,spellchecker,article', 'charmap,contextmenu,inlinepopups,help,clipboard,searchreplace,fullscreen,preview,print,style,textcase,nonbreaking,visualchars,visualblocks,xhtmlxtras,imgmanager,anchor,link,spellchecker,article,lists,formatselect,styleselect', 0, 2, 0, '0000-00-00 00:00:00', ''),
(3, 'Blogger', 'Simple Blogging Profile', '', '3,4,5,6,8,7', '', 0, 'desktop,tablet,phone', 'bold,italic,strikethrough,lists,blockquote,spacer,justifyleft,justifycenter,justifyright,spacer,link,unlink,imgmanager,article,spellchecker,fullscreen,kitchensink;formatselect,underline,justifyfull,forecolor,clipboard,removeformat,charmap,indent,outdent,undo,redo,help', 'link,imgmanager,article,spellchecker,fullscreen,kitchensink,clipboard,contextmenu,inlinepopups,lists,formatselect,fontcolor', 0, 3, 0, '0000-00-00 00:00:00', '{"editor":{"toggle":"0"}}'),
(4, 'Mobile', 'Sample Mobile Profile', '', '3,4,5,6,8,7', '', 0, 'tablet,phone', 'undo,redo,spacer,bold,italic,underline,formatselect,spacer,justifyleft,justifycenter,justifyfull,justifyright,spacer,fullscreen,kitchensink;styleselect,lists,spellchecker,article,link,unlink', 'fullscreen,kitchensink,spellchecker,article,link,inlinepopups,lists,formatselect,styleselect', 0, 4, 0, '0000-00-00 00:00:00', '{"editor":{"toolbar_theme":"mobile","resizing":"0","resize_horizontal":"0","resizing_use_cookie":"0","toggle":"0","links":{"popups":{"default":"","jcemediabox":{"enable":"0"},"window":{"enable":"0"}}}}}');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

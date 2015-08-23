
-- 
-- Table structure for table `#__dc_mv_calendars`
-- 

CREATE TABLE IF NOT EXISTS `#__dc_mv_calendars` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `title` text NOT NULL default '',
  `permissions` text,
  `owner` int(11),
  `subjectlist` TEXT NULL DEFAULT NULL,
  `locationlist` TEXT NULL DEFAULT NULL,
  `ordering` int(11) NOT NULL,
  `published` tinyint(1) NOT NULL default '0',
  `checked_out` int(11) NOT NULL default '0',
  `checked_out_time` datetime NOT NULL default '0000-00-00 00:00:00',
  PRIMARY KEY  (`id`)
);

-- 
-- Table structure for table '#__dc_mv_events'
-- 

CREATE TABLE IF NOT EXISTS `#__dc_mv_events` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `calid` int(10) unsigned DEFAULT NULL,
  `starttime` datetime DEFAULT NULL,
  `endtime` datetime DEFAULT NULL,
  `title` varchar(250) DEFAULT NULL,
  `location` varchar(250) DEFAULT NULL,
  `description` text,
  `isalldayevent` tinyint(3) unsigned DEFAULT NULL,
  `color` varchar(10) DEFAULT NULL,
  `owner` int(11),
  `published` tinyint(1),
  `rrule` varchar(255),
  `uid` int(10),
  `exdate` text,
  PRIMARY KEY (`id`)
);
CREATE TABLE IF NOT EXISTS `#__dc_mv_free` (
`id` int(11) unsigned NOT NULL ,
`a` TEXT,
`b` TEXT,
`c` TEXT,
`d` TEXT,
`e` TEXT,
PRIMARY KEY (`id`)
);
INSERT IGNORE INTO `#__dc_mv_free`(id) values(1);

CREATE TABLE IF NOT EXISTS `#__dc_mv_configuration` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `palettes` text,
  `administration` text,
  PRIMARY KEY (`id`)
);
INSERT IGNORE INTO `#__dc_mv_configuration` (`id`,`palettes`,`administration`) VALUES (
1,
'a:2:{i:0;a:3:{s:4:"name";s:7:"Default";s:6:"colors";a:70:{i:0;s:3:"FFF";i:1;s:3:"FCC";i:2;s:3:"FC9";i:3;s:3:"FF9";i:4;s:3:"FFC";i:5;s:3:"9F9";i:6;s:3:"9FF";i:7;s:3:"CFF";i:8;s:3:"CCF";i:9;s:3:"FCF";i:10;s:3:"CCC";i:11;s:3:"F66";i:12;s:3:"F96";i:13;s:3:"FF6";i:14;s:3:"FF3";i:15;s:3:"6F9";i:16;s:3:"3FF";i:17;s:3:"6FF";i:18;s:3:"99F";i:19;s:3:"F9F";i:20;s:3:"BBB";i:21;s:3:"F00";i:22;s:3:"F90";i:23;s:3:"FC6";i:24;s:3:"FF0";i:25;s:3:"3F3";i:26;s:3:"6CC";i:27;s:3:"3CF";i:28;s:3:"66C";i:29;s:3:"C6C";i:30;s:3:"999";i:31;s:3:"C00";i:32;s:3:"F60";i:33;s:3:"FC3";i:34;s:3:"FC0";i:35;s:3:"3C0";i:36;s:3:"0CC";i:37;s:3:"36F";i:38;s:3:"63F";i:39;s:3:"C3C";i:40;s:3:"666";i:41;s:3:"900";i:42;s:3:"C60";i:43;s:3:"C93";i:44;s:3:"990";i:45;s:3:"090";i:46;s:3:"399";i:47;s:3:"33F";i:48;s:3:"60C";i:49;s:3:"939";i:50;s:3:"333";i:51;s:3:"600";i:52;s:3:"930";i:53;s:3:"963";i:54;s:3:"660";i:55;s:3:"060";i:56;s:3:"366";i:57;s:3:"009";i:58;s:3:"339";i:59;s:3:"636";i:60;s:3:"000";i:61;s:3:"300";i:62;s:3:"630";i:63;s:3:"633";i:64;s:3:"330";i:65;s:3:"030";i:66;s:3:"033";i:67;s:3:"006";i:68;s:3:"309";i:69;s:3:"303";}s:7:"default";s:3:"F00";}i:1;a:3:{s:4:"name";s:9:"Semaphore";s:6:"colors";a:3:{i:0;s:3:"F00";i:1;s:3:"FF3";i:2;s:3:"3C0";}s:7:"default";s:3:"3C0";}}',
'a:15:{s:5:"views";a:4:{i:0;s:7:"viewDay";i:1;s:8:"viewWeek";i:2;s:9:"viewMonth";i:3;s:10:"viewNMonth";}s:11:"viewdefault";s:5:"month";s:8:"language";s:5:"en-GB";s:13:"start_weekday";s:1:"0";s:8:"cssStyle";s:9:"cupertino";s:12:"paletteColor";s:1:"0";s:6:"btoday";s:1:"1";s:11:"bnavigation";s:1:"1";s:8:"brefresh";s:1:"1";s:14:"numberOfMonths";s:2:"12";s:7:"sample0";N;s:7:"sample1";s:5:"click";s:7:"sample2";N;s:7:"sample3";s:0:"";s:7:"sample4";s:10:"new_window";}'
);







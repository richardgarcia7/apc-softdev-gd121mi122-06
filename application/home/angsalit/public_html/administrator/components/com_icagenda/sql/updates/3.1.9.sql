UPDATE `#__icagenda` SET version='3.1.9', releasedate='2013-09-06' WHERE id=2;

ALTER TABLE `#__icagenda_registration` ADD `notes` TEXT(65535)  NOT NULL AFTER `people`;
ALTER TABLE `#__icagenda_events` ADD `created_by_email` VARCHAR(100) NOT NULL AFTER `created_by_alias`;
ALTER TABLE `#__icagenda_events` ADD `weekdays` VARCHAR(255)  NOT NULL AFTER `displaytime`;

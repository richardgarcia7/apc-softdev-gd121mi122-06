UPDATE `#__icagenda` SET version='3.3.6', releasedate='2014-05-16' WHERE id=3;

ALTER TABLE `#__icagenda_customfields` ADD `slug` VARCHAR(255) NOT NULL AFTER `alias`;

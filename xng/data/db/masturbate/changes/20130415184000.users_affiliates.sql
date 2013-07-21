ALTER TABLE `users` ADD COLUMN `isAffiliate` TINYINT(1) UNSIGNED NULL AFTER `record_num`, ADD COLUMN `contactIcq` VARCHAR(255) NULL AFTER `isAffiliate`, ADD COLUMN `contactGtalk` VARCHAR(255) NULL AFTER `contactIcq`, ADD COLUMN `contactSkype` VARCHAR(255) NULL AFTER `contactGtalk`, ADD COLUMN `contactMsnLive` VARCHAR(255) NULL AFTER `contactSkype`, ADD COLUMN `affiliateCompanyName` VARCHAR(255) NULL AFTER `contactMsnLive`, ADD COLUMN `affiliateFirstname` VARCHAR(150) NULL AFTER `affiliateCompanyName`, ADD COLUMN `affiliateLastname` VARCHAR(150) NULL AFTER `affiliateFirstname`, ADD COLUMN `affiliateTitle` VARCHAR(150) NULL AFTER `affiliateLastname`, ADD COLUMN `affiliateFax` VARCHAR(150) NULL AFTER `affiliateTitle`, ADD COLUMN `affiliateStreetAddress` VARCHAR(255) NULL AFTER `affiliateFax`, ADD COLUMN `affiliateCity` VARCHAR(255) NULL AFTER `affiliateStreetAddress`, ADD COLUMN `affiliateState` VARCHAR(255) NULL AFTER `affiliateCity`, ADD COLUMN `affiliateZip` VARCHAR(50) NULL AFTER `affiliateState`, ADD COLUMN `affiliateCountry_id` INT UNSIGNED NULL AFTER `affiliateZip`; 

ALTER TABLE `content` ADD COLUMN `site_id` INT UNSIGNED NULL AFTER `movie_height`;

/* Drop legacy tables */
DROP TABLE IF EXISTS `affiliates_custodians`;

/* New table */
CREATE TABLE `affiliates_custodians`( `custodian_id` INT UNSIGNED NOT NULL AUTO_INCREMENT, `user_id` INT UNSIGNED NOT NULL, `firstname` VARCHAR(150) NOT NULL, `lastname` VARCHAR(150) NOT NULL, `streetAddress` VARCHAR(255) NOT NULL, `state` VARCHAR(255) NOT NULL, `city` VARCHAR(255) NOT NULL, `zip` VARCHAR(50) NOT NULL, `country_id` INT UNSIGNED NOT NULL, `ip` INT UNSIGNED, PRIMARY KEY (`custodian_id`) ) ENGINE=INNODB; 


/* Drop legacy tables */
DROP TABLE IF EXISTS `affiliates_sites`;

/* New table */
CREATE TABLE `affiliates_sites`( `site_id` INT UNSIGNED NOT NULL AUTO_INCREMENT, `user_id` INT UNSIGNED NOT NULL, `sitename` VARCHAR(200) NOT NULL, `webmasterProgramLink` TEXT, `trackingLink` TEXT, `siteDescription` TEXT, `siteBannerType` TINYINT(1) UNSIGNED NOT NULL, `custodian_id` INT UNSIGNED NOT NULL, `ip` INT UNSIGNED, PRIMARY KEY (`site_id`) ); 



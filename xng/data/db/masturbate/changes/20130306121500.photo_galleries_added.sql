/*Table structure for table `galleries` */

DROP TABLE IF EXISTS `galleries`;

CREATE TABLE `galleries`( 
    `gallery_id` INT UNSIGNED NOT NULL AUTO_INCREMENT, 
    `galleryName` VARCHAR(255) NOT NULL, 
    `galleryDescription` TEXT, 
    `galleryFolder` VARCHAR(5) NOT NULL, 
    `photosCount` INT UNSIGNED NOT NULL DEFAULT 0, 
    `user_id` INT UNSIGNED NOT NULL,
    `uploadDate` DATETIME NOT NULL, 
    `ip` INT UNSIGNED NOT NULL, 
    PRIMARY KEY (`gallery_id`) 
) ENGINE=INNODB DEFAULT CHARSET=latin1;

ALTER TABLE `galleries` ADD INDEX `IDX__user_id` (`user_id`);


/*Table structure for table `photos` */
DROP TABLE IF EXISTS `photos`;

CREATE TABLE `photos`(
    `photo_id` INT UNSIGNED NOT NULL AUTO_INCREMENT, 
    `gallery_id` INT UNSIGNED NOT NULL, 
    `photoTitle` VARCHAR(255) NOT NULL, 
    `filename` VARCHAR(50), 
    `photoWidth` INT UNSIGNED NOT NULL, 
    `photoHeight` INT UNSIGNED NOT NULL, 
    `user_id` INT UNSIGNED NOT NULL,
    `uploadDate` DATETIME NOT NULL, 
    `ip` INT UNSIGNED NOT NULL, 
    PRIMARY KEY (`photo_id`) 
) ENGINE=INNODB CHARSET=latin1; 

ALTER TABLE `photos` ADD INDEX `IDX__gallery_id` (`gallery_id`); 


CREATE TABLE `galleries_niches` (
  `gallery_id` INT(11) NOT NULL,
  `niche_id` INT(11) NOT NULL,
  KEY `UNQ__gallery_id__niche_id` (`gallery_id`,`niche_id`)
) ENGINE=INNODB DEFAULT CHARSET=latin1;


CREATE TABLE `photos_views` (
  `photo_id` INT(11) UNSIGNED NOT NULL,
  `views` INT(11) UNSIGNED DEFAULT 0 NOT NULL,
  PRIMARY KEY (`photo_id`)
) ENGINE=INNODB DEFAULT CHARSET=latin1;

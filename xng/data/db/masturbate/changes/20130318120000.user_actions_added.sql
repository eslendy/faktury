DROP TABLE IF EXISTS `photos_favorites`;

CREATE TABLE `photos_favorites` (
  `photo_id` INT(11) UNSIGNED NOT NULL,
  `user_id` INT(11) UNSIGNED NOT NULL,
  `addedDate` DATETIME NOT NULL, 
  `ip` INT UNSIGNED NOT NULL, 
  UNIQUE KEY `UNQ__user_id__photo_id` (`user_id`,`photo_id`)
) ENGINE=INNODB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `photos_rating`;

CREATE TABLE `photos_rating` (
  `photo_id` INT(11) UNSIGNED NOT NULL,
  `totalVotes` INT(11) UNSIGNED DEFAULT 0 NOT NULL,
  `totalStars` INT(11) UNSIGNED DEFAULT 0 NOT NULL, 
  `rating` DECIMAL(7,3) UNSIGNED DEFAULT 0 NOT NULL, 
  PRIMARY KEY (`photo_id`),
  KEY `rating` (`rating`)
) ENGINE=INNODB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `photos_comments`;

CREATE TABLE `photos_comments` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `photo_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comments` text NOT NULL,
  `creationDate` DATETIME NOT NULL,
  `ip` INT UNSIGNED NOT NULL, 
  PRIMARY KEY (`comment_id`),
  KEY `photo_id` (`photo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
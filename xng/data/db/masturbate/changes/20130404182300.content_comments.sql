/* Drop legacy tables */
DROP TABLE IF EXISTS `photos_comments`;

/* New table */
CREATE TABLE `content_comments` (
  `comment_id` INT(11) NOT NULL AUTO_INCREMENT,
  `contentType_id` INT(11) UNSIGNED NOT NULL,
  `content_id` INT(11) UNSIGNED NOT NULL,
  `parentComment_id` INT(11) UNSIGNED, 
  `user_id` INT(11) NOT NULL,
  `comments` TEXT NOT NULL,
  `creationDate` DATETIME NOT NULL,
  `ip` INT UNSIGNED NOT NULL, 
  PRIMARY KEY (`comment_id`),
  KEY (`contentType_id`, `content_id`) 
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
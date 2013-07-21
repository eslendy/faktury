/** Drop legacy tables */
DROP TABLE IF EXISTS `photos_votetypes`;
DROP TABLE IF EXISTS `photos_votes`;
DROP TABLE IF EXISTS `photos_rating`;

/* New Tables */
DROP TABLE IF EXISTS `content_votetypes`;

CREATE TABLE `content_votetypes` (
  `voteType_id` TINYINT(11) UNSIGNED NOT NULL,
  `voteTypeName` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`voteType_id`)
) ENGINE=INNODB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `content_votes`;

CREATE TABLE `content_votes` (
  `contentType_id` INT UNSIGNED NOT NULL,
  `content_id` INT UNSIGNED NOT NULL,
  `voteType_id` TINYINT(11) UNSIGNED NOT NULL,
  `votes` INT(11) UNSIGNED DEFAULT 0 NOT NULL,
  PRIMARY KEY (`contentType_id`, `content_id`, `voteType_id`)
) ENGINE=INNODB DEFAULT CHARSET=latin1;


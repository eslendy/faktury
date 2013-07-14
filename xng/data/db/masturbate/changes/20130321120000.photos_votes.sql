DROP TABLE IF EXISTS `photos_votetypes`;

CREATE TABLE `photos_votetypes` (
  `voteType_id` TINYINT(11) UNSIGNED NOT NULL,
  `voteTypeName` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`voteType_id`)
) ENGINE=INNODB DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS `photos_votes`;

CREATE TABLE `photos_votes` (
  `photo_id` INT UNSIGNED NOT NULL,     
  `voteType_id` TINYINT(11) UNSIGNED NOT NULL,
  `votes` INT(11) UNSIGNED DEFAULT 0 NOT NULL,
  PRIMARY KEY (`photo_id`, `voteType_id`)
) ENGINE=INNODB DEFAULT CHARSET=latin1;



ALTER TABLE  `content` ADD  `type` TINYINT NOT NULL DEFAULT  '1';
ALTER TABLE  `users` CHANGE  `lastlogin`  `lastlogin` DATETIME NOT NULL;

DROP TABLE IF EXISTS `subscriptions`;
CREATE TABLE IF NOT EXISTS `subscriptions` (
  `user` int(11) NOT NULL,
  `subscribe_to` int(11) NOT NULL,
  `type` int(11) NOT NULL COMMENT '1=video 2=photos 3=pornstars',
  PRIMARY KEY (`user`,`subscribe_to`,`type`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

ALTER TABLE  `subscriptions` ADD  `date_added` DATETIME NULL;

--
-- Table structure for table `content_rating`
--

DROP TABLE IF EXISTS `content_rating`;
CREATE TABLE IF NOT EXISTS `content_rating` (
  `up` int(11) NOT NULL,
  `down` int(11) NOT NULL,
  `option1` int(11) NOT NULL DEFAULT '0',
  `option2` int(11) NOT NULL DEFAULT '0',
  `option3` int(11) NOT NULL DEFAULT '0',
  `option4` int(11) NOT NULL DEFAULT '0',
  `option5` int(11) NOT NULL DEFAULT '0',
  `option6` int(11) NOT NULL DEFAULT '0',
  `content` int(11) NOT NULL,
  PRIMARY KEY (`content`),
  KEY `up` (`up`),
  KEY `down` (`down`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


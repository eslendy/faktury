/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

/*Table structure for table `comments` */

DROP TABLE IF EXISTS `comments`;

CREATE TABLE `comments` (
  `userid` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `comment` text NOT NULL,
  `content` int(11) NOT NULL DEFAULT '0',
  `timestamp` varchar(255) NOT NULL DEFAULT '',
  `ip` varchar(255) NOT NULL DEFAULT '',
  `record_num` int(11) NOT NULL AUTO_INCREMENT,
  UNIQUE KEY `record_num` (`record_num`),
  KEY `content` (`content`,`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `comments` */

/*Table structure for table `content` */

DROP TABLE IF EXISTS `content`;

CREATE TABLE `content` (
  `title` varchar(255) NOT NULL DEFAULT '',
  `filename` varchar(255) NOT NULL DEFAULT '',
  `orig_filename` varchar(255) NOT NULL,
  `trailer_filename` varchar(255) NOT NULL,
  `thumbnail` varchar(255) NOT NULL DEFAULT '',
  `embed` text NOT NULL,
  `description` text NOT NULL,
  `paysite` int(11) NOT NULL DEFAULT '0',
  `keywords` varchar(255) NOT NULL,
  `pornstars` varchar(255) NULL,
  `scheduled_date` date NOT NULL DEFAULT '0000-00-00',
  `date_added` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `encoded_date` datetime NOT NULL,
  `rating` varchar(5) NOT NULL DEFAULT '0',
  `length` int(11) NOT NULL DEFAULT '0',
  `submitter` int(11) NOT NULL DEFAULT '0',
  `ip` varchar(15) NOT NULL,
  `approved` int(11) NOT NULL DEFAULT '0',
  `hotlinked` varchar(1024) NOT NULL,
  `plug_url` varchar(255) NOT NULL,
  `enabled` int(11) NOT NULL DEFAULT '0',
  `main_thumb` int(11) NOT NULL DEFAULT '3',
  `xml` varchar(32) NOT NULL,
  `photos` int(11) NOT NULL DEFAULT '0',
  `mobile` varchar(255) NOT NULL,
  `pornstartmp` varchar(255) NOT NULL,
  `movie_width` int(11) NOT NULL,
  `movie_height` int(11) NOT NULL,
  `record_num` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`record_num`),
  KEY `encoded_date` (`encoded_date`,`photos`,`enabled`),
  KEY `filename` (`filename`),
  KEY `scheduled_date` (`scheduled_date`),
  KEY `enabled_2` (`enabled`,`length`,`photos`),
  KEY `enabled` (`enabled`,`encoded_date`,`photos`),
  KEY `rating` (`rating`,`enabled`,`photos`),
  FULLTEXT KEY `keywords` (`keywords`,`title`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `content` */

/*Table structure for table `content_niches` */

DROP TABLE IF EXISTS `content_niches`;

CREATE TABLE `content_niches` (
  `content` int(11) NOT NULL DEFAULT '0',
  `niche` int(11) NOT NULL DEFAULT '0',
  KEY `content` (`content`,`niche`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `content_niches` */


/*Table structure for table `content_pornstars` */

DROP TABLE IF EXISTS `content_pornstars`;

CREATE TABLE `content_pornstars` (
  `content` int(11) NOT NULL,
  `pornstar` int(11) NOT NULL,
  KEY `content` (`content`,`pornstar`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `content_pornstars` */

/*Table structure for table `content_views` */

DROP TABLE IF EXISTS `content_views`;

CREATE TABLE `content_views` (
  `views` int(11) NOT NULL,
  `content` int(11) NOT NULL,
  PRIMARY KEY (`content`),
  KEY `views` (`views`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `content_views` */

/*Table structure for table `countries` */

DROP TABLE IF EXISTS `countries`;

CREATE TABLE `countries` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `value` varchar(250) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Table structure for table `csv_import` */

DROP TABLE IF EXISTS `csv_import`;

CREATE TABLE `csv_import` (
  `title` varchar(255) NOT NULL,
  `flv` varchar(1024) NOT NULL,
  `local` varchar(255) NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `desc` text NOT NULL,
  `embed` text NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `lengthsec` int(11) NOT NULL,
  `paysite` varchar(255) NOT NULL,
  `default_paysite` int(11) NOT NULL,
  `hotlink` int(11) NOT NULL,
  `submitter` int(11) NOT NULL,
  `pornstars` varchar(255) NOT NULL,
  `plugurl` varchar(255) NOT NULL,
  `record_num` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`record_num`),
  UNIQUE KEY `record_num` (`record_num`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `csv_import` */

/*Table structure for table `favorites` */

DROP TABLE IF EXISTS `favorites`;

CREATE TABLE `favorites` (
  `user` int(11) NOT NULL DEFAULT '0',
  `content` int(11) NOT NULL DEFAULT '0',
  `record_num` int(11) NOT NULL AUTO_INCREMENT,
  UNIQUE KEY `record_num` (`record_num`),
  KEY `user` (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `favorites` */

/*Table structure for table `images` */

DROP TABLE IF EXISTS `images`;

CREATE TABLE `images` (
  `title` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `gallery` int(11) NOT NULL,
  `record_num` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`record_num`),
  KEY `gallery` (`gallery`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `images` */

/*Table structure for table `keywords` */

DROP TABLE IF EXISTS `keywords`;

CREATE TABLE `keywords` (
  `word` varchar(64) NOT NULL,
  `amount` int(11) NOT NULL,
  KEY `word` (`word`),
  KEY `amount` (`amount`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `keywords` */

/*Table structure for table `mail` */

DROP TABLE IF EXISTS `mail`;

CREATE TABLE `mail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from` varchar(64) NOT NULL,
  `to` varchar(64) NOT NULL,
  `subject` varchar(256) NOT NULL,
  `date` date NOT NULL,
  `text` text NOT NULL,
  `read` char(1) NOT NULL DEFAULT 'N',
  `trash` char(1) NOT NULL DEFAULT 'N',
  `trash_a` char(1) NOT NULL DEFAULT 'N',
  `display` char(1) NOT NULL DEFAULT 'Y',
  `display_a` varchar(1) NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`id`),
  KEY `from` (`from`,`to`,`date`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `mail` */

/*Table structure for table `niches` */

DROP TABLE IF EXISTS `niches`;

CREATE TABLE `niches` (
  `name` varchar(255) NOT NULL DEFAULT '',
  `ad0` text NOT NULL,
  `ad1` text NOT NULL,
  `ad2` text NOT NULL,
  `ad3` text NOT NULL,
  `ad4` text NOT NULL,
  `ad5` text NOT NULL,
  `ad6` text NOT NULL,
  `ad7` text NOT NULL,
  `ad8` text NOT NULL,
  `ad9` text NOT NULL,
  `postroll` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `enabled` int(11) NOT NULL DEFAULT '1',
  `description` text NOT NULL,
  `metakw` varchar(255) NOT NULL,
  `metadesc` varchar(255) NOT NULL,
  `csv_match` varchar(255) NOT NULL,
  `record_num` int(11) NOT NULL AUTO_INCREMENT,
  UNIQUE KEY `record_num` (`record_num`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `niches` */

/*Table structure for table `paysites` */

DROP TABLE IF EXISTS `paysites`;

CREATE TABLE `paysites` (
  `name` varchar(255) NOT NULL DEFAULT '',
  `url` varchar(255) NOT NULL DEFAULT '',
  `user` int(11) NOT NULL DEFAULT '0',
  `ad0` text NOT NULL,
  `ad1` text NOT NULL,
  `ad2` text NOT NULL,
  `ad3` text NOT NULL,
  `ad4` text NOT NULL,
  `ad5` text NOT NULL,
  `ad6` text NOT NULL,
  `ad7` text NOT NULL,
  `ad8` text NOT NULL,
  `ad9` text NOT NULL,
  `inline_xml_url` varchar(255) NOT NULL,
  `pre_xml_url` varchar(255) NOT NULL,
  `pause_xml_url` varchar(255) NOT NULL,
  `post_xml_url` varchar(255) NOT NULL,
  `postroll` varchar(255) NOT NULL DEFAULT '',
  `enabled` int(11) NOT NULL DEFAULT '1',
  `belowplayertext` varchar(255) NOT NULL DEFAULT '',
  `record_num` int(11) NOT NULL AUTO_INCREMENT,
  UNIQUE KEY `record_num` (`record_num`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `paysites` */

/*Table structure for table `pornstar_comments` */

DROP TABLE IF EXISTS `pornstar_comments`;

CREATE TABLE `pornstar_comments` (
  `userid` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `comment` text NOT NULL,
  `pornstar` int(11) NOT NULL DEFAULT '0',
  `timestamp` varchar(255) NOT NULL DEFAULT '',
  `ip` varchar(255) NOT NULL DEFAULT '',
  `record_num` int(11) NOT NULL AUTO_INCREMENT,
  UNIQUE KEY `record_num` (`record_num`),
  KEY `pornstar` (`pornstar`,`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pornstar_comments` */

/*Table structure for table `pornstar_ratings` */

DROP TABLE IF EXISTS `pornstar_ratings`;

CREATE TABLE `pornstar_ratings` (
  `id` varchar(11) NOT NULL DEFAULT '',
  `total_votes` int(11) NOT NULL DEFAULT '0',
  `total_value` int(11) NOT NULL DEFAULT '0',
  `used_ips` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pornstar_ratings` */

/*Table structure for table `pornstars` */

DROP TABLE IF EXISTS `pornstars`;

CREATE TABLE `pornstars` (
  `name` varchar(255) NOT NULL,
  `aka` varchar(255) NOT NULL,
  `dob` varchar(255) NOT NULL,
  `height` varchar(255) NOT NULL,
  `weight` varchar(255) NOT NULL,
  `measurements` varchar(255) NOT NULL,
  `hair` varchar(255) NOT NULL,
  `eyes` varchar(255) NOT NULL,
  `ethnicity` varchar(255) NOT NULL,
  `official_site_name` varchar(255) NOT NULL,
  `official_site_url` varchar(255) NOT NULL,
  `biography` text NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `rating` varchar(5) NOT NULL,
  `rank` int(11) NOT NULL,
  `views` int(11) NOT NULL,
  `custom` text NOT NULL,
  `record_num` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`record_num`),
  KEY `rank` (`rank`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `pornstars` */

/*Table structure for table `profile_comments` */

DROP TABLE IF EXISTS `profile_comments`;

CREATE TABLE `profile_comments` (
  `userid` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL DEFAULT '',
  `comment` text NOT NULL,
  `profile` int(11) NOT NULL DEFAULT '0',
  `timestamp` varchar(255) NOT NULL DEFAULT '',
  `ip` varchar(255) NOT NULL DEFAULT '',
  `record_num` int(11) NOT NULL AUTO_INCREMENT,
  UNIQUE KEY `record_num` (`record_num`),
  KEY `profile` (`profile`,`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `profile_comments` */

/*Table structure for table `ratings` */

DROP TABLE IF EXISTS `ratings`;

CREATE TABLE `ratings` (
  `id` varchar(11) NOT NULL DEFAULT '',
  `total_votes` int(11) NOT NULL DEFAULT '0',
  `total_value` int(11) NOT NULL DEFAULT '0',
  `used_ips` longtext,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `ratings` */


/*Table structure for table `reported_comments` */

DROP TABLE IF EXISTS `reported_comments`;

CREATE TABLE `reported_comments` (
  `comment` int(11) NOT NULL DEFAULT '0',
  `record_num` int(11) NOT NULL AUTO_INCREMENT,
  `ip` varchar(255) NOT NULL DEFAULT '',
  UNIQUE KEY `record_num` (`record_num`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `reported_comments` */

/*Table structure for table `reported_content` */

DROP TABLE IF EXISTS `reported_content`;

CREATE TABLE `reported_content` (
  `content` int(11) NOT NULL DEFAULT '0',
  `ip` varchar(255) NOT NULL DEFAULT '',
  `reason` varchar(255) NOT NULL DEFAULT '',
  `record_num` int(11) NOT NULL AUTO_INCREMENT,
  UNIQUE KEY `record_num` (`record_num`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `reported_content` */

/*Table structure for table `rss_feed` */

DROP TABLE IF EXISTS `rss_feed`;

CREATE TABLE `rss_feed` (
  `name` varchar(255) NOT NULL,
  `feed` text NOT NULL,
  `top` text NOT NULL,
  `bottom` text NOT NULL,
  `record_num` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`record_num`),
  UNIQUE KEY `record_num` (`record_num`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Table structure for table `scraper_import` */

DROP TABLE IF EXISTS `scraper_import`;

CREATE TABLE `scraper_import` (
  `url` varchar(255) NOT NULL,
  `user` int(11) NOT NULL,
  `paysite` int(11) NOT NULL,
  `record_num` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`record_num`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `scraper_import` */

/*Table structure for table `static` */

DROP TABLE IF EXISTS `static`;

CREATE TABLE `static` (
  `filename` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `headertitle` varchar(255) NOT NULL,
  `metakw` varchar(255) NOT NULL,
  `metadesc` text NOT NULL,
  `body` text NOT NULL,
  `record_num` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`record_num`),
  UNIQUE KEY `record_num` (`record_num`),
  KEY `filename` (`filename`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


/*Table structure for table `status` */

DROP TABLE IF EXISTS `status`;

CREATE TABLE `status` (
  `scraper_running` int(11) NOT NULL,
  `encoder_running` int(11) NOT NULL,
  `encoder_done` int(11) NOT NULL,
  `encoder_total` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


/*Table structure for table `subscriptions` */

DROP TABLE IF EXISTS `subscriptions`;

CREATE TABLE `subscriptions` (
  `user` int(11) NOT NULL,
  `friend` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `subscriptions` */

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `username` varchar(255) NOT NULL DEFAULT '',
  `password` varchar(255) NOT NULL DEFAULT '',
  `email` varchar(255) NOT NULL DEFAULT '',
  `last_ip` varchar(255) NOT NULL DEFAULT '',
  `user_level` int(11) NOT NULL DEFAULT '0',
  `avatar` varchar(255) NOT NULL DEFAULT '',
  `location` varchar(50) NOT NULL DEFAULT '',
  `age` int(11) NOT NULL DEFAULT '0',
  `gender` varchar(255) NOT NULL DEFAULT '',
  `date_joined` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `description` text NOT NULL,
  `name` varchar(255) NOT NULL DEFAULT '',
  `phone` varchar(255) NOT NULL DEFAULT '',
  `im` varchar(255) NOT NULL DEFAULT '',
  `im_type` varchar(255) NOT NULL DEFAULT '',
  `program_name` varchar(255) NOT NULL DEFAULT '',
  `program_url` varchar(255) NOT NULL DEFAULT '',
  `freeform` varchar(255) NOT NULL DEFAULT '',
  `enabled` int(11) NOT NULL DEFAULT '1',
  `country` varchar(255) NOT NULL DEFAULT '',
  `lastlogin` varchar(255) NOT NULL DEFAULT '',
  `validate` varchar(255) NOT NULL,
  `backlink` varchar(255) NOT NULL,
  `banner` varchar(255) NOT NULL,
  `premium` int(11) NOT NULL,
  `tokens` int(11) NOT NULL,
  `custom` text NOT NULL,
  `facebook_id` int(11) NOT NULL,
  `twitter_id` int(11) NOT NULL,
  `record_num` int(11) NOT NULL AUTO_INCREMENT,
  UNIQUE KEY `record_num` (`record_num`),
  KEY `username` (`username`,`password`,`validate`),
  KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `users` */

/*Table structure for table `xml_feeds` */

DROP TABLE IF EXISTS `xml_feeds`;

CREATE TABLE `xml_feeds` (
  `name` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `hotlink` int(11) NOT NULL,
  `record_num` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`record_num`),
  UNIQUE KEY `record_num` (`record_num`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `xml_feeds` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

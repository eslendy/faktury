/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

/*Data for the table `users` */
insert  into `users`(`username`,`password`,`email`,`last_ip`,`user_level`,`avatar`,`location`,`age`,`gender`,`date_joined`,`description`,`name`,`phone`,`im`,`im_type`,`program_name`,`program_url`,`freeform`,`enabled`,`country`,`lastlogin`,`validate`,`backlink`,`banner`,`premium`,`tokens`,`custom`,`facebook_id`,`twitter_id`,`record_num`) values ('testuser','e10adc3949ba59abbe56e057f20f883e','testuser@localhost.test','127.0.0.1',0,'','',0,'','2013-03-07 01:20:46','','','','','','','','',1,'','1363064234','','','',0,0,'',0,0,1);

/* Data for the table `users` (affiliates) */
insert into `users` (`username`, `password`, `email`, `contactIcq`, `contactGtalk`, `contactSkype`, `contactMsnLive`, `isAffiliate`, `last_ip`, `record_num`) values ('phpunit', 'e10adc3949ba59abbe56e057f20f883e', 'phpunit@xng.bz', '3253453454', 'phpunit@gmail.com', '46456456', 'phpunit@hotmail.com', 1, '127.0.0.1', 2);

/*Data for the table `niches` */
INSERT INTO `niches` (`name`, `ad0`, `ad1`, `ad2`, `ad3`, `ad4`, `ad5`, `ad6`, `ad7`, `ad8`, `ad9`, `postroll`, `url`, `enabled`, `description`, `metakw`, `metadesc`, `csv_match`, `record_num`) VALUES ('Amateurs', '', '', '', '', '', '', '', '', '', '', '', 'amateurs', 1, '', '', '', '', 1),('Asians', '', '', '', '', '', '', '', '', '', '', '', 'asians', 1, '', '', '', '', 2),('Asses', '', '', '', '', '', '', '', '', '', '', '', 'asses', 1, '', '', '', '', 3),('Big Tits', '', '', '', '', '', '', '', '', '', '', '', 'bigtits', 1, '', '', '', '', 4),('Blowjobs', '', '', '', '', '', '', '', '', '', '', '', 'blowjobs', 1, '', '', '', '', 5),('Celebrity', '', '', '', '', '', '', '', '', '', '', '', 'celebrity', 1, '', '', '', '', 6),('Chubby Girls', '', '', '', '', '', '', '', '', '', '', '', 'chubby-girls', 1, '', '', '', '', 7),('College Girls', '', '', '', '', '', '', '', '', '', '', '', 'college-girls', 1, '', '', '', '', 8),('Drunk Girls', '', '', '', '', '', '', '', '', '', '', '', 'drunk-girls', 1, '', '', '', '', 9),('Cumshots', '', '', '', '', '', '', '', '', '', '', '', 'cumshots', 1, '', '', '', '', 10),('Ebony / Black', '', '', '', '', '', '', '', '', '', '', '', 'ebony', 1, '', '', '', '', 11),('Emo', '', '', '', '', '', '', '', '', '', '', '', 'emo', 1, '', '', '', '', 12),('Girlfriends', '', '', '', '', '', '', '', '', '', '', '', 'girlfriends', 1, '', '', '', '', 13),('Group Sex', '', '', '', '', '', '', '', '', '', '', '', 'group-sex', 1, '', '', '', '', 14),('Hentai', '', '', '', '', '', '', '', '', '', '', '', 'hentai', 1, '', '', '', '', 15),('Indian', '', '', '', '', '', '', '', '', '', '', '', 'indian', 1, '', '', '', '', 16),('Interracial', '', '', '', '', '', '', '', '', '', '', '', 'interracial', 1, '', '', '', '', 17),('Latina', '', '', '', '', '', '', '', '', '', '', '', 'latina', 1, '', '', '', '', 18),('Lesbians', '', '', '', '', '', '', '', '', '', '', '', 'lesbians', 1, '', '', '', '', 19),('MILF', '', '', '', '', '', '', '', '', '', '', '', 'milf', 1, '', '', '', '', 20),('Mirrors', '', '', '', '', '', '', '', '', '', '', '', 'mirrors', 1, '', '', '', '', 21),('Old People', '', '', '', '', '', '', '', '', '', '', '', 'old-people', 1, '', '', '', '', 22),('Out in Public', '', '', '', '', '', '', '', '', '', '', '', 'out-in-public', 1, '', '', '', '', 23),('Party', '', '', '', '', '', '', '', '', '', '', '', 'party', 1, '', '', '', '', 24),('POV', '', '', '', '', '', '', '', '', '', '', '', 'pov', 1, '', '', '', '', 25),('Self Shot', '', '', '', '', '', '', '', '', '', '', '', 'self-shot', 1, '', '', '', '', 26),('Shemale', '', '', '', '', '', '', '', '', '', '', '', 'shemale', 1, '', '', '', '', 27),('Teens', '', '', '', '', '', '', '', '', '', '', '', 'teens', 1, '', '', '', '', 28),('Voyeur', '', '', '', '', '', '', '', '', '', '', '', 'voyeur', 1, '', '', '', '', 29),('Wives', '', '', '', '', '', '', '', '', '', '', '', 'wives', 1, '', '', '', '', 30);

/*Data for the table `galleries` */
insert  into `galleries`(`gallery_id`,`galleryName`,`galleryDescription`,`galleryFolder`,`photosCount`,`user_id`,`uploadDate`,`ip`) values 
    (1,'Kayden Kross','Kayden Kross is a hot blonde teen star','kk/ts',22,1,'2013-03-14 07:01:47',2130706433),
    (2,'Ariel','Ariel is a beautiful redhead','aa/pf',2,1,'2013-03-14 07:01:47',2130706433),
    (3,'Aria Giovanni','Aria Giovanni is a popular pornstar','ag/pn',2,1,'2013-03-14 07:01:47',2130706433),
    (4,'Mia Malkova','Mia Malkova is a sexy bomb','mm/av',2,1,'2013-03-14 07:01:47',2130706433),
    (5,'Sandee Westgate','','sw/ee',2,1,'2013-03-14 07:01:47',2130706433);


/*Data for the table `galleries_niches` */
insert  into `galleries_niches`(`gallery_id`,`niche_id`) values (1,3),(1,6);

/*Data for the table `photos` */
insert  into `photos`(`photo_id`,`gallery_id`,`photoTitle`,`filename`,`photoWidth`,`photoHeight`,`user_id`,`uploadDate`,`ip`) values 
(1,1,'Kayden Kross Portrait','kk/ts/kaydenkrossportrait.jpg',509,764,1,'2013-03-14 07:07:49',2130706433),
(2,1,'Kayden Kross Landscape','kk/ts/kaydenkrosslandscape.jpg', 1024, 768, 1,'2013-03-14 07:07:49',2130706433),
(3,2,'Ariel Portrait','aa/pf/arielportrait.jpg',576,864,1,'2013-03-14 07:07:49',2130706433),
(4,2,'Ariel Landscape','aa/pf/ariellandscape.jpg', 1600, 900, 1,'2013-03-14 07:07:49',2130706433),
(5,3,'Aria Giovanni Portrait','ag/pn/ariagiovanniportrait.jpg',600,900,1,'2013-03-14 07:07:49',2130706433),
(6,3,'Aria Giovanni Landscape','ag/pn/ariagiovannilandscape.jpg', 1024, 768, 1,'2013-03-14 07:07:49',2130706433),
(7,4,'Mia Malkova Portrait','mm/av/miamalkovaportrait.jpg',500, 750,1,'2013-03-14 07:07:49',2130706433),
(8,4,'Mia Malkova Landscape','mm/av/miamalkovalandscape.jpg', 798, 482, 1,'2013-03-14 07:07:49',2130706433),
(9,5,'Sandee Westgate Portrait','sw/ee/sandeewestgateportrait.jpg',850,1279,1,'2013-03-14 07:07:49',2130706433),
(10,5,'Sandee Westgate Landscape','sw/ee/sandeewestgatelandscape.jpg', 847, 580, 1,'2013-03-14 07:07:49',2130706433),
(11,1,'','kk/ts/kaydenkross01.jpg',728,1094,1,'2013-03-14 07:07:49',2130706433),
(12,1,'','kk/ts/kaydenkross02.jpg',800,1024,1,'2013-03-14 07:07:49',2130706433),
(13,1,'','kk/ts/kaydenkross03.jpg',1600,900,1,'2013-03-14 07:07:49',2130706433),
(14,1,'','kk/ts/kaydenkross04.jpg',1920,1200,1,'2013-03-14 07:07:49',2130706433),
(15,1,'','kk/ts/kaydenkross05.jpg',1024,768,1,'2013-03-14 07:07:49',2130706433),
(16,1,'','kk/ts/kaydenkross06.jpg',1600,1051,1,'2013-03-14 07:07:49',2130706433),
(17,1,'','kk/ts/kaydenkross07.jpg',1280,854,1,'2013-03-14 07:07:49',2130706433),
(18,1,'','kk/ts/kaydenkross08.jpg',854,1280,1,'2013-03-14 07:07:49',2130706433),
(19,1,'','kk/ts/kaydenkross09.jpg',1280,854,1,'2013-03-14 07:07:49',2130706433),
(20,1,'','kk/ts/kaydenkross10.jpg',854,1280,1,'2013-03-14 07:07:49',2130706433),
(21,1,'','kk/ts/kaydenkross11.jpg',854,1280,1,'2013-03-14 07:07:49',2130706433),
(22,1,'','kk/ts/kaydenkross12.jpg',1280,854,1,'2013-03-14 07:07:49',2130706433),
(23,1,'','kk/ts/kaydenkross13.jpg',1366,768,1,'2013-03-14 07:07:49',2130706433),
(24,1,'','kk/ts/kaydenkross14.jpg',1920,1080,1,'2013-03-14 07:07:49',2130706433),
(25,1,'','kk/ts/kaydenkross15.jpg',1600,900,1,'2013-03-14 07:07:49',2130706433),
(26,1,'','kk/ts/kaydenkross16.jpg',1280,720,1,'2013-03-14 07:07:49',2130706433),
(27,1,'','kk/ts/kaydenkross17.jpg',1600,1067,1,'2013-03-14 07:07:49',2130706433),
(28,1,'','kk/ts/kaydenkross18.jpg',1200,900,1,'2013-03-14 07:07:49',2130706433),
(29,1,'','kk/ts/kaydenkross19.jpg',2555,1600,1,'2013-03-14 07:07:49',2130706433),
(30,1,'','kk/ts/kaydenkross20.jpg',1024,768,1,'2013-03-14 07:07:49',2130706433);

/* Data for the table `affiliates_custodians` */
insert into `affiliates_custodians` (`custodian_id`,`user_id`,`firstname`,`lastname`,`streetAddress`,`state`,`city`,`zip`,`country_id`, `ip`) values ('1','2','Bill','Gates','One Microsoft Wat','WA','Redmond','98052','227', INET_ATON('127.0.0.1')); 

/* Data for the table `affiliates_sites` */
insert into `affiliates_sites` (`site_id`, `sitename`, `webmasterProgramLink`, `trackingLink`, `siteDescription`, `siteBannerType`, `custodian_id`, `user_id`, `ip`) values (1, 'Naked Apples', 'http://www.webmaster-program-link.com', 'http://tracking-link.com', 'Best apples ever!', '2', '1', '2', INET_ATON('127.0.0.1'));



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

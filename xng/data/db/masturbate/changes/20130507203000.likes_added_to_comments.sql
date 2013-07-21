ALTER TABLE `content_comments` ADD COLUMN `likes` INT UNSIGNED DEFAULT 0 NOT NULL AFTER `comments`; 
ALTER TABLE  `users` CHANGE  `affiliateCountry_id`  `affiliateCountry_id` INT( 10 ) UNSIGNED NOT NULL DEFAULT  '227';

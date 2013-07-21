ALTER TABLE `affiliates_sites` ADD COLUMN `submitted_date` DATETIME NOT NULL AFTER `ip`;
ALTER TABLE  `affiliates_sites` ADD  `approved` TINYINT NOT NULL DEFAULT  '0';
ALTER TABLE  `affiliates_sites` ADD  `bannerImage` TEXT CHARACTER SET latin1 COLLATE latin1_general_ci NULL DEFAULT NULL
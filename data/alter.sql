-- Thana 22-Oct-2020
ALTER TABLE `author_details` ADD `deleted` VARCHAR(255) NOT NULL DEFAULT 'no' AFTER `status`;

ALTER TABLE `author_details` ADD `created_by` VARCHAR(255) NULL DEFAULT NULL AFTER `deleted`;

----- V2.0
-- Thana 09-Dec-2020 
ALTER TABLE `author_details` CHANGE `date_published` `date_published` VARCHAR(255) NULL DEFAULT NULL;
ALTER TABLE `author_details` ADD `co_author2` VARCHAR(255) NULL DEFAULT NULL AFTER `co_author`, ADD `co_author3` VARCHAR(255) NULL DEFAULT NULL AFTER `co_author2`, ADD `co_author4` VARCHAR(255) NULL DEFAULT NULL AFTER `co_author3`;
ALTER TABLE `author_details` CHANGE `national_type` `journal_type` VARCHAR(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL;
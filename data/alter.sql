-- Thana 22-Oct-2020
ALTER TABLE `author_details` ADD `deleted` VARCHAR(255) NOT NULL DEFAULT 'no' AFTER `status`;

ALTER TABLE `author_details` ADD `created_by` VARCHAR(255) NULL DEFAULT NULL AFTER `deleted`;
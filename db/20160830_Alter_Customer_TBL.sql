ALTER TABLE `customers` ADD `gcm_id` TEXT NULL AFTER `email`;
ALTER TABLE `user` ADD `show_notification` ENUM("Yes","No") NOT NULL DEFAULT 'No' AFTER `photo`;

ALTER TABLE `shops` ADD `email` varchar(100)  DEFAULT NULL AFTER `photo`;
ALTER TABLE `shops` ADD `enable_email_notification` ENUM("Yes","No") NOT NULL DEFAULT 'No' AFTER `email`;

ALTER TABLE `user` ADD `latitude` VARCHAR(20) NULL AFTER `show_notification`, ADD `longitude` VARCHAR(20) NULL AFTER `latitude`;


ALTER TABLE `order_map_trace` DROP FOREIGN KEY `fk_order_map_trace_order_histories1`;

ALTER TABLE `order_map_trace` DROP `order_histories_id`;

ALTER TABLE `order_map_trace` Add  `user_id` INT(20) NOT NULL;

ALTER TABLE `order_map_trace` ADD FOREIGN KEY (`user_id`) REFERENCES `user`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `order_histories` ADD FOREIGN KEY (`user_id`) REFERENCES `user`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `order_map_trace` CHANGE `Longitude` `Longitude` FLOAT(10,8) NOT NULL DEFAULT '0';
ALTER TABLE `order_map_trace` CHANGE `Latitude` `Latitude` FLOAT(10,8) NOT NULL DEFAULT '0';

ALTER TABLE `user` ADD `live_status` ENUM("On-Line","Off-Line") NOT NULL DEFAULT 'Off-Line' AFTER `longitude`, ADD `work_status` ENUM("Ready","Waiting") NOT NULL DEFAULT 'Waiting' AFTER `live_status`;

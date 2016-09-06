ALTER TABLE `shops` ADD `subscribed_in_delivery` TINYINT(1) NOT NULL DEFAULT '0' AFTER `subscribed`;

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES 
('show_unsubscribe_shop', '2', 'show_unsubscribe_shop', NULL, NULL, '2016-08-22 03:39:07', '2016-08-22 03:40:37');
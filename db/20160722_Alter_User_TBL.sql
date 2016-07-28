ALTER TABLE `user` ADD `shop_id` INT(10) NOT NULL AFTER `id`;

ALTER TABLE `user` ADD `phone` INT(10) NOT NULL AFTER `status`, ADD `user_type` ENUM('SHOP_ADMIN','SHOP_DELIVERY_MAN','CR_ADMIN','CR_DELIVERY_MAN') NOT NULL DEFAULT 'SHOP_ADMIN' AFTER `phone`, ADD `deleted` ENUM('Yes','No') NOT NULL DEFAULT 'No' AFTER `user_type`, ADD `gender` ENUM('Male','Female') NOT NULL DEFAULT 'Male' AFTER `deleted`, ADD `is_fired` ENUM('Yes','No') NOT NULL DEFAULT 'No' AFTER `gender`, ADD `lang` ENUM('Ar','En') NOT NULL DEFAULT 'En' AFTER `is_fired`;

ALTER TABLE `user` ADD `subscribed` ENUM('Yes','No') NOT NULL DEFAULT 'Yes' AFTER `lang`;

ALTER TABLE `user` ADD CONSTRAINT `User_Shop_FK` FOREIGN KEY (`shop_id`) REFERENCES `shops`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;


ALTER TABLE `user` CHANGE `created_at` `created_at` VARCHAR(50) NULL DEFAULT NULL;
ALTER TABLE `user` CHANGE `updated_at` `updated_at` VARCHAR(50) NULL DEFAULT NULL;

ALTER TABLE `user` CHANGE `status` `status` int(2) NULL DEFAULT 10;
ALTER TABLE `user` CHANGE `subscribed` `subscribed` ENUM('Yes','No') CHARACTER SET utf8 COLLATE utf8_unicode_ci NULL DEFAULT 'Yes';

ALTER TABLE `auth_item` CHANGE `created_at` `created_at` VARCHAR(30) NULL DEFAULT NULL;
ALTER TABLE `auth_item` CHANGE `updated_at` `updated_at` VARCHAR(30) NULL DEFAULT NULL;

ALTER TABLE `auth_item_child` ADD `created_at` VARCHAR(50) NULL DEFAULT NULL AFTER `child`, ADD `updated_at` VARCHAR(50) NULL DEFAULT NULL AFTER `created_at`;
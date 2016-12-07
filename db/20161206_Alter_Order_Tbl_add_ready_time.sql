ALTER TABLE `orders` ADD `ready_time` INT(10) NULL AFTER `note`;

ALTER TABLE `order_histories` ADD `ready_time` INT NOT NULL DEFAULT '0' AFTER `order_status`;
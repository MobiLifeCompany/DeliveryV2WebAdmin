ALTER TABLE `orders` ADD `delivery_user_id` INT(10) NULL AFTER `delivery_charge`;

ALTER TABLE `orders` ADD CONSTRAINT `User_orders_FK` FOREIGN KEY (`delivery_user_id`)
REFERENCES `user`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
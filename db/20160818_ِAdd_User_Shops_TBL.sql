CREATE TABLE `user_shops` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `deleted` tinyint(1) DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `user_shops` ADD PRIMARY KEY(`id`);
ALTER TABLE `user_shops` CHANGE `id` `id` INT(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `user_shops` ADD CONSTRAINT `Users_Shop_FK` FOREIGN KEY (`shop_id`) 
REFERENCES `shops`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `user_shops` ADD CONSTRAINT `Shop_Users_FK` FOREIGN KEY (`user_id`) 
REFERENCES `user`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

ALTER TABLE `user` CHANGE `shop_id` `shop_id` INT(10) NULL;


alter table `user` drop foreign key `User_Shop_FK`;
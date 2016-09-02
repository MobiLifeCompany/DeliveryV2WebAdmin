ALTER TABLE `shop_delivery_areas` ADD `delivery_charge` INT(10) default 0 AFTER `deleted`;

ALTER TABLE `shops` ADD `city_id` INT(10) NOT NULL AFTER `business_id`;
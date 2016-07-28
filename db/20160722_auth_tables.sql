call this commnad 
yii migrate --migrationPath=@yii/rbac/migrations


In case of yii2-app-base template, from which I have created my application, there is a config/console.php configuration file 
where the authManager needs to be declared. It is not sufficient to have it in the config/web.php declared only.

'authManager' => [
                           'class' => 'yii\rbac\DbManager',
                           'defaultRoles' => ['guest'],
          ],


ALTER TABLE `auth_assignment` CHANGE `created_at` `created_at` VARCHAR(50) NULL DEFAULT NULL;
---------------------------------------------------------------------------------------------------------------------------
---------------------------------------------------------------------------------------------------------------------------
-------------------------------------------------OR Directly---------------------------------------------------------------
---------------------------------------------------------------------------------------------------------------------------
---------------------------------------------------------------------------------------------------------------------------





drop table if exists `auth_assignment`;
drop table if exists `auth_item_child`;
drop table if exists `auth_item`;
drop table if exists `auth_rule`;

create table `auth_rule`
(
`name` varchar(64) not null,
`data` text,
`created_at` VARCHAR(50) NULL DEFAULT NULL,
`updated_at` VARCHAR(50) NULL DEFAULT NULL,
    primary key (`name`)
) engine InnoDB;

create table `auth_item`
(
`name` varchar(64) not null,
`type` integer not null,
`description` text,
`rule_name` varchar(64),
`data` text,
`created_at` VARCHAR(50) NULL DEFAULT NULL,
`updated_at` VARCHAR(50) NULL DEFAULT NULL,
primary key (`name`),
foreign key (`rule_name`) references `auth_rule` (`name`) on delete set null on update cascade,
key `type` (`type`)
) engine InnoDB;

create table `auth_item_child`
(
`parent` varchar(64) not null,
`child` varchar(64) not null,
primary key (`parent`, `child`),
foreign key (`parent`) references `auth_item` (`name`) on delete cascade on update cascade,
foreign key (`child`) references `auth_item` (`name`) on delete cascade on update cascade
) engine InnoDB;

create table `auth_assignment`
(
`item_name` varchar(64) not null,
`user_id` varchar(64) not null,
`created_at` VARCHAR(50) NULL DEFAULT NULL,
primary key (`item_name`, `user_id`),
foreign key (`item_name`) references `auth_item` (`name`) on delete cascade on update cascade
) engine InnoDB;
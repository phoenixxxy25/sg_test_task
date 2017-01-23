CREATE DATABASE `mcomments`;

CREATE TABLE `mmcomments`.`comments` (
	`id` INT(11) NOT NULL AUTO_INCREMENT ,
	`post_id` INT(11) NOT NULL ,
	`author` VARCHAR(20) NOT NULL ,
	`text` VARCHAR(100) NOT NULL ,
	`rating` INT(11) NOT NULL DEFAULT '0' ,
	PRIMARY KEY (`id`)
	);

CREATE TABLE `mcomments`.`comment_extras` (
	`id` INT(11) NOT NULL AUTO_INCREMENT ,
	`comment_id` INT(11) NOT NULL ,
	`user_id` INT(11) NOT NULL ,
	PRIMARY KEY (`id`)
	);

	
CREATE TABLE `mcomments`.`posts` (
	`id` INT(11) NOT NULL AUTO_INCREMENT ,
	`author` VARCHAR(30) NOT NULL ,
	`text` TEXT NOT NULL ,
	PRIMARY KEY (`id`)
	);
CREATE TABLE `mcomments`.`users` (
	`id` INT(11) NOT NULL AUTO_INCREMENT ,
	`login` VARCHAR(20) NOT NULL ,
	`password` VARCHAR(60) NOT NULL ,
	PRIMARY KEY (`id`)
	);	
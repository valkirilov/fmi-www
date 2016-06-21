CREATE TABLE `fmi-www-local`.`fmi_images` (
	`id` INT NOT NULL AUTO_INCREMENT ,
	`path` TEXT NOT NULL ,
	`width` INT NOT NULL ,
	`height` INT NOT NULL ,
	`created_at` DATETIME NOT NULL ,
	`updated_at` DATETIME NOT NULL ,
	PRIMARY KEY (`id`))
ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci;
CREATE TABLE `fmi-www-local`.`fmi_users` (
    `id` INT NOT NULL AUTO_INCREMENT ,
    `email` VARCHAR(80) NOT NULL ,
    `password` VARCHAR(32) NOT NULL ,
    `created_at` DATETIME NOT NULL ,
    `updated_at` DATETIME NOT NULL ,
    PRIMARY KEY (`id`))
ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_unicode_ci;
CREATE TABLE `Admin_users` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`name` VARCHAR(255) NOT NULL,
	`email` VARCHAR(255) NOT NULL UNIQUE,
	`password` VARCHAR(255) NOT NULL,
	`phone` VARCHAR(15),
	`created_at` TIMESTAMP NOT NULL,
	`updated_at` TIMESTAMP NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `questions` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`question` VARCHAR(255) NOT NULL UNIQUE,
	`type` VARCHAR(255) NOT NULL,
	`created_at` DATETIME NOT NULL,
	`updated_at` DATETIME NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `answers` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`answer` VARCHAR(255) NOT NULL,
	`tamplate_id` INT NOT NULL,
	`user_id` INT NOT NULL,
	`created_at` TIMESTAMP NOT NULL,
	`updated_at` TIMESTAMP NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `templates` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`user_id` INT NOT NULL,
	`question_id` INT NOT NULL,
	`created_at` TIMESTAMP NOT NULL,
	`updated_at` TIMESTAMP NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `Admins` (
	`id` INT NOT NULL AUTO_INCREMENT,
	`permissions` VARCHAR(255) NOT NULL,
	`name` VARCHAR(255) NOT NULL,
	`email` VARCHAR(255) NOT NULL UNIQUE,
	`password` VARCHAR(255) NOT NULL,
	`is_active` BOOLEAN NOT NULL,
	`created_at` TIMESTAMP NOT NULL,
	`updated_at` TIMESTAMP NOT NULL,
	PRIMARY KEY (`id`)
);

ALTER TABLE `answers` ADD CONSTRAINT `answers_fk0` FOREIGN KEY (`tamplate_id`) REFERENCES `templates`(`id`);

ALTER TABLE `answers` ADD CONSTRAINT `answers_fk1` FOREIGN KEY (`user_id`) REFERENCES `Admin_users`(`id`);

ALTER TABLE `templates` ADD CONSTRAINT `templates_fk0` FOREIGN KEY (`user_id`) REFERENCES `Admin_users`(`id`);

ALTER TABLE `templates` ADD CONSTRAINT `templates_fk1` FOREIGN KEY (`question_id`) REFERENCES `questions`(`id`);







CREATE TABLE `Animals`(
`id` BIGINT NOT NULL,
`animal_name` CHAR(255) NOT NULL,
`type_of_food_id` CHAR(255) NOT NULL
);
ALTER TABLE
`Animals` ADD PRIMARY KEY(`id`);
CREATE TABLE `Employee`(
`id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
`name_of_worker` CHAR(255) NOT NULL,
`animal_id` CHAR(255) NOT NULL
);
CREATE TABLE `Food`(
`id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY,
`type_of_food` CHAR(255) NOT NULL
);
ALTER TABLE
`Animals` ADD CONSTRAINT `animals_type_of_food_id_foreign` FOREIGN KEY(`type_of_food_id`) REFERENCES `Food`(`id`);
ALTER TABLE
`Employee` ADD CONSTRAINT `employee_animal_id_foreign` FOREIGN KEY(`animal_id`) REFERENCES `Animals`(`id`);

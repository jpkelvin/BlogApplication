CREATE DATABASE blog;
USE blog;


CREATE TABLE `blog`.`users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `admin` TINYINT(6) NULL,
  `username` VARCHAR(255) NULL,
  `email` VARCHAR(255) NULL,
  `password` VARCHAR(255) NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email_UNIQUE` (`email` ASC) VISIBLE);




CREATE TABLE `blog`.`topics` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NULL,
  `description` TEXT(150) NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC) VISIBLE);



  CREATE TABLE `blog`.`posts` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `user_id` INT(11) NULL,
    `title` VARCHAR(255) NULL,
    `image` VARCHAR(255) NULL,
    `body` TEXT NULL,
    `published` TINYINT NULL,
    `created_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`));

    ALTER TABLE `blog`.`posts`
    ADD COLUMN `topic_id` INT(11) NULL AFTER `user_id`;

    ALTER TABLE `blog`.`posts`
      ADD INDEX `topic_id_idx` (`topic_id` ASC) VISIBLE;
      ;
      ALTER TABLE `blog`.`posts`
      ADD CONSTRAINT `topic_id`
        FOREIGN KEY (`topic_id`)
        REFERENCES `blog`.`topics` (`id`)
        ON DELETE SET NULL
        ON UPDATE CASCADE;


        CREATE TABLE `blog`.`comments` (
      `id` INT(11) NOT NULL AUTO_INCREMENT,
      `user_id` INT(11)  NULL,
      `post_id` INT(11)  NULL,
      `comment` VARCHAR(255)  NULL,
      `created_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
      PRIMARY KEY (`id`, `user_id`, `post_id`),
      INDEX `user_id_idx` (`user_id` ASC) VISIBLE,
      INDEX `post_id_idx` (`post_id` ASC) VISIBLE,
      CONSTRAINT `user_id`
        FOREIGN KEY (`user_id`)
        REFERENCES `blog`.`users` (`id`)
        ON DELETE NO ACTION
        ON UPDATE NO ACTION,
      CONSTRAINT `post_id`
        FOREIGN KEY (`post_id`)
        REFERENCES `blog`.`posts` (`id`)
        ON DELETE CASCADE
        ON UPDATE CASCADE);


        CREATE TABLE `blog`.`rating` (
        `user_id` INT(11) NOT NULL,
        `post_id` INT(11) NOT NULL,
        `rating` TINYINT NOT NULL,
        PRIMARY KEY (`user_id`, `post_id`),
        INDEX `post_id_idx` (`post_id` ASC) VISIBLE,
        CONSTRAINT `user`
          FOREIGN KEY (`user_id`)
          REFERENCES `blog`.`users` (`id`)
          ON DELETE NO ACTION
          ON UPDATE NO ACTION,
        CONSTRAINT `post`
          FOREIGN KEY (`post_id`)
          REFERENCES `blog`.`posts` (`id`)
          ON DELETE NO ACTION
          ON UPDATE NO ACTION);


          ALTER TABLE `blog`.`rating`
          DROP FOREIGN KEY `post`;
          ALTER TABLE `blog`.`rating`
          ADD CONSTRAINT `post`
            FOREIGN KEY (`post_id`)
            REFERENCES `blog`.`posts` (`id`)
            ON DELETE CASCADE
            ON UPDATE NO ACTION;

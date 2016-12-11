-- Luan Einhardt <ldseinhardt@gmail.com>
-- mysql > source agenda.sql

-- CUIDADO !!! Será deletado a base de dados abaixo caso exista e criado novamente a estrutura base
DROP DATABASE IF EXISTS `agenda`;

CREATE DATABASE `agenda`;

USE `agenda`;

SET FOREIGN_KEY_CHECKS = 0;
SET TIME_ZONE='+00:00';
SET NAMES utf8;
SET character_set_client = utf8;

-- -----------------------------------------------------
-- Table `organizations`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `organizations` (
  `id`               INT          NOT NULL AUTO_INCREMENT,
  `name`             VARCHAR(128) NOT NULL,
  `phone`            VARCHAR(16)  NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET=utf8;

-- -----------------------------------------------------
-- Table `emails`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `emails` (
  `contact_id`       INT          NOT NULL,
  `id`               INT          NOT NULL,
  `email`            VARCHAR(256) NOT NULL,
  PRIMARY KEY (`contact_id`, `id`),
  FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`)
) ENGINE = InnoDB DEFAULT CHARSET=utf8;

-- -----------------------------------------------------
-- Table `phone_types`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `phone_types` (
  `id`               INT          NOT NULL AUTO_INCREMENT,
  `label`            VARCHAR(16)  NOT NULL UNIQUE,
  PRIMARY KEY (`id`)
) ENGINE = InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `phone_types` (`id`, `label`) VALUES
  (1, 'Residencial'),
  (2, 'Celular'),
  (3, 'Trabalho');

-- -----------------------------------------------------
-- Table `phones`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `phones` (
  `contact_id`       INT          NOT NULL,
  `id`               INT          NOT NULL,
  `type_id`          INT          NOT NULL,
  `phone`            VARCHAR(16)  NOT NULL,
  PRIMARY KEY (`contact_id`, `id`),
  FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`),
  FOREIGN KEY (`type_id`) REFERENCES `phone_types` (`id`)
) ENGINE = InnoDB DEFAULT CHARSET=utf8;

-- -----------------------------------------------------
-- Table `contacts`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `contacts` (
  `id`               INT          NOT NULL AUTO_INCREMENT,
  `first_name`       VARCHAR(16)  DEFAULT '',
  `last_name`        VARCHAR(32)  DEFAULT '',
  `primary_email_id` INT          NULL,
  `primary_phone_id` INT          NULL,
  `organization_id`  INT          NULL,
  `created`          TIMESTAMP    NULL,
  `modified`         TIMESTAMP    NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  FOREIGN KEY (`id`, `primary_email_id`) REFERENCES `emails` (`contact_id`, `id`),
  FOREIGN KEY (`id`, `primary_phone_id`) REFERENCES `phones` (`contact_id`, `id`),
  FOREIGN KEY (`organization_id`) REFERENCES `organizations` (`id`)
) ENGINE = InnoDB DEFAULT CHARSET=utf8;

-- -----------------------------------------------------
-- Table `address`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `address` (
  `contact_id`       INT          NOT NULL,
  `address`          VARCHAR(256) DEFAULT '',
  `zip_code`         VARCHAR(16)  DEFAULT '',
  `district`         VARCHAR(64)  DEFAULT '',
  `city`             VARCHAR(64)  DEFAULT '',
  PRIMARY KEY (`contact_id`),
  FOREIGN KEY (`contact_id`) REFERENCES `contacts` (`id`)
) ENGINE = InnoDB DEFAULT CHARSET=utf8;

SET FOREIGN_KEY_CHECKS = 1;

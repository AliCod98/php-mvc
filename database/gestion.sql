-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema gestion
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema gestion
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `gestion` DEFAULT CHARACTER SET utf8 ;
USE `gestion` ;

-- -----------------------------------------------------
-- Table `gestion`.`comptes`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestion`.`comptes` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `email` VARCHAR(45) NOT NULL,
  `password` VARCHAR(105) NOT NULL,
  `role` VARCHAR(45) NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `email_UNIQUE`(`email` ASC))
ENGINE = InnoDB;

-- Insert to table comptes
iNSERT INTO `comptes` (`id`, `name`, `email`, `password`, `role`, `created_at`) VALUES
(2, 'admin', 'admin@gmail.com', '$2y$12$fK7tw6bInmnumd8XzY2C.eRy9KHo7fyW0V2B1LqPLNgSOk9Lcgxx2', 'admin', '2019-08-14 04:36:55'),
(1, 'student', 'student@gmail.com', '$2y$12$fK7tw6bInmnumd8XzY2C.eRy9KHo7fyW0V2B1LqPLNgSOk9Lcgxx2.', 'student', '2019-08-12 16:01:21');


-- -----------------------------------------------------
-- Table `gestion`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestion`.`users` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nom` VARCHAR(45) NULL,
  `prenom` VARCHAR(45) NULL,
  `age` INT NULL,
  `compte_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_user_comptes_idx` (`compte_id` ASC),
  CONSTRAINT `fk_user_comptes`
    FOREIGN KEY (`compte_id`)
    REFERENCES `gestion`.`comptes` (`id`)
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;

-- Insert to table users
iNSERT INTO `users` (`id`, `nom`, `prenom`, `age`, `compte_id`) VALUES
(2, 'med', 'med', '27', 1),
(1, 'ali', 'ali', '18', 2);





-- -----------------------------------------------------
-- Table `gestion`.`formations`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestion`.`formations` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `designation` VARCHAR(45) NULL,
  `prix` FLOAT NULL,
  `nombre_module` INT NULL,
  `description` TEXT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `gestion`.`inscriptions`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `gestion`.`inscriptions` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `frais` FLOAT NOT NULL,
  -- `totale_paye` FLOAT NOT NULL,
  -- `totale_reste` FLOAT NOT NULL,
  `prix` FLOAT NOT NULL,
  `information` TEXT NULL,
  `date_inscription` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `user_id` INT NOT NULL,
  `formation_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_inscriptions_user1_idx` (`user_id` ASC),
  INDEX `fk_inscriptions_formations1_idx` (`formation_id` ASC),
  CONSTRAINT `fk_inscriptions_user1`
    FOREIGN KEY (`user_id`)
    REFERENCES `gestion`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_inscriptions_formations1`
    FOREIGN KEY (`formation_id`)
    REFERENCES `gestion`.`formations` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `green_belt` DEFAULT CHARACTER SET utf8 ;
USE `green_belt` ;

-- -----------------------------------------------------
-- Table `green_belt`.`students`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `green_belt`.`students` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `name` VARCHAR(85) NULL ,
  `created_at` DATETIME NULL ,
  `updated_at` DATETIME NULL ,
  PRIMARY KEY (`id`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `green_belt`.`exams`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `green_belt`.`exams` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `students_id` INT NOT NULL ,
  `subject` VARCHAR(45) NULL ,
  `grade` INT NULL ,
  `teachers_note` TEXT NULL ,
  `created_at` DATETIME NULL ,
  `updated_at` DATETIME NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_exams_students_idx` (`students_id` ASC) ,
  CONSTRAINT `fk_exams_students`
    FOREIGN KEY (`students_id` )
    REFERENCES `green_belt`.`students` (`id` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

USE `green_belt` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

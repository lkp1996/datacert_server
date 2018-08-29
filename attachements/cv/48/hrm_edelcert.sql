SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`employee`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`employee` (
  `pk_employee` INT NOT NULL ,
  `lastName` VARCHAR(100) NOT NULL ,
  `firstName` VARCHAR(100) NOT NULL ,
  `username` VARCHAR(100) NOT NULL ,
  `password` VARCHAR(100) NOT NULL ,
  `birthDate` INT NULL ,
  `address` VARCHAR(100) NULL ,
  `postCode` VARCHAR(100) NULL ,
  `location` VARCHAR(100) NULL ,
  `avs` VARCHAR(100) NULL ,
  `phone` VARCHAR(100) NULL ,
  `email` VARCHAR(100) NULL ,
  `picture` LONGTEXT NULL ,
  `currentTitle` VARCHAR(100) NULL ,
  `comingToOfficeDate` INT NULL ,
  `currentHourlyWage` VARCHAR(100) NULL ,
  `cv` LONGTEXT NULL ,
  PRIMARY KEY (`pk_employee`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`formationType`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`formationType` (
  `pk_formationType` INT NOT NULL ,
  `formation` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`pk_formationType`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`formation`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`formation` (
  `pk_formation` INT NOT NULL ,
  `formativeOrganization` VARCHAR(100) NOT NULL ,
  `fk_formationType` INT NOT NULL ,
  `EAScope` INT NOT NULL ,
  `fromDate` INT NOT NULL ,
  `toDate` INT NOT NULL ,
  `attachement` LONGTEXT NULL ,
  `fk_employee` INT NOT NULL ,
  PRIMARY KEY (`pk_formation`) ,
  INDEX `fk_formation_formationType_idx` (`fk_formationType` ASC) ,
  INDEX `fk_formation_employee1_idx` (`fk_employee` ASC) ,
  CONSTRAINT `fk_formation_formationType`
    FOREIGN KEY (`fk_formationType` )
    REFERENCES `mydb`.`formationType` (`pk_formationType` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_formation_employee1`
    FOREIGN KEY (`fk_employee` )
    REFERENCES `mydb`.`employee` (`pk_employee` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`professionnalExperience`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`professionnalExperience` (
  `pk_professionnalExperience` INT NOT NULL ,
  `organizationName` VARCHAR(100) NOT NULL ,
  `organizationActivity` VARCHAR(100) NOT NULL ,
  `fonction` VARCHAR(100) NOT NULL ,
  `EAScope` INT NOT NULL ,
  `fromDate` INT NOT NULL ,
  `toDate` INT NOT NULL ,
  `attachement` LONGTEXT NULL ,
  `fk_employee` INT NOT NULL ,
  PRIMARY KEY (`pk_professionnalExperience`) ,
  INDEX `fk_professionnalExperience_employee1_idx` (`fk_employee` ASC) ,
  CONSTRAINT `fk_professionnalExperience_employee1`
    FOREIGN KEY (`fk_employee` )
    REFERENCES `mydb`.`employee` (`pk_employee` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`NMSStandard`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`NMSStandard` (
  `pk_NMSStandard` INT NOT NULL ,
  `name` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`pk_NMSStandard`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`consultingExperience`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`consultingExperience` (
  `pk_consultingExperience` INT NOT NULL ,
  `organizationName` VARCHAR(100) NOT NULL ,
  `organizationActivity` VARCHAR(100) NOT NULL ,
  `fk_NMSStandard` INT NOT NULL ,
  `EAScope` INT NOT NULL ,
  `organization` VARCHAR(100) NOT NULL ,
  `year` VARCHAR(100) NOT NULL ,
  `fk_employee` INT NOT NULL ,
  PRIMARY KEY (`pk_consultingExperience`) ,
  INDEX `fk_consultingExperience_NMSStandard1_idx` (`fk_NMSStandard` ASC) ,
  INDEX `fk_consultingExperience_employee1_idx` (`fk_employee` ASC) ,
  CONSTRAINT `fk_consultingExperience_NMSStandard1`
    FOREIGN KEY (`fk_NMSStandard` )
    REFERENCES `mydb`.`NMSStandard` (`pk_NMSStandard` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_consultingExperience_employee1`
    FOREIGN KEY (`fk_employee` )
    REFERENCES `mydb`.`employee` (`pk_employee` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`auditExperience`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`auditExperience` (
  `pk_auditExperiences` INT NOT NULL ,
  `organizationName` VARCHAR(100) NOT NULL ,
  `organizationActivity` VARCHAR(100) NOT NULL ,
  `fk_NMSStandard` INT NOT NULL ,
  `EAScope` VARCHAR(100) NOT NULL ,
  `oc` VARCHAR(100) NOT NULL ,
  `year` VARCHAR(100) NOT NULL ,
  `attachement` LONGTEXT NULL ,
  `fk_employee` INT NOT NULL ,
  PRIMARY KEY (`pk_auditExperiences`) ,
  INDEX `fk_auditExperience_NMSStandard1_idx` (`fk_NMSStandard` ASC) ,
  INDEX `fk_auditExperience_employee1_idx` (`fk_employee` ASC) ,
  CONSTRAINT `fk_auditExperience_NMSStandard1`
    FOREIGN KEY (`fk_NMSStandard` )
    REFERENCES `mydb`.`NMSStandard` (`pk_NMSStandard` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_auditExperience_employee1`
    FOREIGN KEY (`fk_employee` )
    REFERENCES `mydb`.`employee` (`pk_employee` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`internalQualification`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`internalQualification` (
  `pk_internalQualifications` INT NOT NULL ,
  `process` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`pk_internalQualifications`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`internalQualification_employee`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`internalQualification_employee` (
  `fk_internalQualification` INT NOT NULL ,
  `fk_employee` INT NOT NULL ,
  `yesno` TINYINT NOT NULL ,
  `resutl` VARCHAR(100) NOT NULL ,
  `validationDate` INT NOT NULL ,
  `attachement` LONGTEXT NULL ,
  PRIMARY KEY (`fk_internalQualification`, `fk_employee`) ,
  INDEX `fk_internalQualification_has_employee_employee1_idx` (`fk_employee` ASC) ,
  INDEX `fk_internalQualification_has_employee_internalQualification_idx` (`fk_internalQualification` ASC) ,
  CONSTRAINT `fk_internalQualification_has_employee_internalQualification1`
    FOREIGN KEY (`fk_internalQualification` )
    REFERENCES `mydb`.`internalQualification` (`pk_internalQualifications` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_internalQualification_has_employee_employee1`
    FOREIGN KEY (`fk_employee` )
    REFERENCES `mydb`.`employee` (`pk_employee` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`auditObservation`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`auditObservation` (
  `pk_auditObservation` INT NOT NULL ,
  `organization` VARCHAR(100) NOT NULL ,
  `observer` VARCHAR(100) NOT NULL ,
  `EAScope` INT NOT NULL ,
  `comment` LONGTEXT NOT NULL ,
  `date` INT NOT NULL ,
  `fk_employee` INT NOT NULL ,
  PRIMARY KEY (`pk_auditObservation`) ,
  INDEX `fk_auditObservation_employee1_idx` (`fk_employee` ASC) ,
  CONSTRAINT `fk_auditObservation_employee1`
    FOREIGN KEY (`fk_employee` )
    REFERENCES `mydb`.`employee` (`pk_employee` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`objective`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`objective` (
  `pk_objective` INT NOT NULL ,
  `mediumLongTermObjectives` VARCHAR(100) NOT NULL ,
  `auditorStrategy` VARCHAR(100) NOT NULL ,
  `date` INT NOT NULL ,
  `validate` TINYINT NOT NULL ,
  `fk_employee` INT NOT NULL ,
  PRIMARY KEY (`pk_objective`) ,
  INDEX `fk_objective_employee1_idx` (`fk_employee` ASC) ,
  CONSTRAINT `fk_objective_employee1`
    FOREIGN KEY (`fk_employee` )
    REFERENCES `mydb`.`employee` (`pk_employee` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`mandateSheet`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `mydb`.`mandateSheet` (
  `pk_mandateSheet` INT NOT NULL ,
  `organization` VARCHAR(100) NOT NULL ,
  `EAScope` INT NOT NULL ,
  `date` INT NOT NULL ,
  `attachement` LONGTEXT NULL ,
  `fk_employee` INT NOT NULL ,
  PRIMARY KEY (`pk_mandateSheet`) ,
  INDEX `fk_mandateSheet_employee1_idx` (`fk_employee` ASC) ,
  CONSTRAINT `fk_mandateSheet_employee1`
    FOREIGN KEY (`fk_employee` )
    REFERENCES `mydb`.`employee` (`pk_employee` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

USE `mydb` ;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

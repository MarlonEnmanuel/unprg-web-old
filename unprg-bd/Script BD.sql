-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema unprg-web
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema unprg-web
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `unprg-web` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ;
USE `unprg-web` ;

-- -----------------------------------------------------
-- Table `unprg-web`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unprg-web`.`usuario` (
  `idUsuario` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `login` VARCHAR(45) NOT NULL COMMENT '',
  `password` VARCHAR(45) NOT NULL COMMENT '',
  `nombres` VARCHAR(45) NOT NULL COMMENT '',
  `apellidos` VARCHAR(45) NOT NULL COMMENT '',
  `oficina` VARCHAR(45) NOT NULL COMMENT '',
  `fchReg` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '',
  `permisos` TEXT NOT NULL COMMENT '',
  PRIMARY KEY (`idUsuario`)  COMMENT '',
  UNIQUE INDEX `login_UNIQUE` (`login` ASC)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `unprg-web`.`archivo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unprg-web`.`archivo` (
  `idArchivo` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `nombre` VARCHAR(45) NOT NULL COMMENT '',
  `type` VARCHAR(45) NOT NULL COMMENT '',
  `link` TEXT NOT NULL COMMENT '',
  `fchReg` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP COMMENT '',
  PRIMARY KEY (`idArchivo`)  COMMENT '')
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `unprg-web`.`aviso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `unprg-web`.`aviso` (
  `idAviso` INT NOT NULL AUTO_INCREMENT COMMENT '',
  `fchReg` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '',
  `texto` TEXT NOT NULL COMMENT '',
  `emergente` TINYINT(1) NOT NULL DEFAULT 0 COMMENT '',
  `visible` TINYINT(1) NOT NULL DEFAULT 1 COMMENT '',
  `estado` TINYINT(1) NOT NULL DEFAULT 1 COMMENT '',
  `idArchivo` INT NOT NULL COMMENT '',
  `idUsuario` INT NOT NULL COMMENT '',
  PRIMARY KEY (`idAviso`)  COMMENT '',
  INDEX `fk_aviso_archivo_idx` (`idArchivo` ASC)  COMMENT '',
  INDEX `fk_aviso_usuario1_idx` (`idUsuario` ASC)  COMMENT '',
  CONSTRAINT `fk_aviso_archivo`
    FOREIGN KEY (`idArchivo`)
    REFERENCES `unprg-web`.`archivo` (`idArchivo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_aviso_usuario1`
    FOREIGN KEY (`idUsuario`)
    REFERENCES `unprg-web`.`usuario` (`idUsuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `unprg-web`.`usuario`
-- -----------------------------------------------------
START TRANSACTION;
USE `unprg-web`;
INSERT INTO `unprg-web`.`usuario` (`idUsuario`, `login`, `password`, `nombres`, `apellidos`, `oficina`, `fchReg`, `permisos`) VALUES (DEFAULT, 'administrador', '9dbf7c1488382487931d10235fc84a74bff5d2f4', 'admin', 'admin', 'Red Telemática', DEFAULT, 'admin');

COMMIT;


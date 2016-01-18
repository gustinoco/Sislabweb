-- MySQL Script generated by MySQL Workbench
-- 01/12/16 09:15:49
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema sislabweb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema sislabweb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `sislabweb` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `sislabweb` ;

-- -----------------------------------------------------
-- Table `sislabweb`.`CLIENTE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sislabweb`.`CLIENTE` ;

CREATE TABLE IF NOT EXISTS `sislabweb`.`CLIENTE` (
  `Id` INT NULL AUTO_INCREMENT COMMENT 'Código do Cliente',
  `Nome` TEXT NULL COMMENT 'Nome do cliente\n',
  `Cpf` CHAR(14) NULL,
  `Cnpj` CHAR(18) NULL,
  `Fone` TEXT NULL COMMENT 'Numero telefone fixo do cliente\n',
  `Endereco` TEXT NULL COMMENT 'Endereço do cliente\n',
  `Fax` TEXT NULL COMMENT 'Numero de fax do cliente',
  `Celular` TEXT NULL COMMENT 'Numero de telefone do cliente',
  `Email` TEXT NULL COMMENT 'Email do cliente\n',
  `Cep` TEXT NULL COMMENT 'Cep do Cliente\n',
  `Cidade` TEXT NULL COMMENT 'Cidade do cliente\n',
  `Estado` CHAR(2) NULL COMMENT 'Estado de origem do cliente (UF)\n',
  PRIMARY KEY (`Id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sislabweb`.`PESQUISADOR`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sislabweb`.`PESQUISADOR` ;

CREATE TABLE IF NOT EXISTS `sislabweb`.`PESQUISADOR` (
  `Login` VARCHAR(45) NULL,
  `Nome_completo` VARCHAR(100) NULL,
  `Email` VARCHAR(100) NULL,
  `Data_cadastro` DATETIME NULL,
  `Data_ultimo_acesso` DATETIME NULL,
  `Permissao` TINYINT(1) NULL,
  `Senha` VARCHAR(45) NULL,
  `Id` INT NULL,
  PRIMARY KEY (`Login`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sislabweb`.`PROPRIEDADE`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sislabweb`.`PROPRIEDADE` ;

CREATE TABLE IF NOT EXISTS `sislabweb`.`PROPRIEDADE` (
  `Id` INT NOT NULL AUTO_INCREMENT,
  `Nome` VARCHAR(45) NULL,
  `Area` VARCHAR(45) NULL,
  `Localidade` VARCHAR(45) NULL,
  `Municipio` VARCHAR(45) NULL,
  `Estado` VARCHAR(45) NULL,
  `Cliente_id` INT NULL,
  PRIMARY KEY (`Id`),
  INDEX `fk_PROPRIEDADE_CLIENTE1_idx` (`Cliente_id` ASC),
  CONSTRAINT `fk_PROPRIEDADE_CLIENTE1`
    FOREIGN KEY (`Cliente_id`)
    REFERENCES `sislabweb`.`CLIENTE` (`Id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sislabweb`.`BOLETIM_SOLO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sislabweb`.`BOLETIM_SOLO` ;

CREATE TABLE IF NOT EXISTS `sislabweb`.`BOLETIM_SOLO` (
  `Id` INT NOT NULL AUTO_INCREMENT,
  `Id_cliente` INT NULL,
  `Pesquisador` VARCHAR(45) NULL,
  `Propriedade` INT NULL,
  `Pesquisa` TINYINT(1) NULL,
  `Data_entrada` VARCHAR(11) NULL,
  `Valor` FLOAT NULL,
  `Observacao` VARCHAR(45) NULL,
  `Cultura` VARCHAR(20) NULL,
  `Sistema` VARCHAR(30) NULL,
  PRIMARY KEY (`Id`),
  INDEX `fk_BOLETIM_CLIENTE1_idx` (`Id_cliente` ASC),
  INDEX `fk_BOLETIM_SOLO_PESQUISADOR1_idx` (`Pesquisador` ASC),
  INDEX `fk_BOLETIM_SOLO_PROPRIEDADE1_idx` (`Propriedade` ASC),
  CONSTRAINT `fk_BOLETIM_CLIENTE1`
    FOREIGN KEY (`Id_cliente`)
    REFERENCES `sislabweb`.`CLIENTE` (`Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_BOLETIM_SOLO_PESQUISADOR1`
    FOREIGN KEY (`Pesquisador`)
    REFERENCES `sislabweb`.`PESQUISADOR` (`Login`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_BOLETIM_SOLO_PROPRIEDADE1`
    FOREIGN KEY (`Propriedade`)
    REFERENCES `sislabweb`.`PROPRIEDADE` (`Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sislabweb`.`SOLO`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sislabweb`.`SOLO` ;

CREATE TABLE IF NOT EXISTS `sislabweb`.`SOLO` (
  `Id` INT NOT NULL AUTO_INCREMENT,
  `Id_boletim` INT NULL,
  `Pesquisador` VARCHAR(45) NULL,
  `Data_cadastro` TIMESTAMP NULL,
  `Al` VARCHAR(45) NULL,
  `K` VARCHAR(45) NULL,
  `Phcacl2` VARCHAR(45) NULL,
  `Hal3` VARCHAR(45) NULL,
  `Ca` VARCHAR(45) NULL,
  `Mg` VARCHAR(45) NULL,
  `Cu` VARCHAR(45) NULL,
  `Fe` VARCHAR(45) NULL,
  `Mn` VARCHAR(45) NULL,
  `Zn` VARCHAR(45) NULL,
  `B` VARCHAR(45) NULL,
  `Materia_organica` VARCHAR(45) NULL,
  `Argila` VARCHAR(45) NULL,
  `Silte` VARCHAR(45) NULL,
  `Areia` VARCHAR(45) NULL,
  `Pmehl` VARCHAR(45) NULL,
  `Identificao` VARCHAR(45) NULL,
  `Rotina` TINYINT(1) NULL,
  `Mo` TINYINT(1) NULL,
  `Micro` TINYINT(1) NULL,
  `Textura` TINYINT(1) NULL,
  PRIMARY KEY (`Id`),
  INDEX `fk_SOLO_BOLETIM_SOLO1_idx` (`Id_boletim` ASC),
  INDEX `fk_SOLO_PESQUISADOR1_idx` (`Pesquisador` ASC),
  CONSTRAINT `fk_SOLO_BOLETIM_SOLO1`
    FOREIGN KEY (`Id_boletim`)
    REFERENCES `sislabweb`.`BOLETIM_SOLO` (`Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_SOLO_PESQUISADOR1`
    FOREIGN KEY (`Pesquisador`)
    REFERENCES `sislabweb`.`PESQUISADOR` (`Login`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sislabweb`.`BOLETIM_PLANTA`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sislabweb`.`BOLETIM_PLANTA` ;

CREATE TABLE IF NOT EXISTS `sislabweb`.`BOLETIM_PLANTA` (
  `Id` INT NOT NULL AUTO_INCREMENT,
  `Data_entrada` INT NULL,
  `Id_cliente` INT NULL,
  `Propriedade` INT NULL,
  `Pesquisador` VARCHAR(45) NULL,
  `Pesquisa` TINYINT(1) NULL,
  `Cultura` VARCHAR(45) NULL,
  `Observacao` VARCHAR(45) NULL,
  `Valor` DECIMAL(4,2) NULL,
  `Parte` VARCHAR(40) NULL,
  PRIMARY KEY (`Id`),
  INDEX `fk_BOLETIM_PLANTA_CLIENTE1_idx` (`Id_cliente` ASC),
  INDEX `fk_BOLETIM_PLANTA_PESQUISADOR1_idx` (`Pesquisador` ASC),
  INDEX `fk_BOLETIM_PLANTA_PROPRIEDADE1_idx` (`Propriedade` ASC),
  CONSTRAINT `fk_BOLETIM_PLANTA_CLIENTE1`
    FOREIGN KEY (`Id_cliente`)
    REFERENCES `sislabweb`.`CLIENTE` (`Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_BOLETIM_PLANTA_PESQUISADOR1`
    FOREIGN KEY (`Pesquisador`)
    REFERENCES `sislabweb`.`PESQUISADOR` (`Login`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_BOLETIM_PLANTA_PROPRIEDADE1`
    FOREIGN KEY (`Propriedade`)
    REFERENCES `sislabweb`.`PROPRIEDADE` (`Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `sislabweb`.`PLANTA`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `sislabweb`.`PLANTA` ;

CREATE TABLE IF NOT EXISTS `sislabweb`.`PLANTA` (
  `Id` INT NULL AUTO_INCREMENT,
  `Id_boletim` INT NULL,
  `Pesquisador` VARCHAR(45) NULL,
  `Data_cadastro` TIMESTAMP NULL,
  `N` VARCHAR(45) NULL,
  `P` VARCHAR(45) NULL,
  `K` VARCHAR(45) NULL,
  `Ca` VARCHAR(45) NULL,
  `Mg` VARCHAR(45) NULL,
  `S` VARCHAR(45) NULL,
  `Cu` VARCHAR(45) NULL,
  `Fe` VARCHAR(45) NULL,
  `Mn` VARCHAR(45) NULL,
  `Zn` VARCHAR(45) NULL,
  `B` VARCHAR(45) NULL,
  `Identificacao` VARCHAR(45) NULL,
  `Micro` TINYINT(1) NULL,
  `Macro` TINYINT(1) NULL,
  `Somente_n` TINYINT(1) NULL,
  PRIMARY KEY (`Id`),
  INDEX `fk_PLANTA_BOLETIM_PLANTA1_idx` (`Id_boletim` ASC),
  INDEX `fk_PLANTA_PESQUISADOR1_idx` (`Pesquisador` ASC),
  CONSTRAINT `fk_PLANTA_BOLETIM_PLANTA1`
    FOREIGN KEY (`Id_boletim`)
    REFERENCES `sislabweb`.`BOLETIM_PLANTA` (`Id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_PLANTA_PESQUISADOR1`
    FOREIGN KEY (`Pesquisador`)
    REFERENCES `sislabweb`.`PESQUISADOR` (`Login`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

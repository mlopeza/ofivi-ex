SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `SEVI` DEFAULT CHARACTER SET utf8 ;
USE `SEVI` ;

-- -----------------------------------------------------
-- Table `SEVI`.`Campus`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SEVI`.`Campus` ;

CREATE  TABLE IF NOT EXISTS `SEVI`.`Campus` (
  `idCampus` INT NOT NULL AUTO_INCREMENT ,
  `Nombre` VARCHAR(45) NOT NULL ,
  `Ciudad` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`idCampus`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SEVI`.`Escuela`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SEVI`.`Escuela` ;

CREATE  TABLE IF NOT EXISTS `SEVI`.`Escuela` (
  `idEscuela` INT NOT NULL ,
  `idCampus` INT NOT NULL ,
  `Nombre` VARCHAR(45) NOT NULL ,
  `Ubicacion` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`idEscuela`, `idCampus`) ,
  INDEX `escuela_campus` (`idCampus` ASC) ,
  CONSTRAINT `escuela_campus`
    FOREIGN KEY (`idCampus` )
    REFERENCES `SEVI`.`Campus` (`idCampus` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SEVI`.`Departamento`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SEVI`.`Departamento` ;

CREATE  TABLE IF NOT EXISTS `SEVI`.`Departamento` (
  `idDepartamento` INT NOT NULL AUTO_INCREMENT ,
  `idEscuela` INT NOT NULL ,
  `nombre` VARCHAR(45) NOT NULL ,
  `ubicacion` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`idDepartamento`, `idEscuela`) ,
  INDEX `Departamento_Escuela` (`idEscuela` ASC) ,
  CONSTRAINT `Departamento_Escuela`
    FOREIGN KEY (`idEscuela` )
    REFERENCES `SEVI`.`Escuela` (`idEscuela` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SEVI`.`Usuario`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SEVI`.`Usuario` ;

CREATE  TABLE IF NOT EXISTS `SEVI`.`Usuario` (
  `idUsuario` INT NOT NULL AUTO_INCREMENT ,
  `idDepartamento` INT NOT NULL ,
  `Nombre` VARCHAR(40) NOT NULL ,
  `ApellidoP` VARCHAR(20) NOT NULL ,
  `ApellidoM` VARCHAR(20) NULL ,
  `email` VARCHAR(45) NOT NULL ,
  `Tipo_Usuario` CHAR NOT NULL DEFAULT 'c' COMMENT 'p - Profesor\na - Administrador\nu - Usuario de extension\nv - Administrador de Extension\nl - Usuario de Legal\nc - Cliente' ,
  `Vista_Profesor` BIT NOT NULL DEFAULT 0 ,
  `Vista_Administrador` BIT NOT NULL DEFAULT 0 ,
  `Vista_Supervisor_Extension` BIT NOT NULL DEFAULT 0 ,
  `Vista_Usuario_Extension` BIT NOT NULL DEFAULT 0 ,
  `Vista_Legal` BIT NOT NULL DEFAULT 0 ,
  `Vista_Cliente` BIT NOT NULL DEFAULT 0 ,
  `Usuario_Activo` BIT NOT NULL DEFAULT 0 ,
  `Usuario_Aceptado` CHAR NOT NULL DEFAULT 'e' ,
  PRIMARY KEY (`idUsuario`, `idDepartamento`) ,
  INDEX `Usuario_Departamento` (`idDepartamento` ASC) ,
  CONSTRAINT `Usuario_Departamento`
    FOREIGN KEY (`idDepartamento` )
    REFERENCES `SEVI`.`Departamento` (`idDepartamento` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SEVI`.`Usuario_Telefono`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SEVI`.`Usuario_Telefono` ;

CREATE  TABLE IF NOT EXISTS `SEVI`.`Usuario_Telefono` (
  `idTelefono` INT NOT NULL AUTO_INCREMENT ,
  `idUsuario` INT NOT NULL ,
  `telefono` VARCHAR(45) NOT NULL ,
  `extension` VARCHAR(45) NULL ,
  `descripcion` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`idTelefono`, `idUsuario`) ,
  INDEX `telefono_usuario` (`idUsuario` ASC) ,
  CONSTRAINT `telefono_usuario`
    FOREIGN KEY (`idUsuario` )
    REFERENCES `SEVI`.`Usuario` (`idUsuario` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SEVI`.`Agenda`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SEVI`.`Agenda` ;

CREATE  TABLE IF NOT EXISTS `SEVI`.`Agenda` (
  `idAgenda` INT NOT NULL AUTO_INCREMENT ,
  `idUsuario` INT NOT NULL ,
  `Inicio` TIMESTAMP NOT NULL DEFAULT now() ,
  `Descripcion` BLOB NULL ,
  `idContacto` INT NULL ,
  `Termino` TIMESTAMP NULL ,
  PRIMARY KEY (`idAgenda`, `idUsuario`) ,
  INDEX `agenda_usuario` (`idUsuario` ASC) ,
  CONSTRAINT `agenda_usuario`
    FOREIGN KEY (`idUsuario` )
    REFERENCES `SEVI`.`Usuario` (`idUsuario` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SEVI`.`Recordatorio`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SEVI`.`Recordatorio` ;

CREATE  TABLE IF NOT EXISTS `SEVI`.`Recordatorio` (
  `idRecordatorio` INT NOT NULL AUTO_INCREMENT ,
  `idAgenda` INT NOT NULL ,
  `inicioRecordatorio` TIMESTAMP NOT NULL ,
  `avisoAceptado` TINYINT(1) NOT NULL ,
  PRIMARY KEY (`idRecordatorio`, `idAgenda`) ,
  INDEX `agenda_recordatorio` (`idAgenda` ASC) ,
  CONSTRAINT `agenda_recordatorio`
    FOREIGN KEY (`idAgenda` )
    REFERENCES `SEVI`.`Agenda` (`idAgenda` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SEVI`.`Proyecto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SEVI`.`Proyecto` ;

CREATE  TABLE IF NOT EXISTS `SEVI`.`Proyecto` (
  `idProyecto` INT NOT NULL ,
  `nombre` VARCHAR(45) NOT NULL ,
  `descripcionUsuario` BLOB NOT NULL ,
  `descripcionAEV` BLOB NOT NULL ,
  `Proyecto_Activo` BIT NOT NULL DEFAULT 1 ,
  PRIMARY KEY (`idProyecto`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SEVI`.`Categoria`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SEVI`.`Categoria` ;

CREATE  TABLE IF NOT EXISTS `SEVI`.`Categoria` (
  `idCategoria` INT NOT NULL AUTO_INCREMENT ,
  `Categoria` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`idCategoria`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SEVI`.`Estado`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SEVI`.`Estado` ;

CREATE  TABLE IF NOT EXISTS `SEVI`.`Estado` (
  `idEstado` INT NOT NULL AUTO_INCREMENT ,
  `idProyecto` INT NOT NULL ,
  `tiempoActualizacion` TIMESTAMP NOT NULL DEFAULT now() ,
  `idUsuario` INT NOT NULL ,
  `estado` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`idEstado`, `idProyecto`, `idUsuario`) ,
  INDEX `Estado_Proyecto` (`idProyecto` ASC) ,
  INDEX `Estado_Usuario` (`idUsuario` ASC) ,
  CONSTRAINT `Estado_Proyecto`
    FOREIGN KEY (`idProyecto` )
    REFERENCES `SEVI`.`Proyecto` (`idProyecto` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `Estado_Usuario`
    FOREIGN KEY (`idUsuario` )
    REFERENCES `SEVI`.`Usuario` (`idUsuario` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SEVI`.`Usuario_Proyecto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SEVI`.`Usuario_Proyecto` ;

CREATE  TABLE IF NOT EXISTS `SEVI`.`Usuario_Proyecto` (
  `idUsuario` INT NOT NULL ,
  `idProyecto` INT NOT NULL ,
  `Responsable` BIT NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`idUsuario`, `idProyecto`) ,
  INDEX `UP_Proyecto` (`idProyecto` ASC) ,
  INDEX `UP_Usuario` (`idUsuario` ASC) ,
  CONSTRAINT `UP_Proyecto`
    FOREIGN KEY (`idProyecto` )
    REFERENCES `SEVI`.`Proyecto` (`idProyecto` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `UP_Usuario`
    FOREIGN KEY (`idUsuario` )
    REFERENCES `SEVI`.`Usuario` (`idUsuario` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SEVI`.`Grupo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SEVI`.`Grupo` ;

CREATE  TABLE IF NOT EXISTS `SEVI`.`Grupo` (
  `idGrupo` INT NOT NULL ,
  `nombre` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`idGrupo`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SEVI`.`Empresa`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SEVI`.`Empresa` ;

CREATE  TABLE IF NOT EXISTS `SEVI`.`Empresa` (
  `idEmpresa` INT NOT NULL ,
  `idGrupo` INT NOT NULL ,
  `nombre` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`idEmpresa`, `idGrupo`) ,
  INDEX `Empresa_Grupo` (`idGrupo` ASC) ,
  CONSTRAINT `Empresa_Grupo`
    FOREIGN KEY (`idGrupo` )
    REFERENCES `SEVI`.`Grupo` (`idGrupo` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SEVI`.`Categoria_Proyecto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SEVI`.`Categoria_Proyecto` ;

CREATE  TABLE IF NOT EXISTS `SEVI`.`Categoria_Proyecto` (
  `idCategoria` INT NOT NULL ,
  `idProyecto` INT NOT NULL ,
  PRIMARY KEY (`idCategoria`, `idProyecto`) ,
  INDEX `CP_Categoria` (`idCategoria` ASC) ,
  INDEX `CP_Proyecto` (`idProyecto` ASC) ,
  CONSTRAINT `CP_Categoria`
    FOREIGN KEY (`idCategoria` )
    REFERENCES `SEVI`.`Categoria` (`idCategoria` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `CP_Proyecto`
    FOREIGN KEY (`idProyecto` )
    REFERENCES `SEVI`.`Proyecto` (`idProyecto` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SEVI`.`Contacto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SEVI`.`Contacto` ;

CREATE  TABLE IF NOT EXISTS `SEVI`.`Contacto` (
  `idContacto` INT NOT NULL AUTO_INCREMENT ,
  `idEmpresa` INT NOT NULL ,
  `Nombre` VARCHAR(40) NOT NULL ,
  `ApellidoP` VARCHAR(20) NOT NULL ,
  `ApellidoM` VARCHAR(20) NULL ,
  `email` VARCHAR(45) NOT NULL ,
  `Contacto_Activo` BIT NOT NULL DEFAULT 0 ,
  `Recibe_Correos` BIT NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`idContacto`, `idEmpresa`) ,
  INDEX `Contacto_Empresa` (`idEmpresa` ASC) ,
  CONSTRAINT `Contacto_Empresa`
    FOREIGN KEY (`idEmpresa` )
    REFERENCES `SEVI`.`Empresa` (`idEmpresa` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SEVI`.`Contacto_Proyecto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SEVI`.`Contacto_Proyecto` ;

CREATE  TABLE IF NOT EXISTS `SEVI`.`Contacto_Proyecto` (
  `idContacto` INT NOT NULL ,
  `idProyecto` INT NOT NULL ,
  PRIMARY KEY (`idContacto`, `idProyecto`) ,
  INDEX `fk_Contacto_Proyecto_1` (`idContacto` ASC) ,
  INDEX `fk_Contacto_Proyecto_2` (`idProyecto` ASC) ,
  CONSTRAINT `fk_Contacto_Proyecto_1`
    FOREIGN KEY (`idContacto` )
    REFERENCES `SEVI`.`Contacto` (`idContacto` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `fk_Contacto_Proyecto_2`
    FOREIGN KEY (`idProyecto` )
    REFERENCES `SEVI`.`Proyecto` (`idProyecto` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SEVI`.`Contacto_Telefono`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SEVI`.`Contacto_Telefono` ;

CREATE  TABLE IF NOT EXISTS `SEVI`.`Contacto_Telefono` (
  `idTelefono` INT NOT NULL AUTO_INCREMENT ,
  `idContacto` INT NOT NULL ,
  `telefono` VARCHAR(45) NOT NULL ,
  `extension` VARCHAR(45) NULL ,
  `descripcion` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`idTelefono`, `idContacto`) ,
  INDEX `Telefono_Contacto` (`idContacto` ASC) ,
  CONSTRAINT `Telefono_Contacto`
    FOREIGN KEY (`idContacto` )
    REFERENCES `SEVI`.`Contacto` (`idContacto` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SEVI`.`Grupo_Area`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SEVI`.`Grupo_Area` ;

CREATE  TABLE IF NOT EXISTS `SEVI`.`Grupo_Area` (
  `idGrupo_Area` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(45) NOT NULL ,
  PRIMARY KEY (`idGrupo_Area`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SEVI`.`Area_Conocimiento`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SEVI`.`Area_Conocimiento` ;

CREATE  TABLE IF NOT EXISTS `SEVI`.`Area_Conocimiento` (
  `idArea_Conocimiento` INT NOT NULL AUTO_INCREMENT ,
  `idGrupo_Area` INT NOT NULL ,
  `area` VARCHAR(45) NULL ,
  PRIMARY KEY (`idArea_Conocimiento`, `idGrupo_Area`) ,
  INDEX `Area_Conocimiento_Grupo` (`idGrupo_Area` ASC) ,
  CONSTRAINT `Area_Conocimiento_Grupo`
    FOREIGN KEY (`idGrupo_Area` )
    REFERENCES `SEVI`.`Grupo_Area` (`idGrupo_Area` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SEVI`.`Usuario_Area`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SEVI`.`Usuario_Area` ;

CREATE  TABLE IF NOT EXISTS `SEVI`.`Usuario_Area` (
  `idArea_Conocimiento` INT NOT NULL ,
  `idUsuario` INT NOT NULL ,
  PRIMARY KEY (`idArea_Conocimiento`, `idUsuario`) ,
  INDEX `UA_Usuario` (`idUsuario` ASC) ,
  INDEX `UA_Area` (`idArea_Conocimiento` ASC) ,
  CONSTRAINT `UA_Usuario`
    FOREIGN KEY (`idUsuario` )
    REFERENCES `SEVI`.`Usuario` (`idUsuario` )
    ON DELETE CASCADE
    ON UPDATE CASCADE,
  CONSTRAINT `UA_Area`
    FOREIGN KEY (`idArea_Conocimiento` )
    REFERENCES `SEVI`.`Area_Conocimiento` (`idArea_Conocimiento` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;


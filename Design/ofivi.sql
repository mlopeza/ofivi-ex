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
  `idEscuela` INT NOT NULL AUTO_INCREMENT ,
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
  `Username` VARCHAR(45) NOT NULL ,
  `Nombre` VARCHAR(40) NOT NULL ,
  `ApellidoP` VARCHAR(20) NOT NULL ,
  `ApellidoM` VARCHAR(20) NULL ,
  `email` VARCHAR(45) NOT NULL ,
  `password` VARCHAR(140) NOT NULL DEFAULT 'Sin contraseña' ,
  `Tipo_Usuario` CHAR NOT NULL DEFAULT 'c' COMMENT 'p - Profesor\na - Administrador\nu - Usuario de extension\nv - Administrador de Extension\nl - Usuario de Legal' ,
  `Vista_Profesor` TINYINT NOT NULL DEFAULT 0 ,
  `Vista_Administrador` TINYINT NOT NULL DEFAULT 0 ,
  `Vista_Supervisor_Extension` TINYINT NOT NULL DEFAULT 0 ,
  `Vista_Usuario_Extension` TINYINT NOT NULL DEFAULT 0 ,
  `Vista_Legal` TINYINT NOT NULL DEFAULT 0 ,
  `Vista_Cliente` TINYINT NOT NULL DEFAULT 0 ,
  `Usuario_Activo` TINYINT NOT NULL DEFAULT 0 ,
  `Usuario_Aceptado` CHAR NOT NULL DEFAULT 'e' ,
  PRIMARY KEY (`idUsuario`, `idDepartamento`) ,
  INDEX `Usuario_Departamento` (`idDepartamento` ASC) ,
  UNIQUE INDEX `Username_UNIQUE` (`Username` ASC) ,
  CONSTRAINT `Usuario_Departamento`
    FOREIGN KEY (`idDepartamento` )
    REFERENCES `SEVI`.`Departamento` (`idDepartamento` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SEVI`.`Usuario_Telefono`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SEVI`.`Usuario_Telefono` ;

CREATE  TABLE IF NOT EXISTS `SEVI`.`Usuario_Telefono` (
  `idTelefono` INT NOT NULL AUTO_INCREMENT ,
  `idUsuario` INT NOT NULL ,
  `lada` VARCHAR(10) NULL ,
  `telefono` VARCHAR(45) NOT NULL ,
  `extension` VARCHAR(45) NULL ,
  `descripcion` VARCHAR(45) NOT NULL ,
  `descripcionExtra` VARCHAR(255) NULL ,
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
-- Table `SEVI`.`Grupo`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SEVI`.`Grupo` ;

CREATE  TABLE IF NOT EXISTS `SEVI`.`Grupo` (
  `idGrupo` INT NOT NULL AUTO_INCREMENT ,
  `nombre` VARCHAR(45) NOT NULL ,
  `activo` TINYINT NULL DEFAULT '1' ,
  PRIMARY KEY (`idGrupo`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SEVI`.`Empresa`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SEVI`.`Empresa` ;

CREATE  TABLE IF NOT EXISTS `SEVI`.`Empresa` (
  `idEmpresa` INT NOT NULL AUTO_INCREMENT ,
  `idGrupo` INT NOT NULL ,
  `nombre` VARCHAR(45) NOT NULL ,
  `activo` TINYINT NULL DEFAULT 1 ,
  PRIMARY KEY (`idEmpresa`, `idGrupo`) ,
  INDEX `Empresa_Grupo` (`idGrupo` ASC) ,
  CONSTRAINT `Empresa_Grupo`
    FOREIGN KEY (`idGrupo` )
    REFERENCES `SEVI`.`Grupo` (`idGrupo` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SEVI`.`Proyecto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SEVI`.`Proyecto` ;

CREATE  TABLE IF NOT EXISTS `SEVI`.`Proyecto` (
  `idProyecto` INT NOT NULL AUTO_INCREMENT ,
  `idEmpresa` INT NOT NULL ,
  `nombre` VARCHAR(45) NOT NULL ,
  `descripcionUsuario` BLOB NOT NULL ,
  `descripcionAEV` BLOB NOT NULL ,
  `Proyecto_Activo` TINYINT NOT NULL DEFAULT 1 ,
  `iniciadoPor` INT(11) NOT NULL ,
  PRIMARY KEY (`idProyecto`, `idEmpresa`) ,
  INDEX `Proyecto_Empresa` (`idEmpresa` ASC) ,
  INDEX `Proyecto_Usuario` (`iniciadoPor` ASC) ,
  CONSTRAINT `Proyecto_Empresa`
    FOREIGN KEY (`idEmpresa` )
    REFERENCES `SEVI`.`Empresa` (`idEmpresa` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `Proyecto_Usuario`
    FOREIGN KEY (`iniciadoPor` )
    REFERENCES `SEVI`.`Usuario` (`idUsuario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SEVI`.`SupraCategoria`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SEVI`.`SupraCategoria` ;

CREATE  TABLE IF NOT EXISTS `SEVI`.`SupraCategoria` (
  `idSupraCategoria` INT NOT NULL AUTO_INCREMENT ,
  `Nombre` VARCHAR(100) NOT NULL ,
  PRIMARY KEY (`idSupraCategoria`) )
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SEVI`.`Categoria`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SEVI`.`Categoria` ;

CREATE  TABLE IF NOT EXISTS `SEVI`.`Categoria` (
  `idCategoria` INT NOT NULL AUTO_INCREMENT ,
  `idSupraCategoria` INT NOT NULL ,
  `Categoria` VARCHAR(28) NOT NULL ,
  PRIMARY KEY (`idCategoria`, `idSupraCategoria`) ,
  INDEX `fk_Categoria_1` (`idSupraCategoria` ASC) ,
  CONSTRAINT `fk_Categoria_1`
    FOREIGN KEY (`idSupraCategoria` )
    REFERENCES `SEVI`.`SupraCategoria` (`idSupraCategoria` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
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
  `tiempo_solicitud` TIMESTAMP NULL DEFAULT now() ,
  `tiempo_respuesta` TIMESTAMP NULL ,
  `acepto` TINYINT NULL DEFAULT 0 ,
  `Razon` VARCHAR(255) NOT NULL ,
  `sugerencia` VARCHAR(45) NULL ,
  `activa` TINYINT NOT NULL DEFAULT 1 ,
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
  `Contacto_Activo` TINYINT NOT NULL DEFAULT 1 ,
  `Recibe_Correos` SMALLINT NOT NULL DEFAULT 0 ,
  `puesto` VARCHAR(45) NULL ,
  `departamento` VARCHAR(45) NULL ,
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
  `lada` VARCHAR(10) NOT NULL ,
  `telefono` VARCHAR(45) NOT NULL ,
  `extension` VARCHAR(45) NULL ,
  `descripcion` VARCHAR(45) NOT NULL ,
  `descripcionExtra` VARCHAR(255) NULL ,
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
  `nombre` VARCHAR(100) NOT NULL ,
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


-- -----------------------------------------------------
-- Table `SEVI`.`Reporte`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SEVI`.`Reporte` ;

CREATE  TABLE IF NOT EXISTS `SEVI`.`Reporte` (
  `idReporte` INT NOT NULL AUTO_INCREMENT ,
  `idUsuario` INT NOT NULL ,
  `idProyecto` INT NOT NULL ,
  `Titulo` VARCHAR(50) NOT NULL DEFAULT 'Sin Titulo' ,
  `Reporte` BLOB NOT NULL ,
  `reporteFinal` TINYINT NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`idReporte`, `idUsuario`, `idProyecto`) ,
  INDEX `reporte_usuario` (`idUsuario` ASC) ,
  INDEX `reporte_proyecto` (`idProyecto` ASC) ,
  CONSTRAINT `reporte_usuario`
    FOREIGN KEY (`idUsuario` )
    REFERENCES `SEVI`.`Usuario` (`idUsuario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `reporte_proyecto`
    FOREIGN KEY (`idProyecto` )
    REFERENCES `SEVI`.`Proyecto` (`idProyecto` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SEVI`.`Documento`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SEVI`.`Documento` ;

CREATE  TABLE IF NOT EXISTS `SEVI`.`Documento` (
  `idDocumento` INT NOT NULL AUTO_INCREMENT ,
  `idProyecto` INT NOT NULL ,
  `Titulo` VARCHAR(255) NOT NULL ,
  `Archivo` LONGBLOB NOT NULL ,
  `esLegal` TINYINT NOT NULL DEFAULT 0 ,
  `esPropuesta` TINYINT NOT NULL DEFAULT 0 ,
  `estaAceptado` TINYINT NOT NULL DEFAULT 0 ,
  `Type` VARCHAR(45) NULL ,
  `Size` VARCHAR(45) NULL ,
  `Extension` VARCHAR(45) NULL ,
  `Informacion` VARCHAR(1400) NULL ,
  PRIMARY KEY (`idDocumento`, `idProyecto`) ,
  INDEX `fk_Documento_1` (`idProyecto` ASC) ,
  CONSTRAINT `fk_Documento_1`
    FOREIGN KEY (`idProyecto` )
    REFERENCES `SEVI`.`Proyecto` (`idProyecto` )
    ON DELETE CASCADE
    ON UPDATE CASCADE)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `SEVI`.`jqcalendar`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `SEVI`.`jqcalendar` ;

CREATE  TABLE IF NOT EXISTS `SEVI`.`jqcalendar` (
  `Id` INT NOT NULL AUTO_INCREMENT ,
  `idUsuario` INT NOT NULL ,
  `Subject` VARCHAR(1000) NULL ,
  `Location` VARCHAR(500) NULL DEFAULT '' ,
  `Description` VARCHAR(1000) NULL DEFAULT '' ,
  `StartTime` DATETIME NULL ,
  `EndTime` DATETIME NULL ,
  `IsAllDayEvent` SMALLINT NOT NULL ,
  `Color` VARCHAR(200) NULL ,
  `RecurringRule` VARCHAR(500) NULL ,
  `enviado` TINYINT NOT NULL DEFAULT 0 ,
  PRIMARY KEY (`Id`, `idUsuario`) ,
  INDEX `fk_jqcalendar_1` (`idUsuario` ASC) ,
  INDEX `time_tree` USING BTREE (`StartTime` ASC, `idUsuario` ASC, `enviado` ASC) ,
  INDEX `time_tree_2` (`idUsuario` ASC, `StartTime` ASC) ,
  CONSTRAINT `fk_jqcalendar_1`
    FOREIGN KEY (`idUsuario` )
    REFERENCES `SEVI`.`Usuario` (`idUsuario` )
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 4;


-- -----------------------------------------------------
-- Placeholder table for view `SEVI`.`Vista_Usuarios_Area`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `SEVI`.`Vista_Usuarios_Area` (`Nombre` INT, `ApellidoP` INT, `ApellidoM` INT, `email` INT, `Tipo_Usuario` INT, `Departamento` INT, `Campus` INT, `Escuela` INT, `idArea_Conocimiento` INT);

-- -----------------------------------------------------
-- View `SEVI`.`Vista_Usuarios_Area`
-- -----------------------------------------------------
DROP VIEW IF EXISTS `SEVI`.`Vista_Usuarios_Area` ;
DROP TABLE IF EXISTS `SEVI`.`Vista_Usuarios_Area`;
USE `SEVI`;
CREATE  OR REPLACE VIEW `SEVI`.`Vista_Usuarios_Area` AS
SELECT u.Nombre, u.ApellidoP, u.ApellidoM, u.email, u.Tipo_Usuario, d.nombre as Departamento,
            c.Nombre as Campus, e.Nombre as Escuela, ua.idArea_Conocimiento
FROM Usuario u
INNER JOIN Departamento d ON u.idDepartamento = d.idDepartamento
INNER JOIN Escuela e ON e.idEscuela = d.idEscuela
INNER JOIN Campus c ON c.idCampus = e.idCampus
INNER JOIN Usuario_Area ua ON u.idUsuario = ua.idUsuario
;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `SEVI`.`Campus`
-- -----------------------------------------------------
START TRANSACTION;
USE `SEVI`;
INSERT INTO `SEVI`.`Campus` (`idCampus`, `Nombre`, `Ciudad`) VALUES (1, 'Campus Monterrey', 'Monterrey');
INSERT INTO `SEVI`.`Campus` (`idCampus`, `Nombre`, `Ciudad`) VALUES (2, 'Campus Guadalajara', 'Guadalajara');

COMMIT;

-- -----------------------------------------------------
-- Data for table `SEVI`.`Escuela`
-- -----------------------------------------------------
START TRANSACTION;
USE `SEVI`;
INSERT INTO `SEVI`.`Escuela` (`idEscuela`, `idCampus`, `Nombre`, `Ubicacion`) VALUES (1, 1, 'Escuela de Ingenieria', 'Aulas 6 Cuarto Piso');
INSERT INTO `SEVI`.`Escuela` (`idEscuela`, `idCampus`, `Nombre`, `Ubicacion`) VALUES (2, 1, 'Escuela de Negocios', 'A6402');

COMMIT;

-- -----------------------------------------------------
-- Data for table `SEVI`.`Departamento`
-- -----------------------------------------------------
START TRANSACTION;
USE `SEVI`;
INSERT INTO `SEVI`.`Departamento` (`idDepartamento`, `idEscuela`, `nombre`, `ubicacion`) VALUES (1, 1, 'Ciencias Computacionales', 'A2110');
INSERT INTO `SEVI`.`Departamento` (`idDepartamento`, `idEscuela`, `nombre`, `ubicacion`) VALUES (2, 1, 'Ingenieria Quimica', 'A1110');

COMMIT;

-- -----------------------------------------------------
-- Data for table `SEVI`.`Usuario`
-- -----------------------------------------------------
START TRANSACTION;
USE `SEVI`;
INSERT INTO `SEVI`.`Usuario` (`idUsuario`, `idDepartamento`, `Username`, `Nombre`, `ApellidoP`, `ApellidoM`, `email`, `password`, `Tipo_Usuario`, `Vista_Profesor`, `Vista_Administrador`, `Vista_Supervisor_Extension`, `Vista_Usuario_Extension`, `Vista_Legal`, `Vista_Cliente`, `Usuario_Activo`, `Usuario_Aceptado`) VALUES (1, 1, 'elda_quiroga', 'Elda', 'Quiroga', '', 'equiroga@itesm.mx', '5b722b307fce6c944905d132691d5e4a2214b7fe92b738920eb3fce3a90420a19511c3010a0e7712b054daef5b57bad59ecbd93b3280f210578f547f4aed4d25', 'p', 1, 0, 0, 0, 0, 0, 1, 'e');
INSERT INTO `SEVI`.`Usuario` (`idUsuario`, `idDepartamento`, `Username`, `Nombre`, `ApellidoP`, `ApellidoM`, `email`, `password`, `Tipo_Usuario`, `Vista_Profesor`, `Vista_Administrador`, `Vista_Supervisor_Extension`, `Vista_Usuario_Extension`, `Vista_Legal`, `Vista_Cliente`, `Usuario_Activo`, `Usuario_Aceptado`) VALUES (2, 1, 'L00203456', 'Juan Arturo', 'Nolazco', 'Flores', 'jnolazco@itesm.mx', '5b722b307fce6c944905d132691d5e4a2214b7fe92b738920eb3fce3a90420a19511c3010a0e7712b054daef5b57bad59ecbd93b3280f210578f547f4aed4d25', 'p', 1, 1, 0, 0, 0, 0, 1, 'e');
INSERT INTO `SEVI`.`Usuario` (`idUsuario`, `idDepartamento`, `Username`, `Nombre`, `ApellidoP`, `ApellidoM`, `email`, `password`, `Tipo_Usuario`, `Vista_Profesor`, `Vista_Administrador`, `Vista_Supervisor_Extension`, `Vista_Usuario_Extension`, `Vista_Legal`, `Vista_Cliente`, `Usuario_Activo`, `Usuario_Aceptado`) VALUES (3, 1, 'L00202020', 'Luis Humberto', 'Gonzalez', 'Guerra', 'lherrera@itesm.mx', '5b722b307fce6c944905d132691d5e4a2214b7fe92b738920eb3fce3a90420a19511c3010a0e7712b054daef5b57bad59ecbd93b3280f210578f547f4aed4d25', 'p', 1, 0, 0, 1, 1, 0, 1, 'a');
INSERT INTO `SEVI`.`Usuario` (`idUsuario`, `idDepartamento`, `Username`, `Nombre`, `ApellidoP`, `ApellidoM`, `email`, `password`, `Tipo_Usuario`, `Vista_Profesor`, `Vista_Administrador`, `Vista_Supervisor_Extension`, `Vista_Usuario_Extension`, `Vista_Legal`, `Vista_Cliente`, `Usuario_Activo`, `Usuario_Aceptado`) VALUES (4, 1, 'jorge_limon', 'Jorge', 'Limon', '', 'jlimon@itesm.mx', '5b722b307fce6c944905d132691d5e4a2214b7fe92b738920eb3fce3a90420a19511c3010a0e7712b054daef5b57bad59ecbd93b3280f210578f547f4aed4d25', 'v', 1, 1, 1, 1, 1, 1, 1, 'a');
INSERT INTO `SEVI`.`Usuario` (`idUsuario`, `idDepartamento`, `Username`, `Nombre`, `ApellidoP`, `ApellidoM`, `email`, `password`, `Tipo_Usuario`, `Vista_Profesor`, `Vista_Administrador`, `Vista_Supervisor_Extension`, `Vista_Usuario_Extension`, `Vista_Legal`, `Vista_Cliente`, `Usuario_Activo`, `Usuario_Aceptado`) VALUES (5, 1, 'evesdrop_fake_hack_hack', 'Eve', 'Fake', '', 'efake@itesm.mx', '5b722b307fce6c944905d132691d5e4a2214b7fe92b738920eb3fce3a90420a19511c3010a0e7712b054daef5b57bad59ecbd93b3280f210578f547f4aed4d25', 'a', 0, 0, 0, 0, 0, 0, 0, 'r');
INSERT INTO `SEVI`.`Usuario` (`idUsuario`, `idDepartamento`, `Username`, `Nombre`, `ApellidoP`, `ApellidoM`, `email`, `password`, `Tipo_Usuario`, `Vista_Profesor`, `Vista_Administrador`, `Vista_Supervisor_Extension`, `Vista_Usuario_Extension`, `Vista_Legal`, `Vista_Cliente`, `Usuario_Activo`, `Usuario_Aceptado`) VALUES (6, 1, 'L00902890', 'Jenny', 'V', '', 'No mail', 'ce8a7bda5bb05a8e0bf1b7166335cad2a9ed79504ac5ec694c2c0286efa94d1913963130a1af41e6bffbf9c2c5036439985cdf67cc1ac6ee00a3faba3065ee58', 'a', 1, 1, 1, 1, 0, 0, 1, 'a');

COMMIT;

-- -----------------------------------------------------
-- Data for table `SEVI`.`Usuario_Telefono`
-- -----------------------------------------------------
START TRANSACTION;
USE `SEVI`;
INSERT INTO `SEVI`.`Usuario_Telefono` (`idTelefono`, `idUsuario`, `lada`, `telefono`, `extension`, `descripcion`, `descripcionExtra`) VALUES (1, 4, '899', '9290171', '202', 'Ninguna', 'Nada');
INSERT INTO `SEVI`.`Usuario_Telefono` (`idTelefono`, `idUsuario`, `lada`, `telefono`, `extension`, `descripcion`, `descripcionExtra`) VALUES (2, 4, '899', '9290171', '203', 'Ninguna 2', 'Nada 2');

COMMIT;

-- -----------------------------------------------------
-- Data for table `SEVI`.`Grupo`
-- -----------------------------------------------------
START TRANSACTION;
USE `SEVI`;
INSERT INTO `SEVI`.`Grupo` (`idGrupo`, `nombre`, `activo`) VALUES (1, 'OXXO', NULL);

COMMIT;

-- -----------------------------------------------------
-- Data for table `SEVI`.`Empresa`
-- -----------------------------------------------------
START TRANSACTION;
USE `SEVI`;
INSERT INTO `SEVI`.`Empresa` (`idEmpresa`, `idGrupo`, `nombre`, `activo`) VALUES (1, 1, 'Empresa 1', NULL);

COMMIT;

-- -----------------------------------------------------
-- Data for table `SEVI`.`Grupo_Area`
-- -----------------------------------------------------
START TRANSACTION;
USE `SEVI`;
INSERT INTO `SEVI`.`Grupo_Area` (`idGrupo_Area`, `nombre`) VALUES (1, 'Tecnologias de la Infromación y la comunicación');
INSERT INTO `SEVI`.`Grupo_Area` (`idGrupo_Area`, `nombre`) VALUES (2, 'Medicina');

COMMIT;

-- -----------------------------------------------------
-- Data for table `SEVI`.`Area_Conocimiento`
-- -----------------------------------------------------
START TRANSACTION;
USE `SEVI`;
INSERT INTO `SEVI`.`Area_Conocimiento` (`idArea_Conocimiento`, `idGrupo_Area`, `area`) VALUES (1, 1, 'Redes');
INSERT INTO `SEVI`.`Area_Conocimiento` (`idArea_Conocimiento`, `idGrupo_Area`, `area`) VALUES (2, 1, 'Sistemas Operativos');
INSERT INTO `SEVI`.`Area_Conocimiento` (`idArea_Conocimiento`, `idGrupo_Area`, `area`) VALUES (3, 1, 'Sistemas Embebidos');
INSERT INTO `SEVI`.`Area_Conocimiento` (`idArea_Conocimiento`, `idGrupo_Area`, `area`) VALUES (4, 2, 'Medicina General');
INSERT INTO `SEVI`.`Area_Conocimiento` (`idArea_Conocimiento`, `idGrupo_Area`, `area`) VALUES (5, 2, 'Gastro Enterologia');

COMMIT;

-- -----------------------------------------------------
-- Data for table `SEVI`.`Usuario_Area`
-- -----------------------------------------------------
START TRANSACTION;
USE `SEVI`;
INSERT INTO `SEVI`.`Usuario_Area` (`idArea_Conocimiento`, `idUsuario`) VALUES (1, 1);
INSERT INTO `SEVI`.`Usuario_Area` (`idArea_Conocimiento`, `idUsuario`) VALUES (1, 2);
INSERT INTO `SEVI`.`Usuario_Area` (`idArea_Conocimiento`, `idUsuario`) VALUES (1, 3);
INSERT INTO `SEVI`.`Usuario_Area` (`idArea_Conocimiento`, `idUsuario`) VALUES (2, 1);
INSERT INTO `SEVI`.`Usuario_Area` (`idArea_Conocimiento`, `idUsuario`) VALUES (2, 3);
INSERT INTO `SEVI`.`Usuario_Area` (`idArea_Conocimiento`, `idUsuario`) VALUES (4, 1);

COMMIT;


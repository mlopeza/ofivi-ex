INSERT INTO  `sevi`.`campus` (
`idCampus` ,
`Nombre` ,
`Ciudad`
)
VALUES (
NULL ,  'NA',  'NA'
);

INSERT INTO  `sevi`.`escuela` (
`idEscuela` ,
`idCampus` ,
`Nombre` ,
`Ubicacion`
)
VALUES (
NULL ,(SELECT idCampus FROM campus WHERE Nombre = 'NA' LIMIT 1),  'NA',  'NA'
);

INSERT INTO  `sevi`.`departamento` (
`idDepartamento` ,
`idEscuela` ,
`nombre` ,
`ubicacion`
)
VALUES (
NULL ,(SELECT idEscuela FROM escuela WHERE nombre = 'NA' LIMIT 1),  'NA',  'NA'
);

INSERT INTO  `sevi`.`usuario` (

`idUsuario` ,
`idDepartamento` ,
`Username` ,
`Nombre` ,
`ApellidoP` ,
`ApellidoM` ,
`email` ,
`password` ,
`Tipo_Usuario` ,
`Vista_Profesor` ,
`Vista_Administrador` ,
`Vista_Supervisor_Extension` ,
`Vista_Usuario_Extension` ,
`Vista_Legal` ,
`Vista_Cliente` ,
`Usuario_Activo` ,
`Usuario_Aceptado`
)
VALUES (
NULL ,  (SELECT idDepartamento FROM departamento WHERE nombre = 'NA' LIMIT 1),  'Sin usuario',  'NA',  'NA',  'NA',  'NA',  'Sin contraseña',  'c',  '0',  '0',  '0',  '0',  '0',  '0',  '0',  'a'
);

INSERT INTO  `sevi`.`grupo` (
`idGrupo` ,
`nombre` ,
`activo`
)
VALUES (
NULL ,  'NA',  '1'
);

INSERT INTO  `sevi`.`empresa` (
`idEmpresa` ,
`idGrupo` ,
`nombre` ,
`activo`
)
VALUES (
NULL ,  (SELECT idGrupo FROM grupo WHERE nombre = 'NA' LIMIT 1),  'Sin empresa',  '1'
);

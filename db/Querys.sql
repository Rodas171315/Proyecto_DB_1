-- --------------------------------------------------------

--
-- Crea los datos de la persona.
--

DELIMITER $$
DROP PROCEDURE IF EXISTS CREAR_PERSONAS$$
CREATE PROCEDURE `CREAR_PERSONAS`(IN cui BIGINT(13), primer_nombre VARCHAR(20), segundo_nombre VARCHAR(20), tercer_nombre VARCHAR(20), primer_apellido VARCHAR(20), segundo_apellido VARCHAR(20), fecha_nacimiento DATE, id_sexo INT, id_oficio INT, id_enfermedad INT)
BEGIN
    INSERT INTO `personas`(`cui`, `primer_nombre`, `segundo_nombre`, `tercer_nombre`, `primer_apellido`, `segundo_apellido`, `fecha_nacimiento`, `id_sexo`) VALUES (cui,primer_nombre,segundo_nombre,tercer_nombre,primer_apellido,segundo_apellido,fecha_nacimiento,id_sexo);
    INSERT INTO `oficiosxpersona`(`cui`, `id_oficio`) VALUES (cui,id_oficio);
    INSERT INTO `enfermedadesxpersona`(`cui`, `id_enfermedad`) VALUES (cui,id_enfermedad);
    UPDATE `personas` SET `apto_registro`=FALSE, `registrado`=FALSE WHERE `cui`=cui;
END;$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Actualiza los datos de la persona.
--

DELIMITER $$
DROP PROCEDURE IF EXISTS ACTUALIZAR_PERSONAS$$
CREATE PROCEDURE `ACTUALIZAR_PERSONAS`(IN p_cui BIGINT(13), IN p_primer_nombre VARCHAR(20), IN p_segundo_nombre VARCHAR(20), IN p_tercer_nombre VARCHAR(20), IN p_primer_apellido VARCHAR(20), IN p_segundo_apellido VARCHAR(20), IN p_fecha_nacimiento DATE, IN p_id_sexo INT, IN p_id_oficio INT, IN p_id_enfermedad INT)
BEGIN
    UPDATE `personas` SET `primer_nombre`=p_primer_nombre,`segundo_nombre`=p_segundo_nombre,`tercer_nombre`=p_tercer_nombre,`primer_apellido`=p_primer_apellido,`segundo_apellido`=p_segundo_apellido,`fecha_nacimiento`=p_fecha_nacimiento,`id_sexo`=p_id_sexo WHERE `cui`=p_cui;
    UPDATE `oficiosxpersona` SET `id_oficio`=p_id_oficio WHERE `cui`=p_cui;
    UPDATE `enfermedadesxpersona` SET `id_enfermedad`=p_id_enfermedad WHERE `cui`=p_cui;
END;$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Habilita a las personas para ser aptos de registrarse.
--

DELIMITER $$
DROP PROCEDURE IF EXISTS HABILITAR_PERSONAS$$
CREATE PROCEDURE `HABILITAR_PERSONAS`(IN p_fecha_nacimiento DATE, IN p_id_oficio INT, IN p_id_enfermedad INT)
BEGIN
    UPDATE `personas` 
    INNER JOIN `oficiosxpersona` ON `oficiosxpersona`.`cui`=`personas`.`cui` 
    INNER JOIN `enfermedadesxpersona` ON `enfermedadesxpersona`.`cui`=`personas`.`cui`
    SET `apto_registro`=TRUE WHERE `fecha_nacimiento`<=p_fecha_nacimiento OR `id_oficio`=p_id_oficio OR `id_enfermedad`=p_id_enfermedad;
END;$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Crea el usuario y todo lo necesario para su seguimiento de vacunacion.
--

DELIMITER $$
DROP PROCEDURE IF EXISTS CREAR_USUARIOS$$
CREATE PROCEDURE CREAR_USUARIOS(IN p_cui BIGINT(13), contra VARCHAR(20), IN p_telefono INT, IN p_email VARCHAR(25), id_centro INT, p_id_seguimiento VARCHAR(21))
BEGIN
    SET p_id_seguimiento = RIGHT(p_id_seguimiento, LENGTH(p_id_seguimiento)-1);
    INSERT INTO `usuarios`(`cui`, `contra`, `id_perfil`) VALUES (p_cui,contra,1);
    INSERT INTO `seguimientos_persona`(`id_seguimiento`,`fecha_vacunacion`) VALUES (p_id_seguimiento,CURDATE());
    INSERT INTO `dosis`(`id_dosis_recibida`, `fecha_dosis`) VALUES (1,now());
    INSERT INTO `dosisxseguimiento`(`id_seguimiento`, `id_dosis`) VALUES (p_id_seguimiento,LAST_INSERT_ID());
    INSERT INTO `centrosxseguimiento`(`id_seguimiento`, `id_centro`) VALUES (p_id_seguimiento,id_centro);
    INSERT INTO `registrosxpersona`(`cui`, `id_seguimiento`) VALUES (p_cui,p_id_seguimiento);
    UPDATE `personas` SET `registrado`=TRUE, `telefono`=p_telefono, `email`=p_email WHERE `cui`=p_cui;
END;$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Procedimiento que genera y descarga los archivos para reportes.
--

DELIMITER $$
DROP PROCEDURE IF EXISTS ESCRIBE_REPORTE_3$$
CREATE PROCEDURE ESCRIBE_REPORTE_3()
BEGIN
    SELECT * FROM `personas` 
    WHERE apto_registro=TRUE AND registrado=FALSE 
    ORDER BY `personas`.`cui` ASC 
    INTO OUTFILE 'C:/Users/Dylan/Downloads/reporte-habilitados-sin-registrar.csv'
    FIELDS TERMINATED BY ','
    LINES TERMINATED BY '\n';
END;$$
DELIMITER ;

-- CALL `ESCRIBE_REPORTE_3`();

-- Select Count(*) AS `TOTAL de Personas` FROM `personas` WHERE apto_registro=TRUE AND registrado=FALSE ORDER BY `personas`.`cui` ASC;

-- --------------------------------------------------------

--
-- Devuelve el nombre completo de las personas. 
--

DELIMITER $$
DROP FUNCTION IF EXISTS FULLNAME$$
CREATE FUNCTION FULLNAME(p_cui BIGINT(13))
RETURNS VARCHAR(250)
BEGIN
    DECLARE nombre_completo VARCHAR(250);
    SELECT CONCAT(`primer_nombre`,' ',`segundo_nombre`,' ',`tercer_nombre`,' ',`primer_apellido`,' ',`segundo_apellido`) INTO nombre_completo FROM `personas` WHERE `cui`=p_cui;
    RETURN nombre_completo;
END;$$
DELIMITER ;

/* SELECT FULLNAME(`personas`.`cui`) AS `Nombre_Completo` FROM `personas`; */

-- --------------------------------------------------------

--
-- Vista para ver adecuadamente los datos de las personas.
--

DELIMITER $$
DROP VIEW IF EXISTS VISTA_PERSONAS$$
CREATE VIEW VISTA_PERSONAS AS
SELECT `personas`.`cui` AS `CUI`,
FULLNAME(`personas`.`cui`) AS `Nombre Completo`,
`personas`.`fecha_nacimiento` AS `Fecha de Nacimiento`,
`sexos`.`sexo` AS `Sexo`,
`oficios`.`oficio` AS `Oficio`,
`enfermedades`.`enfermedad` AS `Enfermedad`
FROM `personas`
INNER JOIN `sexos` ON `sexos`.`id_sexo`=`personas`.`id_sexo`
INNER JOIN `oficiosxpersona` ON `oficiosxpersona`.`cui`=`personas`.`cui`
INNER JOIN `enfermedadesxpersona` ON `enfermedadesxpersona`.`cui`=`personas`.`cui`
INNER JOIN `oficios` ON `oficios`.`id_oficio`=`oficiosxpersona`.`id_oficio`
INNER JOIN `enfermedades` ON `enfermedades`.`id_enfermedad`=`enfermedadesxpersona`.`id_enfermedad`
ORDER BY `personas`.`cui`;$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Vista para ver adecuadamente los datos de las personas habilitadas.
--

DELIMITER $$
DROP VIEW IF EXISTS PERSONAS_HABILITADAS$$
CREATE VIEW PERSONAS_HABILITADAS AS
SELECT `personas`.`cui` AS `CUI`,
FULLNAME(`personas`.`cui`) AS `Nombre Completo`,
`personas`.`fecha_nacimiento` AS `Fecha de Nacimiento`,
`sexos`.`sexo` AS `Sexo`,
`oficios`.`oficio` AS `Oficio`,
`enfermedades`.`enfermedad` AS `Enfermedad`,
`personas`.`apto_registro` AS `Habilitado`
FROM `personas`
INNER JOIN `sexos` ON `sexos`.`id_sexo`=`personas`.`id_sexo`
INNER JOIN `oficiosxpersona` ON `oficiosxpersona`.`cui`=`personas`.`cui`
INNER JOIN `enfermedadesxpersona` ON `enfermedadesxpersona`.`cui`=`personas`.`cui`
INNER JOIN `oficios` ON `oficios`.`id_oficio`=`oficiosxpersona`.`id_oficio`
INNER JOIN `enfermedades` ON `enfermedades`.`id_enfermedad`=`enfermedadesxpersona`.`id_enfermedad`
WHERE `personas`.`apto_registro`=TRUE
ORDER BY `personas`.`cui`;$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Vista para ver adecuadamente los datos de las personas registradas.
--

DELIMITER $$
DROP VIEW IF EXISTS PERSONAS_REGISTRADAS$$
CREATE VIEW PERSONAS_REGISTRADAS AS
SELECT `personas`.`cui` AS `CUI`,
FULLNAME(`personas`.`cui`) AS `Nombre Completo`,
`personas`.`fecha_nacimiento` AS `Fecha de Nacimiento`,
`sexos`.`sexo` AS `Sexo`,
`oficios`.`oficio` AS `Oficio`,
`enfermedades`.`enfermedad` AS `Enfermedad`,
`personas`.`apto_registro` AS `Habilitado`,
`personas`.`registrado` AS `Registrado`
FROM `personas`
INNER JOIN `sexos` ON `sexos`.`id_sexo`=`personas`.`id_sexo`
INNER JOIN `oficiosxpersona` ON `oficiosxpersona`.`cui`=`personas`.`cui`
INNER JOIN `enfermedadesxpersona` ON `enfermedadesxpersona`.`cui`=`personas`.`cui`
INNER JOIN `oficios` ON `oficios`.`id_oficio`=`oficiosxpersona`.`id_oficio`
INNER JOIN `enfermedades` ON `enfermedades`.`id_enfermedad`=`enfermedadesxpersona`.`id_enfermedad`
WHERE `personas`.`registrado`=TRUE
ORDER BY `personas`.`cui`;$$
DELIMITER ;

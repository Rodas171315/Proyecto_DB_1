-- --------------------------------------------------------

--
-- Crea los datos de la persona.
--

DELIMITER $$
DROP PROCEDURE IF EXISTS CREAR_PERSONAS$$
CREATE PROCEDURE `CREAR_PERSONAS`(IN p_cui BIGINT(13), primer_nombre VARCHAR(20), segundo_nombre VARCHAR(20), tercer_nombre VARCHAR(20), primer_apellido VARCHAR(20), segundo_apellido VARCHAR(20), fecha_nacimiento DATE, id_sexo INT, id_oficio INT, id_enfermedad INT)
BEGIN
    INSERT INTO `personas`(`cui`, `primer_nombre`, `segundo_nombre`, `tercer_nombre`, `primer_apellido`, `segundo_apellido`, `fecha_nacimiento`, `id_sexo`) VALUES (p_cui,primer_nombre,segundo_nombre,tercer_nombre,primer_apellido,segundo_apellido,fecha_nacimiento,id_sexo);
    INSERT INTO `oficiosxpersona`(`cui`, `id_oficio`) VALUES (p_cui,id_oficio);
    INSERT INTO `enfermedadesxpersona`(`cui`, `id_enfermedad`) VALUES (p_cui,id_enfermedad);
    UPDATE `personas` SET `apto_registro`=FALSE, `registrado`=FALSE WHERE `cui`=p_cui;
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
-- Elimina los datos de la persona.
--

DELIMITER $$
DROP PROCEDURE IF EXISTS BORRAR_PERSONAS$$
CREATE PROCEDURE `BORRAR_PERSONAS`(IN cui BIGINT(13))
BEGIN
    DELETE FROM `oficiosxpersona` WHERE `oficiosxpersona`.`cui` = cui;
    DELETE FROM `enfermedadesxpersona` WHERE `enfermedadesxpersona`.`cui` = cui;
    DELETE FROM `personas` WHERE `personas`.`cui` = cui;
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
CREATE PROCEDURE `CREAR_USUARIOS`(IN p_cui BIGINT(13), contra VARCHAR(20), IN p_telefono INT, IN p_email VARCHAR(25), id_centro INT, p_id_seguimiento VARCHAR(21))
BEGIN
    SET p_id_seguimiento = RIGHT(p_id_seguimiento, LENGTH(p_id_seguimiento)-1);
    INSERT INTO `usuarios`(`cui`, `contra`, `id_perfil`) VALUES (p_cui,contra,1);
    INSERT INTO `seguimientos_persona`(`id_seguimiento`,`vacunado_extranjero`) VALUES (p_id_seguimiento,FALSE);
    INSERT INTO `dosis`(`id_dosis_recibida`, `fecha_dosis`) VALUES (1,now());
    INSERT INTO `dosisxseguimiento`(`id_seguimiento`, `id_dosis`) VALUES (p_id_seguimiento,LAST_INSERT_ID());
    INSERT INTO `centrosxseguimiento`(`id_seguimiento`, `id_centro`) VALUES (p_id_seguimiento,id_centro);
    INSERT INTO `vacunasxseguimiento`(`id_seguimiento`, `id_vacuna`) VALUES (p_id_seguimiento,1);
    INSERT INTO `registrosxpersona`(`cui`, `id_seguimiento`) VALUES (p_cui,p_id_seguimiento);
    UPDATE `personas` SET `registrado`=TRUE, `telefono`=p_telefono, `email`=p_email WHERE `cui`=p_cui;
END;$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Actualiza los datos del usuario.
--

DELIMITER $$
DROP PROCEDURE IF EXISTS ACTUALIZAR_USUARIOS$$
CREATE PROCEDURE `ACTUALIZAR_USUARIOS`(IN p_cui BIGINT(13), IN p_contra VARCHAR(20), IN p_telefono INT, IN p_email VARCHAR(25), IN p_id_perfil INT)
BEGIN
    UPDATE `personas` SET `telefono`=p_telefono,`email`=p_email WHERE `cui`=p_cui;
    UPDATE `usuarios` SET `id_perfil`=p_id_perfil WHERE `cui`=p_cui;
    IF (p_contra != '') THEN
        UPDATE `usuarios` SET `contra`=p_contra WHERE `cui`=p_cui;
    END IF;
END;$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Elimina los datos del usuario.
--

DELIMITER $$
DROP PROCEDURE IF EXISTS BORRAR_USUARIOS$$
CREATE PROCEDURE `BORRAR_USUARIOS`(IN cui BIGINT(13))
BEGIN
    DELETE FROM `usuarios` WHERE `usuarios`.`cui` = cui;
END;$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Establece la fecha de vacunacion para las personas.
--

DELIMITER $$
DROP PROCEDURE IF EXISTS ESTABLECER_FECHA_VACUNA$$
CREATE PROCEDURE `ESTABLECER_FECHA_VACUNA`(IN p_fecha_vacunacion DATE, IN p_fecha_nacimiento DATE, IN p_id_oficio INT, IN p_id_enfermedad INT)
BEGIN
    UPDATE `seguimientos_persona` 
    INNER JOIN `registrosxpersona` ON `registrosxpersona`.`id_seguimiento`=`seguimientos_persona`.`id_seguimiento` 
    INNER JOIN `personas` ON `personas`.`cui`=`registrosxpersona`.`cui`
    INNER JOIN `oficiosxpersona` ON `oficiosxpersona`.`cui`=`personas`.`cui`
    INNER JOIN `enfermedadesxpersona` ON `enfermedadesxpersona`.`cui`=`personas`.`cui`
    SET `fecha_vacunacion`=p_fecha_vacunacion WHERE `fecha_nacimiento`<=p_fecha_nacimiento OR `id_oficio`=p_id_oficio OR `id_enfermedad`=p_id_enfermedad;
END;$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Crea los datos de vacunacion y actualiza el seguimiento de vacunacion de la persona.
--

DELIMITER $$
DROP PROCEDURE IF EXISTS VACUNAR_PERSONAS$$
CREATE PROCEDURE `VACUNAR_PERSONAS`(IN p_id_seguimiento VARCHAR(20), IN p_vacunado_extranjero BOOLEAN, IN p_id_vacuna INT)
BEGIN
    DECLARE dias, dosis, dosis_max, p_dosis_recibida INT;
    DECLARE p_fecha_vacunacion DATE;

    SELECT `dias_dosis` INTO dias FROM `vacunas` WHERE `id_vacuna`=p_id_vacuna;
    SELECT MAX(`id_dosis_recibida`) INTO dosis FROM `seguimientos_persona` 
    INNER JOIN `dosisxseguimiento` ON `dosisxseguimiento`.`id_seguimiento`=`seguimientos_persona`.`id_seguimiento`
    INNER JOIN `dosis` ON `dosis`.`id_dosis`=`dosisxseguimiento`.`id_dosis`
    WHERE `seguimientos_persona`.`id_seguimiento`=p_id_seguimiento;
    SELECT `cant_dosis` INTO dosis_max FROM `vacunas` WHERE `id_vacuna`=p_id_vacuna;

    SET p_dosis_recibida = (dosis)+1;

    INSERT INTO `dosis`(`id_dosis_recibida`,`fecha_dosis`) VALUES (p_dosis_recibida,now());
    INSERT INTO `dosisxseguimiento`(`id_seguimiento`, `id_dosis`) VALUES (p_id_seguimiento,LAST_INSERT_ID());

    IF (p_dosis_recibida-1) = dosis_max THEN
        SET p_fecha_vacunacion = '9999-01-01';
        INSERT INTO `dosis`(`id_dosis_recibida`,`fecha_dosis`) VALUES (5,DATE_ADD(now(), INTERVAL 1 MINUTE));
        INSERT INTO `dosisxseguimiento`(`id_seguimiento`, `id_dosis`) VALUES (p_id_seguimiento,LAST_INSERT_ID());
    ELSEIF (p_dosis_recibida-1) < dosis_max THEN
        SET p_fecha_vacunacion = DATE_ADD(CURDATE(),INTERVAL (dias) DAY);
    END IF;

    UPDATE `seguimientos_persona` SET `vacunado_extranjero`=p_vacunado_extranjero, `fecha_vacunacion`=p_fecha_vacunacion WHERE `id_seguimiento`=p_id_seguimiento;
    UPDATE `vacunasxseguimiento` SET `id_vacuna`=p_id_vacuna WHERE `id_seguimiento`=p_id_seguimiento;
END;$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Procedimientos que generan y descargan los archivos para reportes.
--

-- Personas vacunadas en cada centro de vacunación entre dos fechas.
DELIMITER $$
DROP PROCEDURE IF EXISTS ESCRIBE_REPORTE_1$$
CREATE PROCEDURE `ESCRIBE_REPORTE_1`(IN p_fecha_1 DATE, IN p_fecha_2 DATE)
BEGIN
    SELECT `vista_personas`.*,
    `vista_seguimientos`.* 
    FROM `vista_seguimientos` 
    INNER JOIN `vista_personas` ON `vista_personas`.`CUI`=`vista_seguimientos`.`CUI`
    WHERE `Fecha de Dosis`>p_fecha_1 AND `Fecha de Dosis`<p_fecha_2 AND `Vacuna`!='Ninguna' AND `Dosis`!='Inscrito'
    GROUP BY `vista_seguimientos`.`CUI`
    ORDER BY `vista_seguimientos`.`Fecha de Dosis` ASC
    INTO OUTFILE 'C:/Users/Dylan/Downloads/vacunados-en-cada-centro.csv'
    FIELDS TERMINATED BY ','
    LINES TERMINATED BY '\n';
END;$$
DELIMITER ;

-- Detalle de vacunas diario en determinado centro de vacunación.
DELIMITER $$
DROP PROCEDURE IF EXISTS ESCRIBE_REPORTE_2$$
CREATE PROCEDURE `ESCRIBE_REPORTE_2`(IN p_id_centro INT)
BEGIN
    SELECT `centro`,`direccion`,STOCK(`id_centro`)
    FROM `centros_vacunacion`
    WHERE `id_centro`=p_id_centro
    INTO OUTFILE 'C:/Users/Dylan/Downloads/vacunas-en-determinado-centro.csv'
    FIELDS TERMINATED BY ','
    LINES TERMINATED BY '\n';
END;$$
DELIMITER ;

-- Cantidad y listado de personas habilitadas para vacunación pero que no se han registrado.
DELIMITER $$
DROP PROCEDURE IF EXISTS ESCRIBE_REPORTE_3$$
CREATE PROCEDURE `ESCRIBE_REPORTE_3`()
BEGIN
    SELECT * FROM `personas` 
    WHERE `apto_registro`=TRUE AND `registrado`=FALSE 
    ORDER BY `personas`.`cui` ASC 
    INTO OUTFILE 'C:/Users/Dylan/Downloads/reporte-habilitados-sin-registrar.csv'
    FIELDS TERMINATED BY ','
    LINES TERMINATED BY '\n';
END;$$
DELIMITER ;

-- CALL `ESCRIBE_REPORTE_3`();

-- Select Count(*) AS `TOTAL de Personas` FROM `personas` WHERE apto_registro=TRUE AND registrado=FALSE ORDER BY `personas`.`cui` ASC;

-- Cantidad y listado de personas registradas y que no acudieron a su fecha programada de vacuna pudiendo especificar 
-- si es para cualquier fase o para alguna fase en particular.
DELIMITER $$
DROP PROCEDURE IF EXISTS ESCRIBE_REPORTE_4$$
CREATE PROCEDURE `ESCRIBE_REPORTE_4`(IN p_id_dosis_recibida INT)
BEGIN
    SELECT `vista_personas`.*,
    `vista_seguimientos`.* 
    FROM `vista_seguimientos`
    INNER JOIN `vista_personas` ON `vista_personas`.`CUI`=`vista_seguimientos`.`CUI`
    INNER JOIN `tipos_dosis` ON `tipos_dosis`.`dosis_recibida`=`vista_seguimientos`.`Dosis`
    WHERE `Fecha de Dosis`<CURDATE() AND `id_dosis_recibida`=p_id_dosis_recibida
    ORDER BY `vista_personas`.`CUI` ASC
    INTO OUTFILE 'C:/Users/Dylan/Downloads/personas-sin-vacunar-segun-fase.csv'
    FIELDS TERMINATED BY ','
    LINES TERMINATED BY '\n';
END;$$
DELIMITER ;

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
-- Devuelve la cantidad de vacunas disponibles por centro de vacunacion. 
--

DELIMITER $$
DROP FUNCTION IF EXISTS STOCK$$
CREATE FUNCTION STOCK(p_cant_vacunas INT)
RETURNS INT(11)
BEGIN
    DECLARE vacunas_aplicadas, vacunas_restantes INT;
    SELECT COUNT(*) INTO vacunas_aplicadas 
    FROM `vista_seguimientos` 
    INNER JOIN `centros_vacunacion` ON `centros_vacunacion`.`centro`=`vista_seguimientos`.`Centro`
    SET vacunas_restantes = vacunas_restantes - vacunas_aplicadas;
    RETURN vacunas_restantes;
END;$$
DELIMITER ;

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
`personas`.`registrado` AS `Registrado`,
`personas`.`telefono` AS `Telefono`,
`personas`.`email` AS `Email`
FROM `personas`
INNER JOIN `sexos` ON `sexos`.`id_sexo`=`personas`.`id_sexo`
INNER JOIN `oficiosxpersona` ON `oficiosxpersona`.`cui`=`personas`.`cui`
INNER JOIN `enfermedadesxpersona` ON `enfermedadesxpersona`.`cui`=`personas`.`cui`
INNER JOIN `oficios` ON `oficios`.`id_oficio`=`oficiosxpersona`.`id_oficio`
INNER JOIN `enfermedades` ON `enfermedades`.`id_enfermedad`=`enfermedadesxpersona`.`id_enfermedad`
WHERE `personas`.`registrado`=TRUE
ORDER BY `personas`.`cui`;$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Vistas para ver adecuadamente el CRUD de usuarios.
--

DELIMITER $$
DROP VIEW IF EXISTS CRUD_USUARIOS$$
CREATE VIEW CRUD_USUARIOS AS
SELECT `personas_registradas`.*,
`perfiles`.`perfil` AS `Perfil`
FROM `personas_registradas`
INNER JOIN `usuarios` ON `usuarios`.`cui`=`personas_registradas`.`CUI`
INNER JOIN `perfiles` ON `perfiles`.`id_perfil`=`usuarios`.`id_perfil`;$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Vista para ver adecuadamente los datos de las personas con su fecha de vacunacion establecida.
--

DELIMITER $$
DROP VIEW IF EXISTS FECHAS_VACUNACION$$
CREATE VIEW FECHAS_VACUNACION AS
SELECT `personas`.`cui` AS `CUI`,
FULLNAME(`personas`.`cui`) AS `Nombre Completo`,
`personas`.`fecha_nacimiento` AS `Fecha de Nacimiento`,
`oficios`.`oficio` AS `Oficio`,
`enfermedades`.`enfermedad` AS `Enfermedad`,
`seguimientos_persona`.`id_seguimiento` AS `Codigo Seguimiento`,
`seguimientos_persona`.`fecha_vacunacion` AS `Fecha Vacunacion`
FROM `seguimientos_persona`
INNER JOIN `registrosxpersona` ON `registrosxpersona`.`id_seguimiento`=`seguimientos_persona`.`id_seguimiento` 
INNER JOIN `personas` ON `personas`.`cui`=`registrosxpersona`.`cui`
INNER JOIN `oficiosxpersona` ON `oficiosxpersona`.`cui`=`personas`.`cui`
INNER JOIN `enfermedadesxpersona` ON `enfermedadesxpersona`.`cui`=`personas`.`cui`
INNER JOIN `oficios` ON `oficios`.`id_oficio`=`oficiosxpersona`.`id_oficio`
INNER JOIN `enfermedades` ON `enfermedades`.`id_enfermedad`=`enfermedadesxpersona`.`id_enfermedad`
WHERE NOT `seguimientos_persona`.`fecha_vacunacion`=''
ORDER BY `personas`.`cui`;$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Vista para ver adecuadamente los seguimientos de vacunacion de las personas.
--

DELIMITER $$
DROP VIEW IF EXISTS VISTA_SEGUIMIENTOS$$
CREATE VIEW VISTA_SEGUIMIENTOS AS
SELECT `registrosxpersona`.`cui` AS `CUI`,
`seguimientos_persona`.`id_seguimiento` AS `Seguimiento`,
`seguimientos_persona`.`vacunado_extranjero` AS `Vacunacion Extranjera`,
`seguimientos_persona`.`fecha_vacunacion` AS `Fecha de Vacunacion`,
`centros_vacunacion`.`centro` AS `Centro`,
`vacunas`.`vacuna` AS `Vacuna`,
`tipos_dosis`.`dosis_recibida` AS `Dosis`,
`dosis`.`fecha_dosis` AS `Fecha de Dosis`
FROM `seguimientos_persona`
INNER JOIN `registrosxpersona` ON `registrosxpersona`.`id_seguimiento`=`seguimientos_persona`.`id_seguimiento`
INNER JOIN `centrosxseguimiento` ON `centrosxseguimiento`.`id_seguimiento`=`seguimientos_persona`.`id_seguimiento`
INNER JOIN `vacunasxseguimiento` ON `vacunasxseguimiento`.`id_seguimiento`=`seguimientos_persona`.`id_seguimiento`
INNER JOIN `dosisxseguimiento` ON `dosisxseguimiento`.`id_seguimiento`=`seguimientos_persona`.`id_seguimiento`
INNER JOIN `dosis` ON `dosis`.`id_dosis`=`dosisxseguimiento`.`id_dosis`
INNER JOIN `centros_vacunacion` ON `centros_vacunacion`.`id_centro`=`centrosxseguimiento`.`id_centro`
INNER JOIN `vacunas` ON `vacunas`.`id_vacuna`=`vacunasxseguimiento`.`id_vacuna`
INNER JOIN `tipos_dosis` ON `tipos_dosis`.`id_dosis_recibida`=`dosis`.`id_dosis_recibida`
ORDER BY `registrosxpersona`.`cui`;$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Vistas para ver adecuadamente el historial del proceso de vacunacion de las personas.
--

DELIMITER $$
DROP VIEW IF EXISTS DOSIS_EXTENDIDO$$
CREATE VIEW DOSIS_EXTENDIDO AS
SELECT `dosisxseguimiento`.*,
    CASE WHEN `dosis`.`id_dosis_recibida` = '1' THEN `dosis`.`fecha_dosis` END AS 'inscrito',
    CASE WHEN `dosis`.`id_dosis_recibida` = '2' THEN `dosis`.`fecha_dosis` END AS 'primera_dosis',
    CASE WHEN `dosis`.`id_dosis_recibida` = '3' THEN `dosis`.`fecha_dosis` END AS 'segunda_dosis',
    CASE WHEN `dosis`.`id_dosis_recibida` = '4' THEN `dosis`.`fecha_dosis` END AS 'tercera_dosis',
    CASE WHEN `dosis`.`id_dosis_recibida` = '5' THEN `dosis`.`fecha_dosis` END AS 'completado'
FROM `dosisxseguimiento`
INNER JOIN `dosis` ON `dosis`.`id_dosis`=`dosisxseguimiento`.`id_dosis`
INNER JOIN `registrosxpersona` ON `registrosxpersona`.`id_seguimiento`=`dosisxseguimiento`.`id_seguimiento`
ORDER BY `registrosxpersona`.`cui`;$$

DROP VIEW IF EXISTS DOSIS_RECIBIDA_PIVOTE$$
CREATE VIEW DOSIS_RECIBIDA_PIVOTE AS
SELECT `T`.`id_seguimiento`,
    MAX(`inscrito`) AS 'Inscrito',
    MAX(`primera_dosis`) AS 'Primera_dosis',
    MAX(`segunda_dosis`) AS 'Segunda_dosis',
    MAX(`tercera_dosis`) AS 'Tercera_dosis',
    MAX(`completado`) AS 'Completado'
FROM `dosis_extendido` AS T
INNER JOIN `registrosxpersona` ON `registrosxpersona`.`id_seguimiento`=`T`.`id_seguimiento`
GROUP BY `T`.`id_seguimiento`
ORDER BY `registrosxpersona`.`cui`;$$

DROP VIEW IF EXISTS VISTA_HISTORIAL$$
CREATE VIEW VISTA_HISTORIAL AS
SELECT `TT`.`id_seguimiento`,
    COALESCE(`Inscrito`, "0000-00-00 00:00:00") as "Inscrito",
    COALESCE(`Primera_dosis`, "0000-00-00 00:00:00") as "Primera Dosis",
    COALESCE(`Segunda_dosis`, "0000-00-00 00:00:00") as "Segunda Dosis",
    COALESCE(`Tercera_dosis`, "0000-00-00 00:00:00") as "Tercera Dosis",
    COALESCE(`Completado`, "0000-00-00 00:00:00") as "Completado"
FROM `dosis_recibida_pivote` AS TT;$$
DELIMITER ;

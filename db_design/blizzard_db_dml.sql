-- Cortois Bert
-- 25 september 2014

-- -------------------------------------- INSERT PROCEDURES ----------------------------------
-- Stored procedure insert voor de tabel form

USE blizzard_db;

DROP PROCEDURE IF EXISTS FieldTypeInsert;

DELIMITER //
CREATE PROCEDURE `FieldTypeInsert`
(
	IN pName NVARCHAR (15)
)
BEGIN
INSERT INTO `field_type`
	(
		`field_type`.`field_type_name`
	)
	VALUES
	(
		pName
	);
END //
DELIMITER ;


-- Stored procedure insert voor de tabel event

USE blizzard_db;

DROP PROCEDURE IF EXISTS EventInsert;

DELIMITER //
CREATE PROCEDURE `EventInsert`
(
	OUT pId INT ,
	IN pName NVARCHAR (35) ,
	IN pDescription TEXT ,
	IN pDate DATETIME ,
	IN pImage MEDIUMBLOB ,
    IN pValidated TINYINT ,
    IN pShiftsLink TEXT ,
    IN pLocationName NVARCHAR (40) ,
    IN pLocationAddress NVARCHAR (100) ,
    IN pLocationCoordinates NVARCHAR (45)
    
)
BEGIN
INSERT INTO `event`
	(
		`event`.`event_name`,
		`event`.`event_description`,
		`event`.`event_date`,
		`event`.`event_image`,
		`event`.`event_validated`,
		`event`.`event_shifts_link`,
		`event`.`event_location_name`,
		`event`.`event_location_address`,
		`event`.`event_location_coordinates`
	)
	VALUES
	(
		pName,
		pDescription,
		pDate,
		pImage,
		pValidated,
		pShiftsLink,
		pLocationName,
		pLocationAddress,
		pLocationCoordinates
	);
	SELECT LAST_INSERT_ID() INTO pId;
END //
DELIMITER ;


-- Stored procedure insert voor de tabel form

USE blizzard_db;

DROP PROCEDURE IF EXISTS FormInsert;

DELIMITER //
CREATE PROCEDURE `FormInsert`
(
	OUT pId INT ,
	IN pName NVARCHAR (45) ,
	IN pEventId INT
    
)
BEGIN
INSERT INTO `form`
	(
		`form`.`form_name`,
		`form`.`fk_event_id`
	)
	VALUES
	(
		pName,
		pEventId
	);
	SELECT LAST_INSERT_ID() INTO pId;
END //
DELIMITER ;


-- Stored procedure insert voor de tabel inputfield

USE blizzard_db;

DROP PROCEDURE IF EXISTS InputFieldInsert;

DELIMITER //
CREATE PROCEDURE `InputFieldInsert`
(
	OUT pId INT ,
	IN pName NVARCHAR (25) ,
	IN pComment TEXT ,
	IN pPosition INT ,
	IN pFieldTypeName NVARCHAR(15) ,
    IN pFormId INT
    
)
BEGIN
INSERT INTO `input_field`
	(
		`input_field`.`input_field_name`,
		`input_field`.`input_field_comment`,
		`input_field`.`input_field_position`,
		`input_field`.`fk_field_type_name`,
		`input_field`.`fk_form_id`
	)
	VALUES
	(
		pName,
		pComment,
		pPosition,
		pFieldTypeName,
		pFormId
	);
	SELECT LAST_INSERT_ID() INTO pId;
END //
DELIMITER ;


-- -------------------------------------- SELECT ALL PROCEDURES ----------------------------------

-- Stored procedure select all voor de tabel event
USE blizzard_db;
DROP PROCEDURE IF EXISTS FieldTypeSelectAll;
DELIMITER //
CREATE PROCEDURE `FieldTypeSelectAll`
(
)
BEGIN
SELECT `field_type`.*
	FROM `field_type`
;
END //
DELIMITER ;

-- Stored procedure select all voor de tabel event
USE blizzard_db;
DROP PROCEDURE IF EXISTS EventSelectAll;
DELIMITER //
CREATE PROCEDURE `EventSelectAll`
(
)
BEGIN
SELECT `event`.*
	FROM `event`
;
END //
DELIMITER ;

-- Stored procedure select all voor de tabel form
USE blizzard_db;
DROP PROCEDURE IF EXISTS FormSelectAll;
DELIMITER //
CREATE PROCEDURE `FormSelectAll`
(
)
BEGIN
SELECT `form`.*
	FROM `form`
;
END //
DELIMITER ;

-- Stored procedure select all voor de tabel event
USE blizzard_db;
DROP PROCEDURE IF EXISTS InputFieldSelectAll;
DELIMITER //
CREATE PROCEDURE `InputFieldSelectAll`
(
)
BEGIN
SELECT `input_field`.*
	FROM `input_field`
;
END //
DELIMITER ;


-- -------------------------------------- SELECT ONE PROCEDURES ----------------------------------

-- Stored procedure select one voor de tabel field_type
USE blizzard_db;
DROP PROCEDURE IF EXISTS FieldTypeSelectByName;
DELIMITER //
CREATE PROCEDURE `FieldTypeSelectByName`
(
	 pName INT 
)
BEGIN
SELECT `field_type`.`field_type_name`

	FROM `field_type`
	WHERE `field_type`.`field_type_name` = pName;
END //
DELIMITER ;
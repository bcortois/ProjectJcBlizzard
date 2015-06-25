-- Cortois Bert
-- 25 september 2014

-- -------------------------------------- INSERT PROCEDURES ----------------------------------
-- Stored procedure insert for table form

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


-- Stored procedure insert for table event

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


-- Stored procedure insert for table form

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


-- Stored procedure insert for table inputfield

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

-- Stored procedure insert for table subscriber

USE blizzard_db;

DROP PROCEDURE IF EXISTS SubscriberInsert;

DELIMITER //
CREATE PROCEDURE `SubscriberInsert`
(
	OUT pId INT ,
	IN pFormId INT
)
BEGIN
INSERT INTO `subscriber`
	(
		`subscriber`.`fk_form_id`
	)
	VALUES
	(
		pFormId
	);
    SELECT LAST_INSERT_ID() INTO pId;
END //
DELIMITER ;

-- Stored procedure insert for table data

USE blizzard_db;

DROP PROCEDURE IF EXISTS DataInsert;

DELIMITER //
CREATE PROCEDURE `DataInsert`
(
	OUT pId INT ,
	IN pValue NVARCHAR (100) ,
	IN pInputFieldId INT,
    IN pSubscriberId INT
    
)
BEGIN
INSERT INTO `data`
	(
		`data`.`data_value`,
		`data`.`fk_input_field_id`,
        `data`.`fk_subscriber_id`
	)
	VALUES
	(
		pValue,
		pInputFieldId,
        pSubscriberId
	);
	SELECT LAST_INSERT_ID() INTO pId;
END //
DELIMITER ;

-- -------------------------------------- SELECT ALL PROCEDURES ----------------------------------

-- Stored procedure select all for table field_type
USE blizzard_db;
DROP PROCEDURE IF EXISTS FieldTypeSelectAll;
DELIMITER //
CREATE PROCEDURE `FieldTypeSelectAll`
(
)
BEGIN
SELECT `field_type`.`field_type_name`
	FROM `field_type`
;
END //
DELIMITER ;

-- Stored procedure select all for table event
USE blizzard_db;
DROP PROCEDURE IF EXISTS EventSelectAll;
DELIMITER //
CREATE PROCEDURE `EventSelectAll`
(
)
BEGIN
SELECT `event`.`event_id`, `event`.`event_name`, `event`.`event_date`
	FROM `event`
;
END //
DELIMITER ;

-- -------------------------------------- SELECT ONE PROCEDURES ----------------------------------

-- Stored procedure select one by id for table form
USE blizzard_db;
DROP PROCEDURE IF EXISTS EventSelectOneById;
DELIMITER //
CREATE PROCEDURE `EventSelectOneById`
(
	IN pId INT
)
BEGIN
SELECT `event`.*, `form`.`form_id`, `form`.`form_name`
	FROM `event`
    LEFT JOIN `form`
    ON `event`.`event_id` = `form`.`fk_event_id`
    WHERE `event`.`event_id` = pId
;
END //
DELIMITER ;

-- Stored procedure select all by event id for table form
USE blizzard_db;
DROP PROCEDURE IF EXISTS FormSelectOneById;
DELIMITER //
CREATE PROCEDURE `FormSelectOneById`
(
	IN pId INT
)
BEGIN
SELECT `form`.*, `input_field`.*
	FROM `form`
    LEFT JOIN `input_field`
    ON `form`.`form_id` = `input_field`.`fk_form_id`
    WHERE `form`.`form_id` = pId
;
END //
DELIMITER ;

-- -------------------------------------- SELECT ALL BY PROCEDURES ----------------------------------

-- Stored procedure select all by form id for tabel input_field
USE blizzard_db;
DROP PROCEDURE IF EXISTS InputFieldSelectAllByFormId;
DELIMITER //
CREATE PROCEDURE `InputFieldSelectAllByFormId`
(
	IN pId INT
)
BEGIN
SELECT `input_field`.*
	FROM `input_field`
    WHERE `input_field`.`fk_form_id` = pId
;
END //
DELIMITER ;

-- Stored procedure select all by subscriber id for tabel data
USE blizzard_db;
DROP PROCEDURE IF EXISTS DataSelectAllBySubscriberId;
DELIMITER //
CREATE PROCEDURE `DataSelectAllBySubscriberId`
(
	IN pId INT
)
BEGIN
SELECT `data`.*
	FROM `data`
    WHERE `data`.`fk_subscriber_id` = pId
;
END //
DELIMITER ;

-- Stored procedure select all by form id for tabel subscriber
USE blizzard_db;
DROP PROCEDURE IF EXISTS SubscriberSelectAllByFormId;
DELIMITER //
CREATE PROCEDURE `SubscriberSelectAllByFormId`
(
	IN pId INT
)
BEGIN
SELECT `subscriber`.*
	FROM `subscriber`
    WHERE `subscriber`.`fk_form_id` = pId
;
END //
DELIMITER ;
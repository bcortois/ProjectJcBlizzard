USE blizzard_db;

SET @idevent = 0;
SET @idform = 0;
SET @idinputfield = 0;

CALL EventInsert(@idevent,'testEvent','Beschrijving van Event', NOW(), NULL, 1, 'www.shift.com', 'locationname', 'locationaddress', 'coordinates');
CALL FormInsert(@idform,'testForm',@idevent);
CALL FieldTypeInsert('checkbox');
CALL InputFieldInsert(@idinputfield,'testInputField','Comment van InputField', 1, 'checkbox', @idform);


CALL InputFieldSelectAll();
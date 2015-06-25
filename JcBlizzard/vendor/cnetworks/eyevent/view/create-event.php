<?php
require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
$feedback = new \CNetworks\Helpers\Bll\Feedback();
$controller = new \CNetworks\EyeVent\Controller($feedback);
$controller->initRequestScanner();
?>
<HTML>
<HEAD>
    <TITLE></TITLE>
</HEAD>
<BODY>
    <FORM name="event-form" id="event-form" method="post">
        <div>
            <h1>Evenement</h1>
        </div>
        <div>
            <label id="event-name">Titel van het evenement: </label>
            <input type="text" id="event-name" name="event-name" />
        </div>
        <div>
            <label id="event-description">Omschrijving van het evenement: </label>
            <input type="text" id="event-description" name="event-description" />
        </div>
        <div>
            <label id="event-date">datum van het evenement: </label>
            <input type="text" id="event-date" name="event-date" />
        </div>
        <div>
            <label id="event-shifts-link">shifts-link van het evenement: </label>
            <input type="text" id="event-shifts-link" name="event-shifts-link" />
        </div>
        <div>
            <label id="event-location-name">location-name van het evenement: </label>
            <input type="text" id="event-location-name" name="event-location-name" />
        </div>
        <div>
            <label id="event-location-address">location-address van het evenement: </label>
            <input type="text" id="event-location-address" name="event-location-address" />
        </div>
        <div>
            <label id="event-location-coordinates">location-coordinates van het evenement: </label>
            <input type="text" id="event-location-coordinates" name="event-location-coordinates" />
        </div>
        <div>
            <h1>Formulier</h1>
        </div>
        <div>
            <label id="form-name">Naam van het formulier: </label>
            <input type="text" id="form-name" name="form-name" />
        </div>
        <div id="create-form-input-fields">
            <input type="text" id="input-field-names" name="input-field-names" value="" hidden="hidden" \>
            <div>
                <label id="input-field-name-1">Naam van het veld: </label>
                <input type="text" id="input-field-name-1" name="input-field-name-1" />
                <label id="input-field-comment-1">Commentaar: </label>
                <input type="text" id="input-field-comment-1" name="input-field-comment-1" />
                <label id="input-field-position-1">Volgorde: </label>
                <input type="text" id="input-field-position-1" name="input-field-position-1" />
                <label id="input-field-type-1">Type veld: </label>
                <select id="input-field-type-1" name="input-field-type-1">
                    <option value="text">text</option>
                    <option value="checkbox">checkbox</option>
                </select>
                <input type="button" id="create-form-delete-field-1" value="x"/>
            </div>
        </div>
        <div>
            <input type="button" id="create-form-add-field" value="+"/>
        </div>
        <div>
            <button type="submit" name="action" value="add-event"">Save</button>
        </div>
    </FORM>
    <script src="../js/cnetworks.create-event-0.1.js"></script>
<?php
print_r($feedback);
?>
</BODY>
</HTML>

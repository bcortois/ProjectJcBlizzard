<?php
require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';
$feedback = new \CNetworks\Helpers\Bll\Feedback();
$logBook = new \CNetworks\Helpers\Bll\LogBook();
$connector = new \CNetworks\Helpers\Dal\Connector("localhost","3306","blizzard_db","root","v0xL1d57", $logBook, $feedback);
$model = new \CNetworks\EyeVent\Model\Event($connector, $logBook, $feedback);
$formModel = new \CNetworks\EyeVent\Model\Form($connector, $logBook, $feedback);
$controller = new \CNetworks\EyeVent\Controller($feedback);
$controller->initRequestScanner();
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $event = $model->loadOne($id);
}
?>
<HTML>
<HEAD>
    <TITLE></TITLE>
</HEAD>
<BODY>
<FORM method="post">
    <div>
        <h1>Evenement</h1>
    </div>
    <div>
        <label id="event-name">Titel van het evenement: </label>
        <input type="text" id="event-name" name="event-name" value="<?php if (isset($_GET['id'])) { echo $event->getName(); } ?>" />
    </div>
    <div>
        <label id="event-description">Omschrijving van het evenement: </label>
        <input type="text" id="event-description" name="event-description" value="<?php if (isset($_GET['id'])) { echo $event->getDescription(); } ?>"/>
    </div>
    <div>
        <label id="event-date">datum van het evenement: </label>
        <input type="text" id="event-date" name="event-date" value="<?php if (isset($_GET['id'])) { echo $event->getDate(); } ?>"/>
    </div>
    <div>
        <label id="event-shifts-link">shifts-link van het evenement: </label>
        <input type="text" id="event-shifts-link" name="event-shifts-link" value="<?php if (isset($_GET['id'])) { echo $event->getShiftsLink(); } ?>" />
    </div>
    <div>
        <label id="event-location-name">location-name van het evenement: </label>
        <input type="text" id="event-location-name" name="event-location-name" value="<?php if (isset($_GET['id'])) { echo $event->getLocationName(); } ?>" />
    </div>
    <div>
        <label id="event-location-address">location-address van het evenement: </label>
        <input type="text" id="event-location-address" name="event-location-address" value="<?php if (isset($_GET['id'])) { echo $event->getLocationAddress(); } ?>" />
    </div>
    <div>
        <label id="event-location-coordinates">location-coordinates van het evenement: </label>
        <input type="text" id="event-location-coordinates" name="event-location-coordinates" value="<?php if (isset($_GET['id'])) { echo $event->getLocationCoordinates(); } ?>" />
    </div>
    <div>
        <h1>Formulier</h1>
    </div>
    <div>
        <label>Naam: </label>
        <a href="form.php?id=<?php if (isset($_GET['id'])) { echo $event->getForm()->getId(); } ?>"><?php if (isset($_GET['id'])) { echo $event->getForm()->getName(); } ?></a>
    </div>
    <div>
        <button type="submit" name="action" value="add-event">Save</button>
    </div>
</FORM>
<?php
print_r($feedback);
?>
</BODY>
</HTML>
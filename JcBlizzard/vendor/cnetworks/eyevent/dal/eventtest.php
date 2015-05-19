<?php
define('VENDOR_PATH', $_SERVER['DOCUMENT_ROOT'] . '/vendor/cnetworks');
define('APP_PATH', VENDOR_PATH . '/eyevent');
ini_alter('date.timezone','Europe/Brussels');

require 'Event.php';
require APP_PATH . '/bll/Event.php';
require VENDOR_PATH . '/helpers/bll/Log.php';

$connection = 0;
$log = new \CNetworks\Helpers\Bll\Log();
$event = new \CNetworks\EyeVent\Bll\Event();
$daEvent = new \CNetworks\EyeVent\Dal\Event($event, $connection, $log);

$event->setName('phpevent');
$event->setDescription('phpdescription');
$event->setDate('2015-05-19 21:00:00');
$event->setImage(NULL);
$event->setValidated(FALSE);
$event->setShiftsLink('www.shift.php.com');
$event->setLocationName('Jc Blizzard');
$event->setLocationAddress('Van Assestraat 10, 1820 Melsbroek');
$event->setLocationCoordinates('89.89903928993993,190.23374663823');
$daEvent->setEvent($event);
$daEvent->insert();

print_r($log->getLogBook());

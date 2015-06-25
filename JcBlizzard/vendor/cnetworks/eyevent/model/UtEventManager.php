<?php
ini_alter('date.timezone','Europe/Brussels');

require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

$logBook = new \CNetworks\Helpers\Bll\LogBook();
$feedback = new \CNetworks\Helpers\Bll\Feedback();
$connector = new \CNetworks\Helpers\Dal\Connector("localhost","3306","blizzard_db","root","v0xL1d57", $logBook, $feedback);
$eventModel = new \CNetworks\EyeVent\Model\EventManager($connector, $logBook, $feedback);
$inputFieldList = Array(Array('testManagerInputF', 'testManagerInputFC', 4, 'text'),
    Array('testManagerInputF', 'testManagerInputFC', 4, 'text'),
    Array('testManagerInputF', 'testManagerInputFC', 4, 'text'),
    Array('testManagerInputF', 'testManagerInputFC', 4, 'text'),
    Array('testManagerInputF', 'testManagerInputFC', 4, 'text'));

$eventModel->createEvent('testManager', 'testManagerDescription', '2015-05-19 21:00:00', null, 'testManagerLink',
    'testManagerLocation', 'testManegerAddress', '89.89903928993993,190.23374663823', 'testManagerForm', $inputFieldList);


print_r($feedback);
include $_SERVER['DOCUMENT_ROOT'] . '/vendor/cnetworks/helpers/view/log-report.html';
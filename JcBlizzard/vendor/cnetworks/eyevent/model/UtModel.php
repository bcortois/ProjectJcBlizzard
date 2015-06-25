<?php
ini_alter('date.timezone','Europe/Brussels');

require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

$logBook = new \CNetworks\Helpers\Bll\LogBook();
$feedback = new \CNetworks\Helpers\Bll\Feedback();
$connector = new \CNetworks\Helpers\Dal\Connector("localhost","3306","blizzard_db","root","v0xL1d57", $logBook, $feedback);
$model = new \CNetworks\EyeVent\Model\Model($connector, $logBook, $feedback);

print_r($model->loadFormContent(39));
print_r($feedback);
//include $_SERVER['DOCUMENT_ROOT'] . '/vendor/cnetworks/helpers/view/log-report.html';

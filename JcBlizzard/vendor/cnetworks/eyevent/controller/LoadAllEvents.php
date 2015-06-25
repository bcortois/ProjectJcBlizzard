<?php
/**
 * Created by PhpStorm.
 * User: bert
 * Date: 22/06/2015
 * Time: 9:48
 */
require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

$feedback = new \CNetworks\Helpers\Bll\Feedback();
$controller = new \CNetworks\EyeVent\Controller\Controller($feedback);
$controller->initEventModel();
$model = $controller->getModel();
$eventJson = Array();
foreach($model->loadAllEvent() as $entity) {
    $eventJson[] = $entity->jsonSerialize();
}
echo json_encode($eventJson);
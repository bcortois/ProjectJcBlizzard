<?php
/**
 * Created by PhpStorm.
 * User: bert
 * Date: 24/06/2015
 * Time: 18:36
 */
require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

$feedback = new \CNetworks\Helpers\Bll\Feedback();
$controller = new \CNetworks\EyeVent\Controller\Controller($feedback);
$controller->initEventModel();
$model = $controller->getModel();
echo json_encode($model->loadOneEvent($_GET['id'])->jsonSerialize());
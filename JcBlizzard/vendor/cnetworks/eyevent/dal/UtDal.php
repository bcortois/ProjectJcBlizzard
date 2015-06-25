<?php
ini_alter('date.timezone','Europe/Brussels');

require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

$event = new \CNetworks\EyeVent\Bll\Event();
$form = new \CNetworks\EyeVent\Bll\Form();
$fieldType = new \CNetworks\EyeVent\Bll\FieldType();
$inputField = new \CNetworks\EyeVent\Bll\InputField();
$subscriber = new \CNetworks\EyeVent\Bll\Subscriber();
$data = new CNetworks\EyeVent\Bll\Data();
$logBook = new \CNetworks\Helpers\Bll\LogBook();
$feedback = new CNetworks\Helpers\Bll\Feedback();
$connector = new \CNetworks\Helpers\Dal\Connector("localhost","3306","blizzard_db","root","v0xL1d57", $logBook, $feedback);
$daEvent = new \CNetworks\EyeVent\Dal\Event($connector, $logBook, $feedback);
$daForm = new \CNetworks\EyeVent\Dal\Form($connector, $logBook, $feedback);
$daFieldType = new \CNetworks\EyeVent\Dal\FieldType($connector, $logBook, $feedback);
$daInputField = new \CNetworks\EyeVent\Dal\InputField($connector, $logBook, $feedback);
$daSubscriber = new \CNetworks\EyeVent\Dal\Subscriber($connector, $logBook, $feedback);
$daData = new \CNetworks\EyeVent\Dal\Data($connector, $logBook, $feedback);

$event->setName('datetest');
$event->setDescription('phpdescription');
$event->setDate('2015-5-19 21:00:00');
$event->setImage(NULL);
$event->setValidated(FALSE);
$event->setShiftsLink('www.shift.php.com');
$event->setLocationName('Jc Blizzard');
$event->setLocationAddress('Van Assestraat 10, 1820 Melsbroek');
$event->setLocationCoordinates('89.89903928993993,190.23374663823');
$daEvent->insert($event);
if ($feedback->getIsError()) {
    echo $feedback->getResult() . "\r\n";
}
//$form->setName('phpform');
//$form->setEventId($event->getId());
//$daForm->insert($form);
//if ($feedback->getIsError()) {
//    echo $feedback->getResult() . "\r\n";
//}
//$fieldType->setName('text');
//$daFieldType->insert($fieldType);
//if ($feedback->getIsError()) {
//    echo $feedback->getResult() . "\r\n";
//}
//$inputField->setName('Naam');
//$inputField->setComment('commentaar');
//$inputField->setFieldTypeName($fieldType->getName());
//$inputField->setPosition(1);
//$inputField->setFormId($form->getId());
//$daInputField->insert($inputField);
//if ($feedback->getIsError())
//{
//    echo $feedback->getResult() . "\r\n";
//}
//$subscriber->setFormId($form->getId());
//$daSubscriber->insert($subscriber);
//if ($feedback->getIsError()) {
//    echo $feedback->getResult() . "\r\n";
//}
//$data->setValue('Bert Cortois');
//$data->setInputFieldId($inputField->getId());
//$data->setSubscriberId($subscriber->getId());
//$daData->insert($data);
//if ($feedback->getIsError()) {
//    echo $feedback->getResult() . "\r\n";
//}
//
////if($result = $daSubscriber->selectAllByFormId($form->getId())) {
////    print_r($result);
////}
//
//foreach ($daEvent->selectAll() as $event)
//{
//    print_r($event);
//}
//
//print_r($daInputField->selectAllByFormId(39));

include $_SERVER['DOCUMENT_ROOT'] . '/vendor/cnetworks/helpers/view/error-report.html';
<?php
ini_alter('date.timezone','Europe/Brussels');

require $_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php';

$event = new \CNetworks\EyeVent\Bll\Event();
$form = new \CNetworks\EyeVent\Bll\Form();
$fieldType = new \CNetworks\EyeVent\Bll\FieldType();
$inputField = new \CNetworks\EyeVent\Bll\InputField();
$subscriber = new \CNetworks\EyeVent\Bll\Subscriber();
$logBook = new \CNetworks\Helpers\Bll\LogBook();
$feedback = new CNetworks\Helpers\Bll\Feedback();
$connector = new \CNetworks\Helpers\Dal\Connector("localhost","3306","blizzard_db","root","v0xL1d57", $logBook, $feedback);
$daEvent = new \CNetworks\EyeVent\Dal\Event($event, $connector, $logBook, $feedback);
$daForm = new \CNetworks\EyeVent\Dal\Form($form, $connector, $logBook, $feedback);
$daFieldType = new \CNetworks\EyeVent\Dal\FieldType($fieldType, $connector, $logBook, $feedback);
$daInputField = new \CNetworks\EyeVent\Dal\InputField($inputField, $connector, $logBook, $feedback);
$daSubscriber = new \CNetworks\EyeVent\Dal\Subscriber($subscriber, $connector, $logBook, $feedback);

$event->setName('phpevent');
$event->setDescription('phpdescription');
$event->setDate('2015-05-19 21:00:00');
$event->setImage(NULL);
$event->setValidated(FALSE);
$event->setShiftsLink('www.shift.php.com');
$event->setLocationName('Jc Blizzard');
$event->setLocationAddress('Van Assestraat 10, 1820 Melsbroek');
$event->setLocationCoordinates('89.89903928993993,190.23374663823');
$daEvent->insert();
if ($feedback->getIsError())
{
    echo $feedback->getResult();
}
$form->setName('phpform');
$form->setEventId($event->getId());
$daForm->insert();
if ($feedback->getIsError())
{
    echo $feedback->getResult();
}
$fieldType->setName('Checkbox');
$daFieldType->insert();
if ($feedback->getIsError())
{
    echo $feedback->getResult();
}
$inputField->setName('Naam');
$inputField->setComment('commentaar');
$inputField->setFieldTypeName($fieldType->getName());
$inputField->setPosition(1);
$inputField->setFormId($form->getId());
$daInputField->insert();
if ($feedback->getIsError())
{
    echo $feedback->getResult();
}
$subscriber->setFormId($form->getId());
$daSubscriber->insert();
if ($feedback->getIsError())
{
    echo $feedback->getResult();
}

include $_SERVER['DOCUMENT_ROOT'] . '/vendor/cnetworks/helpers/view/log-report.html';
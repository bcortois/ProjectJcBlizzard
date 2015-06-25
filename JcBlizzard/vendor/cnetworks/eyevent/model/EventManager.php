<?php
/**
 * Created by PhpStorm.
 * User: bert
 * Date: 10/06/2015
 * Time: 11:29
 */

namespace CNetworks\EyeVent\Model;


class EventManager extends \CNetworks\EyeVent\Dal\Base{
    /**
     * Following properties are inherited from \CNetworks\EyeVent\Model\Base:
     * - $connector
     * - $logBook
     * - $feedback
     * - $dal
     * - $entity
     * - $list
     * Following methods are inherited from \CNetworks\EyeVent\Model\Base:
     * - resetList()
     * - initDal()
     * - initBll()
     */

    protected $bllEvent;
    protected $bllForm;
    protected $dalEvent;
    protected $dalForm;
    protected $dalInputField;

    public function initBll()
    {
        // If a bll object already exists than the method's code won't execute.
        if (!$this->bllEvent) {
            $this->bllEvent = new \CNetworks\EyeVent\Bll\Event();
        }
        if (!$this->bllForm) {
            $this->bllForm = new \CNetworks\EyeVent\Bll\Form();
        }
    }

    public function initDal()
    {
        // If a bll object already exists than the method's code won't execute.
        if (!$this->dalEvent) {
            $this->dalEvent = new \CNetworks\EyeVent\Dal\Event($this->connector, $this->logBook, $this->feedback);
        }
        if (!$this->dalForm) {
            $this->dalForm = new \CNetworks\EyeVent\Dal\Form($this->connector, $this->logBook, $this->feedback);
        }
        if (!$this->dalInputField) {
            $this->dalInputField = new \CNetworks\EyeVent\Dal\InputField($this->connector, $this->logBook, $this->feedback);
        }
    }
    public function loadAll()
    {
        $this->resetList();
        $this->initDal();
        foreach ($this->dal->selectAll() as $row)
        {
            $event = new \CNetworks\EyeVent\Bll\Event();
            $event->setId($row['event_id']);
            $event->setName($row['event_name']);
            $event->setDate($row['event_date']);
            $this->list[] = $event;
        }
        return $this->list;
    }

    public function loadOne($eventId)
    {
        $this->initDal();
        $this->initBll();
        $result = $this->dal->selectOneById($eventId);
        $this->entity->setId($result['event_id']);
        $this->entity->setName($result['event_name']);
        $this->entity->setDescription($result['event_description']);
        $this->entity->setDate($result['event_date']);
        $this->entity->setImage($result['event_image']);
        $this->entity->setValidated($result['event_validated']);
        $this->entity->setShiftsLink($result['event_shifts_link']);
        $this->entity->setLocationName($result['event_location_name']);
        $this->entity->setLocationAddress($result['event_location_address']);
        $this->entity->setLocationCoordinates($result['event_location_coordinates']);
        return $this->entity;
    }

    public function createEvent($eventName, $eventDescription, $eventDate, $eventImage, $eventShiftsLink,
                            $EventLocationName, $eventLocationAddress, $eventLocationCoordinates, $formName, $inputFieldList)
    {
        $this->initBll();
        $this->initDal();

        $this->bllEvent->setName($eventName);
        $this->bllEvent->setDescription($eventDescription);
        $this->bllEvent->setDate($eventDate);
        $this->bllEvent->setImage($eventImage);
        $this->bllEvent->setShiftsLink($eventShiftsLink);
        $this->bllEvent->setLocationName($EventLocationName);
        $this->bllEvent->setlocationAddress($eventLocationAddress);
        $this->bllEvent->setLocationCoordinates($eventLocationCoordinates);
        $this->dalEvent->insert($this->bllEvent);

        // This code wil execute if a form was create with the event.
        if($formName) {
            $this->bllForm->setName($formName);
            $this->bllForm->setEventId($this->bllEvent->getId());
            $this->dalForm->insert($this->bllForm);
        }

        // This code will execute if inputfields where added to the form.
        if ($inputFieldList) {
            foreach ($inputFieldList as $key => $inputField) {
                $bllInputField = new \CNetworks\EyeVent\Bll\InputField();
                $bllInputField->setName($inputField[0]);
                $bllInputField->setComment($inputField[1]);
                $bllInputField->setPosition($inputField[2]);
                $bllInputField->setFieldTypeName($inputField[3]);
                $bllInputField->setFormId($this->bllForm->getId());

                $this->dalInputField->insert($bllInputField);
            }
        }
    }
}
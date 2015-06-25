<?php
/**
 * Created by PhpStorm.
 * User: bert
 * Date: 11/06/2015
 * Time: 1:02
 */

namespace CNetworks\EyeVent\Model;


class Model extends Base {

    protected $boEvent;
    protected $boForm;
    protected $boInputFieldList;
    protected $boEventList;
    protected $daEvent;
    protected $daForm;
    protected $daInputField;

    protected function initDaEvent()
    {
        if (!isset($this->daEvent)) {
            $this->daEvent = new \CNetworks\EyeVent\Dal\Event($this->connector, $this->logBook, $this->feedback);
        }
    }

    protected function initDaForm()
    {
        if (!isset($this->daForm)) {
            $this->daForm = new \CNetworks\EyeVent\Dal\Form($this->connector, $this->logBook, $this->feedback);
        }
    }

    protected function initDaInputField()
    {
        if (!isset($this->daInputField)) {
            $this->daInputField = new \CNetworks\EyeVent\Dal\InputField($this->connector, $this->logBook, $this->feedback);
        }
    }

    protected function initBoEvent()
    {
        if (!isset($this->boEvent)) {
            $this->boEvent = new \CNetworks\EyeVent\Bll\Event();
        }
    }

    protected function initBoForm()
    {
        if (!isset($this->boForm)) {
            $this->boForm = new \CNetworks\EyeVent\Bll\Form();
        }
    }

    protected function initBoInputFieldList()
    {
        if (!isset($this->boInputFieldList)) {
            $this->boInputFieldList = Array();
        }
        else
        {
            unset($this->boInputFieldList);
            $this->boInputFieldList = Array();
        }
    }

    protected function initBoEventList()
    {
        if (!isset($this->boEventList)) {
            $this->boEventList = Array();
        }
        else
        {
            unset($this->boEventList);
            $this->boEventList = Array();
        }
    }

    public function getEventList()
    {
        return $this->boEventList;
    }

    public function loadAllEvent()
    {
        $this->initDaEvent();
        $this->initBoEventList();
        foreach ($this->daEvent->selectAll() as $row)
        {
            $this->boEventList[] = \CNetworks\EyeVent\Bll\Event::getInstance($row['event_id'],
                $row['event_name'],
                $row['event_date']);
        }
        return $this->boEventList;
    }

    public function loadOneEvent($eventId)
    {
        $this->initDaEvent();
        $this->initBoEvent();
        $this->initBoForm();

        $result = $this->daEvent->selectOneById($eventId);
        $this->boEvent->setId($result['event_id']);
        $this->boEvent->setName($result['event_name']);
        $this->boEvent->setDescription($result['event_description']);
        $this->boEvent->setDate($result['event_date']);
        $this->boEvent->setImage($result['event_image']);
        $this->boEvent->setValidated($result['event_validated']);
        $this->boEvent->setShiftsLink($result['event_shifts_link']);
        $this->boEvent->setLocationName($result['event_location_name']);
        $this->boEvent->setLocationAddress($result['event_location_address']);
        $this->boEvent->setLocationCoordinates($result['event_location_coordinates']);

        $this->boForm->setId($result['form_id']);
        $this->boForm->setName($result['form_name']);
        $this->boEvent->setform($this->boForm);
        return $this->boEvent;
    }

    public function loadFormContent($formId)
    {
        $this->initDaInputField();
        $this->initBoInputFieldList();
        foreach($this->daInputField->selectAllByFormId($formId) as $row) {
            $inputField = new \CNetworks\EyeVent\Bll\InputField();
            $inputField->setId($row['input_field_id']);
            $inputField->setName($row['input_field_name']);
            $inputField->setComment($row['input_field_comment']);
            $inputField->setPosition($row['input_field_position']);
            $inputField->setFieldTypeName($row['fk_field_type_name']);
            $inputField->setFormId($row['fk_form_id']);
            $this->boInputFieldList[] = $inputField;
        }
        return $this->boInputFieldList;
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

    public function createForm()
    {
        /**
         * This methode switches depending on the nummer of arguments. like create event
         * If only a form is passedthrough, then the function will call addEvent() from model.Event
         * Else it will add inputfield as well.
         */
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: bert
 * Date: 12/05/2015
 * Time: 10:03
 */

namespace CNetworks\EyeVent\Bll;


class Form implements \JsonSerializable {

    private $id;
    private $name;
    private $eventId;
    private $inputFields; // list of objects created from the inputField class.
    private $subscribers; // list of objects created from the subscriber class.

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getEventId()
    {
        return $this->eventId;
    }

    /**
     * @param mixed $eventId
     */
    public function setEventId($eventId)
    {
        $this->eventId = $eventId;
    }

    /**
     * @return mixed
     */
    public function getInputFields()
    {
        return $this->inputFields;
    }

    /**
     * @param mixed $inputFields
     */
    public function setInputFields($inputFields)
    {
        $this->inputFields = $inputFields;
    }

    /**
     * @return mixed
     */
    public function getSubscribers()
    {
        return $this->subscribers;
    }

    /**
     * @param mixed $subscribers
     */
    public function setSubscribers($subscribers)
    {
        $this->subscribers = $subscribers;
    }

    public function jsonSerialize() {
        return get_object_vars($this);
//        return [
//            "id" => $this->getId(),
//            "name" => $this->getName()
//        ];
    }
}
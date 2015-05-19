<?php
/**
 * Created by PhpStorm.
 * User: bert
 * Date: 11/05/2015
 * Time: 22:02
 */

namespace CNetworks\EyeVent\Bll;


class Event {

    private $id;
    private $name;
    private $description;
    private $date;
    private $image;
    private $validated;
    private $shiftsLink;
    private $locationName;
    private $locationAddress;
    private $locationCoordinates;
    private $form;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $eventId
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
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getValidated()
    {
        return $this->validated;
    }

    /**
     * @param mixed $validated
     */
    public function setValidated($validated)
    {
        $this->validated = $validated;
    }

    /**
     * @return mixed
     */
    public function getShiftsLink()
    {
        return $this->shiftsLink;
    }

    /**
     * @param mixed $shiftsLink
     */
    public function setShiftsLink($shiftsLink)
    {
        $this->shiftsLink = $shiftsLink;
    }

    /**
     * @return mixed
     */
    public function getLocationName()
    {
        return $this->locationName;
    }

    /**
     * @param mixed $locationName
     */
    public function setLocationName($locationName)
    {
        $this->locationName = $locationName;
    }

    /**
     * @return mixed
     */
    public function getLocationAddress()
    {
        return $this->locationAddress;
    }

    /**
     * @param mixed $locationAddress
     */
    public function setLocationAddress($locationAddress)
    {
        $this->locationAddress = $locationAddress;
    }

    /**
     * @return mixed
     */
    public function getLocationCoordinates()
    {
        return $this->locationCoordinates;
    }

    /**
     * @param mixed $locationCoordinates
     */
    public function setLocationCoordinates($locationCoordinates)
    {
        $this->locationCoordinates = $locationCoordinates;
    }

    /**
     * @return mixed
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * @param mixed $form
     */
    public function setForm($form)
    {
        $this->form = $form;
    }
}
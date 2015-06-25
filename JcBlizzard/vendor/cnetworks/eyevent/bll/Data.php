<?php
/**
 * Created by PhpStorm.
 * User: bert
 * Date: 12/05/2015
 * Time: 12:57
 */

namespace CNetworks\EyeVent\Bll;


class Data {

    private $id;
    private $value;
    private $inputFieldId;
    private $inputFieldName; // This property is used to store the name of the inputfield associated with this data object. (used in select queries)
    private $subscriberId;

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
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getInputFieldId()
    {
        return $this->inputFieldId;
    }

    /**
     * @param mixed $inputFieldId
     */
    public function setInputFieldId($inputFieldId)
    {
        $this->inputFieldId = $inputFieldId;
    }

    /**
     * @return mixed
     */
    public function getInputFieldName()
    {
        return $this->inputFieldName;
    }

    /**
     * @param mixed $inputFieldName
     */
    public function setInputFieldName($inputFieldName)
    {
        $this->inputFieldName = $inputFieldName;
    }

    /**
     * @return mixed
     */
    public function getSubscriberId()
    {
        return $this->subscriberId;
    }

    /**
     * @param mixed $subscriberId
     */
    public function setSubscriberId($subscriberId)
    {
        $this->subscriberId = $subscriberId;
    }


}
<?php
/**
 * Created by PhpStorm.
 * User: bert
 * Date: 12/05/2015
 * Time: 10:10
 */

namespace CNetworks\EyeVent\Bll;


class InputField {

    private $id;
    private $name;
    private $comment;
    private $position;
    private $fieldTypeName;
    private $formId;

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
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param mixed $comment
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    }

    /**
     * @return mixed
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     * @param mixed $position
     */
    public function setPosition($position)
    {
        $this->position = $position;
    }

    /**
     * @return mixed
     */
    public function getFieldTypeName()
    {
        return $this->fieldTypeName;
    }

    /**
     * @param mixed $type
     */
    public function setFieldTypeName($fieldTypeName)
    {
        $this->fieldTypeName = $fieldTypeName;
    }

    /**
     * @return mixed
     */
    public function getFormId()
    {
        return $this->formId;
    }

    /**
     * @param mixed $formId
     */
    public function setFormId($formId)
    {
        $this->formId = $formId;
    }


}
<?php
/**
 * Created by PhpStorm.
 * User: bert
 * Date: 6/06/2015
 * Time: 13:06
 */

namespace CNetworks\EyeVent\Model;


class InputField extends \CNetworks\EyeVent\Model\Base {

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
     * - initBll
     */

    public function loadAllByFormId($formId)
    {
        $this->resetList();
        $this->initDal();
        foreach ($this->dal->selectAllByFormId($formId) as $row)
        {
            $inputField = new \CNetworks\EyeVent\Bll\InputField();
            $inputField->setId($row['input_field_id']);
            $inputField->setName($row['input_field_name']);
            $inputField->setComment($row['input_field_comment']);
            $inputField->setPosition($row['input_field_position']);
            $inputField->setFieldTypeName($row['fk_field_type_name']);
            $inputField->setFormId($row['fk_form_id']);
            $this->list[] = $inputField;
        }
        return $this->list;
    }

    public function saveOne($name, $comment, $position, $fieldTypeName, $formId)
    {
        $this->initDal();
        $this->initBll();
        $this->entity->setName($name);
        $this->entity->setComment($comment);
        $this->entity->setPosition($position);
        $this->entity->setFieldTypeName($fieldTypeName);
        $this->entity->setFormId($formId);
        $this->dal->insert($this->entity);
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: bert
 * Date: 6/06/2015
 * Time: 13:00
 */

namespace CNetworks\EyeVent\Model;


class Form extends \CNetworks\EyeVent\Model\Base {

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

    public function loadAllByEventId($eventId)
    {
        $this->resetList();
        $this->initDal();
        foreach ($this->dal->selectAllByEventId($eventId) as $row) {
            $form = new \CNetworks\EyeVent\Bll\Form();
            $form->setId($row['form_id']);
            $form->setName($row['form_name']);
            $form->setEventId($row['fk_event_id']);

            $inputFieldList = Array();
            $dalInputField = new \CNetworks\EyeVent\Dal\InputField($this->connector, $this->logBook, $this->feedback);
            foreach($dalInputField->selectAllByFormId($form->getId()) as $row) {
                $inputField = new \CNetworks\EyeVent\Bll\InputField();
                $inputField->setId($row['input_field_id']);
                $inputField->setName($row['input_field_name']);
                $inputField->setComment($row['input_field_comment']);
                $inputField->setPosition($row['input_field_position']);
                $inputField->setFieldTypeName($row['fk_field_type_name']);
                $inputField->setFormId($row['fk_form_id']);
                $inputFieldList[] = $inputField;
            }
            print_r($inputFieldList);
            $form->setInputFields($inputFieldList);
            $this->list[] = $form;
        }
        return $this->list;
    }

    public function saveOne($name, $eventId)
    {
        $this->initDal();
        $this->initBll();
        $this->entity->setName($name);
        $this->entity->setEventId($eventId);
        $this->dal->insert($this->entity);
    }
}
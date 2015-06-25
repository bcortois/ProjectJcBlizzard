<?php
/**
 * Created by PhpStorm.
 * User: bert
 * Date: 6/06/2015
 * Time: 13:13
 */

namespace CNetworks\EyeVent\Model;


class Subscriber extends \CNetworks\EyeVent\Model\Base {

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

    public function loadAllByFormId($formId)
    {
        $this->resetList();
        $this->initDal();
        foreach ($this->dal->selectAllByFormId($formId) as $row)
        {
            $subscriber = new \CNetworks\EyeVent\Bll\Subscriber();
            $subscriber->setId($row['subscriber_id']);
            $subscriber->setFormId($row['fk_form_id']);
            $this->list[] = $subscriber;
        }
        return $this->list;
    }

    public function saveOne($formId)
    {
        $this->initDal();
        $this->initBll();
        $this->entity->setFormId($formId);
        $this->dal->insert($this->entity);
    }
}
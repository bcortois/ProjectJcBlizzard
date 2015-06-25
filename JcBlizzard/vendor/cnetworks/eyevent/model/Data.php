<?php
/**
 * Created by PhpStorm.
 * User: bert
 * Date: 6/06/2015
 * Time: 12:09
 */

namespace CNetworks\EyeVent\Model;


class Data extends \CNetworks\EyeVent\Model\Base {

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

    public function loadAllBySubscriberId($subscriberId)
    {
        $this->resetList();
        $this->initDal();
        foreach ($this->dal->selectAllBySubscriberId($subscriberId) as $row)
        {
            $data = new \CNetworks\EyeVent\Bll\Data();
            $data->setId($row['data_id']);
            $data->setInputFieldId($row['fk_input_field_id']);
            $data->setValue($row['data_value']);
            $data->setSubscriberId($row['fk_subscriber_id']);
            $this->list[] = $data;
        }
        return $this->list;
    }

    public function saveOne($inputFieldId, $value, $subscriberId)
    {
        $this->initDal();
        $this->initBll();
        $this->entity->setInputFieldId($inputFieldId);
        $this->entity->setValue($value);
        $this->entity->setSubscriberId($subscriberId);
        $this->dal->insert($this->entity);
    }
}
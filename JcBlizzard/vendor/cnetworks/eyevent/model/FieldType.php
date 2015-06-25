<?php
/**
 * Created by PhpStorm.
 * User: bert
 * Date: 6/06/2015
 * Time: 12:56
 */

namespace CNetworks\EyeVent\Model;


class FieldType extends \CNetworks\EyeVent\Model\Base {

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

    public function loadAll()
    {
        $this->resetList();
        $this->initDal();
        foreach ($this->dal->selectAll() as $row)
        {
            $fieldType = new \CNetworks\EyeVent\Bll\FieldType();
            $fieldType->setName($row['field_type_name']);
            $this->list[] = $fieldType;
        }
        return $this->list;
    }

    public function saveOne($name)
    {
        $this->initDal();
        $this->initBll();
        $this->entity->setName($name);
        $this->dal->insert($this->entity);
    }
}
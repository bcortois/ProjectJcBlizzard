<?php
/**
 * Created by PhpStorm.
 * User: bert
 * Date: 12/05/2015
 * Time: 13:03
 */

namespace CNetworks\EyeVent\Bll;


class FieldType {

    private $name;

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
}
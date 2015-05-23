<?php
/**
 * Created by PhpStorm.
 * User: bert
 * Date: 12/05/2015
 * Time: 12:52
 */

namespace CNetworks\EyeVent\Bll;


class Subscriber {

    private $id;
    private $formId;
    private $dataList;

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

    /**
     * @return mixed
     */
    public function getDataList()
    {
        return $this->dataList;
    }

    /**
     * @param mixed $dataList
     */
    public function setDataList($dataList)
    {
        $this->dataList = $dataList;
    } // list of objects created from the Data class.


}
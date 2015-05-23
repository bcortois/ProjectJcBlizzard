<?php
/**
 * Created by PhpStorm.
 * User: bert
 * Date: 22/05/2015
 * Time: 12:00
 */

namespace CNetworks\Helpers\Bll;


class Feedback {
    protected $result;
    protected $isError;

    /**
     * @return mixed
     */
    public function getResult()
    {
        if (!$this->result)
        {
            return 'n/a';
        }
        return $this->result;
    }

    /**
     * @param mixed $result
     */
    public function setResult($result)
    {
        $this->result = $result;
    }

    /**
     * @return mixed
     */
    public function getIsError()
    {
        return $this->isError;
    }

    /**
     * @param mixed $isError
     */
    public function setIsError($isError)
    {
        $this->isError = $isError;
    }
}
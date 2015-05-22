<?php
/**
 * Created by PhpStorm.
 * User: bert
 * Date: 19/05/2015
 * Time: 16:10
 */

namespace CNetworks\Helpers\Bll;


class Log {

    protected $action;
    protected $startTime;
    protected $endTime;
    protected $provider;
    protected $errorCodeProvider;
    protected $message;
    protected $isError;

    function __construct()
    {

    }

    /**
     * @return mixed
     */
    public function getStartTime()
    {
        return $this->startTime;
    }

    /**
     * @param mixed $startTime
     */
    public function setStartTime($startTime)
    {
        $this->startTime = $startTime;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param mixed $action
     */
    public function setAction($action)
    {
        $this->action = $action;
    }

    /**
     * @return mixed
     */
    public function getEndTime()
    {
        return $this->endTime;
    }

    /**
     * @param mixed $endTime
     */
    public function setEndTime($endTime)
    {
        $this->endTime = $endTime;
    }

    /**
     * @return mixed
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * @param mixed $provider
     */
    public function setProvider($provider)
    {
        $this->provider = $provider;
    }

    /**
     * @return mixed
     */
    public function getErrorCodeProvider()
    {
        if (!$this->errorCodeProvider) {
            $this->setErrorCodeProvider('n/a');
        }
        return $this->errorCodeProvider;
    }

    /**
     * @param mixed $errorCodeProvider
     */
    public function setErrorCodeProvider($errorCodeProvider)
    {
        $this->errorCodeProvider = $errorCodeProvider;
    }


    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
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

    public function duplicateLog()
    {
        $duplicate = new Log(); // New log object.
        // using the new log object to store a copy by value of current log.
        $duplicate->setAction($this->getAction());
        $duplicate->setStartTime($this->getStartTime());
        $duplicate->setEndTime($this->getEndTime());
        $duplicate->setProvider($this->getProvider());
        $duplicate->setErrorCodeProvider($this->getErrorCodeProvider());
        $duplicate->setMessage($this->getMessage());
        $duplicate->setIsError($this->getIsError());
        return $duplicate;
    }

    public function startLog($action) // This function initiates the starttime and gives the property action a value.
    {
        $this->action = $action;
        $this->startTime = date("Y-m-d H:i:s"); // sets the current log start time.
    }

    public function endLog()
    {
        $this->endTime = date("Y-m-d H:i:s"); //sets the current log end time.
    }

    public function resetLog()
    {
        $this->setAction(NULL);
        $this->setStartTime(NULL);
        $this->setEndTime(NULL);
        $this->setProvider(NULL);
        $this->setErrorCodeProvider(NULL);
        $this->setMessage(NULL);
        $this->setIsError(false);
    }
}
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
    protected $logBook;

    function __construct()
    {
        $this->logBook = Array();
        $this->setIsError(FALSE);
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

    /**
     * @return array
     */
    public function getLogBook()
    {
        return $this->logBook;
    }

    /**
     * @param array $logBook
     */
    public function setLogBook($logBook)
    {
        $this->logBook = $logBook;
    }



    public function addToLogBook() // This function saves the current log object to logBook.
    {
        $copy = new Log(); // New log object.
        $copy = $this; // using the new log object to store a copy by value of current log.
        $this->logBook[] = $copy; // The copy of the log is stored as an entry in the array logBook.
    }

    public function saveLogBook() // This function adds all the logs that are stored in logBook to a local logfile.
    {

    }

    public function startLog($action) // This function initiates the starttime and gives the property action a value.
    {
        $this->action = $action;
        $this->startTime = date("Y-m-d H:i:s"); // sets the current log start time.
    }

    public function endLog()
    {
        $this->endTime = date("Y-m-d H:i:s"); //sets the current log end time.
        $this->addToLogBook();
    }
}
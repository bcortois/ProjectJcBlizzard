<?php
/**
 * Created by PhpStorm.
 * User: bert
 * Date: 20/05/2015
 * Time: 17:27
 */

namespace CNetworks\Helpers\Bll;

require 'Log.php';

class LogBook extends Log{
    private $logBook;

    function __construct()
    {
        $this->logBook = Array();
    }

    /**
     * @return mixed
     */
    public function getLogBook()
    {
        return $this->logBook;
    }

    /**
     * @param mixed $logBook
     */
    public function setLogBook($logBook)
    {
        $this->logBook = $logBook;
    }

    public function write() // This function saves the current log object to logBook.
    {
        $this->logBook[] = $this->duplicateLog(); // The copy of the log is stored as an entry in the array logBook.
        $this->resetLog();
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: bert
 * Date: 22/05/2015
 * Time: 14:01
 */

namespace CNetworks\EyeVent\Dal;


class Base {

    protected $connector;
    protected $logBook;
    protected $feedback;
    protected $pdo;
    protected $preparedStatement;

    function __construct($connector, $logBook, $feedback)
    {
        $this->connector = $connector;
        $this->logBook = $logBook;
        $this->feedback = $feedback;
    }

    protected function resetPreparedStatement()
    {
        $this->preparedStatement = NULL;
    }
}
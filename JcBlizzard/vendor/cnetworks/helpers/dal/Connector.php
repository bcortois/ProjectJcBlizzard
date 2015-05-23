<?php
/**
 * Created by PhpStorm.
 * User: bert
 * Date: 20/05/2015
 * Time: 19:28
 */

namespace CNetworks\Helpers\Dal;


class Connector {

    protected $hostName;
    protected $port;
    protected $databaseName;
    protected $userName;
    protected $password;
    protected $log;
    protected $feedback;
    protected $pdo;

    function __construct($hostName, $port, $databaseName, $userName, $password, $log, $feedback)
    {
        $this->hostName = $hostName;
        $this->port = $port;
        $this->databaseName = $databaseName;
        $this->userName = $userName;
        $this->password = $password;
        $this->log = $log;
        $this->feedback = $feedback;
        $this->pdo = NULL;
    }

    public function getConnection()
    {
        $this->log->startLog("Connecting to database " . $this->databaseName . " on host " . $this->hostName);
        $this->log->setProvider('PDO');
        if ($this->pdo)
        {
            $this->log->setMessage('Connection already opened.');
        }
        else
        {
            $connectionString = "mysql:host=" . $this->hostName . ":" . $this->port . ";dbname=" . $this->databaseName;
            try {
                $this->pdo = new \PDO($connectionString, $this->userName, $this->password);
                $this->pdo->setAttribute( \PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION ); // set up of pdo to throw all types of error into exceptions.
                $this->log->setMessage('Connection successfully opened.');
            }
            catch (\PDOException $ex) {
                $this->log->setProvider('\PDO');
                $this->log->setIsError(TRUE);
                $this->log->setMessage($ex->getMessage());
                $this->log->setErrorCodeProvider($ex->getCode());
                $this->feedback->setIsError(true);
                $this->feedback->setResult($ex->getCode());
            }
        }
        $this->log->endLog();
        $this->log->writeLogBook();
        return $this->pdo;
    }

    public function closeConnection()
    {
        $this->log->startLog("Close connection");
        $this->log->setProvider('PDO');

        if ($this->pdo) {
            $this->pdo = NULL;
            $this->log->setMessage('Connection was successfully closed');
        }
        else {
            $this->log->setMessage('Connection was successfully closed');
        }
        $this->log->endLog();
        $this->log->writeLogBook();
    }
}
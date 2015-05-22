<?php
/**
 * Created by PhpStorm.
 * User: bert
 * Date: 20/05/2015
 * Time: 19:28
 */

namespace CNetworks\Helpers\Dal;


class Connector {

    protected $pdo;
    protected $hostName;
    protected $port;
    protected $databaseName;
    protected $userName;
    protected $password;
    protected $log;
    protected $feedback;

    function __construct($hostName, $port, $databaseName, $userName, $password, $log, $feedback)
    {
        $this->setHostName($hostName);
        $this->setPort($port);
        $this->setDatabaseName($databaseName);
        $this->setUserName($userName);
        $this->setPassword($password);
        $this->setLog($log);
        $this->setPdo(NULL);
        $this->feedback = $feedback;
    }

    /**
     * @return mixed
     */
    public function getPdo()
    {
        return $this->pdo;
    }

    /**
     * @param mixed $pdo
     */
    public function setPdo($pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * @return mixed
     */
    public function getDatabaseName()
    {
        return $this->databaseName;
    }

    /**
     * @param mixed $databaseName
     */
    public function setDatabaseName($databaseName)
    {
        $this->databaseName = $databaseName;
    }

    /**
     * @return mixed
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @param mixed $port
     */
    public function setPort($port)
    {
        $this->port = $port;
    }

    /**
     * @return mixed
     */
    public function getLog()
    {
        return $this->log;
    }

    /**
     * @param mixed $log
     */
    public function setLog($log)
    {
        $this->log = $log;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @param mixed $userName
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;
    }

    /**
     * @return mixed
     */
    public function getHostName()
    {
        return $this->hostName;
    }

    /**
     * @param mixed $hostName
     */
    public function setHostName($hostName)
    {
        $this->hostName = $hostName;
    }

    public function getConnection()
    {
        $this->log->startLog("Connecting to database " . $this->getDatabaseName() . " on host " . $this->getHostName());
        $this->log->setProvider('PDO');
        if ($this->getPdo())
        {
            $this->log->setMessage('Connection already opened.');
        }
        else
        {
            $connectionString = "mysql:host=" . $this->getHostName() . ":" . $this->getPort() . ";dbname=" . $this->getDatabaseName();
            try {
                $this->setPdo(new \PDO($connectionString, $this->getUserName(), $this->getPassword()));
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
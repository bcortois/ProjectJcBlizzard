<?php
/**
 * Created by PhpStorm.
 * User: bert
 * Date: 18/05/2015
 * Time: 22:19
 */

namespace CNetworks\EyeVent\Dal;


class Event {

    protected $event;
    protected $form;
    protected $log;
    protected $connection;

    function __construct($event, $connection, $log)
    {
        $this->event = $event;
        $this->connection = $connection;
        $this->log = $log;
    }

    /**
     * @return mixed
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * @param mixed $event
     */
    public function setEvent($event)
    {
        $this->event = $event;
    }

    /**
     * @return mixed
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * @param mixed $form
     */
    public function setForm($form)
    {
        $this->form = $form;
    }

    /**
     * @return mixed
     */
    public function getConnection()
    {
        return $this->connection;
    }

    /**
     * @param mixed $connection
     */
    public function setConnection($connection)
    {
        $this->connection = $connection;
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

    public function insert()
    {
        $pdo = NULL;
        $this->log->startLog('Insert of event into database');
        try {
            $connectionString = "mysql:host=localhost:3306;dbname=blizzard_db";
            $pdo = new \PDO($connectionString, 'root', 'v0xL1d57');

            $preparedStatement = $pdo->prepare('CALL EventInsert(@pId, :pName, :pDescription, :pDate, :pImage, :pValidated, :pShiftsLink, :pLocationName, :pLocationAddress, :pLocationCoordinates)');
            $preparedStatement->bindValue(':pName', $this->event->getName(), \PDO::PARAM_STR);
            $preparedStatement->bindValue(':pDescription', $this->event->getDescription(), \PDO::PARAM_STR);
            $preparedStatement->bindValue(':pDate', $this->event->getDate(), \PDO::PARAM_STR);
            if (!$this->event->getImage()) {
                $preparedStatement->bindValue(':pImage', $this->event->getImage(), \PDO::PARAM_NULL);
            }
            else {
                $preparedStatement->bindValue(':pImage', $this->event->getImage(), \PDO::PARAM_LOB);
            }
            $preparedStatement->bindValue(':pValidated', $this->event->getValidated(), \PDO::PARAM_BOOL);
            $preparedStatement->bindValue(':pShiftsLink', $this->event->getShiftsLink(), \PDO::PARAM_STR);
            $preparedStatement->bindValue(':pLocationName', $this->event->getLocationName(), \PDO::PARAM_STR);
            $preparedStatement->bindValue(':pLocationAddress', $this->event->getLocationAddress(), \PDO::PARAM_STR);
            $preparedStatement->bindValue(':pLocationCoordinates', $this->event->getLocationCoordinates(), \PDO::PARAM_STR);

            $result = $preparedStatement->execute();
            if ($result)
            {
                $this->event->setId($pdo->query('select @pId')->fetchColumn());
                $this->log->setMessage("The event with id=" . $this->event->getId() . ", was inserted successfully.");
            }
            else
            {
                $this->log->isError(TRUE);
                $this->log->setMessage($preparedStatement->errorInfo()[2]); // Message of the log is set to the value an array containing the SQL error.
                $this->log->setErrorCodeProvider($preparedStatement->errorInfo()[1]);
            }
        }
        catch (\PDOException $ex)
        {
            $this->log->isError(TRUE);
            $this->log->setMessage($ex->getMessage());
            $this->log->setErrorCodeProvider($ex->getCode());
        }


        if ($pdo) {
            $this->pdo = NULL;
            $this->log->endLog();
        }
        else {
            $this->log->endLog();
        }
    }
}
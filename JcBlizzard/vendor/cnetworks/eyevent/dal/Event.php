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
    protected $logBook;
    protected $connector;

    function __construct($event, $connector, $log)
    {
        $this->event = $event;
        $this->connector = $connector;
        $this->logBook = $log;
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

    public function insert()
    {
        $pdo = NULL;
        $preparedStatement = NULL;
        if($pdo = $this->connector->getConnection()) {
            $preparedStatement = $pdo->prepare('CALL EventInsert(@pId, :pName, :pDescription, :pDate, :pImage, :pValidated, :pShiftsLink, :pLocationName, :pLocationAddress, :pLocationCoordinates)');
            $preparedStatement->bindValue(':pName', $this->event->getName(), \PDO::PARAM_STR);
            $preparedStatement->bindValue(':pDescription', $this->event->getDescription(), \PDO::PARAM_STR);
            $preparedStatement->bindValue(':pDate', $this->event->getDate(), \PDO::PARAM_STR);
            $preparedStatement->bindValue(':pImage', $this->event->getImage(), \PDO::PARAM_LOB);
            $preparedStatement->bindValue(':pValidated', $this->event->getValidated(), \PDO::PARAM_BOOL);
            $preparedStatement->bindValue(':pShiftsLink', $this->event->getShiftsLink(), \PDO::PARAM_STR);
            $preparedStatement->bindValue(':pLocationName', $this->event->getLocationName(), \PDO::PARAM_STR);
            $preparedStatement->bindValue(':pLocationAddress', $this->event->getLocationAddress(), \PDO::PARAM_STR);
            $preparedStatement->bindValue(':pLocationCoordinates', $this->event->getLocationCoordinates(), \PDO::PARAM_STR);

            $this->logBook->startLog('Insert of event into database');
            $this->logBook->setProvider('Cnetworks\Eyevent\Dal\Event');
            if ($preparedStatement->execute()) {
                $this->event->setId($pdo->query('select @pId')->fetchColumn());
                $this->logBook->setMessage("The event with id=" . $this->event->getId() . " was inserted successfully.");
            } else {
                $this->logBook->setProvider('MySQL');
                $this->logBook->setIsError(TRUE);
                $this->logBook->setMessage($preparedStatement->errorInfo()[2]); // Message of the log is set to the value an array containing the SQL error.
                $this->logBook->setErrorCodeProvider($preparedStatement->errorInfo()[1]);
            }
            $this->logBook->endLog();
            $this->logBook->write();
            $this->connector->closeConnection();
        }
    }
}
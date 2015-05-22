<?php
/**
 * Created by PhpStorm.
 * User: bert
 * Date: 18/05/2015
 * Time: 22:19
 */

namespace CNetworks\EyeVent\Dal;


class Event extends Dal{

    public function insert()
    {
        if($this->pdo = $this->connector->getConnection()) {
            $this->preparedStatement = $this->pdo->prepare('CALL EventInsert(@pId, :pName, :pDescription, :pDate, :pImage, :pValidated, :pShiftsLink, :pLocationName, :pLocationAddress, :pLocationCoordinates)');
            $this->preparedStatement->bindValue(':pName', $this->entity->getName(), \PDO::PARAM_STR);
            $this->preparedStatement->bindValue(':pDescription', $this->entity->getDescription(), \PDO::PARAM_STR);
            $this->preparedStatement->bindValue(':pDate', $this->entity->getDate(), \PDO::PARAM_STR);
            $this->preparedStatement->bindValue(':pImage', $this->entity->getImage(), \PDO::PARAM_LOB);
            $this->preparedStatement->bindValue(':pValidated', $this->entity->getValidated(), \PDO::PARAM_BOOL);
            $this->preparedStatement->bindValue(':pShiftsLink', $this->entity->getShiftsLink(), \PDO::PARAM_STR);
            $this->preparedStatement->bindValue(':pLocationName', $this->entity->getLocationName(), \PDO::PARAM_STR);
            $this->preparedStatement->bindValue(':pLocationAddress', $this->entity->getLocationAddress(), \PDO::PARAM_STR);
            $this->preparedStatement->bindValue(':pLocationCoordinates', $this->entity->getLocationCoordinates(), \PDO::PARAM_STR);

            $this->logBook->startLog('Insert of event into database');
            $this->logBook->setProvider('Cnetworks\Eyevent\Dal\Event');
            if ($this->preparedStatement->execute()) {
                $this->entity->setId($this->pdo->query('select @pId')->fetchColumn());
                $this->logBook->setMessage("The event with id=" . $this->entity->getId() . " was inserted successfully.");
                $this->feedback->setIsError(false);
                $this->feedback->setResult($this->entity->getName());
            }
            else {
                $this->logBook->setProvider('MySQL');
                $this->logBook->setIsError(TRUE);
                $this->logBook->setMessage($this->preparedStatement->errorInfo()[2]); // Message of the log is set to the value an array containing the SQL error.
                $this->logBook->setErrorCodeProvider($this->preparedStatement->errorInfo()[1]);
                $this->feedback->setIsError(true);
                $this->feedback->setResult($this->preparedStatement->errorInfo()[1]);
            }
            $this->logBook->endLog();
            $this->logBook->writeLogBook();
            $this->connector->closeConnection();
        }
        $this->resetPreparedStatement();
    }
}
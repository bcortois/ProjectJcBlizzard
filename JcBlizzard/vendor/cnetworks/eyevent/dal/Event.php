<?php
/**
 * Created by PhpStorm.
 * User: bert
 * Date: 18/05/2015
 * Time: 22:19
 */

namespace CNetworks\EyeVent\Dal;


class Event extends Dal{

    /**
     * Following properties are inherrited from Dal:
     * - $entity
     * - $connector
     * - $logBook
     * - $feedback
     * - $pdo
     * - preparedStatement
     */

    public function insert()
    {
        if($this->pdo = $this->connector->getConnection()) {
            $this->logBook->startLog('Insert of event into database');
            $this->logBook->setProvider('Cnetworks\Eyevent\Dal\Event');
            try {
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
                if ($this->preparedStatement->execute()) {
                    $this->entity->setId($this->pdo->query('select @pId')->fetchColumn());
                    $this->logBook->setMessage("The event with id=" . $this->entity->getId() . " was inserted successfully.");
                    $this->feedback->setIsError(false);
                    $this->feedback->setResult($this->entity->getName());
                }
            }
            catch (\PDOException $ex) {
                $this->logBook->setProvider('\PDO');
                $this->logBook->setIsError(TRUE);
                $this->logBook->setMessage($ex->getMessage());
                $this->logBook->setErrorCodeProvider($ex->getCode());
                $this->feedback->setIsError(true);
                $this->feedback->setResult($ex->getCode());
            }
            $this->logBook->endLog();
            $this->logBook->writeLogBook();
            $this->connector->closeConnection();
        }
        $this->resetPreparedStatement();
    }
}
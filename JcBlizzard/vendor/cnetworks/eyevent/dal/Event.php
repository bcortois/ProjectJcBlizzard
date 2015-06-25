<?php
/**
 * Created by PhpStorm.
 * User: bert
 * Date: 18/05/2015
 * Time: 22:19
 */

namespace CNetworks\EyeVent\Dal;


class Event extends Base{

    /**
     * Following properties are inherited from \CNetworks\EyeVent\Dal\Base:
     * - $connector
     * - $logBook
     * - $feedback
     * - $pdo
     * - preparedStatement
     */

    public function insert($entity)
    {
        // If the property "pdo" gets an object assigend to it, this code will execute
        // if the connection fails, then the handling of the exception occurs in the connector class.
        if($this->pdo = $this->connector->getConnection()) {
            $this->logBook->startLog('Insert of event into database');
            $this->logBook->setProvider('Cnetworks\Eyevent\Dal\Event');
            try {
                $this->preparedStatement = $this->pdo->prepare('CALL EventInsert(@pId, :pName, :pDescription, :pDate, :pImage, :pValidated, :pShiftsLink, :pLocationName, :pLocationAddress, :pLocationCoordinates)');
                $this->preparedStatement->bindValue(':pName', $entity->getName(), \PDO::PARAM_STR);
                $this->preparedStatement->bindValue(':pDescription', $entity->getDescription(), \PDO::PARAM_STR);
                $this->preparedStatement->bindValue(':pDate', $entity->getDate(), \PDO::PARAM_STR);
                $this->preparedStatement->bindValue(':pImage', $entity->getImage(), \PDO::PARAM_LOB);
                $this->preparedStatement->bindValue(':pValidated', $entity->getValidated(), \PDO::PARAM_BOOL);
                $this->preparedStatement->bindValue(':pShiftsLink', $entity->getShiftsLink(), \PDO::PARAM_STR);
                $this->preparedStatement->bindValue(':pLocationName', $entity->getLocationName(), \PDO::PARAM_STR);
                $this->preparedStatement->bindValue(':pLocationAddress', $entity->getLocationAddress(), \PDO::PARAM_STR);
                $this->preparedStatement->bindValue(':pLocationCoordinates', $entity->getLocationCoordinates(), \PDO::PARAM_STR);
                if ($this->preparedStatement->execute()) {
                    $entity->setId($this->pdo->query('select @pId')->fetchColumn());
                    $this->logBook->setMessage("The event with id=" . $entity->getId() . " was inserted successfully.");
                    $this->feedback->setIsError(false);
                    $this->feedback->setResult($entity->getName());
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

    // returns a result dictionary of a db table and it's row's columns.
    public function selectAll()
    {
        $dbResults = null;
        if($this->pdo = $this->connector->getConnection()) {
            $this->logBook->startLog('SelectAll from event table');
            $this->logBook->setProvider('Cnetworks\Eyevent\Dal\Event');

            try {
                $this->preparedStatement = $this->pdo->prepare('CALL EventSelectAll()');
                if ($this->preparedStatement->execute()) {
                    $rowCount = $this->preparedStatement->rowCount();

                    if ($rowCount) {
                        $this->logBook->setMessage("Tabel event: {$rowCount} rijen ingelezen.");
                        $this->feedback->setIsError(false);
                        $this->feedback->setResult($rowCount); // In case the operation was successful, feedback result will be the count of rows that where selected

                        // results of the select are stored in a variable.
                        $dbResults = $this->preparedStatement->fetchAll(\PDO::FETCH_ASSOC);
                    }
                    else {
                        $this->logBook->setProvider('Cnetworks\Eyevent\Dal\Event');
                        $this->logBook->setIsError(TRUE);
                        $this->logBook->setMessage('Tabel event is leeg.');
                        //$this->logBook->setErrorCodeProvider($ex->getCode());
                        $this->feedback->setIsError(true);
                        $this->feedback->setResult(-1);
                    }
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
        // Exits the procedure and returns a value.
        $this->resetPreparedStatement();
        return $dbResults;
    }

    // returns a result dictionary of a db table and it's row's columns.
    public function selectOneById($eventId)
    {
        $dbResults = null;
        if($this->pdo = $this->connector->getConnection()) {
            $this->logBook->startLog('SelectOne from event table');
            $this->logBook->setProvider('Cnetworks\Eyevent\Dal\Event');

            try {
                $this->preparedStatement = $this->pdo->prepare('CALL EventSelectOneById(:pId)');
                $this->preparedStatement->bindValue(':pId', $eventId, \PDO::PARAM_INT);
                if ($this->preparedStatement->execute()) {
                    $rowCount = $this->preparedStatement->rowCount();
                    if ($rowCount) {
                        $this->logBook->setMessage("Tabel event: {$rowCount} rij ingelezen.");
                        $this->feedback->setIsError(false);
                        $this->feedback->setResult($rowCount); // In case the operation was successful, feedback result will be the count of rows that where selected

                        // results of the select are stored in a variable.
                        $dbResults = $this->preparedStatement->fetch(\PDO::FETCH_ASSOC);
                    }
                    else {
                        $this->logBook->setProvider('Cnetworks\Eyevent\Dal\Event');
                        $this->logBook->setIsError(TRUE);
                        $this->logBook->setMessage("The event with id={$eventId} doesn't exists.");
                        //$this->logBook->setErrorCodeProvider($ex->getCode());
                        $this->feedback->setIsError(true);
                        $this->feedback->setResult(-1);
                    }
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
        // Exits the procedure and returns a value.
        $this->resetPreparedStatement();
        return $dbResults;
    }
}
<?php
/**
 * Created by PhpStorm.
 * User: bert
 * Date: 20/05/2015
 * Time: 23:58
 */

namespace CNetworks\EyeVent\Dal;


class Form extends Base{

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
        if($this->pdo = $this->connector->getConnection()) {
            $this->logBook->startLog('Insert of form into database');
            $this->logBook->setProvider('Cnetworks\Eyevent\Dal\Form');
            try {
                $this->preparedStatement = $this->pdo->prepare('CALL FormInsert(@pId, :pName, :pEventId)');
                $this->preparedStatement->bindValue(':pName', $entity->getName(), \PDO::PARAM_STR);
                $this->preparedStatement->bindValue(':pEventId', $entity->getEventId(), \PDO::PARAM_INT);
                if ($this->preparedStatement->execute()) {
                    $entity->setId($this->pdo->query('select @pId')->fetchColumn());
                    $this->logBook->setMessage("The form with id=" . $entity->getId() . " was inserted successfully.");
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
//    public function selectOneById($eventId)
//    {
//        $dbResults = null;
//        if($this->pdo = $this->connector->getConnection()) {
//            $this->logBook->startLog('SelectOneById from form and input_field table');
//            $this->logBook->setProvider('Cnetworks\Eyevent\Dal\Form');
//
//            try {
//                $this->preparedStatement = $this->pdo->prepare('CALL FormSelectOneById(:pId)');
//                $this->preparedStatement->bindValue(':pId', $eventId, \PDO::PARAM_INT);
//                if ($this->preparedStatement->execute()) {
//                    $rowCount = $this->preparedStatement->rowCount();
//
//                    if ($rowCount) {
//                        $this->logBook->setMessage("Tabel form: {$rowCount} rijen ingelezen.");
//                        $this->feedback->setIsError(false);
//                        $this->feedback->setResult($rowCount); // In case the operation was successful, feedback result will be the count of rows that where selected
//
//                        // results of the select are stored in a variable.
//                        $dbResults = $this->preparedStatement->fetchAll(\PDO::FETCH_ASSOC);
//                    }
//                    else {
//                        $this->logBook->setProvider('Cnetworks\Eyevent\Dal\Form');
//                        $this->logBook->setIsError(TRUE);
//                        $this->logBook->setMessage('Tabel form is leeg.');
//                        //$this->logBook->setErrorCodeProvider($ex->getCode());
//                        $this->feedback->setIsError(true);
//                        $this->feedback->setResult(-1);
//                    }
//                }
//            }
//            catch (\PDOException $ex) {
//                $this->logBook->setProvider('\PDO');
//                $this->logBook->setIsError(TRUE);
//                $this->logBook->setMessage($ex->getMessage());
//                $this->logBook->setErrorCodeProvider($ex->getCode());
//                $this->feedback->setIsError(true);
//                $this->feedback->setResult($ex->getCode());
//            }
//            $this->logBook->endLog();
//            $this->logBook->writeLogBook();
//            $this->connector->closeConnection();
//        }
//        // Exits the procedure and returns a value.
//        $this->resetPreparedStatement();
//        return $dbResults;
//    }
}
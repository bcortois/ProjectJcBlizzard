<?php
/**
 * Created by PhpStorm.
 * User: bert
 * Date: 23/05/2015
 * Time: 20:44
 */

namespace CNetworks\EyeVent\Dal;


class Data extends Base{

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
            $this->logBook->startLog('Insert of data into database');
            $this->logBook->setProvider('Cnetworks\Eyevent\Dal\Data');
            try {
                $this->preparedStatement = $this->pdo->prepare('CALL DataInsert(@pId, :pValue, :pInputFieldId, :pSubscriberId)');
                $this->preparedStatement->bindValue(':pValue', $entity->getValue(), \PDO::PARAM_STR);
                $this->preparedStatement->bindValue(':pInputFieldId', $entity->getInputFieldId(), \PDO::PARAM_INT);
                $this->preparedStatement->bindValue(':pSubscriberId', $entity->getSubscriberId(), \PDO::PARAM_INT);
                if ($this->preparedStatement->execute()) {
                    $entity->setId($this->pdo->query('select @pId')->fetchColumn());
                    $this->logBook->setMessage("The data with id=" . $entity->getId() . " was inserted successfully.");
                    $this->feedback->setIsError(false);
                    $this->feedback->setResult($entity->getId());
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
    public function selectAllBySubscriberId($subscriberId)
    {
        $dbResults = null;
        if($this->pdo = $this->connector->getConnection()) {
            $this->logBook->startLog('SelectAllBySubscriberId from data table');
            $this->logBook->setProvider('Cnetworks\Eyevent\Dal\Data');

            try {
                $this->preparedStatement = $this->pdo->prepare('CALL DataSelectAllBySubscriberId(:pId)');
                $this->preparedStatement->bindValue(':pId', $subscriberId, \PDO::PARAM_INT);
                if ($this->preparedStatement->execute()) {
                    $rowCount = $this->preparedStatement->rowCount();

                    if ($rowCount) {
                        $this->logBook->setMessage("Tabel data: {$rowCount} rijen ingelezen.");
                        $this->feedback->setIsError(false);
                        $this->feedback->setResult($rowCount); // In case the operation was successful, feedback result will be the count of rows that where selected

                        // results of the select are stored in a variable.
                        $dbResults = $this->preparedStatement->fetchAll(\PDO::FETCH_ASSOC);
                    }
                    else {
                        $this->logBook->setProvider('Cnetworks\Eyevent\Dal\Data');
                        $this->logBook->setIsError(TRUE);
                        $this->logBook->setMessage('Tabel data is leeg.');
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
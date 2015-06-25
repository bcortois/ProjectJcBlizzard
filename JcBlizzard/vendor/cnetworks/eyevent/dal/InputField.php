<?php
/**
 * Created by PhpStorm.
 * User: bert
 * Date: 22/05/2015
 * Time: 15:21
 */

namespace CNetworks\EyeVent\Dal;


class InputField extends Base{

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
            $this->logBook->startLog('Insert of inputfield into database');
            $this->logBook->setProvider('Cnetworks\Eyevent\Dal\InputField');
            try {
                $this->preparedStatement = $this->pdo->prepare('CALL InputFieldInsert(@pId, :pName, :pComment, :pPosition, :pFieldTypeName, :pFormId)');
                $this->preparedStatement->bindValue(':pName', $entity->getName(), \PDO::PARAM_STR);
                $this->preparedStatement->bindValue(':pComment', $entity->getComment(), \PDO::PARAM_STR);
                $this->preparedStatement->bindValue(':pPosition', $entity->getPosition(), \PDO::PARAM_INT);
                $this->preparedStatement->bindValue(':pFieldTypeName', $entity->getFieldTypeName(), \PDO::PARAM_STR);
                $this->preparedStatement->bindValue(':pFormId', $entity->getFormId(), \PDO::PARAM_INT);
                if ($this->preparedStatement->execute()) {
                    $entity->setId($this->pdo->query('select @pId')->fetchColumn());
                    $this->logBook->setMessage("The inputfield with id=" . $entity->getId() . " was inserted successfully.");
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
    public function selectAllByFormId($formId)
    {
        $dbResults = null;
        if($this->pdo = $this->connector->getConnection()) {
            $this->logBook->startLog('SelectAllByFormId from input_field table');
            $this->logBook->setProvider('Cnetworks\Eyevent\Dal\InputField');

            try {
                $this->preparedStatement = $this->pdo->prepare('CALL InputFieldSelectAllByFormId(:pId)');
                $this->preparedStatement->bindValue(':pId', $formId, \PDO::PARAM_INT);
                if ($this->preparedStatement->execute()) {
                    $rowCount = $this->preparedStatement->rowCount();

                    if ($rowCount) {
                        $this->logBook->setMessage("Tabel input_field: {$rowCount} rijen ingelezen.");
                        $this->feedback->setIsError(false);
                        $this->feedback->setResult($rowCount); // In case the operation was successful, feedback result will be the count of rows that where selected

                        // results of the select are stored in a variable.
                        $dbResults = $this->preparedStatement->fetchAll(\PDO::FETCH_ASSOC);
                    }
                    else {
                        $this->logBook->setProvider('Cnetworks\Eyevent\Dal\InputField');
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
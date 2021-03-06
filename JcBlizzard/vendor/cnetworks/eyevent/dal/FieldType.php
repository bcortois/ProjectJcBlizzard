<?php
/**
 * Created by PhpStorm.
 * User: bert
 * Date: 21/05/2015
 * Time: 15:43
 */

namespace CNetworks\EyeVent\Dal;


class FieldType extends Base{

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
            $this->logBook->startLog('Insert of fieldtype into database');
            $this->logBook->setProvider('Cnetworks\Eyevent\Dal\FieldType');
            try {
                $this->preparedStatement = $this->pdo->prepare('CALL FieldTypeInsert(:pName)');
                $this->preparedStatement->bindValue(':pName', $entity->getName(), \PDO::PARAM_STR);

                if ($this->preparedStatement->execute()) {
                    $this->logBook->setMessage("The fieldtype with id=" . $entity->getName() . " was inserted successfully.");
                    $this->feedback->setIsError(false);
                    $this->feedback->setResult($entity->getName());
                }
            }
            catch (\PDOException $ex)
            {
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
            $this->logBook->startLog('SelectAll from fieldtype table');
            $this->logBook->setProvider('Cnetworks\Eyevent\Dal\FieldType');

            try {
                $this->preparedStatement = $this->pdo->prepare('CALL FieldTypeSelectAll()');
                if ($this->preparedStatement->execute()) {
                    $rowCount = $this->preparedStatement->rowCount();

                    if ($rowCount) {
                        $this->logBook->setMessage("Tabel fieldtype: {$rowCount} rijen ingelezen.");
                        $this->feedback->setIsError(false);
                        $this->feedback->setResult($rowCount); // In case the operation was successful, feedback result will be the count of rows that where selected

                        // results of the select are stored in a variable.
                        $dbResults = $this->preparedStatement->fetchAll(\PDO::FETCH_ASSOC);
                    }
                    else {
                        $this->logBook->setProvider('Cnetworks\Eyevent\Dal\FieldType');
                        $this->logBook->setIsError(TRUE);
                        $this->logBook->setMessage('Tabel fieldtype is leeg.');
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
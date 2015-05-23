<?php
/**
 * Created by PhpStorm.
 * User: bert
 * Date: 22/05/2015
 * Time: 15:21
 */

namespace CNetworks\EyeVent\Dal;


class InputField extends Dal{
    public function insert()
    {
        if($this->pdo = $this->connector->getConnection()) {
            $this->preparedStatement = $this->pdo->prepare('CALL InputFieldInsert(@pId, :pName, :pComment, :pPosition, :pFieldTypeName, :pFormId)');
            $this->preparedStatement->bindValue(':pName', $this->entity->getName(), \PDO::PARAM_STR);
            $this->preparedStatement->bindValue(':pComment', $this->entity->getComment(), \PDO::PARAM_STR);
            $this->preparedStatement->bindValue(':pPosition', $this->entity->getPosition(), \PDO::PARAM_INT);
            $this->preparedStatement->bindValue(':pFieldTypeName', $this->entity->getFieldTypeName(), \PDO::PARAM_STR);
            $this->preparedStatement->bindValue(':pFormId', $this->entity->getFormId(), \PDO::PARAM_INT);

            $this->logBook->startLog('Insert of inputfield into database');
            $this->logBook->setProvider('Cnetworks\Eyevent\Dal\InputField');
            if ($this->preparedStatement->execute()) {
                $this->entity->setId($this->pdo->query('select @pId')->fetchColumn());
                $this->logBook->setMessage("The inputfield with id=" . $this->entity->getId() . " was inserted successfully.");
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
<?php
/**
 * Created by PhpStorm.
 * User: bert
 * Date: 21/05/2015
 * Time: 15:43
 */

namespace CNetworks\EyeVent\Dal;


class FieldType extends Dal{

    public function insert()
    {
        if($this->pdo = $this->connector->getConnection()) {

            $this->logBook->startLog('Insert of fieldtype into database');
            $this->logBook->setProvider('Cnetworks\Eyevent\Dal\FieldType');

            $this->preparedStatement = $this->pdo->prepare('CALL FieldTypeInsert(:pName)');
            $this->preparedStatement->bindValue(':pName', $this->entity->getName(), \PDO::PARAM_STR);

            if ($this->preparedStatement->execute()) {
                $this->logBook->setMessage("The fieldtype with id=" . $this->entity->getName() . " was inserted successfully.");
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
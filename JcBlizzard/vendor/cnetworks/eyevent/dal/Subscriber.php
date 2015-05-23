<?php
/**
 * Created by PhpStorm.
 * User: bert
 * Date: 22/05/2015
 * Time: 15:44
 */

namespace CNetworks\EyeVent\Dal;


class Subscriber extends Dal {
    private $id;
    private $formId;
    private $dataList; // list of objects created from the Data class.

    public function insert()
    {
        if($this->pdo = $this->connector->getConnection()) {
            $this->preparedStatement = $this->pdo->prepare('CALL InputFieldInsert(@pId, :pFormId)');
            $this->preparedStatement->bindValue(':pId', $this->entity->getId(), \PDO::PARAM_INT);
            $this->preparedStatement->bindValue(':pFormId', $this->entity->getFormId(), \PDO::PARAM_INT);

            $this->logBook->startLog('Insert of subscriber into database');
            $this->logBook->setProvider('Cnetworks\Eyevent\Dal\Subscriber');

            if ($this->preparedStatement->execute()) {
                $this->entity->setId($this->pdo->query('select @pId')->fetchColumn());
                $this->logBook->setMessage("The subscriber with id=" . $this->entity->getId() . " was inserted successfully.");
                $this->feedback->setIsError(false);
                $this->feedback->setResult($this->entity->getId());
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
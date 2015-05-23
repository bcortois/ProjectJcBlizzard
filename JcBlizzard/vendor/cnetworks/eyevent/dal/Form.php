<?php
/**
 * Created by PhpStorm.
 * User: bert
 * Date: 20/05/2015
 * Time: 23:58
 */

namespace CNetworks\EyeVent\Dal;


class Form extends Dal{

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
            $this->logBook->startLog('Insert of form into database');
            $this->logBook->setProvider('Cnetworks\Eyevent\Dal\Form');
            try {
                $this->preparedStatement = $this->pdo->prepare('CALL FormInsert(@pId, :pName, :pEventId)');
                $this->preparedStatement->bindValue(':pName', $this->entity->getName(), \PDO::PARAM_STR);
                $this->preparedStatement->bindValue(':pEventId', $this->entity->getEventId(), \PDO::PARAM_INT);
                if ($this->preparedStatement->execute()) {
                    $this->entity->setId($this->pdo->query('select @pId')->fetchColumn());
                    $this->logBook->setMessage("The form with id=" . $this->entity->getId() . " was inserted successfully.");
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
<?php
/**
 * Created by PhpStorm.
 * User: bert
 * Date: 22/05/2015
 * Time: 15:21
 */

namespace CNetworks\EyeVent\Dal;


class InputField extends Dal{

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
            $this->logBook->startLog('Insert of inputfield into database');
            $this->logBook->setProvider('Cnetworks\Eyevent\Dal\InputField');
            try {
                $this->preparedStatement = $this->pdo->prepare('CALL InputFieldInsert(@pId, :pName, :pComment, :pPosition, :pFieldTypeName, :pFormId)');
                $this->preparedStatement->bindValue(':pName', $this->entity->getName(), \PDO::PARAM_STR);
                $this->preparedStatement->bindValue(':pComment', $this->entity->getComment(), \PDO::PARAM_STR);
                $this->preparedStatement->bindValue(':pPosition', $this->entity->getPosition(), \PDO::PARAM_INT);
                $this->preparedStatement->bindValue(':pFieldTypeName', $this->entity->getFieldTypeName(), \PDO::PARAM_STR);
                $this->preparedStatement->bindValue(':pFormId', $this->entity->getFormId(), \PDO::PARAM_INT);
                if ($this->preparedStatement->execute()) {
                    $this->entity->setId($this->pdo->query('select @pId')->fetchColumn());
                    $this->logBook->setMessage("The inputfield with id=" . $this->entity->getId() . " was inserted successfully.");
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
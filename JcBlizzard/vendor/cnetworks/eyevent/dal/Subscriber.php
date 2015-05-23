<?php
/**
 * Created by PhpStorm.
 * User: bert
 * Date: 22/05/2015
 * Time: 15:44
 */

namespace CNetworks\EyeVent\Dal;


class Subscriber extends Dal {

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
            $this->logBook->startLog('Insert of subscriber into database');
            $this->logBook->setProvider('Cnetworks\Eyevent\Dal\Subscriber');
            try {
                $this->preparedStatement = $this->pdo->prepare('CALL InputFieldInsert(@pId, :pFormId)');
                $this->preparedStatement->bindValue(':pId', $this->entity->getId(), \PDO::PARAM_INT);
                $this->preparedStatement->bindValue(':pFormId', $this->entity->getFormId(), \PDO::PARAM_INT);
                if ($this->preparedStatement->execute()) {
                    $this->entity->setId($this->pdo->query('select @pId')->fetchColumn());
                    $this->logBook->setMessage("The subscriber with id=" . $this->entity->getId() . " was inserted successfully.");
                    $this->feedback->setIsError(false);
                    $this->feedback->setResult($this->entity->getId());
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
<?php
/**
 * Created by PhpStorm.
 * User: bert
 * Date: 21/05/2015
 * Time: 15:43
 */

namespace CNetworks\EyeVent\Dal;


class FieldType extends Dal{

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
            $this->logBook->startLog('Insert of fieldtype into database');
            $this->logBook->setProvider('Cnetworks\Eyevent\Dal\FieldType');
            try {
                $this->preparedStatement = $this->pdo->prepare('CALL FieldTypeInsert(:pName)');
                $this->preparedStatement->bindValue(':pName', $this->entity->getName(), \PDO::PARAM_STR);

                if ($this->preparedStatement->execute()) {
                    $this->logBook->setMessage("The fieldtype with id=" . $this->entity->getName() . " was inserted successfully.");
                    $this->feedback->setIsError(false);
                    $this->feedback->setResult($this->entity->getName());
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
}
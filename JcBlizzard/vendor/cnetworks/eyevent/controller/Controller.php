<?php
/**
 * Created by PhpStorm.
 * User: bert
 * Date: 22/06/2015
 * Time: 9:35
 */

namespace CNetworks\EyeVent\Controller;


class Controller {

    protected $connector;
    protected $logBook;
    protected $feedback;
    protected $model;

    function __construct($feedback)
    {
        $this->feedback = $feedback;
    }

    public function initConnector()
    {
        if (!$this->connector)
        {
            $this->connector = new \CNetworks\Helpers\Dal\Connector("localhost","3306","blizzard_db","root","v0xL1d57", $this->logBook, $this->feedback);
        }
    }

    public function initLogBook()
    {
        $this->logBook = new \CNetworks\Helpers\Bll\LogBook();
    }

    public function initEventModel()
    {
        $this->initLogBook();
        $this->initConnector();
        $this->model = new \CNetworks\EyeVent\Model\Model($this->connector, $this->logBook, $this->feedback);
    }

    public function getModel()
    {
        return $this->model;
    }
}
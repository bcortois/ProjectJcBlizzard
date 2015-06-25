<?php
/**
 * Created by PhpStorm.
 * User: bert
 * Date: 6/06/2015
 * Time: 12:28
 */

namespace CNetworks\EyeVent\Model;


class Base {
    protected $connector;
    protected $logBook;
    protected $feedback;
    protected $dal;
    protected $entity;
    protected $list;

    function __construct($connector, $logBook, $feedback)
    {
        $this->connector = $connector;
        $this->logBook = $logBook;
        $this->feedback = $feedback;
        $this->list = Array();
    }

    protected function resetList()
    {
        // This statement checks if the array 'list' contains data.
        // if true it will clear out the data before use.
        if ($this->list)
        {
            unset($this->list);
        }
    }

    public function initDal()
    {
        // If a dal object already exists than the method's code won't execute.
        if (!$this->dal) {
            // If the debug function's returned array isn't set on the [0] position then this code won't execute
            // Position [1] returns a string which represents the name of the class that called this methode.
            // this code only works if we can retrieve the calling class's name.
            if (isset(debug_backtrace()[1])) {
                // [0] is ourself
                // [1] is our caller

                // The switch works with the returned string minus the '\CNetworks\EyeVent\Dal\' part.
                // With this information the switch decides which dal class is needed to produce a the object.
                switch (substr(debug_backtrace()[1]['class'], 24)) {
                    case 'Data':
                        $this->dal = new \CNetworks\EyeVent\Dal\Data($this->connector, $this->logBook, $this->feedback);
                        break;
                    case 'Event':
                        $this->dal = new \CNetworks\EyeVent\Dal\Event($this->connector, $this->logBook, $this->feedback);
                        break;
                    case 'FieldType':
                        $this->dal = new \CNetworks\EyeVent\Dal\FieldType($this->connector, $this->logBook, $this->feedback);
                        break;
                    case 'Form':
                        $this->dal = new \CNetworks\EyeVent\Dal\Form($this->connector, $this->logBook, $this->feedback);
                        break;
                    case 'InputField':
                        $this->dal = new \CNetworks\EyeVent\Dal\InputField($this->connector, $this->logBook, $this->feedback);
                        break;
                    case 'Subscriber':
                        $this->dal = new \CNetworks\EyeVent\Dal\Subscriber($this->connector, $this->logBook, $this->feedback);
                        break;
                    default:
                        echo 'PROBLEMMOOSSSS';
                }
            }
        }
    }

    // this method ensures that no unneeded objects are added.
    public function initBll()
    {
        // If a bll object already exists than the method's code won't execute.
        if (!$this->entity) {
            // If the debug function's returned array isn't set on the [0] position then this code won't execute
            // Position [1] returns a string which represents the name of the class that called this methode.
            // this code only works if we can retrieve the calling class's name.
            if (isset(debug_backtrace()[1])) {
                // [0] is ourself
                // [1] is our caller
                echo substr(debug_backtrace()[1]['class'], 24);
                // The switch works with the returned string minus the '\CNetworks\EyeVent\Bll\' part.
                // With this information the switch decides which dal class is needed to produce a the object.
                switch (substr(debug_backtrace()[1]['class'], 24)) {
                    case 'Data':
                        $this->entity = new \CNetworks\EyeVent\Bll\Data();
                        break;
                    case 'Event':
                        $this->entity = new \CNetworks\EyeVent\Bll\Event();
                        break;
                    case 'FieldType':
                        $this->entity = new \CNetworks\EyeVent\Bll\FieldType();
                        break;
                    case 'Form':
                        $this->entity = new \CNetworks\EyeVent\Bll\Form();
                        break;
                    case 'InputField':
                        $this->entity = new \CNetworks\EyeVent\Bll\InputField();
                        break;
                    case 'Subscriber':
                        $this->entity = new \CNetworks\EyeVent\Bll\Subscriber();
                        break;
                    default:
                        echo 'PROBLEMMOOSSSS';
                }
            }
        }
    }
}
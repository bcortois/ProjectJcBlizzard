<?php
/**
 * Created by PhpStorm.
 * User: bert
 * Date: 8/06/2015
 * Time: 23:11
 */

namespace CNetworks\EyeVent;


class Controller {

    protected $connector;
    protected $logBook;
    protected $feedback;
    protected $model;

    function __construct($feedback)
    {
        $this->feedback = $feedback;
    }

    public function initRequestScanner()
    {
        if (isset($_REQUEST['action'])) {
            switch($_REQUEST['action']) {
                case 'add-event':
                    $this->initLogBook();
                    $this->initConnector();
                    $formName = null;
                    $inputFieldList = Array();
                    if (isset($_POST['form-name'])) {
                        $formName = $_POST['form-name'];
                        if($_POST['input-field-names']) {
                            $inputFieldNames = explode(",",$_POST['input-field-names']);
                            foreach($inputFieldNames as $inputFieldName) {
                                $i = substr($inputFieldName, 17);
                                $inputFieldList[] = Array($_POST['input-field-name-' . $i],
                                    $_POST['input-field-comment-' . $i],
                                    $_POST['input-field-position-' . $i],
                                    $_POST['input-field-type-' . $i]
                                );
                            }
                        }
                    }
                    $this->model = new \CNetworks\EyeVent\Model\EventManager($this->connector, $this->logBook, $this->feedback);
                    $this->model->createEvent($_POST['event-name'],
                    $_POST['event-description'],
                    $_POST['event-date'],
                    addslashes(file_get_contents($_FILES['images']['tmp_name'])),
                    $_POST['event-shifts-link'],
                    $_POST['event-location-name'],
                    $_POST['event-location-address'],
                    $_POST['event-location-coordinates'],
                    $formName,
                    $inputFieldList
                    );
                    include $_SERVER['DOCUMENT_ROOT'] . '/vendor/cnetworks/helpers/view/log-report.html';
                    break;
                default :
                    break;
            }
        }
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


}
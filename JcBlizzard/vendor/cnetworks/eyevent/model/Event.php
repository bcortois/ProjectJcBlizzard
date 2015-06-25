<?php
/**
 * Created by PhpStorm.
 * User: bert
 * Date: 6/06/2015
 * Time: 0:28
 */

namespace CNetworks\EyeVent\Model;


class Event extends \CNetworks\EyeVent\Model\Base {

    /**
     * Following properties are inherited from \CNetworks\EyeVent\Model\Base:
     * - $connector
     * - $logBook
     * - $feedback
     * - $dal
     * - $entity
     * - $list
     * Following methods are inherited from \CNetworks\EyeVent\Model\Base:
     * - resetList()
     * - initDal()
     * - initBll()
     */

    protected $bllEvent;
    protected $bllForm;

    public function initBll()
    {
        // If a bll object already exists than the method's code won't execute.
        if (!$this->bllEvent) {
            $this->bllEvent = new \CNetworks\EyeVent\Bll\Event();
        }
        if (!$this->bllForm) {
            $this->bllForm = new \CNetworks\EyeVent\Bll\Form();
        }
    }

    public function loadAll()
    {
        $this->resetList();
        $this->initDal();
        foreach ($this->dal->selectAll() as $row)
        {
            $event = new \CNetworks\EyeVent\Bll\Event();
            $event->setId($row['event_id']);
            $event->setName($row['event_name']);
            $event->setDate($row['event_date']);
            $this->list[] = $event;
        }
        return $this->list;
    }

    public function saveOne($name, $description, $date, $image, $shiftsLink, $locationName, $locationAddress, $locationCoordinates)
    {
        $this->initDal();
        $this->initBll();
        $this->entity->setName($name);
        $this->entity->setDescription($description);
        $this->entity->setDate($date);
        $this->entity->setImage($image);
        $this->entity->setShiftsLink($shiftsLink);
        $this->entity->setLocationName($locationName);
        $this->entity->setlocationAddress($locationAddress);
        $this->entity->setLocationCoordinates($locationCoordinates);
        $this->dal->insert($this->entity);
    }
}
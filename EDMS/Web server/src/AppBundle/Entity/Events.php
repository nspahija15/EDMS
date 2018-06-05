<?php
/**
 * Created by PhpStorm.
 * User: archey
 * Date: 13.05.18
 * Time: 22:36
 */

namespace AppBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repositories\Events_Repository")
 * @ORM\Table(name="events")
 */
class Events
{



    public function __construct()
    {

        $this->participatns = new ArrayCollection();

    }


    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;



    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\EventParticipants", mappedBy="event")
     */
    private $participatns;


    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Person", inversedBy="events_created")
     */
    private $event_manager;


    /**
     * @ORM\Column(type="string")
     */
    private $description;


    /**
     *
     * @ORM\Column(type="datetime")
     */
    private $date;


    /**
     * @ORM\Column(type="string")
     */
    private $place;


    /**
     * @ORM\Column(type="boolean")
     */
    private $isConfirmed;


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @return mixed
     */
    public function getParticipatns()
    {
        return $this->participatns;
    }

    /**
     * @param mixed $participatns
     */
    public function setParticipatns($participatns)
    {
        $this->participatns = $participatns;
    }

    /**
     * @return mixed
     */
    public function getEventManager()
    {
        return $this->event_manager;
    }



    /**
     * @param mixed $event_manager
     */
    public function setEventManager($event_manager)
    {
        $this->event_manager = $event_manager;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * @param mixed $place
     */
    public function setPlace($place)
    {
        $this->place = $place;
    }


    /**
     * @return mixed
     */
    public function getisConfirmed()
    {
        return $this->isConfirmed;
    }



    /**
     * @param mixed $isConfirmed
     */
    public function setIsConfirmed($isConfirmed)
    {
        $this->isConfirmed = $isConfirmed;
    }


    public function __toString()
    {

        /** @var \DateTime $dt */
        $dt = $this->getDate();

        return $this->description.".  Time it will take place: ".date('yyy-MM-dd hh:mm',$dt->getTimestamp());

    }



}
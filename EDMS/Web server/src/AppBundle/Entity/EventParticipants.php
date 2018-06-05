<?php
/**
 * Created by PhpStorm.
 * User: archey
 * Date: 13.05.18
 * Time: 22:37
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="AppBundle\Repositories\EventParticipants_Repository")
 * @ORM\Table(name="event_participants")
 */
class EventParticipants
{

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;


    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Person", inversedBy="student_mapped_events" )
     */
    private $participating_stud;


    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Events", inversedBy="participatns")
     */
    private $event;


    /**
     * @ORM\Column(type="boolean")
     */
    private $isParticipating;


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
    public function getParticipatingStud()
    {
        return $this->participating_stud;
    }

    /**
     * @param mixed $participating_stud
     */
    public function setParticipatingStud($participating_stud)
    {
        $this->participating_stud = $participating_stud;
    }

    /**
     * @return mixed
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * @param mixed $event
     */
    public function setEvent($event)
    {
        $this->event = $event;
    }

    /**
     * @return mixed
     */
    public function getisParticipating()
    {
        return $this->isParticipating;
    }

    /**
     * @param mixed $isParticipating
     */
    public function setIsParticipating($isParticipating)
    {
        $this->isParticipating = $isParticipating;
    }


}
<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Performances
 *
 * @ORM\Table(name="performances")
 * @ORM\Entity(repositoryClass="AppBundle\Repositories\Performances_Repository")
 */
class Performances
{
    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=50, nullable=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=100, nullable=true)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_assigned", type="date", nullable=true)
     */
    private $dateAssigned;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Person
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Person", inversedBy="studentPerformances")
     */
    private $student;

    /**
     * @var \AppBundle\Entity\Person
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Person", inversedBy="assistantaddedPerformances")
     */
    private $assistant;




    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return \DateTime
     */
    public function getDateAssigned()
    {
        return $this->dateAssigned;
    }

    /**
     * @param \DateTime $dateAssigned
     */
    public function setDateAssigned($dateAssigned)
    {
        $this->dateAssigned = $dateAssigned;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return Person
     */
    public function getStudent()
    {
        return $this->student;
    }

    /**
     * @param Person $student
     */
    public function setStudent($student)
    {
        $this->student = $student;
    }

    /**
     * @return Person
     */
    public function getAssistant()
    {
        return $this->assistant;
    }

    /**
     * @param Person $assistant
     */
    public function setAssistant($assistant)
    {
        $this->assistant = $assistant;
    }




}


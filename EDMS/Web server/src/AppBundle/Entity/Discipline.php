<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Discipline
 *
 * @ORM\Table(name="discipline")
 * @ORM\Entity
 */
class Discipline
{

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=100, nullable=true)
     */
    private $description;

    /**
     *
     * @ORM\Column(name="points", type="integer", nullable=true)
     */
    private $points;


    /**
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="smallint")
     * @ORM\Id
     */
    private $id;


    /**
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Person", inversedBy="disciplines")
     */
    private $student;


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
     * @return int
     */
    public function getPoints()
    {
        return $this->points;
    }


    /**
     * @param int $points
     */
    public function setPoints($points)
    {
        $this->points = $points;
    }

    
    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
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


}


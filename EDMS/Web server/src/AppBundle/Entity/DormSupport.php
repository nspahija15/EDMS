<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use \Doctrine\Common\Collections\ArrayCollection;


/**
 * DormSupport
 *
 * @ORM\Table(name="dorm_support")
 * @ORM\Entity
 */
class DormSupport
{

    /**
     * @var \DateTime
     * @ORM\Column(name="use_start_date", type="date", nullable=true)
     */
    private $useStartDate;

    /**
     * @var \DateTime
     * @ORM\Column(name="use_end_date", type="date", nullable=true)
     */
    private $useEndDate;

    /**
     * @var boolean
     * @ORM\Column(name="isApproved", type="boolean", nullable=true)
     */
    private $isapproved;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isDelivered", type="boolean", nullable=true)
     */
    private $isdelivered;


    /**
     * @var string
     *
     * @ORM\Column(name="descrition", type="string", length=100, nullable=true)
     */
    private $descrition;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="smallint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Person", inversedBy="dormSupportAssistant")
     */
    private $assistant;

    /**
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Person", inversedBy="dormsupportStudent")
     */
    private $student;


    /**
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\DormObjectsSupported", mappedBy="support")
     */

    private $dormObjectssupp;


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->dormObjectssupp = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getDormObjectssupp()
    {
        return $this->dormObjectssupp;
    }

    /**
     * @param mixed $dormObjectssupp
     */
    public function setDormObjectssupp($dormObjectssupp)
    {
        $this->dormObjectssupp = $dormObjectssupp;
    }



    /**
     * @return \DateTime
     */
    public function getUseStartDate()
    {
        return $this->useStartDate;
    }

    /**
     * @param \DateTime $useStartDate
     */
    public function setUseStartDate($useStartDate)
    {
        $this->useStartDate = $useStartDate;
    }

    /**
     * @return \DateTime
     */
    public function getUseEndDate()
    {
        return $this->useEndDate;
    }

    /**
     * @param \DateTime $useEndDate
     */
    public function setUseEndDate($useEndDate)
    {
        $this->useEndDate = $useEndDate;
    }

    /**
     * @return bool
     */
    public function isIsapproved()
    {
        return $this->isapproved;
    }

    /**
     * @param bool $isapproved
     */
    public function setIsapproved($isapproved)
    {
        $this->isapproved = $isapproved;
    }

    /**
     * @return bool
     */
    public function isIsdelivered()
    {
        return $this->isdelivered;
    }

    /**
     * @param bool $isdelivered
     */
    public function setIsdelivered($isdelivered)
    {
        $this->isdelivered = $isdelivered;
    }

    /**
     * @return string
     */
    public function getDescrition()
    {
        return $this->descrition;
    }

    /**
     * @param string $descrition
     */
    public function setDescrition($descrition)
    {
        $this->descrition = $descrition;
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


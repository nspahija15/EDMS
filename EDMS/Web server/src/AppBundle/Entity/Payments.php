<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Payments
 *
 * @ORM\Table(name="payments")
 * @ORM\Entity(repositoryClass="AppBundle\Repositories\Payments_Repository")
 */

class Payments
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_p", type="date", nullable=true)
     */
    private $dateP;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\AcademicYear", inversedBy="payment_id")
     */
    private $academicYear;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=100, nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="notes", type="string", length=100, nullable=true)
     */
    private $notes;

    /**
     * @var string
     *
     * @ORM\Column(name="amount", type="string", length=100, nullable=true)
     */
    private $amount;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=50, nullable=true)
     */
    private $type;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isProcessed", type="boolean", nullable=true)
     */
    private $isprocessed;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="smallint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \AppBundle\Entity\Person
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Person",inversedBy="payments")

     */
    private $student;

    /**
     * @return \DateTime
     */
    public function getDateP()
    {
        return $this->dateP;
    }

    /**
     * @param \DateTime $dateP
     */
    public function setDateP($dateP)
    {
        $this->dateP = $dateP;
    }

    /**
     * @return int
     */
    public function getAcademicYear()
    {
        return $this->academicYear;
    }

    /**
     * @param int $academicYear
     */
    public function setAcademicYear($academicYear)
    {
        $this->academicYear = $academicYear;
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
     * @return string
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * @param string $notes
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;
    }

    /**
     * @return string
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param string $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return bool
     */
    public function isIsprocessed()
    {
        return $this->isprocessed;
    }

    /**
     * @param bool $isprocessed
     */
    public function setIsprocessed($isprocessed)
    {
        $this->isprocessed = $isprocessed;
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


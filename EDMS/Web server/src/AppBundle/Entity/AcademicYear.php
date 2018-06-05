<?php
/**
 * Created by PhpStorm.
 * User: archey
 * Date: 26.05.18
 * Time: 05:29
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="AppBundle\Repositories\AcademicYear_Repositories")
 * @ORM\Table(name="academic_year")
 */
class AcademicYear
{


    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $year;

    /**
     * @ORM\Column(type="string")
     */
    private $semester;


    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Dormapplication", mappedBy="academic_year")
     */
    private $dorm_application;


    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Person", mappedBy="academic_year")
     */
    private $member_id;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Payments", mappedBy="academicYear")
     */
    private $payment_id;


    /**
     * @ORM\Column(type="date")
     */
    private $start_date;

    /**
     * @ORM\Column(type="date")
     */
    private $end_date;


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
    public function getYear()
    {
        return $this->year;
    }


    /**
     * @param mixed $year
     */
    public function setYear($year)
    {
        $this->year = $year;
    }

    /**
     * @return mixed
     */
    public function getSemester()
    {
        return $this->semester;
    }

    /**
     * @param mixed $semester
     */
    public function setSemester($semester)
    {
        $this->semester = $semester;
    }

    /**
     * @return mixed
     */
    public function getDormApplication()
    {
        return $this->dorm_application;
    }


    /**
     * @return mixed
     */
    public function getMemberId()
    {
        return $this->member_id;
    }

    /**
     * @param mixed $member_id
     */
    public function setMemberId($member_id)
    {
        $this->member_id = $member_id;
    }

    /**
     * @return mixed
     */
    public function getPaymentId()
    {
        return $this->payment_id;
    }

    /**
     * @param mixed $payment_id
     */
    public function setPaymentId($payment_id)
    {
        $this->payment_id = $payment_id;
    }

    /**
     * @return mixed
     */
    public function getStartDate()
    {
        return $this->start_date;
    }

    /**
     * @param mixed $start_date
     */
    public function setStartDate($start_date)
    {
        $this->start_date = $start_date;
    }

    /**
     * @return mixed
     */
    public function getEndDate()
    {
        return $this->end_date;
    }

    /**
     * @param mixed $end_date
     */
    public function setEndDate($end_date)
    {
        $this->end_date = $end_date;
    }


    public function __toString()
    {
      return $this->getSemester()." ";
    }
}
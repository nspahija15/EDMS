<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 *
 * @ORM\Table(name="dormApplication")
 * @ORM\Entity(repositoryClass="AppBundle\Repositories\Dormapplication_Repository")
 */
class Dormapplication
{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="smallint")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\Column(type="integer",unique=true)
     */

    private $card_id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="surname", type="string", length=100, nullable=true)
     */
    private $surname;

    /**
     * @var string
     *
     * @ORM\Column(name="nationality", type="string", length=100, nullable=true)
     */
    private $nationality;


    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\AcademicYear", inversedBy="dorm_application")
     */
    private $academic_year;

    /**
     * @var string
     *
     * @ORM\Column(name="birthday", type="string", length=100, nullable=true)
     */
    private $birthday;

    /**
     * @var string
     *
     * @ORM\Column(name="city", type="string", length=100, nullable=true)
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="phone_nr", type="string", length=20, nullable=true)
     */
    private $phoneNr;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=100, nullable=true)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100, nullable=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="department", type="string", length=50, nullable=true)
     */
    private $department;

    /**
     * @var string
     *
     * @ORM\Column(name="fathersname", type="string", length=100, nullable=true)
     */
    private $fathersname;

    /**
     * @var string
     *
     * @ORM\Column(name="fatherssurname", type="string", length=100, nullable=true)
     */
    private $fatherssurname;

    /**
     * @var string
     *
     * @ORM\Column(name="fathersphone_nr", type="string", length=20, nullable=true)
     */
    private $fathersphoneNr;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $fathersJob;



    /**
     * @var string
     *
     * @ORM\Column(name="mothersname", type="string", length=100, nullable=true)
     */
    private $mothersname;

    /**
     * @var string
     *
     * @ORM\Column(name="motherssurname", type="string", length=100, nullable=true)
     */
    private $motherssurname;

    /**
     * @var string
     *
     * @ORM\Column(name="mothersphone_nr", type="string", length=20, nullable=true)
     */
    private $mothersphoneNr;

    /**
     * @var string
     *
     * @ORM\Column(type="string",  nullable=true)
     */
    private $mothersJob;



    /**
     * @var string
     *
     * @ORM\Column(name="parent_marit_status", type="string", length=10, nullable=true)
     */
    private $parentMaritStatus;

    /**
     * @var boolean
     *
     * @ORM\Column(name="isAccepted", type="boolean", nullable=false)
     */
    private $isaccepted;

    /**
     *
     * @ORM\Column(name="image", type="string", length=100, nullable=true)
     */
    private $image;


    /**
     * @ORM\Column(type="string")
     */
    private $type = 'applicant';


    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getCardId()
    {
        return $this->card_id;
    }

    /**
     * @param mixed $card_id
     */
    public function setCardId($card_id)
    {
        $this->card_id = $card_id;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }



    /**
     * @return string
     */
    public function getPhoneNr()
    {
        return $this->phoneNr;
    }

    /**
     * @param string $phoneNr
     */
    public function setPhoneNr($phoneNr)
    {
        $this->phoneNr = $phoneNr;
    }

    /**
     * @return string
     */
    public function getFathersphoneNr()
    {
        return $this->fathersphoneNr;
    }

    /**
     * @param string $fathersphoneNr
     */
    public function setFathersphoneNr($fathersphoneNr)
    {
        $this->fathersphoneNr = $fathersphoneNr;
    }

    /**
     * @return string
     */
    public function getMothersphoneNr()
    {
        return $this->mothersphoneNr;
    }

    /**
     * @param string $mothersphoneNr
     */
    public function setMothersphoneNr($mothersphoneNr)
    {
        $this->mothersphoneNr = $mothersphoneNr;
    }


    /**
     * @return string
     */
    public function getParentMaritStatus()
    {
        return $this->parentMaritStatus;
    }


    /**
     * @param string $parentMaritStatus
     */
    public function setParentMaritStatus($parentMaritStatus)
    {
        $this->parentMaritStatus = $parentMaritStatus;
    }


    /**
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @param string $surname
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    /**
     * @return string
     */
    public function getNationality()
    {
        return $this->nationality;
    }

    /**
     * @param string $nationality
     */
    public function setNationality($nationality)
    {
        $this->nationality = $nationality;
    }

    /**
     * @return string
     */
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * @param string $birthday
     */
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phoneNr;
    }

    /**
     * @param string $phoneNr
     */
    public function setPhoneNumber($phoneNr)
    {
        $this->phoneNr = $phoneNr;
    }

    /**
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param string $address
     */
    public function setAddress($address)
    {
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getAcademicYear()
    {
        return $this->academic_year;
    }

    /**
     * @param mixed $academic_year
     */
    public function setAcademicYear($academic_year)
    {
        $this->academic_year = $academic_year;
    }


    /**
     * @return string
     */
    public function getDepartment()
    {
        return $this->department;
    }

    /**
     * @param string $department
     */
    public function setDepartment($department)
    {
        $this->department = $department;
    }

    /**
     * @return string
     */
    public function getFathersname()
    {
        return $this->fathersname;
    }

    /**
     * @param string $fathersname
     */
    public function setFathersname($fathersname)
    {
        $this->fathersname = $fathersname;
    }

    /**
     * @return string
     */
    public function getFatherssurname()
    {
        return $this->fatherssurname;
    }

    /**
     * @param string $fatherssurname
     */
    public function setFatherssurname($fatherssurname)
    {
        $this->fatherssurname = $fatherssurname;
    }




    /**
     * @return string
     */
    public function getFathersPhoneNumber()
    {
        return $this->fathersphoneNr;
    }

    /**
     * @param string $fathersphoneNr
     */
    public function setFathersPhoneNumber($fathersphoneNr)
    {
        $this->fathersphoneNr = $fathersphoneNr;
    }

    /**
     * @return string
     */
    public function getMothersname()
    {
        return $this->mothersname;
    }

    /**
     * @param string $mothersname
     */
    public function setMothersname($mothersname)
    {
        $this->mothersname = $mothersname;
    }

    /**
     * @return string
     */
    public function getMothersSurname()
    {
        return $this->motherssurname;
    }

    /**
     * @param string $motherssurname
     */
    public function setMothersSurname($motherssurname)
    {
        $this->motherssurname = $motherssurname;
    }

    /**
     * @return string
     */
    public function getMothersPhoneNumber()
    {
        return $this->mothersphoneNr;
    }

    /**
     * @param string $mothersphoneNr
     */
    public function setMothersPhoneNumber($mothersphoneNr)
    {
        $this->mothersphoneNr = $mothersphoneNr;
    }

    /**
     * @return string
     */
    public function getFathersJob()
    {
        return $this->fathersJob;
    }

    /**
     * @param string $fathersJob
     */
    public function setFathersJob($fathersJob)
    {
        $this->fathersJob = $fathersJob;
    }

    /**
     * @return string
     */
    public function getMothersJob()
    {
        return $this->mothersJob;
    }


    /**
     * @param string $mothersJob
     */
    public function setMothersJob($mothersJob)
    {
        $this->mothersJob = $mothersJob;
    }



    /**
     * @return string
     */
    public function getMaritalStatus()
    {
        return $this->parentMaritStatus;
    }

    /**
     * @param string $parentMaritStatus
     */
    public function setMaritalStatus($parentMaritStatus)
    {
        $this->parentMaritStatus = $parentMaritStatus;
    }

    /**
     * @return bool
     */
    public function isIsaccepted()
    {
        return $this->isaccepted;
    }

    /**
     * @param bool $isaccepted
     */
    public function setIsaccepted($isaccepted)
    {
        $this->isaccepted = $isaccepted;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }



}


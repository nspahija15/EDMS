<?php
/**
 * Created by PhpStorm.
 * User: archey
 * Date: 20.03.18
 * Time: 01:51
 */

namespace AppBundle\Entity;


use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;



/**
 * @ORM\Entity(repositoryClass="AppBundle\Repositories\Person_Repository")
 * @ORM\Table(name="person")
 */
class Person implements UserInterface
{


    public function __construct()
    {
        $this->disciplines = new ArrayCollection();
        $this->dormSupportAssistant = new ArrayCollection();
        $this->payments = new ArrayCollection();
        $this->studentPerformances = new ArrayCollection();
        $this->assistantaddedPerformances = new ArrayCollection();
        $this->events_created = new ArrayCollection();
        $this->student_mapped_events = new ArrayCollection();
    }


    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="string")
     */
    private $surname;

    /**
     * @ORM\Column(type="string",unique=true)
     */
    private $username;

    /**
     * @ORM\Column(type="string",unique=true)
     */
    private $card_id;

    /**
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string",unique=true)
     */
    private $email;



    /**
     *@ORM\Column(type="json_array")
     */

    private $roles = array();


    /**
     * @ORM\Column(type="text")
     */
    private $type;


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



    // --------------------------------



    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Discipline", mappedBy="student")
     */
    private $disciplines;


    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\DormSupport", mappedBy="assistant")
     */
    private $dormSupportAssistant;


    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\DormObjectsSupported", mappedBy="supp_student")
     */
    private $dormsupportObjects;


    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Payments", mappedBy="student")
     */
    private $payments;


    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Performances", mappedBy="student")
     */
    private $studentPerformances;


    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Performances", mappedBy="assistant")
     */
    private $assistantaddedPerformances;



    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Events", mappedBy="event_manager"))
     */
    private $events_created;


    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\EventParticipants", mappedBy="participating_stud")
     */
    private $student_mapped_events;


    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\AcademicYear", inversedBy="member_id")
     */
    private $academic_year;


    /**
     * @return mixed
     */
    public function getDisciplines()
    {
        return $this->disciplines;
    }

    /**
     * @param mixed $disciplines
     */
    public function setDisciplines($disciplines)
    {
        $this->disciplines = $disciplines;
    }

    /**
     * @return mixed
     */
    public function getDormsupportObjects()
    {
        return $this->dormsupportObjects;
    }

    /**
     * @param mixed $dormsupportObjects
     */
    public function setDormsupportObjects($dormsupportObjects)
    {
        $this->dormsupportObjects = $dormsupportObjects;
    }



    /**
     * @return mixed
     */
    public function getDormSupportAssistant()
    {
        return $this->dormSupportAssistant;
    }

    /**
     * @param mixed $dormSupportAssistant
     */
    public function setDormSupportAssistant($dormSupportAssistant)
    {
        $this->dormSupportAssistant = $dormSupportAssistant;
    }



    /**
     * @return mixed
     */
    public function getPayments()
    {
        return $this->payments;
    }

    /**
     * @param mixed $payments
     */
    public function setPayments($payments)
    {
        $this->payments = $payments;
    }

    /**
     * @return mixed
     */
    public function getStudentPerformances()
    {
        return $this->studentPerformances;
    }

    /**
     * @param mixed $studentPerformances
     */
    public function setStudentPerformances($studentPerformances)
    {
        $this->studentPerformances = $studentPerformances;
    }

    /**
     * @return mixed
     */
    public function getAssistantaddedPerformances()
    {
        return $this->assistantaddedPerformances;
    }

    /**
     * @param mixed $assistantaddedPerformances
     */
    public function setAssistantaddedPerformances($assistantaddedPerformances)
    {
        $this->assistantaddedPerformances = $assistantaddedPerformances;
    }




    /**
     * @var string
     *
     * @ORM\Column(name="nationality", type="string", length=100, nullable=true)
     */
    private $nationality;

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
     * @ORM\Column(type="string",nullable=true)
     */
    private  $fathersJob;


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
     * @ORM\Column(type="string", nullable=true)
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
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=100, nullable=true)
     */
    private $image;


    /**
     * @ORM\Column(type="boolean")
     */
    private $existOnServer;


    //------------------------------------

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * @param mixed $surname
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
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
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getExistOnServer()
    {
        return $this->existOnServer;
    }

    /**
     * @param mixed $existOnServer
     */
    public function setExistOnServer($existOnServer)
    {
        $this->existOnServer = $existOnServer;
    }



    public function setRoles($roles)
    {
        $this->roles = $roles;
    }


    /**
     * return an array of Roles
     * @return \[]
     */

    public function getRoles()
    {

        if(!$this->roles)
            return array();

//      if(!in_array('ROLES_USER',$this->roles)){
//          $this->roles[]='ROLES_USER';
//      }

        return $this->roles;

    }






    // newest attributes



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
    public function getMotherssurname()
    {
        return $this->motherssurname;
    }

    /**
     * @param string $motherssurname
     */
    public function setMotherssurname($motherssurname)
    {
        $this->motherssurname = $motherssurname;
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
     * @return mixed
     */
    public function getFathersJob()
    {
        return $this->fathersJob;
    }

    /**
     * @param mixed $fathersJob
     */
    public function setFathersJob($fathersJob)
    {
        $this->fathersJob = $fathersJob;
    }

    /**
     * @return mixed
     */
    public function getMothersJob()
    {
        return $this->mothersJob;
    }

    /**
     * @param mixed $mothersJob
     */
    public function setMothersJob($mothersJob)
    {
        $this->mothersJob = $mothersJob;
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
     * @return mixed
     */
    public function getEventsCreated()
    {
        return $this->events_created;
    }



    /**
     * @return mixed
     */
    public function getStudentMappedEvents()
    {
        return $this->student_mapped_events;
    }


    // --------------------------------------


    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }


    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }


    // show the user
    public function __toString()
    {
        return $this->name." ".$this->surname;
    }


}
<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use \Doctrine\Common\Collections\ArrayCollection;

/**
 * DormObjects
 *
 * @ORM\Table(name="dorm_objects")
 * @ORM\Entity
 */
class DormObjects
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=true)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="amount", type="integer", nullable=true)
     */
    private $amount;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=100, nullable=true)
     */
    private $description;

    /**
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="smallint")
     * @ORM\Id
     */
    private $id;

    /**
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\DormObjectsSupported", mappedBy="supp_dormObjects")
     */
    private $dormSupportObjects;




    /**
     * Constructor
     */
    public function __construct()
    {
        $this->dormSupportObjects = new ArrayCollection();
    }

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
     * @return int
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param int $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
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
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @return mixed
     */
    public function getDormSupportObjects()
    {
        return $this->dormSupportObjects;
    }

    /**
     * @param mixed $dormSupportObjects
     */
    public function setDormSupportObjects($dormSupportObjects)
    {
        $this->dormSupportObjects = $dormSupportObjects;
    }

}


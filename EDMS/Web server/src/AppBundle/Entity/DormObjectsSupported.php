<?php
/**
 * Created by PhpStorm.
 * User: archey
 * Date: 13.05.18
 * Time: 21:44
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(name="dorm_objects_supported")
 */
class DormObjectsSupported
{


    /**
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     */
    private $id;

    /**
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\DormSupport", inversedBy="dormObjectssupp" )
     */
    private $support;


    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\DormObjects", inversedBy="dormSupportObjects")
     */
    private $supp_dormObjects;


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
     * @return mixed
     */
    public function getSuppDormObjects()
    {
        return $this->supp_dormObjects;
    }

    /**
     * @param mixed $supp_dormObjects
     */
    public function setSuppDormObjects($supp_dormObjects)
    {
        $this->supp_dormObjects = $supp_dormObjects;
    }


    /**
     * @return mixed
     */
    public function getSupport()
    {
        return $this->support;
    }


    /**
     * @param mixed $support
     */
    public function setSupport($support)
    {
        $this->support = $support;
    }


}
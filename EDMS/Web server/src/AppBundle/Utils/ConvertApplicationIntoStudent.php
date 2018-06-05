<?php
/**
 * Created by PhpStorm.
 * User: archey
 * Date: 26.05.18
 * Time: 11:57
 */

namespace AppBundle\Utils;

use AppBundle\Entity\Person;
use AppBundle\Entity\Dormapplication;

class ConvertApplicationIntoStudent
{


    public function __construct(Dormapplication $dormapp)
    {
        $this->dormapplication = $dormapp;
    }


    /** @var Dormapplication $dormapplication */
    private $dormapplication;


    public function convert(){

        if(!$this->dormapplication)
            return null;
        else{
            $dormapplication = $this->dormapplication;
        }


        $student = new Person();

        $student->setName($dormapplication->getName());
        $student->setSurname($dormapplication->getSurname());
        $student->setImage($dormapplication->getImage());
        $student->setCardId($dormapplication->getCardId());

        $username = strtolower(substr($dormapplication->getName(),0,1)).strtolower($dormapplication->getSurname());

        $student->setUsername($username);
        $student->setPassword($username);

        $student->setEmail($dormapplication->getEmail());
        $student->setRoles(array('ROLE_STUDENT'));
        $student->setNationality($dormapplication->getNationality());
        $student->setBirthday($dormapplication->getBirthday());

        $student->setBirthday($student->getBirthday());

        $student->setCity($dormapplication->getCity());
        $student->setPhoneNr($dormapplication->getPhoneNumber());
        $student->setAddress($dormapplication->getAddress());
        $student->setDepartment($dormapplication->getDepartment());

        $student->setFathersname($dormapplication->getFathersname());
        $student->setFatherssurname($dormapplication->getFatherssurname());
        $student->setFathersphoneNr($dormapplication->getFathersPhoneNumber());
        $student->setFathersJob($dormapplication->getFathersJob());

        $student->setMothersname($dormapplication->getMothersname());
        $student->setMotherssurname($dormapplication->getMotherssurname());
        $student->setMothersJob($dormapplication->getMothersJob());
        $student->setMothersphoneNr($dormapplication->getMothersPhoneNumber());
        $student->setParentMaritStatus($dormapplication->getMaritalStatus());
        $student->setIsaccepted(true);
        $student->setImage($dormapplication->getImage());
        $student->setExistOnServer(false);
        $student->setType('student');

        return $student;
    }


}
<?php
/**
 * Created by PhpStorm.
 * User: archey
 * Date: 13.05.18
 * Time: 23:03
 */

namespace AppBundle\DataFixtures;

use AppBundle\Entity\Person;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;


class PersonFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {


            // setting up the fixtures



//        $user = new Person();
//        $user->setUsername('admin');


//        $password = $this->encoder->encodePassword($user, 'pass_1234');
//        $user->setPassword($password);


//        $manager->persist($user);
//        $manager->flush();



    }


}
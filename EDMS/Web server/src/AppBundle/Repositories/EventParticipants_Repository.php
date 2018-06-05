<?php
/**
 * Created by PhpStorm.
 * User: archey
 * Date: 19.05.18
 * Time: 12:42
 */

namespace AppBundle\Repositories;
use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\Events;


class EventParticipants_Repository extends EntityRepository
{


    public function getEventsOfTheUserId($user_id){

        return $this->createQueryBuilder('ep')
            ->join('ep.event','event')
            ->where('ep.participating_stud = :studId')
            ->andWhere('event.isConfirmed = TRUE')
            ->setParameter('studId',$user_id)
            ->getQuery()
            ->execute();
    }


}
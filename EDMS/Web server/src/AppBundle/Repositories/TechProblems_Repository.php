<?php
/**
 * Created by PhpStorm.
 * User: archey
 * Date: 03.05.18
 * Time: 13:39
 */

namespace AppBundle\Repositories;


use Doctrine\ORM\EntityRepository;

class TechProblems_Repository extends EntityRepository
{


    public function get_unconfired_fixed_dormProblems(){

        return $this->createQueryBuilder('tp')
            ->where('tp.isConfirmed = FALSE')
            ->andWhere("tp.status = 'fixed'")
            ->getQuery()
            ->execute();
    }

    public function get_unconfired_problems_dormProblems(){

        return $this->createQueryBuilder('tp')
            ->where('tp.isConfirmed = FALSE')
            ->andWhere("tp.status = 'fixed'")
            ->getQuery()
            ->execute();
    }

    public function get_fixed_DormProblems(){

        return $this->createQueryBuilder('tp')
            ->Where("tp.status = 'fixed'")
            ->getQuery()
            ->execute();

    }


    public function get_pending_DormProblems(){

        return $this->createQueryBuilder('tp')
//            ->where('tp.isConfirmed = FALSE')
            ->Where("tp.status = 'pending'")
//            ->orWhere("tp.status = 'considered'")
            ->getQuery()
            ->execute();

    }


    public function get_todo_dormProblems(){

        return $this->createQueryBuilder('tp')
            ->where('tp.isConfirmed = FALSE')
            ->andWhere("tp.status = 'considered'")
            ->getQuery()
            ->execute();

    }

    public function get_fixed_tech_problems(){

        return $this->createQueryBuilder('tp')
            ->where('tp.isConfirmed = FALSE')
            ->andWhere("tp.status = 'fixed'")
            ->getQuery()
            ->execute();

    }


}
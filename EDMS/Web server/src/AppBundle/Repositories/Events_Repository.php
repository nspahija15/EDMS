<?php
/**
 * Created by PhpStorm.
 * User: archey
 * Date: 16.05.18
 * Time: 15:35
 */

namespace AppBundle\Repositories;

use Doctrine\ORM\EntityRepository;


class Events_Repository extends EntityRepository
{


    public function getAllNewEvents(){
        return $this->createQueryBuilder('e')
            ->where('CURRENT_TIMESTAMP() < e.date')
            ->getQuery()
            ->execute();

    }


    public function getAllOldEvents(){
        return $this->createQueryBuilder('e')
            ->where('CURRENT_TIMESTAMP() > e.date')
            ->andWhere("e.isConfirmed = TRUE")
            ->getQuery()
            ->execute();
    }


    public function getAllunconfirmedEvents(){
        return $this->createQueryBuilder('e')
            ->where('e.isConfirmed = FALSE')
            ->getQuery()
            ->execute();
    }

    public function countUnoccuredEvents(){
        $val = $this->createQueryBuilder('e')
            ->select('COUNT(e.id)')
            ->where('CURRENT_TIMESTAMP() < e.date')
            ->getQuery()
            ->getOneOrNullResult();
        if(!$val)
            return 0;
        return $val[1];
    }


}
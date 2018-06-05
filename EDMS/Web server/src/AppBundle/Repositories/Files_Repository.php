<?php
/**
 * Created by PhpStorm.
 * User: archey
 * Date: 20.05.18
 * Time: 02:25
 */

namespace AppBundle\Repositories;

use Doctrine\ORM\EntityRepository;


class Files_Repository extends EntityRepository
{


    public function getAllCamerasGroupByDays(){

        return $this->createQueryBuilder('f')
            ->where("f.type = 'image'")
            ->orderBy('f.date','DESC')
            ->getQuery()
            ->execute();

    }

    public function getAllLogsGroupByDays(){

        return $this->createQueryBuilder('f')
            ->where("f.type='log'")
            ->orderBy('f.name','DESC')
            ->getQuery()
            ->execute();

    }



    public function searchFilesByName($file_name){

        return $this->createQueryBuilder('f')
            ->where('f.name = :file_name')
            ->setParameter('file_name',$file_name)
            ->getQuery()
            ->execute();

    }


}
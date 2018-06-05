<?php
/**
 * Created by PhpStorm.
 * User: archey
 * Date: 26.05.18
 * Time: 18:09
 */

namespace AppBundle\Repositories;

use Doctrine\ORM\EntityRepository;

class AcademicYear_Repositories extends EntityRepository
{


    public function getNowAyear(){
        try{
            return $this->createQueryBuilder('ayr')
                ->where('ayr.start_date < CURRENT_DATE()')
                ->andWhere('ayr.end_date > CURRENT_DATE()')
                ->getQuery()
                ->getOneOrNullResult();
        }catch (\Exception $e){
            return null;
        }
    }



    public function getActiveAcademicYears(){

        return $this->createQueryBuilder('ayr')
            ->where('ayr.start_date < CURRENT_DATE()')
            ->andWhere('ayr.end_date > CURRENT_DATE()')
            ->getQuery()
            ->execute();

    }



    public function getInactiveAcademicYears(){

        return $this->createQueryBuilder('ayr')
            ->where('ayr.start_date > CURRENT_DATE()')
            ->orWhere('ayr.end_date < CURRENT_DATE()')
            ->getQuery()
            ->execute();

    }


    public function checkIfItisAvailable(){

        $dt = $this->getActiveAcademicYears();

        if(count($dt)==0)
            return false;

        return true;
    }





}

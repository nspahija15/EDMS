<?php
/**
 * Created by PhpStorm.
 * User: archey
 * Date: 01.05.18
 * Time: 22:45
 */

namespace AppBundle\Repositories;
use Doctrine\ORM\EntityRepository;



class Dormapplication_Repository extends EntityRepository
{


    public function gettheNumberOFApplciants(){

        try {
            $val = $this->createQueryBuilder('d')
                ->select("COUNT(d.id)")
                ->innerJoin('d.academic_year', 'ac', 'WITH', 'ac.start_date < current_date() and ac.end_date > current_date()')
                ->getQuery()
                ->getOneOrNullResult();
        }catch (\Exception $e){
            return 0;
        }

       if(!$val)
           return 0;

       return $val[1];

    }

    public function getacceptedApplicants(){
        return $this->createQueryBuilder('d')
            ->where('d.isaccepted = TRUE')
            ->innerJoin('d.academic_year', 'ac', 'WITH', 'ac.start_date < current_date() and ac.end_date > current_date()')
            ->getQuery()
            ->execute();
    }


    public function getrejetedApplicants(){
        return $this->createQueryBuilder('d')
            ->where('d.isaccepted = FALSE')
            ->innerJoin('d.academic_year', 'ac', 'WITH', 'ac.start_date < current_date() and ac.end_date > current_date()')
            ->getQuery()
            ->execute();
    }



}
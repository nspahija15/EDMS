<?php
/**
 * Created by PhpStorm.
 * User: archey
 * Date: 26.03.18
 * Time: 16:27
 */

namespace AppBundle\Repositories;

use AppBundle\Entity\Person;
use Doctrine\ORM\EntityRepository;


class Person_Repository extends EntityRepository
{


    /**
     * @return Person|null
     * @param $list []
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function searchForLoginCredentials($list){

        // if there exist more than one with those credentials in this database then
        // an exception is going to be thrown

       return $this->createQueryBuilder('person_')
           ->orwhere('person_.username = :uname')
           ->orWhere('person_.email = :uname')
           ->andWhere('person_.password = :pass')
//           ->innerJoin('p.academic_year','ac','WITH','ac.start_date < current_date() and ac.end_date > current_date()')
               
           ->setParameters(array(
                'uname'=>$list[0],
                'pass'=>$list[1]
            ))
           ->getQuery()
           ->getOneOrNullResult();

    }


    public function getAllTheStudentMembersOFDorm(){
        // select all the valid users
        return $this->createQueryBuilder('p')
            ->where("p.isaccepted = TRUE")
            ->innerJoin('p.payments','payments','WITH','payments.isprocessed = TRUE ')
            ->innerJoin('p.academic_year','ac','WITH','ac.start_date < current_date() and ac.end_date > current_date()')
            ->getQuery()
            ->getArrayResult();

    }

    public function getAllTheStaffMembersOfDorm(){

        return $this->createQueryBuilder('p')
            ->where("p.isaccepted = TRUE")
            ->where("p.type != 'student'")
            ->innerJoin('p.academic_year','ac','WITH','ac.start_date < current_date() and ac.end_date > current_date()')
            ->getQuery()
            ->getArrayResult();
    }

    


    public function getAllAssistantsList(){

        return $this->createQueryBuilder('p')
//            ->where("p.roles = '[\"ROLE_ASSIST\"]'")
            ->where("p.type = 'assistant'")
            ->innerJoin('p.academic_year','ac','WITH','ac.start_date < current_date() and ac.end_date > current_date()')
            ->getQuery()
            ->execute();

    }


    public function countNrOfMembers(){
        $Staffval = $this->getAllTheStaffMembersOfDorm();
        $Studval = $this->getAllTheStudentMembersOFDorm();

        $coutn = count($Staffval)+count($Studval);

        if(!$coutn)
            return 0;

        return $coutn;
    }

    public function countNrOfTechProblems(){
        $val = $this->createQueryBuilder('p')
            ->select('COUNT(p.id)')
            ->where("p.status = 'pending'")
            ->getQuery()
            ->getOneOrNullResult();

        if(!$val)
            return 0;

        return $val[1];

    }



    public function getPerson($email,$car_id){
        return  $this->createQueryBuilder('p')
            ->where('p.email = :email')
            ->andWhere('p.card_id = :card_id')
            ->setParameter('email',$email)
            ->setParameter('card_id',$car_id)
            ->getQuery()
            ->getOneOrNullResult();
    }


    public function getacceptedStudents(){
        return $this->createQueryBuilder('p')
            ->where("p.type = 'student' ")
            ->andWhere("p.isaccepted = TRUE ")
            ->innerJoin('p.academic_year','ac','WITH','ac.start_date < current_date() and ac.end_date > current_date()')
            ->innerJoin('p.payments','payments','WITH','payments.isprocessed = TRUE ')
            ->getQuery()
            ->execute();
    }

    public function getStdForFinanceActualAcademicsemester(){
        return $this->createQueryBuilder('p')
            ->where("p.type = 'student' ")
            ->andWhere("p.isaccepted = TRUE ")
            ->innerJoin('p.academic_year','ac','WITH','ac.start_date < current_date() and ac.end_date > current_date()')
//            ->innerJoin('p.payments','payments','WITH')
            ->getQuery()
            ->execute();
    }

}
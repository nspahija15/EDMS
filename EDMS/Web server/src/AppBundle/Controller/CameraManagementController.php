<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Files;
use AppBundle\Utils\SocketManager;
use Doctrine\ORM\EntityManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;

class CameraManagementController extends Controller
{




    private $host;
    private $port;



    private function setPathUrl($url){
        $session  = new Session();
        $session->set('prv_route','/web/app.php'.$url);
    }



    private function init_connection()
    {
        $this->host = $this->getParameter('socket_host');
        $this->port = $this->getParameter('socket_port');
    }



    /**
     * @Route("/director/camera/show", name="camera_show")
     */
    public function showCameraInformation(){


        $this->setPathUrl("/director/camera/show");

        $em = $this->getDoctrine()->getManager();

        $cameras = $em->getRepository('AppBundle:Files')->getAllCamerasGroupByDays();
        $logs = $em->getRepository('AppBundle:Files')->getAllLogsGroupByDays();

        $leftSDB = $this->getLeftSideMenu($em);

        return $this->render('@App/director_pages/camera_show.html.twig',array(
            'title'=>"Camera Details",
            'members'=>$leftSDB['members'],
            'applicants'=>$leftSDB['applicants'],
            'events'=>$leftSDB['events'],
            'cameras_in_days'=>$cameras,
            'logs'=>$logs
        ));


    }


    /**
     * @Route("/director/camera/delete/{camera_id}", name="delete_camera")
     */
    public function deleteCameraImages(Files $camera_id){


        $em = $this->getDoctrine()->getManager();

        try {

            $file_t = $this->getParameter('unathorizedPeople_images_directory').'/'.$camera_id->getName();

            if(file_exists($file_t))
                unlink($file_t);


            $em->remove($camera_id);
            $em->flush();

            $this->addFlash('success','The Camera deleted Successfully !!');

        }catch(\Exception $e){

            $this->addFlash('failure', 'An Error occured while deleting the camera !!');

        }

        return $this->redirectToRoute('camera_show');

    }




    /**
     * @Route("/director/logs/today",name="today_logs")
     */
    public function getTodaysLogAction(){
        $this->init_connection();
        $sc = new SocketManager($this->getParameter('logs_dir'),$this->host,$this->port);

        if(!$sc->checkConnection()) {
            $this->addFlash('failure', 'The server could not be reached!!');
            $this->redirectToRoute('camera_show');
        }

        $rs = $sc->requestLogs('today');

        if(!$rs)
            $this->addFlash('failure','The files could not be fetched from the server!!');
        else $this->addFlash('success','The files were successfully reached from the server!!');

        return $this->redirectToRoute('camera_show');
    }



    /**
     * @Route("/director/logs/all",name="all_logs")
     */
    public function getAllLogsAction(){
        $this->init_connection();
        $sc = new SocketManager($this->getParameter('logs_dir'),$this->host,$this->port);

        if(!$sc->checkConnection()) {
            $this->addFlash('failure', 'The server could not be reached!!');
            $this->redirectToRoute('camera_show');
        }

        $rs = $sc->requestLogs('all');

        if(!$rs)
            $this->addFlash('failure','The files could not be fetched from the server!!');
        else $this->addFlash('success','The files were successfully reached from the server!!');

        return $this->redirectToRoute('camera_show');
    }



    /**
     * @Route("/director/logs/delete/{log_id}", name="delete_log")
     */
    public function deletelogs(Files $log_id){


        $em = $this->getDoctrine()->getManager();

        try {

            $file_t = $this->getParameter('logs_dir').'/'.$log_id->getName();

            if(file_exists($file_t))
                unlink($file_t);

            $em->remove($log_id);
            $em->flush();

            $this->addFlash('success','The Log deleted Successfully !!');

        }catch(\Exception $e){

            $this->addFlash('failure', 'An Error occured while deleting the Log !!');

        }

        return $this->redirectToRoute('camera_show');

    }


    /**
     * @Route("/director/log/{log_id}",name="show_log_content")
     */
    public function showLogContent(Files $log_id){

        $session  = new Session();
        $path = $session->get('prv_route');

        $fl = file($this->getParameter('logs_dir')."/".$log_id->getName());

        $logs = array();
        foreach ($fl as $row){
            $logs[] = $row;
        }

        $em = $this->getDoctrine()->getManager();


        $leftSDB = $this->getLeftSideMenu($em);

        return $this->render('@App/director_pages/logs_show_details.html.twig',array(
            'title'=>"Profile",
            'members'=>$leftSDB['members'],
            'applicants'=>$leftSDB['applicants'],
            'events'=>$leftSDB['events'],
            'log_info'=>$logs,
            'log'=>$log_id,
            'back'=>$path
        ));

    }


    public function getLeftSideMenu(EntityManager $em){

        $cnt_members = $em->getRepository('AppBundle:Person')->countNrOfMembers();
        $cnt_applicants = $em->getRepository('AppBundle:Dormapplication')->gettheNumberOFApplciants();

        $events = $em->getRepository('AppBundle:Events')->countUnoccuredEvents();

        return array("applicants"=>$cnt_applicants,"members"=>$cnt_members,'events'=>$events);

    }

}

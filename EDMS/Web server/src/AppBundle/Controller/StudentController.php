<?php

namespace AppBundle\Controller;


use AppBundle\Entity\EventParticipants;
use AppBundle\Entity\Payments;
use AppBundle\Entity\Person;
use AppBundle\Entity\TechProblems;
use AppBundle\Form\edit_profile_form;
use AppBundle\Form\report_problem_form;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

use AppBundle\Repositories\Payments_Repository;
use Doctrine\ORM\EntityManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;




class StudentController extends Controller
{

    /**
     * @Route("/student", name="student")
     */
    public function homepageAction(){

        /** @var Person $user */
        $user = $this->getUser();


        $em = $this->getDoctrine()->getManager();

        $leftSDB = $this->getLeftSideMenu($em);


        return $this->render('@App/student_page/index.html.twig',array(
            'title'=>"EDMS Student",
            'user'=>$user,
            'events'=>$leftSDB['events']

        ));

    }



    public function getLeftSideMenu(EntityManager $em){


        $events = $em->getRepository('AppBundle:Events')->countUnoccuredEvents();
        return array('events'=>$events);



    }
    /**
     * @Route("/student/assistants", name="view_assistant_stud")
     * @return Response
     */
    public function showAssistantsAction(){



        //get the list of the assistants registered in the dormitory

        $em = $this->getDoctrine()->getManager();


        $leftSDB = $this->getLeftSideMenu($em);

        $assistants = $em->getRepository('AppBundle:Person')->findBy(['type'=>'assistant']);


        return $this->render("@App/student_page/view_assistant.html.twig",array(
            'title'=>"Manage Assistants",
            'assistants'=>$assistants,

            'events'=>$leftSDB['events']

        ));


    }
//    public function showAssistantsAction(){
//
//
//        //todo get the list of the assistants registered in the dormitory
//
//        $em = $this->getDoctrine()->getManager();
//
//
//        $leftSDB = $this->getLeftSideMenu($em);
//
//        $assistants = $em->getRepository('AppBundle:Person')->getAllAssistantsList();
//
//
//        return $this->render("@App/student_page/view_assistant.html.twig",array(
//            'title'=>"Assistant Info",
//            'assistants'=>$assistants,
//            'events'=>$leftSDB['events']
//
//        ));
//
//    }

    /**
     *@Route("/student/show/info/{person}", name="show_information_stud")
     */
    public function showDetailsAction(Person $person){

        $session  = new Session();
        $path = $session->get('prv_route');

        $em = $this->getDoctrine()->getManager();

        $leftSDB = $this->getLeftSideMenu($em);

        return $this->render('@App/student_page/show_info_stud.html.twig',array(
            'title'=>'More Details',
            'events'=>$leftSDB['events'],
            'person'=>$person,
            'back'=>$path

        ));

    }

    /**
     * @Route("/student/problem", name="report_problem_stud")
     */

    public function formReport(Request $request){
        $problem = new TechProblems();

        $form = $this->createForm(report_problem_form::class,$problem);
        $form->handleRequest($request);


        $em=$this->getDoctrine()->getManager();

        if($form->isSubmitted() && $form->isValid()) {

            $problem->setIsConfirmed(false);
            $em->persist($problem);
            $em->flush();

            return $this->redirectToRoute('redirect_pages');

        }

            $leftSDB = $this->getLeftSideMenu($em);


        return $this->render('@App/student_page/form_report.html.twig', array(
            'repForm' => $form->createView(),
            'title'=>'Report a Problem',

            'events'=>$leftSDB['events']


        ));


    }

    /**
     * @Route("/student/profile", name="show_profile_stud")
     */
    public function showProfileAction(){

        /** @var Person $user */
        $user =  $this->getUser();
        $em = $this->getDoctrine()->getManager();

        $leftSDB = $this->getLeftSideMenu($em);

        return $this->render('@App/student_page/profile.html.twig',array(
            'title'=>"Profile",
            'user'=>$user,
            'events'=>$leftSDB['events'],
        ));

    }

    /**
     * @Route("/student/discipline", name="report_discipline")
     */

    public function discipline()
    {
        $em = $this->getDoctrine()->getManager();
        $leftSDB = $this->getLeftSideMenu($em);


        $form = $this->createFormBuilder()
            ->add('name', TextType::class)
            ->add('points', TextType::class)
            ->add('description', TextareaType::class)
            ->add('submit', SubmitType::class, [

                'attr' => [
                    'class' => 'btn btn-success'
                ]

            ])
            ->getForm();

        return $this->render('@App/student_page/discipline_report.html.twig', array(
            'repForm' => $form->createView(),
            'title' => 'Discipline Report',

            'events'=>$leftSDB['events']

        ));

    }

    /**
     * @Route("/student/profile/edit", name="edit_profile_stud")
     */
    public function editProfileAction(Request $request){

        $em = $this->getDoctrine()->getManager();

        /** @var Person $user */
        $user =  $this->getUser();

//        $user =  $em->getRepository('AppBundle:Person')->getPerson($user->getEmail(),$user->getCardId());

        $form = $this->createForm(edit_profile_form::class,$user,array(
            'image_path'=>$this->getParameter('person_images')
        ));

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            try {

                $file = $form['image']->getData();

                if ($file) {

                    if (file_exists($this->getParameter('person_images') . '/' . $user->getImage()))
                        unlink($this->getParameter('person_images') . '/' . $user->getImage());

                    $file_name = $this->generateUniqueFileName() . "." . $file->guessExtension();
                    $file->move($this->getParameter('person_images'), $file_name);

                    $user->setImage($file_name);

                }
            }catch (\Exception $e){}



            try {
                $em->persist($user);
                $em->flush();

                $this->addFlash('success','The profile.html.twig updated successfully!!');
            }catch (\Exception $e){
                $this->addFlash('failure','The profile.html.twig was not updated!!');
            }


            return $this->redirectToRoute('show_profile_stud');

        }


        $leftSDB = $this->getLeftSideMenu($em);

        return $this->render('@App/student_page/edit_profile.html.twig',array(
            'title'=>"Profile",
            'user'=>$user,
            'form'=>$form->createView(),
            'events'=>$leftSDB['events'],
        ));

    }


    /**
     * @Route("/student/payments", name="view_payments_stud")
     * @return Response
     */

    public function showPayments(){

        // TODO show all problems

        $em = $this->getDoctrine()->getManager();



        $payments=$em->getRepository('AppBundle:Payments')->getPayments();


        $leftSDB = $this->getLeftSideMenu($em);


        return $this->render('@App/student_page/view_payments.html.twig',array(
            'title'=>"Payments",
            "pending_problems"=>$payments,
            'events'=>$leftSDB['events']

        ));

    }

    /**
     * @Route("/student/events", name="show_events_stud")
     */
    public function showEvents(){


        /** @var Person $user */
        $user = $this->getUser();

        $em = $this->getDoctrine()->getManager();

        $other_events = $em->getRepository('AppBundle:Events')->getAllNewEvents();
        $your_events = $em->getRepository('AppBundle:EventParticipants')->getEventsOfTheUserId($user->getId());


        $leftSDB = $this->getLeftSideMenu($em);

        return $this->render('@App/student_page/events_stud.html.twig',array(
            'title'=>"Dormitory Events",
            'acc_events'=>$other_events,
            "your_events"=>$your_events,
            'events'=>$leftSDB['events']
        ));


    }


    /**
     * @Route("/student/event/participating/{ventParticiating}", name="invited_events_stud")
     */

    public function acceptInvitation(EventParticipants $eventParticiating){

        if($eventParticiating->getisParticipating()){
            $eventParticiating->setIsParticipating(false);
        }else{
            $eventParticiating->setIsParticipating(true);
        }

        $em =  $this->getDoctrine()->getManager();
        $em->persist($eventParticiating);
        $em->flush();

        return $this->redirectToRoute('show_events_stud');

    }

}

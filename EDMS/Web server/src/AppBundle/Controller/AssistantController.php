<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Events;
use AppBundle\Entity\Performances;
use AppBundle\Entity\Person;
use AppBundle\Entity\TechProblems;
use AppBundle\Form\edit_profile_form;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AssistantController extends Controller
{
    /**
     * @Route("/assistant", name="assistant")
     */
    public function homepageAction()
    {
        /** @var Person $user */
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $leftSDB = $this->getLeftSideMenu($em);

        $user->getStudentMappedEvents();

        return $this->render('@App/assistant_pages/index.html.twig',array(
            'title'=>"EDMS Assistant",
            'user'=>$user,
            'members'=>$leftSDB['members'],
            'events'=>$leftSDB['events'],
            'tech'=>$leftSDB['tech'],
            'performance'=>$leftSDB['performance']
        ));

    }


    /**
     * Lists all event entities.
     *
     * @Route("/assistant/events", name="events")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $events = $em->getRepository('AppBundle:Events')->findBy(['event_manager' =>$user->getId()]);
        $leftSDB = $this->getLeftSideMenu($em);

        return $this->render('@App/assistant_pages/events.html.twig', array(
            'event' => $events,
            'title' => "EVENTS",
            'user' => $user,
            'members'=>$leftSDB['members'],
            'events'=>$leftSDB['events'],
            'tech'=>$leftSDB['tech'],
            'performance'=>$leftSDB['performance']
        ));
    }


    /**
     * @Route("/assistant/events/new", name="new_event")
     * @Method({"GET", "POST"})
     */
    public function createEventAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $event = new Events();
        $user = $this->getUser();
        $form = $this->createForm('AppBundle\Form\EventsType', $event);
        $form->handleRequest($request);
        $leftSDB = $this->getLeftSideMenu($em);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $event->setIsConfirmed(false);
            $em->persist($event);
            $em->flush();

            return $this->redirectToRoute('events', array('id' => $event->getId()));
        }

        /** @var Person $user */
        return $this->render('@App/assistant_pages/newEvent.html.twig', array(
            'events' => $event,
            'form' => $form->createView(),
            'title'=>"Create Event" ,
            'user'=>$user,
            'members'=>$leftSDB['members'],
            'events'=>$leftSDB['events'],
            'tech'=>$leftSDB['tech'],
            'performance'=>$leftSDB['performance']
        ));










    }




    /**
     * @Route("/assistant/students", name="students")
     */
    public function reportStudentAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $students = $em->getRepository('AppBundle:Person')->findBy(['type' => 'student',]);
        $leftSDB = $this->getLeftSideMenu($em);

        return $this->render('@App/assistant_pages/students.html.twig', array(
            'students' => $students,
            'title' => "Students list",
            'user' => $user,
            'members'=>$leftSDB['members'],
            'events'=>$leftSDB['events'],
            'tech'=>$leftSDB['tech'],
            'performance'=>$leftSDB['performance']
        ));
    }


    /**
     * @Route("/assistant/performance", name="performance")
     */
    public function performanceAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $performance = $em->getRepository('AppBundle:Performances')->getAllStudentPerformances();
        $myPerformance = $em->getRepository('AppBundle:Performances')->findBy(['assistant' => $user->getId()]);
        $leftSDB = $this->getLeftSideMenu($em);

        return $this->render('@App/assistant_pages/performances.html.twig', array(
            'performance' => $performance,
            'myPerformance' => $myPerformance,
            'title' => "All student performances",
            'user' => $user,
            'members'=>$leftSDB['members'],
            'events'=>$leftSDB['events'],
            'tech'=>$leftSDB['tech'],
            'performance'=>$leftSDB['performance']
        ));
    }


    /**
     * @Route("/assistant/performance/new", name="new_performance")
     */
    public function createPerformanceAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $performance = new Performances();
        $user = $this->getUser();
        $form = $this->createForm('AppBundle\Form\report_student', $performance);
        $form->handleRequest($request);
        $leftSDB = $this->getLeftSideMenu($em);

        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();

            $dt = new \DateTime('today');

            $performance->setDateAssigned($dt);
            $performance->setAssistant($user);
            $em->persist($performance);
            $em->flush();

            return $this->redirectToRoute('events', array('id' => $performance->getId()));
        }



        /** @var Person $user */
        return $this->render('@App/assistant_pages/add_performance.html.twig', array(
            'performance' => $performance,
            'form' => $form->createView(),
            'title'=>"Report a student" ,
            'user'=>$user,
            'members'=>$leftSDB['members'],
            'events'=>$leftSDB['events'],
            'tech'=>$leftSDB['tech'],
            'performance'=>$leftSDB['performance']
        ));

        }







    /**
     * @Route("/assistant/profile/show", name="show_profile_assistant")
     */
    public function showProfileAction(){

        /** @var Person $user */
        $user =  $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $leftSDB = $this->getLeftSideMenu($em);

        return $this->render('@App/assistant_pages/profile_show.html.twig',array(
            'title'=>"Profile",
            'user'=>$user,
            'members'=>$leftSDB['members'],
            'events'=>$leftSDB['events'],
            'tech'=>$leftSDB['tech'],
            'performance'=>$leftSDB['performance']
        ));

    }


    /**
//     * @Route("/assistant/profile/edit", name="edit_profile_assistant")
//     */
    public function editProfileAction(Request $request){

        $em = $this->getDoctrine()->getManager();

        /** @var Person $user */
        $user =  $this->getUser();

        $user =  $em->getRepository('AppBundle:Person')->getPerson($user->getEmail(),$user->getCardId());

        $form = $this->createForm(edit_profile_form::class, $user,array(
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

                $this->addFlash('success','The profile updated successfully!!');
            }catch (\Exception $e){
                $this->addFlash('failure','The profile was not updated!!');
            }


            return $this->redirectToRoute('edit_profile_assistant');

        }



        $leftSDB = $this->getLeftSideMenu($em);

        return $this->render('@App/assistant_pages/profile_edit.html.twig',array(
            'title'=>"Profile",
            'user'=>$user,
            'form'=>$form->createView(),
            'members'=>$leftSDB['members'],
            'events'=>$leftSDB['events'],
            'tech'=>$leftSDB['tech'],
            'performance'=>$leftSDB['performance']
        ));

    }



    /**
     * @Route("/assistant/report_tech_problem", name="report_tech_problem")
     */
    public function reportTechProblemAction()
    {
        /** @var Person $user */
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        $leftSDB = $this->getLeftSideMenu($em);
        $fixed_problems = $em->getRepository('AppBundle:TechProblems')->findBy(['status'=>'fixed']);
        $pending_problems = $em->getRepository('AppBundle:TechProblems')->findBy(['status'=>'pending'],['status'=>'considered']);

        return $this->render('@App/assistant_pages/report_tech_problem.html.twig',array(
            'title'=>"Report technical problem",
            'user'=>$user,
            'fixed_problems'=>$fixed_problems,
            'pending'=>$pending_problems,
            'members'=>$leftSDB['members'],
            'events'=>$leftSDB['events'],
            'tech'=>$leftSDB['tech'],
            'performance'=>$leftSDB['performance']
        ));
    }







    /**
     * @Route("/assistant/report_tech_problems", name="tech_problems_assistant")
     * @return Response
     */
    public function techProblemsAction(){

        /** @var Person $user */
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();

        $fixed_problems = $em->getRepository('AppBundle:TechProblems')->findBy(['status'=>'fixed']);
        $pending_problems = $em->getRepository('AppBundle:TechProblems')->findBy(['status'=>array('pending','considered')]);



        $leftSDB = $this->getLeftSideMenu($em);

        return $this->render('@App/assistant_pages/report_tech_problem.html.twig',array(
            'user'=>$user,
            'title'=>"Technical Problems",
            'fixed_problems'=>$fixed_problems,
            'pending'=>$pending_problems,
            'members'=>$leftSDB['members'],
            'events'=>$leftSDB['events'],
            'tech'=>$leftSDB['tech'],
            'performance'=>$leftSDB['performance']

        ));

    }



    /**
     * @Route("/assistant/technical/problems", name="fixed_problem")
     */
    public function fixedTechProblemAction(TechProblems $techProblems){

        /** @var Person $user */
        $user=$this->getUser();
        $techProblems->setStatus("fixed");
        $em = $this->getDoctrine()->getManager();
        $leftSDB = $this->getLeftSideMenu($em);

        return $this->render('@App/assistant_pages/report_tech_problem.html.twig',array(
            'title'=>"Profile",
            'user'=>$user,
            'members'=>$leftSDB['members'],
            'events'=>$leftSDB['events'],
            'tech'=>$leftSDB['tech'],
            'performance'=>$leftSDB['performance']
        ));

    }



    public function getLeftSideMenu(EntityManager $em){

        /** @var Person $user */
        $user=$this->getUser();
        $cnt_members = $em->getRepository('AppBundle:Person')->countNrOfMembers();
        $tech = $em->getRepository('AppBundle:TechProblems')->findBy(['status'=>'pending']);
        $events = $em->getRepository('AppBundle:Events')->countUnoccuredEvents();
        $cnt_tech = count($tech);
        $performances = $em->getRepository('AppBundle:Performances')->findBy(['assistant' =>$user->getId()]);
        $cnt_performances = count($performances);
        return array("members"=>$cnt_members,'events'=>$events,'tech'=>$cnt_tech,'performance'=>$cnt_performances);

    }





}

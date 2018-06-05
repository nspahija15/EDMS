<?php

namespace AppBundle\Controller;

use AppBundle\Form\edit_profile_form;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Person;
use AppBundle\Entity\Payments;

/**
 *
 * @Route("/finance")
 */
class FinanceController extends Controller
{

    /**
     *
     * @Route("/", name="finance")
     */
    public function indexAction()
    {

        $user=$this->getUser();
        $em = $this->getDoctrine()->getManager();
        $abc=$em->getRepository("AppBundle:Person")->getStdForFinanceActualAcademicsemester();
        $count2=count($abc);

        return $this->render('@App/finance_pages/index.html.twig', array(
            'number'=>$count2,
            'user'=>$user,
            'title'=>'This is a title'
            ));
    }
    /**
     *
     * @Route("/showstudent", name="show_student")
     */
    public function showstudentAction()
    {

        $user=$this->getUser();
        $em = $this->getDoctrine()->getManager();
//        $student = $em->getRepository('AppBundle:Person')->findBy(['type'=>'student']);
        $student = $em->getRepository('AppBundle:Person')->getStdForFinanceActualAcademicsemester();
        $count2=count($student);

        return $this->render('@App/finance_pages/show_student.html.twig', array(
            'students'=>$student,
            'number' => $count2,
            'user'=>$user,
            'title'=>'This is a title'
        ));
    }

    /**
     * @Route("/showstudent/{id}", name="id_show")
     * @Method("GET")
     */
    public function showAction(Person $student)
    {
        /** @var Person $user */
        $user =  $this->getUser();
        $em = $this->getDoctrine()->getManager();
        $payment = $em->getRepository('AppBundle:Payments')
            ->findBy(['student'=>$student->getId()]);
        $abc=$em->getRepository("AppBundle:Person")->getStdForFinanceActualAcademicsemester();
        $count2=count($abc);

        return $this->render('@App/finance_pages/info_student.html.twig', array(
            'em'=>$payment,
            'number' => $count2,
            'user'=>$user,
            'students' => $student,
            'title' => "finance"

        ));
    }
    /**
     * @Route("/profile", name="profile")
     *
     */
    public function profileAction()
    {

        $user=$this->getUser();
        $em = $this->getDoctrine()->getManager();
//        $student = $em->getRepository('AppBundle:Person')->findBy(['type'=>'student']);
        $student = $em->getRepository('AppBundle:Person')->getStdForFinanceActualAcademicsemester();
        $count2=count($student);
        return $this->render('@App/finance_pages/profile.html.twig', array(
            'students'=>$student,
            'number' => $count2,
            'title' => "finance",
            'user' => $user,
        ));
    }

    /**
     * @Route("/add", name="add")
     * @Method({"GET", "POST"})
     */
    public function addPaymentAction(Request $request)
    {
        /** @var Person $user */
        $user =  $this->getUser();
        $newpayment=new Payments();
        $em = $this->getDoctrine()->getManager();


        $form = $this->createForm('AppBundle\Form\finance_add_payment', $newpayment);
        $form->handleRequest($request);
        $abc=$em->getRepository("AppBundle:Person")->getStdForFinanceActualAcademicsemester();
        $count2=count($abc);



        if ($form->isSubmitted() && $form->isValid()){
            /** @var Person $user */
            $user =  $this->getUser();
            $em->persist($newpayment);
            $em->flush();
            return $this->redirectToRoute('show_student');

        }

        return $this->render('@App/finance_pages/add.html.twig', array(

            'form' => $form->createView(),
            'number' => $count2,
            'user'=>$user,
            'title' => "finance"

        ));

    }


    /**
     * @Route("profile/edit", name="edit")
     *
    */
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


            return $this->redirectToRoute('edit');

        }



        $leftSDB = $this->getLeftSideMenu($em);

        return $this->render('@App/finance_pages/edit.html.twig',array(
            'title'=>"Profile",
            'user'=>$user,
            'form'=>$form->createView(),
            'members'=>$leftSDB['members'],
            'events'=>$leftSDB['events'],
            'tech'=>$leftSDB['tech']
        ));

    }





}

<?php

namespace AppBundle\Controller;


use AppBundle\Entity\Dormapplication;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{


    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {

        return $this->render('@App/default/index.html.twig', array(
            'title'=>"EMDS Homepage",
            'base_dir'=>__DIR__
        ));

    }

    /**
     * @Route("/information", name="information")
     */
    public function indexInformation()
    {

        return $this->render('@App/default/information.html.twig', array(
            'title'=>"EMDS Information",
            'base_dir'=>__DIR__
        ));

    }


    /**
     * @Route("/apply",name="dorm_application")
     */
    public function applicationFormAction(Request $request){

        $d_application = new Dormapplication();

        $form = $this->createForm('AppBundle\Form\application_form',$d_application);
        // enable the form handle
        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()){


            // TODO -> push the form to the database and send an email to the student
            $em = $this->getDoctrine()->getManager();
            // TODO -> if an error occured while writing the data then show the message


            /** @var \DateTime $date */
            $date = $d_application->getBirthday();
            // change the format of the date
            $d_application->setBirthday($date->format('Y-m-d'));
            $d_application->setIsaccepted(False);


            $academic_year = $em->getRepository('AppBundle:AcademicYear')->getNowAyear();

            if(!$academic_year){
                $this->addFlash('failure','There was a problem with your application!!');
                return $this->redirectToRoute('homepage');
            }


            $file = $form['image']->getData();

            $file_name = $this->generateUniqueFileName().".".$file->guessExtension();
            $file->move($this->getParameter('person_images'), $file_name);

            $d_application->setImage($file_name);
            $d_application->setAcademicYear($academic_year);

            try {

                $em->persist($d_application);
                $em->flush();
                $this->addFlash('success','Your Application was delivered Successfully!! Thank You!');

            }catch (\Exception $e)
            {
                $this->addFlash('failure','There was a problem with your applciation!!');

            }
            return $this->redirectToRoute('homepage');
        }


        return $this->render('@App/default/application_page.html.twig',array(
                'form'=>$form->createView(),
                'title'=>"Application Form"
            ));

    }


    /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        return md5(uniqid());
    }


}

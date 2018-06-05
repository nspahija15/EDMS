<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Person;
use AppBundle\Entity\TechProblems;
use AppBundle\Form\academic_year_form;
use AppBundle\Form\edit_profile_form;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TechController extends Controller
{


    /**
     * @Route("/tech", name="tech")
     */
    public function homepageAction(){


        /** @var Person $user */
        $user = $this->getUser();

        $em = $this->getDoctrine()->getManager();

        // show the homepage of the technical staff

        return $this->render('@App/tech_pages/index.html.twig',array(

            'title'=>"EDMS Technical Staff",
            'user'=>$user,
            'problems_count'=>$this->countDT($em)
        ));

    }


    /**
     * @Route("/tech/profile.html.twig/show", name="show_profile_tech")
     */
    public function showProfileAction(){

        /** @var Person $user */
        $user =  $this->getUser();
        $em = $this->getDoctrine()->getManager();


        return $this->render('@App/tech_pages/profile_show.html.twig',array(
            'title'=>"Profile",
            'user'=>$user,
            'problems_count'=>$this->countDT($em)
        ));

    }


    /**
     * @Route("/tech/profile.html.twig/edit", name="edit_profile_tech")
     */
    public function editProfileAction(Request $request){

        $em = $this->getDoctrine()->getManager();

        /** @var Person $user */
        $user =  $this->getUser();

        $user =  $em->getRepository('AppBundle:Person')->getPerson($user->getEmail(),$user->getCardId());

        $form = $this->createForm(edit_profile_form::class,$user,array(
            'image_path'=>$this->getParameter('person_images')
        ));



        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $file = $form['image']->getData();

            if($file){

                if(file_exists($this->getParameter('person_images').'/'.$user->getImage()))
                    unlink($this->getParameter('person_images').'/'.$user->getImage());

                $file_name = $this->generateUniqueFileName().".".$file->guessExtension();
                $file->move($this->getParameter('person_images'), $file_name);

                $user->setImage($file_name);

            }

            try {
                $em->persist($user);
                $em->flush();

                $this->addFlash('success','The profile.html.twig updated successfully!!');
            }catch (\Exception $e){
                $this->addFlash('failure','The profile.html.twig was not updated!!');
            }


            return $this->redirectToRoute('show_profile_tech');

        }





        return $this->render('@App/tech_pages/profile_edit.html.twig',array(
            'title'=>"Profile",
            'user'=>$user,
            'form'=>$form->createView(),
            'problems_count'=>$this->countDT($em)

        ));

    }



    public function countDT($em){

        $em = $this->getDoctrine()->getManager();

        $prb = $em->getRepository('AppBundle:TechProblems')
            ->get_pending_DormProblems();
        $cn = count($prb);

        return $cn;
    }


    /**
     * @return string
     */
    private function generateUniqueFileName()
    {
        return md5(uniqid());
    }





    /**
     * @Route("/tech/problems/view", name="tech_tech_problems")
     */
    public function showTechnicalProblemsAction(){


        /** @var Person $user */
        $user = $this->getUser();

        $em = $this->getDoctrine()->getManager();


        $pending_problems = $em->getRepository('AppBundle:TechProblems')
            ->get_pending_DormProblems();

        $fixed_problems = $em->getRepository('AppBundle:TechProblems')
            ->get_fixed_DormProblems();

        $tod_o = $em->getRepository('AppBundle:TechProblems')
            ->get_todo_dormProblems();

        $len = count($pending_problems);


        return $this->render('@App/tech_pages/technical_information.html.twig',array(
            'title'=>"EDMS Technical Staff",
            'user'=>$user,
            'pending_problems'=>$pending_problems,
            'fixed_problems'=>$fixed_problems,
            'todo_problems'=>$tod_o,
            'problems_count'=>$len
        ));

    }






    /**
     * @Route("/tech/problems/consider/{prob_id}",name="considering_tech_problems")
     */
    public function addIntoConsiderAction(TechProblems $prob_id){

        $prob_id->setStatus('considered');

        $em = $this->getDoctrine()->getManager();


        try {
            $em->persist($prob_id);
            $em->flush();
            $this->addFlash('success','The Problem  '.$prob_id->getName().' was taken into consideration. !!');
        }catch (\Exception $e){
            $this->addFlash('failure','A problem occured while Problem  '.$prob_id->getName().' was being taken into consideration. !!');
        }

        return $this->redirectToRoute('tech_tech_problems');

    }



    /**
     * @Route("/tech/problems/unconsider/{prob_id}",name="unconsidering_tech_problems")
     */
    public function addIntoUnconsiderAction(TechProblems $prob_id){

        $prob_id->setStatus('pending');


        $em = $this->getDoctrine()->getManager();


        try {
            $em->persist($prob_id);
            $em->flush();
            $this->addFlash('success','The Problem  '.$prob_id->getName().' was taken into Unconsideration. !!');
        }catch (\Exception $e){
            $this->addFlash('failure','A problem occured while Problem  '.$prob_id->getName().' was being taken into Unconsideration. !!');
        }


        return $this->redirectToRoute('tech_tech_problems');

    }


    /**
     * @Route("/tech/problems/fixed/{prob_id}",name="fixing_tech_problems")
     */
    public function addIntoFixedAction(TechProblems $prob_id){

        $prob_id->setStatus("fixed");

        $em = $this->getDoctrine()->getManager();


        try {
            $em->persist($prob_id);
            $em->flush();
            $this->addFlash('success','The Problem  '.$prob_id->getName().' was taken into consideration. !!');
        }catch (\Exception $e){
            $this->addFlash('failure','A problem occured while Problem  '.$prob_id->getName().' was being taken into consideration. !!');
        }


        return $this->redirectToRoute('tech_tech_problems');
    }


    /**
     * @Route("/tech/problems/unfixed/{prob_id}",name="unfixing_tech_problems")
     */
    public function addIntoUnfixedAction(TechProblems $prob_id){

        $prob_id->setStatus('considered');

        $em = $this->getDoctrine()->getManager();

        try {
            $em->persist($prob_id);
            $em->flush();
            $this->addFlash('success','The Problem  '.$prob_id->getName().' was removed from fixed position!. !!');
        }catch (\Exception $e){
            $this->addFlash('failure','A problem occured while Problem  '.$prob_id->getName().' was removed from fixed position!. !!');
        }

        return $this->redirectToRoute('tech_tech_problems');

    }




}

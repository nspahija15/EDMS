<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Person;
use AppBundle\Form\Login_Form_template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityController extends Controller
{


    /**
     * @Route("/redirect", name="redirect_pages")
     */

    public function redirectAction(){

        // get information of the user logged in
        /** @var Person $user */
        $user = $this->getUser();


        // check the user roles

        /*
            - { path: ^/finance, roles: ROLE_FINANCE }
            - { path: ^/student, roles: ROLE_STUDENT }
            - { path: ^/assistant, roles: ROLE_ASSIST }
            - { path: ^/director, roles: ROLE_DIRECT }
            - { path: ^/tech, roles: ROLE_TECH }
         */


        if(!$user->getRoles())
            throw new \Exception("THe roles not defined");

//        if('assistant'===$user->getType())
//            return $this->redirectToRoute('assistant');

        if(in_array('ROLE_FINANCE',$user->getRoles()))
            return $this->redirectToRoute('finance');
        else if(in_array('ROLE_STUDENT',$user->getRoles()))
            return $this->redirectToRoute('student');
        else if(in_array('ROLE_ASSIST',$user->getRoles()))
            return $this->redirectToRoute('assistant');
        else if(in_array('ROLE_DIRECT',$user->getRoles()))
            return $this->redirectToRoute('director');
        else if(in_array('ROLE_TECH',$user->getRoles()))
            return $this->redirectToRoute('tech');

        return $this->redirectToRoute('login');

    }



    /**
     * @Route("/login",name="login")
     */
    public function loginAction(Request $request){

        $authenticationUtils = $this->get('security.authentication_utils');


        // get the login error if there is one

        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        $title = "Welcome to the login page";




        $form = $this->createForm(Login_Form_template::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){


            return new Response("The form was submitted");

        }



        return $this->render(
            '@App/login.html.twig',
            array(

                'form'=> $form->createView(),
                'title'=> $title,
                'error'=> $error,
            )
        );
    }


    /**
     * @Route("/logout",name="logout")
     */
    public function logoutAction(){

    }



    /**
     *@Route("/check", name="check_credentials")
     */
    public function checkAction(){

    }


}

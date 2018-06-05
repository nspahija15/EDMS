<?php
/**
 * Created by PhpStorm.
 * User: archey
 * Date: 26.03.18
 * Time: 16:09
 */

namespace AppBundle\Security;

use AppBundle\Entity\Person;
use AppBundle\Form\Login_Form_template;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;



class LoginFormAuthenticator extends AbstractFormLoginAuthenticator
{


    private $form_factory;
    private $em;
    private $router;

    public function __construct(FormFactoryInterface $formFactory, EntityManagerInterface $em, RouterInterface $router)
    {
        $this->form_factory = $formFactory;
        $this->em = $em;
        $this->router = $router;
    }


    public function getCredentials(Request $request)
    {
        $isLoggedin = $request->getPathInfo() == '/login' && $request->isMethod('POST');

        if(!$isLoggedin)
            return;

        // is used to get the credentials from the form (if the form builder was being used)
        $form = $this->form_factory->create(Login_Form_template::class);
        $form->handleRequest($request);

        $data = $form->getData();

        return $data;

    }

    public function getUser($credentials, UserProviderInterface $userProvider)
    {

        // checking the credentials for the user logged in

        $username = $credentials->getUsername();
        $password = $credentials->getPassword();

        $res = null;

        try {

            $res = $this->em->getRepository('AppBundle:Person')
                ->searchForLoginCredentials(array($username, $password));

            return $res;

        }
        catch (NonUniqueResultException $e)
        {
            return;
        }

    }

    /**
     * @param Person $credentials
     * @param UserInterface $user
     * @return \AppBundle\Entity\Person|bool|null
     */
    public function checkCredentials($credentials, UserInterface $user)
    {

        // check for the password validation
        return true;

    }


    protected function getLoginUrl()
    {
        return $this->router->generate('login');
    }



    // on success , redirect to the page_redirect
    public function getDefaultSuccessRedirectUrl()
    {
        return $this->router->generate('redirect_pages');
    }

}
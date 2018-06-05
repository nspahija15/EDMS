<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use AppBundle\Entity\Person;

class Login_Form_template extends AbstractType
{
    

    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('username',TextType::class,array(
                "attr"=>array(
                    'name'=>"_usernmae",
                    'placeholder'=>"Username"
                    )
            ))
            ->add('password',PasswordType::class,array(
                "attr"=>array(
                    'name'=>"_password",
                    'placeholder'=>"Password"
                )
            ));

        return $builder;

    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class'=>Person::class));

        // to protect the form from CSRF attacks
//        $resolver->setDefaults(array(
//            'data_class'      => Person::class,
//            // enable/disable CSRF protection for this form
//            'csrf_protection' => true,
//            // the name of the hidden HTML field that stores the token
//            'csrf_field_name' => '_token',
//            // an arbitrary string used to generate the value of the token
//            // using a different string for each form improves its security
//            'csrf_token_id'   => 'task_item'
//        ));

    }

    public function getBlockPrefix()
    {
        return 'app_bundle_login_form_template';
    }
}

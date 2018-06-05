<?php
/**
 * Created by PhpStorm.
 * User: Aldo
 * Date: 2018-06-03
 * Time: 6:44 PM
 */

namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class report_problem_form extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        return $builder
            ->add('name', TextType::class)
            ->add('place', TextType::class)
            ->add('description', TextareaType::class);
//            ->add('submit', SubmitType::class, [
//
//                'attr'=>[
//                    'class'=> 'btn btn-success'
//                ]
//
//            ]);

    }


    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix()
    {

    }

}
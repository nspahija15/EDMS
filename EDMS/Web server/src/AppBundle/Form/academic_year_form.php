<?php

namespace AppBundle\Form;

use AppBundle\Entity\AcademicYear;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class academic_year_form extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder

            ->add('semester',ChoiceType::class,array(
                'choices' => array(
                    'Winter' => 'Winter',
                    'Spring' => 'Spring'
                ),
            ))
            ->add('startDate',DateType::class, array(
                'widget' => 'choice',
                'years' => range(date('Y')-1, date('Y')+1),
                'format' => 'yyyy-MM-dd',
                'placeholder' => array(
                    'year' => 'Year', 'month' => 'Month', 'day' => 'Day',
                )

            ))
            ->add('endDate',DateType::class, array(
                'widget' => 'choice',
                'years' => range(date('Y')-1, date('Y')+1),
                'format' => 'yyyy-MM-dd',
                'placeholder' => array(
                    'year' => 'Year', 'month' => 'Month', 'day' => 'Day',
                )

            ));


    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class'=>AcademicYear::class));
    }

    public function getBlockPrefix()
    {
        return 'app_bundleacademic_year_form';
    }
}

<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class add_assistant_form extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        return $builder
            ->add("cardId",TextType::class)
            ->add("name")
            ->add('surname')
            ->add('email',EmailType::class)
            ->add('phoneNr',NumberType::class)
            ->add('nationality',TextType::class)
            ->add('city',TextType::class)
//            ->add('birthplace')
            ->add('birthday',DateType::class,array(
                'widget' => 'choice',
                'years' => range(date('Y')-30, date('Y')-16),
                'format' => 'yyyy-MM-dd',
                'placeholder' => array(
                    'year' => 'Year', 'month' => 'Month', 'day' => 'Day',
                )
            ))
            ->add('address',TextType::class)
            ->add('department',TextType::class);

    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix()
    {
        return 'app_bundleadd_assistant_form';
    }
}

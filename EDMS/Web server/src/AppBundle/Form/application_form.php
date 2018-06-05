<?php

namespace AppBundle\Form;

use AppBundle\Entity\Dormapplication;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class application_form extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        return $builder
            ->add('image', FileType::class, array(
                'attr'=>array(
                    'onchange'=>'readURL(this);'
                )
            ))
            ->add('card_id',TextType::class)
            ->add('name',TextType::class)
            ->add('surname',TextType::class)
            ->add('nationality',TextType::class)
            ->add('birthday',DateType::class,array(
                'widget' => 'choice',
                'years' => range(date('Y')-30, date('Y')-16),
                'format' => 'yyyy-MM-dd',
                'placeholder' => array(
                    'year' => 'Year', 'month' => 'Month', 'day' => 'Day',
                )
            ))
            ->add('city',TextType::class)
            ->add("phoneNumber", NumberType::class)
            ->add('address',TextType::class)
            ->add('email',EmailType::class)
            ->add('department',TextType::class)


            ->add('fathersName',TextType::class)
            ->add('fathersSurname',TextType::class)
            ->add('fathersJob',TextType::class)
            ->add('fathersPhoneNumber',NumberType::class)

            ->add('mothersName',TextType::class)
            ->add('mothersSurname',TextType::class)
            ->add('mothersJob',TextType::class)
            ->add('mothersPhoneNumber',NumberType::class)

            ->add("maritalStatus",ChoiceType::class,array(
                'choices' => array(
                    'Married' => 'Married',
                    'Divorced' => 'Divorced'
                ),
            ));

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class'=>Dormapplication::class));
    }

    public function getBlockPrefix()
    {
        return 'app_bundleapplication_form';
    }
}

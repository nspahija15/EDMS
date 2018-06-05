<?php

namespace AppBundle\Form;

use AppBundle\Entity\Dormapplication;
use AppBundle\Entity\Person;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class edit_profile_form extends AbstractType
{


    private $image_path;


    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $this->image_path = $options['image_path'];


         $builder
            ->add('image', FileType::class, array(
                'attr'=>array(
                    'onchange'=>'readURL(this);'
                )
            ))
             ->add('password',PasswordType::class)
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
            ->add("phoneNr", NumberType::class)
            ->add('address',TextType::class)
            ->add('email',EmailType::class)
            ->add('department',TextType::class)


            ->add('fathersName',TextType::class)
            ->add('fathersSurname',TextType::class)
            ->add('fathersJob',TextType::class)
            ->add('fathersphoneNr',NumberType::class)

            ->add('mothersName',TextType::class)
            ->add('mothersSurname',TextType::class)
            ->add('mothersJob',TextType::class)
            ->add('mothersphoneNr',NumberType::class)

            ->add("parentMaritStatus",ChoiceType::class,array(
                'choices' => array(
                    'Married' => 'Married',
                    'Divorced' => 'Divorced'
                ),
            ));


        $builder->get('birthday')
             ->addModelTransformer(new CallbackTransformer(
                 function ($tagsAsString) {
                     $dt = new \DateTime($tagsAsString);

                     return $dt;
                 },
                 function (\DateTime $tagsAsFile) {

                     return date('Y-m-d',$tagsAsFile->getTimestamp());
                 }
             ));


        $builder->get('image')
            ->addModelTransformer(new CallbackTransformer(
                function ($tagsAsString) {

                    if($tagsAsString)
                        $file = new File($this->image_path.'/'.$tagsAsString);
                    else
                        $file = new File($this->image_path.'/default.png');

                    return $file;
                },
                function (File $tagsAsFile) {
                    return $tagsAsFile;
                }
            ));


        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $product = $event->getData();
            $form = $event->getForm();

            if ('' != $product->getImage()) {
                $form->remove('image');
            }


        });


    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array('data_class'=>Person::class));
        $resolver->setRequired('image_path');
    }

    public function getBlockPrefix()
    {
        return 'app_bundleapplication_form';
    }
}

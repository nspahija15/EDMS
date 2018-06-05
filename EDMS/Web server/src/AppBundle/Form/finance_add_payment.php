<?php

namespace AppBundle\Form;

use AppBundle\Entity\Payments;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class finance_add_payment extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('student')
            ->add('amount')
            ->add('dateP')
            ->add('description')
            ->add('notes')
            ->add('type')
            ->add('academicYear');

//            ->add('roomid', null, array(
//                'label' => 'Room:'
//            ));
    }
    /**
 * {@inheritdoc}
 */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Payments::class,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'appbundle_payments';
    }


}

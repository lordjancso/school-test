<?php

namespace AppBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StudentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('name', 'text');
        $builder->add('gender', 'choice', array(
            'choices' => array(
                'Male' => 'Male',
                'Female' => 'Female'
            )
        ));
        $builder->add('birthplace', 'text');
        $builder->add('birthday', 'date', array(
            'years' => range(1960, 2000),
            'format' => 'yyyyMMdd',
            'placeholder' => array('year' => 'Year', 'month' => 'Month', 'day' => 'Day')
        ));
        $builder->add('email', 'email');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AppBundle\Entity\Student'
        ));
    }

    public function getName()
    {
        return 'app_student';
    }
}

<?php

namespace App\Form;

use App\Entity\Section;
use App\Entity\SectionAbstract;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SectionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('order');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                // uncomment if you want to bind to a class
                'data_class' => SectionAbstract::class,
            ]
        );
    }
}

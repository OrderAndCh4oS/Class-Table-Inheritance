<?php

namespace App\Form;

use App\Entity\QuoteBlock;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuoteBlockType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'section',
                SectionType::class,
                [
                    'label' => false,
                ]
            )
            ->add('quote')
            ->add('citation');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                // uncomment if you want to bind to a class
                'data_class' => QuoteBlock::class,
            ]
        );
    }
}

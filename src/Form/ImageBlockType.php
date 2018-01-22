<?php

namespace App\Form;

use App\Entity\Image;
use App\Entity\ImageBlock;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ImageBlockType extends AbstractType
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
            ->add(
                'image',
                ImageType::class,
                [
                    'data_class' => Image::class,
                    'label' => false,
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                // uncomment if you want to bind to a class
                'data_class' => ImageBlock::class,
            ]
        );
    }
}

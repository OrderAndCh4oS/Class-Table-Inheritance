<?php
/**
 * Created by PhpStorm.
 * User: sarcoma
 * Date: 15/04/18
 * Time: 10:38
 */

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;

class ArticleSectionOrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('sections', CollectionType::class, [
                    'entry_type' => SectionOrderType::class,
                    'entry_options' => [
                        'label' => 'Section Order',
                    ],
                ]
            );
    }
}

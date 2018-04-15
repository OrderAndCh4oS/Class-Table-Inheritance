<?php
/**
 * Created by PhpStorm.
 * User: sarcoma
 * Date: 15/04/18
 * Time: 09:38
 */

namespace App\Form;

use App\Entity\SectionAbstract;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SectionOrderType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('orderNumber', IntegerType::class, ['label' => false]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'data_class' => SectionAbstract::class,
            ]
        );
    }
}

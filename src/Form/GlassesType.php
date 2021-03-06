<?php

namespace App\Form;

use App\Entity\Glasses;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GlassesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('brand')
            ->add('name')
            ->add('color')
            ->add('size')
            ->add('shape')
            ->add('price')
            ->add('customer')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Glasses::class,
        ]);
    }
}

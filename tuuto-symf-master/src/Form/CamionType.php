<?php

namespace App\Form;

use App\Entity\Camion;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CamionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('matricule')
            ->add('marque')
            ->add('couleur')
            ->add('capaciteEnKg')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Camion::class,
        ]);
    }
}

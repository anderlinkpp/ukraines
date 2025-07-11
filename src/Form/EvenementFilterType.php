<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class EvenementFilterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('motCle', TextType::class, [
                'required' => false,
                'label' => 'Recherche',
                'attr' => ['placeholder' => 'Nom ou description']
            ])
            ->add('rechercher', SubmitType::class, [
                'label' => 'Filtrer',
            ]);
    }
}

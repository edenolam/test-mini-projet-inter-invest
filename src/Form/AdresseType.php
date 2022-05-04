<?php

namespace App\Form;

use App\Entity\Adresse;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AdresseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('numero', NumberType::class)
            ->add('typeVoie', ChoiceType::class, [
                'choices' => [
                    'rue' => 'rue',
                    'boulevard' => 'boulevard',
                    'avenue' => 'avenue',
                    'allee' => 'allee',
                ]
            ])
            ->add('nomVoie')
            ->add('ville')
            ->add('codePostale');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Adresse::class,
        ]);
    }
}

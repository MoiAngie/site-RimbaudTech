<?php

namespace App\Form;

use App\Entity\Tarifs;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class TarifType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('locaCE_demiJ', TextType::class)
            ->add('locaCE_J', TextType::class)
            ->add('locaReu_demiJ', TextType::class)
            ->add('locaReu_J', TextType::class)
            ->add('adhesionAnnee', TextType::class)
            ->add('CoHeure_adh', TextType::class)
            ->add('CoHeure_nonadh', TextType::class)
            ->add('CoDemiJ_adh', TextType::class)
            ->add('CoDemiJ_nonadh', TextType::class)
            ->add('CoJournee_adh', TextType::class)
            ->add('CoJournee_nonadh', TextType::class)
            ->add('CoMois_adh', TextType::class)
            ->add('CoMois_nonadh', TextType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tarifs::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ContactType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname', TextType::class)
            ->add('lastname', TextType::class)
            ->add ('object', ChoiceType::class,[
                    'placeholder' => "Choisissez l'objet de votre message",
                    'choices'  => [
                    "Infos sur l'incubation"                         => "Incubation",
                    "Infos sur le co-working"                        => "Co-working",
                    "Infos sur la location"                          => "Location",
                    "Abonnement à la Newsletter"                     => "Newsletter",
                    "Devenir partenaires"                            => "Partenaires",
                    "Autre, précisez dans votre message ci-dessous:" => "Autre"
                  ],
            ])
            ->add('phone', TextType::class)
            ->add('email', TextType::class)
            ->add('message', TextareaType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Contact::class,
        ]);
    }
}

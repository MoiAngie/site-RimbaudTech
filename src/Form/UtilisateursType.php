<?php

namespace App\Form;

use App\Entity\Utilisateurs;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class UtilisateursType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
      $builder
              ->add ('name', TextType::class)
              ->add ('firstname', TextType::class)
              ->add ('company', TextType::class, [
                'required' => false,
              ])
              ->add ('status', ChoiceType::class, [
                      'choices'  => [
                      "Incubé" => "Incubé",
                      "Co-worker" => "Co-workeur",
                      "Personnel" => "Personnel"
                    ],
              ])
              ->add ('profilpicture', FileType::class)
              ->add ('image1', FileType::class, [
                'required' => false,
              ])
              ->add ('image2', FileType::class, [
                'required' => false,
              ])
              ->add ('image3', FileType::class, [
                'required' => false,
              ])
              ->add ('image4', FileType::class, [
                'required' => false,
              ])
              ->add ('description', TextareaType::class)
              ->add ('comment', TextType::class)
              ->add ('socialmedia1', TextType::class)
              ->add ('socialmedia2', TextType::class)
              ->add ('socialmedia3', TextType::class)
      ;
  }

  public function configureOptions(OptionsResolver $resolver)
  {
      $resolver->setDefaults([
          'data_class' => Utilisateurs::class,
      ]);
  }
}

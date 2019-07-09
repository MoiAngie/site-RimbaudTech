<?php

namespace App\Form;

use App\Entity\Utilisateurs;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;


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
              ->add ('status', TextType::class)
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
      ;
  }

  public function configureOptions(OptionsResolver $resolver)
  {
      $resolver->setDefaults([
          'data_class' => Utilisateurs::class,
      ]);
  }
}

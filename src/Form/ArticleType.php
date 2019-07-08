<?php

namespace App\Form;

use App\Entity\Articles;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ArticleType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
      $builder
          ->add('title', TextType::class)
          ->add('author', TextType::class)
          ->add ('image', TextType::class)
          ->add('introduction', TextareaType::class)
          ->add('sousTitre1', TextType::class)
          ->add('paragraphe1', TextareaType::class)
          ->add('sousTitre2', TextType::class)
          ->add('paragraphe2', TextareaType::class)
          ->add('sousTitre3', TextType::class)
          ->add('paragraphe3', TextareaType::class)
          ->add('sousTitre4', TextType::class)
          ->add('paragraphe4', TextareaType::class)
          ->add('dateFin')
      ;
  }

  public function configureOptions(OptionsResolver $resolver)
  {
      $resolver->setDefaults([
          'data_class' => Articles::class,
      ]);
  }
}

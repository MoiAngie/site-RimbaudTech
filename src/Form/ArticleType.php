<?php

namespace App\Form;

use App\Entity\Articles;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

use App\Entity\User;
use App\Form\UserType;

class ArticleType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
      $builder
          ->add('title', TextType::class)
          ->add('author', TextType::class)
          ->add('publie_par', EntityType::class, [
            'class' => User::class,
            'choice_label' => 'username',
            'placeholder' => 'publié par'
          ])
          ->add ('image', FileType::class)
          ->add('introduction', TextareaType::class, [
            'required' => false,
          ])
          ->add('sousTitre1', TextType::class, [
            'required' => false,
          ])
          ->add('paragraphe1', TextareaType::class, [
            'required' => false,
          ])
          ->add('sousTitre2', TextType::class, [
            'required' => false,
          ])
          ->add('paragraphe2', TextareaType::class, [
            'required' => false,
          ])
          ->add('sousTitre3', TextType::class, [
            'required' => false,
          ])
          ->add('paragraphe3', TextareaType::class, [
            'required' => false,
          ])
          ->add('sousTitre4', TextType::class, [
            'required' => false,
          ])
          ->add('paragraphe4', TextareaType::class, [
            'required' => false,
          ])
      ;
  }

  public function configureOptions(OptionsResolver $resolver)
  {
      $resolver->setDefaults([
          'data_class' => Articles::class,
      ]);
  }
}

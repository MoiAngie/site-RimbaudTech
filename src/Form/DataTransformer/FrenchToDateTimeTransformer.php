<?php

namespace App\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;

class FrenchToDateTimeTransformer implements DataTransformerInterface {

  public function transform($date) {

    if($date === null ) {
      return '';
    }

    return $date->format('d/m/Y');
  }

  public function reverseTransform($frenchDate) {
    //frenchDate = 11/09/2019
    if($frenchDate === null) {
      //exception
      throw new TransformationFailedException("Vous devez donner une date");
    }

    $date = \DateTime::createFromFormat('d/m/Y', $frenchDate);

    if($date === false) {
      //exception
      throw new TransformationFailedException("Le format de la date donnée n'est pas valide");
    }

    return $date;
  }
}


 ?>

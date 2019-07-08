<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use App\Entity\Articles;
use App\Entity\Utilisateurs;
use App\Repository\ArticlesRepository;
use App\Repository\UtilisateursRepository;

use App\Form\ArticleType;

class AdminController extends AbstractController
{
  /**
   * @Route("/rt/admin/homeAdmin", name="homeAdmin")
   * ACCUEIL DU PANNEAU D'ADMINISTRATION
   */
  public function homeAdmin()
  {
      return $this->render('rt/admin/homeAdmin.html.twig', [
      ]);
  }

  /**
   * @Route("/rt/admin/portail-incubes", name="portailIncubes")
   * PAGE PORTAIL DES INCUBES (page admin)
   */
  public function portailIncubes()
  {
      return $this->render('rt/admin/portail-incubes.html.twig', [
      ]);
  }

  /**
   * @Route("/rt/admin/create-incube", name="create-incube")
   * PAGE AJOUT D'UN INCUBE (page admin)
   */
  public function createincube(Request $request, ObjectManager $manager)
  {
      $incube = new Utilisateurs;

      $form = $this->createFormBuilder($incube)
                    ->add ('name')
                    ->add ('firstname')
                    ->add ('company')
                    ->add ('status')
                    ->add ('profilpicture')
                    ->add ('image1')
                    ->add ('image2')
                    ->add ('image3')
                    ->add ('image4')
                    ->add ('description')
                    ->add ('comment')
                    ->getForm();

      $form->handleRequest($request);

      if($form->isSubmitted() && $form->isValid()){

      $manager->persist($incube);
      $manager->flush();

      return $this ->redirectToRoute('validation');
      }

      return $this->render('rt/admin/create-incube.html.twig', [
        'formIncube' => $form->createView()
      ]);
  }

  /**
   * @Route("/rt/amin/portail-coworker", name="portailCoworker")
   * PAGE PORTAIL COWORKER
   */
  public function portailCoworker()
  {
      return $this->render('rt/admin/portail-coworker.html.twig', [
      ]);
  }

  /**
   * @Route("/rt/amin/create-cowork", name="create-cowork")
   * PAGE AJOUT COWORKER (page admin)
   */
  public function createcowork(Request $request, ObjectManager $manager)
  {
    $coworker = new Utilisateurs;

    $form = $this->createFormBuilder($coworker)
                  ->add ('name')
                  ->add ('firstname')
                  ->add ('company')
                  ->add ('status')
                  ->add ('profilpicture')
                  ->add ('image1')
                  ->add ('image2')
                  ->add ('image3')
                  ->add ('image4')
                  ->add ('description')
                  ->add ('comment')
                  ->getForm();

    $form->handleRequest($request);

    if($form->isSubmitted() && $form->isValid()){

    $manager->persist($coworker);
    $manager->flush();

    return $this ->redirectToRoute('validation');
    }

    return $this->render('rt/admin/create-coworker.html.twig', [
      'formCoworker' => $form->createView()
    ]);
  }

  /**
   * @Route("/rt/amin/portail-personnel", name="portailPersonnel")
   * PAGE PORTAIL MEMBRES DE L'EQUIPE
   */
  public function portailPersonnel()
  {
      return $this->render('rt/admin/portail-personnel.html.twig', [
      ]);
  }

  /**
   * @Route("/rt/admin/createPersonnel", name="createPersonnel")
   * PAGE D'AJOUT D'UN MEMBRE DU PERSONNEL
   */
  public function createPersonnel()
  {
      return $this->render('rt/admin/create-personnel.html.twig', [
      ]);
  }

  /**
   * @Route("/rt/admin/portail-articles", name="portailArticles")
   * PAGE PORTAIL ARTICLE
   */
  public function portailArticles()
  {
      return $this->render('rt/admin/portail-articles.html.twig', [
      ]);
  }

  /**
   * @Route("/rt/admin/create-article", name="create-article")
   * PAGE DE CREATION D'UN ARTICLE (page admin)
   */
  public function createarticle(Request $request, ObjectManager $manager)
  {
      $article = new Articles();

      $formArticle = $this->createForm(ArticleType::class);

      $formArticle->handleRequest($request);

      if($formArticle->isSubmitted() && $formArticle->isValid()){
      $article->setCreatedAt(new \DateTime());

      $manager->persist($article);
      $manager->flush();

      return $this ->redirectToRoute('validation');
      }

      return $this->render('rt/admin/create-article.html.twig', [
        'formArticle' => $formArticle->createView()
      ]);
  }

  /**
   * @Route("/rt/admin/validation", name="validation")
   * PAGE TYPE ACTION REUSSIE
   */
  public function validation()
  {
      return $this->render('rt/admin/validation.html.twig', [
      ]);
  }

  /**
   * @Route("/rt/admin/portail-tarifs", name="portailTarifs")
   * PAGE PORTAIL DES TARIFS
   */
  public function portailTarifs()
  {
      return $this->render('rt/admin/portail-tarifs.html.twig', [
      ]);
  }

  /**
   * @Route("/rt/admin/createTarif", name="createTarif")
   * PAGE D'AJOUT TARIFS
   */
  public function createTarif()
  {
      return $this->render('rt/admin/create-tarif.html.twig', [
      ]);
  }

  /**
   * @Route("/rt/admin/createAccueil", name="createAccueil")
   * PAGE DE MODIFICATION DE LA PAGE D'ACCUEIL
   */
  public function createAccueil()
  {
      return $this->render('rt/admin/create-accueil.html.twig', [
      ]);
  }
}

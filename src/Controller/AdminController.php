<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use App\Entity\Articles;
use App\Entity\Utilisateurs;
use App\Entity\Tarifs;
use App\Entity\User;

use App\Repository\ArticlesRepository;
use App\Repository\UtilisateursRepository;
use App\Repository\TarifsRepository;
use App\Repository\UserRepository;

use App\Form\ArticleType;
use App\Form\UtilisateursType;
use App\Form\TarifType;

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
   * @Route("/rt/admin/portail-utilisateurs", name="portailUtilisateurs")
   * PAGE PORTAIL COWORKER
   */
  public function portailUtilisateurs()
  {
      return $this->render('rt/admin/portail-utilisateurs.html.twig', [
      ]);
  }

  /**
   * @Route("/rt/admin/create-utilisateur", name="create-utilisateur")
   * PAGE AJOUT UTILISATEUR (page admin)
   */
  public function createUtilisateur(Request $request, ObjectManager $manager)
  {
    $utilisateur = new Utilisateurs;

    $formUtilisateur = $this->createForm(UtilisateursType::class, $utilisateur);

    $formUtilisateur->handleRequest($request);

    if($formUtilisateur->isSubmitted() && $formUtilisateur->isValid()){
    $image = $formUtilisateur['profilpicture']->getData();
    $image1 = $formUtilisateur['image1']->getData();
    $image2 = $formUtilisateur['image2']->getData();
    $image3 = $formUtilisateur['image3']->getData();
    $image4 = $formUtilisateur['image4']->getData();
    $extension = $image->guessExtension();
      if (!$extension) {
        // extension cannot be guessed
        $extension = 'bin';
      }
    $extension1 = $image1->guessExtension();
      if (!$extension1) {
        // extension cannot be guessed
        $extension1 = 'bin';
      }
    $extension2 = $image2->guessExtension();
      if (!$extension2) {
        // extension cannot be guessed
        $extension2 = 'bin';
      }
    $extension3 = $image3->guessExtension();
      if (!$extension3) {
        // extension cannot be guessed
        $extension3 = 'bin';
      }
    $extension4 = $image4->guessExtension();
      if (!$extension4) {
        // extension cannot be guessed
        $extension4 = 'bin';
      }
    $id = sizeof($this->getDoctrine()
        ->getRepository(Utilisateurs::class)
        ->findAll());
    $title = 'profilpicture'.$id;
    $title1 = 'image1'.$id;
    $title2 = 'image2'.$id;
    $title3 = 'image3'.$id;
    $title4 = 'image4'.$id;

    $image->move('img/utilisateurs', $title.'.'.$extension);
    $image1->move('img/utilisateurs', $title1.'.'.$extension1);
    $image2->move('img/utilisateurs', $title2.'.'.$extension2);
    $image3->move('img/utilisateurs', $title3.'.'.$extension3);
    $image4->move('img/utilisateurs', $title4.'.'.$extension4);
    $utilisateur->setProfilpicture('img/utilisateurs/'.$title.'.'.$extension);
    $utilisateur->setImage1('img/utilisateurs/'.$title1.'.'.$extension1);
    $utilisateur->setImage2('img/utilisateurs/'.$title2.'.'.$extension2);
    $utilisateur->setImage3('img/utilisateurs/'.$title3.'.'.$extension3);
    $utilisateur->setImage4('img/utilisateurs/'.$title4.'.'.$extension4);
    $manager->persist($utilisateur);
    $manager->flush();

    return $this ->redirectToRoute('validation');
    }

    return $this->render('rt/admin/create-utilisateur.html.twig', [
      'formUtilisateur' => $formUtilisateur->createView()
    ]);
  }

  /**
   * @Route("/rt/admin/modify-utilisateur", name="modify-utilisateur")
   * PAGE MODIFICATION UTILISATEURS (page admin)
   */
   public function modifyUtilisateur(Request $request, ObjectManager $manager,UtilisateursRepository $repoU)
   {
     $list = $repoU->findAll();

     if (isset($_POST['utilisateur'])) {
       foreach ($_POST['utilisateur'] as $id) {
         $number = $repoU->find($id);
         $manager->persist($number);
       }
       $manager->flush();
       return $this ->redirect('modif-utilisateur/'.$id);
     }


     return $this->render('rt/admin/modify-utilisateur.html.twig', [
       'list' => $list
     ]);
   }


    /**
     * @Route("/rt/admin/modif-utilisateur/{id}", name="modif-utilisateur")
     * PAGE TYPE MODIFICATION UTILISATEUR (page admin)
     */
     public function modifUtilisateur(Utilisateurs $utilisateur, Request $request, ObjectManager $manager)
     {
       $formUtilisateur = $this->createFormBuilder($utilisateur)
                     ->add('name')
                     ->add('firstname')
                     ->add('company')
                     ->add('status')
                     ->add('description')
                     ->add('comment')
                     ->add('socialmedia1')
                     ->add('socialmedia2')
                     ->add('socialmedia3')
                     ->getForm();

       $formUtilisateur->handleRequest($request);

       if($formUtilisateur->isSubmitted() && $formUtilisateur->isValid()){
       $manager->persist($utilisateur);
       $manager->flush();
       return $this->redirectToRoute('validation');
       }
       return $this->render('rt/admin/modif-utilisateur.html.twig', [
         'formUtilisateur' => $formUtilisateur->createView(),
         'utilisateur' => $utilisateur
       ]);
     }

     /**
      * @Route("/rt/admin/modify-photos", name="modify-photos")
      * PAGE LISTE UTILISATEURS POUR MODIF DES PHOTOS (page admin)
      */
      public function modifyPhotos(Request $request, ObjectManager $manager,UtilisateursRepository $repoPhotos)
      {
        $list = $repoPhotos->findAll();

        if (isset($_POST['utilisateur'])) {
          foreach ($_POST['utilisateur'] as $id) {
            $number = $repoPhotos->find($id);
            $manager->persist($number);
          }
          $manager->flush();
          return $this ->redirect('modif-photos/'.$id);
        }


        return $this->render('rt/admin/modify-photos.html.twig', [
          'list' => $list
        ]);
      }

      /**
       * @Route("/rt/admin/modif-photos/{id}", name="modif-photos")
       * PAGE TYPE MODIFICATION PHOTOS (page admin)
       */
       public function modifPhotos(Utilisateurs $utilisateur, Request $request, ObjectManager $manager)
       {
         $formUtilisateur = $this->createFormBuilder($utilisateur)
                       ->add('profilpicture', FileType::class, [
                         'required' => false,
                         'mapped' => false
                       ])
                       ->add('image1', FileType::class, [
                         'required' => false,
                         'mapped' => false
                       ])
                       ->add('image2', FileType::class, [
                         'required' => false,
                         'mapped' => false
                       ])
                       ->add('image3', FileType::class, [
                         'required' => false,
                         'mapped' => false
                       ])
                       ->add('image4', FileType::class, [
                         'required' => false,
                         'mapped' => false
                       ])
                       ->getForm();

         $formUtilisateur->handleRequest($request);

         if($formUtilisateur->isSubmitted() && $formUtilisateur->isValid()){
         $image = $formUtilisateur['profilpicture']->getData();
         $image1 = $formUtilisateur['image1']->getData();
         $image2 = $formUtilisateur['image2']->getData();
         $image3 = $formUtilisateur['image3']->getData();
         $image4 = $formUtilisateur['image4']->getData();
         $extension = $image->guessExtension();
           if (!$extension) {
             // extension cannot be guessed
             $extension = 'bin';
           }
         $extension1 = $image1->guessExtension();
           if (!$extension1) {
             // extension cannot be guessed
             $extension1 = 'bin';
           }
         $extension2 = $image2->guessExtension();
           if (!$extension2) {
             // extension cannot be guessed
             $extension2 = 'bin';
           }
         $extension3 = $image3->guessExtension();
           if (!$extension3) {
             // extension cannot be guessed
             $extension3 = 'bin';
           }
         $extension4 = $image4->guessExtension();
           if (!$extension4) {
             // extension cannot be guessed
             $extension4 = 'bin';
           }
         $id = sizeof($this->getDoctrine()
             ->getRepository(Utilisateurs::class)
             ->findAll());
         $title = 'profilpicture'.$id;
         $title1 = 'image1'.$id;
         $title2 = 'image2'.$id;
         $title3 = 'image3'.$id;
         $title4 = 'image4'.$id;

         $image->move('img/utilisateurs', $title.'.'.$extension);
         $image1->move('img/utilisateurs', $title1.'.'.$extension1);
         $image2->move('img/utilisateurs', $title2.'.'.$extension2);
         $image3->move('img/utilisateurs', $title3.'.'.$extension3);
         $image4->move('img/utilisateurs', $title4.'.'.$extension4);
         $utilisateur->setProfilpicture('img/utilisateurs/'.$title.'.'.$extension);
         $utilisateur->setImage1('img/utilisateurs/'.$title1.'.'.$extension1);
         $utilisateur->setImage2('img/utilisateurs/'.$title2.'.'.$extension2);
         $utilisateur->setImage3('img/utilisateurs/'.$title3.'.'.$extension3);
         $utilisateur->setImage4('img/utilisateurs/'.$title4.'.'.$extension4);
         $manager->persist($utilisateur);
         $manager->flush();

         return $this ->redirectToRoute('validation');
         }

         return $this->render('rt/admin/modif-photos.html.twig', [
           'formUtilisateur' => $formUtilisateur->createView(),
           'utilisateur' => $utilisateur
         ]);
       }

  /**
   * @Route("/rt/admin/remove-utilisateur", name="remove-utilisateur")
   * PAGE SUPPRESSION UTILISATEUR (page admin)
   */
   public function removeUtilisateur(Request $request, ObjectManager $manager,UtilisateursRepository $repoU)
   {
     $list = $repoU->findAll();

     if (isset($_POST['utilisateur'])) {
       foreach ($_POST['utilisateur'] as $id) {
         $user = $repoU->find($id);
         $manager->remove($user);
       }
       $manager->flush();
       return $this ->redirectToRoute('validation');
     }

     return $this->render('rt/admin/remove-utilisateur.html.twig', [
       'list' => $list
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
      $article = new Articles;

      $formArticle = $this->createForm(ArticleType::class, $article);

      $formArticle->handleRequest($request);

      if($formArticle->isSubmitted() && $formArticle->isValid()){
      $article->setCreatedAt(new \DateTime());
      $image = $formArticle['image']->getData();
      $extension = $image->guessExtension();
        if (!$extension) {
          // extension cannot be guessed
          $extension = 'bin';
        }
      $id = sizeof($this->getDoctrine()
          ->getRepository(Articles::class)
          ->findAll());
      $title = 'image'.$id;
      $image->move('img/articles', $title.'.'.$extension);
      $article->setImage('img/articles/'.$title.'.'.$extension);
      $manager->persist($article);
      $manager->flush();

      return $this ->redirectToRoute('validation');
      }

      return $this->render('rt/admin/create-article.html.twig', [
        'formArticle' => $formArticle->createView()
      ]);
  }

  /**
   * @Route("/rt/admin/modify-article", name="modify-article")
   * PAGE MODIFICATION ARTICLES (page admin)
   */
   public function modifyArticle(Request $request, ObjectManager $manager,ArticlesRepository $repoA)
   {
     $list = $repoA->findAll();

     if (isset($_POST['article'])) {
       foreach ($_POST['article'] as $id) {
         $number = $repoA->find($id);
         $manager->persist($number);
       }
       $manager->flush();
       return $this ->redirect('modif-article/'.$id);
     }

     return $this->render('rt/admin/modify-article.html.twig', [
       'list' => $list,
     ]);
   }

   /**
    * @Route("/rt/admin/modif-article/{id}", name="modif-article")
    * PAGE TYPE MODIFICATION ARTICLES (page admin)
    */
    public function modifArticle(Articles $article, Request $request, ObjectManager $manager)
    {
      $formArticle = $this->createFormBuilder($article)
                    ->add('title')
                    ->add('author')
                    ->add('image')
                    ->add('introduction')
                    ->add('sousTitre1')
                    ->add('paragraphe1')
                    ->add('sousTitre2')
                    ->add('paragraphe2')
                    ->add('sousTitre3')
                    ->add('paragraphe3')
                    ->add('sousTitre4')
                    ->add('paragraphe4')
                    ->getForm();

      $formArticle->handleRequest($request);

      if($formArticle->isSubmitted() && $formArticle->isValid()){
      $manager->persist($article);
      $manager->flush();
      return $this->redirectToRoute('validation');
      }
      return $this->render('rt/admin/modif-article.html.twig', [
        'formArticle' => $formArticle->createView()
      ]);
    }

  /**
   * @Route("/rt/admin/remove-article", name="remove-article")
   * PAGE SUPPRESSION ARTICLES (page admin)
   */
   public function removeArticle(Request $request, ObjectManager $manager,ArticlesRepository $repoA)
   {
     $list = $repoA->findAll();

     if (isset($_POST['article'])) {
       foreach ($_POST['article'] as $id) {
         $article = $repoA->find($id);
         $manager->remove($article);
       }
       $manager->flush();
       return $this ->redirectToRoute('validation');
     }

     return $this->render('rt/admin/remove-article.html.twig', [
       'list' => $list
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
   * @Route("/rt/admin/modify-tarifs", name="modify-tarifs")
   * PAGE MODIFICATION TARIFS LISTE (page admin)
   */
   public function modifyTarifs(Request $request, ObjectManager $manager,TarifsRepository $repoT)
   {
     $list = $repoT->findAll();

     if (isset($_POST['tarif'])) {
       foreach ($_POST['tarif'] as $id) {
         $number = $repoT->find($id);
         $manager->persist($number);
       }
       $manager->flush();
       return $this ->redirect('modif-tarifs/'.$id);
     }

     return $this->render('rt/admin/modify-tarifs.html.twig', [
       'list' => $list,
     ]);
   }

  /**
   * @Route("/rt/admin/modif-tarifs/{id}", name="modifTarifs")
   * PAGE MODIFICATION DES TARIFS FORM (page admin)
   */
  public function modifTarifs(Tarifs $tarif, Request $request, ObjectManager $manager)
  {
      $formTarifs = $this->createFormBuilder($tarif)
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
              ->add('comment', TextType::class)
              ->getForm();

        $formTarifs->handleRequest($request);

        if($formTarifs->isSubmitted() && $formTarifs->isValid()){
          $manager->persist($tarif);
          $manager->flush();
        return $this->redirectToRoute('validation');
        }
        return $this->render('rt/admin/modif-tarifs.html.twig', [
          'formTarifs' => $formTarifs->createView()
        ]);

      return $this->render('rt/admin/modify-tarifs.html.twig', [
      ]);
  }

  /**
   * @Route("/rt/admin/createTarif", name="createTarif")
   * PAGE D'AJOUT TARIFS
   */
  public function createTarif(Request $request, ObjectManager $manager)
  {
    $tarif = new Tarifs;

    $formTarif = $this->createForm(TarifType::class, $tarif);

    $formTarif->handleRequest($request);

    if($formTarif->isSubmitted() && $formTarif->isValid()){

      $manager->persist($tarif);
      $manager->flush();

    return $this ->redirectToRoute('validation');
    }

    return $this->render('rt/admin/create-tarif.html.twig', [
      'formTarif' => $formTarif->createView()
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

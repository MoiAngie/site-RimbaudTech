<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\File\Exception\FileException;


use App\Entity\Articles;
use App\Entity\Content;
use App\Entity\Price;
use App\Entity\User;
use App\Entity\Comments;
use App\Entity\Booking;
use App\Entity\Newsletter;

use App\Repository\ArticlesRepository;
use App\Repository\ContentRepository;
use App\Repository\PriceRepository;
use App\Repository\UserRepository;
use App\Repository\CommentsRepository;
use App\Repository\BookingRepository;
use App\Repository\NewsletterRepository;

use App\Form\ArticleType;
use App\Form\ContentType;
use App\Form\PriceType;
use App\Form\CommentType;
use App\Form\UserType;
use App\Form\BookingType;
use App\Form\NewsletterType;


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
   * @Route("/rt/admin/portail-content", name="portailContent")
   * PAGE PORTAIL COWORKER
   */
  public function portailContent()
  {
      return $this->render('rt/admin/portail-content.html.twig', [
      ]);
  }

  /**
   * @Route("/rt/admin/create-content", name="create-content")
   * PAGE AJOUT CONTENT (page admin)
   */
  public function createContent(Request $request, ObjectManager $manager)
  {
    $content = new Content;

    $formContent = $this->createForm(ContentType::class, $content);

    $formContent->handleRequest($request);

    if($formContent->isSubmitted() && $formContent->isValid()){
      $image  = $formContent['profilpicture']->getData();
      $image1 = $formContent['image1']->getData();
      $image2 = $formContent['image2']->getData();
      $image3 = $formContent['image3']->getData();
      $image4 = $formContent['image4']->getData();

      if ($image) {
        $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                $newFilename = $originalFilename.'-'.uniqid().'.'.$image->guessExtension();
                try {
                    $image->move(
                        $this->getParameter('content_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
                $content->setProfilpicture($newFilename);
            }
        if ($image1) {
          $originalFilename = pathinfo($image1->getClientOriginalName(), PATHINFO_FILENAME);
                  $newFilename = $originalFilename.'-'.uniqid().'.'.$image1->guessExtension();
                  try {
                      $image1->move(
                          $this->getParameter('content_directory'),
                          $newFilename
                      );
                  } catch (FileException $e) {
                  }
                  $content->setImage1($newFilename);
              }

        if ($image2) {
          $originalFilename = pathinfo($image2->getClientOriginalName(), PATHINFO_FILENAME);
                  $newFilename = $originalFilename.'-'.uniqid().'.'.$image2->guessExtension();
                  try {
                      $image2->move(
                          $this->getParameter('content_directory'),
                          $newFilename
                      );
                  } catch (FileException $e) {
                  }
                  $content->setImage2($newFilename);
              }

        if ($image3) {
          $originalFilename = pathinfo($image3->getClientOriginalName(), PATHINFO_FILENAME);
                  $newFilename = $originalFilename.'-'.uniqid().'.'.$image3->guessExtension();
                  try {
                      $image3->move(
                          $this->getParameter('content_directory'),
                          $newFilename
                      );
                  } catch (FileException $e) {
                  }
                  $content->setImage3($newFilename);
              }

        if ($image4) {
          $originalFilename = pathinfo($image4->getClientOriginalName(), PATHINFO_FILENAME);
                  $newFilename = $originalFilename.'-'.uniqid().'.'.$image4->guessExtension();
                  try {
                      $image4->move(
                          $this->getParameter('content_directory'),
                          $newFilename
                      );
                  } catch (FileException $e) {
                  }
                  $content->setImage4($newFilename);
              }

            $manager->persist($content);
            $manager->flush();

            return $this ->redirectToRoute('validation');
      }

    return $this->render('rt/admin/create-content.html.twig', [
      'formContent' => $formContent->createView()
    ]);
  }

  /**
   * @Route("/rt/admin/modify-content", name="modify-content")
   * PAGE MODIFICATION CONTENT (page admin)
   */
   public function modifyContent(Request $request, ObjectManager $manager,ContentRepository $repoU)
   {
     $list = $repoU->findBy(array(), ['name' => 'ASC']);

     if (isset($_POST['content'])) {
       foreach ($_POST['content'] as $id) {
         $number = $repoU->find($id);
         $manager->persist($number);
       }
       $manager->flush();
       return $this ->redirect('modif-content/'.$id);
     }


     return $this->render('rt/admin/modify-content.html.twig', [
       'list' => $list
     ]);
   }


    /**
     * @Route("/rt/admin/modif-content/{id}", name="modif-content")
     * PAGE TYPE MODIFICATION CONTENT (page admin)
     */
     public function modifContent(Content $content, Request $request, ObjectManager $manager)
     {
       $formContent = $this->createFormBuilder($content)
                     ->add('name')
                     ->add('firstname')
                     ->add('company')
                     ->add('status',ChoiceType::class,[
                             'placeholder' => "Modifier le statut",
                             'choices'  => [
                             "Incubé" => "Incubé",
                             "Co-worker" => "Co-workeur",
                             "Personnel" => "Personnel"
                           ],
                        ])
                     ->add('description')
                     ->add('comment')
                     ->add('socialmedia1')
                     ->add('socialmedia2')
                     ->add('socialmedia3')
                     ->add('site')
                     ->getForm();

       $formContent->handleRequest($request);

       if($formContent->isSubmitted() && $formContent->isValid()){
          $manager->persist($content);
          $manager->flush();
       return $this->redirectToRoute('validation');
       }
       return $this->render('rt/admin/modif-content.html.twig', [
         'formContent' => $formContent->createView(),
         'content' => $content
       ]);
     }

     /**
      * @Route("/rt/admin/modify-photos", name="modify-photos")
      * PAGE LISTE CONTENT POUR MODIF DES PHOTOS (page admin)
      */
      public function modifyPhotos(Request $request, ObjectManager $manager,ContentRepository $repoPhotos)
      {
        $list = $repoPhotos->findBy(array(), ['name' => 'ASC']);

        if (isset($_POST['content'])) {
          foreach ($_POST['content'] as $id) {
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
       public function modifPhotos(Content $content, Request $request, ObjectManager $manager)
       {
         $formContent = $this->createFormBuilder($content)
                       ->add('profilpicture', FileType::class, [
                         'required' => false,
                         'mapped'   => false
                       ])
                       ->add('image1', FileType::class, [
                         'required' => false,
                         'mapped'   => false
                       ])
                       ->add('image2', FileType::class, [
                         'required' => false,
                         'mapped'   => false
                       ])
                       ->add('image3', FileType::class, [
                         'required' => false,
                         'mapped'   => false
                       ])
                       ->add('image4', FileType::class, [
                         'required' => false,
                         'mapped'   => false
                       ])
                       ->getForm();

         $formContent->handleRequest($request);

         if($formContent->isSubmitted() && $formContent->isValid()){
           $image  = $formContent['profilpicture']->getData();
           $image1 = $formContent['image1']->getData();
           $image2 = $formContent['image2']->getData();
           $image3 = $formContent['image3']->getData();
           $image4 = $formContent['image4']->getData();

           if ($image) {
             $originalFilename = pathinfo($image->getClientOriginalName(), PATHINFO_FILENAME);
                     $newFilename = $originalFilename.'-'.uniqid().'.'.$image->guessExtension();
                     try {
                         $image->move(
                             $this->getParameter('content_directory'),
                             $newFilename
                         );
                     } catch (FileException $e) {
                         // ... handle exception if something happens during file upload
                     }
                     $content->setProfilpicture($newFilename);
                 }
             if ($image1) {
               $originalFilename = pathinfo($image1->getClientOriginalName(), PATHINFO_FILENAME);
                       $newFilename = $originalFilename.'-'.uniqid().'.'.$image1->guessExtension();
                       try {
                           $image1->move(
                               $this->getParameter('content_directory'),
                               $newFilename
                           );
                       } catch (FileException $e) {
                       }
                       $content->setImage1($newFilename);
                   }

             if ($image2) {
               $originalFilename = pathinfo($image2->getClientOriginalName(), PATHINFO_FILENAME);
                       $newFilename = $originalFilename.'-'.uniqid().'.'.$image2->guessExtension();
                       try {
                           $image2->move(
                               $this->getParameter('content_directory'),
                               $newFilename
                           );
                       } catch (FileException $e) {
                       }
                       $content->setImage2($newFilename);
                   }

             if ($image3) {
               $originalFilename = pathinfo($image3->getClientOriginalName(), PATHINFO_FILENAME);
                       $newFilename = $originalFilename.'-'.uniqid().'.'.$image3->guessExtension();
                       try {
                           $image3->move(
                               $this->getParameter('content_directory'),
                               $newFilename
                           );
                       } catch (FileException $e) {
                       }
                       $content->setImage3($newFilename);
                   }

             if ($image4) {
               $originalFilename = pathinfo($image4->getClientOriginalName(), PATHINFO_FILENAME);
                       $newFilename = $originalFilename.'-'.uniqid().'.'.$image4->guessExtension();
                       try {
                           $image4->move(
                               $this->getParameter('content_directory'),
                               $newFilename
                           );
                       } catch (FileException $e) {
                       }
                       $content->setImage4($newFilename);
                   }
         $manager->persist($content);
         $manager->flush();

         return $this->redirectToRoute('validation');
         }

         return $this->render('rt/admin/modif-photos.html.twig', [
           'formContent' => $formContent->createView(),
           'content' => $content
         ]);
       }

  /**
   * @Route("/rt/admin/remove-content", name="remove-content")
   * PAGE SUPPRESSION CONTENT (page admin)
   */
   public function removeContent(Request $request, ObjectManager $manager,ContentRepository $repoU)
   {
     $list = $repoU->findBy(array(), ['name' => 'ASC']);

     if (isset($_POST['content'])) {
       foreach ($_POST['content'] as $id) {
         $user = $repoU->find($id);
         $manager->remove($user);
       }
       $manager->flush();
       return $this ->redirectToRoute('validation');
     }

     return $this->render('rt/admin/remove-content.html.twig', [
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
      $image  ->move('img/articles', $title.'.'.$extension);
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
     $list = $repoA->findBy(array(), ['createdAt' => 'ASC']);

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
        'formArticle' => $formArticle->createView(),
        'articles'     => $article
      ]);
    }

  /**
   * @Route("/rt/admin/remove-article", name="remove-article")
   * PAGE SUPPRESSION ARTICLES (page admin)
   */
   public function removeArticle(Request $request, ObjectManager $manager,ArticlesRepository $repoA)
   {
     $list = $repoA->findBy(array(), ['createdAt' => 'ASC']);

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
   public function modifyTarifs(Request $request, ObjectManager $manager,PriceRepository $repoT)
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
  public function modifTarifs(Price $price, Request $request, ObjectManager $manager)
  {
      $formTarifs = $this->createFormBuilder($price)
              ->add('hour', TextType::class)
              ->add('halfDay', TextType::class)
              ->add('day', TextType::class)
              ->add('month', TextType::class)
              ->add('year', TextType::class)
              ->add('comment', TextType::class)
              ->getForm();

        $formTarifs->handleRequest($request);

        if($formTarifs->isSubmitted() && $formTarifs->isValid()){
          $manager->persist($price);
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
   * @Route("/rt/admin/modify-comment", name="modify-comment")
   * PAGE LISTE DES COMMENTAIRES (page admin)
   */
   public function modifyComment(Request $request, ObjectManager $manager,CommentsRepository $repoC)
   {
     $list = $repoC->findAll();

     if (isset($_POST['comment'])) {
       foreach ($_POST['comment'] as $id) {
         $number = $repoC->find($id);
         $manager->persist($number);
       }
       $manager->flush();
       return $this ->redirect('modif-comment/'.$id);
     }

     return $this->render('rt/admin/modify-comment.html.twig', [
       'list' => $list,
     ]);
   }

  /**
   * @Route("/rt/admin/modif-comment/{id}", name="modif-comment")
   * PAGE MODIFICATION DES TARIFS FORM (page admin)
   */
  public function modifComment(Comments $comments, Request $request, ObjectManager $manager, CommentsRepository $repoComment)
  {

      $formComments = $this->createFormBuilder($comments)
              ->add('text', TextareaType::class)
              ->getForm();

        $formComments->handleRequest($request);

        if($formComments->isSubmitted() && $formComments->isValid()){
          $manager->persist($comments);
          $manager->flush();
        return $this->redirectToRoute('validation');
        }
        return $this->render('rt/admin/modif-comment.html.twig', [
          'formComments' => $formComments->createView(),
          'comment' => $comments
        ]);

      return $this->render('rt/admin/modify-comment.html.twig', [

      ]);
  }

  /**
   * @Route("/rt/admin/remove-comment", name="remove-comment")
   * PAGE SUPPRESSION COMMENTAIRES (page admin)
   */
   public function removeComment(Request $request, ObjectManager $manager,CommentsRepository $repoO)
   {
     $list = $repoO->findAll();

     if (isset($_POST['comment'])) {
       foreach ($_POST['comment'] as $id) {
         $comment = $repoO->find($id);
         $manager->remove($comment);
       }
       $manager->flush();
       return $this ->redirectToRoute('validation');
     }

     return $this->render('rt/admin/remove-comment.html.twig', [
       'list' => $list
     ]);
   }

   /**
    * @Route("/rt/admin/portail-booking", name="portailBooking")
    * PAGE PORTAIL BOOKING / RESERVATIONS
    */
   public function portailBooking()
   {
       return $this->render('rt/admin/portail-booking.html.twig', [
       ]);
   }

   /**
    * @Route("/rt/admin/list-booking", name="list-booking")
    * PAGE LISTING BOOKING / RESERVATIONS
    */
   public function listBooking(BookingRepository $repoList)
   {
       return $this->render('rt/admin/list-booking.html.twig', [
         'booking' => $repoList->findAll()
       ]);
   }


   /**
    * @Route("/rt/admin/modify-booking", name="modify-booking")
    * PAGE LISTE DES RESERVATIONS (page admin)
    */
    public function modifyBooking(Request $request, ObjectManager $manager, BookingRepository $repoB)
    {
      $list = $repoB->findBy(array(), ['startDate' => 'ASC']);

      if (isset($_POST['booking'])) {
        foreach ($_POST['booking'] as $id) {
          $number = $repoB->find($id);
          $manager->persist($number);
        }
        $manager->flush();
        return $this ->redirect('modif-booking/'.$id);
      }

      return $this->render('rt/admin/modify-booking.html.twig', [
        'list' => $list,
      ]);
    }

    /**
     * @Route("/rt/admin/modif-booking/{id}", name="modif-booking")
     * PAGE TYPE MODIFICATION RESERVATIONS (page admin)
     */
     public function modifBooking(Booking $booking, Request $request, ObjectManager $manager)
     {
       $formBooking = $this->createFormBuilder($booking)
                     ->add('startDate', DateType::class, ['widget' => 'choice', 'format' => 'dd MM yyyy'])
                     ->add('endDate', DateType::class, ['widget' => 'choice', 'format' => 'dd MM yyyy'])
                     ->getForm();

       $formBooking->handleRequest($request);

       if($formBooking->isSubmitted() && $formBooking->isValid()){
           $manager->persist($booking);
           $manager->flush();
       return $this->redirectToRoute('validation');
       }
       return $this->render('rt/admin/modif-booking.html.twig', [
         'formBooking' => $formBooking->createView(),
         'booking'     => $booking
       ]);
     }

     /**
      * @Route("/rt/admin/remove-booking", name="remove-booking")
      * PAGE SUPPRESSION RESERVATIONS (page admin)
      */
      public function removeBooking(Request $request, ObjectManager $manager,BookingRepository $repoBooking)
      {
        $list = $repoBooking->findBy(array(), ['startDate' => 'ASC']);

        if (isset($_POST['booking'])) {
          foreach ($_POST['booking'] as $id) {
            $booking = $repoBooking->find($id);
            $manager->remove($booking);
          }
          $manager->flush();
          return $this ->redirectToRoute('validation');
        }

        return $this->render('rt/admin/remove-booking.html.twig', [
          'list' => $list
        ]);
      }


        /**
         * @Route("/rt/admin/modify-newsletter", name="modify-newsletter")
         * PAGE LISTE CONTENT POUR MODIF LA NEWSLETTER (page admin)
         */
         public function modifyNewsletter(Request $request, ObjectManager $manager, NewsletterRepository $repoNews)
         {
           $list = $repoNews->findAll();

           if (isset($_POST['newsletter'])) {
             foreach ($_POST['newsletter'] as $id) {
               $number = $repoNews->find($id);
               $manager->persist($number);
             }
             $manager->flush();
             return $this ->redirect('modif-newsletter/'.$id);
           }


           return $this->render('rt/admin/modify-newsletter.html.twig', [
             'list' => $list
           ]);
         }

         /**
          * @Route("/rt/admin/modif-newsletter/{id}", name="modif-newsletter")
          * PAGE TYPE MODIFICATION NEWSLETTER (page admin)
          */
          public function modifNewsletter(Newsletter $newsletter, Request $request, ObjectManager $manager)
          {
            $formNewsletter = $this->createFormBuilder($newsletter)
                          ->add('printscreen', FileType::class, [
                            'required' => false,
                            'mapped'   => false
                          ])
                          ->getForm();

            $formNewsletter->handleRequest($request);

            if($formNewsletter->isSubmitted() && $formNewsletter->isValid()){
            $printscreen  = $formNewsletter['printscreen']->getData();
            $extension = $printscreen->guessExtension();
              if (!$extension) {
                // extension cannot be guessed
                $extension = 'bin';
              }
            $id = sizeof($this->getDoctrine()
                ->getRepository(Newsletter::class)
                ->findAll());
            $title = 'printscreen'.$id;

            $printscreen->move('img/newsletter', $title.'.'.$extension);
            $newsletter->setPrintscreen('img/newsletter/'.$title.'.'.$extension);
            $manager->persist($newsletter);
            $manager->flush();

            return $this->redirectToRoute('validation');
            }

            return $this->render('rt/admin/modif-newsletter.html.twig', [
              'formNewsletter' => $formNewsletter->createView(),
              'newsletter' => $newsletter
            ]);
          }
          /**
           * @Route("/rt/admin/create-newsletter", name="create-newsletter")
           * PAGE AJOUT CONTENT (page admin)
           */
          public function createNewsletter(Request $request, ObjectManager $manager)
          {
            $newsletter = new Newsletter;

            $formNewsletter = $this->createForm(NewsletterType::class, $newsletter);

            $formNewsletter->handleRequest($request);

            if($formNewsletter->isSubmitted() && $formNewsletter->isValid()){
            $printscreen  = $formNewsletter['printscreen']->getData();
            $extension = $printscreen->guessExtension();
              if (!$extension) {
                // extension cannot be guessed
                $extension = 'bin';
              }
            $id = sizeof($this->getDoctrine()
                ->getRepository(Newsletter::class)
                ->findAll());
            $title  = 'printscreen'.$id;

            $printscreen ->move('img/newsletter', $title.'.'.$extension);
            $newsletter->setPrintscreen('img/newsletter/'.$title.'.'.$extension);
            $manager->persist($newsletter);
            $manager->flush();

            return $this ->redirectToRoute('validation');
            }

            return $this->render('rt/admin/create-newsletter.html.twig', [
              'formNewsletter' => $formNewsletter->createView()
            ]);
          }

}

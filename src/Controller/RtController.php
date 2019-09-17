<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Doctrine\Common\Persistence\ObjectManager;

use App\Entity\Articles;
use App\Entity\Content;
use App\Entity\Comments;
use App\Entity\Contact;
use App\Entity\Status;
use App\Entity\Booking;
use App\Entity\Price;
use App\Entity\Coworking;

use App\Repository\ArticlesRepository;
use App\Repository\ContentRepository;
use App\Repository\TarifsRepository;
use App\Repository\CommentsRepository;
use App\Repository\StatusRepository;
use App\Repository\BookingRepository;
use App\Repository\CoworkingRepository;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

use App\Form\ArticleType;
use App\Form\ContactType;
use App\Form\CommentType;
use App\Form\BookingType;

use App\Notification\ContactNotification;

class RtController extends AbstractController
{
    /**
     * @Route("/rt", name="rt")
     * PAGE ACCUEIL DU SITE
     */
    public function index(ContentRepository $repo, ArticlesRepository $repoA)
    {
        $content= $repo->findByStatus("Incubé");
        $article = $repoA->findArticleIndex();

        return $this->render('rt/index.html.twig', [
            'controller_name' => 'RtController',
            'content' =>$content,
            'article' => $article,
        ]);
    }

    /**
     * @Route("/rt/articles", name="articles")
     * PAGE AVEC TOUS LES ARTICLES
     */
    public function articles(ArticlesRepository $repoAll)
    {
    //  if(!$this->isGranted('ROLE_ADMIN')){
    //    return $this->
    //  }
        $articles = $repoAll->findAll();

        return $this->render('rt/articles.html.twig', [
            'articles' =>$articles
        ]);
    }

    /**
     * @Route("/rt/coworking", name="coworking")
     * PAGE PRESENTATION CO-WORKING
     */
    public function coworking(ContentRepository $repo, CoworkingRepository $repoT)
    {
      $content = $repo->findByStatus('Co-workeur');
      $adherent = $repoT->findOneBy(['adherent' => true]);
      $nadherent = $repoT->findOneBy(['adherent' => false]);
      return $this->render('rt/co-working.html.twig', [
        'content' =>$content,
        'adherent' => $adherent,
        'nadherent' => $nadherent
      ]);
    }

    /**
     * @Route("/rt/coworker/{id}", name="coworker")
     * PAGE TYPE COWORKER (afficher un coworker à la fois)
     */
    public function showcoworkeur(ContentRepository $repo, $id)
    {
      $coworker = $repo->find($id);
      return $this->render('rt/coworker.html.twig', [
        'coworker' => $coworker
      ]);
    }

    /**
 * @Route("/rt/location", name="location")
 * PAGE LOCATION DE SALLE
 */
public function location(StatusRepository $rep)
{
    return $this->render('rt/location.html.twig', [
      'status' => $rep->findAll()
    ]);
}
    /**
     * @Route("/rt/incubation", name="incubation")
     * PAGE PRESENTATION DE L'INCUBATION
     */
    public function incubation(ContentRepository $repo)
    {
        $content = $repo->findByStatus("Personnel");
        return $this->render('rt/incubation.html.twig', [
          'content' => $content
        ]);
    }

    /**
     * @Route("/rt/galerie-incubes", name="galerie-incubes")
     * PAGE GALLERIE INCUBES
     */
    public function galerie_incubes(ContentRepository $repo)
    {
      $content = $repo->findByStatus("Incubé");
      return $this->render('rt/galerie-incube.html.twig', [
        'content' => $content
      ]);
    }

    /**
     * @Route("/rt/incube/{id}", name="incube")
     * PAGE TYPE INCUBES (afficher un incube à la fois)
     */
    public function showincube(ContentRepository $repo, $id)
    {
      $incube = $repo->find($id);
      return $this->render('rt/incube.html.twig', [
        'incube' => $incube
      ]);
    }

    /**
     * @Route("/rt/actu", name="actu")
     * PAGE ACTUALITES
     */
    public function actu(ArticlesRepository $repo)
    {

        $article = $repo->findArticleActu();
        $article2 = $repo->findAll();

        return $this->render('rt/actu.html.twig', [
          'article'  =>$article,
          'article2' =>$article2
        ]);
    }

    /**
     * @Route("/rt/article/{id}", name="article")
     * PAGE D'AFFICHAGE D'UN ARTICLE COMPLET AVEC SES COMMENTAIRES
     */
    public function showarticle(ArticlesRepository $repo, Articles $article, Request $request, ObjectManager $manager)
    {
      if($this->getUser() != null){
        $user = $this->getUser();
        $comment= new Comments($user, $article);

        $formComment = $this->createForm(CommentType::class, $comment);

        $formComment->handleRequest($request);

        if ($formComment->isSubmitted() && $formComment->isValid()) {
          $manager->persist($comment);
          $manager->flush();
                return $this->redirectToRoute('article', ['id' => $article->getId()]);
        }
        $form = $formComment->createView();


      } else {
        $form = null;
      }


        $articles = $repo->findAll();
        $prev = null;
        $next = null;
        $taille = count($articles);
          for($i = 0 ; $i < $taille ; $i++){
            if($articles[$i] == $article){
              if($i != 0){
                $prev = $articles[$i-1];
              }
              if($i != $taille-1){
                $next = $articles[$i+1];
              }
            }
          }

        return $this->render('rt/article.html.twig', [
          'article'     => $article,
          'next'        => $next,
          'prev'        => $prev,
          'formComment' => $form
        ]);

  }
    /**
     * @Route("/rt/contact", name="contact")
     * PAGE CONTACT
     */
    public function contact(Request $request, ContactNotification $notification)
    {
      $contact = new Contact();
      $formContact = $this->createForm(ContactType::class);
      $formContact->handleRequest($request);

      if ($formContact->isSubmitted() && $formContact->isValid()) {
        $notification->notify($contact);
        $this->addFlash(
    'success',
    'Votre message a bien été envoyé !'
);

        return $this->redirectToRoute('contact');
      }

        return $this->render('rt/contact.html.twig', [
          'formContact' => $formContact->createView()
        ]);

    }

    /**
     * @Route("/rt/redirection", name="redirection")
     * PAGE DE REDIRECTION APRES CONNEXION
     */
    public function redirection()
    {
        return $this->render('rt/redirection.html.twig', [
        ]);
    }

}

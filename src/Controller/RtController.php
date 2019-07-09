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
use App\Entity\Contact;
use App\Repository\ArticlesRepository;
use App\Repository\UtilisateursRepository;
use App\Form\ArticleType;
use App\Form\ContactType;

class RtController extends AbstractController
{
    /**
     * @Route("/rt", name="rt")
     * PAGE ACCUEIL DU SITE
     */
    public function index(UtilisateursRepository $repo, ArticlesRepository $repoA)
    {
        $incubes = $repo->findByStatus("Incubé");
        $article = $repoA->findAll();

        return $this->render('rt/index.html.twig', [
            'controller_name' => 'RtController',
            'incubes' =>$incubes,
            'article' => $article
        ]);
    }

    /**
     * @Route("/rt/coworking", name="coworking")
     * PAGE PRESENTATION CO-WORKING
     */
    public function coworking(UtilisateursRepository $repo)
    {
      $coworker = $repo->findByStatus("co-worker");
      return $this->render('rt/co-working.html.twig', [
        'coworker' =>$coworker
      ]);
    }

    /**
     * @Route("/rt/coworker/{id}", name="coworker")
     * PAGE TYPE COWORKER (afficher un coworker à la fois)
     */
    public function showcoworkeur(UtilisateursRepository $repo, $id)
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
    public function location()
    {
        return $this->render('rt/location.html.twig', [
        ]);
    }

    /**
     * @Route("/rt/incubation", name="incubation")
     * PAGE PRESENTATION DE L'INCUBATION
     */
    public function incubation()
    {
        return $this->render('rt/incubation.html.twig', [
        ]);
    }

    /**
     * @Route("/rt/galerie-incubes", name="galerie-incubes")
     * PAGE GALLERIE INCUBES
     */
    public function galerie_incubes(UtilisateursRepository $repo)
    {
      $incubes = $repo->findByStatus("Incubé");
      return $this->render('rt/galerie-incube.html.twig', [
        'incubes' =>$incubes
      ]);
    }

    /**
     * @Route("/rt/incube/{id}", name="incube")
     * PAGE TYPE INCUBES (afficher un incube à la fois)
     */
    public function showincube(UtilisateursRepository $repo, $id)
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
          'article' =>$article
          'article2' =>$article2
        ]);
    }

    /**
     * @Route("/rt/article/{id}", name="article")
     * PAGE D'AFFICHAGE D'UN ARTICLE COMPLET
     */
    public function showarticle(ArticlesRepository $repo, $id)
    {

        $article = $repo->find($id);
        return $this->render('rt/article.html.twig', [
          'article' => $article
        ]);
    }

    /**
     * @Route("/rt/contact", name="contact")
     * PAGE CONTACT
     */
    public function contact()
    {
      $contact = new Contact();

      $formContact = $this->createForm(ContactType::class);

        return $this->render('rt/contact.html.twig', [
          'formContact' => $formContact->createView()
        ]);
    }
}

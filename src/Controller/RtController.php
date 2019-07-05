<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;

use App\Entity\Articles;
use App\Repository\ArticlesRepository;
use App\Entity\Utilisateurs;
use App\Repository\UtilisateursRepository;
use App\Entity\Contact;
use App\Form\ContactType;
class RtController extends AbstractController
{
    /**
     * @Route("/rt", name="rt")
     */
    public function index(UtilisateursRepository $repo, ArticlesRepository $repoA)
    {
        $incubes = $repo->findByStatus("Incubé");
        $article = $repoA->findArticle();

        return $this->render('rt/index.html.twig', [
            'controller_name' => 'RtController',
            'incubes' =>$incubes,
            'article' => $article
        ]);
    }

    /**
     * @Route("/rt/incubation", name="incubation")
     */
    public function incubation()
    {
        return $this->render('rt/incubation.html.twig', [
        ]);
    }
    /**
     * @Route("/rt/coworking", name="coworking")
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
     */
    public function showcoworkeur(UtilisateursRepository $repo, $id)
    {
      $coworker = $repo->find($id);
      return $this->render('rt/coworker.html.twig', [
        'coworker' => $coworker
      ]);
    }

    /**
     * @Route("/rt/amin/create-cowork", name="create-cowork")
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
     * @Route("/rt/location", name="location")
     */
    public function location()
    {
        return $this->render('rt/location.html.twig', [
        ]);
    }
    /**
     * @Route("/rt/galerie-incubes", name="galerie-incubes")
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
     */
    public function showincube(UtilisateursRepository $repo, $id)
    {
      $incube = $repo->find($id);
      return $this->render('rt/incube.html.twig', [
        'incube' => $incube
      ]);
    }

    /**
     * @Route("/rt/admin/create-incube", name="create-incube")
     * page qui permet d'afficher les articles
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
     * @Route("/rt/actu", name="actu")
     */
    public function actu(ArticlesRepository $repo)
    {

        $articles = $repo->findAll();
        return $this->render('rt/actu.html.twig', [
          'articles' =>$articles
        ]);
    }
    /**
     * @Route("/rt/admin/create-article", name="create-article")
     * page qui permet d'afficher les articles
     */
    public function createarticle(Request $request, ObjectManager $manager)
    {
        $article = new Articles;

        $form = $this->createFormBuilder($article)
                      ->add ('title')
                      ->add ('author')
                      ->add ('content')
                      ->add ('image')
                      ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
        $article->setCreatedAt(new \DateTime());

        $manager->persist($article);
        $manager->flush();

        return $this ->redirectToRoute('validation');
        }

        return $this->render('rt/admin/create-article.html.twig', [
          'formArticle' => $form->createView()
        ]);
    }
    /**
     * @Route("/rt/article/{id}", name="article")
     * page qui permet d'afficher les articles
     */
    public function showarticle(ArticlesRepository $repo, $id)
    {

        $article = $repo->find($id);
        return $this->render('rt/article.html.twig', [
          'article' => $article
        ]);
    }
    /**
     * @Route("/rt/amin/portail-articles", name="portailArticles")
     */
    public function portailArticles()
    {
        return $this->render('rt/admin/portail-articles.html.twig', [
        ]);
    }
    /**
     * @Route("/rt/contact", name="contact")
     */
    public function contact()
    {
      $contact = new Contact();

      $formContact = $this->createForm(ContactType::class);

        return $this->render('rt/contact.html.twig', [
          'formContact' => $formContact->createView()
        ]);
    }
    /**
     * @Route("/rt/admin/homeAdmin", name="homeAdmin")
     */
    public function homeAdmin()
    {
        return $this->render('rt/admin/homeAdmin.html.twig', [
        ]);
    }
    /**
     * @Route("/rt/admin/validation", name="validation")
     */
    public function validation()
    {
        return $this->render('rt/admin/validation.html.twig', [
        ]);
    }
    /**
     * @Route("/rt/admin/createTarif", name="createTarif")
     */
    public function createTarif()
    {
        return $this->render('rt/admin/create-tarif.html.twig', [
        ]);
    }
    /**
     * @Route("/rt/admin/createPersonnel", name="createPersonnel")
     */
    public function createPersonnel()
    {
        return $this->render('rt/admin/create-personnel.html.twig', [
        ]);
    }
    /**
     * @Route("/rt/admin/createAccueil", name="createAccueil")
     */
    public function createAccueil()
    {
        return $this->render('rt/admin/create-accueil.html.twig', [
        ]);
    }
}

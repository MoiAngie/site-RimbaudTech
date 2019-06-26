<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;

use App\Entity\Articles;
class RtController extends AbstractController
{
    /**
     * @Route("/rt", name="rt")
     */
    public function index()
    {
        return $this->render('rt/index.html.twig', [
            'controller_name' => 'RtController',
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
    public function coworking()
    {
        return $this->render('rt/co-working.html.twig', [
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
    public function galerie_incubes()
    {
        return $this->render('rt/galerie-incube.html.twig', [
        ]);
    }
    /**
     * @Route("/rt/incube", name="incube")
     */
    public function incube()
    {
        return $this->render('rt/incube.html.twig', [
        ]);
    }
    /**
     * @Route("/rt/actu", name="actu")
     */
    public function actu()
    {
        return $this->render('rt/actu.html.twig', [
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
                      ->add ('content')
                      ->add ('image')
                      /*->add('publish', SubmitType::class, [
                      'label' => 'Publier un article',
                    ])*/
                      ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
        $article->setCreatedAt(new \DateTime());

        $manager->persist($article);
        $manager->flush();

        return $this ->redirectToRoute('article', ['id' => $article->getId()]);
        }
        dump($article);
        return $this->render('rt/admin/create-article.html.twig', [
          'formArticle' => $form->createView()
        ]);
    }
    /**
     * @Route("/rt/article", name="article")
     * page qui permet d'afficher les articles
     */
    public function showarticle()
    {
        return $this->render('rt/article.html.twig', [
        ]);
    }
    /**
     * @Route("/rt/contact", name="contact")
     */
    public function contact()
    {
        return $this->render('rt/contact.html.twig', [
        ]);
    }

    /**
     * @Route("/rt/slider-index", name="slider")
     */
    public function slider()
    {
        return $this->render('rt/slider-index.html.twig', [
        ]);
    }
}

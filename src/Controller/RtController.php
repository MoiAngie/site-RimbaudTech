<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

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
     * @Route("/rt/article", name="article")
     */
    public function article()
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
}

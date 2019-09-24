<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FooterlinksController extends AbstractController
{
    /**
     * @Route("/rt/footerlinks/cookies", name="cookies")
     */
    public function cookies()
    {
        return $this->render('rt/footerlinks/cookies.html.twig', [
        ]);
    }

    /**
     * @Route("/rt/footerlinks/sitemap", name="sitemap")
     */
    public function sitemap()
    {
        return $this->render('rt/footerlinks/sitemap.html.twig', [
        ]);
    }

    /**
     * @Route("/rt/footerlinks/mentionslegales", name="mentionslegales")
     */
    public function mentionslegales()
    {
        return $this->render('rt/footerlinks/mentionslegales.html.twig', [
        ]);
    }


}

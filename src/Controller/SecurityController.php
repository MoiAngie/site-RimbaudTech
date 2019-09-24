<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;

use App\Entity\User;
use App\Entity\Comments;
use App\Form\RegistrationType;
use App\Repository\UserRepository;
use App\Repository\BookingRepository;
use App\Repository\CommentsRepository;


class SecurityController extends AbstractController
{

    /**
    * @Route("/rt/security/Inscription", name="rt_security_registration")
    */
    public function registration(Request $request, ObjectManager $manager,
    UserPasswordEncoderInterface $encoder) {
      $user = new User();

      $form = $this->createForm(RegistrationType::class, $user);

      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()) {
        $hash = $encoder->encodePassword($user, $user->getPassword());

        $user->setPassword($hash);

        $manager->persist($user);
        $manager->flush();

        return $this->redirectToRoute('rt_security_login');
      }
      return $this->render('rt/security/registration.html.twig', [
        'form' => $form->createView()
      ]);
    }

    /**
     * @Route("/rt/login", name="rt_security_login")
     */
    public function login(AuthenticationUtils $utils)
    {
      $error = $utils->getLastAuthenticationError();

      if (isset($_POST['submit'])) {
      return $this ->redirectToRoute('redirection');
    }

        return $this->render('rt/security/login.html.twig', [
          'hasError' => $error !== null
        ]);
    }

    /**
     * @Route("/rt/profile", name="rt_security_profile")
     */
    public function profile(BookingRepository $repoBook, CommentsRepository $repoComment){
        $user = $this->getUser();

        return $this->render('rt/security/profile.html.twig', [
          'booking' => $repoBook->findAll(),
          'comment' => $repoComment->findAll(),
        ]);
    }



}

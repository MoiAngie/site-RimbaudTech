<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/*use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;*/
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;

use App\Entity\User;
use App\Form\RegistrationType;

class SecurityAdminController extends AbstractController
{

  /**
  * @Route("/Inscription", name="security_registration")
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

      return $this->redirectToRoute('validation');
    }
    return $this->render('security/registration.html.twig', [
      'form' => $form->createView()
    ]);
  }
  /**
   * @Route("/rt/admin/portail-admin", name="portailAdmin")
   */
  public function portailAdmin()
  {
      return $this->render('rt/admin/portail-admin.html.twig', [
      ]);
  }
    /**
     * @Route("/login", name="security_login")
     */
    public function login()
    {

        return $this->render('security/login.html.twig');
    }

    /**
     * @Route("/logout", name="security_logout")
     */
     public function logout() {}

       /**
        * @Route("/modifyUser", name="modify-User")
        */
       public function modifyUser()
       {

           return $this->render('security/modify-admin.html.twig');
       }

       /**
        * @Route("/removeUser", name="remove-User")
        */
       public function removeUser()
       {

           return $this->render('security/remove-admin.html.twig');
       }

}

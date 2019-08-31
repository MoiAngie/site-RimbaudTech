<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;

use App\Entity\User;
use App\Form\RegistrationType;
use App\Repository\UserRepository;

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
    public function login(AuthenticationUtils $utils)
    {
      $error = $utils->getLastAuthenticationError();

      if (isset($_POST['submit'])) {
      return $this ->redirectToRoute('homeAdmin');
    }

        return $this->render('security/login.html.twig', [
          'hasError' => $error !== null
        ]);
    }

    /**
     * @Route("/logout", name="security_logout")
     */
     public function logout() {}

       /**
        * @Route("/modifyUser", name="modify-User")
        * PAGE MODIFICATION ADMINISTRATEURS (page admin)
        */
        public function modifyUser(Request $request, ObjectManager $manager,UserRepository $repoAdmin)
        {
          $list = $repoAdmin->findAll();

          if (isset($_POST['user'])) {
            foreach ($_POST['user'] as $id) {
              $number = $repoAdmin->find($id);
              $manager->persist($number);
            }
            $manager->flush();
            return $this ->redirect('modifUser/'.$id);
          }


          return $this->render('security/modify-admin.html.twig', [
            'list' => $list
          ]);
        }


       /**
        * @Route("/modifUser/{id}", name="modif-User")
        * PAGE TYPE MODIFICATION USER (page admin)
        */
        public function modifUser(User $user, Request $request, ObjectManager $manager)
        {
          $form = $this->createFormBuilder($user)
                        ->add('username')
                        ->add('email')
                        ->add('password')
                        ->getForm();

          $form->handleRequest($request);

          if($form->isSubmitted() && $form->isValid()){
          $manager->persist($user);
          $manager->flush();
          return $this->redirectToRoute('validation');
          }
          return $this->render('security/modif-admin.html.twig', [
            'formUser' => $form->createView()
          ]);
        }

       /**
        * @Route("/removeUser", name="remove-User")
        * PAGE SUPPRESSION USER (page admin)
        */
        public function removeUser(Request $request, ObjectManager $manager, UserRepository $repoAdmin)
        {
          $list = $repoAdmin->findAll();

          if (isset($_POST['user'])) {
            foreach ($_POST['user'] as $id) {
              $user = $repoAdmin->find($id);
              $manager->remove($user);
            }
            $manager->flush();
            return $this ->redirectToRoute('validation');
          }

          return $this->render('security/remove-admin.html.twig', [
            'list' => $list
          ]);
        }

}

<?php
namespace App\Notifications;

class ContactNotification {

  /**
  * @var \Swift_Mailer
  */
  private $mailer;

  /**
  * @var Environment
  */
  private $renderer;

  public function construct(\Swift_Mailer $mailer, Environment $renderer){

  }

  public function notify(Contact $contact){

    $message = (new \Swift_Message($contact->getObject()))
      ->setFrom('clow.servieres@hotmail.fr')
      ->setTo('clow.servieres@hotmail.fr')
      ->setReplyTo($contact ->getEmail())
      ->setBody($this->renderer->render('rt/emails/contact.html.twig', [
        'contact' => $contact
      ]), 'text/html');
    $this->mailer->send($message);
  }
}

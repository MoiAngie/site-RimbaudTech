<?php
namespace App\Notification;

use App\Entity\Contact;
use Twig\Environment;


class ContactNotification {
  /**
   * @var \Swift_Mailer
   */
   private $mailer;

   /**
    * @var Environment
    */
    private $renderer;

  public function _construct(\Swift_Mailer $mailer, Environment $renderer) {
    $this->mailer = $mailer;
    $this->renderer = $renderer;
  }

  public function notify(Contact $contact, \Swift_Mailer $mailer) {
    $message = (new \Swift_Message())
      ->setFrom('noreply@rt.fr')
      ->setTo('angelinamaas.simplon@gmail.com')
      ->setReplyTo($contact->getEmail())
      ->setBody($this->renderer->render('emails/contact.html.twig', [
        'contact' => $contact
    ]), 'text/html');
    $this->mailer->send($message);

    return $this->render('rt/contact.html.twig', [
      'formContact' => $formContact->createView()
    ]);

  }

}

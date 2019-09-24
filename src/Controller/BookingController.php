<?php

namespace App\Controller;

use App\Entity\Status;
use App\Entity\Booking;
use App\Entity\Price;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;

use Symfony\Component\Form\Extension\Core\Type\DateType;

use App\Form\BookingType;
use App\Repository\StatusRepository;


class BookingController extends AbstractController
{
    /**
     *
     * @Route("rt/booking/{id}", name="booking-id")
     */
    public function book(StatusRepository $repoStatus, Request $request, ObjectManager $manager, Status $status = null)
    {
        $valid = false;
        if ($this->getUser() != null) {
          $user = $this->getUser();
          $booking= new Booking($user);

          $formBooking = $this->createForm(BookingType::class, $booking);

          $formBooking->handleRequest($request);

        if ($formBooking->isSubmitted() && $formBooking->isValid()) {
          $user = $this->getUser();
          $prices = $status->getPrices();
          $priceNew = null;
            foreach($prices as $price){
              $priceNew = $price;
              break;
            }

          $booking->setBooker($user)
                  ->setPrice($priceNew)
                  ->setStatus($status);

          //si les dates sont déjà réservées => message d'erreur
          if (!$booking->isBookableDates()) {
            $this->addFlash(
              'warning',
              "La salle est déjà occupée à ces dates-là. Veuillez en choisir d'autres ou contacter Rimbaud'Tech."
            );
          } else {
            //sinon, on valide le formulaire
            $manager->persist($booking);
            $manager->flush();
            $valid = true;
            }
          }
            $form = $formBooking->createView();
          } else {
            $form = null;
          }

          return $this->render('rt/booking.html.twig', [
            'validBooking' => $valid,
            'formBooking' => $form,
            'status' => $status
          ]);
    }
}

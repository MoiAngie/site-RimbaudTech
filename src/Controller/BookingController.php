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
     * @Route("rt/booking", name="booking")
     * @Route("rt/booking/{id}", name="booking-id")
     */
    public function book(StatusRepository $repoStatus, Request $request, ObjectManager $manager, Price $price, $id = null)
    {
        if($id != null){
          $status = $repoStatus->find($id);
        } else {
          $status = null;
        }

      if($this->getUser() != null) {
        $user = $this->getUser();
        $booking= new Booking($user);

        $formBooking = $this->createForm(BookingType::class, $booking);

        $formBooking->handleRequest($request);

        if ($formBooking->isSubmitted() && $formBooking->isValid()) {
          $user = $this->getUser();

          $booking->setBooker($user)
                  ->setPrice($price);

          $manager->persist($booking);
          $manager->flush();
        }
        $form = $formBooking->createView();

      //return $this->redirectToRoute('location');

      } else {
        $form = null;
      }

        return $this->render('rt/booking.html.twig', [
          'formBooking' => $form,
          'status' => $status
        ]);
    }
}

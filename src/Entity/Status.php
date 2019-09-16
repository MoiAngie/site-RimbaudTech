<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StatusRepository")
 */
class Status
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $status;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Price", mappedBy="status")
     */
    private $prices;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Booking", mappedBy="status")
     */
    private $bookings;

    public function __construct()
    {
        $this->prices = new ArrayCollection();
        $this->bookings = new ArrayCollection();
    }

    /**
    * Pour créer un tableau des jours possibles pour la réservation
    *
    * @return array c'est un tableau d'objets DateTime représentant les jours déjà réservés
    */
    public function getNotAvailableDays() {
      $notAvailableDays = [];

      foreach($this->bookings as $booking) {
        //calcul du nb de jours entre date d'arrivée et celle de fin
        $result = range( //Crée un tableau contenant un intervalle d'éléments
          $booking->getStartDate()->getTimestamp(),//début
          $booking->getEndDate()->getTimestamp(),//fin
          24 * 60 * 60 //step ou étape -> nombe de secondes dans une journée
        );

        $days = array_map(function($dayTimestamp) {
          return new \DateTime(date('Y-m-d', $dayTimestamp));
        }, $result);

        //Fusionner les tableaux $notAvailableDays et $days en un seul
        $notAvailableDays = array_merge($notAvailableDays, $days);
      }
      return $notAvailableDays;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    /**
     * @return Collection|Price[]
     */
    public function getPrices(): Collection
    {
        return $this->prices;
    }

    public function addPrice(Price $price): self
    {
        if (!$this->prices->contains($price)) {
            $this->prices[] = $price;
            $price->addStatus($this);
        }

        return $this;
    }

    public function removePrice(Price $price): self
    {
        if ($this->prices->contains($price)) {
            $this->prices->removeElement($price);
            $price->removeStatus($this);
        }

        return $this;
    }

    /**
     * @return Collection|Booking[]
     */
    public function getBookings(): Collection
    {
        return $this->bookings;
    }

    public function addBooking(Booking $booking): self
    {
        if (!$this->bookings->contains($booking)) {
            $this->bookings[] = $booking;
            $booking->setStatus($this);
        }

        return $this;
    }

    public function removeBooking(Booking $booking): self
    {
        if ($this->bookings->contains($booking)) {
            $this->bookings->removeElement($booking);
            // set the owning side to null (unless already changed)
            if ($booking->getStatus() === $this) {
                $booking->setStatus(null);
            }
        }

        return $this;
    }
}

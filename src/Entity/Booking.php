<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookingRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Booking
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="bookings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $booker;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\Date(message="Vous devez utiliser le format jj/mm/aaaa pour que votre saisie soit valide")
     * @Assert\GreaterThan("today", message="La date d'arrivée doit être antérieure à celle d'aujourd'hui")
     */
    private $startDate;

    /**
     * @ORM\Column(type="datetime")
     * @Assert\Date(message="Vous devez utiliser le format jj/mm/aaaa pour que votre saisie soit valide")
     * @Assert\GreaterThan(propertyPath="startDate", message="La date de fin doit être antérieure à celle d'arrivée")
     */
    private $endDate;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Price", inversedBy="booking")
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Status", inversedBy="bookings")
     */
    private $status;

    public function __construct()
    {
      $this->createdAt = new \DateTime();
    }

    // /**
    // * Callback
    // *
    // * @ORM\PrePersist
    // *
    // * @return void
    // */

    // public function prePersist() {
    //   if(empty($this->createdAt)) {
    //     $this->createdAt = new \DateTime();
    //   }
    //
    //   if(empty($this->price)) {
    //     $this->price = $this->status->getPrice() * $this->getDuration();
    //   }
    // }

    public function isBookableDates() {
      // déterminer les dates impossibles à la Réservation
      $notAvailableDays = $this->status->getNotAvailableDays();
      // comparer les dates choisies avec celles déjà réservées
      $bookingDays = $this->getDays();

      $formatDay = function($day) {
        return $day->format('Y-m-d');
      };

      //tableau de chaines de caractères des journées
      $days = array_map($formatDay, $bookingDays);

      $notAvailable = array_map($formatDay, $notAvailableDays);

      foreach($days as $day) {
        if(array_search($day, $notAvailable) !== false) return false;
      }

      return true;
    }

    /**
    * Pour créer un tableau des jours choisies pour la réservation
    *
    * @return array c'est un tableau d'objets DateTime représentant les jours de la réservation
    */
    public function getDays() {
      $result = range(
        $this->startDate->getTimestamp(),
        $this->endDate->getTimestamp(),
        24 * 60 * 60
      );

      $days = array_map(function($dayTimestamp) {
        return new \DateTime(date('Y-m-d', $dayTimestamp));
      }, $result);

      return $days;
    }

    public function getDuration() {
      $diff = $this->endDate->diff($this->startDate);
      return $diff->days;
    }

    // public function __construct(User $user, Booking $booking)
    // {
    //   $this->booker = $user;
    //   $this->booking = $booking;
    //   $this->created_at = new \DateTime();
    // }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBooker(): ?User
    {
        return $this->booker;
    }

    public function setBooker(?User $booker): self
    {
        $this->booker = $booker;

        return $this;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->startDate;
    }

    public function setStartDate(\DateTimeInterface $startDate): self
    {
        $this->startDate = $startDate;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->endDate;
    }

    public function setEndDate(\DateTimeInterface $endDate): self
    {
        $this->endDate = $endDate;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getPrice(): ?Price
    {
        return $this->price;
    }

    public function setPrice(?Price $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getStatus(): ?Status
    {
        return $this->status;
    }

    public function setStatus(?Status $status): self
    {
        $this->status = $status;

        return $this;
    }
}

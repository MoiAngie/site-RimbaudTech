<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CoworkingRepository")
 */
class Coworking
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $adherent;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Price", inversedBy="coworking", cascade={"persist", "remove"})
     */
    private $price;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdherent(): ?bool
    {
        return $this->adherent;
    }

    public function setAdherent(bool $adherent): self
    {
        $this->adherent = $adherent;

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
}

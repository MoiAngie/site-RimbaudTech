<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\NewsletterRepository")
 */
class Newsletter
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
    private $printscreen;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrintscreen(): ?string
    {
        return $this->printscreen;
    }

    public function setPrintscreen(string $printscreen): self
    {
        $this->printscreen = $printscreen;

        return $this;
    }
}

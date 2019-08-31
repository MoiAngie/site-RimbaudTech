<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticlesRepository")
 */
class Articles
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
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $author;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $introduction;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sousTitre1;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $paragraphe1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sousTitre2;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $paragraphe2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sousTitre3;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $paragraphe3;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $sousTitre4;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $paragraphe4;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $valid_until;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="articles")
     */
    public $publie_par;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(string $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

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

    public function getIntroduction(): ?string
    {
        return $this->introduction;
    }

    public function setIntroduction(?string $introduction): self
    {
        $this->introduction = $introduction;

        return $this;
    }

    public function getSousTitre1(): ?string
    {
        return $this->sousTitre1;
    }

    public function setSousTitre1(?string $sousTitre1): self
    {
        $this->sousTitre1 = $sousTitre1;

        return $this;
    }

    public function getParagraphe1(): ?string
    {
        return $this->paragraphe1;
    }

    public function setParagraphe1(?string $paragraphe1): self
    {
        $this->paragraphe1 = $paragraphe1;

        return $this;
    }

    public function getSousTitre2(): ?string
    {
        return $this->sousTitre2;
    }

    public function setSousTitre2(?string $sousTitre2): self
    {
        $this->sousTitre2 = $sousTitre2;

        return $this;
    }

    public function getParagraphe2(): ?string
    {
        return $this->paragraphe2;
    }

    public function setParagraphe2(?string $paragraphe2): self
    {
        $this->paragraphe2 = $paragraphe2;

        return $this;
    }

    public function getSousTitre3(): ?string
    {
        return $this->sousTitre3;
    }

    public function setSousTitre3(?string $sousTitre3): self
    {
        $this->sousTitre3 = $sousTitre3;

        return $this;
    }

    public function getParagraphe3(): ?string
    {
        return $this->paragraphe3;
    }

    public function setParagraphe3(?string $paragraphe3): self
    {
        $this->paragraphe3 = $paragraphe3;

        return $this;
    }

    public function getSousTitre4(): ?string
    {
        return $this->sousTitre4;
    }

    public function setSousTitre4(?string $sousTitre4): self
    {
        $this->sousTitre4 = $sousTitre4;

        return $this;
    }

    public function getParagraphe4(): ?string
    {
        return $this->paragraphe4;
    }

    public function setParagraphe4(?string $paragraphe4): self
    {
        $this->paragraphe4 = $paragraphe4;

        return $this;
    }

    public function getValidUntil(): ?\DateTimeInterface
    {
        return $this->valid_until;
    }

    public function setValidUntil(\DateTimeInterface $valid_until): self
    {
        $this->valid_until = $valid_until;

        return $this;
    }

    public function getPubliePar(): ?User
    {
        return $this->publie_par;
    }

    public function setPubliePar(?User $publie_par): self
    {
        $this->publie_par = $publie_par;

        return $this;
    }
}

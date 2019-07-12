<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TarifsRepository")
 */
class Tarifs
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $locaCE_demiJ;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $locaCE_J;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $locaReu_demiJ;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $locaReu_J;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $adhesionAnnee;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $CoHeure_adh;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $CoHeure_nonadh;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $CoDemiJ_adh;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $CoDemiJ_nonadh;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $CoJournee_adh;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $CoJournee_nonadh;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $CoMois_adh;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $CoMois_nonadh;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLocaCEDemiJ(): ?string
    {
        return $this->locaCE_demiJ;
    }

    public function setLocaCEDemiJ(?string $locaCE_demiJ): self
    {
        $this->locaCE_demiJ = $locaCE_demiJ;

        return $this;
    }

    public function getLocaCEJ(): ?string
    {
        return $this->locaCE_J;
    }

    public function setLocaCEJ(?string $locaCE_J): self
    {
        $this->locaCE_J = $locaCE_J;

        return $this;
    }

    public function getLocaReuDemiJ(): ?string
    {
        return $this->locaReu_demiJ;
    }

    public function setLocaReuDemiJ(?string $locaReu_demiJ): self
    {
        $this->locaReu_demiJ = $locaReu_demiJ;

        return $this;
    }

    public function getLocaReuJ(): ?string
    {
        return $this->locaReu_J;
    }

    public function setLocaReuJ(?string $locaReu_J): self
    {
        $this->locaReu_J = $locaReu_J;

        return $this;
    }

    public function getAdhesionAnnee(): ?string
    {
        return $this->adhesionAnnee;
    }

    public function setAdhesionAnnee(?string $adhesionAnnee): self
    {
        $this->adhesionAnnee = $adhesionAnnee;

        return $this;
    }

    public function getCoHeureAdh(): ?string
    {
        return $this->CoHeure_adh;
    }

    public function setCoHeureAdh(?string $CoHeure_adh): self
    {
        $this->CoHeure_adh = $CoHeure_adh;

        return $this;
    }

    public function getCoHeureNonadh(): ?string
    {
        return $this->CoHeure_nonadh;
    }

    public function setCoHeureNonadh(?string $CoHeure_nonadh): self
    {
        $this->CoHeure_nonadh = $CoHeure_nonadh;

        return $this;
    }

    public function getCoDemiJAdh(): ?string
    {
        return $this->CoDemiJ_adh;
    }

    public function setCoDemiJAdh(?string $CoDemiJ_adh): self
    {
        $this->CoDemiJ_adh = $CoDemiJ_adh;

        return $this;
    }

    public function getCoDemiJNonadh(): ?string
    {
        return $this->CoDemiJ_nonadh;
    }

    public function setCoDemiJNonadh(?string $CoDemiJ_nonadh): self
    {
        $this->CoDemiJ_nonadh = $CoDemiJ_nonadh;

        return $this;
    }

    public function getCoJourneeAdh(): ?string
    {
        return $this->CoJournee_adh;
    }

    public function setCoJourneeAdh(?string $CoJournee_adh): self
    {
        $this->CoJournee_adh = $CoJournee_adh;

        return $this;
    }

    public function getCoJourneeNonadh(): ?string
    {
        return $this->CoJournee_nonadh;
    }

    public function setCoJourneeNonadh(?string $CoJournee_nonadh): self
    {
        $this->CoJournee_nonadh = $CoJournee_nonadh;

        return $this;
    }

    public function getCoMoisAdh(): ?string
    {
        return $this->CoMois_adh;
    }

    public function setCoMoisAdh(?string $CoMois_adh): self
    {
        $this->CoMois_adh = $CoMois_adh;

        return $this;
    }

    public function getCoMoisNonadh(): ?string
    {
        return $this->CoMois_nonadh;
    }

    public function setCoMoisNonadh(?string $CoMois_nonadh): self
    {
        $this->CoMois_nonadh = $CoMois_nonadh;

        return $this;
    }
}

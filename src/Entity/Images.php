<?php

namespace App\Entity;

use App\Repository\ImagesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ImagesRepository::class)
 */
class Images
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
    private $nom;

    /**
     * @ORM\Column(type="text")
     */
    private $lien;

    /**
     * @ORM\ManyToOne(targetEntity=Realisations::class, inversedBy="images")
     * @ORM\JoinColumn(nullable=false)
     */
    private $realisations_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getLien(): ?string
    {
        return $this->lien;
    }

    public function setLien(string $lien): self
    {
        $this->lien = $lien;

        return $this;
    }

    public function getRealisationsId(): ?Realisations
    {
        return $this->realisations_id;
    }

    public function setRealisationsId(?Realisations $realisations_id): self
    {
        $this->realisations_id = $realisations_id;

        return $this;
    }
}

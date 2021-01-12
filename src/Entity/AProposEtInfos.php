<?php

namespace App\Entity;

use App\Repository\AProposEtInfosRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AProposEtInfosRepository::class)
 */
class AProposEtInfos
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom_entreprise;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adresse;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $code_postal;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email_contact;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $email_envoi_formulaire;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $facebook;

    /**
     * @ORM\Column(type="text")
     */
    private $presentation_a_propos;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $slogan;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $mentions_legales;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $complement_adresse;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $telephone_2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $autre;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomEntreprise(): ?string
    {
        return $this->nom_entreprise;
    }

    public function setNomEntreprise(string $nom_entreprise): self
    {
        $this->nom_entreprise = $nom_entreprise;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->code_postal;
    }

    public function setCodePostal(string $code_postal): self
    {
        $this->code_postal = $code_postal;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getEmailContact(): ?string
    {
        return $this->email_contact;
    }

    public function setEmailContact(string $email_contact): self
    {
        $this->email_contact = $email_contact;

        return $this;
    }

    public function getEmailEnvoiFormulaire(): ?string
    {
        return $this->email_envoi_formulaire;
    }

    public function setEmailEnvoiFormulaire(string $email_envoi_formulaire): self
    {
        $this->email_envoi_formulaire = $email_envoi_formulaire;

        return $this;
    }

    public function getFacebook(): ?string
    {
        return $this->facebook;
    }

    public function setFacebook(?string $facebook): self
    {
        $this->facebook = $facebook;

        return $this;
    }

    public function getPresentationAPropos(): ?string
    {
        return $this->presentation_a_propos;
    }

    public function setPresentationAPropos(string $presentation_a_propos): self
    {
        $this->presentation_a_propos = $presentation_a_propos;

        return $this;
    }

    public function getSlogan(): ?string
    {
        return $this->slogan;
    }

    public function setSlogan(string $slogan): self
    {
        $this->slogan = $slogan;

        return $this;
    }

    public function getMentionsLegales(): ?string
    {
        return $this->mentions_legales;
    }

    public function setMentionsLegales(?string $mentions_legales): self
    {
        $this->mentions_legales = $mentions_legales;

        return $this;
    }

    public function getComplementAdresse(): ?string
    {
        return $this->complement_adresse;
    }

    public function setComplementAdresse(?string $complement_adresse): self
    {
        $this->complement_adresse = $complement_adresse;

        return $this;
    }

    public function getTelephone2(): ?string
    {
        return $this->telephone_2;
    }

    public function setTelephone2(?string $telephone_2): self
    {
        $this->telephone_2 = $telephone_2;

        return $this;
    }

    public function getAutre(): ?string
    {
        return $this->autre;
    }

    public function setAutre(?string $autre): self
    {
        $this->autre = $autre;

        return $this;
    }

}

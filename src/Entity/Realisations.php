<?php

namespace App\Entity;

use App\Repository\RealisationsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass=RealisationsRepository::class)
 * @Vich\Uploadable()
 */
class Realisations
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string|null
     * @ORM\Column(type="string", length=255)
     */
    private $filename;


    /**
     * @var File|null
     * @Vich\UploadableField(mapping="realisation_image", fileNameProperty="filename")
     */
    private $imageFile;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="text")
     */
    private $hook;

    /**
     * @ORM\Column(type="text")
     */
    private $description;



    /**
     * @ORM\OneToMany(targetEntity=Images::class, mappedBy="realisations_id", orphanRemoval=true)
     */
    private $images;

    /**
     * @ORM\Column(type="text")
     */
    // J'ai mis en public, car j'ai une erreur d'accès dans la vue, si je laisse en privé
    public $image_defaut;

    /**
     * @ORM\Column(type="datetime")
     */
    // J'ai aussi mis ici en public, car j'ai une erreur d'accès dans la vue, si je laisse en privé
    public $date_creation;



    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->date_creation = new \DateTime('now');
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getHook(): ?string
    {
        return $this->hook;
    }

    public function setHook(string $hook): self
    {
        $this->hook = $hook;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }



    public function getImageDefaut(): ?string
    {
        return $this->image_defaut;
    }

    public function setImageDefaut(string $image_defaut): self
    {
        $this->image_defaut = $image_defaut;

        return $this;
    }

    /**
     * @return Collection|Images[]
     */
    public function getImages(): Collection
    {
        return $this->images;
    }

    public function addImage(Images $image): self
    {
        if (!$this->images->contains($image)) {
            $this->images[] = $image;
            $image->setRealisationsId($this);
        }

        return $this;
    }

    public function removeImage(Images $image): self
    {
        if ($this->images->contains($image)) {
            $this->images->removeElement($image);
            // set the owning side to null (unless already changed)
            if ($image->getRealisationsId() === $this) {
                $image->setRealisationsId(null);
            }
        }

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->date_creation;
    }

    public function setDateCreation(\DateTimeInterface $date_creation): self
    {
        $this->date_creation = $date_creation;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getFilename(): ?string
    {
        return $this->filename;
    }

    /**
     * @param null|string $filename
     * @return Realisations
     */
    public function setFilename(?string $filename): Realisations
    {
        $this->filename = $filename;
        return $this;
    }

    /**
     * @return null|File
     */
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    /**
     * @param null|string $imageFile
     * @return Realisations
     */
    public function setImageFile(?File $imageFile): Realisations
    {
        $this->imageFile = $imageFile;
        return $this;
    }
}

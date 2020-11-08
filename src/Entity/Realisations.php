<?php

namespace App\Entity;

use App\Repository\RealisationsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;


/**
 * @ORM\Entity(repositoryClass=RealisationsRepository::class)
 */
class Realisations
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    // /**
    //  * @var string|null
    //  * @ORM\Column(type="string", length=255)
    //  */
    // private $filename;



    /**
     * @ORM\Column(type="string", length=255)
     */
    private $titre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $hook;

    /**
     * @ORM\Column(type="text")
     */
    private $description;





    /**
     * @ORM\OneToMany(targetEntity=Images::class, mappedBy="realisations_id", orphanRemoval=true, cascade={"persist"})
     */
    private $images;





    // J'ai mis en public, car j'ai une erreur d'accès dans la vue, si je laisse en privé
    /**
     * @ORM\Column(type="datetime")
     */

    public $updated_at;



    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->updated_at = new \DateTime('now');
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




    // Ajouté automatiquement. C'est dans le cas d'une relation avec la table Images, pour l'upload multiple par ex.
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





    // /**
    //  * @return null|string
    //  */
    // public function getFilename(): ?string
    // {
    //     return $this->filename;
    // }

    // /**
    //  * @param null|string $filename
    //  * @return Realisations
    //  */
    // public function setFilename(?string $filename): Realisations
    // {
    //     $this->filename = $filename;
    //     return $this;
    // }



    // /**
    //  * @return null|File
    //  */
    // public function getImageFile(): ?File
    // {
    //     return $this->imageFile;
    // }




    // /**
    //  * @param null|string $imageFile
    //  * @return Realisations
    //  */
    // public function setImageFile(?File $imageFile): Realisations
    // {
    //     $this->imageFile = $imageFile;
    //     if ($this->imageFile instanceof UploadedFile) {
    //         $this->updated_at = new \DateTime('now');
    //     }


    //     return $this;
    // }




    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}

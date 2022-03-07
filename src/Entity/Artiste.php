<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ArtisteRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: ArtisteRepository::class)]
/**
 * @Vich\Uploadable
 */
class Artiste
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 50)]
    private $nom;

    #[ORM\Column(type: 'string', length: 50)]
    private $prenom;

    #[ORM\ManyToMany(targetEntity: Film::class, inversedBy: 'artistes')]
    private $film;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $photo;

    /**
     * @Vich\UploadableField(mapping="photos", fileNameProperty="photo")
     */
    private $photoFile;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $maj;

    public function __construct()
    {
        $this->film = new ArrayCollection();
    }

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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * @return Collection<int, Film>
     */
    public function getFilm(): Collection
    {
        return $this->film;
    }

    public function addFilm(Film $film): self
    {
        if (!$this->film->contains($film)) {
            $this->film[] = $film;
        }

        return $this;
    }

    public function removeFilm(Film $film): self
    {
        $this->film->removeElement($film);

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(?string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    public function getMaj(): ?\DateTimeInterface
    {
        return $this->maj;
    }

    public function setMaj(?\DateTimeInterface $maj): self
    {
        $this->maj = $maj;

        return $this;
    }

    /**
     * Get the value of photoFile
     */ 
    public function getPhotoFile()
    {
        return $this->photoFile;
    }

    /**
     * Set the value of photoFile
     *
     * @return  self
     */ 
    public function setPhotoFile($photoFile)
    {
        $this->photoFile = $photoFile;

        if (null !== $photoFile) {
            $this->maj = new \DateTimeImmutable();
        }

        return $this;
    }
}

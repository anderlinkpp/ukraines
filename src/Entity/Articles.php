<?php

namespace App\Entity;

use App\Repository\ArticlesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArticlesRepository::class)]
class Articles
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(length: 255)]
    private ?string $permalien = null;

    #[ORM\Column(length: 255)]
    private ?string $courteDescription = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateCreation = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateModification = null;

    #[ORM\Column]
    private ?bool $activation = null;

    #[ORM\ManyToMany(targetEntity: Categories::class, inversedBy: 'articles')]
    private Collection $categorie;

    #[ORM\ManyToMany(targetEntity: Images::class, inversedBy: 'articles')]
    private Collection $image;

    #[ORM\ManyToMany(targetEntity: Utilisateurs::class, inversedBy: 'articles')]
    private Collection $utilisateur;

    #[ORM\ManyToOne(inversedBy: 'article')]
    private ?Evenements $evenements = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $creationPar = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $modificationPar = null;

    public function __construct()
    {
        $this->categorie = new ArrayCollection();
        $this->image = new ArrayCollection();
        $this->utilisateur = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getPermalien(): ?string
    {
        return $this->permalien;
    }

    public function setPermalien(string $permalien): static
    {
        $this->permalien = $permalien;

        return $this;
    }

    public function getCourteDescription(): ?string
    {
        return $this->courteDescription;
    }

    public function setCourteDescription(string $courteDescription): static
    {
        $this->courteDescription = $courteDescription;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): static
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getDateModification(): ?\DateTimeInterface
    {
        return $this->dateModification;
    }

    public function setDateModification(?\DateTimeInterface $dateModification): static
    {
        $this->dateModification = $dateModification;

        return $this;
    }

    public function isActivation(): ?bool
    {
        return $this->activation;
    }

    public function setActivation(bool $activation): static
    {
        $this->activation = $activation;

        return $this;
    }

    /**
     * @return Collection<int, Categories>
     */
    public function getCategorie(): Collection
    {
        return $this->categorie;
    }

    public function addCategorie(Categories $categorie): static
    {
        if (!$this->categorie->contains($categorie)) {
            $this->categorie->add($categorie);
        }

        return $this;
    }

    public function removeCategorie(Categories $categorie): static
    {
        $this->categorie->removeElement($categorie);

        return $this;
    }

    /**
     * @return Collection<int, Images>
     */
    public function getImage(): Collection
    {
        return $this->image;
    }

    public function addImage(Images $image): static
    {
        if (!$this->image->contains($image)) {
            $this->image->add($image);
        }

        return $this;
    }

    public function removeImage(Images $image): static
    {
        $this->image->removeElement($image);

        return $this;
    }

    /**
     * @return Collection<int, Utilisateurs>
     */
    public function getUtilisateur(): Collection
    {
        return $this->utilisateur;
    }

    public function addUtilisateur(Utilisateurs $utilisateur): static
    {
        if (!$this->utilisateur->contains($utilisateur)) {
            $this->utilisateur->add($utilisateur);
        }

        return $this;
    }

    public function removeUtilisateur(Utilisateurs $utilisateur): static
    {
        $this->utilisateur->removeElement($utilisateur);

        return $this;
    }

    public function getEvenements(): ?Evenements
    {
        return $this->evenements;
    }

    public function setEvenements(?Evenements $evenements): static
    {
        $this->evenements = $evenements;

        return $this;
    }

    public function getCreationPar(): ?string
    {
        return $this->creationPar;
    }

    public function setCreationPar(?string $creationPar): static
    {
        $this->creationPar = $creationPar;

        return $this;
    }

    public function getModificationPar(): ?string
    {
        return $this->modificationPar;
    }

    public function setModificationPar(?string $modificationPar): static
    {
        $this->modificationPar = $modificationPar;

        return $this;
    }
}

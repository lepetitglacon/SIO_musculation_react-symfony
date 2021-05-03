<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CommentaireBoissonRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=CommentaireBoissonRepository::class)
 * @ApiResource(collectionOperations=
 *     {
 *          "delete"={
 *     "security"="is_granted('ROLE_ADMIN') or object.getProprietaire() == user"}
 *     },
 *     normalizationContext={"groups"={"boisson"}})
 */
class CommentaireBoisson
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"boisson"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"boisson"})
     */
    private $titre;

    /**
     * @ORM\Column(type="text")
     * @Groups({"boisson"})
     */
    private $message;

    /**
     * @ORM\ManyToOne(targetEntity=Utilisateur::class, inversedBy="commentaireBoissons")
     * @Groups({"boisson"})
     */
    private $proprietaire;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"boisson"})
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity=Boisson::class, inversedBy="commentaireBoissons")
     */
    private $boisson;

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

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getProprietaire(): ?Utilisateur
    {
        return $this->proprietaire;
    }

    public function setProprietaire(?Utilisateur $proprietaire): self
    {
        $this->proprietaire = $proprietaire;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getBoisson(): ?Boisson
    {
        return $this->boisson;
    }

    public function setBoisson(?Boisson $boisson): self
    {
        $this->boisson = $boisson;

        return $this;
    }
}

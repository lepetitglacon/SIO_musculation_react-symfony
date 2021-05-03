<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\BoissonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=BoissonRepository::class)
 * @ApiResource(collectionOperations={
 *          "get",
 *          })
 */
class Boisson
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
     * @ORM\Column(type="string", length=255)
     * @Groups({"boisson"})
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"boisson"})
     */
    private $image;

    /**
     * @ORM\OneToMany(targetEntity=CommentaireBoisson::class, mappedBy="boisson")
     */
    private $commentaireBoissons;

    public function __construct()
    {
        $this->commentaireBoissons = new ArrayCollection();
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    /**
     * @return Collection|CommentaireBoisson[]
     */
    public function getCommentaireBoissons(): Collection
    {
        return $this->commentaireBoissons;
    }

    public function addCommentaireBoisson(CommentaireBoisson $commentaireBoisson): self
    {
        if (!$this->commentaireBoissons->contains($commentaireBoisson)) {
            $this->commentaireBoissons[] = $commentaireBoisson;
            $commentaireBoisson->setBoisson($this);
        }

        return $this;
    }

    public function removeCommentaireBoisson(CommentaireBoisson $commentaireBoisson): self
    {
        if ($this->commentaireBoissons->removeElement($commentaireBoisson)) {
            // set the owning side to null (unless already changed)
            if ($commentaireBoisson->getBoisson() === $this) {
                $commentaireBoisson->setBoisson(null);
            }
        }

        return $this;
    }
}

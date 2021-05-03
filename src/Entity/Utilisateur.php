<?php
namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity
 * @ORM\Table(name="Utilisateur")
 * @ApiResource(
 *      normalizationContext={"groups"={"atelier","boisson"}},
 * )
 */
class Utilisateur implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"read","atelier","boisson"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", unique=true)
     * @Assert\NotBlank()
     * @Groups({"read","atelier","boisson"})
     */
    private $login;

    /**
     * @ORM\Column(type="string" )
     * @Assert\NotBlank()
     * @Assert\Length(min=2, max=50)
     * @Groups({"read", "atelier","boisson"})
     * itemOperations={
     *          "put"={"access_control"="is_granted('ROLE_ADMIN') and object.getEmail == user"}
     *     }
     */
    private $nomUtilisateur;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @Assert\Length(min=2, max=50)
     * @Groups({"read", "atelier","boisson"})
     * itemOperations={
     *          "put"={"access_control"="is_granted('ROLE_ADMIN') and object.getEmail == user"}
     *     }
     */
    private $prenomUtilisateur;

    /**
     * @ORM\Column(type="string", unique=true )
     * @Assert\Email()
     * @Groups({"read", "atelier","boisson"})
     * itemOperations={
     *          "put"={"access_control"="is_granted('ROLE_ADMIN') and object.getEmail == user"}
     *     }
     */
    private $email;

    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     * @Groups({"read"})
     */
    private $password;

    /**
     * @ORM\Column(type="json")
     * @Groups({"read","atelier","boisson"})
     */
    private $roles = [];

    /**
     * @ORM\OneToMany(targetEntity=CommentaireAtelier::class, mappedBy="proprietaire", orphanRemoval=true)
     */
    private $commentaireAteliers;

    /**
     * @ORM\OneToMany(targetEntity=CommentaireBoisson::class, mappedBy="proprietaire")
     */
    private $commentaireBoissons;

    /**
     * Utilisateur constructor.
     */
    public function __construct()
    {
        $this->id = -1;
        $this->login = "";
        $this->nomUtilisateur = "";
        $this->prenomUtilisateur = "";
        $this->email = "";
        $this->password = "";
        $this->roles = "";
        $this->commentaireAteliers = new ArrayCollection();
        $this->commentaireBoissons = new ArrayCollection();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setLogin(string $login): void
    {
        $this->login = $login;
    }

    public function getLogin(): string
    {
        return $this->login;
    }

    public function getNomUtilisateur(): string
    {
        return $this->nomUtilisateur;
    }

    public function setNomUtilisateur(string $nomUtilisateur): void
    {
        $this->nomUtilisateur = $nomUtilisateur;
    }

    public function getPrenomUtilisateur(): string
    {
        return $this->prenomUtilisateur;
    }

    public function setPrenomUtilisateur(string $prenomUtilisateur): void
    {
        $this->prenomUtilisateur = $prenomUtilisateur;
    }


    /*
    * Méthode obligatoire pour répondre aux besoins de l'héritage à userInterface
    */
    public function getUserName(): string
    {
        return $this->login;
    }



    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /*
    * Méhtode héritée de UserInterface
    */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /*
    * Méhtode héritée de UserInterface
    */
    public function getRoles(): array
    {
        $roles = $this->roles;

// il est obligatoire d'avoir au moins un rôle si on est authentifié, par convention c'est ROLE_USER
        if (empty($roles)) {
            $roles[] = 'ROLE_USER';
        }

        return array_unique($roles);
    }

    public function setRoles(array $roles): void
    {
        $this->roles = $roles;
    }

    /*
    * Méhtode héritée de UserInterface
    */
    public function getSalt(): ?string
    {
        return null;
    }

    /*
    * Méhtode héritée de UserInterface
    */
    public function eraseCredentials(): void
    {
    }

    /**
     * @return Collection|CommentaireAtelier[]
     */
    public function getCommentaireAteliers(): Collection
    {
        return $this->commentaireAteliers;
    }

    public function addCommentaireAtelier(CommentaireAtelier $commentaireAtelier): self
    {
        if (!$this->commentaireAteliers->contains($commentaireAtelier)) {
            $this->commentaireAteliers[] = $commentaireAtelier;
            $commentaireAtelier->setProprietaire($this);
        }

        return $this;
    }

    public function removeCommentaireAtelier(CommentaireAtelier $commentaireAtelier): self
    {
        if ($this->commentaireAteliers->removeElement($commentaireAtelier)) {
            // set the owning side to null (unless already changed)
            if ($commentaireAtelier->getProprietaire() === $this) {
                $commentaireAtelier->setProprietaire(null);
            }
        }

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
            $commentaireBoisson->setProprietaire($this);
        }

        return $this;
    }

    public function removeCommentaireBoisson(CommentaireBoisson $commentaireBoisson): self
    {
        if ($this->commentaireBoissons->removeElement($commentaireBoisson)) {
            // set the owning side to null (unless already changed)
            if ($commentaireBoisson->getProprietaire() === $this) {
                $commentaireBoisson->setProprietaire(null);
            }
        }

        return $this;
    }
}
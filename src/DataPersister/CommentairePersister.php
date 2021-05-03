<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use App\Entity\CommentaireAtelier;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class CommentairePersister implements DataPersisterInterface
{
    protected $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em=$em;
    }

    public function supports($data): bool
    {
        return $data instanceof CommentaireAtelier;
    }

    public function persist($data)
    {
        $data->setDate(new \DateTime("now"));
        $this->em->persist($data);
        $this->em->flush();
    }

    public function remove($data)
    {
        $this->em->remove($data);
        $this->em->flush();
    }
}
<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use App\Entity\Atelier;
use App\Entity\CommentaireAtelier;

class AtelierPersister implements DataPersisterInterface
{

    public function supports($data): bool
    {
        return $data instanceof Atelier;
    }

    public function persist($data)
    {
        $data = $request->toArray();
        $commentaire = new CommentaireAtelier();
        $commentaire->setAtelier($atelierRepository->find($id));
        $commentaire->setProprietaire($this->getUser());
        $commentaire->setDate(new \DateTime());
        $commentaire->setTitre($data["titre"]);
        $commentaire->setMessage($data["message"]);

        $entitymanager = $this->getDoctrine()->getManager();
        $entitymanager->persist($commentaire);

        $entitymanager->flush();
    }

    public function remove($data)
    {
        // TODO: Implement remove() method.
    }
}
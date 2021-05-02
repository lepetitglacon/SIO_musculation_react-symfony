<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use App\Entity\Atelier;

class AtelierPersister implements DataPersisterInterface
{

    public function supports($data): bool
    {
        return $data instanceof Atelier;
    }

    public function persist($data)
    {
        // TODO: Implement persist() method.
    }

    public function remove($data)
    {
        // TODO: Implement remove() method.
    }
}
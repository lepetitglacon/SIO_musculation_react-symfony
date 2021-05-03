<?php

namespace App\Repository;

use App\Entity\CommentaireBoisson;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CommentaireBoisson|null find($id, $lockMode = null, $lockVersion = null)
 * @method CommentaireBoisson|null findOneBy(array $criteria, array $orderBy = null)
 * @method CommentaireBoisson[]    findAll()
 * @method CommentaireBoisson[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CommentaireBoissonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CommentaireBoisson::class);
    }

    // /**
    //  * @return CommentaireBoisson[] Returns an array of CommentaireBoisson objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CommentaireBoisson
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

<?php

namespace App\Repository;

use App\Entity\Glasses;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Glasses|null find($id, $lockMode = null, $lockVersion = null)
 * @method Glasses|null findOneBy(array $criteria, array $orderBy = null)
 * @method Glasses[]    findAll()
 * @method Glasses[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GlassesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Glasses::class);
    }

    // /**
    //  * @return Glasses[] Returns an array of Glasses objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Glasses
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

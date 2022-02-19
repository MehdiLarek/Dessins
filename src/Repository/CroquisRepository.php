<?php

namespace App\Repository;

use App\Entity\Croquis;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Croquis|null find($id, $lockMode = null, $lockVersion = null)
 * @method Croquis|null findOneBy(array $criteria, array $orderBy = null)
 * @method Croquis[]    findAll()
 * @method Croquis[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CroquisRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Croquis::class);
    }

    // /**
    //  * @return Croquis[] Returns an array of Croquis objects
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
    public function findOneBySomeField($value): ?Croquis
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

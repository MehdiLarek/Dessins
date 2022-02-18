<?php

namespace App\Repository;

use App\Entity\Paysages;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Paysages|null find($id, $lockMode = null, $lockVersion = null)
 * @method Paysages|null findOneBy(array $criteria, array $orderBy = null)
 * @method Paysages[]    findAll()
 * @method Paysages[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PaysagesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Paysages::class);
    }

    // /**
    //  * @return Paysages[] Returns an array of Paysages objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Paysages
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

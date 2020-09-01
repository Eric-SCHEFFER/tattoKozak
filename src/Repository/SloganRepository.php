<?php

namespace App\Repository;

use App\Entity\Slogan;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Slogan|null find($id, $lockMode = null, $lockVersion = null)
 * @method Slogan|null findOneBy(array $criteria, array $orderBy = null)
 * @method Slogan[]    findAll()
 * @method Slogan[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SloganRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Slogan::class);
    }

    // /**
    //  * @return Slogan[] Returns an array of Slogan objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Slogan
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

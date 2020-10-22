<?php

namespace App\Repository;

use App\Entity\AProposEtInfos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method AProposEtInfos|null find($id, $lockMode = null, $lockVersion = null)
 * @method AProposEtInfos|null findOneBy(array $criteria, array $orderBy = null)
 * @method AProposEtInfos[]    findAll()
 * @method AProposEtInfos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AProposEtInfosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AProposEtInfos::class);
    }

    // /**
    //  * @return AProposEtInfos[] Returns an array of AProposEtInfos objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?AProposEtInfos
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

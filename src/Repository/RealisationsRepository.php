<?php

namespace App\Repository;

use App\Entity\Realisations;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Realisations|null find($id, $lockMode = null, $lockVersion = null)
 * @method Realisations|null findOneBy(array $criteria, array $orderBy = null)
 * @method Realisations[]    findAll()
 * @method Realisations[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RealisationsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Realisations::class);
    }



    // Coder la méthode pour rechercher dans la bdd les 3 dernières réalisations (table réalisations), avec la première image liée à chaque réalisation (table images)
    public function findLast3Realisations()
    {
        $query = $this->createQueryBuilder('realis');
        $query = $query->select('realis')
            ->innerJoin('realis.images', 'i')
            ->where('i.realisations_id = :id')
            ->setParameter('id', 'toto')
            ->orderBy('realis.date_fin', 'DESC')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult();
        return $query;





        // return $this->createQueryBuilder('realis')
        // ->innerJoin('images', 'i')
        // // ->where('i.id = :images.realisations_id_id')
        // ->orderBy('realis.date_fin', 'DESC')
        // ->setMaxResults(3)
        // ->getQuery()
        // ->getResult();
    }


    // public function findPostByCategory($categoryId)
    // {
    //     $query = $this->createQueryBuilder('p');
    //     $query = $query->select('p')
    //         ->innerJoin('p.categoryPost', 'c')
    //         ->where('c.id = :categoryId')
    //         ->setParameter('categoryId', $categoryId)
    //         ->getQuery()
    //         ->getResult();
    //     return $query;
    // }


    // /**
    //  * @return Realisations[] Returns an array of Realisations objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Realisations
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

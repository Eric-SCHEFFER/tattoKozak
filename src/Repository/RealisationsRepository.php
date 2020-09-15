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


    // Essai avec DQL

    public function findLast3Realisations()
    {
        // Select simple
        $dql = 'SELECT * FROM App\Entity\Realisations';
        $query = $this->getEntityManager()->createQuery($dql);


        // join
        // $query = $em->createQuery("SELECT u FROM User u JOIN u.address a WHERE a.city = 'Berlin'");
        // $users = $query->getResult();

        
        // dd($query);
        return $query->execute();
    }



    // Essai avec QueryBuilder, mais ça me retourne un tableau vide.

    // public function findLast3Realisations()
    // {
    //     $query = $this->createQueryBuilder('r')
    //         ->select('r')
    //         ->join('r.images', 'i', 'WITH', 'i.realisations_id = :id')
    //         // ->andwhere('i.realisations_id = :id')
    //         // ->orderBy('r.date_fin', 'DESC')
    //         ->setParameter('id', 'toto')
    //         // ->setMaxResults(3)
    //         ->getQuery()
    //         ->getResult();
    //     dd($query);
    //     // return $query;
    // }




    // ============ Exemples fournis par symfony ================

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

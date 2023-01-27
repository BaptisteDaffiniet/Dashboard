<?php

namespace App\Repository;

use App\Entity\SteamAppNews;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SteamAppNews|null find($id, $lockMode = null, $lockVersion = null)
 * @method SteamAppNews|null findOneBy(array $criteria, array $orderBy = null)
 * @method SteamAppNews[]    findAll()
 * @method SteamAppNews[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SteamAppNewsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SteamAppNews::class);
    }

    // /**
    //  * @return SteamAppNews[] Returns an array of SteamAppNews objects
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
    public function findOneBySomeField($value): ?SteamAppNews
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

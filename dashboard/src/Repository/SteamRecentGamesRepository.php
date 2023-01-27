<?php

namespace App\Repository;

use App\Entity\SteamRecentGames;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SteamRecentGames|null find($id, $lockMode = null, $lockVersion = null)
 * @method SteamRecentGames|null findOneBy(array $criteria, array $orderBy = null)
 * @method SteamRecentGames[]    findAll()
 * @method SteamRecentGames[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SteamRecentGamesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SteamRecentGames::class);
    }

    // /**
    //  * @return SteamRecentGames[] Returns an array of SteamRecentGames objects
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
    public function findOneBySomeField($value): ?SteamRecentGames
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

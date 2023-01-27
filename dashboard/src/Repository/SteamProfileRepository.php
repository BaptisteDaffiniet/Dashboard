<?php

namespace App\Repository;

use App\Entity\SteamProfile;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method SteamProfile|null find($id, $lockMode = null, $lockVersion = null)
 * @method SteamProfile|null findOneBy(array $criteria, array $orderBy = null)
 * @method SteamProfile[]    findAll()
 * @method SteamProfile[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SteamProfileRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SteamProfile::class);
    }

    // /**
    //  * @return SteamProfile[] Returns an array of SteamProfile objects
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
    public function findOneBySomeField($value): ?SteamProfile
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

<?php

namespace App\Repository;

use App\Entity\DeviseConversion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DeviseConversion|null find($id, $lockMode = null, $lockVersion = null)
 * @method DeviseConversion|null findOneBy(array $criteria, array $orderBy = null)
 * @method DeviseConversion[]    findAll()
 * @method DeviseConversion[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DeviseConversionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DeviseConversion::class);
    }

    // /**
    //  * @return DeviseConversion[] Returns an array of DeviseConversion objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DeviseConversion
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

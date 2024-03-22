<?php

namespace App\Repository;

use App\Entity\Adopters;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Adopters>
 *
 * @method Adopters|null find($id, $lockMode = null, $lockVersion = null)
 * @method Adopters|null findOneBy(array $criteria, array $orderBy = null)
 * @method Adopters[]    findAll()
 * @method Adopters[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdoptersRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Adopters::class);
    }

    //    /**
    //     * @return Adopters[] Returns an array of Adopters objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('a.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Adopters
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}

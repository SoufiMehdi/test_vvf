<?php

namespace App\Repository;

use App\Entity\Asked;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Asked>
 *
 * @method Asked|null find($id, $lockMode = null, $lockVersion = null)
 * @method Asked|null findOneBy(array $criteria, array $orderBy = null)
 * @method Asked[]    findAll()
 * @method Asked[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AskedRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Asked::class);
    }

//    /**
//     * @return Asked[] Returns an array of Asked objects
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

//    public function findOneBySomeField($value): ?Asked
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

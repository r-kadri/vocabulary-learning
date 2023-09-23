<?php

namespace App\Repository;

use App\Entity\WordLevel;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<WordLevel>
 *
 * @method WordLevel|null find($id, $lockMode = null, $lockVersion = null)
 * @method WordLevel|null findOneBy(array $criteria, array $orderBy = null)
 * @method WordLevel[]    findAll()
 * @method WordLevel[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WordLevelRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WordLevel::class);
    }

//    /**
//     * @return WordLevel[] Returns an array of WordLevel objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('w')
//            ->andWhere('w.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('w.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?WordLevel
//    {
//        return $this->createQueryBuilder('w')
//            ->andWhere('w.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

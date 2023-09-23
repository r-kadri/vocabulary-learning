<?php

namespace App\Repository;

use App\Entity\GoalList;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<GoalList>
 *
 * @method GoalList|null find($id, $lockMode = null, $lockVersion = null)
 * @method GoalList|null findOneBy(array $criteria, array $orderBy = null)
 * @method GoalList[]    findAll()
 * @method GoalList[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GoalListRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GoalList::class);
    }

//    /**
//     * @return GoalList[] Returns an array of GoalList objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('g.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?GoalList
//    {
//        return $this->createQueryBuilder('g')
//            ->andWhere('g.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

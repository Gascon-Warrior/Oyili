<?php

namespace App\Repository;

use App\Entity\VideoJobWorker;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<VideoJobWorker>
 *
 * @method VideoJobWorker|null find($id, $lockMode = null, $lockVersion = null)
 * @method VideoJobWorker|null findOneBy(array $criteria, array $orderBy = null)
 * @method VideoJobWorker[]    findAll()
 * @method VideoJobWorker[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VideoJobWorkerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, VideoJobWorker::class);
    }

//    /**
//     * @return VideoJobWorker[] Returns an array of VideoJobWorker objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('v.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?VideoJobWorker
//    {
//        return $this->createQueryBuilder('v')
//            ->andWhere('v.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
